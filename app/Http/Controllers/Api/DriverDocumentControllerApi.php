<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelpersController;
use App\Models\DriverDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class DriverDocumentControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataTable = $request->all();

        $data = json_decode($dataTable['data'], true);

        if ($request->hasFile('files')) {

            $file = $request->file('files');

            foreach ($file as $index => $f) {
                $driverDocument = new DriverDocument();
                $driverDocument->driver_id = $dataTable['user_id'];
                $driverDocument->type_document_driver_id = explode('_', $index)[0];
//                $driverDocument->active = 1;
                $driverDocument->identify_number = $data[explode('_', $index)[0]]['numId'];
                $driverDocument->expiry_date = date_create($data[explode('_', $index)[0]]['dateExp'])->format('Y-m-d H:i:s');

                $image_name = uniqid('driver_document') . time() . '.' . $f->getClientOriginalExtension();
                $driverDocument->image = 'storage/driver/document/' . $image_name;
                $f->storeAs('public/driver/document', $image_name);
                $driverDocument->save();
            }

            return HelpersController::responseApi(
                200,
                "success",
                null
            );
        } else {
            return HelpersController::responseApi(
                200,
                "Fichier non téléchargé",
                null
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DriverDocument $driverDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DriverDocument $driverDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverDocument $driverDocument)
    {
        //
    }
}
