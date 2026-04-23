<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EnquiryType;

class EnquiryTypeController extends Controller
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
        $enquiry_types = EnquiryType::all();
        return view("EnquiryForm/add_enquirytype",compact('enquiry_types'));
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
        EnquiryType::create([
            'EnquiryType_Name'=>$request->enquirytype_name,
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
        $enquirytype = EnquiryType::find($id);
        return response()->json($enquirytype);
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
        EnquiryType::whereId($id)->update($request->except(['_token']));

        return response()->json(['success' => 'Data Source is Successfully Updated']);
    }

    public function enquirytypeactive(Request $request, $id)
    {
       
        EnquiryType::where('id',$id)->update($request->all());

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
