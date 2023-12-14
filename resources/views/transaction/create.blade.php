@extends('layouts.master')
@section('title') Transaksi  @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Transaksi  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ $storeLink }}" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-7 row">
                                <div class="col-md-5">
                                    <select class="select2" name="customer" required>
                                        <option value="">Pilih Customer</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" >{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="float-end">
                                    <h4 class="mb-0">#{{ $code }}</h4>
                                    <span style="color: grey">{{ \Carbon\Carbon::now() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="min-width:400px !important;">Nama</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot class="table-light" id="content">
                                    <tr>
                                        <td colspan="3">Total</td>
                                        <td colspan="2">
                                            <input class="form-control" type="text" name="grand_total" id="grand_total">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success float-end mt-2"><i class="mdi mdi-send"></i> Submit</button>
                                <input class="btn btn-primary float-end m-2" type="button" value="Tambah Item" onclick="addRowItem()"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        $(".select2").select2();

        function generateRandomString(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            return Array.from({ length }, () => characters[Math.floor(Math.random() * characters.length)]).join('');
        }

        function addRowItem () {
            var randomString = generateRandomString(10);
            document.querySelector('#content').insertAdjacentHTML(
                'beforebegin',
                `
                <tr>
                    <td>
                        <select type="text" name="item[]" class="form-control select2 {{ $errors->has('name') ? ' is-invalid' : '' }}" id="item_${randomString}" onchange="getItem('${randomString}', this.value)" required >
                            <option>Pilih Item</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control" type="text" name="price[]" id="price_${randomString}" placeholder="Harga" required value=0 onchange="calcTotal('${randomString}')">
                    </td>
                    <td>
                        <input class="form-control" type="text" name="qty[]" id="qty_${randomString}" placeholder="Qty" required min=1 value=0 onchange="calcTotal('${randomString}')">
                    </td>
                    <td>
                        <input class="form-control" type="text" name="total[]" id="total_${randomString}" placeholder="Total" required onchange="sumAllTotals()">
                    </td>
                    <td>
                        <div class="btn btn-block btn-danger ml-4" style="cursor:pointer;" onclick="removeRowItem(this)"><i class="mdi mdi-trash-can"></i></div>
                    </td>
                </tr>
                `
            )

            $(".select2").select2();
        }

        function removeRowItem (input) {
            input.parentNode.parentNode.remove()
        }

        function getItem(randomString, idItem){
            console.log(idItem)
            $.ajax({
                url: "{{ route('product.item.get-item') }}",
                type: "GET",
                data: {"item_id":idItem,},
                success: function(data) {
                    document.getElementById(`price_${randomString}`).value = data.price
                }
            });
        }

        function calcTotal(randomString){
            var price = document.getElementById(`price_${randomString}`).value
            var qty = document.getElementById(`qty_${randomString}`).value

            document.getElementById(`total_${randomString}`).value = parseFloat(price) * parseFloat(qty);

            sumAllTotals()
        }

        function sumAllTotals() {
            var totalInputs = document.getElementsByName("total[]");
            var total = 0;

            for (var i = 0; i < totalInputs.length; i++) {
                var inputValue = parseFloat(totalInputs[i].value);

                if (!isNaN(inputValue)) {
                    total += inputValue;
                }
            }

            var formattedGrandTotal = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                currencyDisplay: 'symbol',
                minimumFractionDigits: 0,
            }).format(total);

            document.getElementById('grand_total').value = total;
        }
    </script>
@endsection
