<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;

class BranchController extends Controller
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
        $branches = Branch::all();
        return view("OrganizationForm/select_branch",compact('branches'));
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
        $branch = new Branch;
        $branch->Branch_Name = $request->input('branch_name');
        $branch->Branch_Manager= $request->input('branch_manager');
        $branch->Company= $request->input('company');
        $branch->Contact_No= $request->input('contact_no');
        $branch->GSTIN_UIN= $request->input('gst');
        $branch->Country= $request->input('country');
        $branch->State= $request->input('state');
        $branch->City= $request->input('city');
        $branch->Contact_Address= $request->input('contact_address');
        $branch->Area= $request->input('area');
        $branch->Landmark= $request->input('landmark');
        $branch->save();
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
        $branch = Branch::find($id);
        return response()->json($branch);
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
        $branch = Branch::find($id);
        $branch->Branch_Name = $request->input('branch_name');
        $branch->Branch_Manager= $request->input('branch_manager');
        $branch->Company= $request->input('company');
        $branch->Contact_No= $request->input('contact_no');
        $branch->GSTIN_UIN= $request->input('gst');
        $branch->Country= $request->input('country');
        $branch->State= $request->input('state');
        $branch->City= $request->input('city');
        $branch->Contact_Address= $request->input('contact_address');
        $branch->Area= $request->input('area');
        $branch->Landmark= $request->input('landmark');
        $branch->save();

        return response()->json(['success' => 'Branch is Successfully Updated']);
    }

    public function branchActive(Request $request, $id)
    {
       
        Branch::where('id',$id)->update($request->all());

        return response()->json(['success' => 'Data is Successfully Updated']);
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
