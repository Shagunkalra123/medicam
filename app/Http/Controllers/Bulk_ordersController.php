<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Importer;
use App\MainOrder;
class Bulk_ordersController extends Controller
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
        //
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
        $validator = Validator::make($request->all(), [
           
            'file' => 'required|max:5000|mimes:xlsx'
            
          ]);
    if($validator->passes())
    {
        $uniqueval=time();
        $file=$request->file('file');
           $filename = $uniqueval.'-'.$file->getClientOriginalName();
           $savePath = public_path('/excel_uploads/');
           $file->move($savePath ,$filename);
           $excel =Importer::make('Excel');
           $excel->load($savePath.$filename);
           $collection =$excel->getCollection(); 
          // print_r($collection);
           return response()->json(['success'=>$collection]);
    }
    else{
        return redirect()->back()->with(['errors'=>$validator->errors()->all()]);
    }
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
        //
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
        //
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
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function import_file()
    {
        return view('Orders.bulk_excel');

    }
}
