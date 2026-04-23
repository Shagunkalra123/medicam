<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssociationWithMedicam;

class AssociationWithMedicamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $association_with_medicams = AssociationWithMedicam::all();
        return view("OrganizationForm/add_associationwithmedicam",compact('association_with_medicams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AssociationWithMedicam::create([
            'AssociationWithMedicam_Name'=>$request->associationwithmedicam_name,
            ]);
            return response()->json(['success'=>'done']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $associationwithmedicam = AssociationWithMedicam::find($id);
        return response()->json($associationwithmedicam);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        AssociationWithMedicam::whereId($id)->update($request->except(['_token']));

        return response()->json(['success' => 'Association With Medicam is Successfully Updated']);
    }

    public function associationwithmedicamactive(Request $request, $id)
    {
       
        AssociationWithMedicam::where('id',$id)->update($request->all());

        return response()->json(['success' => 'Association With Medicam is Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
