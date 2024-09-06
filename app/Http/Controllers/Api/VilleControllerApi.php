<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelpersController;
use App\Models\Ville;
use Illuminate\Http\Request;

class VilleControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Ville::with('communes')->get();
        return HelpersController::responseApi(
            200,
            "success",
            $all
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ville $ville)
    {
        return HelpersController::responseApi(
            200,
            'success',
            $ville->with('communes')->first()
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ville $ville)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ville $ville)
    {
        //
    }
}
