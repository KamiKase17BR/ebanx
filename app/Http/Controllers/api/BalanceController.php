<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use Exception;
use Symfony\Component\HttpFoundation\Response;




class BalanceController extends Controller
{
    
    public function index(Request $request)
    {
        $input = $request->input();
        $id = $input["account_id"];
        
        try{
            $account = Events::where('id',$id)->get();

            return response()->json([
                $account[0]->amount
            ], Response::HTTP_OK);
        }catch(Exception $exception){
            
            return response()->json([
                0
            ], Response::HTTP_NOT_FOUND);
        }

       
    }

}
