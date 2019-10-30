<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mobile_number', 20)->unique()->nullable(false);
            $table->string('first_name', 20)->nullable(false);
            $table->string('last_name', 20)->nullable(false);
            $table->date('date_of_birth', 10)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('email', 50)->unique()->nullable(false);
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
        Schema::dropIfExists('custom_users');
    }
}
