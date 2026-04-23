<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;
use Carbon\Carbon;
use App\User;
use Auth;
use App\enquiry;

use DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $comment = new Comment;
        $comment->comments = $request->comment;
        $comment->nature = $request->browser_modal;
        $comment->enquery_id = $request->enq_id;
        $loged_in_name = Auth::user()->name;
        $loged_in_email = Auth::user()->email;
        $comment->username = $loged_in_name;
        $comment->useremail = $loged_in_email;
        $comment->save();
        
        $com_id = DB::getPdo()->lastInsertId();
        $data = DB::table('comments')->select('*')->where('id', $com_id)->first();
        $date= Carbon::parse($data->created_at)->format('d/m/Y H:i:s');
        //$user = DB::table('users')->select('*')->get();
        //cho $date_for;
       $enquiry_nature= enquiry::where('id',$request->enq_id)->update(['lastvaluekey' => $com_id]);

        //Comment::where('comments', $com_id)->get();
       
       
        //return response()->json(['data'=>$data,'date'=>$date,'user'=>$user]); 
        return response()->json(['data'=>$data,'date'=>$date]); 

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
}
