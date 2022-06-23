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
        Schema::create('matrix_risks', function (Blueprint $table) {
            $table->id();
            $table->integer('item');
            $table->foreignId('position_id')->constrained('positions');
            $table->foreignId('process_id')->constrained('processes');
            $table->foreignId('area_id')->constrained('areas');
            $table->foreignId('task_id')->constrained('tasks');
            $table->enum('clasification', ['RUTINARIO', 'NO RUTINARIO']);
            $table->foreignId('risk_id')->constrained('risks');
            $table->text('possible_effects')->nullable();
            $table->string('consequence')->nullable();
            $table->string('hours_exposition_day')->nullable();
            $table->boolean('exists_control')->default(0);
            $table->text('cotrol_descrption')->nullable();
            $table->enum('control_done', ['FUENTE', 'INDIVIDUE','MEDIO']);
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
        Schema::dropIfExists('matrix_risks');
    }
};
