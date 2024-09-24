<?php

namespace App\Filament\Pages;

use App\Models\Animator;
use App\Models\UserInvitation;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Auth\Events\Registered;
use Livewire\Attributes\Url;

class Invitation extends BaseRegister
{
    #[Url]
    public $token = '';

    public ?UserInvitation $invitation = null;

    public ?array $data = [];

    public function mount(): void
    {
        $this->invitation = UserInvitation::where('code', $this->token)->firstOrFail();

        $this->form->fill([
            'email' => $this->invitation->email,
        ]);
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/register.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/register.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/register.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        $user = $this->getUserModel()::create($data);

        if ($this->invitation->role) {
            $user->assignRole($this->invitation->role);
            if ($this->invitation->role === 'animator') {
                $animator = Animator::where('email', $this->invitation->email)->first();
                if ($animator) {
                    $animator->user_id = $user->id;
                    $animator->save();
                } else {
                    Animator::create([
                        'user_id' => $user->id,
                        'email' => $this->invitation->email,
                    ]);
                }
            }
        }

        $this->invitation->delete();

        app()->bind(
            \Illuminate\Auth\Listeners\SendEmailVerificationNotification::class,
        );

        event(new Registered($user));

        Filament::auth()->login($user);

        session()->regenerate();

        return app(RegistrationResponse::class);
    }

    protected function getEmailFormComponent(): Component
    {
        return Forms\Components\TextInput::make('email')
            ->label(__('filament-panels::pages/auth/register.form.email.label'))
            ->email()
            ->required()
            ->maxLength(255)
            ->unique($this->getUserModel())
            ->readOnly();
    }
}
