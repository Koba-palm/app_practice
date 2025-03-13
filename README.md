# app_practice
Laravelを用いたwebアプリ開発の練習。git, githubを使う練習もする。

#開発の流れ
1. セットアップ
   ・githubでリポジトリを作成し、ローカル環境にclone
   ・empty-crud-temp-10からLaravelテンプレートを流用(cloneする)
   ・形整えて一度pushしておく
   ・make initでdocker起動
2. データベース
   ・modelを作成：データベースの中にどんなデータを書き込むのか決める係
   ・migrationを作成：データベースの枠組み(変数名など)の設計図をMySQLに依頼する係
     <命名規則>
       ・日付_create_モデル名(小文字)s_tableにする。
       ・なお、php artisan make:model モデル名 -m でモデルと新しいmigrationを自動で作ってくれる。
   ・右上データベース→＋→データソース→MySQLで設定を行う。
     Host：
     Port：
     User：
     Passqord：
     Database：
   ・Seeder


!開発メモ!
・push前には必ずpull
・make appしてコンテナ内に入って実行するコマンドとコマンド外で実行するコマンドの違いが曖昧。
