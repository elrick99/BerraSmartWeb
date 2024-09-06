<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelpersController;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthControllerDriver extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|max:14|unique:users',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
            'vehicule_marque_id' => 'required|integer|exists:vehicule_marques,id',
            'vehicule_type_id' => 'required|integer|exists:vehicule_types,id',
            'car_color' => 'required|string|max:255',
            'car_number' => 'required|string|max:255',
            'gender' => 'required|in:Homme,Femme',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return HelpersController::responseApi(
                400,
                "fields is required",
                null
            );
        }

        if ($request->password != $request->confirm_password) {
            return HelpersController::responseApi(
                401,
                "Passwords do not match",
                null
            );

        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'role' => 'driver',
                'username' => HelpersController::username($request->name),
                'indicator_tel'=> '+225',
                'status' => 'active',
                'password' => Hash::make($request->password),
            ]);

            $driver = Driver::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'vehicule_marque_id' => $request->vehicule_marque_id,
                'vehicule_type_id' => $request->vehicule_type_id,
                'car_color' => $request->car_color,
                'car_number' => $request->car_number,
                'gender' => $request->gender,
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;
            return HelpersController::responseApi(
                200,
                "success",
                [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]
            );
//            return response()->json([
//                'access_token' => $token,
//                'token_type' => 'Bearer',
//            ]);
        }


    }

    public function login(Request $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return HelpersController::responseApi(
                401,
                "Unauthorized",
                null
            );
        }
        $token = auth()->user()->createToken('auth_token')->plainTextToken;
        return HelpersController::responseApi(
            200,
            "success",
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        );
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return HelpersController::responseApi(
            200,
            "success",
            null
        );
    }
}
