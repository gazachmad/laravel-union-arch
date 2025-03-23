<?php

namespace App\Modules\Auth\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Core\Application\Services\Login\LoginRequest;
use App\Modules\Auth\Core\Application\Services\Login\LoginService;
use App\Modules\Auth\Core\Application\Services\Logout\LogoutService;
use App\Modules\Auth\Core\Application\Services\Register\RegisterRequest;
use App\Modules\Auth\Core\Application\Services\Register\RegisterService;
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
                'username' => 'required',
                'password' => 'required'
            ]);

            try {
                $this->unit_of_work->transaction(fn() => $service->execute(
                    new LoginRequest(
                        $request->input('username'),
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
                'username' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed'
            ]);

            try {
                $this->unit_of_work->transaction(fn() => $service->execute(
                    new RegisterRequest(
                        $request->input('name'),
                        $request->input('username'),
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

    public function logout(LogoutService $service): RedirectResponse
    {
        $service->execute();

        return redirect()->route('login');
    }
}
