<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_relations', function (Blueprint $table) {
            $table->id('relation_id');
            $table->foreignId('following_id')->constrained('users')->onDelete('cascade'); //フォローする側のuser_id
            $table->foreignId('followed_id')->constrained('users')->onDelete('cascade');  //フォローされる側のuser_id
            $table->unique(['followed_id', 'following_id']);  //組み合わせが一意であると指定
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_relations');
    }
};
