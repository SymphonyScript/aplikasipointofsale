@extends('layouts.master')
@section('title') Pembelian @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Pembelian @endslot
        @slot('add') {{ $createLink }} @endslot
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
                                <th scope="col">Kode Pembelian</th>
                                <th scope="col">Item(s)</th>
                                <th scope="col">Total</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Alamat</th>
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
                                    <td>{{ @$transaction->supplier->name }}</td>
                                    <td>{{ @$transaction->supplier->address }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('stock.purchasing.show', $transaction) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-eye"></i></a>
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
