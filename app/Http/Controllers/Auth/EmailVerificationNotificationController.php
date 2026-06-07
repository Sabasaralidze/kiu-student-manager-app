<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\Mailer\Exception\TransportException;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('tasks.index', absolute: false));
        }

        try {
            $request->user()->sendEmailVerificationNotification();
        } catch (TransportException) {
            return back()->with('mail-error', 'Gmail login failed. Use a Gmail App Password in .env (see instructions below), or set MAIL_MAILER=log for local testing.');
        }

        if (config('mail.default') === 'log') {
            return back()->with([
                'status' => 'verification-link-sent',
                'mail-log-hint' => true,
            ]);
        }

        return back()->with('status', 'verification-link-sent');
    }
}
