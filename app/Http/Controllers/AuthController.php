<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'required' => 'El campo :attribute es requerido'
        ]);

        //Retorna los errores de validacion
        if ($validator->fails()) {
            return response()->json([
                "status" => 404,
                "message" => "Errores de validación",
                "errors" => $validator->errors()
            ]);
        }

        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return response()->json([
                "status" => 404,
                "message" => 'Este usuario no existe en la base de datos',
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => 404,
                "message" => 'Password incorrecta',
            ]);
        }
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "status" => 200,
            "message" => 'Login exitoso.',
            'token' => $token,
            "usuario" => $user
        ]);
    }
}
