<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('title', 145)->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('required')->default(true);
            $table->enum('category',['main','secundary']);
            $table->integer('survey_id')->index('fk_questions_surveys_idx');
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
        Schema::dropIfExists('questions');
    }
}
