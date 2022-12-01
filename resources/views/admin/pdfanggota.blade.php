<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            size: 8;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <h1>Data Kehadiran Anggota KSP Dian Mandiri</h1>
    </div>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Kelompok</th>
            <th>Petugas</th>
            <th>Cabang</th>
        </tr>
        @php
        $no=1;
        @endphp
        @foreach ($data as $index => $row)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $row->username}}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->tgl }}</td>
            <td>{{ $row->kelompok }}</td>
            <td>{{ $row->po }}</td>
            <td>{{ $row->Cabangs->nama_cabang }}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>