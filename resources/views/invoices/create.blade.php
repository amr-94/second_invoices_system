@extends('layouts.app')
@section('title')
    @lang('Create Invoice')
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    @lang('Create Invoice')
                     <a href="{{ route('invoices.index') }}" class="btn btn-outline-primary "><i class="fa fa-home"></i>
                        @lang('back to invoice')</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('invoices.store') }}" method="post" class="form">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_name">@lang('customer name')</label>
                                    <input type="text" name="customer_name" class="form-control">
                                    @error('customer_name')
                                        <p style="color: red"> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_email">@lang('customer email')</label>
                                    <input type="text" name="customer_email" class="form-control">
                                    @error('customer_email')
                                        <p style="color: red"> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_mobile">@lang('customer mobile')</label>
                                    <input type="text" name="customer_mobile" class="form-control">
                                    @error('customer_mobile')
                                        <p style="color: red"> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="company_name">@lang('company name')</label>
                                    <input type="text" name="company_name" class="form-control">
                                    @error('company_name')
                                        <p style="color: red"> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="invoice_number">@lang('invoice number')</label>
                                    <input type="text" name="invoice_number" class="form-control">
                                    @error('invoice_number')
                                        <p style="color: red"> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="invoice_date">@lang('invoice_date')</label>
                                    <input type="date" name="invoice_date" class="form-control">
                                    @error('invoice_date')
                                        <p style="color: red"> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table" id="invoice_details">
                                <thead>
                                    <th></th>
                                    <th>@lang('product_name')</th>
                                    <th>@lang('unit')</th>
                                    <th>@lang('quantity')</th>
                                    <th>@lang('unit_price')</th>
                                    <th>@lang('product_subtotal')</th>
                                </thead>
                                <tbody>
                                    <tr class="cloning_row" id="0">
                                        {{-- <td><button class="btn- btn-danger btn-sm delegated-btn" type="button"><i class="fa fa-minus"></i></button></td> --}}
                                        <td>#</td>
                                        <td>
                                            <input type="text" name="product_name[0]" id="product_name"
                                                class="product_name form-control">
                                        </td>
                                        <td><select name="unit[0]" id="unit" class="unit form-control">
                                                <option value=""></option>
                                                <option value="piece">piece</option>
                                                <option value="g">g</option>
                                                <option value="kg">kg</option>
                                            </select></td>
                                        <td>
                                            <input type="number" name="quantity[0]" id="quantity"
                                                class="quantity form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="unit_price[0]" id="unit_price"
                                                class="unit_price form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="row_sub_total[0]" id="row_sub_total"
                                                class="row_sub_total form-control" readonly>
                                        </td>
                                    </tr>
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
                                        <td><input type="number" name="sub_total" class="sub_total form-group"
                                                id="sub_total" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">@lang('discount')</td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <select name="discount_type" id="discount_type"
                                                    class="discount_type custom-select">
                                                    <option value="fixed">EP</option>
                                                    <option value="percentage">percentage</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <input type="number" step="0.1" id="discount_value"
                                                        name="discount_value" class="discount_value form-control">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">@lang('vat_value') </td>
                                        <td><input type="number" name="vat_value" class="vat_value form-group"
                                                id="vat_value" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">@lang('shipping')</td>
                                        <td><input type="number" name="shipping" class="shipping form-group"
                                                id="shipping" value="0.00"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">@lang('total_due')</td>
                                        <td><input type="number" name="total_due" class="total_due form-group"
                                                id="total_due" readonly></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="text-right pt-3">
                            <button type="submit" name="save" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('project_js/alljs.js') }}"></script>

    {{-- <script>



        $('#invoice_details').on('keyup blur', '.quantity, .unit_price,.discount_value,.discount_type,.shipping',
            function() {

                var quantity = parseFloat(document.getElementById("quantity").value) || 0;
                var unit_price = parseFloat(document.getElementById("unit_price").value) || 0;
                var discount_value = parseFloat(document.getElementById("discount_value").value) || 0;
                var discount_type = document.getElementById("discount_type").value;
                var shipping = parseFloat(document.getElementById("shipping").value) || 0;
                var sum_sub_total = quantity * unit_price;
                var shipping_presntage = sum_sub_total * (shipping / 100);
                var vat_value = document.getElementById("vat_value").value = (shipping_presntage).toFixed(2);
                var sum_total_due_percentage = sum_sub_total * (discount_value / 100);
                var sum_total_due_fixed = sum_sub_total - discount_value;
                var sub_total = document.getElementById("sub_total").value = (sum_sub_total).toFixed(2);
                var sub_total2 = document.getElementById("sub_total2").value = (sum_sub_total).toFixed(2);


                if (discount_type === 'percentage') {
                    document.getElementById("total_due").value = (sum_sub_total - sum_total_due_percentage +
                        shipping_presntage).toFixed(2);
                } else {
                    document.getElementById("total_due").value = (sum_total_due_fixed + shipping_presntage).toFixed(2);
                }
                // ===========================================

            });


    </script> --}}
@endsection
