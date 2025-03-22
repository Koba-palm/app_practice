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

    public function posts()
    {
        return $this->hasMany(Post::class);  //postと紐付け。1対多
    }

    public function followingUsers() //自分(フォローする側)がどのユーザーをフォローしているか
    {
        return $this->belongsToMany(  //belongsToMany()は中間テーブルのある多対多のリレーションで使用。
            User::class,  //中間テーブルで繋がっている相手のクラス
            'user_relations',   //中間テーブル名を手動で指定する必要あり。
            'following_id', //呼び出し元モデルの外部キー = 自分 を指すカラムを指定
            'followed_id'); //関連モデルの外部キー = 相手
    }

    public function followedUsers()  //自分が(フォローされる側)がどのユーザーにフォローされているか
    {
        return $this->belongsToMany(
            User::class,
            'user_relations',
            'followed_id',  //今回は、自分 = フォローされる側
            'following_id'  //相手はフォローする側
        );
    }
}
