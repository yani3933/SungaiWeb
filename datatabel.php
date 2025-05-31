<?php include("config.php"); ?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>Data Updated</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Load otomatis -->
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $('#sensorTableBody').load('load_sensor_data.php');
            }, 1000);
        });
    </script>
    <style>
        /* Custom styles for banner */
        .banner {
            background-image: url('images/latarbelakang.jpg');
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1020;
        }
        .banner h1 {
            color: white;
            text-align: center;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            width: 100%;
        }
        .navbar {
            background-color: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar a {
            font-weight: bold;
            padding: 10px 15px;
            color: #333 !important;
        }
        .navbar a:hover {
            background-color: #333;
            color: #fff !important;
            border-radius: 5px;
        }
        .header-title {
            margin-top: 20px;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            color: #333;
            border-bottom: 2px solid #007bff; /* Underline */
            padding-bottom: 20px;
        }
        .container {
            margin-top: 30px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm">
    <div class="container justify-content-center">
        <a class="navbar-brand" href="index.php">Home</a>
        <a class="navbar-brand" href="graphmerger.php">Filter Grafik</a>
        <a class="navbar-brand" href="realtime.php">Data Real-time</a>
        <a class="navbar-brand" href="datatabel.php">Data Updated</a>
        <a class="navbar-brand" href="grafik.php">Grafik Gabungan</a>
        <a class="navbar-brand" href="grafik2.php">Grafik</a>
    </div>
</nav>

<!-- Page Title -->
<div class="container">
    <h1 class="header-title">Data Updated Kualitas Air Sungai</h1>
</div>


<div class="container mt-4" style="text-align: center;">
    <div class="table-responsive">
        <!-- Tabel dengan zebra striping -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">NOMOR</th>
                    <th scope="col">pH</th>
                    <th scope="col">OKSIGEN</th>
                    <th scope="col">ELEKTRIK</th>
                    <th scope="col">SUHU</th>
                    <th scope="col">LEVEL</th>
                    <th scope="col">TANGGAL</th>
                    <th scope="col">KATEGORI</th>
                </tr>
            </thead>
            <tbody id="sensorTableBody">
                <!-- Data tabel akan dimuat di sini oleh load_sensor_data.php -->
                <?php
                $sql = "SELECT * FROM monitoring ORDER BY tanggal DESC";
                $query = mysqli_query($db, $sql);
                $no = 1;
                while($value = mysqli_fetch_assoc($query)){
                    // Kondisi untuk memberikan kelas warna berdasarkan nilai pH
                    $phClass = '';
                    if($value['ph'] > 7) {
                        $phClass = 'table-success'; // Warna hijau untuk pH di atas 7
                    } elseif($value['ph'] < 7) {
                        $phClass = 'table-danger'; // Warna merah untuk pH di bawah 7
                    } else {
                        $phClass = 'table-warning'; // Warna kuning untuk pH netral (7)
                    }

                    // Alternatif pewarnaan manual untuk setiap baris
                    if($no % 2 == 0) {
                        echo "<tr class='{$phClass} table-primary'>"; // Tambahan warna biru muda untuk baris genap
                    } else {
                        echo "<tr class='{$phClass} table-secondary'>"; // Tambahan warna abu-abu untuk baris ganjil
                    }

                    echo "<td>".htmlspecialchars($no)."</td>";           
                    echo "<td>".htmlspecialchars($value['ph'])."</td>";            
                    echo "<td>".htmlspecialchars($value['oksigen'])."</td>";            
                    echo "<td>".htmlspecialchars($value['elektrik'])."</td>";
                    echo "<td>".htmlspecialchars($value['suhu'])."</td>";
                    echo "<td>".htmlspecialchars($value['level'])."</td>";
                    echo "<td>".htmlspecialchars($value['tanggal'])."</td>"; 
                    echo "<td>".htmlspecialchars($value['kategori'])."</td>";                       
                    echo "</tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
