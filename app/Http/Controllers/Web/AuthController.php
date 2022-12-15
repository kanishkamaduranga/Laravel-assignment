<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
//use Session;

class AuthController extends Controller
{
    /**
     * show admin user login page
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (Auth::check()){
            return redirect()->intended('/');
        } else {
            return view('auth.login');
        }
    }

    /**
     * Authentication request handling , after successful login redirect to dashboard
     *
     * @param LoginRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function login(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withErrors('Login details are not valid');

    }

    /**
     * Flush admin user session .
     * Logout dashboard user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('/login');
    }
}
