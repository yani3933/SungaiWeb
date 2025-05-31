<?php
    // Koneksi ke database MySQL
    $conn = mysqli_connect("localhost", "root", "", "sungai");

    // Memeriksa apakah koneksi berhasil
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Membaca data dari tabel "monitoring", diurutkan berdasarkan ID secara descending (dari yang terbaru)
    $sql = mysqli_query($conn, "SELECT * FROM monitoring ORDER BY id DESC");

    // Mengambil satu baris data hasil query
    $data = mysqli_fetch_array($sql);

    // Mengambil nilai oksigen dari hasil query
    $oksigen = $data['oksigen'];

    // Jika nilai oksigen kosong (null), set menjadi 0
    if ($oksigen == "") $oksigen = 0;

    // Menampilkan nilai oksigen sebagai output
    echo $oksigen;
?>
