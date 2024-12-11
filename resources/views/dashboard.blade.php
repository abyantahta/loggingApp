<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    {{-- {{ dd($logs) }} --}}
    <div class="bg-red-400" style="padding-bottom: 50px; padding-left:30px; padding-right:30px; margin-top:10px;">
        <div class="card shadow rounded-3 p-3 border-0 bg-red-400 max-w-xl mx-auto">
            @if (session()->has('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <stong style="text-align: center" class="text-center">{{ session()->get('error') }}</stong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <stong style="text-align: center" class="text-center">{{ session()->get('success') }}</stong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <video class="" id="preview"></video>

            <form action="{{ route('store') }}" method="POST" id="form">
                @csrf
                <input type="hidden" name="scanData" id="scanData">
            </form>
        </div>

        <div class="table-responsive bg-red-400 mt-5" style="height: 400px; overflow: scroll;">
          <table class="table table-striped text-center table-bordered table-hover" style="position: relative">
            <thead style="position: sticky;top: -1px;left: 0;widows: 100%;">
                <tr>
                    <th style=" background-color: #c5e3f3; max-width: 35px">No</th>
                    <th style=" background-color: #c5e3f3; max-width: 100px">Kode</th>
                    <th style=" background-color: #c5e3f3;">Nama</th>
                    <th style=" background-color: #c5e3f3;">Tanggal Masuk</th>
                    <th style=" background-color: #c5e3f3;">Jam Masuk</th>
                    <th style=" background-color: #c5e3f3;">Tanggal Keluar</th>
                    <th style=" background-color: #c5e3f3;">Jam Keluar</th>
                    <th style=" background-color: #c5e3f3;">Durasi</th>
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
                    <td>{{ \Carbon\Carbon::parse($log->user_in)->translatedFormat('d F Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->user_in)->translatedFormat('H:i') }}</td>
                    <td>{{ $log->user_out ? (\Carbon\Carbon::parse($log->user_out)->translatedFormat('d F Y')): "-" }}</td>
                    <td>{{ $log->user_out ? (\Carbon\Carbon::parse($log->user_out)->translatedFormat('H:i')): "-" }}</td>
                    {{-- <td>{{ \Carbon\Carbon::parse($log->user_out)->translatedFormat('H:i') }}</td> --}}
                    <td>{{ $log->duration ? (\Carbon\CarbonInterval::seconds($log->duration)->cascade()->forHumans()): "-" }}</td>
                    {{-- <td>{{ $log->user_out->diffInSeconds() }}</td> --}}
                </tr>
                @empty
                <h4 class="text-center text-md mb-3">Tidak ada log tersimpan</h4>
                @endforelse
            </tbody>
          </table>
        </div>
        <a href="{{ url('export') }}" type="button" class="btn btn-warning" style="font-weight: bold; font-size: 16px; color: white; padding: 10px 30px;width:100%;margin-top: 30px; max-width: 300px margin-left:30px; margin-right:30px ">Export</a>
    </div>
</x-app-layout>
