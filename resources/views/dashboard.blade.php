@extends('layouts.master')
@section('title')
    @lang('translation.dashboards')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Welcome!, {{ \Illuminate\Support\Facades\Auth::user()->name }}</h4>
                                <p class="text-muted mb-0">Here's what's happening with your store
                                    today.</p>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                            </div><!-- end card header -->

{{--                            <div class="card-header p-0 border-0 bg-light-subtle">--}}
{{--                                <div class="row g-0 text-center">--}}
{{--                                    <div class="col-6 col-sm-6">--}}
{{--                                        <div class="p-3 border border-dashed border-start-0">--}}
{{--                                            <h5 class="mb-1"><span class="counter-value" data-target="7585">0</span></h5>--}}
{{--                                            <p class="text-muted mb-0">Transaksi</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!--end col-->--}}
{{--                                    <div class="col-6 col-sm-6">--}}
{{--                                        <div class="p-3 border border-dashed border-start-0">--}}
{{--                                            <h5 class="mb-1">$<span class="counter-value" data-target="22.89">0</span>k</h5>--}}
{{--                                            <p class="text-muted mb-0">Pendapatan</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div><!-- end card header -->--}}

                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="customer_impression_charts" data-colors='["--vz-success", "--vz-primary", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Penjualan Terbanyak</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Qty</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sellings as $selling)
                                            <tr>
                                                <td>{{ $selling->code }}</td>
                                                <td>{{ $selling->name }}</td>
                                                <td>{{ rp_format($selling->price) }}</td>
                                                <td>{{ $selling->total_sold }}</td>
                                        @endforeach
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Item</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Stok</th>
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
                                        @endforeach
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Transaksi Terakhir</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Produk</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Kasir</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td>
                                                    #{{ $transaction->code }}
                                                </td>
                                                <td>
                                                    {{ @$transaction->customer->name }}
                                                </td>
                                                <td>
                                                    {{ @$transaction->items->count() }}
                                                </td>
                                                <td>
                                                    <span class="text-success">{{ rp_format($transaction->total) }}</span>
                                                </td>
                                                <td>
                                                    {{ @$transaction->cashier->name }}
                                                </td>
                                            </tr><!-- end tr -->
                                        @endforeach
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                </div> <!-- end row-->

            </div> <!-- end .h-100-->

        </div> <!-- end col -->

    </div>
@endsection
@section('script')
    <script>
        const transactionStatisticRoute = "{{ route('transaction.statistic') }}";
    </script>
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
    <!-- dashboard init -->
    <script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
