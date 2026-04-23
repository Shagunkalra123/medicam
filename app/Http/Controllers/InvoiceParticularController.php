<?php

namespace App\Http\Controllers;

use App\InvoiceParticular;
use Illuminate\Http\Request;
use App\MainOrder;
use App\OrderParticular;
use App\Invoice;

class InvoiceParticularController extends Controller
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
    public function store(Request $request,$id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvoiceParticular  $invoiceParticular
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceParticular $invoiceParticular)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoiceParticular  $invoiceParticular
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceParticular $invoiceParticular)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceParticular  $invoiceParticular
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceParticular $invoiceParticular)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceParticular  $invoiceParticular
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceParticular $invoiceParticular)
    {
        //
    }
}
