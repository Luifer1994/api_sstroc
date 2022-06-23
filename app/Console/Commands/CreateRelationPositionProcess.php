<?php

namespace App\Console\Commands;

use App\Models\Position;
use App\Models\PositionsProcess;
use App\Models\Process;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateRelationPositionProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-relation-position-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "Importing...";

        $positions = [
            [
                'position' => 'ANALISTA DE COSTOS',
                'process' => ['GESTIÓN ADMINISTRATIVA']
            ],
            [
                'position' => 'APRENDIZ SENA',
                'process'    => [
                    'GESTIÓN ADMINISTRATIVA',
                    'GESTIÓN DE FACTURACIÓN',
                    'GESTIÓN FINANCIERA',
                ]
            ],
            [
                'position' => 'ASISTENTE ADMINISTRATIVO',
                'process' => ['GESTIÓN COMERCIAL']
            ],
            [
                'position' => 'ASISTENTE CONTABLE',
                'process' => ['GESTIÓN FINANCIERA']
            ],
            [
                'position' => 'ASISTENTE DE CARTERA',
                'process' => [
                    'CARTERA',
                    'GESTIÓN ADMINISTRATIVA'
                ]
            ],
            [
                'position' => 'ASISTENTE DE TALENTO HUMANO',
                'process' => ['GESTIÓN DEL TALENTO HUMANO']
            ],
            [
                'position' => 'AUXILIAR ADMINISTRATIVA',
                'process' => ['CONSULTA EXTERNA', 'GESTIÓN ADMINISTRATIVA']
            ],
            [
                'position' => 'AUXILIAR ADMINISTRATIVA DE SIAU',
                'process' => [
                    'ATENCIÓN AL USUARIO',
                    'CONSULTA EXTERNA'
                ]
            ],
            [
                'position' => 'AUXILIAR ADMINISTRATIVO DE GESTION DE LA TECNOLOGIA',
                'process' => ['GESTION DE LA TECNOLOGIA']
            ],
            [
                'position' => 'AUXILIAR DE ADMISIONES',
                'process' => ['CONSULTA EXTERNA']
            ],
            [
                'position' => 'AUXILIAR DE ALTO COSTO',
                'process' => ['GESTIÓN ADMINISTRATIVA']
            ],
            [
                'position' => 'AUXILIAR DE ARCHIVO',
                'process' => ['SISTEMAS DE INFORMACION']
            ],
            [
                'position' => 'AUXILIAR DE AUTORIZACIONES',
                'process' => ['GESTIÓN DE FACTURACIÓN']
            ],
            [
                'position' => 'AUXILIAR DE CALL CENTER',
                'process' => ['CONSULTA EXTERNA']
            ],
            [
                'position' => 'AUXILIAR DE COMPRAS',
                'process' => ['GESTIÓN DE COMPRAS']
            ],

            [
                'position' => 'AUXILIAR DE CUENTA DE ALTO COSTO',
                'process' => ['GESTIÓN ADMINISTRATIVA']
            ],
            [
                'position' => 'AUXILIAR DE ENFERMERIA',
                'process' => [
                    'CONSULTA EXTERNA',
                    'QUIMIOTERAPIA',
                    'RADIOTERAPIA'
                ]
            ],
            [
                'position' => 'AUXILIAR DE FACTURACIÓN',
                'process' => ['GESTIÓN DE FACTURACIÓN']
            ],
            [
                'position' => 'AUXILIAR DE FARMACIA',
                'process' => ['SERVICIO FARMACEUTICO']
            ],
            [
                'position' => 'AUXILIAR DE MANTENIMIENTO',
                'process' => ['GESTION DE LA TECNOLOGIA']
            ],
            [
                'position' => 'AUXILIAR DE OFICIOS VARIOS',
                'process' => ['GESTION DE LA TECNOLOGIA']
            ],
            [
                'position' => 'AUXILIAR DE SERVICIOS GENERALES',
                'process' => ['GESTION DE LA TECNOLOGIA']
            ],
            [
                'position' => 'AUXILIAR DE SISTEMAS DE INFORMACION',
                'process' => ['SISTEMAS DE INFORMACION']
            ],
            [
                'position' => 'COMUNICADORA SOCIAL',
                'process' => ['GESTIÓN COMERCIAL']
            ],
            [
                'position' => 'COORD CUENTA DE ALTO COSTO',
                'process' => ['GESTIÓN ADMINISTRATIVA']
            ],
            [
                'position' => 'COORDINADOR DE SEGURIDAD Y SALUD EN EL TRABAJO',
                'process' => ['GESTIÓN DEL TALENTO HUMANO']
            ],
            [
                'position' => 'COORDINADORA DE CALL CENTER',
                'process' => ['CONSULTA EXTERNA']
            ],
            [
                'position' => 'COORDINADORA DE CUENTAS MEDICAS',
                'process' => ['GESTIÓN DE FACTURACIÓN']
            ],
            [
                'position' => 'COORDINADORA DE SEGURIDAD DEL PACIENTE',
                'process' => ['SEGURIDAD DEL PACIENTE']
            ],
            [
                'position' => 'DIRECTOR ADMINISTRATIVO Y FINANCIERO',
                'process' => ['GESTIÓN ADMINISTRATIVA']
            ],
            [
                'position' => 'DIRECTORA TECNICA DEL SERVICIO FARMACEUTICO',
                'process' => ['SERVICIO FARMACEUTICO']
            ],
            [
                'position' => 'ENFERMERA',
                'process' => ['GESTIÓN ADMINISTRATIVA']
            ],
            [
                'position' => 'ENFERMERA ADMINISTRATIVA',
                'process' => ['ATENCIÓN AL USUARIO', 'CONSULTA EXTERNA']
            ],
            [
                'position' => 'FISICO MEDICO',
                'process' => ['RADIOTERAPIA']
            ],
            [
                'position' => 'GERENTE',

                'process' => ['GERENTE']
            ],
            [
                'position' => 'GESTORA DE PROGRAMAS ESPECIALES',
                'process' => ['CONSULTA EXTERNA', 'GESTIÓN ADMINISTRATIVA']
            ],
            [
                'position' => 'JEFE DE PRODUCCION',
                'process' => ['SERVICIO FARMACEUTICO']
            ],
            [
                'position' => 'LIDER ADMINISTRATIVO',
                'process' => ['GESTIÓN DE FACTURACIÓN']
            ],
            [
                'position' => 'LIDER COMERCIAL',
                'process' => ['GESTIÓN COMERCIAL']
            ],
            [
                'position' => 'LIDER DE CONSULTA EXTERNA',
                'process' => ['CONSULTA EXTERNA']
            ],
            [
                'position' => 'LÍDER DE GESTIÓN DE COMPRAS',
                'process' => ['GESTIÓN DE COMPRAS']
            ],
            [
                'position' => 'LIDER DE GESTION DE LA CALIDAD',
                'process' => ['GESTIÓN DE CALIDAD']
            ],
            [
                'position' => 'LIDER DE GESTION DE LA TECNOLOGIA Y AMBIENTE FISICO',
                'process' => ['GESTION DE LA TECNOLOGIA']
            ],
            [
                'position' => 'LÍDER DE GESTIÓN DE TALENTO HUMANO',
                'process' => ['GESTIÓN DEL TALENTO HUMANO']
            ],
            [
                'position' => 'LIDER DE GESTION FINANCIERA',
                'process' => ['GESTIÓN FINANCIERA']
            ],
            [
                'position' => 'LIDER DE QUIMIOTERAPIA',
                'process' => ['QUIMIOTERAPIA']
            ],
            [
                'position' => 'LIDER DE RADIOTERAPIA',
                'process' => ['RADIOTERAPIA']
            ],
            [
                'position' => 'LIDER DE SISTEMAS DE INFORMACION',
                'process' => ['SISTEMAS DE INFORMACION']
            ],
            [
                'position' => 'MEDICO GENERAL',
                'process' => ['QUIMIOTERAPIA']
            ],
            [
                'position' => 'MENSAJERO',
                'process' => ['GERENTE']
            ],
            [
                'position' => 'OFICIAL DE PROTECCION RADIOLOGICA',
                'process' => ['RADIOTERAPIA']
            ],
            [
                'position' => 'QUIMICO FARMACEUTICO',
                'process' => ['CONSULTA EXTERNA']
            ],
            [
                'position' => 'REVISOR(A) DE CUENTAS MEDICAS',
                'process' => ['GESTIÓN DE FACTURACIÓN']
            ],
            [
                'position' => 'TECNOLOGO DE RADIOTERAPIA',
                'process' => ['RADIOTERAPIA']
            ],
            [
                'position' => 'TRABAJADORA SOCIAL',
                'process' => ['CONSULTA EXTERNA']
            ],
        ];

        foreach ($positions as $value) {
            $position = Position::where('name', '=', $value["position"])->first();
            if ($position) {
                foreach ($value["process"] as $item) {
                    $process = Process::where("name", '=', $item)->first();
                    if ($process) {
                        $positionProcess = PositionsProcess::where('position_id', $position->id)->where('process_id', $process->id)->first();
                        if (!$positionProcess) {
                            DB::table('positions_processes')->insert([
                                'position_id' => $position->id,
                                'process_id'  => $process->id
                            ]);
                        }
                    }

                }
            }
        }
       echo PHP_EOL. "!Success¡".PHP_EOL;
    }
}
