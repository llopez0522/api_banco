<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeAccountResource;
use App\Models\TypeAccount;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

class TypeAccountController extends Controller {

    function all() {
        try {
            $data = TypeAccountResource::collection(TypeAccount::all()->sortBy('name'));

            if (count($data) > 0) {
                return response()->json([
                    'success' => TRUE,
                    'error'   => 1,
                    'message' => 'Listado exitoso',
                    'data'    => $data
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


    function all2() {
        try {
            $data = TypeAccount::join('account AS ac', 'ac.type_account_id', '=', 'type_account.id')
                ->selectRaw("type_account.id, type_account.name, ac.name ac_name, ac.number_, ac.value")
                ->get();

            if (count($data) > 0) {
                return response()->json([
                    'success' => TRUE,
                    'error'   => 1,
                    'message' => 'Listado exitoso',
                    'data'    => $data
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
}
