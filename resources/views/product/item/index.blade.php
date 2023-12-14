@extends('layouts.master')
@section('title') Item @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Item @endslot
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
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ @$item->unit->name }}</td>
                                    <td>{{ @$item->category->name }}</td>
                                    <td>{{ rp_format($item->price) }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>
                                        <a href="{{ route('product.item.qr', $item) }}" class="btn btn-sm btn-primary"><i class="mdi mdi-qrcode"></i></a>
                                        <a href="{{ route('product.item.edit', $item) }}" class="btn btn-sm btn-warning"><i class="mdi mdi-pen"></i></a>
                                        <a href="{{ route('product.item.delete', $item) }}" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-end mt-3">
                        {{ $items->appends(Request::except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
