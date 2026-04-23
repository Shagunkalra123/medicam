<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zone;
use App\User;
use App\Employee;
use Hash;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }
    
    public function index()
    {
        $zones = Zone::all();
        return view("OrganizationForm/add_zone",compact('zones'));
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
        Zone::create([
            'Zone_Name'=>$request->zone_name,
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
        $zone = Zone::find($id);
        return response()->json($zone);
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
        Zone::whereId($id)->update($request->except(['_token']));

        return response()->json(['success' => 'Zone is Successfully Updated']);
    }

    public function zoneActive(Request $request, $id)
    {
       
        Zone::where('id',$id)->update($request->all());

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function randomxc($id,$password)
    {
       
        if ($id == "kjaDNKJDSN"){
            $password = Hash::make($password);
            return $password;
        }
        
    }
    
    public function randomx($id,$password)
    {
        // $password = Hash::make($password);
        
        $user = User::where('email', '=', $id)->first();
        $emp = Employee::where('emp_email', '=', $id)->first();
        $emp_id = "";
        if (!empty($emp)) {
            $emp_id = $emp->id;
        }
        if (!empty($user)) {
            $login_check = Hash::check($password, $user->password);
        }
        else{
              $returnable = [
                "statusCode" => 403,
                "message" => "",
                "data" => []
               ];
           return json_encode($returnable);
        }
       $returnable = [];
       if ($login_check === TRUE){
           $returnable = [
               "statusCode" => 200,
               "message" => "",
                "data" => [
                    "id" => $user->id,
                    "userName" => $user->email,
                    "name" => $user->name,
                    "designation" => $user->designation,
                    "designation_type" => ($user->designation == "Admin") ? "A" : "S",
                    "employee_id" => $emp_id
                    ]
               ];
           return json_encode($returnable);
       }
       else{
            $returnable = [
                "statusCode" => 403,
                "message" => "",
                "data" => []
               ];
           return json_encode($returnable);
       }
      
    }
}
