<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function handleRequest(Request $request){
        $json = $request->json();
        $requestArray = json_decode($request->getContent());

        $service = new  \App\Library\Services\Interfaces\TeskTaskService();
        $response = $service->reserveEventPlaces(1, $requestArray->name, $requestArray->places);
        return $response->getBody();
//        return  View::make('clear', ["response" =>  $response->getBody()]);

//        return response()->json(['reserveId'=>$requestArray->name]);
    }
}
