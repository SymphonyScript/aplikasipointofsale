@extends('layouts.master')
@section('title') Transaksi  @endsection
@section('content')
    @component('components.page-title')
        @slot('title') Transaksi  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12">
                        <div class="float-start">
                            <h4 class="mb-0">#{{ $code }}</h4>
                            <span style="color: grey">{{ \Carbon\Carbon::now() }}</span>
                        </div>
                        <div class="float-end">
                            <input class="btn btn-sm btn-primary mt-2" type="button" value="Tambah Item" onclick="addRowItem()"/>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ $storeLink }}" method="post" class="row g-2">
                        @csrf
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="table-light" id="content">
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td colspan="2"><span id="grand_total">0</span></td>
                                </tr>
                            </tfoot>
                        </table>
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



    <script>
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
                    <td style="min-width:400px !important;">
                        <select type="text" name="item[]" class="form-control select2 {{ $errors->has('name') ? ' is-invalid' : '' }}" id="item_${randomString}" onchange="getItem('${randomString}', this.value)" required >
                            <option>Pilih Item</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control" type="text" name="price[]" id="price_${randomString}" placeholder="Harga" required onchange="calcTotal('${randomString}')">
                    </td>
                    <td>
                        <input class="form-control" type="text" name="qty[]" id="qty_${randomString}" placeholder="Qty" required min=1 value=0 onchange="calcTotal('${randomString}')">
                    </td>
                    <td>
                        <input class="form-control" type="text" name="total[]" id="total_${randomString}" placeholder="Total" required>
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

            document.getElementById('grand_total').textContent = formattedGrandTotal;
        }
    </script>
@endsection
