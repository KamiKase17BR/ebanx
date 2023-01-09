<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;


class EventController extends Controller
{

    public function store(Request $request)
    {
        $form = json_decode($request->getContent(), true);

        if ($form["type"] == "deposit") {
            
            $id = $form["destination"] ;
            
            $account["id"] = $id;
            $account["balance"] = $form["amount"];
            
            try {
                $searchAccount = Events::find($id);

                if (!empty($searchAccount)) {
                    $return = $this->update($form, $id);
                }
                
                if (empty($searchAccount)) {
                    Events::create($account);
                    $return = Events::find($id);
                }

                return response()->json([
                    "destination" =>  $return
                ], Response::HTTP_CREATED);
            } catch (QueryException $exception) {
                return response()->json([
                    0
                ], Response::HTTP_NOT_FOUND);
            }
        }

        if ($form["type"] == "withdraw") {
            $id = $form["origin"];
            try {
                Events::findOrFail($id);

                $return = $this->update($form, $id);

                $return = array("origin" => $return);
                
                return response()->json(
                    $return
                , Response::HTTP_CREATED);
            } catch (Exception $exception) {

                return response()->json(
                    0
                , Response::HTTP_NOT_FOUND);
            }
        }

        if ($form["type"] = "transfer") {
            $id = $form["origin"];
            $toId = $form["destination"];
            try {
                Events::findOrFail($id);
                Events::findOrFail($toId);

                $return = $this->update($form, $id);
                return response()->json([
                    $return
                ], Response::HTTP_CREATED);
            } catch (Exception $exception) {

                return response()->json(
                    0
                , Response::HTTP_NOT_FOUND);
            }
        }
    }


    public function update($request, $id)
    {
        $account = Events::find($id);
        
        $newAmount = $request["amount"];
        
        $beforeAmount = $account->balance;

        if ($request["type"] == "withdraw") {
            $afterAmount =  $beforeAmount - $newAmount;
        }
        if ($request["type"] == "deposit") {
            $afterAmount = $newAmount + $beforeAmount;
        }
        if ($request["type"] == "transfer") {

            $fromAccountAmount =  $beforeAmount - $newAmount;

            $toAccountId = $request["destination"];

            $account = Events::find($toAccountId);
            $beforeAmount = $account->balance;

            $toAccountAmount = $newAmount + $beforeAmount;
        }

        if ($request["type"] == "withdraw" || $request["type"] == "deposit") {
            $account = Events::where('id', $id)->update(['balance' => $afterAmount]);
            $account = Events::find($id);
        }
        if ($request["type"] == "transfer") {
            $fromAccountId = $request["origin"];

            Events::where('id', $fromAccountId)->update(['balance' => $fromAccountAmount]);
            Events::where('id', $toAccountId)->update(['balance' => $toAccountAmount]);

            $fromReturn = ["origin" => Events::find($fromAccountId)];
            $toReturn = ["destination" => Events::find($toAccountId)];

            $account = $fromReturn + $toReturn;
        }

        return $account;
    }
}
