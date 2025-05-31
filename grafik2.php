<?php include("config.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Kualitas Air</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
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
        .chart-container {
            position: relative;
            height: 40vh;
            width: 100%;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .card {
            margin-top: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 1.2rem;
            padding: 15px;
        }
        @media (max-width: 768px) {
            .chart-container {
                height: 50vh;
            }
            .header-title {
                font-size: 1.8rem;
            }
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
    <h1 class="header-title">Grafik Kualitas Air Sungai</h1>
</div>

<!-- Grafik -->
<div class="container">
    <div class="row">
        <!-- Card untuk Grafik pH -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik pH</h5>
                    <div class="chart-container">
                        <canvas id="phChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card untuk Grafik Oksigen -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Oksigen Terlarut</h5>
                    <div class="chart-container">
                        <canvas id="oksigenChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Card untuk Grafik Suhu -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Suhu (°C)</h5>
                    <div class="chart-container">
                        <canvas id="suhuChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card untuk Grafik Level Air -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Level Air</h5>
                    <div class="chart-container">
                        <canvas id="levelChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Card untuk Grafik Electric Conductivity -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Electric Conductivity (EC)</h5>
                    <div class="chart-container">
                        <canvas id="ecChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ambil data dari database menggunakan PHP dan kirim ke JavaScript -->
<?php
    $sql = "SELECT ph, oksigen, elektrik, suhu, level, tanggal FROM monitoring ORDER BY tanggal DESC LIMIT 20";
    $query = mysqli_query($db, $sql);

    $ph = [];
    $oksigen = [];
    $suhu = [];
    $level = [];
    $electric = [];
    $tanggal = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $ph[] = $row['ph'];
        $oksigen[] = $row['oksigen'];
        $suhu[] = $row['suhu'];
        $level[] = $row['level'];
        $electric[] = $row['elektrik'];
        $tanggal[] = $row['tanggal'];
    }
?>

<script>
    var phData = <?php echo json_encode($ph); ?>;
    var oksigenData = <?php echo json_encode($oksigen); ?>;
    var suhuData = <?php echo json_encode($suhu); ?>;
    var levelData = <?php echo json_encode($level); ?>;
    var ecData = <?php echo json_encode($electric); ?>;
    var tanggalData = <?php echo json_encode($tanggal); ?>;

    // Konfigurasi Grafik pH
    var ctxPh = document.getElementById('phChart').getContext('2d');
    var phChart = new Chart(ctxPh, {
        type: 'line',
        data: {
            labels: tanggalData.reverse(),
            datasets: [{
                label: 'pH',
                data: phData.reverse(),
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Konfigurasi Grafik Oksigen
    var ctxOksigen = document.getElementById('oksigenChart').getContext('2d');
    var oksigenChart = new Chart(ctxOksigen, {
        type: 'line',
        data: {
            labels: tanggalData.reverse(),
            datasets: [{
                label: 'Oksigen Terlarut',
                data: oksigenData.reverse(),
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Konfigurasi Grafik Suhu
    var ctxSuhu = document.getElementById('suhuChart').getContext('2d');
    var suhuChart = new Chart(ctxSuhu, {
        type: 'line',
        data: {
            labels: tanggalData.reverse(),
            datasets: [{
                label: 'Suhu (°C)',
                data: suhuData.reverse(),
                borderColor: 'rgba(255, 206, 86, 1)',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Konfigurasi Grafik Level Air
    var ctxLevel = document.getElementById('levelChart').getContext('2d');
    var levelChart = new Chart(ctxLevel, {
        type: 'line',
        data: {
            labels: tanggalData.reverse(),
            datasets: [{
                label: 'Level Air',
                data: levelData.reverse(),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Konfigurasi Grafik Electric Conductivity (EC)
    var ctxEc = document.getElementById('ecChart').getContext('2d');
    var ecChart = new Chart(ctxEc, {
        type: 'line',
        data: {
            labels: tanggalData.reverse(),
            datasets: [{
                label: 'Electric Conductivity (EC)',
                data: ecData.reverse(),
                borderColor: 'rgba(153, 102, 255, 1)',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
</script>

</body>
</html>
