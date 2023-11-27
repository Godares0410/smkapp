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
                <form action="{{ route('bankujian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="jenis">Jenis Ujian</label>
                        <select class="form-control" id="jenis" name="jenis" required>
                            @foreach ($jenis as $jns)
                                <option value="{{ $jns->id_jenis }}">{{ $jns->nama_ujian }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            @foreach ($kelas as $kls)
                                <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mapel">Mapel</label>
                        <select class="form-control" id="mapel" name="mapel" required>
                            <option value="pilih_kelas">Pilih Mapel</option>
                            @foreach ($mapel as $mpl)
                                @php
                                    $decodedIdJurusanValues = json_decode($mpl->id_jurusan, true);
                                    $matchingKodeJurusanValues = \App\Models\Jurusan::whereIn('id_jurusan', $decodedIdJurusanValues)
                                        ->pluck('kode_jurusan')
                                        ->toArray();
                                @endphp
                                <option class="mapel-option" value="{{ $mpl->id_mapel }}"
                                    data-kelas="{{ $mpl->id_kelas }}">
                                    {{ $mpl->nama_mapel }} (
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
                        <label for="bank_soal">Bank Soal</label><br>
                        <div id="bankSoalContainer">
                            <!-- Konten bank soal akan ditambahkan di sini secara dinamis -->
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="selectAll" style="display: none">
                        @foreach ($jurusan as $jurusan_item)
                            <input type="checkbox" value="{{ $jurusan_item->id_jurusan }}" style="display: none">
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="jurusan_mapel">Jurusan Mapel:</label><br>
                        <input type="checkbox" id="pilihSemua"> Select All<br>
                        @foreach ($jurusan as $jurusan_item)
                            <input type="checkbox" name="jurusan_mapel[]" value="{{ $jurusan_item->id_jurusan }}">
                            {{ $jurusan_item->kode_jurusan }}<br>
                        @endforeach
                    </div>
                    {{-- <div class="form-group">
                        <label for="durasi">Durasi</label>
                        <input type="text" class="form-control" id="durasi" name="durasi" placeholder="Masukkan Jumlah Soal"
                            required>
                    </div> --}}
                    <div class="form-group">
                        <label for="jumlah_soal">Jumlah Soal</label>
                        <input type="text" class="form-control" id="jumlah_soal" name="jumlah_soal"
                            placeholder="Masukkan Jumlah Soal" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_opsi">Jumlah Opsi</label>
                        <select class="form-control" id="jumlah_opsi" name="jumlah_opsi" required>
                            <option value=4>4</option>
                            <option value=5 selected>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="acak_soal">Acak Soal</label>
                        <select class="form-control" id="acak_soal" name="acak_soal" required>
                            <option value=1 selected>Acak</option>
                            <option value=0>Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="acak_jawaban">Acak Jawaban</label>
                        <select class="form-control" id="acak_jawaban" name="acak_jawaban" required>
                            <option value=1>Acak</option>
                            <option value=0 selected>Tidak</option>
                        </select>
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

{{-- MODAL EDIT --}}
@foreach ($mapel as $data)
    <div class="modal fade" id="modalEdit{{ $data->id_mapel }}" tabindex="-1" role="dialog"
        aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mapel.update', $data->id_mapel) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_mapel">Nama Mapel:</label>
                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel"
                                value="{{ $data->nama_mapel }}" required><br>
                        </div>
                        <div class="form-group">
                            <label for="kode_mapel">Kode Mapel:</label>
                            <input type="text" class="form-control" id="kode_mapel" name="kode_mapel"
                                value="{{ $data->kode_mapel }}" required><br>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select class="form-control" id="kelas" name="kelas" required>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id_kelas }}"
                                        {{ $kls->id_kelas == $data->id_kelas ? 'selected' : '' }}>
                                        {{ $kls->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jurusan_mapel">Jurusan Mapel:</label><br>
                            <input type="checkbox" id="selectAll"> Select All<br>
                            @php
                                $selectedJurusan = json_decode($data->id_jurusan);
                            @endphp
                            @foreach ($jurusan as $jurusan_item)
                                <input type="checkbox" name="jurusan_mapel[]"
                                    value="{{ $jurusan_item->id_jurusan }}"
                                    {{ in_array($jurusan_item->id_jurusan, $selectedJurusan) ? 'checked' : '' }}>
                                {{ $jurusan_item->kode_jurusan }}<br>
                            @endforeach
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
