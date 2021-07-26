<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    function infoUser() {
        try {
            $data = User::where('id', '=', Auth::id())
                ->select('document', 'username', 'email')
                ->first();

            if ($data) {
                return response()->json([
                    'error' => 1,
                    'data'  => $data
                ], Response::HTTP_OK)->withHeaders([
                    'Content-Type'     => 'application/json',
                    'Accept'           => 'application/json',
                    'X-Requested-With' => 'XMLHttpRequest'
                ]);
            }
        } catch (QueryException $e) {
            return response()->json([
                'success' => FALSE,
                'error'   => 0,
                'message' => $e->getMessage(),
            ], Response::HTTP_CONFLICT)->withHeaders([
                'Content-Type'     => 'application/json',
                'Accept'           => 'application/json',
                'X-Requested-With' => 'XMLHttpRequest'
            ]);
        }
    }
}
