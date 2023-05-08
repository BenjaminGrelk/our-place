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
            return redirect()->route('dashboard');
        }

        return redirect()->route('register');
    }
}
