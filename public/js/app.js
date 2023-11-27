// Contoh menggunakan jQuery untuk AJAX
$.ajax({
    url: "/siswa/dashboard", // Ganti dengan URL yang sesuai
    method: "GET",
    success: function (response) {
        // Proses respons sukses
        console.log(response);
    },
    error: function (xhr) {
        // Tangkap pesan error
        var error = JSON.parse(xhr.responseText).error;

        // Tampilkan pesan error
        alert(error);

        // Redirect ke halaman login atau halaman lain jika diperlukan
        window.location.href = "/login"; // Ganti dengan URL yang sesuai
    },
});
