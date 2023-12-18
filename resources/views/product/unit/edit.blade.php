@extends('layouts.master')
@section('title') Ukuran @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Tambah Ukuran @endslot
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
                            <label for="input-name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="input-name" placeholder="Nama" required value="{{ $unit->name }}">
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
