<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->after('password');
            $table->string('avatar')->after('name');
            $table->integer('area_id')->after('avatar')->unsigned();
            $table->boolean('isActive')->after('area_id');
            $table->foreign('area_id')->references('id')->on('area')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            //$table->softDeletes();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('area_id');
            $table->dropColumn('isActve');
            $table->dropForeign(['user_id']);
            //$table->softDeletes();
            //$table->timestamps();
        });
    }
}
