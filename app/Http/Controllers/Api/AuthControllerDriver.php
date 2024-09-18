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
    /**
     * Driver
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerDriver(Request $request)
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
            'car_year' => 'required|integer',
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

//        return HelpersController::responseApi(
//            200,
//            "success",
//            $request->all()
//        );

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
                'gender' => $request->gender,
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
                    Driver::with('user')->where('user_id', $user->id)->first()
                ]
            );
//            return response()->json([
//                'access_token' => $token,
//                'token_type' => 'Bearer',
//            ]);
        }


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkDriver(Request $request){
        $rules = [
            'telephone' => 'required|string|max:14',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return HelpersController::responseApi(
                400,
                "fields is required",
                null
            );
        }

        $user = User::where('mobile', $request->telephone)->where('role', 'driver')->first();
        if (!$user) {
            return HelpersController::responseApi(
                200,
                "Unauthorized",
                null
            );
        }
        return HelpersController::responseApi(
            200,
            "success",
            Driver::with('user')->where('user_id', $user->id)->first()
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginDriver(Request $request)
    {
        $rules = [
            'telephone' => 'required|string|max:14',
            'fcm_Token' => 'required|string|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return HelpersController::responseApi(
                400,
                "fields is required",
                null
            );
        }

        $user = User::where('mobile', $request->telephone)->first();
//        dd($user);
        if (!$user) {
            return HelpersController::responseApi(
                401,
                "Unauthorized",
                null
            );
        }
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        $user->fcm_Token = $request->fcm_Token;
        $user->save();
        return HelpersController::responseApi(
            200,
            "success",
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'driver' => Driver::with('user')->where('user_id', $user->id)->first()
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return HelpersController::responseApi(
            200,
            "success",
            null
        );
    }


    /**
     * User
     */

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerUser(Request $request){
//    return response()->json($request->file());
//        $file = $request->file('files');
//        $image_name = uniqid('user_profile') . time() . '.' . $file->getClientOriginalExtension();
//
//       $ok =  $file->storeAs('public/user/profile', $image_name);
//        if($ok){
//            return HelpersController::responseApi(
//                200,
//                "File Uploaded Success",
//                null
//            );
//        }else{
//            return HelpersController::responseApi(
//                200,
//                "File Uploaded Not Success",
//                null
//            );
//        }
//        return
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|max:14|unique:users',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return HelpersController::responseApi(
                200,
                "fields is required",
                null
            );
        }

        if ($request->password != $request->confirm_password) {
            return HelpersController::responseApi(
                200,
                "Passwords do not match",
                null
            );
        }
        $profile_photo_path = null;
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $image_name = uniqid('user_profile') . time() . '.' . $file->getClientOriginalExtension();
            $profile_photo_path = 'user/profile/' . $image_name;
            $file->storeAs('public/user/profile', $image_name);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'role' => 'user',
                'username' => HelpersController::username($request->name),
                'indicator_tel'=> '+225',
                'status' => 'active',
                'gender' => $request->gender,
                'password' => Hash::make($request->password),
                'profile_photo_path' => $profile_photo_path
            ]);
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'role' => 'user',
                'username' => HelpersController::username($request->name),
                'indicator_tel'=> '+225',
                'status' => 'active',
                'gender' => $request->gender,
                'password' => Hash::make($request->password),
            ]);
        }


        $token = $user->createToken('auth_token')->plainTextToken;
        return HelpersController::responseApi(
            200,
            "success",
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkUser(Request $request){
//        return response()->json($request->all());
        $rules = [
            'telephone' => 'required|string|max:14',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return HelpersController::responseApi(
                400,
                "fields is required",
                null
            );
        }

        $user = User::where('mobile', $request->telephone)->where('role', 'user')->first();
        if (!$user) {
            return HelpersController::responseApi(
                200,
                "Unauthorized",
                null
            );
        }
        return HelpersController::responseApi(
            200,
            "success",
            $user
        );
    }



    public function loginUser(Request $request)
    {
        $rules = [
            'telephone' => 'required|string|max:14',
            'fcm_token' => 'required|string|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return HelpersController::responseApi(
                200,
                "fields is required",
                null
            );
        }

        $user = User::where('mobile', $request->telephone)->where('role', 'user')->first();
        $user->fcm_token = $request->fcm_token;
        $user->save();
        if (!$user) {
            return HelpersController::responseApi(
                200,
                "Unauthorized",
                null
            );
        }

        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;
        return HelpersController::responseApi(
            200,
            "success",
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]
        );
    }
}
