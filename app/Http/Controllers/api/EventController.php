<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;


class EventController extends Controller
{
    
    public function index()
    {
        return Events::all();
    }

    
    public function store(Request $request)
    {
        $input = $request->input();
        $id = $request["id"];

        if($input["type"] == "deposit" ){
            try{
                $create = Events::create($input);
                 
            }catch(QueryException $exception){
                echo $request['amount'];
               $create = $this->update($input, $id);
            }
        
            return response()->json([
                $create
            ], Response::HTTP_CREATED);
        }
        
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update($request, $id)
    {
        
        $amount = $request["amount"];
        $amount += $amount;
        echo $amount;

        $addAmount = Events::find($id);
 
        $addAmount->amount = $amount;
 
        $addAmount->save();
        
        return $addAmount;
    }


    public function destroy($id)
    {
        //
    }
}
