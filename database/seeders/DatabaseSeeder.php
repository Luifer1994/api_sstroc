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

        $positions = [
            'LIDER COMERCIAL',
            'LIDER DE CONSULTA EXTERNA',
            'LÍDER DE GESTIÓN DE COMPRAS',
            'LIDER DE GESTIÓN DE LA CALIDAD',
            'LIDER DE GESTIÓN DE LA TECNOLOGÍA Y AMBIENTE FÍSICO',
            'LÍDER DE GESTIÓN DE TALENTO HUMANO',
            'LIDER DE GESTIÓN FINANCIERA',
            'LIDER DE QUIMIOTERAPIA',
            'LIDER DE RADIOTERAPIA',
            'LIDER DE SISTEMAS DE INFORMACIÓN',
            'MEDICO GENERAL',
            'MENSAJERO',
            'OFICIAL DE PROTECCIÓN RADIOLOGICA',
            'ORIENTADORA',
            'QUIMICO FARMACEUTICO',
            'REVISOR(A) DE CUENTAS MEDICAS',
            'TECNOLOGO DE RADIOTERAPIA',
            'TRABAJADORA SOCIAL'

        ];
        foreach ($positions as $position) {
            DB::table('positions')->insert([
                'name' => $position
            ]);
        }

        $riskTypes = [
            [
                'name' => 'FÍSICOS',
                'description' => 'Se clasifican aquí los factores ambientales de naturaleza física, que cuando entran en contacto con las personas pueden tener efectos nocivos sobre su salud dependiendo de su intensidad y exposición.',
                'risks' => [
                    'Ruido (impacto intermitente y continuo)',
                    'Iluminación (Luz visible por exceso o deficiencia)',
                    'Vibración (Cuerpo entero, segmentaria)',
                    'Temperaturas extremas (Calor y frío)',
                    'Presión atmosférica',
                    'Radiaciones ionizantes (Rayos X, gama, beta y alfa)',
                    'Radiaciones no ionizantes (laser, ultravioleta infrarroja)'
                ]
            ],
            [
                'name' => 'BIOMECÁNICOS',
                'description' => 'Son todos aquellos objetos, puestos de trabajo y herramientas, que por el peso, tamaño, forma o diseño encierran la capacidad potencial de producir fatiga física o lesiones osteomusculares, por obligar al trabajador a realizar sobreesfuerzos, movimientos repetitivos y posturas inadecuadas.',
                'risks' => [
                    'Postura (Prolongada mantenida, forzada, anti gravitacionales)',
                    'Esfuerzo',
                    'Movimiento repetitivo',
                    'Manipulación manual de cargas'
                ]
            ],
            [
                'name' => 'BIOLOGICOS',
                'description' => 'Están constituidos por un conjunto de microorganismos, toxinas, secreciones biológicas, tejidos y órganos corporales humanos, animales y vegetales, presentes en determinados ambientes laborales, que al entrar en contacto con el organismo pueden desencadenar enfermedades infectocontagiosas, reacciones alérgicas o intoxicaciones.',
                'risks' => [
                    'Virus',
                    'Bacterias',
                    'Hongos',
                    'Parasitos',
                    'Picaduras',
                    'Fluidos o excrementos',
                ]
            ],
            [
                'name' => 'QUÍMICOS',
                'description' => 'Se refiere a aquellos elementos sustancias orgánicas o inorgánicas que pueden ingresar al organismo por inhalación, absorción o ingestión y dependiendo de su nivel de concentración y el tiempo de exposición pueden generar lesiones sintéticas, intoxicaciones o quemaduras. De acuerdo con sus efectos en el organismo pueden ser irritantes, asfixiantes, anestésicos y narcóticos, tóxicos sintéticos, productores de Neumoconiosis, productores de alergias y cancerígenos.',
                'risks' => [
                    'Polvos orgánicos inorgánicos',
                    'Fibras',
                    'Líquidos (nieblas y rocíos)',
                    'Gases y vapores',
                    'Humos metálicos, no metálicos',
                    'Material particulado',
                ]
            ],
            [
                'name' => 'PSICOSOCIAL',
                'description' => 'son las condiciones presentes en una situación laboral directamente relacionadas con la organización del trabajo, con el contenido del puesto, con la realización de la tarea o incluso con el entorno, que tienen la capacidad de afectar al desarrollo del trabajo y a la salud de las personas trabajadoras.',
                'risks' => [
                    'Gestión organizacional (estilo de mando, pago, contratación, participación, inducción y capacitación, bienestar social, evaluación del desempeño, manejo de cambios)',
                    'Características de la organización del trabajo (Comunicación, tecnología, organización del trabajo, demandas cualitativas y cuantitativas de la labor)',
                    'Características del grupo social del trabajo (relaciones, cohesión, calidad de interacciones, trabajo en equipo)',
                    'Condiciones de la tarea (carga mental, contenido de la tarea, demandas emocionales, sistemas de control, definición de roles, monotonía, etc.).',
                    'Interfase persona tarea (conocimientos, habilidades con relación a la demanda de la tarea, iniciativa, autonomía y reconocimiento, identificación de la persona con la tarea y la organización)',
                    'Jornada de trabajo (pausas, trabajo nocturno, rotación, horas extras, descansos)',
                ]
            ],
            [
                'name' => 'MECANICO',
                'description' => '',
                'risks' => [
                    'Elementos de maquinas',
                    'Herramientas',
                    'Piezas a trabajar',
                    'Materiales proyectados solidos o fluidos'
                ]
            ],
            [
                'name' => 'ELÉCTRICO',
                'description' => '',
                'risks' => [
                    'Alta tensión',
                    'Baja tensión'
                ]
            ],
            [
                'name' => 'LOCATIVO',
                'description' => '',
                'risks' => [
                    'Almacenamiento',
                    'Superficie de trabajo irregulares',
                    'Superficie de trabajo deslizantes',
                    'Superficie de trabajo con diferencia de nivel',
                    'Condiciones de orden y aseo',
                    'Caídas de objetos'
                ]
            ],
            [
                'name' => 'TECNOLÓGICO',
                'description' => 'Abarca todos aquellos objetos, materiales combustibles, sustancias químicas y fuentes de calor que bajo ciertas condiciones de inflamabilidad o combustibilidad pueden desencadenar incendios y explosiones',
                'risks' => [
                    'Explosión',
                    'Fuga',
                    'Derrame',
                    'Incendio'
                ]
            ],
            [
                'name' => 'PUBLICO',
                'description' => '',
                'risks' => [
                    'Robos, atracos, asaltos',
                    'Atentados',
                    'Desorden publico',
                    'ACCIDENTES DE TRANSITO',
                    'TRABAJO EN ALTURAS',
                    'ESPACIOS CONFINADOS'
                ]
            ],
            [
                'name' => 'FENÓMENOS NATURALES',
                'description' => 'Son todos aquellas condiciones de la naturaleza y/o medio ambientales, que por sus características propias, tienen el potencial de causar incidentes, accidentes de trabajo o situaciones de emergencia',
                'risks' => [
                    'Sismo',
                    'Terremoto',
                    'Vendaval',
                    'Inundación',
                    'Derrumbe',
                    'Precipitaciones (Lluvias, granizadas)'
                ]
            ],

        ];

        $num = 1;
        foreach ($riskTypes as $riskType) {
            DB::table('risk_types')->insert([
                'name' => $riskType["name"],
                'description' => $riskType["description"],
            ]);
            foreach ($riskType["risks"] as $value) {
                DB::table('risks')->insert([
                    'risks_type_id' => $num,
                    'name' => $value,
                ]);
            }
            $num++;
        }

        TypeDocument::factory(3)->create();
        Gender::factory(2)->create();
        Country::factory(1)->create();
        City::factory(3)->create();
        EducationLevel::factory(3)->create();
        MaritalStatus::factory(3)->create();
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
            "title" => "¿Ha sido diagnosticado con alguna enfermedad?",
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
            "title" => "¿Consumes bebidas alcohólicas?",
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
            "title" => "¿Consumes sustancia psicoactivas?",
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
            "title" => "¿Consumes medicamentos de control especial?",
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
