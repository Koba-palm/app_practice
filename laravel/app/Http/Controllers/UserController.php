<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() // index: 一覧を表示する関数としてよく使われる
    {
        $users = User::all(); // usersテーブルをモデルを介して全取得
        return view('users.index', compact('users'));
        /*  ① `compact('users')` で ['users' => $users] の形(配列)に変換
            ② `users.index.blade.php` に `['users' => $users]` が送られる
            ③  Blade テンプレートで `$users` が使えるようになる　　*/
    }
}
