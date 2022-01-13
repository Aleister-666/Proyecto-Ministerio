<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferencesClientsUsersToDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('client_id')
                ->nullable()
                ->constrained('clients')
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
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropColumn('user_id');

            $table->dropForeign('client_id');
            $table->dropColumn('client_id');
        });
    }
}
