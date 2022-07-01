<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluate_matrices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matrix_risk_id')->constrained('matrix_risks')->unique();
            $table->integer('deficiency_level');
            $table->integer('exposition_level');
            $table->integer('probability_level')->comment('deficiency_level * exposition_level');
            $table->integer('consequence_level');
            $table->integer('risk_level')->comment('probability_level * consequence_level');
            $table->integer('number_exposed_plant');
            $table->integer('number_exposed_visitor');
            $table->integer('number_exposed_contrataing');
            $table->integer('total_exposed');
            $table->boolean('exist_legal_requirement')->default(false);
            $table->text('detail_legal_requirement')->nullable();
            $table->enum('exist_new_control',['SI', 'NO', 'NO APLICA']);
            $table->text('detail_control')->nullable();
            $table->string('control_type')->nullable();
            $table->date('date_programing_control')->nullable();
            $table->text('tracing')->nullable();
            $table->date('date_tracing')->nullable();
            $table->enum('state_compliance',['CERRADO', 'EN PROCESO', 'NO APLICA', 'NO INICIADO']);
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
        Schema::dropIfExists('evaluate_matrices');
    }
};
