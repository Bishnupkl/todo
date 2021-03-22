<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
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


    }
}
