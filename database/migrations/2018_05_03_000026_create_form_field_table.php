<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormFieldTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'form_field';

    /**
     * Run the migrations.
     * @table form_field
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('form_id')->unsigned();
            $table->integer('field_id')->unsigned();
            $table->text('data');

            //$table->index(["field_id"], 'fk_form_has_field_field1_idx');

            //$table->index(["form_id"], 'fk_form_has_field_form1_idx');


            $table->foreign('form_id')->references('id')->on('form')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('field_id')->references('id')->on('field')
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
