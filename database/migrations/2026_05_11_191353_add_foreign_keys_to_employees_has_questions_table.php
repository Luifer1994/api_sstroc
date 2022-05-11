<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEmployeesHasQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees_has_questions', function (Blueprint $table) {
            $table->foreign(['employee_id'], 'fk_employees_has_questions_employees1')->references(['id'])->on('employees')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['question_id'], 'fk_employees_has_questions_questions1')->references(['id'])->on('questions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['response_id'], 'fk_employees_has_questions_response1')->references(['id'])->on('responses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees_has_questions', function (Blueprint $table) {
            $table->dropForeign('fk_employees_has_questions_employees1');
            $table->dropForeign('fk_employees_has_questions_questions1');
            $table->dropForeign('fk_employees_has_questions_response1');
        });
    }
}
