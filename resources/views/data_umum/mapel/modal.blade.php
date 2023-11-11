<!-- Modal -->

{{-- <div class="modal fade" id="modal-form" tabindex="-1" role="dialog"> --}}
<div class="modal fade" id="modalTambahMapel" tabindex="-1" role="dialog" aria-labelledby="modalTambahMapelLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('mapel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_mapel">Nama Mapel:</label>
                        <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" required><br>
                    </div>
                    <div class="form-group">
                        <label for="kode_mapel">Kode Mapel:</label>
                        <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" required><br>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelas">Kelas Mapel:</label>
                        <select id="nama_kelas" class="form-control" name="nama_kelas" required>
                            @foreach ($kelas as $kelas_item)
                                <option value="{{ $kelas_item->nama_kelas }}">{{ $kelas_item->nama_kelas }}</option>
                            @endforeach
                        </select><br>
                    </div>
                    {{-- <label for="jurusan_mapel">Jurusan Mapel:</label><br>
                    <input type="checkbox" id="selectAll"> Select All<br>
                    @foreach ($jurusan as $jurusan_item)
                        <input type="checkbox" name="jurusan_mapel[]" value="{{ $jurusan_item->kode_jurusan }}">
                        {{ $jurusan_item->kode_jurusan }}<br>
                    @endforeach --}}

                    <button type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
            <form id="importForm" action="{{ route('mapel.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body md-10">
                    <div class="form-group">
                        <label for="file">Upload File Harus Sesuai Template!</label>
                        <a href="{{ url('/download-template-mapel') }}" class="btn btn-success btn-xs">Download
                            Template
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
