<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth",
     *     operationId="login",
     *     tags={"Autenticação"},
     *     summary="Faz login e retorna um token de acesso",
     *     security={{"Bearer":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Credenciais de login",
     *         @OA\JsonContent(
     *             required={"email", "password", "device_name"},
     *             @OA\Property(property="email", type="string", example="lpagac@example.net"),
     *             @OA\Property(property="password", type="string", example="12345678"),
     *             @OA\Property(property="device_name", type="string", example="swagger"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Token de acesso gerado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string", example="seu_token_de_acesso"),
     *             @OA\Property(property="token_type", type="string", example="Bearer"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciais inválidas",
     *     ),
     * )
     */
    public function auth(Request $request)
    {

        $user = User::where('email', $request->email)->first();


        if (! $user || ! Hash::check($request->password, $user->password))
        {
            throw ValidationException::withMessages(['email' => 'The provider credentials are incorrect']);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }




    /**
     * @OA\Post(
     *     path="/api/register",
     *     operationId="register",
     *     tags={"Autenticação"},
     *     summary="Cria um novo usuário",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do novo usuário",
     *         @OA\JsonContent(
     *             required={"email", "password", "name"},
     *             @OA\Property(property="email", type="string", example="novo_nome_de_usuario"),
     *             @OA\Property(property="password", type="string", example="nova_senha"),
     *             @OA\Property(property="name", type="string", example="novo_nome"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuário criado com sucesso",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro ao criar usuário",
     *     ),
     * )
     */
    public function register(Request $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;

        return $user->save();
    }
}
