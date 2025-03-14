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
<h1>ユーザー一覧</h1>

<table>
    <tr>
        <th>ID</th>
        <th>名前</th>
        <th>メールアドレス</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>  {{-- <?php echo 中身; ?> をbladeでは{{ 中身 }}で書ける--}}
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        {{-- $usersの中身はこんな感じ。
            [
                (object) ['id' => 1, 'name' => '山田 太郎', 'email' => 'taro@example.com'],
                (object) ['id' => 2, 'name' => '鈴木 次郎', 'email' => 'jiro@example.com'],
             ] --}}
    </tr>
    @endforeach
</table>

</body>
</html>
