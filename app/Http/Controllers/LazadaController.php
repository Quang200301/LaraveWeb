<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\lazada;
class LazadaController extends Controller
{
    public function getLazada(){
        $lazadas= lazada::all();	
        return response()->json($lazadas);
    }

    public function addLazada(Request $request)							
	{							
	$lazadas = new lazada();							
	$lazadas->name = $request->input('name');							
	$lazadas->avarta = $request->input('avarta');													
	$lazadas->price = intval($request->input('price'));	
    $lazadas->shopower=$request->input('shopower');																
	$lazadas->save();							
	return response()->json([
		'status'=>200,
		'massange'=>'Add successful'
	]);	
	}	
}
