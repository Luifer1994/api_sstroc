<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $users = User::select(
            'users.*',
            'employees.name',
            'employees.last_name',
            'employees.document_number',
            'employees.phone',
            'type_documents.name as document_type',
            'genders.name as gender',
            'rols.name as rol',
        )->where('employees.name', 'like', '%'.$request["search"].'%')
            ->leftJoin('employees', 'employees.id', '=', 'users.employee_id')
            ->join('type_documents', 'type_documents.id', '=', 'employees.type_document_id')
            ->join('genders', 'genders.id', '=', 'employees.gender_id')
            ->join('rols', 'rols.id', '=', 'users.rol_id')
            ->orderBy('users.id', 'DESC')
            ->paginate($limit);

        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $users
        ], 200);
    }
    public function login(LoginRequest $request)
    {
        // Obtenemos al usuario a autenticar
        $user = User::where('email', $request->email)->first();
        // Vemos si las credenciales son erróneas para retornar un mensaje de error
        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                'res' => true,
                'token' => $user->createToken('SSTROC')->plainTextToken,
                'user' => $user,
                'message' => 'Bienvenido al sistema',
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Email o password incorrecto',
            ], 400);
        }
    }

    public function store(RegisterUserRequest $request)
    {
        $employee = Employee::find($request->employee_id);
        $request["password"] = Hash::make($request["password"]);
        $request["email"] = $employee->email;
        $user = User::create($request->all());
        if ($user) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar usuario',
                'data' => null,
            ], 400);
        }
    }
    public function validateSesion()
    {
        if (Auth::check()) {
            return true;
        }
    }

    public function logout()
    {
        //Obtenemos usuario logeado
        $user = Auth::user();
        //Busca todos los token del usuario en la base de datos y los eliminamos;
        $user->tokens->each(function ($token) {
            $token->delete();
        });
        return response()->json([
            'res' => true,
            'message' => 'Hasta la proxima',
        ], 200);
    }
}
