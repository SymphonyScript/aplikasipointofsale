@extends('layouts.master')
@section('title') User  @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Tambah User  @endslot
        @slot('return') {{ $indexLink }}  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $storeLink }}" method="post" class="row g-2">
                        @csrf
                        <div class="col-md-3 form">
                            <label for="input-name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="input-name" placeholder="Nama" required>
                        </div>
                        <div class="col-md-3 form">
                            <label for="input-email" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" id="input-email" placeholder="Email" required>
                        </div>
                        <div class="col-md-3 form">
                            <label for="input-password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="input-password" placeholder="Password" required>
                        </div>
                        <div class="col-md-3 form">
                            <label for="input-gender" class="form-label">Kelamin</label>
                            <select class="js-example-basic-single" name="gender">
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="col-md-3 form">
                            <label for="input-phone-number" class="form-label">No. Telp</label>
                            <input type="text" name="phone_number" class="form-control" id="input-phone-number" placeholder="No. Telp">
                        </div>
                        <div class="col-md-3 form">
                            <label for="input-role" class="form-label">Role</label>
                            <select class="js-example-basic-single" name="role">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form">
                            <label for="input-address" class="form-label">Alamat</label>
                            <input type="text" name="address" class="form-control" id="input-address" placeholder="Alamat">
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
