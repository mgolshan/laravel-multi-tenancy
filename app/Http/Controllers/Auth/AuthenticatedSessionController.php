<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        /** @var User $user */
        $user = $request->user();
        $tenant = $user->firstTenant();
        $domain = $tenant ? $tenant->firstDomain()->domain : config('app.domain');

        $url = 'https://' . $domain . route('dashboard', absolute: false);

        return redirect($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): FoundationResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $url = config('app.url') . route('home', absolute: false);

        return Inertia::location($url);
    }
}
