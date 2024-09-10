<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverDocumentRequest;
use App\Http\Requests\UpdateDriverDocumentRequest;
use App\Models\Driver;
use App\Models\DriverDocument;
use App\Models\TypeDocumentDriver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DriverDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Driver $driver)
    {
//        $results = DriverDocument::where('driver_id', $driver->user_id)->paginate(10);
        $results = TypeDocumentDriver::paginate(10);
//        dd($driverDocuments);
        return view('backend.driver.documents.index', compact('results','driver'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverDocumentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DriverDocument $driverDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DriverDocument $driverDocument)
    {
        //
    }

    /**
     * Aprove the specified resource in storage.
     */
    public function approve(DriverDocument $driverDocument, Request $request)
    {
        $rules = [
            'status' => 'required|in:APPROVED,REJECTED'
        ];
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back();
        }
        $driverDocument->update([
            'status' => $request->status,
        ]);
//        dd(DriverDocument::where('driver_id', $driverDocument->driver_id)->where('status', 'APPROVED')->count(),TypeDocumentDriver::all()->count());
        if(DriverDocument::where('driver_id', $driverDocument->driver_id)->where('status', 'APPROVED')->count() == TypeDocumentDriver::all()->count()){
            Driver::where('user_id', $driverDocument->driver_id)->update(['approve' => '1', 'status' => '1']);
            User::where('id', $driverDocument->driver_id)->update(['status' => 'active']);
            return redirect()->back();
        }elseif (DriverDocument::where('driver_id', $driverDocument->driver_id)->where('status', 'REJECTED')->count() == TypeDocumentDriver::all()->count()){
            Driver::where('user_id', $driverDocument->driver_id)->update(['approve' => '2', 'status' => '2']); //2 = Rejected; 0 = Pending; 1 = Approved
            User::where('id', $driverDocument->driver_id)->update(['status' => 'inactive']);
            return redirect()->back();
        }
        else{
            Driver::where('user_id', $driverDocument->driver_id)->update(['approve' => '0', 'status' =>'0']);
            User::where('id', $driverDocument->driver_id)->update(['status' => 'inactive']);
            return redirect()->back();
        }
        Session::flash('message', 'Mise à jour effectuée avec succès');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriverDocumentRequest $request, DriverDocument $driverDocument)
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
