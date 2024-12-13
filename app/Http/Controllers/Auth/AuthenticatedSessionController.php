<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.login'); 
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // Redirect back with error if authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput(); // Preserve the old input for convenience
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log out the user
        Auth::guard('web')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect()->route('login');
    }
}
