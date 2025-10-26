<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'preferred_route' => ['required', 'string', 'in:line1,line2,line3,line4,line5,line6,line7,line8'],
        ]);

        $user = User::create([
            'name' => trim($request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'preferred_route' => $request->preferred_route,
        ]);

        // Create user profile with normalized name
        $user->profile()->create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
        ]);

        // Assign driver role to the new user
        $user->assignRole('driver');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('driver.dashboard', absolute: false));
    }
}
