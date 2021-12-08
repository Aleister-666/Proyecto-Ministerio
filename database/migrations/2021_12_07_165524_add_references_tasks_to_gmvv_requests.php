<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferencesTasksToGmvvRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gmvv_requests', function (Blueprint $table) {

            $table->unsignedBigInteger('type_task');
            $table->foreign('type_task')
                ->references('type')
                ->on('tasks')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gmvv_requests', function (Blueprint $table) {
            $table->dropForeign(['type_task']);
            $table->dropColumn('type_task');
        });
    }
}
