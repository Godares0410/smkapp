<!-- Modal -->

{{-- <div class="modal fade" id="modal-form" tabindex="-1" role="dialog"> --}}
<div class="modal fade" id="modalTambahSiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahSiswaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            @foreach ($kelas as $kls)
                                <option value="{{ $kls->nama_kelas }}">{{ $kls->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select class="form-control" id="jurusan" name="jurusan" required>
                            @foreach ($jurusan as $jrs)
                                <option value="{{ $jrs->kode_jurusan }}">{{ $jrs->kode_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="rombel" name="rombel" required>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control-file" id="foto" name="foto">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

@foreach ($siswa as $data)
    <div class="modal fade" id="modalDetail{{ $data->id_siswa }}" tabindex="-1" role="dialog"
        aria-labelledby="modalDetailLabel{{ $data->id_siswa }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailLabel{{ $data->id_siswa }}">Detail Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Siswa:</strong> {{ $data->nama_siswa }}</p>
                    <p><strong>Kelas:</strong> {{ $data->kelas }}</p>
                    <p><strong>Jurusan:</strong> {{ $data->jurusan }}</p>
                    {{-- <img src="{{ asset('img/siswa/' . $data->foto) }}" alt="Foto Siswa" class="img-fluid" style="width: 100px"> --}}
                    <img src="{{ $data->foto ? asset('img/siswa/' . $data->foto) : asset('img/siswa/man.png') }}"alt="Foto Siswa"
                        class="img-fluid" style="width: 100px">
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <form id="importForm" action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body md-10">
                    <div class="form-group">
                        <label for="file">Upload File Harus Sesuai Template!</label>
                        <a href="{{ url('/download-template') }}" class="btn btn-success btn-xs">Download Template
                            Excel
                            <i class="fa fa-download"></i></a>
                    </div>

                    <div class="form-group mt-10">
                        <label for="file">Upload :</label>
                        <input type="file" name="file" id="file" required>
                        <p class="help-block">File harus berupa xls/xlsx</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
