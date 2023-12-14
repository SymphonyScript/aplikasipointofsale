@extends('layouts.master')
@section('title') Supplier  @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Tambah Supplier  @endslot
        @slot('return') {{ $indexLink }}  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $updateLink }}" method="POST" class="row g-2">
                        @csrf
                        @method('PUT')
                        <div class="col-md-4 form">
                            <label for="input-name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="input-name" placeholder="Nama" required  value="{{ $customer->name }}">
                        </div>
                        <div class="col-md-4 form">
                            <label for="input-gender" class="form-label">Kelamin</label>
                            <select class="js-example-basic-single" name="gender">
                                <option value="Pria" @if($customer->gender == "Pria") selected @endif>Pria</option>
                                <option value="Wanita" @if($customer->gender == "Wanita") selected @endif>Wanita</option>
                            </select>
                        </div>
                        <div class="col-md-4 form">
                            <label for="input-phone-number" class="form-label">No. Telp</label>
                            <input type="text" name="phone_number" class="form-control" id="input-phone-number" placeholder="No. Telp" value="{{ $customer->phone_number }}">
                        </div>
                        <div class="col-md-12 form">
                            <label for="input-address" class="form-label">Alamat</label>
                            <input type="text" name="address" class="form-control" id="input-address" placeholder="Alamat" value="{{ $customer->address }}">
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
