<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('from_id');
            $table->foreign('from_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedInteger('to_id');
            $table->foreign('to_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->boolean('are_friends')->default(0);
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
        Schema::dropIfExists('friends');
    }
}
