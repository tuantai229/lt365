<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to display to the user. Finally, we'll send out a proper response.
        $status = $this->sendResetLink($request->only('email'));

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

    /**
     * Send a new password reset link.
     *
     * @param  array  $credentials
     * @return string
     */
    protected function sendResetLink(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();

        if (is_null($user)) {
            return Password::INVALID_USER;
        }

        $token = $this->generateToken($user);
        
        $resetUrl = url(route('auth.password.reset', [
            'token' => $token,
            'email' => $user->email,
        ], false));

        Mail::send('emails.reset-password', [
            'user' => $user,
            'resetUrl' => $resetUrl,
        ], function ($message) use ($user) {
            $message->to($user->email, $user->full_name)
                ->subject('Yêu cầu đặt lại mật khẩu');
        });

        return Password::RESET_LINK_SENT;
    }

    /**
     * Generate a new token for the user.
     *
     * @param  \App\Models\User  $user
     * @return string
     */
    protected function generateToken(User $user): string
    {
        // The create method generates a token, hashes it for storage, and returns the plain-text token.
        return Password::broker()->getRepository()->create($user);
    }
}
