<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('comments');
            $table->foreignId('post_id')->constrained();
            $table->foreignId('user_id')->constrained();

            $table->text('text');
            $table->boolean('is_root')->default(false);

            $table->timestamps();
        });
    }
}
