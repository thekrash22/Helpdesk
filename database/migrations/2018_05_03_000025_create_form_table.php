<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'form';

    /**
     * Run the migrations.
     * @table form
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('thread_id')->unsigned();
            $table->integer('name_form_id')->unsigned();

            //$table->index(["name_form_id"], 'fk_form_name_form1_idx');

            //$table->index(["thread_id"], 'fk_form_thread1_idx');

            //$table->index(["area_id"], 'fk_form_area1_idx');


            $table->foreign('thread_id')->references('id')->on('thread')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('name_form_id')->references('id')->on('name_form')
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
