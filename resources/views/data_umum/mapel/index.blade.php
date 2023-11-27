@extends('layout.master')

@section('title')
    mapel
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-umum', 'active')
@section('mapel-active', 'active')

@section('badge')
    @parent
    <li class="active">{{ ucwords($title) }}</li>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2500 // Menutup pesan dalam 1 detik (1000ms)
                });
            </script>
        @endif



        <!-- Small boxes (Stat box) -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data {{ ucwords($title) }}</h3>
                <div class="pull-right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">Import
                        Data
                        <i class="fa fa-upload"></i>
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modalTambahMapel">Tambah
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">N0</th>
                            <th>Nama Mapel</th>
                            <th>Kode Mapel</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        {{-- @dd($mapel) --}}
                        @foreach ($mapel as $data)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $data->nama_mapel }}</td>
                                <td>{{ $data->kode_mapel }}</td>
                                @php
                                    $id = $data->id_kelas;
                                    $keles = \App\Models\Kelas::whereIn('id_kelas', [$id])
                                        ->pluck('nama_kelas')
                                        ->first();
                                @endphp

                                <td>{{ $keles }}</td>

                                {{-- Retrieve kode_jurusan values based on id_jurusan --}}
                                @php
                                    $decodedIdJurusanValues = json_decode($data->id_jurusan, true);
                                    $matchingKodeJurusanValues = \App\Models\Jurusan::whereIn('id_jurusan', $decodedIdJurusanValues)
                                        ->pluck('kode_jurusan')
                                        ->toArray();
                                @endphp
                                <td>
                                    @foreach ($matchingKodeJurusanValues as $index => $kodeJurusan)
                                        {{ $kodeJurusan }}

                                        @if ($index < count($matchingKodeJurusanValues) - 1)
                                            ,
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modalEdit{{ $data->id_mapel }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @includeIf('data_umum.mapel.modal')
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $('.table').DataTable()
        })

        $(document).ready(function() {
            // ...

            // Fungsi untuk membuka modal dan mengatur judul
            function openModal(title) {
                $('.modal-title').text(title);
                // ...
            }

            // Menangkap event tombol dengan atribut data-target="#modalTambahmapel"
            $('button[data-target="#modalTambahMapel"]').on('click', function() {
                var title = "Tambah Mapel";
                openModal(title);
            });
            // Menangkap event tombol dengan atribut data-target="#modalImportmapel"
            $('button[data-target="#importModal"]').on('click', function() {
                var title = "Import Data Mapel";
                openModal(title);
            });
        });

        document.getElementById('selectAll').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('input[name="jurusan_mapel[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById('selectAll').checked;
            });
        });
    </script>
@endpush
