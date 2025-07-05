<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PanelRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $panel = Filament::getCurrentPanel()?->getId();

        if ($user) {
            if ($panel === 'admin' && $user->role !== 'admin') {
                abort(403, 'Hanya admin yang boleh mengakses panel Admin.');
            }
            if ($panel === 'hrd' && $user->role !== 'hrd') {
                abort(403, 'Hanya HRD yang boleh mengakses panel HRD.');
            }
        }

        return $next($request);
    }
}
