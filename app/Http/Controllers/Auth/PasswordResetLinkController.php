<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_THROTTLED) {
            $message = $this->throttleMessage($request->email);

            return back()->withInput($request->only('email'))
                ->withErrors(['email' => $message]);
        }

        if ($status === Password::RESET_LINK_SENT) {
            $flash = ['status' => __($status)];

            if (config('mail.default') === 'log') {
                $flash['mail-log-hint'] = true;
            }

            return back()->with($flash);
        }

        return back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }

    private function throttleMessage(string $email): string
    {
        $throttle = config('auth.passwords.users.throttle', 60);
        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        if ($record) {
            $waitUntil = Carbon::parse($record->created_at)->addSeconds($throttle);
            $secondsLeft = max(1, $waitUntil->timestamp - now()->timestamp);

            return "Please wait {$secondsLeft} seconds before requesting another reset link.";
        }

        return 'Please wait before retrying.';
    }
}
