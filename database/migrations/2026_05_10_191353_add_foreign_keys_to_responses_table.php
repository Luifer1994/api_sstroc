<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responses', function (Blueprint $table) {
            $table->foreign(['question_id'], 'fk_response_questions1')->references(['id'])->on('questions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['question_next_id'], 'fk_response_questions2')->references(['id'])->on('questions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responses', function (Blueprint $table) {
            $table->dropForeign('fk_response_questions1');
            $table->dropForeign('fk_response_questions2');
        });
    }
}
