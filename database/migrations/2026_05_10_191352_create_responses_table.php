<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('indicator', 4)->nullable();
            $table->string('text', 45)->nullable();
            $table->boolean('response_true')->nullable();
            $table->integer('question_id')->index('fk_response_questions1_idx');
            $table->integer('question_next_id')->nullable()->index('fk_response_questions2_idx');
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
        Schema::dropIfExists('responses');
    }
}
