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
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif




<h1>ユーザー一覧</h1>

<a href="{{ route('users.create') }}">ユーザー登録画面へ</a>
<table>
    <tr>
        <th>ID</th>
        <th>名前</th>
        <th>メールアドレス</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>  {{-- <?php echo 中身; ?> をbladeでは{{ 中身 }}で書ける--}}
        <td><a href="{{ route('users.edit', ['id' => $user->id]) }}">{{ $user->name }} </a></td>
        <td>{{ $user->email }}</td>
        <td>
            <form action="{{ route('users.delete', ['id' => $user->id]) }}" method="post">
                @csrf
                @method('DELETE')  <!--HTMLではform内ではdelete methodは使用不可。form内でpost & form外でdelete指定 => Laravelがdelete methodに変換-->
                <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </td>




    </tr>
    @endforeach
</table>

</body>
</html>


{{-- $usersの中身はこんな感じ。
            [
                (object) ['id' => 1, 'name' => '山田 太郎', 'email' => 'taro@example.com'],
                (object) ['id' => 2, 'name' => '鈴木 次郎', 'email' => 'jiro@example.com'],
             ] --}}
