<?php

namespace App\Http\Controllers;

class MainController
{
    /**
     * If the user is authenticated, redirect to the dashboard.
     * Otherwise, redirect to the registration page.
     */
    public function index()
    {
        if (auth()->check()) {
            // Pass in the authenticated user
            return redirect()->route('home', auth()->user());
        }

        return redirect()->route('register');
    }

    // Home route, passing in auth middleware auth()->user()
    public function home()
    {
        // Pass in the authenticated user
        return view('home', ['current_user' => auth()->user()]);
    }
}
