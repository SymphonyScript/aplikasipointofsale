@extends('layouts.master')
@section('title') Customer  @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Customer  @endslot
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
                                <th scope="col">Nama</th>
                                <th scope="col">Kelamin</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No. Telp</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>
                                        <a href="{{ route('customer.edit', $user) }}" class="btn btn-sm btn-warning"><i class="mdi mdi-pen"></i></a>
                                        <a href="{{ route('customer.delete', $user) }}" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-end mt-3">
                        {{ $users->appends(Request::except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
