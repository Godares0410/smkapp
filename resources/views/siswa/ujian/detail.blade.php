@extends('layout.master')

@section('title')
    Ketentuan Ujian
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-umum', 'active')
@section('mapel-active', 'active')

@section('badge')
    @parent
    <li class="active">Ujian {{ $nama->nama_ujian }}</li>
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
                <h3 class="box-title">Ujian {{ $nama->nama_ujian }}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-3"></div>
                    @foreach ($ujian as $data)
                        <div class="col-lg-6">
                            <div class="box box-primary" style="border-width: 4px;">
                                <div class="box-body box-profile" style="border: 1px solid #343434;">

                                    <h3 class="profile-username text-center">{{ $data->nama_mapel }}</h3>

                                    <p class="text-muted text-center">Ketentuan Ujian</p>

                                    <div class="box">
                                        <ol style="margin-top: 10px">
                                            <li>Peserta ujian harus memastikan koneksi internet stabil sebelum ujian
                                                dimulai.</li>
                                            <li>Peserta harus membawa kartu ujian saat memasuki ruang ujian.</li>
                                            <li>Peserta harus hadir tepat waktu pada waktu yang ditentukan untuk memulai
                                                ujian.</li>
                                            <li>Peserta dilarang berkomunikasi dengan peserta lain selama ujian berlangsung.
                                            </li>
                                            <li>Memakai atribut seragam lengkap.</li>
                                            <li>Pelanggaran aturan ujian maka akun akan diblokir.</li>
                                        </ol>
                                    </div>
                                    <form action="{{ route('siswas.mengerjakan') }}" method="POST">
                                        @csrf
                                        <input type="hidden" id="id_ujian" name="id_ujian"
                                            value="{{ $data->id_jadwal_ujian }}">
                                            <button class="btn btn-primary btn-block" type="submit">Mulai</button>
                                    </form>
                                </div>
                            </div>
                    @endforeach
                    <div class="col-lg-3"></div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
@endsection
