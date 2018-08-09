<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsSubjectTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tickets_subject';

    /**
     * Run the migrations.
     * @table tickets_subject
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
            Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('tickets_id')->unsigned();
            $table->integer('subject_id')->unsigned();

            //$table->index(["subject_id"], 'fk_tickets_has_subject_subject1_idx');

            ///$table->index(["tickets_id"], 'fk_tickets_has_subject_tickets1_idx');


            $table->foreign('tickets_id')->references('id')->on('tickets')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('subject_id')->references('id')->on('subject')
                ->onDelete('no action')
                ->onUpdate('no action');
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
