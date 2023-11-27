@extends('layout.master')

@section('title')
    Bank Soal
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-ujian', 'active')
@section('banksoal-active', 'active')

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
                <h3 class="box-title">Data {{ ucwords($title) }} : {{ $bank->nama_bank_soal }}</h3>
                <div class="pull-right">
                    {{-- <button onclick="addForm()" class="btn btn-success">Import
                        <i class="fa fa-upload"></i>
                    </button> --}}
                    <a href="/banksoal" type="button" class="btn btn-warning">Kembali
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">Import
                        Soal
                        <i class="fa fa-upload"></i>
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFoto">Upload Foto
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <h4>Jumlah Soal : {{ $jml }}</h4>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">N0</th>
                            <th>Soal</th>
                            <th>Opsi A</th>
                            <th>Opsi B</th>
                            <th>Opsi C</th>
                            <th>Opsi D</th>
                            <th>Opsi E</th>
                            <th>Kunci</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($soal as $data)
                            <tr>
                                <td class="text-center">{{ $counter++ }}</td>
                                <td>{{ $data->soal }}</td>
                                <td>{{ $data->pil_a }}</td>
                                <td>{{ $data->pil_b }}</td>
                                <td>{{ $data->pil_c }}</td>
                                <td>{{ $data->pil_d }}</td>
                                <td>{{ $data->pil_e }}</td>
                                <td>{{ $data->jawaban }}</td>
                                <td>
                                    <div class="btn-group" style="display: flex;">
                                        @if ($data->file_1 != null)
                                            <button type="button"
                                                class="btn btn-{{ $data->file_1 ? 'success' : 'secondary' }} btn-detail"
                                                data-toggle="modal" data-target="#modalDetail{{ $data->id_soal }}"
                                                style="margin-right: 5px;">
                                                Foto
                                            </button>
                                        @endif
                                        <form action="{{ route('soal.destroy', $data->id_soal) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-delete btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @includeIf('data_ujian.soal.modal')
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

            // Menangkap event tombol dengan atribut data-target="#modalTambahjurusan"
            $('button[data-target="#modalTambahBankSoal"]').on('click', function() {
                var title = "Tambah Jurusan";
                openModal(title);
            });
            // Menangkap event tombol dengan atribut data-target="#modalImportJurusan"
            $('button[data-target="#importModal"]').on('click', function() {
                var title = "Import Data Jurusan";
                openModal(title);
            });
            // Menangkap event tombol dengan atribut data-target="#modalImportJurusan"
            $('button[data-target="#importFoto"]').on('click', function() {
                var title = "Import Data Jurusan";
                openModal(title);
            });
        });

        // <<HAPUS>>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: 'Apakah Anda yakin ingin menghapus data ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            button.parentNode.submit();
                        }
                    });
                });
            });
        });

        $(document).ready(function () {
        var zoomFactor = 1;

        $('.zoom-in-btn').on('click', function () {
            zoomFactor += 0.1;
            updateImageZoom();
        });

        $('.zoom-out-btn').on('click', function () {
            if (zoomFactor > 0.2) {
                zoomFactor -= 0.1;
                updateImageZoom();
            }
        });

        function updateImageZoom() {
            $('.modal-body .zoomable').css('transform', 'scale(' + zoomFactor + ')');
        }
    });
    </script>
@endpush
