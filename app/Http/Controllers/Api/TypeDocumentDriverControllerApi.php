<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelpersController;
use App\Models\TypeDocumentDriver;
use Illuminate\Http\Request;

class TypeDocumentDriverControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = TypeDocumentDriver::all();
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
    public function show(TypeDocumentDriver $typeDocumentDriver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeDocumentDriver $typeDocumentDriver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeDocumentDriver $typeDocumentDriver)
    {
        //
    }
}
