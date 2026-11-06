<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    // Hanya user dengan role "customer" yang boleh lanjut ke Controller.
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->role !== 'customer') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Hanya customer yang boleh mengakses.',
                'data'    => null,
            ], 403);
        }

        return $next($request);
    }
}
