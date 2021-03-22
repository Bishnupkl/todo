<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class UserController extends Controller
{

    private $sucess_status = 200;

    public function register(Request $request)
    {
        $validator=\Illuminate\Support\Facades\Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',

    ]);

        if ($validator->fails()) {
            return response()->json(["val error"=> $validator->errors()]);
        }

        $data = $request->all();
        $data['password']=bcrypt($request->password);
        $user = User::create($data);

        if ($user) {
            return response()->json(["message" => "user created succesfully",
            ]);
//            return  response()->json([])
        }else{
            return  response()->json(["message" => "user couldnt registered",]);


        }

    }

    public function login(Request  $request)
    {
        $validator=\Illuminate\Support\Facades\Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(["val error"=> $validator->errors()]);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user       =       Auth::user();
            $token      =       $user->createToken('token')->accessToken;

            return response()->json([ "success" => true, "login" => true, "token" => $token, "data" => $user]);
        }
        else {
            return response()->json(["status" => $this->sucess_status,"status" => "failed", "success" => false, "message" => "Whoops! invalid email or password"]);
        }
    }

    public function userDetail() {
        $user           =       Auth::user();
        if(!is_null($user)) {
            return response()->json(["status" => $this->sucess_status, "success" => true, "user" => $user]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no user found"]);
        }
    }




}
