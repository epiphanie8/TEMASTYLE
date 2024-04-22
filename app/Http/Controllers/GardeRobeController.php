<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GardeRobeController extends Controller
{
    //
    public function __construct()
    {
       $this->middleware('auth:api',['except' =>['login','register']]);
    }
    public function garderobe(Request $request){
        $request ->validate([
            'couleur_garde_robes'=> 'required|string',
            'image'=>'required|image|mimes:jpeg,png,jpg',
            'type_garde_robe_id'=>'required',
        ]);

        $imagesData = file_get_content($request->file('image'));

        $image = new Image();
        $image->couleur_garde_robes = $request->couleur_garde_robes;
        $image->type_garde_robe_id = $request->type_garde_robe_id;
        $image->image = $imagesData;
        $image->save();

        $errors =$validator->errors();
            if($errors->has('image')){
                return response()->json([
                    'success' => false,
                    'status' => 422,
                    'message' =>'Veuillez choisir une image de format jpeg,png,jpg'
                ]);
            }
            return response()->json(
                [
                'success' => true,
                'status' => 201,
                'message' =>'Insertion reussie'
            ]
                );
    }
}
