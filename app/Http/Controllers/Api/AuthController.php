<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
        /**
 * @OA\Post(
 *   path="/api/register",
 *   tags={"Auth"},
 *   summary="Registrar un nuevo usuario",
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       required={"name","email","password"},
 *       @OA\Property(property="name", type="string", example="Juan Pérez"),
 *       @OA\Property(property="email", type="string", format="email", example="juan@example.com"),
 *       @OA\Property(property="password", type="string", format="password", example="12345678")
 *     )
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Usuario registrado correctamente",
 *     @OA\JsonContent(
 *       @OA\Property(property="user", ref="#/components/schemas/User"),
 *       @OA\Property(property="token", type="string", example="1|xyz123token"),
 *       @OA\Property(property="token_type", type="string", example="Bearer")
 *     )
 *   ),
 *   @OA\Response(response=422, description="Error de validación")
 * )
 */
    // Registro
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

/**
 * @OA\Post(
 *   path="/api/login",
 *   tags={"Auth"},
 *   summary="Iniciar sesión de usuario",
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", format="email", example="juan@example.com"),
 *       @OA\Property(property="password", type="string", format="password", example="12345678")
 *     )
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Login exitoso",
 *     @OA\JsonContent(
 *       @OA\Property(property="user", ref="#/components/schemas/User"),
 *       @OA\Property(property="token", type="string", example="1|xyz123token"),
 *       @OA\Property(property="token_type", type="string", example="Bearer")
 *     )
 *   ),
 *   @OA\Response(response=401, description="Credenciales inválidas")
 * )
 */
    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales no son válidas.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
/**
 * @OA\Post(
 *   path="/api/logout",
 *   security={{"sanctum":{}}},
 *   tags={"Auth"},
 *   summary="Cerrar sesión del usuario autenticado",
 *   @OA\Response(
 *     response=200,
 *     description="Sesión cerrada correctamente",
 *     @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sesión cerrada correctamente")
 *     )
 *   ),
 *   @OA\Response(response=401, description="Usuario no autenticado")
 * )
 */

    // Logout
    public function logout(Request $request)
{
    if (! $request->user()) {
        return response()->json([
            'message' => 'Usuario no autenticado'
        ], 401);
    }

    $request->user()->tokens()->delete();

    return response()->json([
        'message' => 'Sesión cerrada correctamente'
    ]);
}
/**
 * @OA\Get(
 *   path="/api/me",
 *   security={{"sanctum":{}}},
 *   tags={"Auth"},
 *   summary="Obtener el perfil del usuario autenticado",
 *   @OA\Response(
 *     response=200,
 *     description="Perfil del usuario",
 *     @OA\JsonContent(
 *       @OA\Property(property="user", ref="#/components/schemas/User")
 *     )
 *   ),
 *   @OA\Response(response=401, description="Usuario no autenticado")
 * )
 */

    // Perfil del usuario autenticado
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

}
