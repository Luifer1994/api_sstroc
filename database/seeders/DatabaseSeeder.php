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
    }
}
