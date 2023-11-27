<!-- Modal -->
<div class="modal fade" id="modalTambahSesi" tabindex="-1" role="dialog" aria-labelledby="modalTambahSesiLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('sesi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_sesi">Nama Sesi</label>
                        <input type="text" class="form-control" id="nama_sesi" name="nama_sesi" placeholder="Sesi 1"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="kode_sesi">Kode Sesi</label>
                        <input type="text" class="form-control" id="kode_sesi" name="kode_sesi" placeholder="S1"
                            required>
                    </div>
                    <!-- Select untuk Jam -->
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label for="mulai">Jam Mulai</label>
                            <input type="time" name="mulai" class="form-control timepicker">
                        </div>
                    </div>
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label for="sampai">Jam Berakhir</label>
                            <input type="time" name="sampai" class="form-control timepicker">
                        </div>
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

<!-- Modal Edit-->
@foreach ($sesi as $data)
    <div class="modal fade" id="modalEdit{{ $data->id_sesi }}" tabindex="-1" role="dialog"
        aria-labelledby="modalEditSesiLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sesi.update', $data->id_sesi) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_sesi">Nama Sesi</label>
                            <input type="text" class="form-control" id="nama_sesi" name="nama_sesi"
                                placeholder="Sesi 1" value="{{ $data->nama_sesi }}" required>
                        </div>
                        <div class="form-group">
                            <label for="kode_sesi">Kode Sesi</label>
                            <input type="text" class="form-control" id="kode_sesi" name="kode_sesi" placeholder="S1"
                                value="{{ $data->kode_sesi }}" required>
                        </div>
                        <!-- Select untuk Jam -->
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="mulai">Jam Mulai</label>
                                <input type="time" name="mulai" class="form-control timepicker"
                                    value="{{ $data->mulai }}">
                            </div>
                        </div>
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="sampai">Jam Mulai</label>
                                <input type="time" name="sampai" class="form-control timepicker" value="{{ $data->sampai }}">
                            </div>
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
@endforeach
