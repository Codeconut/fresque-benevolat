<?php

namespace App\Providers\Filament;

use App\Http\Middleware\LastOnlineAt;
use Awcodes\FilamentGravatar\GravatarPlugin;
use Awcodes\FilamentGravatar\GravatarProvider;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\App;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        // Carbon::setLocale(config('app.locale'));

        // if (App::environment('production')) {
        //     \Illuminate\Support\Facades\URL::forceScheme('https');
        // }

        FilamentColor::register([
            'danger' => Color::Red,
            'gray' => Color::Zinc,
            'info' => Color::hex('#000091'),
            'primary' => Color::hex('#000091'),
            'success' => Color::Green,
            'warning' => Color::Amber,
        ]);

        // Filament::serving(function () {
        //     Filament::registerUserMenuItems([
        //         'account' => MenuItem::make()->label('Mon profil')->url(route('filament.app.animator.profile')),
        //     ]);
        // });
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->darkMode(false)
            ->brandName('Admin - La Fresque du Bénévolat')
            ->brandLogo(asset('images/logos/fresque-benevolat-logo.svg'))
            ->brandLogoHeight('55px')
            ->breadcrumbs(false)
            ->id('admin')
            ->path('admin')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->login()
            ->passwordReset()
            ->userMenuItems([
                'profile' => MenuItem::make()->label('Mon profil')->url(fn (): string => route('filament.app.animator.profile'))->hidden(fn (): bool => ! auth()->user()->hasRole('animator')),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->defaultAvatarProvider(GravatarProvider::class)
            ->plugins([
                GravatarPlugin::make(),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                LastOnlineAt::class,
            ]);
    }
}
