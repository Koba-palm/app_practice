<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'body',
        'image_path',
    ];

    public function post() //一つのポストに属する。
    {
        return $this->belongsTo(Post::class);
    }

    public function user() //一人のユーザーに属する。
    {
        return $this->belongsTo(User::class);
    }
}
