<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesHasQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_has_questions', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->index('fk_employees_has_questions_employees1_idx');
            $table->integer('question_id')->index('fk_employees_has_questions_questions1_idx');
            $table->string('response', 254)->nullable();
            $table->integer('response_id')->nullable()->index('fk_employees_has_questions_response1_idx');
            $table->softDeletes();
            $table->timestamps();

            $table->primary(['employee_id', 'question_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees_has_questions');
    }
}
