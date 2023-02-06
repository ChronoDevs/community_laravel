<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->nullable();
            $table->string('email', 100)->unique();
            $table->string('username', 100);
            $table->string('password', 100);
            $table->string('name', 100);
            $table->string('nick_name', 100)->nullable();
            $table->date('birth_date')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('zip_code', 8);
            $table->string('address', 100);
            $table->string('tel', 11);
            $table->string('job_title', 100);
            $table->string('profile_picture', 100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
