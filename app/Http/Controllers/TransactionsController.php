<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\MainOrder;
use App\OrderParticular;
use App\InvoiceParticular;
use PDF;
use stdClass;
use DB;

class TransactionsController extends Controller
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
    
    public function index($id)
    {
        $transactions = Transaction::find($id);
        return response()->json($transactions);
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
        $transaction = new Transaction;
        $transaction->amount_recieved = $request->amount_recieved;
        $transaction->transaction_id = $request->transaction_id;
        $transaction->payment_date = $request->payment_date;
        $transaction->payment_mode = $request->payment_mode;
        $transaction->leave_note = $request->leave_note;
        $transaction->invoice_id = $request->hidden_inv_id;
        $transaction->save();

        return response()->json(['success','Transaction saved succefully']);
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
        $transactions = DB::table('transactions')->where('invoice_id', $id)->get();
        return response()->json($transactions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$t,$pdf)
    {
        $transactions = DB::table('transactions')->where('invoice_id', $id)->get();
        $invoices =  DB::table('transactions')->where('invoice_id', $id)->get();
        $paid = $transactions->amount_recieved;
        $balance = 
        DB::table('users')->where('id', 1)->update(['votes' => 1]);
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

    public function invoiceTransPdf(Request $request,$id,$pdf,$ord_id)
    {
        $final_data=[];
        $order=MainOrder::where('id',$ord_id)->get();
        print_r($order);
        $orderparticulars = OrderParticular::where('orders_id',$ord_id)->get();
        $inv_id_old=DB::table('invoices')->max('id');
        if($inv_id_old == null || $inv_id_old == ""){
            $inv_id=0;
        }else{
            $inv_id=$inv_id_old;
        }

        $total_qty = DB::table('order_particulars')->where('orders_id', $id)->sum('qty');
        $sum_of_all_prices = DB::table('order_particulars')->where('orders_id', $id)->sum('price');
        $sum_of_all_total =  DB::table('order_particulars')->where('orders_id', $id)->sum('total');
        $transactions =  DB::table('transactions')->where('invoice_id', $id)->get();

       $t= time().'.pdf';
       $id1 = $id;
       $pdf = PDF::loadView('invoice.invoiceTransPdf', array('pdfdata' => $order,'finaldata'=>$orderparticulars,'inv_id'=>$inv_id,'sum_qty'=>$total_qty,'sum_price'=>$sum_of_all_prices,'sum_total'=>$sum_of_all_total,'transactions'=>$transactions));
       $pdf->save('InvoicePDF/'.$t);
       return $this->update($id1,$t,$pdf);
    }

}
