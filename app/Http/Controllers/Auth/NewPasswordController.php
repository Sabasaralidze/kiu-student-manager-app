<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = null;

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $resetUser) use ($request, &$user) {
                $resetUser->forceFill([
                    'password' => $request->password,
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($resetUser));

                $user = $resetUser;
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('tasks.index')
                ->with('success', 'Password updated. Welcome back!');
        }

        $message = match ($status) {
            Password::INVALID_TOKEN => 'This reset link is invalid or already used. Request a new link and use only the latest one from the log.',
            Password::INVALID_USER => 'No account found with this email address.',
            default => __($status),
        };

        return back()->withInput($request->only('email'))
            ->withErrors(['email' => $message]);
    }
}
