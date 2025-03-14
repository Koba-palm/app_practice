<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
ブラウザで http://127.0.0.1:8000/users にアクセス(Laravelにリクエストを送る)　【クライアント側】
    ⬇
①Route: routes/web.php の Route::get('/users', ...) に一致　　　　　　　　 【ここからサーバー側】
    ⬇
②Controller: UserController@index() が実行される
    ⬇
return view('users.index', compact('users')) により Blade ファイルへデータが送られる
    ⬇
③View: users.index.blade.php が実行され、HTMLが生成される　　　　　　　　　　　【ここまでサーバー側】
    ⬇
④ブラウザにHTMLが表示される。　　　　　　　　　　　　　　　　　　　　　　　　　　　 【クライアント側】

命名規則：user一覧表示では、/usersが用いられやすい。*/
/*
【MVCモデルの説明】Model, View, Controller
① 【ブラウザ】`http://127.0.0.1:8000/users` にアクセス
    ⬇
② 【Laravel】`routes/web.php` のルートをチェック
    ⬇
③ 【Controller】 `UserController@index()` を実行
    ⬇
④ 【Model】 `User::all()` でデータベースからデータ取得
    ⬇
⑤ 【Controller】`return view('users.index', compact('users'))` で View にデータを渡す
    ⬇
⑥ 【View】 `users.index.blade.php` が HTML に変換される
    ⬇
⑦ 【Controller】HTML をブラウザに返す
    ⬇
⑧ 【ブラウザ】ユーザー一覧ページが表示される
*/
Route::get('/users', [UserController::class, 'index'])->name('users.index');
