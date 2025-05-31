<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <!-- Menentukan karakter encoding dokumen sebagai UTF-8 agar mendukung berbagai karakter internasional -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Mengatur tampilan responsif agar sesuai dengan ukuran layar perangkat -->

    <title>Dashboard</title>
    <!-- Judul halaman yang akan ditampilkan di tab browser -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Menghubungkan CSS Bootstrap untuk memudahkan styling dan layout responsif -->

    <style>
        /* Mengatur latar belakang halaman dengan gambar */
        body {
            background-image: url('images/bg2.png'); /* Menggunakan gambar sebagai background */
            background-size: cover; /* Menyesuaikan ukuran gambar agar menutupi seluruh layar */
            background-position: center; /* Memposisikan gambar di tengah */
            background-attachment: fixed; /* Membuat background tetap saat scrolling */
            color: black; /* Warna teks default hitam */
            font-family: Arial, sans-serif; /* Menggunakan font Arial atau sans-serif sebagai alternatif */
        }

        /* Styling untuk Navbar */
        .navbar {
            background-color: white; /* Navbar berwarna putih */
        }

        /* Styling untuk link dalam navbar */
        .navbar a {
            color: black !important; /* Warna teks hitam */
            font-weight: bold; /* Teks dibuat tebal */
            margin-right: 20px; /* Jarak antar link dalam navbar */
            padding: 5px 10px; /* Padding dalam link */
            transition: all 0.3s ease; /* Animasi perubahan warna saat hover */
        }

        /* Efek hover pada link navbar */
        .navbar a:hover {
            background-color: black; /* Warna latar belakang berubah menjadi hitam saat hover */
            color: white !important; /* Warna teks berubah menjadi putih */
            border-radius: 5px; /* Membuat sudut membulat */
        }

        /* Styling untuk bagian teks dan gambar di tengah halaman */
        .centered {
            display: flex; /* Menggunakan flexbox untuk penataan elemen */
            justify-content: flex-start; /* Menempatkan konten di sebelah kiri */
            align-items: center; /* Menengahkan elemen secara vertikal */
            height: 80vh; /* Mengatur tinggi elemen agar 80% dari tinggi viewport */
            padding-left: 50px; /* Jarak dari sisi kiri */
        }

        /* Styling untuk teks judul dalam section centered */
        .centered h1 {
            font-size: 3rem; /* Ukuran font besar */
            font-weight: normal; /* Ketebalan font normal */
            line-height: 1.2; /* Mengatur tinggi baris */
        }

        /* Styling untuk bagian teks yang diberi efek italic dan bold */
        .centered h1 span {
            font-style: italic; /* Teks miring */
            font-weight: bold; /* Teks tebal */
        }

        /* Styling untuk gambar dalam section centered */
        .centered img {
            margin-left: 50px; /* Memberi jarak gambar dari teks */
            max-width: 50%; /* Membatasi ukuran gambar maksimal 50% dari container */
            height: auto; /* Memastikan rasio aspek tetap */
        }
    </style>
</head>
<body>

    <!-- Navbar (Navigasi) -->
    <nav class="navbar navbar-expand-sm">
        <div class="container justify-content-center">
            <!-- Menu navigasi dengan link ke berbagai halaman -->
            <a class="navbar-brand" href="graphmerger.php">Filter Grafik</a>
            <a class="navbar-brand" href="realtime.php">Data Real Time</a>
            <a class="navbar-brand" href="datatabel.php">Data Updated</a>
            <a class="navbar-brand" href="grafik.php">Grafik Gabungan</a>
            <a class="navbar-brand" href="grafik2.php">Grafik</a>
        </div>
    </nav>

    <!-- Menghubungkan JavaScript eksternal -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- Library jQuery untuk mempermudah manipulasi DOM dan AJAX -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript Bootstrap untuk mendukung komponen interaktif seperti dropdown dan modal -->

</body>
</html>
