@extends('layout.master')

@section('title')
    jadwal Ujian
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-ujian', 'active')
@section('jadwal_ujian-active', 'active')

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahJenis">Tambah
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <!-- /.col -->
                @foreach ($jadwal as $data)
                    <div class="box-body">
                        <div class="col-md-6 col-lg-4">
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{ $data->nama_mapel }} - {{ $data->nama_kelas }}</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table-striped" style="width: 100%">
                                        <tr>
                                            <th>Jurusan</th>
                                            <th>:</th>
                                            @php
                                                $decodedIdJurusanValues = json_decode($data->id_jurusan, true);

                                                // Check if $decodedIdJurusanValues is not null before using it
                                                if (!is_null($decodedIdJurusanValues)) {
                                                    $matchingKodeJurusanValues = \App\Models\Jurusan::whereIn('id_jurusan', $decodedIdJurusanValues)
                                                        ->pluck('kode_jurusan')
                                                        ->toArray();
                                                } else {
                                                    // Handle the case when $decodedIdJurusanValues is null
                                                    $matchingKodeJurusanValues = [];
                                                }
                                            @endphp
                                            <th class="text-right"><span class="label"
                                                    style="background-color: rgb(0, 152, 134)">
                                                    @foreach ($matchingKodeJurusanValues as $index => $kodeJurusan)
                                                        {{ $kodeJurusan }}

                                                        @if ($index < count($matchingKodeJurusanValues) - 1)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Pelaksanaan</th>
                                            <th>:</th>

                                            <th class="text-right"><span class="label"
                                                    style="background-color: rgb(0, 58, 152)">{{ $data->tgl_mulai }}</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Selesai</th>
                                            <th>:</th>

                                            <th class="text-right"><span class="label"
                                                    style="background-color: rgb(233, 53, 8)">{{ $data->tgl_selesai }}</span>
                                            </th>
                                        </tr>
                                        {{-- <tr>
                                            <th>Jam</th>
                                            <th>:</th>

                                            <th class="text-right"><span class="label label-success">3</span>
                                                - <span class="label label-danger">6</span></th>
                                        </tr> --}}
                                        <tr>
                                            <th>Durasi</th>
                                            <th>:</th>
                                            <th class="text-right"><span class="label"
                                                    style="background-color: rgb(207, 135, 0)">{{ $data->durasi }}
                                                    Menit</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Soal</th>
                                            <th>:</th>
                                            <th class="text-right"><span class="label"
                                                    style="background-color: rgb(150, 32, 130)">{{ $data->jumlah_soal }}</span>
                                            </th>
                                        </tr>
                                        {{-- <tr>
                                            <th>Sesi</th>
                                            <th>:</th>
                                            <th class="text-right"><span class="label label-primary">
                                                </span></th>
                                        </tr> --}}
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                @endforeach
                <!-- /.box-body -->
                <div class="box-footer">
                    Footer
                </div>
                <!-- /.box-footer-->
            </div>
        </div>
    </section>
    @includeIf('data_ujian.jadwal_ujian.modal')
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wysihtml5/0.3.0/wysihtml5-0.3.0.min.js"></script>

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

        document.getElementById('pilihSemua').addEventListener('change', function() {
            var checkboxes = document.getElementsByClassName('sesi-checkbox');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = this.checked;
                toggleJamFields(checkboxes[i]);
            }
        });

        var sesiCheckboxes = document.getElementsByClassName('sesi-checkbox');
        for (var i = 0; i < sesiCheckboxes.length; i++) {
            sesiCheckboxes[i].addEventListener('change', function() {
                toggleJamFields(this);
            });
        }

        function toggleJamFields(checkbox) {
            var sesiId = checkbox.value;
            var jamFields = document.getElementById('jam-fields-' + sesiId);
            if (checkbox.checked) {
                jamFields.style.display = 'block';
            } else {
                jamFields.style.display = 'none';
            }
        }
    </script>
@endpush
