<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Top Navigation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/dist/css/skins/_all-skins.min.css') }}">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
  <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue fixed layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="../../index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Admin</b>LTE</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->


                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../../dist/img/user2-160x160.jpg" class="img-circle"
                                                        alt="User Image">
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <!-- end message -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ auth('siswa')->user()->nama_siswa }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p>{{ auth('siswa')->user()->nama_siswa }}
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        {{ $ujian->nama_mapel }}
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $idUj }}</h3>
                            <!-- Button to trigger the modal -->
                            <div class="pull-right">
                                <button class="btn btn-success" onclick="refreshHalaman()"><i
                                        class="fa  fa-refresh"></i></button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#soalModal" id="btnDaftarSoal">
                                    Daftar Soal
                                </button>
                            </div>
                        </div>
                        @if (session('sukses'))
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: '{{ session('sukses') }}',
                                    showConfirmButton: true
                                })
                            </script>
                        @endif
                        <div class="box-body">
                            <div id="soal-container">
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach ($soal as $sl)
                                    <div class="pertanyaan-{{ $sl->id_soal }}">
                                        <h3>{{ $counter++ }}. {{ $sl->soal }}</h3><br>

                                        <form class="answer-form">
                                            @csrf
                                            <input type="hidden" name="id_soal" value="{{ $sl->id_soal }}">
                                            <button type="button"
                                                class="answer-btn btn-lg {{ $sl->soal_jawaban == 'A' ? 'btn-success' : '' }}"
                                                data-answer="{{ encrypt($sl->pil_a) }}">A</button>
                                            {{ $sl->pil_a }}
                                        </form><br>
                                        <form class="answer-form">
                                            @csrf
                                            <input type="hidden" name="id_soal" value="{{ $sl->id_soal }}">
                                            <button type="button"
                                                class="answer-btn btn-lg {{ $sl->soal_jawaban == 'B' ? 'btn-success' : '' }}"
                                                data-answer="{{ encrypt($sl->pil_b) }}">B</button>
                                            {{ $sl->pil_b }}
                                        </form><br>
                                        <form class="answer-form">
                                            @csrf
                                            <input type="hidden" name="id_soal" value="{{ $sl->id_soal }}">
                                            <button type="button"
                                                class="answer-btn btn-lg {{ $sl->soal_jawaban == 'C' ? 'btn-success' : '' }}"
                                                data-answer="{{ encrypt($sl->pil_c) }}">C</button>
                                            {{ $sl->pil_c }}
                                        </form><br>
                                        <form class="answer-form">
                                            @csrf
                                            <input type="hidden" name="id_soal" value="{{ $sl->id_soal }}">
                                            <button type="button"
                                                class="answer-btn btn-lg {{ $sl->soal_jawaban == 'D' ? 'btn-success' : '' }}"
                                                data-answer="{{ encrypt($sl->pil_d) }}">D</button>
                                            {{ $sl->pil_d }}
                                        </form><br>
                                        @if ($ujian->jumlah_opsi == 5)
                                            <form class="answer-form">
                                                @csrf
                                                <input type="hidden" name="id_soal" value="{{ $sl->id_soal }}">
                                                <button type="button"
                                                    class="answer-btn btn-lg {{ $sl->soal_jawaban == 'E' ? 'btn-success' : '' }}"
                                                    data-answer="{{ encrypt($sl->pil_e) }}">E</button>
                                                {{ $sl->pil_e }}
                                            </form><br>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="container">
                <!-- Tambahkan div dengan ID untuk menampilkan soal -->
                <div class="col-lg-4 col-xs-4">
                    <!-- small box -->
                    <div class="text-center">
                        <button class="btn btn-primary" id="btnSebelumnya"
                            onclick="tampilkanSoalSebelumnya()">Sebelumnya</button>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-4">
                    <!-- small box -->
                    <div class="text-center">
                        <button type="button" class="btn btn-warning btn-ragu">
                            Ragu
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-4">
                    <!-- small box -->
                    <div class="text-right">
                        <button class="btn btn-primary pull-right" id="btnSelanjutnya"
                            onclick="tampilkanSoalSelanjutnya()">Selanjutnya</button>
                        <form action="{{ route('siswas.selesai') }}" method="POST" id="formSelesai">
                            @csrf
                            <input type="hidden" value="{{ $idUj }}" name="idUj">
                            <button type="button" class="btn btn-success pull-right" id="btnSelesai"
                                style="display: none;" onclick="konfirmasiSelesai()">Selesai</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="soalModal" tabindex="-1" role="dialog" aria-labelledby="soalModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="soalModalLabel">Pastikan Tidak Ada Soal Terlewat</h4>
                </div>
                <div class="modal-body">
                    <!-- Generate buttons for each question -->
                    @foreach ($soal as $sl)
                        @php
                            $isSoalJawabanNotNull = !is_null($sl->soal_jawaban);
                        @endphp

                        <button type="button"
                            class="btn btn-{{ $isSoalJawabanNotNull ? 'success' : 'default' }} btn-soal"
                            data-nomor="{{ $loop->iteration }}" style="width: 19%">
                            {{ $loop->iteration }}
                        </button>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery 3 -->
    <script src="{{ asset('AdminLTE-2/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('AdminLTE-2/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('AdminLTE-2/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE-2/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('AdminLTE-2/dist/js/demo.js') }}"></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var currentSoalIndex = 0;
        var jumlahSoal = {{ count($soal) }};

        document.addEventListener("DOMContentLoaded", function() {
            // Retrieve the current question index from local storage
            var storedIndex = localStorage.getItem('currentSoalIndex');

            // Set the current question index, or use 0 if not stored (first question)
            currentSoalIndex = storedIndex !== null ? parseInt(storedIndex) : 0;

            console.log("Stored Index:", storedIndex); // Tambahkan log ini

            var jumlahSoal = {{ count($soal) }};
            console.log("Jumlah Soal:", jumlahSoal); // Tambahkan log ini

            tampilkanSoal();
            updateNavigationButtons();
        });

        function updateNavigationButtons() {
            // Hide/show "Sebelumnya" button based on the current question index
            document.getElementById("btnSebelumnya").style.display = (currentSoalIndex === 0) ? "none" : "block";

            // Hide/show "Selanjutnya" and "Selesai" buttons based on the current question index
            if (currentSoalIndex === jumlahSoal - 1) {
                document.getElementById("btnSelanjutnya").style.display = "none";
                document.getElementById("btnSelesai").style.display = "block";
            } else {
                document.getElementById("btnSelanjutnya").style.display = "block";
                document.getElementById("btnSelesai").style.display = "none";
            }
        }

        function tampilkanSoalSebelumnya() {
            if (currentSoalIndex > 0) {
                currentSoalIndex--;
                tampilkanSoal();
            }
        }

        function tampilkanSoalSelanjutnya() {
            if (currentSoalIndex < jumlahSoal - 1) {
                currentSoalIndex++;
                tampilkanSoal();
            }
        }

        function tampilkanSoal() {
            var soalContainer = document.getElementById("soal-container");
            var soalDivs = soalContainer.getElementsByTagName("div");

            // Hide all questions
            for (var i = 0; i < soalDivs.length; i++) {
                soalDivs[i].style.display = "none";
            }

            // Show the current question
            soalDivs[currentSoalIndex].style.display = "block";

            // Update navigation buttons visibility
            updateNavigationButtons();
        }

        function refreshHalaman() {
            // Save the current question index to local storage
            localStorage.setItem('currentSoalIndex', currentSoalIndex);
            location.reload();
        }
        document.addEventListener("DOMContentLoaded", function() {
            // Retrieve the current question index from local storage
            var storedIndex = localStorage.getItem('currentSoalIndex');

            // Set the current question index, or use 0 if not stored (first question)
            currentSoalIndex = storedIndex !== null ? parseInt(storedIndex) : 0;

            tampilkanSoal();
            updateNavigationButtons();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.answer-btn').click(function() {
                // Ambil data dari tombol jawaban
                var idSoal = $(this).parent().find('input[name="id_soal"]').val();
                var jawaban = $(this).data('answer');

                // Ambil container pertanyaan
                var pertanyaanContainer = $(this).closest('.pertanyaan-' + idSoal);

                // Remove btn-success class from all buttons within the current question container
                pertanyaanContainer.find('.answer-btn').removeClass('btn-success');

                // Tambahkan class btn-success pada tombol yang ditekan
                $(this).addClass('btn-success');

                // Kirim permintaan Ajax
                $.ajax({
                    type: 'POST',
                    url: '{{ route('siswas.update') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_soal: idSoal,
                        jawaban: jawaban
                    },
                    success: function(response) {
                        // Handle response jika diperlukan
                        console.log(response);
                    },
                    error: function(error) {
                        // Handle error jika diperlukan
                        console.log(error);
                    }
                });
            });
        });
        $(document).ready(function() {
            // Handle click event for each question button in the modal
            $('.btn-soal').click(function() {
                var nomorSoal = $(this).data('nomor');

                // Set the current question index
                currentSoalIndex = nomorSoal - 1;

                // Display the corresponding question in the modal
                tampilkanSoal();

                // Close the modal
                $('#soalModal').modal('hide');
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let exitFullscreenCount = 0;

            // // Tampilkan SweetAlert pertama saat halaman dimuat
            Swal.fire({
                title: 'Kerjakan dengan jujur',
                icon: 'info',
                confirmButtonText: 'OK'
            }).then((result) => {
                // Setelah user menekan OK, masuk ke mode fullscreen
                if (result.isConfirmed) {
                    toggleFullScreen();
                }
            });

            // Fungsi untuk masuk/keluar dari mode fullscreen
            function toggleFullScreen() {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen().then(() => {
                        // Tampilkan SweetAlert kedua saat keluar dari mode fullscreen
                        document.addEventListener('fullscreenchange', function() {
                            if (!document.fullscreenElement) {
                                exitFullscreenCount++;

                                if (exitFullscreenCount >= 2) {
                                    // Kirim data ke endpoint pada controller
                                    sendDataToController(exitFullscreenCount);
                                } else {
                                    Swal.fire({
                                        title: 'Anda melakukan kecurangan, point akan dikurangi',
                                        icon: 'warning',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // Setelah user menekan OK, kembali ke mode fullscreen
                                        toggleFullScreen();
                                    });
                                }
                            }
                        });
                    });
                } else {
                    document.exitFullscreen();
                }
            }

            // Fungsi untuk mengirim data ke controller
            function sendDataToController(exitFullscreenCount) {
                // Menggunakan Fetch API untuk mengirim data ke controller
                fetch('/siswas/updateStatus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        exitFullscreenCount: exitFullscreenCount
                    })
                }).then(response => {
                    // Handle response jika diperlukan
                    return response.json();
                }).then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Akun Anda Diblokir',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Redirect ke halaman logout setelah menekan OK
                            window.location.href = '/logout';
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal memperbarui status',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }).catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    </script>




    <script>
        function konfirmasiSelesai() {
            Swal.fire({
                title: 'Apakah Anda yakin mengakhiri ujian?',
                text: 'Pastikan semua soal sudah terjawab.',
                // input: 'checkbox',
                inputValue: false, // Set default checkbox tidak dicentang
                // inputPlaceholder: 'Saya yakin',
                showCancelButton: true,
                confirmButtonText: 'Selesai',
                cancelButtonText: 'Batal',
                inputValidator: (result) => {
                    return !result && 'Anda harus setuju untuk melanjutkan!'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Checkbox dicentang, eksekusi formulir
                    document.getElementById('formSelesai').submit();
                }
            });
        }
    </script>



</body>

</html>
