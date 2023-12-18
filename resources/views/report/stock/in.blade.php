@extends('layouts.master')
@section('title') Laporan Stock In @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Laporan Stock In @endslot
        @slot('exportPDF') {{ route('report.stock.in',['download_type' => 'PDF']) }} @endslot
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
                                <th scope="col">Kode</th>
                                <th scope="col">Item</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Supplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocks as $stock)
                                <tr>
                                    <td>{{ parse_date_time($stock->created_at) }}</td>
                                    <td>{{ @$stock->item->code }}</td>
                                    <td>{{ @$stock->item->name }}</td>
                                    <td>{{ $stock->description }}</td>
                                    <td>{{ $stock->qty }}</td>
                                    <td>{{ @$stock->supplier->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-end mt-3">
                        {{ $stocks->appends(Request::except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
