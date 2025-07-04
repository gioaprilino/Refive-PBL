<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class HrdPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('hrd')
            ->path('hrd')
            ->login()
            ->brandName('Tri Virya Nusantara')
            ->favicon(asset('/front/img/LOGO TVN.png'))
            ->breadcrumbs(false)
            ->databaseNotifications()
            ->databaseNotificationsPolling('5s')
            ->colors([
                'primary' => Color::Red,
            ])
            ->discoverResources(in: app_path('Filament/Hrd/Resources'), for: 'App\\Filament\\Hrd\\Resources')
            ->discoverPages(in: app_path('Filament/Hrd/Pages'), for: 'App\\Filament\\Hrd\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Hrd/Widgets'), for: 'App\\Filament\\Hrd\\Widgets')
            ->widgets([
                \App\Filament\Hrd\Widgets\StatsOverview::class,
                \App\Filament\Hrd\Widgets\LatestLeaveRequests::class,
                \App\Filament\Hrd\Widgets\PendingLeaveRequestsChart::class
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
            ]);
    }
}
