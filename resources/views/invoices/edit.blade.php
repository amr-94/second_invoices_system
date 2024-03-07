@extends('layouts.app')
@section('title')
    @lang('invoice edit')
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
<a href="{{ route('invoices.index') }}" class="btn btn-outline-primary "><i class="fa fa-home"></i>
                        @lang('back to invoice')</a>
                    <a href="{{ route('invoices.create') }}" class="btn btn-outline-success  "><i class="fa fa-create"></i>
                       @lang('Create New Invoice')</a>                </div>

                <div class="card-body">
                    <form action="{{ route('invoices.update', $invoice->id) }}" method="post" class="form">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_name">@lang('customer name')</label>
                                    <input type="text" name="customer_name" value="{{  $invoice->customer_name }}" class="form-control">
                                    @error('customer_name')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_email">@lang('customer email')</label>
                                    <input type="text" name="customer_email" value="{{  $invoice->customer_email }}" class="form-control">
                                    @error('customer_email')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_mobile">@lang('customer mobile')</label>
                                    <input type="text" name="customer_mobile" value="{{  $invoice->customer_mobile }}" class="form-control">
                                    @error('customer_mobile')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="company_name">@lang('company name')</label>
                                    <input type="text" name="company_name" value="{{  $invoice->company_name }}" class="form-control">
                                    @error('company_name')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="invoice_number">@lang('invoice number')</label>
                                    <input type="text" name="invoice_number" value="{{  $invoice->invoice_number }}" class="form-control">
                                    @error('invoice_number')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="invoice_date">@lang('invoice_date')</label>
                                    <input type="text" name="invoice_date" value="{{ $invoice->invoice_date }}" class="form-control pickdate">
                                    @error('invoice_date')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table" id="invoice_details">
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
                                @foreach($invoice->details as $details)
                                <tr class="cloning_row" id="{{ $details->id }}">
                                    <td>
                                        @if($loop->index == 0)
                                        {{ '#' }}
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="product_name[{{ $loop->index }}]" id="product_name" value="{{  $details->product_name }}" class="product_name form-control">
                                        @error('product_name')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </td>
                                    <td>
                                        <select name="unit[{{ $loop->index }}]" id="unit" class="unit form-control">
                                            <option></option>
                                            <option value="piece" {{ $details->unit == 'piece' ? 'selected' : '' }}>piece</option>
                                            <option value="g" {{ $details->unit == 'g' ? 'selected' : '' }}>g</option>
                                            <option value="kg" {{ $details->unit == 'kg' ? 'selected' : '' }}>kg</option>
                                        </select>
                                        @error('unit')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[{{ $loop->index }}]" step="0.01" id="quantity" value="{{  $details->quantity }}" class="quantity form-control">
                                        @error('quantity')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </td>
                                    <td>
                                        <input type="number" name="unit_price[{{ $loop->index }}]" step="0.01" id="unit_price" value="{{  $details->unit_price }}" class="unit_price form-control">
                                        @error('unit_price')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" name="row_sub_total[{{ $loop->index }}]" id="row_sub_total" value="{{ $details->row_sub_total }}" class="row_sub_total form-control" readonly="readonly">
                                        @error('row_sub_total')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <button type="button" class="btn_add btn btn-primary">@lang('Add another product')</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">@lang('sub_total')</td>
                                    <td><input type="number" step="0.01" name="sub_total" id="sub_total" value="{{  $invoice->sub_total }}" class="sub_total form-control" readonly="readonly"></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">@lang('discount')</td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <select name="discount_type" id="discount_type" class="discount_type custom-select">
                                                <option value="fixed" {{ $invoice->discount_type == 'fixed' ? 'selected' : '' }}>ep</option>
                                                <option value="percentage" {{ $invoice->discount_type == 'percentage' ? 'selected' : '' }}>percentage</option>
                                            </select>
                                            <div class="input-group-append">
                                                <input type="number" step="0.01" name="discount_value" id="discount_value" value="{{  $invoice->discount_value }}" class="discount_value form-control" value="0.00">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">@lang('vat_value')</td>
                                    <td><input type="number" step="0.01" name="vat_value" id="vat_value" value="{{  $invoice->vat_value }}" class="vat_value form-control" readonly="readonly"></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">@lang('shipping')</td>
                                    <td><input type="number" step="0.01" name="shipping" id="shipping" value="{{  $invoice->shipping }}" class="shipping form-control"></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">@lang('total_due')</td>
                                    <td><input type="number" step="0.01" name="total_due" id="total_due" value="{{ $invoice->total_due }}" class="total_due form-control" readonly="readonly"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="text-right pt-3">
                            <button type="submit" name="save" class="btn btn-primary">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')


    <script src="{{ asset('project_js/alljs.js') }}"></script>

@endsection


