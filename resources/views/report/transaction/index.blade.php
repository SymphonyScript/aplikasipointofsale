@extends('layouts.master')
@section('title') Laporan Penjualan  @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Laporan Penjualan  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <table class="table align-middle table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nota</th>
                                <th scope="col">Item(s)</th>
                                <th scope="col">Total</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Kasir</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ parse_date_time($transaction->created_at) }}</td>
                                    <td>{{ $transaction->code }}</td>
                                    <td>
                                        <table class="table table-hover table-nowrap mb-0">
                                        @foreach($transaction->items as $item)
                                            <tr>
                                                <td>{{ $item->item->name }}</td>
                                                <td><span class="badge badge-gradient-primary">{{ $item->qty }}</span></td>
                                                <td>{{ rp_format($item->total) }}</td>
                                            </tr>
                                        @endforeach
                                        </table>
                                    </td>
                                    <td>{{ rp_format($transaction->total) }}</td>
                                    <td>{{ @$transaction->customer->name }}</td>
                                    <td>{{ @$transaction->cashier->name }}</td>
                                    <td>
{{--                                        <a href="{{ route('customer.edit', $user) }}" class="btn btn-sm btn-warning"><i class="mdi mdi-pen"></i></a>--}}
                                        <a href="{{ route('transaction.delete', $transaction) }}" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-end mt-3">
                        {{ $transactions->appends(Request::except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
