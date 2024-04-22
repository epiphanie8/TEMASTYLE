<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //

    public function __construct()
    {
       $this->middleware('auth:api',['except' =>['login','register']]);
    }
    public function register(Request $request){
        $validator=validator::make(
            $request->all(),
            [
                'nom' => 'required|string',
                'prenom'=>'required|string',
                'contact'=>'required|string|unique:users',
                'email'=>'required|string|unique:users',
                'password'=>'required|min:6|confirmed',
            ]
            );
            $errors =$validator->errors();
            if($errors->has('email')){
                return response()->json([
                    'success' => false,
                    'status' => 422,
                    'message' =>'email existe déjà '
                ]);
            }

            else if($errors->has('contact'))
            {
                return response()->json(
                    [
                    'success' => false,
                    'status' => 422,
                    'message' =>'contact existe déjà '
                ]
                    );
            }

           else if($errors->has('password')){
                return response()->json([
                    'success' => false,
                    'status' => 422,
                    'message' =>'Veuillez entrer un mot de passe de 6 caractères minimum'
                ]);
            }

            $password_hash = Hash::make( $request->password);

            $user = User::create([
               'nom' =>$request->nom,
               'prenom' =>$request->prenom,
               'contact' =>$request->contact,
               'email' =>$request->email,
               'password' =>$password_hash,
               
            ]);
            return response()->json(
                [
                'success' => true,
                'status' => 201,
                'message' =>'Inscription reussie'
            ]
                );
        
    }



    public function login(Request $request) 
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email'=> 'required',
                'password' =>'required',

            ]
            
            );
            if ($validator->fails()){
                $errors =$validator->errors();
                return response()->json(
                    [
                        'success'=>false,
                        'status'=>422,
                        'message'=>"Veuillez renseigner tous les champs!",
                    ]
                    );
            }
            if (!$token =auth()->attempt($validator->validated())){
                return response()->json([
                    "success"=> false,
                    "status"=> 401,
                    "message"=>"compte inexistant ou mot de passe incorrecte",
                ]);
            }
            return $this->responsewithToken($token);

    }
    protected function responsewithToken($token)
    {
        $date =now()->addSeconds(JWTAuth::factory()->getTTL() * 60);
        $user= auth()->user();
        return response()->json(
            [
                'success'=>true,
                'status'=>200,
                'data'=>$user,
                'access_token'=> $token,
                'type' => 'Bearer',
                'expires_in' => date($date),
                'date_expire_in' => $date->format('y-m-d'),
                'heure_expire_in' => $date->format('H:i:s'),
                
            ]
            );
    }

}
