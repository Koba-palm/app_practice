<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

    public function create()
    {
        // user登録フォームViewに流す。
        return view('users.create');
    }

    public function store(Request $request) // この引数は、Requestクラスのオブジェクト「$request」です、と明示している。LaravelのDependency Injectionの仕組みを使って静的でないプロパティを渡す設計になっている(多分)
    {
        // $requestをvalidateにかける
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6', //とりあえずrequiredは必須
        ]);

        // input(validationチェック済み)をmodelに渡し、データベースに保存してもらう。
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // user一覧へリダイレクト
        return redirect()->route('users.index');
    }

    public function edit($id)  //ルートパラメータでリクエストが発生した時,動的に取得されるため$idをそのまま使える。
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($id);  //Class::function 静的(static)メソッド
        $user->update([  // $instance->function 動的(instance)メソッド
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('users.index');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();  //削除メソッド

        return redirect()->route('users.index')->with('success', 'ユーザーを削除しました。');
    }

    public function follow(User $user) //フォローする相手ユーザーを引数で受け取る
    {
        if (Auth::id() == $user->id) {
            return back()->with('error', "自分はフォローできません。");
        }

        // 自分がまだこのユーザーをフォローしていなければフォローする
        if (!Auth::user()->followingUsers->contains($user->id)) { //現在ログインしているユーザーがフォローしているユーザーの一覧に引数のユーザーが含まれていなかったら、
            Auth::user()->followingUsers()->attach($user->id);
        }
        return back()->with('success', "{$user->name}さんをフォローしました！"); //back(): 元のページにリダイレクト。sessionにsuccessメッセージを保存
    }

    public function unfollow(User $user)
    {
        if (Auth::user()->followingUsers->contains($user->id)) { //followingUsers: データを「見る」。Laravelではメソッド(関数)をプロパティのように扱える(リレーションプロパティ)。自動で同じ名前のメソッドを検索して実行し、実データとして返してくれるため。
            Auth::user()->followingUsers()->detach($user->id);       //followingUsers(): データを「いじる」。user_relationsのクエリビルダー(DBを編集する権限的なもの)を渡す。
        }
        return back()->with('success', "{$user->name}さんのフォローを解除しました");
    }

    public function follow_index()
    {
        $followings = Auth::user()->followingUsers;
        $followers = Auth::user()->followedUsers;
        return view('follow.index', compact('followings', 'followers'));
    }
}
