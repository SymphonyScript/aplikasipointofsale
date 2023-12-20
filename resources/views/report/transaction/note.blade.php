<style>
    tr, td, th {
        padding : 5px;
        margin : 0px;
    }

    .w-100{
        width : 100%;
    }

    .w-50{
        width : 50%;
    }

    .divider{
        border-bottom: 1px dashed black;
    }
</style>

<div class="w-100">
    <h2 style="text-align: center">Point Of Sale</h2>
</div>

<div class="w-100" style="margin: 0px; padding:0px">
    <h5 style="text-align: center">Kedung Lumbu, Pasar Kliwon, Surakarta City, Central Java 57133</h5>
</div>

<table class="w-100">
    <tr>
        <td>#{{ $transaction->code }}</td>
        <td style="text-align: right">{{ parse_date_time($transaction->created_at) }}</td>
    </tr>
    <tr>
        <td>Kasir : {{ @$transaction->cashier->name }}</td>
        <td></td>
    </tr>
</table>

<div class="divider w-100"></div>

<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="border-bottom: 1px dashed black;">
            <th scope="col">Barang</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
    @foreach($transaction->items as $item)
        <tr>
            <td>{{ @$item->item->name }}</td>
            <td>{{ rp_format($item->price) }}</td>
            <td style="text-align:center">{{ $item->qty }}</td>
            <td>{{ rp_format($item->total) }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr style="border-top: 1px dashed black;">
            <td colspan="3">Total</td>
            <td>{{ rp_format($transaction->total) }}</td>
        </tr>
    </tfoot>
</table>

<div class="divider w-100"></div>

<div class="w-100" style="margin-top: 20px; padding:0px; text-align: center">
    <span>Barang TIDAK DAPAT ditukar/dikembalikan dengan ALASAN APAPUN. Sebelum dibayar akan dicoba, kerusakan barang bukan tanggung jawab kami.</span>
</div>
