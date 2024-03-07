@extends('layouts.app')
@section('title')
    @lang{{ __('All Invoices') }}
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h2>{{ __('All Invoices') }}</h2>
                    <a href="{{ route('invoices.create') }}" class="btn btn-primary btn-sm "><i class="fa fa-plus"></i> @lang('Create New Invoice')</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <th>@lang('customer name')</th>
                                    <th>@lang('invoice number')</th>
                                    <th>@lang('invoice_date')</th>
                                    <th>@lang('total_due')</th>
                                    <th>@lang('actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->customer_name }}
                                        </td>
                                        <td><a
                                                href="{{ route('invoices.show', $invoice->id) }}">{{ $invoice->invoice_number }}</a></td>
                                        <td>{{ $invoice->invoice_date }}</td>
                                        <td>{{ $invoice->total_due }}</td>
                                        <td>
                                            <a href="{{ route('invoices.edit', $invoice->id) }}"
                                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('invoices.destroy', $invoice->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete.form').submit();"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="post"
                                                id="delete.form" style="display: none;">
                                                @csrf
                                                @method('DELETE')

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <div class="float-right">
                                            {{-- {!! $invoices->links() !!} --}}
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
