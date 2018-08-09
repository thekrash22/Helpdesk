<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsAssignedUserTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tickets_assigned_users';

    /**
     * Run the migrations.
     * @table tickets_assigned_users
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('tickets_id')->unsigned();
            $table->integer('assigned_by_id')->unsigned();
            $table->integer('assigned_to_id')->unsigned();

            //$table->index(["assigned_to_id"], 'fk_tickets_assigned_users_users1_idx');

            //$table->index(["tickets_id"], 'fk_tickets_has_users_tickets1_idx');

            //$table->index(["assigned_by_id"], 'fk_tickets_has_users_users1_idx');


            $table->foreign('tickets_id')->references('id')->on('tickets')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('assigned_by_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('assigned_to_id')->references('id')->on('users')
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
