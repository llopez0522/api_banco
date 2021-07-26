<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MovementsController extends Controller {

    function store(Request $request) {
        try {
            $this->validate($request, [
                'bank_id'          => 'required',
                'type_movement_id' => 'required',
                'account_origin'   => 'required',
                'account_destiny'  => 'required',
                'amount'           => 'required',
            ]);
            $account = new AccountController();
            $accountId = $account->checkAccount($request);

            $userHasAccount = new UserHasAccountController();
            $verifyAccount = $userHasAccount->verifyAccount($request);

//            if ($accountId->id === $verifyAccount->account_id) {
//                return response()->json([
//                    'success' => FALSE,
//                    'error'   => 0,
//                    'message' => 'Lo sentmos no es posible hacer transferencias a la misma cuenta.',
//                ], Response::HTTP_OK)->withHeaders([
//                    'Content-Type'     => 'application/json',
//                    'Accept'           => 'application/json',
//                    'X-Requested-With' => 'XMLHttpRequest'
//                ]);
//            }

            if ($request->amount > $accountId->value) {
                return response()->json([
                    'success' => FALSE,
                    'error'   => 0,
                    'message' => 'Lo sentimos no tiene saldo suficiente para realizar esta transferencia.',
                ], Response::HTTP_OK)->withHeaders([
                    'Content-Type'     => 'application/json',
                    'Accept'           => 'application/json',
                    'X-Requested-With' => 'XMLHttpRequest'
                ]);
            }

            if ($verifyAccount->state === 0) {
                return response()->json([
                    'success' => FALSE,
                    'error'   => 0,
                    'message' => 'La cuenta a la que desea tranferir se encuentra inhabilitada.',
                ], Response::HTTP_OK)->withHeaders([
                    'Content-Type'     => 'application/json',
                    'Accept'           => 'application/json',
                    'X-Requested-With' => 'XMLHttpRequest'
                ]);
            }

            if ($request->amount === 0) {
                return response()->json([
                    'success' => FALSE,
                    'error'   => 0,
                    'message' => 'Su saldo es insuficiente para realizar la tranferencia.',
                ], Response::HTTP_OK)->withHeaders([
                    'Content-Type'     => 'application/json',
                    'Accept'           => 'application/json',
                    'X-Requested-With' => 'XMLHttpRequest'
                ]);
            }

            $data = Movement::create([
                'account_id'       => $request->account_destiny,
                'bank_id'          => $request->bank_id,
                'type_movement_id' => $request->type_movement_id,
                'amount'           => $request->amount,
                'date_'            => date('Y-m-d H:i:s'),
            ]);

            Movement::create([
                'account_id'       => $request->account_origin,
                'bank_id'          => $request->bank_id,
                'type_movement_id' => $request->type_movement_id,
                'amount'           => $request->amount,
                'date_'            => date('Y-m-d H:i:s'),
            ]);

            if ($data) {
                $affected = $this->sumValue($request);
                if ($affected) {
                    $this->subtractValue($request);
                }

                return response()->json([
                    'success' => TRUE,
                    'error'   => 1,
                    'message' => 'Su transferencia a sido exitosa',
                ], Response::HTTP_CREATED)->withHeaders([
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

    function sumValue(Request $request) {
        try {
            return DB::update(
                'UPDATE account SET value = value + ? WHERE id = ?',
                [$request->amount, $request->account_destiny]
            );
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

    function subtractValue(Request $request) {
        try {
            return DB::update(
                'UPDATE account SET value = value - ? WHERE id = ?',
                [$request->amount, $request->account_origin]
            );
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
