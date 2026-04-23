<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Client;
use Sunra\PhpSimple\HtmlDomParser;
use App\IndiaMart;
use DB;
use App\Product;
use App\EnquiryDataSource;
use App\ReferredBy;
use App\EnquiryType;
use App\Employee;
use Carbon\Carbon;
class IndiaMartController extends Controller
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
        // $html_array=array();
        // set_time_limit(200);
        // $oClient = new Client([
        //     'host'          => 'imap.hostinger.com',
        //     'port'          => 993,
        //     'encryption'    => 'ssl',
        //     'validate_cert' => false,
        //     'username'      => 'indiamart@hemantmedicam.com',
        //     'password'      => 'India@321',
        //     'protocol'      => 'imap'
        // ]);
        // /* Alternative by using the Facade
        // $oClient = Webklex\IMAP\Facades\Client::account('default');
        // */
        // //Connect to the IMAP Server
        // $connected=$oClient->connect();
        // //Get all Mailboxes
        // /** @var \Webklex\IMAP\Support\FolderCollection $aFolder */
        // $aFolder = $oClient->getFolders();
        // // dd($aFolder);
        // //Loop through every Mailbox
        // /** @var \Webklex\IMAP\Folder $oFolder */
        // foreach($aFolder as $oFolder){
        
        //     //Get all Messages of the current Mailbox $oFolder
        //     /** @var \Webklex\IMAP\Support\MessageCollection $aMessage */
        //     //$aMessage = $oFolder->messages()->all()->get();
        //     $aMessage = $oFolder->query()->from('indiamart@hemantmedicam.com')->get();
        //     //$aMessage = $oFolder->query()->from('buyleads@indiamart.com')->get();
        //     /** @var \Webklex\IMAP\Message $oMessage */
        //     foreach($aMessage as $oMessage){
        //        // $dom = HtmlDomParser::str_get_html( $oMessage->getHTMLBody(true) );
        //         //Move the current Message to 'INBOX.read'
        //         // dump($oMessage->moveToFolder('INBOX.Junk'));
        //                 if($oMessage->moveToFolder('INBOX.Junk') == true){
        //                     $html_body_single= $oMessage->getHTMLBody();
        //                         if( !in_array($html_body_single, $html_array))
        //                         {
        //                             array_push($html_array,$html_body_single);
        //                         }
        //                     foreach($html_array as $single_body)
        //                     {   
        //                         //description     
        //                         if(strpos($single_body,'looking for')){                 
        //                             $table_split=explode("looking for",$single_body);
        //                             $test_description= $table_split[1];
        //                             $test_description1= explode('.',$test_description);
        //                             $test_description2= $test_description1[0];
        //                             $test_description1= explode('</strong>',$test_description2);
        //                             $test_description= strip_tags($test_description1[0]); 
        //                             $test_description= trim($test_description,' " ');   
        //                             $description= $test_description;
        //                         }elseif(strpos($single_body,'I need')){
        //                             $table_split=explode("I need",$single_body);
        //                             $test_description= $table_split[1];
        //                             $test_description1= explode('.',$test_description);
        //                             $test_description2= $test_description1[0];
        //                             $test_description1= explode('</strong>',$test_description2);
        //                             $test_description= strip_tags($test_description1[0]); 
        //                             $test_description= trim($test_description,' " ');   
        //                             $description= $test_description;
        //                         }elseif(strpos($single_body,'A buyer has sent you an enquiry for')){
        //                             $table_split=explode("A buyer has sent you an enquiry for",$single_body);
        //                             $test_description= $table_split[1];
        //                             $test_description1= explode('.',$test_description);
        //                             $test_description2= $test_description1[0];
        //                             $test_description1= explode('</strong>',$test_description2);
        //                             $test_description= strip_tags($test_description1[0]); 
        //                             $test_description= trim($test_description,' " ');   
        //                             $description= $test_description;
        //                         }
        //                         //address
        //                         $regards_address=1;
        //                         if(strpos($single_body,'Regards,')){ 
                                  
        //                             $buyer_details=  explode("Regards,",$single_body);
        //                             $first_index_buyer=$buyer_details[1];
        //                             $test= explode('</span>',$first_index_buyer);
        //                             $test= explode('<span',$test[0]);
        //                             $test= explode('">',$test[1]);
        //                             $address = $test[1];
        //                             $regards_address=0;
        //                             if(str_word_count($address)<=2){
        //                                 $buyer_details=  explode("Regards",$single_body);
        //                                 $first_index_buyer=$buyer_details[1];
        //                                 $test_address= explode('</span>',$first_index_buyer);
        //                                 $new_test_address=$test_address[1];                                
        //                                 $new_test_address=explode('">',$new_test_address);
        //                                 $address= $new_test_address[2];
        //                                 $regards_address=1;
        //                             }
        //                         }else{
        //                             $buyer_details=  explode("Regards",$single_body);
        //                             $first_index_buyer=$buyer_details[1];
        //                             $test_address= explode('</span>',$first_index_buyer);
        //                             $new_test_address=$test_address[1];                                
        //                             $new_test_address=explode('">',$new_test_address);
        //                             $address= $new_test_address[2];
        //                         }
                               
        //                         //byer name 
        //                         if(strpos($single_body,'Regards')&& $regards_address){    
        //                             $buyer_details=  explode("Regards",$single_body);
        //                             $first_index_buyer=$buyer_details[1];
        //                             $test= explode('</span>',$first_index_buyer);
        //                             $test= explode('<span',$test[0]);
        //                             $test= explode('">',$test[1]);
        //                             $byer_name = $test[1];
        //                         }else{
        //                             $byer_name = "";
        //                         }
                               
        //                         //mobile
        //                         if(strpos($single_body,'Mobile')){ 
        //                         $buyer_details= explode("Mobile",$first_index_buyer);
        //                         if(isset($buyer_details[1])){
        //                             $trpostion= substr($first_index_buyer, strpos($first_index_buyer, "Mobile:") + 1);
        //                             $test_address= explode('obile:',$trpostion);  
        //                             $mobile= $test_address[1];
        //                             $mobile= explode('">+',$mobile); 
        //                             $mobile= explode('</a>',$mobile[1]); 
        //                             $mobile = $mobile[0]; 
        //                             if(strpos($mobile,')-')){
        //                                 $number= explode(')-',$mobile); 
        //                                 $country_code= explode('(',$number[0]);
        //                                 $country_code=$country_code[1];
        //                                 $mobile= "+".$country_code.$number[1];
        //                             }
        //                         }
        //                         }elseif(strpos($single_body,'call')){
        //                         $buyer_details=  explode("Regards,",$single_body);
        //                         $first_index_buyer=$buyer_details[1];
        //                         $buyer_details= explode("call",$first_index_buyer);
        //                         if(isset($buyer_details[1])){
        //                             $trpostion= substr($first_index_buyer, strpos($first_index_buyer, "call:") + 1);
        //                             $test_address= explode('all:',$trpostion);  
        //                             $mobile= $test_address[1];
        //                             $mobile= explode('">+',$mobile); 
        //                             $mobile= explode('</a>',$mobile[1]); 
        //                             $mobile = $mobile[0]; 
        //                         }
        //                     }
                            
        //                     if(strpos($single_body,'Email')){ 
        //                         // if(isset($buyer_details[1])){
        //                         //  echo"<pre>";print_r($buyer_details);exit;
        //                         // }
        //                         $test_email1="";
        //                         //email
        //                         $buyer_details= explode("Email",$first_index_buyer);
        //                         if(isset($buyer_details[1])){
        //                             $trpostion= substr($first_index_buyer, strpos($first_index_buyer, "Email:") + 1);
        //                             $test_email = explode('mail:', $trpostion);
        //                             $test_email=  $test_email[1];
        //                             $test_email= explode ('">', $test_email);
        //                             $test_email1= explode('</a>',$test_email[1]) ?? ""; 
        //                             $true_mail1=$test_email1[0];
        //                             if(strpos($true_mail1,'@')){
        //                                 $true_mail1= $true_mail1;
        //                             }else{
        //                                 $true_mail1="";
        //                             }
        //                             if(strpos($test_email[2],'@')){
        //                                 $test_email2= explode('</a>',$test_email[2]) ?? ""; 
        //                                 $true_mail2=$test_email2[0];
        //                             }
        //                         }
        //                     }
        //                     if (strpos($single_body,'piece')) {
        //                       //quantity
        //                       $quantity=1;
        //                       $table_split=explode("piece",$single_body);   
        //                       if(isset($table_split)){
        //                           $data = explode('>', $table_split[0]);
        //                           $quantity=trim(end($data));
        //                       }
        //                     }elseif(strpos($single_body,'Quantity')){
        //                         $table_split=explode("Quantity",$single_body);
        //                         $table_split=explode('2px;">',$table_split[2]);   
        //                         $table_split=explode('<',$table_split[1]);
        //                         $quantity= $table_split[0];
        //                     }else{
        //                         $quantity=1;
        //                     }
        //                     dump($description);
        //                     dump($address);
        //                     dump($byer_name);
        //                     dump($mobile);
        //                     dump($true_mail1);
        //                     dump($quantity);
        //                        //saving data
        //                        $india_marts= new IndiaMart;
        //                        $india_marts->byer_name = $byer_name;
        //                        $india_marts->address = $address;
        //                        $india_marts->mobile = $mobile;
        //                        $india_marts->email = $true_mail1;
        //                        $india_marts->description = $description;
        //                        $india_marts->quantity = $quantity;
        //                        $india_marts->save();     
        //                        if(isset($true_mail2) && !empty($true_mail2)){
        //                         //saving data for 2nd mail
        //                         $india_marts= new IndiaMart ;
        //                         $india_marts->byer_name = $byer_name;
        //                         $india_marts->address = $address;
        //                         $india_marts->mobile = $mobile;
        //                         $india_marts->email = $true_mail2;
        //                         $india_marts->description = $description;
        //                         $india_marts->quantity = $quantity;
        //                         $india_marts->save();     
        //                        }               
        //                        //taking data
        //                        $indiamart_datas = IndiaMart::all();
        //                     //    $Organisation_true = DB::table('clients')->get();
        //                        $Assign_toID = Employee::all();
        //                        $productID = Product::all();
        //                        return view('indiamart/list_indiamart_enquires',compact('Assign_toID','productID'))->with('indiamart_datas',$indiamart_datas);                             
        //                     }
                                
                             
                          
       
        //          }else{
        //             $Organisation_true = DB::table('clients')->get();
        //             $indiamart_datas = IndiaMart::all();
        //             $Assign_toID = Employee::all();
        //             $productID = Product::all();
        //             return view('indiamart/list_indiamart_enquires',compact('Assign_toID','productID'))->with('indiamart_datas',$indiamart_datas);
        //                 }
        //             }
                   
        //         }
                // dd("2nd");
                $Organisation_true = DB::table('clients')->get();
                $indiamart_datas = IndiaMart::all();
                $Assign_toID = Employee::all();
                $productID = Product::all();
                return view('indiamart/list_indiamart_enquires',compact('Assign_toID','productID'))->with('indiamart_datas',$indiamart_datas);
                                     //$count=0;
            }
          
       
      
    

   public function fetch_data(Request $request)
    {
      $from_date= date('Y-m-d H:i:s', strtotime($request->from_date));
 $to_date= date('Y-m-d H:i:s', strtotime($request->to_date));
     if($request->ajax())
     {
      if($request->from_date != '' &&  $request->to_date != '')
      {
       $data = DB::table('india_marts')
         ->whereBetween('created_at', array($from_date, $to_date))
         ->get();
      }
      else
      {
       $data = DB::table('india_marts')->orderBy('created_at', 'desc')->get();
      }
      echo json_encode($data);
     }
    }



    public function createEnquery($enqid)
    {
        $indiamart = IndiaMart::where('id', $enqid);
       
        $productID = Product::all();
        $enquiry_data_sources = EnquiryDataSource::where('is_active','1')->get();
       $referred_bies=ReferredBy::where('is_active','1')->get();
       $enquiry_types=EnquiryType::where('is_active','1')->get();
       $Assign_toID = Employee::all();
        return view('enquiry.createIndiaMartEnq',compact('productID','enquiry_data_sources','referred_bies','enquiry_types','Assign_toID'))->with('indiamart',$indiamart);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $indiamart_datas = IndiaMart::whereDate('created_at', Carbon::today())->get();
        $enq_count= $indiamart_datas->count();
        return response()->json($enq_count);
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
    public function count()
    {
        $meeting_data=array();
        $meeting_Data["01"]=0;
        $meeting_Data["02"]=0;
        $meeting_Data["03"]=0;
        $meeting_Data["04"]=0;
        $meeting_Data["05"]=0;
        $meeting_Data["06"]=0;
        $meeting_Data["07"]=0;
        $meeting_Data["08"]=0;
        $meeting_Data["09"]=0;
        $meeting_Data["10"]=0;
        $meeting_Data["11"]=0;
        $meeting_Data["12"]=0;
        $Meetings = IndiaMart::select('id', 'created_at')->get();
        foreach($Meetings as $singlemeet)
        {   
            if(!empty($singlemeet->created_at)){
                $month_in_loop=  explode(" ",$singlemeet->created_at);
                $month_in_loop= $month_in_loop[0];
                $month_in_loop=explode("-",$month_in_loop);
                $month_in_loop=$month_in_loop[1];
                $month_value=$meeting_Data[$month_in_loop];
                $month_value=$month_value+1;
                $meeting_Data[$month_in_loop]=$month_value;
            }
        }
      
        return response()->json($meeting_Data);
    }
    
}
