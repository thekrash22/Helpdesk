<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'notifications';

    /**
     * Run the migrations.
     * @table notifications
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('sender_users_id')->unsigned()->nullable();
            $table->integer('tickets_id')->unsigned();
            $table->integer('received_users_id')->unsigned();
            $table->string('message');
            $table->integer('area_sender_id')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->integer('action_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->tinyInteger('read');


            $table->foreign('sender_users_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('tickets_id')->references('id')->on('tickets')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('received_users_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('area_sender_id')->references('id')->on('area')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('area_id')->references('id')->on('area')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('action_id')->references('id')->on('action')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('type_id')->references('id')->on('type')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->softDeletes();
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
       Schema::dropIfExists($this->set_schema_table);
     }
}
