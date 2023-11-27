@extends('layout.master')

@section('title')
    ujian
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-ujian', 'active')
@section('ujian-active', 'active')

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSesi">Tambah
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">NO</th>
                            <th>Jenis Ujian</th>
                            <th>Nama Mapel</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Jumlah Soal</th>
                            <th>Acak Soal</th>
                            <th>Acak Jawaban</th>
                            <th class="text-center" style="width: 2em">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        {{-- @dd($bankujian) --}}
                        @foreach ($bankujian as $data)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $data->nama_ujian }}</td>
                                <td>{{ $data->nama_mapel }}</td>
                                <td>{{ $data->nama_kelas }}</td>

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
                                <td>{{ $data->jumlah_soal }}</td>
                                @if ($data->acak_soal == 1)
                                    {{ $acak = 'Acak' }}
                                @else
                                    {{ $acak = 'Tidak' }}
                                @endif
                                <td>{{ $acak }}</td>
                                @if ($data->acak_jawaban == 1)
                                    {{ $soal = 'Acak' }}
                                @else
                                    {{ $soal = 'Tidak' }}
                                @endif
                                <td>{{ $soal }}</td>
                                <td>
                                    <form action="{{ route('bank_ujian.destroy', $data->id_bank_ujian) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-delete btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @includeIf('data_ujian.ujian.modal')
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
            $('button[data-target="#modalTambahSesi"]').on('click', function() {
                var title = "Tambah Sesi";
                openModal(title);
            });
            // Menangkap event tombol dengan atribut data-target="#modalImportJurusan"
            $('button[data-target="#importModal"]').on('click', function() {
                var title = "Import Data Jurusan";
                openModal(title);
            });
        });

        document.getElementById('pilihSemua').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('input[name="jurusan_mapel[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById('pilihSemua').checked;
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
        }); // Add an event listener to "kelas" dropdown
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

        // Fungsi untuk menambahkan checkbox bank soal berdasarkan mapel yang dipilih
        function tambahkanCheckboxBankSoal(mapelId, namaBankSoal) {
            var container = document.getElementById('bankSoalContainer');
            var checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'bank_soal[]';
            checkbox.value = mapelId;
            checkbox.id = 'bankSoal_' + mapelId;

            var label = document.createElement('label');
            label.htmlFor = 'bankSoal_' + mapelId;
            label.appendChild(document.createTextNode(' ' + namaBankSoal));

            container.appendChild(checkbox);
            container.appendChild(label);
            container.appendChild(document.createElement('br'));
        }

        // Mendengarkan perubahan pada dropdown mata pelajaran
        document.getElementById('mapel').addEventListener('change', function() {
            var selectedMapel = this.value;
            var selectedOption = this.options[this.selectedIndex];
            var kelasId = selectedOption.getAttribute('data-kelas');

            // Hapus semua elemen checkbox bank soal yang sudah ada
            document.getElementById('bankSoalContainer').innerHTML = '';

            // Ambil data bank soal yang sesuai dengan mapel yang dipilih
            var matchingBankSoal = {!! json_encode($bank) !!}.filter(function(bankSoal) {
                return bankSoal.id_mapel == selectedMapel;
            });

            // Tambahkan checkbox untuk setiap bank soal yang sesuai
            matchingBankSoal.forEach(function(bankSoal) {
                tambahkanCheckboxBankSoal(bankSoal.id_bank_soal, bankSoal.nama_bank_soal);
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
