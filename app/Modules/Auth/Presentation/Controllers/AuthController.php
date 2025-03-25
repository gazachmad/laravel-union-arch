<?php

namespace App\Modules\Auth\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Core\Application\Services\Login\LoginRequest;
use App\Modules\Auth\Core\Application\Services\Login\LoginService;
use App\Modules\Auth\Core\Application\Services\Logout\LogoutService;
use App\Modules\Auth\Core\Application\Services\Register\RegisterRequest;
use App\Modules\Auth\Core\Application\Services\Register\RegisterService;
use App\Modules\Auth\Core\Application\Services\ResetPassword\ResetPasswordRequest;
use App\Modules\Auth\Core\Application\Services\ResetPassword\ResetPasswordService;
use App\Modules\Auth\Core\Application\Services\SendResetPasswordLink\SendResetPasswordLinkRequest;
use App\Modules\Auth\Core\Application\Services\SendResetPasswordLink\SendResetPasswordLinkService;
use App\Modules\Shared\Mechanism\UnitOfWork;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private UnitOfWork $unit_of_work) {}

    /** @return RedirectResponse|View */
    public function login(Request $request, LoginService $service)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'phone_number' => 'required',
                'password' => 'required'
            ]);

            try {
                $this->unit_of_work->transaction(fn() => $service->execute(
                    new LoginRequest(
                        $request->input('phone_number'),
                        $request->input('password'),
                        $request->boolean('remember')
                    )
                ));
            } catch (Exception $e) {
                return redirect()->back()->withInput()->with('alert.error', $e->getMessage());
            }

            return redirect()->intended();
        }

        $data = ['title' => 'Login'];

        return view('Auth::login', $data);
    }

    /** @return RedirectResponse|View */
    public function register(Request $request, RegisterService $service)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required',
                'phone_number' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed'
            ]);

            try {
                $this->unit_of_work->transaction(fn() => $service->execute(
                    new RegisterRequest(
                        $request->input('name'),
                        $request->input('phone_number'),
                        $request->input('email'),
                        $request->input('password')
                    )
                ));
            } catch (Exception $e) {
                return redirect()->back()->withInput()->with('alert.error', $e->getMessage());
            }

            return redirect()->route('login')->with('alert.success', 'User registered successfully');
        }

        $data = ['title' => 'Register'];

        return view('Auth::register', $data);
    }

    /** @return RedirectResponse|View */
    public function forgotPassword(Request $request, SendResetPasswordLinkService $service)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'email' => 'required|email|exists:users'
            ]);

            try {
                $service->execute(
                    new SendResetPasswordLinkRequest($request->input('email'))
                );
            } catch (Exception $e) {
                return redirect()->back()->withInput()->with('alert.error', $e->getMessage());
            }

            return redirect()->route('login')->with('alert.success', 'Password reset link sent successfully');
        }

        $data = ['title' => 'Forgot Password'];

        return view('Auth::forgot-password', $data);
    }

    /** @return RedirectResponse|View */
    public function resetPassword(Request $request, string $token, ResetPasswordService $service)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required|confirmed'
            ]);

            try {
                $this->unit_of_work->transaction(fn() => $service->execute(
                    new ResetPasswordRequest(
                        $token,
                        $request->input('email'),
                        $request->input('password'),
                        $request->input('password_confirmation')
                    )
                ));
            } catch (Exception $e) {
                return redirect()->back()->withInput()->with('alert.error', $e->getMessage());
            }

            return redirect()->route('login')->with('alert.success', 'Password reset successfully');
        }

        $data = ['title' => 'Reset Password'];

        return view('Auth::reset-password', $data);
    }

    public function logout(LogoutService $service): RedirectResponse
    {
        $service->execute();

        return redirect()->route('login');
    }
}
