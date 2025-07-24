<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display the login form.
     */
    public function showLogin(Request $request): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // Check if user exists and is active
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email không tồn tại trong hệ thống.',
            ])->onlyInput('email');
        }

        if ($user->status !== 1) {
            return back()->withErrors([
                'email' => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email để xác thực.',
            ])->onlyInput('email');
        }

        if (!$user->isVerified()) {
            return back()->withErrors([
                'email' => 'Email chưa được xác thực. Vui lòng kiểm tra email để xác thực.',
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Update last login time
            $user->updateLastLogin();

            // Redirect to intended URL or home
            $intended = $request->session()->get('url.intended', '/');
            return redirect()->intended($intended)->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('email');
    }

    /**
     * Display the registration form.
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15', 'regex:/^[0-9\-\+\(\)\s]+$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['required', 'accepted'],
        ], [
            'full_name.required' => 'Vui lòng nhập họ và tên.',
            'full_name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Email này đã được sử dụng.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'terms.required' => 'Vui lòng đồng ý với điều khoản sử dụng.',
            'terms.accepted' => 'Vui lòng đồng ý với điều khoản sử dụng.',
        ]);

        // Create user with status = 0 (inactive)
        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'status' => 0, // Inactive until email verification
        ]);

        // Generate verification token
        $token = Str::random(60);
        $user->remember_token = $token;
        $user->save();

        // Send verification email
        $this->sendVerificationEmail($user, $token);

        // Subscribe to newsletter if requested
        if ($request->boolean('newsletter')) {
            // Add newsletter subscription logic here if needed
        }

        event(new Registered($user));

        return redirect()->route('auth.verify.notice')
            ->with('email', $user->email)
            ->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email để xác thực tài khoản.');
    }

    /**
     * Display the email verification notice.
     */
    public function verifyNotice(Request $request): View
    {
        $email = $request->session()->get('email', 'your-email@example.com');
        return view('auth.verify-notice', compact('email'));
    }

    /**
     * Handle email verification.
     */
    public function verify(Request $request): RedirectResponse
    {
        $token = $request->query('token');
        $email = $request->query('email');

        if (!$token || !$email) {
            return redirect()->route('auth.register')
                ->withErrors(['token' => 'Liên kết xác thực không hợp lệ.']);
        }

        $user = User::where('email', $email)
            ->where('remember_token', $token)
            ->first();

        if (!$user) {
            return redirect()->route('auth.register')
                ->withErrors(['token' => 'Liên kết xác thực không hợp lệ hoặc đã hết hạn.']);
        }

        // Check if already verified
        if ($user->isVerified() && $user->status === 1) {
            return redirect()->route('auth.login')
                ->with('info', 'Tài khoản đã được xác thực trước đó.');
        }

        // Verify email and activate account
        $user->email_verified_at = now();
        $user->status = 1; // Activate account
        $user->remember_token = null; // Clear verification token
        $user->save();

        return redirect()->route('auth.login')
            ->with('success', 'Xác thực email thành công! Bạn có thể đăng nhập ngay bây giờ.');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Đăng xuất thành công!');
    }

    /**
     * Resend verification email.
     */
    public function resendVerification(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->isVerified() && $user->status === 1) {
            return back()->with('info', 'Email đã được xác thực trước đó.');
        }

        // Check rate limiting - prevent resending within 60 seconds
        $lastSentKey = 'email_verification_sent_' . $user->id;
        $lastSentTime = cache()->get($lastSentKey);
        
        if ($lastSentTime && now()->diffInSeconds($lastSentTime) < 60) {
            $remainingSeconds = 60 - now()->diffInSeconds($lastSentTime);
            return back()->withErrors([
                'resend' => "Vui lòng đợi {$remainingSeconds} giây trước khi gửi lại email xác thực."
            ]);
        }

        // Generate new verification token
        $token = Str::random(60);
        $user->remember_token = $token;
        $user->save();

        // Send verification email
        $this->sendVerificationEmail($user, $token);

        // Cache the sent time for rate limiting
        cache()->put($lastSentKey, now(), 60);

        return back()->with('success', 'Email xác thực đã được gửi lại!');
    }

    /**
     * Send verification email to user.
     */
    private function sendVerificationEmail(User $user, string $token): void
    {
        $verificationUrl = URL::temporarySignedRoute(
            'auth.verify',
            now()->addMinutes(60), // URL expires in 60 minutes
            [
                'email' => $user->email,
                'token' => $token,
            ]
        );

        // Send email using Laravel's mail system
        Mail::send('emails.verify-email', [
            'user' => $user,
            'verificationUrl' => $verificationUrl,
        ], function ($message) use ($user) {
            $message->to($user->email, $user->full_name)
                ->subject('Xác thực tài khoản LT365');
        });
    }
}
