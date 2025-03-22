<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>{{ Auth::user()->name }}のホーム</h1> <!--Auth::user()は現在ログインしているユーザーの情報をとって来てくれる-->

<h2>自分の情報</h2>
<table>
    <thead>
        <tr>
            <th>名前</th>
            <th>メールアドレス</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ Auth::user()->name }}</td>
            <td>{{ Auth::user()->email }}</td>
        </tr>
    </tbody>
</table>
<form action="{{ route('users.edit', Auth::user()->id) }}">
    <button>ユーザー情報を変更する</button>
</form>

<h2>自分の投稿一覧</h2>
@foreach(Auth::user()->posts as $post)  <!-- userはAuthのメソッドなので()が必要。postsはプロパティ -->
    <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
    <br>
@endforeach
<form action="{{ route('post.create') }}">
    <button type="submit">投稿を作成する</button>
</form>

<h2>つながり</h2>
<p>フォロー：{{ Auth::user()->followingUsers->count() }}</p>
<p>フォロワー：{{ Auth::user()->followedUsers->count() }}</p>
<form action="{{ route('follow.index') }}">
    <button type="submit">友達一覧</button>
</form>

<br>
<br>
<form action="{{ route('logout') }}">
    <button>ログアウト</button>
</form>
</body>
</html>
