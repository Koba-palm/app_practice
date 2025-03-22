<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;

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
// Read: ユーザー一覧
Route::get('/users', [UserController::class, 'index'])->name('users.index'); //usersにアクセスしたら,UserController@indexが実行される
// Create: ユーザー登録
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Update: ユーザー情報更新
Route::middleware('auth')->group(function () {
    Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');
});
Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
// Delete: ユーザー削除
Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');

// Login機能
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/login/home', [LoginController::class, 'home'])->name('login.home');
});

// Post機能
Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::middleware('auth')->group(function () {
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
});
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::post('/post/{id}', [PostController::class, 'update'])->name('post.update');
Route::delete('/post/{id}', [PostController::class, 'delete'])->name('post.delete');

// Post機能：詳細表示。画像表示機能。
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

// フォロー機能
Route::middleware('auth')->group(function () {
    Route::get('/follow', [UserController::class, 'follow_index'])->name('follow.index');
    Route::post('/follow/{user}', [UserController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{user}', [UserController::class, 'unfollow'])->name('unfollow');
});
