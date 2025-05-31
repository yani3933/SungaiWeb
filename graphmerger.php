<?php include("config.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Monitoring Kualitas Air Sungai</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Custom CSS */
        body { background-color: #f8f9fa; }
        .navbar { background-color: white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); }
        .navbar a { font-weight: bold; padding: 10px 15px; color: #333 !important; }
        .navbar a:hover { background-color: #333; color: #fff !important; border-radius: 5px; }
        .header-title { margin-top: 20px; font-size: 2rem; font-weight: bold; text-align: center; color: #333; border-bottom: 2px solid #007bff; padding-bottom: 20px; }
        .container { margin-top: 30px; }
        .form-row { margin-bottom: 20px; }
        .form-control { border-radius: 5px; padding: 10px; }
        .btn-primary { background-color: #007bff; border: none; font-weight: bold; padding: 10px 20px; transition: background-color 0.3s ease; }
        .btn-primary:hover { background-color: #0056b3; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); }
        .chart-container { position: relative; height: 60vh; width: 100%; margin: auto; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); background-color: #fff; padding: 20px; }
        .card { margin-top: 30px; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); }
        .card-header { background-color: #007bff; color: white; font-weight: bold; text-align: center; font-size: 1.2rem; padding: 15px; }
    </style>
</head>
<body>

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

<div class="container">
    <h1 class="header-title">Filter Grafik Kualitas Air Sungai</h1>
</div>

<div class="container">
    <form id="dateRangeForm">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <label for="startDate">Tanggal Awal:</label>
                <input type="date" class="form-control mb-2" id="startDate" required>
            </div>
            <div class="col-auto">
                <label for="endDate">Tanggal Akhir:</label>
                <input type="date" class="form-control mb-2" id="endDate" required onchange="checkDateRange()">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">Tampilkan Grafik</button>
            </div>
        </div>
    </form>

    <div class="chart-container">
        <canvas id="qualityChart"></canvas>
    </div>

    <div class="card">
        <div class="card-header">Grafik Variabel Kualitas Air</div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="phChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="oksigenChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="suhuChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="levelChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="elektrikChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?php
// Ambil data dari database
$sql = "SELECT ph, oksigen, elektrik, suhu, level, tanggal FROM monitoring ORDER BY tanggal DESC LIMIT 20";
$query = mysqli_query($db, $sql);

if (!$query) {
    die("Query gagal: " . mysqli_error($db));
}

$data = [
    "ph" => [],
    "oksigen" => [],
    "suhu" => [],
    "level" => [],
    "elektrik" => [],
    "tanggal" => []
];

while ($row = mysqli_fetch_assoc($query)) {
    $data["ph"][] = $row["ph"];
    $data["oksigen"][] = $row["oksigen"];
    $data["suhu"][] = $row["suhu"];
    $data["level"][] = $row["level"];
    $data["elektrik"][] = $row["elektrik"];
    $data["tanggal"][] = $row["tanggal"];
}

// Kirim data ke JavaScript
?>
<script>
    var chartData = <?php echo json_encode($data); ?>;

    function checkDateRange() {
        const startDate = new Date(document.getElementById('startDate').value);
        const endDate = new Date(document.getElementById('endDate').value);

        if (endDate < startDate) {
            alert("Tanggal akhir tidak boleh sebelum tanggal awal.");
            document.getElementById('endDate').value = '';
        }
    }

    // Fungsi untuk memperbarui grafik berdasarkan rentang tanggal
    function updateChart(startDate, endDate) {
        const filteredData = {
            ph: [],
            oksigen: [],
            suhu: [],
            level: [],
            elektrik: [],
            tanggal: []
        };

        for (let i = 0; i < chartData.tanggal.length; i++) {
            const date = new Date(chartData.tanggal[i]);
            if (date >= new Date(startDate) && date <= new Date(endDate)) {
                filteredData.ph.push(chartData.ph[i]);
                filteredData.oksigen.push(chartData.oksigen[i]);
                filteredData.suhu.push(chartData.suhu[i]);
                filteredData.level.push(chartData.level[i]);
                filteredData.elektrik.push(chartData.elektrik[i]);
                filteredData.tanggal.push(chartData.tanggal[i]);
            }
        }

        // Update grafik utama
        qualityChart.data.labels = filteredData.tanggal;
        qualityChart.data.datasets[0].data = filteredData.ph;
        qualityChart.data.datasets[1].data = filteredData.oksigen;
        qualityChart.data.datasets[2].data = filteredData.suhu;
        qualityChart.data.datasets[3].data = filteredData.level;
        qualityChart.data.datasets[4].data = filteredData.elektrik;
        qualityChart.update();

        // Update grafik individu
        updateIndividualCharts(filteredData);
    }

    function updateIndividualCharts(filteredData) {
        phChart.data.labels = filteredData.tanggal;
        phChart.data.datasets[0].data = filteredData.ph;
        phChart.update();

        oksigenChart.data.labels = filteredData.tanggal;
        oksigenChart.data.datasets[0].data = filteredData.oksigen;
        oksigenChart.update();

        suhuChart.data.labels = filteredData.tanggal;
        suhuChart.data.datasets[0].data = filteredData.suhu;
        suhuChart.update();

        levelChart.data.labels = filteredData.tanggal;
        levelChart.data.datasets[0].data = filteredData.level;
        levelChart.update();

        elektrikChart.data.labels = filteredData.tanggal;
        elektrikChart.data.datasets[0].data = filteredData.elektrik;
        elektrikChart.update();
    }

    // Inisialisasi grafik utama
    var ctx = document.getElementById('qualityChart').getContext('2d');
    var qualityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.tanggal.reverse(),
            datasets: [
                { label: 'pH', data: chartData.ph.reverse(), borderColor: 'rgba(255, 99, 132, 1)', backgroundColor: 'rgba(255, 99, 132, 0.2)', fill: true },
                { label: 'Oksigen', data: chartData.oksigen.reverse(), borderColor: 'rgba(54, 162, 235, 1)', backgroundColor: 'rgba(54, 162, 235, 0.2)', fill: true },
                { label: 'Suhu', data: chartData.suhu.reverse(), borderColor: 'rgba(255, 206, 86, 1)', backgroundColor: 'rgba(255, 206, 86, 0.2)', fill: true },
                { label: 'Level', data: chartData.level.reverse(), borderColor: 'rgba(75, 192, 192, 1)', backgroundColor: 'rgba(75, 192, 192, 0.2)', fill: true },
                { label: 'Elektrik Conductivity', data: chartData.elektrik.reverse(), borderColor: 'rgba(153, 102, 255, 1)', backgroundColor: 'rgba(153, 102, 255, 0.2)', fill: true }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Inisialisasi grafik individu
    var phCtx = document.getElementById('phChart').getContext('2d');
    var phChart = new Chart(phCtx, {
        type: 'line',
        data: {
            labels: chartData.tanggal,
            datasets: [{ label: 'pH', data: chartData.ph, borderColor: 'rgba(255, 99, 132, 1)', backgroundColor: 'rgba(255, 99, 132, 0.2)', fill: true }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    var oksigenCtx = document.getElementById('oksigenChart').getContext('2d');
    var oksigenChart = new Chart(oksigenCtx, {
        type: 'line',
        data: {
            labels: chartData.tanggal,
            datasets: [{ label: 'Oksigen', data: chartData.oksigen, borderColor: 'rgba(54, 162, 235, 1)', backgroundColor: 'rgba(54, 162, 235, 0.2)', fill: true }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    var suhuCtx = document.getElementById('suhuChart').getContext('2d');
    var suhuChart = new Chart(suhuCtx, {
        type: 'line',
        data: {
            labels: chartData.tanggal,
            datasets: [{ label: 'Suhu', data: chartData.suhu, borderColor: 'rgba(255, 206, 86, 1)', backgroundColor: 'rgba(255, 206, 86, 0.2)', fill: true }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    var levelCtx = document.getElementById('levelChart').getContext('2d');
    var levelChart = new Chart(levelCtx, {
        type: 'line',
        data: {
            labels: chartData.tanggal,
            datasets: [{ label: 'Level', data: chartData.level, borderColor: 'rgba(75, 192, 192, 1)', backgroundColor: 'rgba(75, 192, 192, 0.2)', fill: true }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    var elektrikCtx = document.getElementById('elektrikChart').getContext('2d');
    var elektrikChart = new Chart(elektrikCtx, {
        type: 'line',
        data: {
            labels: chartData.tanggal,
            datasets: [{ label: 'Elektrik Conductivity', data: chartData.elektrik, borderColor: 'rgba(153, 102, 255, 1)', backgroundColor: 'rgba(153, 102, 255, 0.2)', fill: true }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // Menangani pengiriman form
    document.getElementById('dateRangeForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        updateChart(startDate, endDate);
    });
</script>

</body>
</html>
