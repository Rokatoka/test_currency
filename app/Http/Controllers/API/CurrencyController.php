<?php

namespace App\Http\Controllers\API;

use App\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class CurrencyController
 * @package App\Http\Controllers\API
 */
class CurrencyController extends Controller
{
    /**
     * Get list of currencies on specific date with pagination
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request){
        if(!$request->header('Authorization')){
            $data = 'Token not provided';
            $status = 401;
            return response()->json(['data' => $data], $status);
        }
        if(Auth::guard('api')->check()){
            $currencies = Currency::filter($request->toArray())->paginate(6);
            $data = $currencies->total() != 0 ? $currencies : 'No data found';
            $status = $currencies->total() != 0 ? 200 : 404;
        }else{
            $data = 'Wrong token provided';
            $status = 403;
        }

        return response()->json(['data' => $data], $status);
    }

    /**
     * Get one currency by it's name and date
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItem(Request $request){
        if(!$request->header('Authorization')){
            $data = 'Token not provided';
            $status = 401;
            return response()->json(['data' => $data], $status);

        }
        if(Auth::guard('api')->check()){
            $currency = Currency::filter($request->toArray())->first();
            $data = isset($currency) ? $currency : 'No data found';
            $status = isset($currency) ? 200 : 404;
        }else{
            $data = 'Wrong token provided';
            $status = 403;
        }

        return response()->json(['data' => $data], $status);

    }
}
