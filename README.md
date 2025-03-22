# app_practice
Laravelを用いたwebアプリ開発の練習。git, githubを使う練習もする。

#開発の流れ
1. セットアップ <br>
   ・githubでリポジトリを作成し、ローカル環境にclone <br>
   ・empty-crud-temp-10からLaravelテンプレートを流用(cloneする) <br>
   ・形整えて一度pushしておく <br>
   ・make initでdocker起動 <br>
   <br>
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
   <br>
3. CRUDのR:Read ユーザー一覧を作ろう：データベースの動作確認ができる <br>
   ＝users テーブルのデータを取得して一覧表示するページ <br>
   <必要な要素>  <br>
      ・Model：usersテーブルと接続する。Controllerとdatabaseの橋渡し的存在。 →作成済み!  <br>
      ・Controlor：ユーザー一覧を取得する <br>
         - Modelからデータを取得  <br>
   　　　 - データを配列形式に変換し、Viewに送る  <br>
      ・Route：/usersにアクセスできるようにする   <br>
         - Getメソッドを使用：データを取得するメソッド(他にpost, put, deleteがある)  <br>
         - Get以下のコマンド：/usersにアクセスしたらUserController@indexが実行される  <br>
         - Routeに名前をつけておくと、route('名前')で呼び出せるようになる → viewでそのルートへのリンクを自動生成する際に使用。  <br>
      ・View(Blade)：usersのデータを一覧表示する   <br>
    　　　- Controllerでview(users.index)にしたため、users/index.blade.phpと命名する。 命名規則：view(フォルダ名.ファイル名)+blade.php   <br>
         - Controllerによって渡された$usersが使用可能。ここでは@foreach($users as $user)で一覧表示を行う    <br>
         - bladeでは、<?php echo 中身; ?> を{{ 中身 }}で書ける   <br>
   <br>
4. CRUDのC:Create ユーザー登録機能を作ろう  <br>
   =ブラウザからデータベースにデータ追加を行う機能   <br>
   <必要な要素>   <br>
   ・Model: 今回もusersを使用する。ユーザー登録に必要な情報(email, password)を追加する。 <br>
   ・Routeの設定：createとpostのルーティングを作成  <br>
      - /users/create にアクセスすると create() を実行し、登録フォームを表示(GET)  <br>
      - フォームを送信すると store() を実行し、ユーザーをデータベースに保存(POST)   <br>
   ・Controller：フォームを表示するcreate()と登録を処理するstore()を作成。　　<br>
      - create：フォーム登録Viewをreturnで返す　　<br>
      - store: Modelのcreateメソッドを使ってデータベースに$requestを保存。validationで入力チェック, redirectでユーザー一覧へ飛ばす。  <br>
   ・View：users/create.blade.php。ユーザー登録フォーム画面。  <br>
      - route('users.store')に渡す。method="post"忘れずに！(忘れたらデフォルト設定のgetに接続される=users.index=ユーザー登録はされずにただindex画面に遷移するだけの謎操作になっちゃうｶﾞﾋﾞｰﾝ)  <br>
  <br>
5. CRUDのU:Update ユーザー情報の更新機能を作ろう  <br>
   =ユーザーごとの更新ページからpostで上書きする。  <br>
   <必要な要素>  <br>
   ・Route: 編集画面を表示するルート, 更新内容を届けるルート <br>
      - /{id}で一意のユーザーを指定できる。  <br>
      - index.blade.phpにリンクを埋め込み、同時にidも指定すると楽。  <br>
   ・Controller: フォームを表示するedit()と更新内容をmodelに渡すupdate()  <br>
      - Routeから自動で$idを受け取ってくれる。  <br>
      - edit: $idで一人に絞ったデータを示す$userをviewに渡す。  <br>
      - update: $user->update([更新内容])  <br>
   ・View: ユーザー情報更新画面  <br>
   <br>
6. CRUDのD:Delete ユーザー削除機能を作ろう  <br>
   <必要な要素>   <br>
   ・View: Indexに削除ボタンを追加。押したらusers.delete, id, method=deleteでroutingされる  <br>
   ・Route: deleteメソッドを使用。{id}で一意のユーザー保持。Controller@deleteに渡す  <br>
   ・Controller: $idでユーザー絞る。deleteを実行。最後にIndexにリダイレクトしとこ。  <br>
7. ログイン機能を作ろう  <br>
   ・Route: get(ログイン画面), post(ログイン認証), get(logout),   <br>
   ・Controller: ログイン用のものを作る。show(ログイン画面viewへ)。login(requestをauthで検証)。logout(Auth::logout)。home(viewに渡す)  <br>
   ・View: ログイン画面, ログイン者専用ホーム画面を作成  <br>
8. post機能を作ろう  <br>
   ・Model & Migration: Userと1対多で結びつける(belongTo, hasMany)。migrationはforeignId('user_id')で外部のuser_idと結びつける。constrained()も。  <br>
   ・CRUD作成。createはmiddlewareつける。  <br>
9. 画像を投稿できるようにしよう  <br>
    ・showブレード(記事の詳細表示)を追加。editとmethodもurlもかぶるのでeditの方のurlを少し変える。  <br>
    ・migrationにstring('image_path)を追加。  <br>
       - make:migration [名前] --table=post で新しいmigrationファイルを作る。なぜ？▶︎既存のものを編集したらfreshしないと反映されない。freshしたら今あるデータが全部なくなる😭 <br>
    ・Postモデルのfillableにimage_pathを付け加える  <br>
    ・Controller: $imagePath = $request->file('image')->store('images', 'public');でpublicフォルダに画像を保存し、そのパスを取得。DBに渡すのは画像そのものではなく、パス！  <br>
    ※Laravelはデフォルトは1Mまでしかアップできない。色々試したけど解消できませんでした。  <br>
10. フォロー機能を搭載しよう  <br>
    ・migrationでuser_relationsを作成(外部キー2つを繋ぐ中間テーブル)。 <br>
    ・UserにbelongsToManyを二つ追加(多対多)。  <br>
       - return $this->belongsToMany(  //belongsToMany()は中間テーブルのある多対多のリレーションで使用。  <br>
            User::class,  //中間テーブルで繋がっている相手のクラス  <br>  
            'user_relationships',   //中間テーブル名を手動で指定する必要あり。  <br>
            'following_id', //呼び出し元モデルの外部キー = 自分 を指すカラムを指定  <br>
            'followed_id'); //関連モデルの外部キー = 相手  <br>
    ・CRUDを作成。  <br>
       - <新出>リレーションプロパティ  <br>
       - 自分をフォローできないようにcontrollerで制限をかける。  <br>
11. リプライ機能を追加しよう  <br>
   ・DB作成


      

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
【MVCモデルの説明: user index】Controllerがユーザー, Model, Viewを繋ぐ役割を担っている。  <br>
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
【users.createの流れ】  <br>
[ブラウザ] ユーザーが登録フォームに入力  <br>
    ⬇　　<br>
[ルーティング] `/users/create` にアクセス  <br>
    ⬇　　<br>
[Controller] UserController@create() → `users/create.blade.php` を表示  <br>
    ⬇　　<br>
[View] `users/create.blade.php` がブラウザに表示される  <br>
    ⬇　　<br>
[ブラウザ] ユーザーがフォームを送信 (`POST /users`)  <br>
    ⬇　　<br>
[ルーティング] `POST /users` → `UserController@store()` が実行  <br>
    ⬇　　<br>
[Controller] `store()` で `Request` を受け取る & バリデーションを実行  <br>
    ⬇　　<br>  
[Model] `User::create()` でデータベースに保存  <br>
    ⬇　　<br>
[Controller] `redirect()->route('users.index')`  <br>
    ⬇　　<br>
[ブラウザ] `/users` にリダイレクトしてユーザー一覧を表示  <br>
<br>
Auth::user()->posts でログイン中のユーザーのポストを取得できる。  <br>
🔹 プロパティ	オブジェクトが持ってる「値」	$user->name, $user->email  <br>
🔹 メソッド	オブジェクトに「させる動作」	$user->sendEmail(), $user->posts()  <br>
🔹 リレーション	モデル同士の「つながり」	$user->posts（User が持つ Post 一覧）  <br>
<br>
クエリビルダー：SQL文を、PHPのコード（オブジェクト指向）で書ける仕組み のこと。 e.g.)User::all()  <br>
$user->followingUsersだと、フォローしているユーザーの一覧を「取得」する。リレーションプロパティと呼ばれる(メソッドをプロパティの様に使用できる)。  <br>
$user->followingUsers()だと、フォローしているユーザーに関するテーブル(ここではuser_relations)のクエリビルダー(データベースを編集する権限みたいなもの)を渡すことになる。  <br>

