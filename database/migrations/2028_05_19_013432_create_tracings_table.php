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
        Schema::create('tracings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('finding_id')->constrained('findings');
            $table->foreignId('user_id')->constrained('users');
            $table->string('description');
            $table->text('long_description')->nullable();
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
        Schema::dropIfExists('tracings');
    }
};
