<?php

namespace App\Filament\Pages;

use App\Http\Responses\CustomRegistrationResponse;
use App\Models\Animator;
use App\Models\UserInvitation;
use App\Notifications\UserAnimatorHasAcceptedInvitation;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
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

        $animator = Animator::where('email', $this->invitation->email)->first();

        $this->form->fill([
            'email' => $this->invitation->email,
            'first_name' => $animator ? $animator->first_name : null,
            'last_name' => $animator ? $animator->last_name : null,
        ]);
    }

    /**
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getFirstNameFormComponent(),
                        $this->getLastNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
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
        $data['name'] = $data['first_name'].' '.$data['last_name'];

        $user = $this->getUserModel()::create($data);

        if ($this->invitation->role) {
            $user->assignRole($this->invitation->role);
            if ($this->invitation->role === 'animator') {
                $animator = Animator::where('email', $this->invitation->email)->first();
                if ($animator) {
                    $animator->user_id = $user->id;
                    $animator->first_name = $data['first_name'];
                    $animator->last_name = $data['last_name'];
                    $animator->save();
                } else {
                    $user->animator()->create([
                        'email' => $this->invitation->email,
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                    ]);
                }

                $user->notify(new UserAnimatorHasAcceptedInvitation);
            }
        }

        $this->invitation->delete();

        app()->bind(
            \Illuminate\Auth\Listeners\SendEmailVerificationNotification::class,
        );

        event(new Registered($user));

        Filament::auth()->login($user);

        session()->regenerate();

        if ($user->hasRole('animator')) {
            return new CustomRegistrationResponse(route('filament.app.animator.profile'));
        }

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

    protected function getFirstNameFormComponent(): Component
    {
        return TextInput::make('first_name')
            ->label('Prénom')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getLastNameFormComponent(): Component
    {
        return TextInput::make('last_name')
            ->label('Nom')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    public function getRegisterFormAction(): Action
    {
        return Action::make('register')
            ->label(__('filament-panels::pages/auth/register.form.actions.register.label'))
            ->size('xl')
            ->submit('register');
    }
}
