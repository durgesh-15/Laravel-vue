<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

use Validator;

class AuthController extends Controller
{
    /*
    * user login function 
    */
    public function login (Request $request) 
    {
        try
        {
            $rules = [
                'email' => 'required|email',
                'password' => 'required'
            ];
            $message = [
                'email.required'    => 'Please enter your email',
                'email.email'       => 'Please enter valid email',
                'password.required' => 'Please enter your password'
            ];
            
            $validator = Validator::make($request->all(),$rules,$message);
            if($validator->fails())
            {
                $result = $validator->messages();
                return response()->json([
                    'status'  => false,
                    'message' => "Validation error",
                    'errors'  => $result
                ]);
            }
    
            $user = User::where('email', $request->email)->first();
            if($user){
                if(Hash::check($request->password, $user->password))
                {
                    $token = Str::random(80);
                    $user->remember_token = $token;
                    $user->save();

                    return response()->json([
                        'status' => true,
                        'token'  => $token
                    ]);
                } 
                else
                {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Password mismatch'
                    ]);
                }
            }
            else
            {
                return response()->json([
                    'status'  => false,
                    'message' => 'User does not exist'
                ]);
            }
        }
        catch(Exeption $e)
        {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }

        
    }
    /*
     * user login function 
     */
    // public function login(Request $request)
    // {
    //     //set validation rule
    //     try
    //     {
    //         $rules = [
    //             'email' => 'required|email',
    //             'password' => 'required'
    //         ];
    //         $message = [
    //             'email.required'    => 'Please enter your email',
    //             'email.email'       => 'Please enter valid email',
    //             'password.required' => 'Please enter your password'
    //         ];
            
    //         $validator = Validator::make($request->all(),$rules,$message);
    //         if($validator->fails())
    //         {
    //             $result = $validator->messages();
    //             return response()->json([
    //                 'status'  => false,
    //                 'message' => "Validation error",
    //                 'errors'  => $result
    //             ]);
    //         }
            
    //         $credentials = [
    //             'email'    => $request->email,
    //             'password' => $request->password
    //         ];

    //         if(Auth::attempt($credentials))
    //         {
    //             $token = Str::random(80);
    //             Auth::user()->api_token = $token;
    //             Auth::user()->save();
    //             return response()->json([
    //                 'status' => true,
    //                 'token' => $token
    //             ]);
    //         }
    //         return response()->json(['status' => 'Email or password wrong'],403);
    //     }
    //     catch(Exeption $e)
    //     {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => $e->gerMessage()
    //         ]);
    //     }
    // }
    
}
