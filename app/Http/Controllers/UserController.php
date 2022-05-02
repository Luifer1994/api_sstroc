<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
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
            'type_documents.name as document_type',
            'genders.name as gender',
            'rols.name as rol',
        )
            ->join('type_documents', 'type_documents.id', '=', 'users.type_document_id')
            ->join('genders', 'genders.id', '=', 'users.gender_id')
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
}
