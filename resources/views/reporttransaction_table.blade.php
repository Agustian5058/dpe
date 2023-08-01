<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th></th>
            <th>Tanggal Transaksi</th>
            <th>Kode Kedatangan</th>
            <th>Customer</th>
            <th>Transaksi</th>
            <th>Keterangan</th>
            <th>Container</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Saldo Awal</th>
            <th>Saldo Akhir</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($dataTransactions as $dataTransaction)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dataTransaction->transaction_date }}</td>
                <td>{{ $dataTransaction->transaction_vehicle_arrival }}</td>
                <td>{{ $dataTransaction->customer_name }} - {{ $dataTransaction->customer_sales }} - {{ $dataTransaction->transaction_customer }}</td>
                <td>{{ $dataTransaction->transaction_transaction_type }}</td>
                <td>{{ $dataTransaction->note }}</td>
                <td>{{ $dataTransaction->transaction_container_number }}</td>
                <td> @if ($dataTransaction->transaction_debit_credit == "Debit") Rp. {{ number_format($dataTransaction->price, 0) }} @endif</td>
                <td> @if ($dataTransaction->transaction_debit_credit == "Credit") Rp. {{ number_format($dataTransaction->price, 0) }} @endif</td>
                <td>Rp. {{ number_format($dataTransaction->previous_amount, 0) }}</td>
                <td>Rp. {{ number_format($dataTransaction->current_amount, 0) }}</td>
            </tr>
        @empty
            <div class="alert alert-danger">
                Data Transaksi belum Tersedia.
            </div>
        @endforelse
    </tbody>
</table>