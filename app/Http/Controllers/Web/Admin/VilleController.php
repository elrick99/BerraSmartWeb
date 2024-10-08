<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVilleRequest;
use App\Http\Requests\UpdateVilleRequest;
use App\Models\Ville;
use Illuminate\Support\Facades\Session;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Ville::paginate(10);
        return view('backend.ville.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.ville.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVilleRequest $request)
    {
       $data = $request->all();
        $data['libelle'] = strtoupper($data['libelle']);
//       dd($data);
       $status = Ville::create($data);
       if($status){
           Session::flash('message', 'Ville creer avec succes');
           Session::flash('alert-class', 'alert-success');
           return redirect()->route('ville.index')->with('success', 'Ville creer avec succes');
       }else{
           return back()->with('error', 'Ville non creer');
       }

    }

    /**
     * Display the specified resource.
     */
    public function show(Ville $ville)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ville $ville)
    {
        return view('backend.ville.edit', compact('ville'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVilleRequest $request, Ville $ville)
    {
        $ville->libelle = strtoupper($request->libelle);
        $ville->description = $request->description;
        $ville->status = $request->status;
        $status = $ville->save();

        if($status){
            Session::flash('message', 'Ville modifier avec succes ');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('ville.index')->with('success', 'Ville modifier avec succes');
        }else{
            return back()->with('error', 'Ville non modifier');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ville = Ville::find($id);
        $status = $ville->delete();
        if ($status){
            echo json_encode([
                'statusCode' => 200,
                'message' => 'Ville supprimer avec succes'
                ]);
        }else{
            echo json_encode([
                'statusCode' => 201,
                'message' => 'Ville non supprimer'
                ]);
        }

    }
}
