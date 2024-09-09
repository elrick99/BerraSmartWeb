<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelpersController;
use App\Models\VehiculeMarque;
use Illuminate\Http\Request;

class VehiculeMarqueControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = VehiculeMarque::with('vehicule_type')->get();
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
    public function show(VehiculeMarque $vehiculeMarque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehiculeMarque $vehiculeMarque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehiculeMarque $vehiculeMarque)
    {
        //
    }
}
