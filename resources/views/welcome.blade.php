<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        tr>th {
            background-color: red;
        }
    </style>
</head>

<body>
    {{-- <h1>Hello, world!</h1> --}}
    {{-- {{ dd($logs) }} --}}
    <div class="container col-lg-6 py-5">
        
        <div class="card bg-white shadow rounded-3 p-3 border-0">
            @if (session()->has('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <stong class="text-center">{{ session()->get('error') }}</stong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <stong class="text-center">{{ session()->get('success') }}</stong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <video id="preview"></video>

            <form action="{{ route('store') }}" method="POST" id="form">
                @csrf
                <input type="hidden" name="scanData" id="scanData">
            </form>
        </div>

        <div class="table-responsive  mt-5" style="height: 400px; overflow: scroll;">
          <table class="table table-striped text-center table-bordered table-hover" style="position: relative">
            <thead style="position: sticky;top: -1px;left: 0;widows: 100%;">
                <tr>
                    <th style=" background-color: #c5e3f3; max-width: 35px">No</th>
                    <th style=" background-color: #c5e3f3; max-width: 100px">Kode</th>
                    <th style=" background-color: #c5e3f3;">Nama</th>
                    <th style=" background-color: #c5e3f3;">Date Masuk</th>
                    <th style=" background-color: #c5e3f3;">Date Keluar</th>
                    {{-- <th>Kode</th>
                    <th>Nama</th>
                    <th>Date Masuk</th>
                    <th>Date Keluar</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                <tr>
                    <td>{{ ($loop->index)+1 }}</td>
                    <td>{{ $log->user_id }}</td>
                    <td>{{ $log->user_name }}</td>
                    <td>{{ $log->user_in }}</td>
                    <td>{{ $log->user_out ?? "-" }}</td>
                </tr>
                @empty
                <h4 class="text-center text-md mb-3">Tidak ada log tersimpan</h4>
                @endforelse
            </tbody>
          </table>
        </div>
        <a href="{{ url('export') }}" type="button" class="btn btn-warning" style="font-weight: bold; font-size: 16px; color: white; padding: 10px 30px;width:100%;margin-top: 30px; ">Export</a>
    </div>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        scanner.addListener('scan', function(content) {
            console.log(content);
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c){
            document.getElementById('scanData').value = c;
            document.getElementById('form').submit();
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
