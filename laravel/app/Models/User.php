<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
/* use Illuminate\Database\Eloquent\Model; */
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable /* ModelからAuthenticatabelにすることでパスワード認証、リメンバートークン、ログイン管理が可能に。 */
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ]; /* Userの登録情報を取り込む際、大量代入(Mass Assignment)エラーが起こるのを回避するために必要 */

    protected $hidden = [
        'password',
        'remember_token',
    ]; /* Eloquentのデータを取得する際、レスポンスに含めないためのコード。セキュリティ保持のため。 */
}
