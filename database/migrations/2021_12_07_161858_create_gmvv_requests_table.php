<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGmvvRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gmvv_requests', function (Blueprint $table) {
            $table->id();
            $table->string('copy_ci');
            $table->string('contancy_job');
            $table->string('contancy_home');
            $table->string('contancy_civil');
            $table->string('birth_certificate_children');
            $table->string('sworn_declaration');
            $table->string('registration_form_gmvv');
            $table->string('explanatory_statement');

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
        Schema::dropIfExists('gmvv_requests');
    }
}
