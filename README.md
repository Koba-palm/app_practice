# app_practice
Laravelを用いたwebアプリ開発の練習。git, githubを使う練習もする。

#開発の流れ
1. セットアップ <br>
   ・githubでリポジトリを作成し、ローカル環境にclone <br>
   ・empty-crud-temp-10からLaravelテンプレートを流用(cloneする) <br>
   ・形整えて一度pushしておく <br>
   ・make initでdocker起動 <br>
   
2. データベースその1(Users)　まずはログイン機能を作ろっと <br>
   ・modelを作成：データベースの中にどんなデータを書き込むのか決める係 <br>
   ・migrationを作成：データベースの枠組み(変数名など)の設計図をMySQLに依頼する係 <br>
     <命名規則> <br>
       ・日付_create_モデル名(小文字)s_tableにする。 <br>
       ・なお、php artisan make:model モデル名 -m でモデルと新しいmigrationを自動で作ってくれる。<br>
   ・右上データベース→＋→データソース→MySQLで設定を行う。<br>
     Host：127.0.0.1 (localhost。とりあえずMySQLではこれを使おう) <br>
     Port：43306 (.envには3306とあるが、このテンプレではdocker-compose.ymlの「ports:- 43306:3306」を理由に(多分)43306に。) <br>
     User：laravel  <br>
     Passqord：laravel  <br>
     Database：laravel  <br>
     (envファイル参照。ただこのテンプレだと上記のようになる。よく分かんない🤷) <br>
   ・migrationに必要な変数を追加する。(migrate, fresh, refresh忘れずに！)   <br>
   ・modelに必要な条件を追加する  <br>
   (・Seederを作成：仮のデータを使いたい時に便利(DatabaseSeederに登録する, migrate --seedを忘れずに)) <br>
   
3. CRUDのR:Read ユーザー一覧を作ろう：データベースの動作確認ができる <br>
   ＝users テーブルのデータを取得して一覧表示するページ <br>
   <必要な要素>
      ・Model：usersテーブルと接続する。Controllerとdatabaseの橋渡し的存在。 →作成済み!  <br>
      ・Controlor：ユーザー一覧を取得する <br>
         - Modelからデータを取得
   　　　 - データを配列形式に変換し、Viewに送る
      ・Route：/usersにアクセスできるようにする   <br>
         - Getメソッドを使用：データを取得するメソッド(他にpost, put, deleteがある)
         - Get以下のコマンド：/usersにアクセスしたらUserController@indexが実行される
         - Routeに名前をつけておくと、route('名前')で呼び出せるようになる → viewでそのルートへのリンクを自動生成する際に使用。
      ・View(Blade)：usersのデータを一覧表示する   <br>
    　　　- Controllerでview(users.index)にしたため、users/index.blade.phpと命名する。 命名規則：view(フォルダ名.ファイル名)+blade.php
         - Controllerによって渡された$usersが使用可能。ここでは@foreach($users as $user)で一覧表示を行う
         - bladeでは、<?php echo 中身; ?> を{{ 中身 }}で書ける

4. CRUDのC:Create ユーザー登録機能を作ろう  <br>
   =ブラウザからデータベースにデータ追加を行う機能
   <必要な要素>


      

<br>
<br>
⭐︎開発メモ⭐︎  <br>
・push前には必ずpull  <br>
・make appしてコンテナ内に入って実行するコマンドとコマンド外で実行するコマンドの違いが曖昧。  <br>
<br>
【CRUDのRの流れ】 <br>
   ブラウザで http://127.0.0.1:8000/users にアクセス(Laravelにリクエストを送る)　【クライアント側】<br>
    ⬇<br>
   ①Route: routes/web.php の Route::get('/users', ...) に一致　　　　　　　　 【ここからサーバー側】<br>
    ⬇<br>
   ②Controller: UserController@index() が実行される<br>
    ⬇<br>
   return view('users.index', compact('users')) により Blade ファイルへデータが送られる<br>
    ⬇<br>
   ③View: users.index.blade.php が実行され、HTMLが生成される　　　　　　　　　　　【ここまでサーバー側】<br>
    ⬇<br>
   ④ブラウザにHTMLが表示される。　　　　　　　　　　　　　　　　　　　　　　　　　　　 【クライアント側】<br>
   <br>
【MVCモデルの説明】Controllerがユーザー, Model, Viewを繋ぐ役割を担っている。  <br>
   ① 【ブラウザ】`http://127.0.0.1:8000/users` にアクセス　　<br>
       ⬇　　<br>
   ② 【Laravel】`routes/web.php` のルートをチェック　　<br>
       ⬇　　<br>
   ③ 【Controller】 `UserController@index()` を実行　　<br>
       ⬇　　<br>
   ④ 【Model】 `User::all()` でデータベースからデータ取得　　<br>
       ⬇　　<br>
   ⑤ 【Controller】`return view('users.index', compact('users'))` で View にデータを渡す　　<br>
       ⬇　　<br>
   ⑥ 【View】 `users.index.blade.php` が HTML に変換される　　<br>
       ⬇　　<br>
   ⑦ 【Controller】HTML をブラウザに返す　　<br>
       ⬇　　<br>
   ⑧ 【ブラウザ】ユーザー一覧ページが表示される　　<br>
<br>

