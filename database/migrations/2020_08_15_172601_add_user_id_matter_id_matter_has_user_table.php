<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdMatterIdMatterHasUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matter_has_user', function (Blueprint $table) {
            $table->integer('matter_id')->unsigned();
            $table->foreign('matter_id')
            ->references('id')->on('matters')
            ->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matter_has_user', function (Blueprint $table) {
            $table->dropForeign(['matter_id']);
            $table->dropColumn('matter_id');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
