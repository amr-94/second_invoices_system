<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\invoicedetails;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = invoice::all();
        return view('invoices.index', [
            'invoices' => $invoices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('invoices.create');
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


        $invoice = invoice::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_mobile' => $request->customer_mobile,
            'company_name' => $request->company_name,
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'sub_total' => $request->sub_total,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'vat_value' => $request->vat_value,
            'shipping' => $request->shipping,
            'total_due' => $request->total_due,
        ]);

        $details_list = [];
        for ($i = 0; $i < count($request->product_name); $i++) {
            $details_list[$i]['product_name'] = $request->product_name[$i];
            $details_list[$i]['unit'] = $request->unit[$i];
            $details_list[$i]['quantity'] = $request->quantity[$i];
            $details_list[$i]['unit_price'] = $request->unit_price[$i];
            $details_list[$i]['row_sub_total'] = $request->row_sub_total[$i];
        }
        $details = $invoice->details()->createMany($details_list);

        return redirect(route('invoices.index'))->with('success', "$request->invoice_number تم اضافة فاتورة جديدة");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
        $invoice = invoice::findorfail($id);
        return view('invoices.show',[
            'invoice'=>$invoice
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $invoice= invoice::findorfail($id);
        return view('invoices.edit',[
            'invoice'=>$invoice
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $invoice= invoice::findorfail($id);
        $invoice->update([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_mobile' => $request->customer_mobile,
            'company_name' => $request->company_name,
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'sub_total' => $request->sub_total,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'vat_value' => $request->vat_value,
            'shipping' => $request->shipping,
            'total_due' => $request->total_due,
        ]);
        $invoice->details()->delete();

        $details_list=[];
        for ($i = 0; $i < count($request->product_name); $i++) {
            $details_list[$i]['product_name'] = $request->product_name[$i];
            $details_list[$i]['unit'] = $request->unit[$i];
            $details_list[$i]['quantity'] = $request->quantity[$i];
            $details_list[$i]['unit_price'] = $request->unit_price[$i];
            $details_list[$i]['row_sub_total'] = $request->row_sub_total[$i];
        }
        $invoice->details()->createMany($details_list);
        return redirect(route('invoices.show',$id))->with('success', "invoice number $request->invoice_number has been updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoice $invoice)
    {
        //
    }
}
