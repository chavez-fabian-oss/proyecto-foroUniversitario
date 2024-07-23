<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubredditsTable extends Migration
{
    public function up()
    {
        Schema::create('subreddits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name')->unique();
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('subreddit_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subreddit_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subreddit_user');
        Schema::dropIfExists('subreddits');
    }
}
