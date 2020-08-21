<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password');
            $table->string('username');

            $table->rememberToken();

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }
}
