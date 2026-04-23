<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Employee;
use App\User;
use Validator;
use DB;
use File;

class EmployeesController extends Controller
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
        $employees = Employee::all();
        return view('Employee/list_of_employees')->with('employees',$employees);
    }

    public function employeeActive(Request $request, $id)
    {
       
        Employee::whereId($id)->update($request->all());

        return response()->json(['success' => 'Data is Successfully Updated']);
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
    public function display(Request $request)
    {   
        $id=DB::table('employees')->max('id');
        return view('Employee/add_newstaff')->with('id',$id);
    }


    public function store(Request $request)
    {   
 
       
        $validator = Validator::make($request->all(), [
            'image_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
 
        
        if(!empty($_POST['image'])){
            $encoded_data = $_POST['image'];
            $binary_data = base64_decode( $encoded_data );
            $image = time().".png";
            $result = file_put_contents( 'emp_photos/'.$image, $binary_data );
        }else if($_POST['image'] == ""){
          //  $upload_image = time().'.'.$request->image_photo->getClientOriginalExtension();
            //$request->image_photo->move(public_path('emp_photos'), $upload_image);
            $image = "emp".".png";
           // $image =  'emp_photos/'.$image;
        }

       $pass = $request->input('password');
        $password = Hash::make($pass);

        $employee = new Employee;
        $employee->emp_id = $request->input('emp_id');
        $employee->first_name= $request->input('first_name');
        $employee->last_name= $request->input('last_name');
        $employee->emp_username= $request->input('emp_username');
        $employee->password= $password ;
        $employee->emp_email= $request->input('emp_email');
        $employee->emp_contact= $request->input('emp_contact');
        $employee->gender= $request->input('gender');
        $employee->Marital_status=$request->input('Marital_status');
        $employee->dob=$request->input('dob');
        $employee->designation=$request->input('designation');
        $employee->address=$request->input('address');
        $employee->blood_group=$request->input('blood_group');
        $employee->relative_name=$request->input('relative_name');
        $employee->relation=$request->input('relation');
        $employee->relative_contact=$request->input('relative_contact');
        $employee->relative_address=$request->input('relative_address');
        $employee->employee_photo= $image;
        $employee->upload_employee_photo = $image;
        
        $employee->save();
        $user = new User;
        $user->name =$request->input('first_name');
        $user->email =$request->input('emp_email');
        $user->password =$password ;
        $user->designation =$request->input('designation');
        $user->save();

        


        // User::create([
        //     'first_name'=>$request->first_name,
        //     'email'=>$request->emp_email,
        //     'password'=>$password,
        //     'designation'=>$request->designation
        //     ]);

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

    public function updateForm($id , $image )
    {

        return view('Employee/update_employee',compact('image'))->with('id',$id);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
        //return view('Employee/update_employee')->with('employee',$employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id , $image)
    {

        $employee = Employee::where('id',$id)->first();
        $update_email_foreign=$request->input('emp_email');
        $true_user_table = User::where('email',$update_email_foreign)->first();
       
       //echo $request->input('password');
        
        if(!empty($_POST['image'])){
            
            $encoded_data = $_POST['image'];
            $binary_data = base64_decode( $encoded_data );
            $image_name = time().".png";
            $result = file_put_contents( 'emp_photos/'.$image_name, $binary_data );
            $filename = public_path().'/emp_photos/'.$image;
            File::delete($filename);
            $employee->employee_photo= $image_name;
            $employee->upload_employee_photo= $image_name;
        }else if($_POST['image'] == ""){
            //$upload_image = time().'.'.$request->image_photo->getClientOriginalExtension();
            //$request->image_photo->move(public_path('emp_photos'), $upload_image);
            //$image_name =  $upload_image ;
            $image_name = "emp".".png";
            $employee->employee_photo= $image_name;
            $employee->upload_employee_photo= $image_name;

        }

        $employee->emp_id = $request->input('emp_id');
        $employee->first_name= $request->input('first_name');
        $employee->last_name= $request->input('last_name');
        $employee->emp_username= $request->input('emp_username');
       
        $dpass=$request->input('password');
        if($dpass=="1234567"){

        }else {
        $dpass=$request->input('password');
        $password = Hash::make($dpass);
        $employee->password= $password;
        $true_user_table->password= $password;
        $true_user_table->save();
        }

        $employee->emp_email= $request->input('emp_email');
        $employee->emp_contact= $request->input('emp_contact');
        $employee->gender= $request->input('gender');
        $employee->Marital_status=$request->input('Marital_status');
        $employee->dob=$request->input('dob');
        $employee->designation=$request->input('designation');
        $employee->address=$request->input('address');
        $employee->blood_group=$request->input('blood_group');
        $employee->relative_name=$request->input('relative_name');
        $employee->relation=$request->input('relation');
        $employee->relative_contact=$request->input('relative_contact');
        $employee->relative_address=$request->input('relative_address');
        
        $employee->save();
        
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
