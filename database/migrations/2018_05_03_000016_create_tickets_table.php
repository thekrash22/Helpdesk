<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tickets';

    /**
     * Run the migrations.
     * @table tickets
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('settled', 45)->unique();
            $table->text('description')->nullable();
            $table->integer('folios')->nullable();
            $table->integer('priority_id')->unsigned()->nullable();
            $table->integer('status_id')->unsigned();
            $table->integer('person_id')->unsigned();
            $table->integer('linked_tikcket_id')->unsigned();
            $table->date('expiration');
            
           // $table->integer('days')->default('15');

            //$table->index(["priority_id"], 'fk_tickets_priority1_idx');

            //$table->index(["person_id"], 'fk_tickets_person1_idx');

            //$table->index(["status_id"], 'fk_tickets_status1_idx');

            //$table->unique(["settled"], 'settled_UNIQUE');


            $table->foreign('priority_id')->references('id')->on('priority')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('status_id')->references('id')->on('status')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('person_id')->references('id')->on('person')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('linked_tikcket_id')->references('id')->on('tickets')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
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
