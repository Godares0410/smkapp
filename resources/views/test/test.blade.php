<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Store Checkbox Form</title>
</head>

<body>
    <form method="post" action="{{ route('store') }}">
        @csrf
        <label for="nama_makanan">Nama Makanan:</label>
        <input type="text" name="nama_makanan" required>

        <label for="tipe_makanan">Tipe Makanan:</label><br>
        <input type="checkbox" name="tipe_makanan[]" value="makanan_utama"> Makanan Utama<br>
        <input type="checkbox" name="tipe_makanan[]" value="cemilan"> Cemilan<br>
        <input type="checkbox" name="tipe_makanan[]" value="pembuka"> Pembuka<br>
        <input type="checkbox" name="tipe_makanan[]" value="penutup"> Penutup<br>

        <button type="submit">Simpan</button>
    </form>

    <h1>Data Makanan</h1>

    <form action="{{ route('makanan') }}" method="GET">
        <label for="tipe_makanan">Filter berdasarkan Tipe Makanan:</label>
        <select name="tipe_makanan">
            <option value="makanan_utama">Makanan Utama</option>
            <option value="cemilan">Cemilan</option>
            <option value="pembuka">Pembuka</option>
            <option value="penutup">Penutup</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    @foreach ($makanans as $makanan)
        <p>Nama Makanan: {{ $makanan->nama_makanan }}</p>
        <p>Tipe Makanan: {{ implode(', ', json_decode($makanan->tipe_makanan)) }}</p>
        <hr>
    @endforeach
</body>
</body>

</html>
