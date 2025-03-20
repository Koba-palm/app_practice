<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('login.show');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Auth: Laravel の認証機能を管理するファサード。
        if (Auth::attempt($credentials)) { // 認証成功なら通す
            $request->session()->regenerate(); //セッションを再生成(セッション固定攻撃を防ぐため)
            return redirect()->route('login.home'); //🚨マイページに遷移。あとで作る
        }
        return back()->withErrors([ //認証失敗ならエラーを返す
            'email' => 'ログイン情報が正しくありません。',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout(); //認証情報を破棄
        $request->session()->invalidate(); //セッションを無効化
        $request->session()->regenerateToken(); //CSRFトークンを再生成(セキュリティ対策)
        return redirect()->route('login');
    }

    public function home()
    {
        return view('login.home');
    }
}
