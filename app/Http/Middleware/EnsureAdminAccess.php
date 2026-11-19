<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdminAccess
{
    /**
     * Allow only staff accounts (admin / worker / vendor) into the backend.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('admin.login');
        }

        if ($user->hasAnyRole(['admin', 'worker', 'vendor']) || $user->can('dashboard.access')) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
