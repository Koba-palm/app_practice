<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;  //Factoryを使ってダミーデータを生成するときに使う
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'image_path',
    ]; //一括代入を許可

    public function user()
    {
        return $this->belongsTo(User::class); //userとpostを紐付ける。ポストは一人のユーザーに属する。
    }
    public function replies() // 1対多
    {
        return $this->hasMany(Reply::class);
    }
}
