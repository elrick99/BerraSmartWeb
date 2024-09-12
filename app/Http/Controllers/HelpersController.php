<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpersController extends Controller
{
    public static function responseApi($status, $message, $data = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ],$status,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        );
    }

    public static function username($name): string
    {
        $name = preg_replace('/[^A-Za-z0-9]/', '', $name);
        // prendre les 4 premiers caractères de $name et 3 chiffres aleatoires
        $name = substr($name, 0, 4).rand(00,999);
        return $name;
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
