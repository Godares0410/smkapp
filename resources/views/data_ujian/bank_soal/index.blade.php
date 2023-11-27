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
                <h3 class="box-title">Data {{ ucwords($title) }}</h3>
                <div class="pull-right">
                    {{-- <button onclick="addForm()" class="btn btn-success">Import
                        <i class="fa fa-upload"></i>
                    </button> --}}
                    {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">Import
                        Data
                        <i class="fa fa-upload"></i>
                    </button> --}}
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modalTambahBankSoal">Tambah
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">N0</th>
                            <th>Nama {{ ucwords($title) }}</th>
                            <th>Kelas</th>
                            <th>Nama Mapel</th>
                            <th class="text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($banksoal as $data)
                            @php
                                $decodedIdJurusanValues = json_decode($data->id_jurusan, true);
                                $matchingKodeJurusanValues = \App\Models\Jurusan::whereIn('id_jurusan', $decodedIdJurusanValues)
                                    ->pluck('kode_jurusan')
                                    ->toArray();
                            @endphp
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $data->nama_bank_soal }}</td>
                                @php
                                    $id = $data->id_kelas;
                                    $keles = \App\Models\Kelas::whereIn('id_kelas', [$id])
                                        ->pluck('nama_kelas')
                                        ->first();
                                @endphp
                                <td>{{ $keles }}</td>
                                <td>{{ $data->nama_mapel }}
                                    (
                                    @foreach ($matchingKodeJurusanValues as $index => $kodeJurusan)
                                        {{ $kodeJurusan }}

                                        @if ($index < count($matchingKodeJurusanValues) - 1)
                                            ,
                                        @endif
                                    @endforeach
                                    )
                                </td>
                                <td>
                                    <div class="btn-group" style="display: flex;">
                                        <a href="{{ route('soal.index', ['id_bank_soal' => $data->id_bank_soal]) }}" class="btn btn-primary" style="margin-right: 5px;">Lihat Soal</a>
                                        <form action="{{ route('bank_soal.destroy', $data->id_bank_soal) }}" method="POST">
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
    @includeIf('data_ujian.bank_soal.modal')
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
        });

        document.getElementById('selectAll').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('input[name="jurusan_mapel[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById('selectAll').checked;
            });
        });

        function updateMapelOptions() {
            // Get the selected value from the "kelas" dropdown
            var selectedKelas = document.getElementById("kelas").value;

            // Get the "mapel" dropdown
            var mapelDropdown = document.getElementById("mapel");

            // Set the value of the "mapel" dropdown to "pilih_kelas"
            mapelDropdown.value = "pilih_kelas";

            // Get all options in the "mapel" dropdown
            var mapelOptions = document.querySelectorAll("#mapel .mapel-option");

            // Loop through each option
            mapelOptions.forEach(function(option) {
                // Show the option only if it belongs to the selected "kelas" or if "selectAll" is checked
                if (option.getAttribute("data-kelas") === selectedKelas || document.getElementById("selectAll")
                    .checked) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            });
        }

        // Add an event listener to "kelas" dropdown
        document.getElementById("kelas").addEventListener("change", updateMapelOptions);

        // Add an event listener to "selectAll" checkbox
        document.getElementById("selectAll").addEventListener("change", updateMapelOptions);

        // Trigger the update when the page loads
        updateMapelOptions();


        document.addEventListener("DOMContentLoaded", function() {
            // Code to toggle the visibility of the "Select All" checkbox
            var selectAllCheckbox = document.getElementById("selectAll");

            // Initial state: hidden
            selectAllCheckbox.style.display = "none";

            // Example: Show the checkbox when a specific condition is met (you can customize this condition)
            // For example, if a certain button is clicked
            var showCheckboxButton = document.getElementById("showCheckboxButton");

            showCheckboxButton.addEventListener("click", function() {
                // Toggle the visibility when the button is clicked
                if (selectAllCheckbox.style.display === "none") {
                    selectAllCheckbox.style.display = "inline-block"; // or "block" depending on your layout
                } else {
                    selectAllCheckbox.style.display = "none";
                }
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
    </script>
@endpush
