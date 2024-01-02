@extends('layouts.master')
@section('title') Struk Pembelian @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Struk Pembelian @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <table class="table align-middle table-nowrap mb-0">
                        <tr>
                            <td>Tanggal</td>
                            <td>: {{ parse_date_time($purchasing->created_at) }}</td>
                            <td>Supplier</td>
                            <td>: {{ @$purchasing->supplier->name }}</td>
                        </tr>
                        <tr>
                            <td>Kode Pembelian</td>
                            <td>: {{ $purchasing->code }}</td>
                            <td>Alamat Supplier</td>
                            <td>: {{ @$purchasing->supplier->address }}</td>
                        </tr>
                    </table>
                    <table class="table align-middle table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchasing->items as $purchasing)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $purchasing->item->code }}</td>
                                    <td>{{ $purchasing->item->name }}</td>
                                    <td>{{ rp_format($purchasing->price) }}</td>
                                    <td>{{ $purchasing->qty }}</td>
                                    <td>{{ rp_format($purchasing->total) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light" id="content">
                            <tr>
                                <td colspan="5">Total</td>
                                <td colspan="1">
                                    {{ rp_format($purchasing->total) }}
{{--                                    <input class="form-control" type="text" name="grand_total" id="grand_total">--}}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
