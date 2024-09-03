<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehiculeMarqueRequest;
use App\Http\Requests\UpdateVehiculeMarqueRequest;
use App\Models\VehiculeMarque;
use Illuminate\Support\Facades\Session;

class VehiculeMarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = VehiculeMarque::paginate(10);
        return view('backend.vehicule_marque.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.vehicule_marque.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehiculeMarqueRequest $request)
    {
        $data = $request->all();
        $data['libelle'] = strtoupper($data['libelle']);
        $status = VehiculeMarque::create($data);
        if($status){
            Session::flash('message', 'Vehicule Marque creer avec succes');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('vehicule_marque.index')->with('success', 'Vehicule Marque creer avec succes');
        }else{
            return back()->with('error', 'Vehicule Marque non creer');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VehiculeMarque $vehiculeMarque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehiculeMarque $vehiculeMarque)
    {
        return view('backend.vehicule_marque.edit', compact('vehiculeMarque'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehiculeMarqueRequest $request, VehiculeMarque $vehiculeMarque)
    {
        $vehiculeMarque->libelle = strtoupper($request->libelle);
        $vehiculeMarque->description = $request->description;
        $vehiculeMarque->status = $request->status;
        $status = $vehiculeMarque->save();
        if($status){
            Session::flash('message', 'Vehicule Marque modifier avec succes');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('vehicule_marque.index')->with('success', 'Vehicule Marque modifier avec succes');
        }else {
            return back()->with('error', 'Vehicule Marque non modifier');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehiculeMarque = VehiculeMarque::find($id);
        $status = $vehiculeMarque->delete();
        if($status){
            echo json_encode(['statusCode' => 200, 'message' => 'Vehicule Marque supprimer avec succes']);
        }else{
            echo json_encode(['statusCode' => 201, 'message' => 'Vehicule Marque non supprimer']);
        }
    }
}
