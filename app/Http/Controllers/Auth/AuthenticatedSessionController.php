<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->user()->usertype === 'superadmin') {
            return redirect('superadmin/dashboard');
        }

        if ($request->user()->usertype === 'admin') {
            return redirect('admin/dashboard');
        }

        if ($request->user()->usertype === 'seller') {
            $userTest = User::findOrFail(Auth::user()->id);
            if ($userTest->forfait->statut == 'Bloquer') {
                sweetalert()->error('Votre compte a été bloqué par nos administrateur .Veuiilez les contacter pour plus d\'information au 658949091');
                return redirect('/');
            }

            return redirect('seller/dashboard');
        }

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
