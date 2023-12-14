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
                        <div class="col-md-3 form">
                            <label for="input-name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="input-name" placeholder="Nama" required  value="{{ $user->name }}">
                        </div>
                        <div class="col-md-3 form">
                            <label for="input-email" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" id="input-email" placeholder="Email" required value="{{ $user->email }}">
                        </div>
                        <div class="col-md-3 form">
                            <label for="input-password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="input-password" placeholder="Password">
                        </div>
                        <div class="col-md-3 form">
                            <label for="input-gender" class="form-label">Kelamin</label>
                            <select class="js-example-basic-single" name="gender">
                                <option value="Pria" @if($user->gender == "Pria") selected @endif>Pria</option>
                                <option value="Wanita" @if($user->gender == "Wanita") selected @endif>Wanita</option>
                            </select>
                        </div>
                        <div class="col-md-3 form">
                            <label for="input-phone-number" class="form-label">No. Telp</label>
                            <input type="text" name="phone_number" class="form-control" id="input-phone-number" placeholder="No. Telp" value="{{ $user->phone_number }}">
                        </div>
                        <div class="col-md-3 form">
                            <label for="input-role" class="form-label">Role</label>
                            <select class="js-example-basic-single" name="role">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if($user->roles->contains($role) == $role->id) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form">
                            <label for="input-address" class="form-label">Alamat</label>
                            <input type="text" name="address" class="form-control" id="input-address" placeholder="Alamat" value="{{ $user->address }}">
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
