<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehiculeTypeRequest;
use App\Http\Requests\UpdateVehiculeTypeRequest;
use App\Models\VehiculeMarque;
use App\Models\VehiculeType;
use Illuminate\Support\Facades\Session;

class VehiculeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = VehiculeType::paginate(10);
        return view('backend.vehicule_type.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marquesVehicule = VehiculeMarque::all();
        return view('backend.vehicule_type.create', compact('marquesVehicule'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehiculeTypeRequest $request)
    {
        $data = $request->all();
        $data['libelle'] = strtoupper($data['libelle']);
//        dd($data);
        $status = VehiculeType::create($data);
        if($status){
            Session::flash('message', 'Vehicule Type creer avec succes');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('vehicule_type.index')->with('success', 'Vehicule Type creer avec succes');
        }else{
            return back()->with('error', 'Vehicule Type non creer');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VehiculeType $vehiculeType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehiculeType $vehiculeType)
    {
        $marquesVehicule = VehiculeMarque::all();
        return view('backend.vehicule_type.edit', compact('vehiculeType', 'marquesVehicule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehiculeTypeRequest $request, VehiculeType $vehiculeType)
    {
        $vehiculeType->libelle = strtoupper($request->libelle);
        $vehiculeType->description = $request->description;
        $vehiculeType->vehicule_marque_id = $request->vehicule_marque_id;
        $vehiculeType->status = $request->status;
        $status = $vehiculeType->save();
        if($status){
            Session::flash('message', 'Vehicule Type modifier avec succes');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('vehicule_type.index')->with('success', 'Vehicule Type modifier avec succes');
        }else{
            return back()->with('error', 'Vehicule Type non modifier');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehiculeType = VehiculeType::find($id);
        $status = $vehiculeType->delete();
        if($status){
            echo json_encode(['status' => true, 'message' => 'Vehicule Type supprimer avec succes']);
        }else{
            echo json_encode(['status' => false, 'message' => 'Vehicule Type non supprimer']);
        }
    }
}
