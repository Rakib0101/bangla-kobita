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
            'login_name' => ['required', 'string', 'max:255', 'unique:users,login_name'],
            'name_bangla' => ['required', 'string', 'max:255'],
            'input_method' => ['required', 'in:english,avro,unijoy'],
            'name_english' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'has_other_account' => ['required', 'in:yes,no,inactive'],
            'terms_accepted' => ['required', 'accepted'],
        ]);

        $user = User::create([
            'name' => $request->name_english, // Keep original name field for compatibility
            'login_name' => $request->login_name,
            'name_bangla' => $request->name_bangla,
            'input_method' => $request->input_method,
            'name_english' => $request->name_english,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'has_other_account' => $request->has_other_account,
            'terms_accepted' => true,
            'role' => 'author',
            'is_active' => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
