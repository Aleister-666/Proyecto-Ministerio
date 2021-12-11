<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNamesClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('names_clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->string('first_name', 50);
            $table->string('first_surname', 50);
            $table->string('second_name', 50)->nullable();
            $table->string('second_surname', 50)->nullable();

            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');

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
        Schema::dropIfExists('names_clients');
    }
}
