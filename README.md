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
   ・modelに必要な条件を追加する(modelの役割、使い方がよく分からない🤷)  <br>
   (・Seederを作成：仮のデータを使いたい時に便利(DatabaseSeederに登録する, migrate --seedを忘れずに)) <br>
3. CRUDのR:Read ログイン画面の表示させたい <br>
   ・

      次始める手順：まずはgithubでPRを許可してmerge。その後pullしてlocal mainにmerge。その後databaseにもmergeってかdatabaseは削除して新しいbranch作ろうかな？次はログイン画面のCRUDだ！

<br>
<br>
!開発メモ!  <br>
・push前には必ずpull  <br>
・make appしてコンテナ内に入って実行するコマンドとコマンド外で実行するコマンドの違いが曖昧。  <br>
