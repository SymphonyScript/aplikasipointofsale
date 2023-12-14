@extends('layouts.master')
@section('title') Stock Out  @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Tambah Stock Out  @endslot
        @slot('return') {{ $indexLink }}  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $storeLink }}" method="post" class="row g-2">
                        @csrf
                        <div class="col-md-4 form">
                            <label for="input-item" class="form-label">Item</label>
                            <select class="js-example-basic-single" name="item_id">
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 form">
                            <label for="input-supplier" class="form-label">Supplier</label>
                            <select class="js-example-basic-single" name="supplier_id">
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 form">
                            <label for="input-qty" class="form-label">Qty</label>
                            <input type="number" name="qty" class="form-control" id="input-qty" placeholder="Qty" required>
                        </div>
                        <div class="col-md-12 form">
                            <label for="input-description" class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" id="input-description" rows="3"></textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success float-end"><i class="mdi mdi-send"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
