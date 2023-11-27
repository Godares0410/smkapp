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
            <form id="importForm" action="{{ route('soal.import', ['id_bank_soal' => $bank->id_bank_soal]) }}" method="post" enctype="multipart/form-data">
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

{{-- Upload Image --}}
<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="modalFotoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <form id="importForm" action="{{ route('soal_foto.upload', ['id_bank_soal' => $bank->id_bank_soal]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body md-10">

                    <div class="form-group mt-10">
                        <input type="file" name="images[]" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Your modal code -->
@foreach ($soal as $data)
    <div class="modal fade" id="modalDetail{{ $data->id_soal }}" tabindex="-1" role="dialog"
        aria-labelledby="modalDetailLabel{{ $data->id_soal }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailLabel{{ $data->id_soal }}">Foto Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <button class="btn btn-primary zoom-in-btn">Zoom In</button>
                        <button class="btn btn-primary zoom-out-btn">Zoom Out</button>
                    </div>
                    <img src="{{ $data->file_1 ? asset('bank_soal/'. $bank->nama_bank_soal . '/' . $data->file_1) : asset('img/siswa/man.png') }}" alt="Foto Siswa"
                        class="img-fluid zoomable" style="width: 100%">
                </div>
            </div>
        </div>
    </div>
@endforeach