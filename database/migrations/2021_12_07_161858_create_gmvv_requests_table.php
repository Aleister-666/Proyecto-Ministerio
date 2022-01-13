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
            $table->string('copy_ci', null)->nullable();
            $table->string('contancy_job', null)->nullable();
            $table->string('contancy_home', null)->nullable();
            $table->string('contancy_civil', null)->nullable();
            $table->string('birth_certificate_children', null)->nullable();
            $table->string('sworn_declaration', null)->nullable();
            $table->string('registration_form_gmvv', null)->nullable();
            $table->string('explanatory_statement', null)->nullable();

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
