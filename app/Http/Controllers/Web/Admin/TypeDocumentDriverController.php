<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeDocumentDriverRequest;
use App\Http\Requests\UpdateTypeDocumentDriverRequest;
use App\Models\TypeDocumentDriver;

class TypeDocumentDriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = TypeDocumentDriver::paginate(10);
        return view('backend.type_document_driver.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.type_document_driver.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeDocumentDriverRequest $request)
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
     * Show the form for editing the specified resource.
     */
    public function edit(TypeDocumentDriver $typeDocumentDriver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeDocumentDriverRequest $request, TypeDocumentDriver $typeDocumentDriver)
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
