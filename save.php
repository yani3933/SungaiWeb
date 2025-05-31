<?php
// Sertakan file konfigurasi untuk koneksi database
include("config.php");

// Tampilkan semua error untuk debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Cek apakah parameter GET tersedia
if (isset($_GET['ph'], $_GET['oksigen'], $_GET['elektrik'], $_GET['suhu'], $_GET['level'], $_GET['kategori'])) {

    // Ambil nilai dari URL (GET)
    $ph = $_GET['ph'];
    $oksigen = $_GET['oksigen'];
    $elektrik = $_GET['elektrik'];
    $suhu = $_GET['suhu'];
    $level = $_GET['level'];
    $kategori = $_GET['kategori'];

    // Validasi dan sanitasi data
    if (is_numeric($ph) && is_numeric($oksigen) && is_numeric($elektrik) && is_numeric($suhu) && is_numeric($level) && is_numeric($kategori)) {

        // Tentukan kategori berdasarkan nilai
        if ($kategori >= 95) {
            $kategori_text = 'Sangat Baik';
        } elseif ($kategori >= 80) {
            $kategori_text = 'Baik';
        } elseif ($kategori >= 65) {
            $kategori_text = 'Sedang';
        } elseif ($kategori >= 45) {
            $kategori_text = 'Buruk';
        } else {
            $kategori_text = 'Sangat Buruk';
        }

        // Siapkan query SQL
        $sql = "INSERT INTO monitoring (ph, oksigen, elektrik, suhu, level, kategori) 
                VALUES (?, ?, ?, ?, ?, ?)";

        // Gunakan prepared statement untuk keamanan
        $stmt = mysqli_prepare($db, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ddddds", $ph, $oksigen, $elektrik, $suhu, $level, $kategori_text);
            $result = mysqli_stmt_execute($stmt);

            // Cek keberhasilan eksekusi
            if ($result) {
                echo "Data berhasil disimpan.";
            } else {
                echo "Gagal menyimpan data: " . mysqli_error($db);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Gagal mempersiapkan query: " . mysqli_error($db);
        }
    } else {
        echo "Input tidak valid.";
    }
} else {
    echo "Parameter tidak lengkap.";
}

?>
