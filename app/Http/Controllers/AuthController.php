<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['authenticate']]);
    }

    public function authenticate(Request $request) {
        $credentials = $request->only('document', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'error'   => 0,
                'message' => 'El usuario y/o contraseña son incorrectos',
                'data'    => NULL
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Obteniendo el usuario autenticado.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        return response()->json(Auth::user());
    }

    /**
     * Cerrar la sesión del usuario (invalidar el token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Actualizar token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Obteniendo la extructura de matriz token.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token) {
        return response()->json([
            'error' => 1,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
