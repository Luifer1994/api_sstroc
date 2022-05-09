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
        Schema::create('perfil_sociodemographics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->foreignId('city_id')->constrained('cities');
            $table->string('address')->nullable();
            $table->foreignId('housing_type_id')->constrained('housing_types');
            $table->string('contact_emergency');
            $table->foreignId('kindred_id')->constrained('kindreds');
            $table->string('phone_contact',15);
            $table->foreignId('education_level_id')->constrained('education_levels');
            $table->integer('dependents');
            $table->integer('number_of_children');
            $table->string('use_free_time')->nullable();
            $table->foreignId('position_id')->constrained('positions');
            $table->foreignId('type_contract_id')->constrained('type_contracts');
            $table->date('contract_date');
            $table->float('average_income',15,2);
            $table->string('seniority_range',40);
            $table->foreignId('social_security_id')->constrained('social_securities');
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
        Schema::dropIfExists('perfil_sociodemographics');
    }
};
