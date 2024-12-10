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
                    <th style=" ">No</th>
                    <th style=" ">Kode</th>
                    <th style=" ">Nama</th>
                    <th style=" ">Date Masuk</th>
                    <th style=" ">Date Keluar</th>
                    {{-- <th>Kode</th>
                    <th>Nama</th>
                    <th>Date Masuk</th>
                    <th>Date Keluar</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                <tr>
                    <td>{{ ($loop->index)+1 }}</td>
                    <td>{{ $log->user_id }}</td>
                    <td>{{ $log->user_name }}</td>
                    <td>{{ $log->user_in }}</td>
                    <td>{{ $log->user_out ?? "-" }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
</body>
</html>