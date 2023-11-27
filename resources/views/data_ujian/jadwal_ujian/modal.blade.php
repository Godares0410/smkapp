<!-- Modal -->

{{-- <div class="modal fade" id="modal-form" tabindex="-1" role="dialog"> --}}
<div class="modal fade" id="modalTambahJenis" tabindex="-1" role="dialog" aria-labelledby="modalTambahJenisLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('jadwal_ujian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="bank_ujian">Pilih Bank Ujian</label>
                        <select class="form-control" id="bank_ujian" name="bank_ujian" required>
                            @foreach ($bank as $ujn)
                                @php
                                    $decodedIdJurusanValues = json_decode($ujn->id_jurusan, true);
                                    $matchingKodeJurusanValues = \App\Models\Jurusan::whereIn('id_jurusan', $decodedIdJurusanValues)
                                        ->pluck('kode_jurusan')
                                        ->toArray();
                                @endphp
                                <option value="{{ $ujn->id_bank_ujian }}">{{ $ujn->nama_ujian }} :
                                    {{ $ujn->nama_mapel }} {{ $ujn->nama_kelas }}-(
                                    @foreach ($matchingKodeJurusanValues as $index => $kodeJurusan)
                                        {{ $kodeJurusan }}
                                        @if ($index < count($matchingKodeJurusanValues) - 1)
                                            ,
                                        @endif
                                    @endforeach
                                    )
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jurusan_mapel">Sesi :</label><br>
                        <input type="checkbox" id="pilihSemua"> Select All<br>
                        @foreach ($sesi as $ss)
                            <input type="checkbox" name="sesi[]" value="{{ $ss->id_sesi }}" class="sesi-checkbox">
                            {{ $ss->nama_sesi }}<br>
                        @endforeach
                    </div>
                    
                    <div class="form-group">
                        <label for="durasi">Durasi</label>
                        <input type="text" class="form-control" id="durasi" name="durasi" placeholder="Dalam Satuan Menit" required>
                    </div>
                    <div class="form-group">
                        <label for="mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="mulai" name="mulai" placeholder="UAS" required>
                    </div>
                    <div class="form-group">
                        <label for="selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="selesai" name="selesai" placeholder="UAS" required>
                    </div>
                    
                    @foreach ($sesi as $ss)
                        <div class="form-group jam-fields" id="jam-fields-{{ $ss->id_sesi }}" style="display: none;">
                            <h5>Atur Sesi {{ $ss->nama_sesi }}</h5>
                            <label for="jam_mulai_{{ $ss->id_sesi }}">Jam Mulai</label>
                            <input type="time" class="form-control" id="jam_mulai_{{ $ss->id_sesi }}"
                                name="jam_mulai[]" placeholder="UAS" onchange="checkValue(this)">
                    
                            <label for="jam_selesai_{{ $ss->id_sesi }}">Jam Selesai</label>
                            <input type="time" class="form-control" id="jam_selesai_{{ $ss->id_sesi }}"
                                name="jam_selesai[]" placeholder="UAS" onchange="checkValue(this)">
                        </div>
                    @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
