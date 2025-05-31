<?php
// Menghubungkan file ini dengan file konfigurasi database
include("config.php");

// Membuat query SQL untuk mengambil semua data dari tabel 'monitoring' dan mengurutkannya berdasarkan tanggal terbaru (DESC = descending)
$sql = "SELECT * FROM monitoring ORDER BY tanggal DESC";

// Mengeksekusi query dan menyimpan hasilnya dalam variabel $query
$query = mysqli_query($db, $sql);

// Inisialisasi nomor urut untuk data yang akan ditampilkan
$no = 1;

// Melakukan perulangan untuk mengambil setiap baris data dari hasil query
while($value = mysqli_fetch_assoc($query)){
    echo "<tr>"; // Membuka baris tabel

    // Menampilkan nomor urut dan memastikan data aman dengan htmlspecialchars untuk menghindari serangan XSS
    echo "<td>".htmlspecialchars($no)."</td>";           
    echo "<td>".htmlspecialchars($value['ph'])."</td>";            // Menampilkan data pH
    echo "<td>".htmlspecialchars($value['oksigen'])."</td>";       // Menampilkan data oksigen
    echo "<td>".htmlspecialchars($value['elektrik'])."</td>";      // Menampilkan data konduktivitas listrik
    echo "<td>".htmlspecialchars($value['suhu'])."</td>";          // Menampilkan data suhu
    echo "<td>".htmlspecialchars($value['level'])."</td>";         // Menampilkan data level air
    echo "<td>".htmlspecialchars($value['tanggal'])."</td>";       // Menampilkan data tanggal pencatatan
    echo "<td>".htmlspecialchars($value['kategori'])."</td>";      // Menampilkan kategori hasil pemantauan

    echo "</tr>"; // Menutup baris tabel

    $no++; // Menambah nilai nomor urut untuk baris berikutnya
}
?>
