<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Arl;
use App\Models\City;
use App\Models\Country;
use App\Models\EducationLevel;
use App\Models\Gender;
use App\Models\HousingType;
use App\Models\Kindred;
use App\Models\MaritalStatus;
use App\Models\PensionFund;
use App\Models\Position;
use App\Models\RiskType;
use App\Models\SocialSecurity;
use App\Models\TypeContract;
use App\Models\TypeDocument;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = ["Coordinado", "Axiliar", "Lider", "Proveedor"];
        foreach ($roles as $rol) {
            DB::table('rols')->insert([
                "name" => $rol
            ]);
        }
        TypeDocument::factory(3)->create();
        Gender::factory(2)->create();
        Country::factory(1)->create();
        City::factory(3)->create();
        EducationLevel::factory(3)->create();
        MaritalStatus::factory(3)->create();
        RiskType::factory(3)->create();
        Position::factory(3)->create();
        Area::factory(3)->create();
        HousingType::factory(3)->create();
        Kindred::factory(4)->create();
        SocialSecurity::factory(3)->create();
        TypeContract::factory(3)->create();
        Arl::factory(2)->create();
        PensionFund::factory(3)->create();
        User::factory(1)->create();

        DB::table('surveys')->insert([
            "id" => 1,
            "title" => "Consumos del empleado"
        ]);

        DB::table('questions')->insert([
            "id" => 1,
            "title" => "¿ha sido diagnosticado con alguna enfermedad?",
            "order" => 1,
            "required" => true,
            "category" => "main",
            "survey_id" => 1,
        ]);

        DB::table('questions')->insert([
            "id" => 2,
            "title" => "¿Cual?",
            "order" => 2,
            "required" => false,
            "category" => "secundary",
            "survey_id" => 1,
        ]);

        DB::table('responses')->insert([
            "id" => 1,
            "indicator" => "a",
            "text" => "SI",
            "response_true" => false,
            "question_id" => 1,
            "question_next_id" => 2,
        ]);

        DB::table('responses')->insert([
            "id" => 2,
            "indicator" => "b",
            "text" => "NO",
            "response_true" => false,
            "question_id" => 1,
            "question_next_id" => NULL,
        ]);

        DB::table('questions')->insert([
            "id" => 3,
            "title" => "¿Fumas?",
            "order" => 3,
            "required" => true,
            "category" => "main",
            "survey_id" => 1,
        ]);

        DB::table('questions')->insert([
            "id" => 4,
            "title" => "Promedio diario",
            "order" => 4,
            "required" => false,
            "category" => "secundary",
            "survey_id" => 1,
        ]);

        DB::table('responses')->insert([
            "id" => 3,
            "indicator" => "a",
            "text" => "SI",
            "response_true" => false,
            "question_id" => 3,
            "question_next_id" => 4,
        ]);

        DB::table('responses')->insert([
            "id" => 4,
            "indicator" => "b",
            "text" => "NO",
            "response_true" => false,
            "question_id" => 3,
            "question_next_id" => NULL,
        ]);


        DB::table('questions')->insert([
            "id" => 5,
            "title" => "consumo de bebidas alcohólicas",
            "order" => 5,
            "required" => true,
            "category" => "main",
            "survey_id" => 1,
        ]);

        DB::table('responses')->insert([
            "id" => 5,
            "indicator" => "a",
            "text" => "SI",
            "response_true" => false,
            "question_id" => 5,
            "question_next_id" => NULL,
        ]);

        DB::table('responses')->insert([
            "id" => 6,
            "indicator" => "b",
            "text" => "NO",
            "response_true" => false,
            "question_id" => 5,
            "question_next_id" => NULL,
        ]);

        DB::table('questions')->insert([
            "id" => 6,
            "title" => "consumo de sustancia psicoactivas",
            "order" => 6,
            "required" => true,
            "category" => "main",
            "survey_id" => 1,
        ]);

        DB::table('responses')->insert([
            "id" => 7,
            "indicator" => "a",
            "text" => "SI",
            "response_true" => false,
            "question_id" => 6,
            "question_next_id" => NULL,
        ]);

        DB::table('responses')->insert([
            "id" => 8,
            "indicator" => "b",
            "text" => "NO",
            "response_true" => false,
            "question_id" => 6,
            "question_next_id" => NULL,
        ]);


        DB::table('questions')->insert([
            "id" => 7,
            "title" => "medicamentos de control especial",
            "order" => 8,
            "required" => true,
            "category" => "main",
            "survey_id" => 1,
        ]);

        DB::table('questions')->insert([
            "id" => 8,
            "title" => "¿Cual?",
            "order" => 9,
            "required" => false,
            "category" => "secundary",
            "survey_id" => 1,
        ]);

                DB::table('responses')->insert([
                    "id" => 9,
                    "indicator" => "a",
                    "text" => "SI",
                    "response_true" => false,
                    "question_id" => 7,
                    "question_next_id" => 8,
                ]);

                DB::table('responses')->insert([
                    "id" => 10,
                    "indicator" => "b",
                    "text" => "NO",
                    "response_true" => false,
                    "question_id" => 7,
                    "question_next_id" => NULL,
                ]);

        DB::table('questions')->insert([
            "id" => 9,
            "title" => "¿Con que frecuancia practica deporte?",
            "order" => 10,
            "required" => true,
            "category" => "main",
            "survey_id" => 1,
        ]);
    }
}
