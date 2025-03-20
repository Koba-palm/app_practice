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
<h1>投稿一覧</h1>

<form action="{{ route('post.create') }}">
    @csrf
    <button type="submit">投稿を作成する</button>
</form>

<form action="{{ route('login.home') }}">
    @csrf
    <button type="submit">ログイン/マイホームへ</button>
</form>

<table>
    <thead>
        <tr>
            <th>タイトル</th>
            <th>本文</th>
            <th>投稿者</th>
        </tr>
    </thead>
    @foreach($posts as $post)
    <tbody>
        <tr>
            <td>
                <a href="{{ route('post.show', $post->id) }}">{{$post->title}}</a>
            </td>
            <td>{{$post->user->name}}</td>
            @if (Auth::id() == $post->user_id)
            <td>
                <form action="{{ route('post.edit', $post->id) }}">
                    <button type="submit">更新</button>
                </form>
            </td>
            <td>
                <form action="{{ route('post.edit', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            </td>
            @endif
        </tr>
    </tbody>
    @endforeach
</table>

</body>
</html>
