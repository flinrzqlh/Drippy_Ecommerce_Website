<?php
// session check
session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Create connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drippy";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total revenue data
$totalRevenueSql = "SELECT SUM(total_price) as total_revenue, DATE(order_date) as order_date FROM orders GROUP BY DATE(order_date)";
$totalRevenueResult = $conn->query($totalRevenueSql);
$totalRevenueData = [];
$totalRevenueLabels = [];
while ($row = $totalRevenueResult->fetch_assoc()) {
    $totalRevenueData[] = $row['total_revenue'];
    $totalRevenueLabels[] = $row['order_date'];
}

// Fetch stock overview data
$stockOverviewSql = "SELECT product_name, quantity FROM products";
$stockOverviewResult = $conn->query($stockOverviewSql);
$stockOverviewData = [];
$stockOverviewLabels = [];
while ($row = $stockOverviewResult->fetch_assoc()) {
    $stockOverviewData[] = $row['quantity'];
    $stockOverviewLabels[] = $row['product_name'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DRIPPY Statistics</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="text-gray-800">
    <!-- Navigation Bar -->
    <nav class="sticky z-50 top-0 flex justify-between items-center px-8 py-4 bg-[#ffffff] shadow-[0_0_20px_rgba(0,0,0,0.25)]">
        <!-- Logo Section -->
        <div class="text-2xl md:text-4xl font-bold bg-[#ffffff] rounded-md flex justify-center items-center">
            <div class="p-2 rounded-full bg-[#ffffff] mr-3 shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                <img src="assets/logo/LogoDrippy.png" alt="drippy" class="w-10 h-10 md:w-12 md:h-12 inline-block">
            </div>
            <span class="text-[#050A30]">DRIPPY</span>
        </div>
        <!-- Navigation Buttons -->
        <div class="flex space-x-4">
            <!-- Statistics -->
            <a href="statistics.php" class="p-2 rounded-lg bg-[#ffffff] transform transition-all duration-300 hover:scale-110 shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                <img src="assets/icon/statisticsicon.png" alt="statistics" class="w-10 h-10 md:w-12 md:h-12">
            </a>
            <!-- Edit Data -->
            <a href="editdata.php" class="p-2 rounded-lg bg-[#ffffff] transform transition-all duration-300 hover:scale-110 shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                <img src="assets/icon/editicon.png" alt="editdata" class="w-10 h-10 md:w-12 md:h-12">
            </a>
            <!-- Account -->
            <a href="profileadmin.php" class="p-2 rounded-lg bg-[#ffffff] transform transition-all duration-300 hover:scale-110 shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                <img src="assets/icon/accounticon.png" alt="profile" class="w-10 h-10 md:w-12 md:h-12">
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="bg-[#31AEFF] min-h-screen">
        <section class="px-10">
            <!-- Title (Statistics) -->
            <h1 class="text-4xl text-align-left font-semibold text-white py-8 ml-10">Statistics</h1>

            <!-- Total Revenue Graph -->
            <div class="flex justify-between items-center bg-white p-5 rounded-lg shadow-[0_0_20px_rgba(0,0,0,0.25)] mb-5">
                <canvas id="totalRevenueChart"></canvas>
            </div>

            <!-- Stock Overview Graph -->
            <div class="flex justify-between items-center bg-white p-5 rounded-lg shadow-[0_0_20px_rgba(0,0,0,0.25)] mb-5">
                <canvas id="stockOverviewChart"></canvas>
            </div>

        </section>
    </main>

    <script>
        // Total Revenue Chart
        const totalRevenueCtx = document.getElementById('totalRevenueChart').getContext('2d');
        const totalRevenueChart = new Chart(totalRevenueCtx, {
            type: 'line', // Ensure the chart type is 'line'
            data: {
                labels: <?php echo json_encode($totalRevenueLabels); ?>,
                datasets: [{
                    label: 'Total Revenue',
                    data: <?php echo json_encode($totalRevenueData); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Stock Overview Chart
        const stockOverviewCtx = document.getElementById('stockOverviewChart').getContext('2d');
        const stockOverviewChart = new Chart(stockOverviewCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($stockOverviewLabels); ?>,
                datasets: [{
                    label: 'Stock Quantity',
                    data: <?php echo json_encode($stockOverviewData); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>