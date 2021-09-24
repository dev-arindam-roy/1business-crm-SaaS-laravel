<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email_id')->unique();
            $table->string('mobile_number', 20)->unique();
            $table->string('password');
            $table->tinyInteger('is_owner')->default(0)->comment('0=No, 1=Yes');
            $table->tinyInteger('status')->default(0)->comment('0=Inactive, 1=Active, 2=Blocked, 3=Deleted');
            $table->text('email_verify_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('email_verify_token_expire_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
}
