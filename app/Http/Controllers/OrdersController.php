<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MainOrder;
use App\OrderParticular;
use App\client;
use App\Product;
use App\Proposal;
use App\prop_product;
use App\ViewList;


class OrdersController extends Controller
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
    
    public function index($enqid,$proid1,$Entid2)
    {   
        if($enqid == "0" && $proid1 == "0" && $Entid2 == "0"){
            $ProposalEntry='2';
            $organisations = client::all();
            $products = Product::all();
            $enqId = 0;
            $proID = 0;
            return view('Orders/create_order',compact('organisations','products','ProposalEntry','enqId','proID'));
        }
        else{
            $enqId = $enqid;
            $proID = $proid1;
            $ProposalEntry = $Entid2;
            $products = Product::all();
            $organisations = client::all();
            $proposal = Proposal::where('id',$proid1)->first();
            $prop_product = prop_product::where('proposal_id',$proid1)->get();
            return view('Orders/create_order_for_proposal',compact('prop_product','enqId','organisations','ProposalEntry','proID','proposal'))->with('products',$products);
        }
        
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
                $order = new MainOrder;
                $order->contact_person_name = $request->contact_person_name;
                $order->org_id = $request->hidden_orgid;
                $order->organization_name = $request->organization_name1;
                $order->mobile_number = $request->mobile_num;
                $order->email_id = $request->email_id;
                $order->address = $request->address;
                $order->subtotal = $request->sub_total;
               
                $order->Warranty_date = $request->Warranty_date;
                $order->grand_total = $request->total_amount;
                $order->enqid_hidden = $request->enqid_hidden;
                $order->entryLevelHidden = $request->entryLevelHidden;
                $order->proposalIDHidden = $request->proposalIDHidden;
                $order->pono = $request->pono;

                if($order->save()){

                    foreach($request->product as $key=>$value){
                        $data = array(
                            'products' => $value,
                            'qty' => $request->qty[$key],
                            'sgst'=> $request->tax_sgst[$key],
                            'igst' => $request->tax_igst[$key],  
                            'cgst' => $request->tax_cgst[$key],  
                            'discount' => $request->discount[$key],  
                            'price' => $request->price[$key],
                            'total' => $request->total[$key],
                            'orders_id' => $order->id
                        );
                        OrderParticular::insert($data);  
                    }
                }

                  
    }



public function storeview(Request $request)
    {
        $user = Auth::user();
                $viewlist = new ViewList;
                $viewlist->view_name = $request->view_name;
                $viewlist->view_code = $request->view_code;
                $viewlist->page_name = $request->view_key;
                $viewlist->user_id = $user->id;
                $viewlist->username = $user->email;
                

                try {
                    $viewlist->save();
                    return response()->json(['success' => 'success']);
                }
                catch(\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == '1062'){
                        return response()->json(['success'=>'Duplicate entry']);
                    }
                }
               
    }
    public function invoiceCreated(Request $request, $id)
    {
       
        MainOrder::whereId($id)->update($request->all());

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

   

    public function orderActive(Request $request, $id)
    {
       
        MainOrder::whereId($id)->update($request->all());

        return response()->json(['success' => 'Data is Successfully Updated']);
    }

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
    
    public function price($id)
    {
        $product = Product::find($id);
        $product_price = $product->price;
        return response()->json($product_price);
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
