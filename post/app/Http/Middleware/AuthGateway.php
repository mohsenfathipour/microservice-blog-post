<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthGateway
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        $url = config('microservice.user') . 'auth/check-token';

        $response = Http::post($url, ['token' => $token])->json();

        // ToDo: Permission
        if(!isset($response['success']) || $response['success'] !== true) {
            return response()->json([
                'success' => false,
                'message' => 'token is invalid'
            ]);
        }

        $user = new GenericUser($response['data']);
        Auth::login($user);

        return $next($request);
    }
}
