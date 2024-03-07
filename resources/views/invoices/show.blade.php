@extends('layouts.app')
@section('title')
    @lang('invoice number') {{ $invoice->invoice_number }}
@stop
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <a href="{{ route('invoices.index') }}" class="btn btn-outline-primary "><i class="fa fa-home"></i>
                        @lang('back to invoice')</a>
                    <a href="{{ route('invoices.create') }}" class="btn btn-outline-success  "><i class="fa fa-create"></i>
                        @lang('Create New Invoice')</a>
                </div>

                <x-alert />
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>@lang('customer name')</th>
                            <td>{{ $invoice->customer_name }}</td>
                            <th>@lang('customer email')</th>
                            <td>{{ $invoice->customer_email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('customer mobile')</th>
                            <td>{{ $invoice->customer_mobile }}</td>
                            <th>@lang('company name')</th>
                            <td>{{ $invoice->company_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('invoice number')</th>
                            <td>{{ $invoice->invoice_number }}</td>
                            <th>@lang('invoice_date')</th>
                            <td>{{ $invoice->invoice_date }}</td>
                        </tr>
                    </table>

                    <h3>invoice_details</h3>

                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>@lang('product_name')</th>
                                <th>@lang('unit')</th>
                                <th>@lang('quantity')</th>
                                <th>@lang('unit_price')</th>
                                <th>@lang('product_subtotal')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->details as $details)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $details->product_name }}</td>
                                    <td>{{ $details->unit }}</td>
                                    <td>{{ $details->quantity }}</td>
                                    <td>{{ $details->unit_price }}</td>
                                    <td>{{ $details->row_sub_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <th colspan="2">@lang('sub_total')</th>
                                <td>{{ $invoice->sub_total }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <th colspan="2">@lang('discount')</th>
                                <td>{{ $invoice->discount_value }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <th colspan="2">@lang('vat_value')</th>
                                <td>{{ $invoice->vat_value }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <th colspan="2">@lang('shipping')</th>
                                <td>{{ $invoice->shipping }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <th colspan="2">@lang('total_due')</th>
                                <td>{{ $invoice->total_due }}</td>
                            </tr>

                        </tfoot>
                    </table>
                </div>

                {{-- <div class="row">
                        <div class="col-12 text-center">
                            <a href="{{ route('invoice.print', $invoice->id) }}" class="btn btn-primary btn-sm ml-auto"><i class="fa fa-print"></i> {{ __('Frontend/frontend.print') }}</a>
                            <a href="{{ route('invoice.pdf', $invoice->id) }}" class="btn btn-secondary btn-sm ml-auto"><i class="fa fa-file-pdf"></i> {{ __('Frontend/frontend.export_pdf') }}</a>
                            <a href="{{ route('invoice.send_to_email', $invoice->id) }}" class="btn btn-success btn-sm ml-auto"><i class="fa fa-envelope"></i> {{ __('Frontend/frontend.send_to_email') }}</a>
                        </div>
                    </div> --}}
            </div>
        </div>
    </div>
    <x-jq />

@endsection
