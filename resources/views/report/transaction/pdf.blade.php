<style>
    tr, td, th {
        border : 1px solid black;
        padding : 5px;
        margin : 0px;
    }
</style>

<table style="width: 100%; border-collapse: collapse">
    <thead class="table-light">
    <tr>
        <th scope="col">Tanggal</th>
        <th scope="col">Nota</th>
        <th scope="col">Item(s)</th>
        <th scope="col">Total</th>
        <th scope="col">Customer</th>
        <th scope="col">Kasir</th>
        <th scope="col">Aksi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ parse_date_time($transaction->created_at) }}</td>
            <td>{{ $transaction->code }}</td>
            <td>
                <table class="table table-hover table-nowrap mb-0">
                    @foreach($transaction->items as $item)
                        <tr>
                            <td>{{ $item->item->name }}</td>
                            <td><span class="badge badge-gradient-primary">{{ $item->qty }}</span></td>
                            <td>{{ rp_format($item->total) }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
            <td>{{ rp_format($transaction->total) }}</td>
            <td>{{ @$transaction->customer->name }}</td>
            <td>{{ @$transaction->cashier->name }}</td>
            <td>
                {{--                                        <a href="{{ route('customer.edit', $user) }}" class="btn btn-sm btn-warning"><i class="mdi mdi-pen"></i></a>--}}
                <a href="{{ route('transaction.delete', $transaction) }}" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
