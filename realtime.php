<?php include("config.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Monitoring Kualitas Air</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
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
        .card {
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease; /* Efek transisi */
        }
        .card:hover {
            transform: translateY(-5px); /* Efek hover */
        }
        .card-header {
            font-size: 1.25rem;
            font-weight: bold;
            color: white;
            padding: 10px;
        }
        .card-header.kategori {
            background-color: #8C4FB7;
        }
        .card-header.pH {
            background-color: #FF6F61;
        }
        .card-header.oksigen {
            background-color: #F9A602;
        }
        .card-header.ec {
            background-color: #63ADF2;
        }
        .card-header.suhu {
            background-color: #2ecc71;
        }
        .card-header.level {
            background-color: #9b59b6;
        }
        .card-body h1 {
            font-size: 2rem;
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
    </style>

    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $('#cekph').load("cekph.php");
                $('#cekdo').load("cekdo.php");
                $('#cekec').load("cekec.php");
                $('#ceksuhu').load("ceksuhu.php");
                $('#ceklevel').load("ceklevel.php");
                $('#kategori').load("kategori.php"); // Update kategori setiap 1 detik
            }, 1000);
        });
    </script>
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


    <!-- Header Title -->
    <div class="header-title">Realtime Monitoring Kualitas Air</div>

    <!-- Container -->
    <div class="container">
        <div class="row">
            <!-- Kartu untuk pH -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-header pH">
                        <i class="fas fa-flask"></i> pH
                    </div>
                    <div class="card-body bg-light">
                        <h1><span id="cekph">0</span></h1>
                    </div>
                </div>
            </div>

            <!-- Kartu untuk Oksigen Terlarut -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-header oksigen">
                        <i class="fas fa-leaf"></i> Oksigen Terlarut
                    </div>
                    <div class="card-body bg-light">
                        <h1><span id="cekdo">0</span></h1>
                    </div>
                </div>
            </div>

            <!-- Kartu untuk Electric Conductivity -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-header ec">
                        <i class="fas fa-bolt"></i> Electric Conductivity
                    </div>
                    <div class="card-body bg-light">
                        <h1><span id="cekec">0</span></h1>
                    </div>
                </div>
            </div>

            <!-- Kartu untuk Suhu -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-header suhu">
                        <i class="fas fa-thermometer-half"></i> Suhu
                    </div>
                    <div class="card-body bg-light">
                        <h1><span id="ceksuhu">0</span></h1>
                    </div>
                </div>
            </div>

            <!-- Kartu untuk Level Air -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-header level">
                        <i class="fas fa-water"></i> Level Air
                    </div>
                    <div class="card-body bg-light">
                        <h1><span id="ceklevel">0</span></h1>
                    </div>
                </div>
            </div>

            <!-- Kartu untuk Kategori -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-header kategori">
                        <i class="fas fa-info-circle"></i> Kategori
                    </div>
                    <div class="card-body bg-light">
                        <h1><span id="kategori">-</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and jQuery JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
