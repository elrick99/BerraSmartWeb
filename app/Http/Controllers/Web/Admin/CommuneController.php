<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommuneRequest;
use App\Http\Requests\UpdateCommuneRequest;
use App\Models\Commune;
use App\Models\Ville;
use Illuminate\Support\Facades\Session;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Commune::paginate(10);
        return view('backend.commune.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $villes = Ville::all();
        return view('backend.commune.create', compact('villes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommuneRequest $request)
    {
        $data = $request->all();
        $data['libelle'] = strtoupper($data['libelle']);
        $status = Commune::create($data);
        if($status){
            Session::flash('message', 'Commune creer avec succes');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('commune.index')->with('success', 'Commune creer avec succes');
        }else{
            return back()->with('error', 'Commune non creer');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Commune $commune)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commune $commune)
    {
        $villes = Ville::all();
        return view('backend.commune.edit', compact('commune', 'villes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommuneRequest $request, Commune $commune)
    {
        $commune->libelle = strtoupper($request->libelle);
        $commune->description = $request->description;
        $commune->ville_id = $request->ville_id;
        $commune->status = $request->status;
        $status = $commune->save();
        if($status){
            Session::flash('message', 'Commune modifier avec succes');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('commune.index')->with('success', 'Commune modifier avec succes');
        }else{
            return back()->with('error', 'Commune non modifier');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $commune= Commune::find($id);
        $status = $commune->delete();
        if($status){
            echo json_encode([
                'statusCode' => 200,
                'message' => 'Commune supprimer avec succes'
            ]);
        }else{
            echo json_encode([
                'statusCode' => 201,
                'message' => 'Commune non supprimer'
            ]);
        }
    }
}
