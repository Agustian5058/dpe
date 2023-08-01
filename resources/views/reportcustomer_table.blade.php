<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th></th>
            <th>Kode Customer</th>
            <th>Nama Customer</th>
            <th>Handle Oleh</th>
            <th>Saldo Customer</th>
            <th>Saldo Awal</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Saldo Akhir</th>
            <!-- <th>Action</th> -->
        </tr>
    </thead>
    <tbody>
        @forelse ($dataCustomers as $dataCustomer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dataCustomer->customer_id }}</td>
                <td>{{ $dataCustomer->customer_name }}</td>
                <td>{{ $dataCustomer->customer_sales }}</td>
                <td>Rp. {{ number_format($dataCustomer->amount, 0) }}</td>
                <td>Rp. {{ number_format($dataCustomer->previous_amount, 0) }}</td>
                <td>Rp. {{ number_format($dataCustomer->total_debit, 0) }}</td>
                <td>Rp. {{ number_format($dataCustomer->total_credit, 0) }}</td>
                <td>Rp. {{ number_format($dataCustomer->current_amount, 0) }}</td>
                <!-- <td>
                    <form action="{{ route('laporan-customer.edit', $dataCustomer->customer_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-success">Detail</button>
                    </form>
                </td> -->
            </tr>
        @empty
            <div class="alert alert-danger">
                Data Customer belum Tersedia.
            </div>
        @endforelse
    </tbody>
</table>