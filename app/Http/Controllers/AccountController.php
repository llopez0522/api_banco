<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use App\Models\Account;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller {

    function show(Request $request) {
        try {
            $data = Account::whereOr("LOWER(type_)  LIKE  LOWER('%".$request->route('type')."%')")
                ->where('type_account_id', '=', $request->route('id'))
                ->where('state', '<>', 0)
                ->orderBy('name', 'ASC')
                ->get();

            if (count($data) > 0) {
                return response()->json([
                    'success' => TRUE,
                    'error'   => 1,
                    'message' => 'Listado exitoso',
                    'data'    => AccountResource::collection($data)
                ], Response::HTTP_OK)->withHeaders([
                    'Content-Type'     => 'application/json',
                    'Accept'           => 'application/json',
                    'X-Requested-With' => 'XMLHttpRequest'
                ]);
            } else {
                return response()->json([
                    'success' => TRUE,
                    'error'   => 0,
                    'message' => 'No hay datos de respuesta disponibles para esta solicitud.',
                    'data'    => $data
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


    function checkAccount(Request $request) {
        try {
            return Account::where('id', '=', $request->account_origin)->first();
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
