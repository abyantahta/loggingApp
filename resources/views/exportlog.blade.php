<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table class="" style="">
        <thead style="">
            <tr>
                <th style="  ">No</th>
                <th style="  ">Kode</th>
                <th style=" ">Nama</th>
                <th style=" ">Tanggal Masuk</th>
                <th style=" ">Jam Masuk</th>
                <th style=" ">Tanggal Keluar</th>
                <th style=" ">Jam Keluar</th>
                <th style=" ">Durasi (detik)</th>
                {{-- <th>Kode</th>
                    <th>Nama</th>
                    <th>Date Masuk</th>
                    <th>Date Keluar</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $log->user_id }}</td>
                    <td>{{ $log->user_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->user_in)->translatedFormat('d F Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->user_in)->translatedFormat('H:i') }}</td>
                    <td>{{ $log->user_out ? \Carbon\Carbon::parse($log->user_out)->translatedFormat('d F Y') : '-' }}
                    </td>
                    <td>{{ $log->user_out ? \Carbon\Carbon::parse($log->user_out)->translatedFormat('H:i') : '-' }}
                    </td>
                    {{-- <td>{{ \Carbon\Carbon::parse($log->user_out)->translatedFormat('H:i') }}</td> --}}
                    <td>{{ $log->duration?? '-' }}
                    </td>
                    {{-- <td>{{ $log->user_out->diffInSeconds() }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
