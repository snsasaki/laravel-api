<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);

        //　ログイン時にapiトークンを作成
        $user = User::first();
        $user->api_token = bin2hex(random_bytes(40));
        $user->save();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('todos.index');
        }

        return back()
            ->withErrors([
                'email' => 'メールアドレスまたはパスワードが正しくありません',
            ])
            ->onlyInput();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login');
    }
}
