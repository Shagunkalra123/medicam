<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReferredBy;

class ReferredByController extends Controller
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
        $referred_bies = ReferredBy::all();
        return view("EnquiryForm/add_referredby",compact('referred_bies'));
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
        ReferredBy::create([
            'ReferredBy_Name'=>$request->referredby_name,
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
        $referredby = ReferredBy::find($id);
        return response()->json($referredby);
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
        ReferredBy::whereId($id)->update($request->except(['_token']));

        return response()->json(['success' => 'State is Successfully Updated']);
    }

    public function referredbyactive(Request $request, $id)
    {
       
        ReferredBy::where('id',$id)->update($request->all());

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
