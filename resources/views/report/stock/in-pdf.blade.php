<style>
    tr, td, th {
        border : 1px solid black;
        padding : 5px;
        margin : 0px;
    }
</style>

<h3>Laporan Stock In</h3>
<table style="width: 100%; border-collapse: collapse">
    <thead>
        <tr>
            <th scope="col">Tanggal</th>
            <th scope="col">Kode</th>
            <th scope="col">Item</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Stok</th>
            <th scope="col">Supplier</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stocks as $stock)
        <tr>
            <td>{{ parse_date_time($stock->created_at) }}</td>
            <td>{{ @$stock->item->code }}</td>
            <td>{{ @$stock->item->name }}</td>
            <td>{{ $stock->description }}</td>
            <td>{{ $stock->qty }}</td>
            <td>{{ @$stock->supplier->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
