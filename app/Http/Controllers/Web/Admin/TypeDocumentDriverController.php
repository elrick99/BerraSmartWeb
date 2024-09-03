<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeDocumentDriverRequest;
use App\Http\Requests\UpdateTypeDocumentDriverRequest;
use App\Models\TypeDocumentDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {
        $rules = [
            'libelle' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:1,0'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $request->session()->put('data', $request->input());
            return redirect()->back()->withErrors($validator)
                ->withInput((array)$request->session()->put('data', $request->input()));
        }else{
            $data = $request->all();
            $data['libelle'] = strtoupper($data['libelle']);
            if (isset($data['has_expiry_date'])) {
                $data['has_expiry_date'] = 1;
            }else{
                $data['has_expiry_date'] = 0;
            }
//        $data['has_expiry_date'] = ($data['has_expiry_date'] == 'on') ? 1 : 0;
//            dd($data);
            $status = TypeDocumentDriver::create($data);
            if($status){
                Session::flash('message', 'Type Document Driver creer avec succes');
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('type_document_driver.index')->with('success', 'Type Document Driver creer avec succes');
            }else{
                return back()->with('error', 'Type Document Driver non creer');
            }
        }


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
        return view('backend.type_document_driver.edit', compact('typeDocumentDriver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeDocumentDriver $typeDocumentDriver)
    {
        $rules = [
            'libelle' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:1,0'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $request->session()->put('data', $request->input());
            return redirect()->back()->withErrors($validator)
                ->withInput((array)$request->session()->put('data', $request->input()));
        }else{
            $typeDocumentDriver->libelle = strtoupper($request->libelle);
            $typeDocumentDriver->description = $request->description;
            if ($request->has_expiry_date) {
                $typeDocumentDriver->has_expiry_date = 1;
            }else{
                $typeDocumentDriver->has_expiry_date = 0;
            }
            $typeDocumentDriver->status = $request->status;
            $status = $typeDocumentDriver->save();
            if($status){
                Session::flash('message', 'Type Document Driver modifier avec succes');
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('type_document_driver.index')->with('success', 'Type Document Driver modifier avec succes');
            }else{
                return back()->with('error', 'Type Document Driver non modifier');
            }
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $typeDocumentDriver = TypeDocumentDriver::find($id);
        $status = $typeDocumentDriver->delete();
        if($status){
            echo json_encode([
                'statusCode'=>200,
                'message'=>'Type Document Driver supprimer avec succes'
            ]);
        }else{
            echo json_encode([
                'statusCode'=>500,
                'message'=>'Type Document Driver non supprimer'
            ]);
        }
    }
}
