<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->renderHook('scripts.end',
                fn () => '<script src="'.asset('js/contact-autocomplete.js').'"></script>'.
                '<meta name="rapidapi-key" content="'.env('RAPIDAPI_KEY').'">')
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Tri Virya Nusantara')
            ->favicon(asset('/front/img/LOGO TVN.png'))
            ->sidebarCollapsibleOnDesktop()
            ->breadcrumbs(false)
            ->colors([
                    'primary' => Color::Blue,
                ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                    Pages\Dashboard::class,
                ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                    Widgets\AccountWidget::class,
                    Widgets\FilamentInfoWidget::class,
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
                    \App\Http\Middleware\PanelRoleMiddleware::class,
                ])
            ->authMiddleware([
                    Authenticate::class,
                ])

            ->navigationItems([
                    NavigationItem::make('Tri Virya Nusantara')
                        ->url('http://localhost:8000', shouldOpenInNewTab: true)
                        ->icon('heroicon-o-eye')
                        ->group('View Site')
                        ->sort(3),
                ]);

    }
}
