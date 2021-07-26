<?php

namespace App\Http\Controllers;

use App\Http\Resources\BanksResource;
use App\Models\Bank;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

class BanksController extends Controller {

    function all() {
        try {
            $data = BanksResource::collection(Bank::all()->sortBy('name'));

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
