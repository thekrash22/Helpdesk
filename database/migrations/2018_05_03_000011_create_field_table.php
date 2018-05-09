<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'field';

    /**
     * Run the migrations.
     * @table field
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('key', 45);
            $table->string('type', 45);
            $table->tinyInteger('required');
            $table->integer('name_form_id')->unsigned();
            
            $table->foreign('name_form_id')->references('id')->on('name_form')
                ->onUpdate('cascade')->onDelete('cascade');

            /*$table->foreign('name_form_id', 'fk_field_name_form1_idx')
                ->references('id')->on('name_form')
                ->onDelete('cascade')
                ->onUpdate('cascade');*/
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
