<table border="1">
    <thead>
        <tr>
            <th colspan="7" style="text-align:center; font-weight:bold;">
                Data User
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
            <th style="text-align:center;">No</th>
            <th style="text-align:center;">Nama</th>
            <th style="text-align:center;">Email</th>
            <th style="text-align:center;">No Hp</th>
            <th style="text-align:center;">Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $item)
            <tr>
                <td style="text-align:center;">{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td style="text-align:center;">{{ $item->no_hp }}</td>
                <td>{{ $item->alamat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>