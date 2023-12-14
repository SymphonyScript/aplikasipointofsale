@extends('layouts.master')
@section('title') Item @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Tambah Item @endslot
        @slot('return') {{ $indexLink }}  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $updateLink }}" method="POST" class="row g-2">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12 form">
                            <label for="input-code" class="form-label">Kode</label>
                            <input type="text" name="code" class="form-control" id="input-code" placeholder="Kode" required value="{{ $item->code }}">
                        </div>
                        <div class="col-md-12 form">
                            <label for="input-name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="input-name" placeholder="Nama" required value="{{ $item->name }}">
                        </div>
                        <div class="col-md-12 form">
                            <label for="input-price" class="form-label">Harga</label>
                            <input type="number" name="price" class="form-control" id="input-price" placeholder="Harga" required value="{{ $item->price }}">
                        </div>
                        <div class="col-md-6 form">
                            <label for="input-category" class="form-label">Kategori</label>
                            <select class="js-example-basic-single" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($item->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form">
                            <label for="input-unit" class="form-label">Unit</label>
                            <select class="js-example-basic-single" name="unit_id">
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}" @if($item->unit_id == $unit->id) selected @endif>{{ $unit->name }}</option>
                                @endforeach
                            </select>
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
