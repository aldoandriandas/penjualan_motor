<table border="1">
    <thead>
        <tr>
            <th colspan="7" style="text-align:center; font-weight:bold;">
                Data Motor
            </th>
        </tr>
        <tr>
            <th colspan="7" style="text-align:center;">
                Tanggal : {{ $tanggal }}
            </th>
        </tr>
        <tr>
            <th colspan="7" style="text-align:center;">
                Pukul : {{ $jam }}
            </th>
        </tr>
        <tr style="background:#f2f2f2;">
            <th style="text-align: center">No</th>
            <th style="text-align: center">Nama Motor</th>
            <th style="text-align: center">Merek</th>
            <th style="text-align: center">Harga</th>
            <th style="text-align: center">Stok</th>
            <th style="text-align: center">Dealer</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($motors as $item)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $item->merk->nama_merk }}</td>
                <td>{{ $item->model->nama_model }}</td>
                <td style="text-align: center">{{ $item->harga }}</td>
                <td style="text-align: center">{{ $item->stock }}</td>
                <td>{{ $item->dealer->nama_dealer ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>