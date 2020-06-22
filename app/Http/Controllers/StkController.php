<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use SmoDav\Mpesa\Laravel\Facades\STK;

class StkController extends Controller
{
    public function initiateRequest(Request $request){

        $token = $request->bearerToken();
        if($token == 'gp0IxrsZd8nBYJgPVLDEe1ayd6uooU0e'){
            try{
                $response = STK::request($request->input('amount'))
                    ->from($request->input('phone'))
                    ->usingReference($request->input('unique_ref'),$request->input('description'))
                    ->setCommand('CustomerPayBillOnline')
                    ->push();

                $data = [
                    'code'=> 200,
                    'message'=>$response->CustomerMessage,
                    'data' => $response
                ];

                return JsonResponse::create($data,200);
            }catch (\Exception $e){
                $error = $e->getMessage();
                $data = [
                    'code'=> 502,
                    'message'=>$error,
                    'data' => [$request->all()]
                ];

                return JsonResponse::create($data,502);
            }
        }else{
            $data = [
                'code'=> 401,
                'message'=>"Invalid API Key. Kindly ensure you use the correct Bearer Token",
                'data' => []
            ];

            return JsonResponse::create($data,401);
        }

    }

    public function checkTransaction(Request $request){

        $token = $request->bearerToken();
        if($token == 'gp0IxrsZd8nBYJgPVLDEe1ayd6uooU0e'){

            $CheckoutRequestID = $request->input('CheckoutRequestID');
            if(!$CheckoutRequestID){
                $data = [
                    'code'=> 502,
                    'message'=>"CheckoutRequestID is required to validate a transaction",
                    'data' => [$request->all()]
                ];

                return JsonResponse::create($data,502);
            }

            $CheckoutRequestID = $request->input('CheckoutRequestID');

            try{

                $response = STK::validate($CheckoutRequestID);

                if(isset($response->errorMessage)){
                    $response->ResultCode = "1030";
                    $data = [
                        'code'=> "200",
                        'message'=>$response->errorMessage,
                        'data' => $response
                    ];
                    return JsonResponse::create($data,200);
                }

//                if($response->ResultCode == "0"){
//                    $code = "1";
//                }else{
//                    $code = $response->ResultCode;
//                }
                    $data = [
                        'code'=> 200,
                        'message'=>$response->ResultDesc,
                        'data' => $response
                    ];

                return JsonResponse::create($data,200);
            }catch (\Exception $e){
                $error = $e->getMessage();
                $data = [
                    'code'=> 502,
                    'message'=>$error,
                    'data' => [$request->all()]
                ];

                return JsonResponse::create($data,502);
            }
        }else{
            $data = [
                'code'=> 401,
                'message'=>"Invalid API Key. Kindly ensure you use the correct Bearer Token",
                'data' => []
            ];

            return JsonResponse::create($data,401);
        }
    }

}
