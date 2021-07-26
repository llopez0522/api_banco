<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserHasAccountResource;
use App\Models\UserHasAccount;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserHasAccountController extends Controller {

    function verifyAccount(Request $request) {
        try {
            $data = UserHasAccount::where('user_has_account.user_id', '=', Auth::id())
                ->where('user_has_account.account_id', '=', $request->account_origin)
                ->join('account AS ac', 'user_has_account.account_id', '=', 'ac.id')
                ->first();

            return new UserHasAccountResource($data);
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
