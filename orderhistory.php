<?php
// session check
session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != 'customer') {
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

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIPPY Order History</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
            <!-- Chatbot Button -->
            <a href="chatbot.php" class="p-2 rounded-lg bg-[#ffffff] transform transition-all duration-300 hover:scale-110 shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                <img src="assets/icon/chatboticon.png" alt="chatbot" class="w-10 h-10 md:w-12 md:h-12">
            </a>
            <!-- Search Button -->
            <a href="search.php" class="p-2 rounded-lg bg-[#ffffff] transform transition-all duration-300 hover:scale-110 shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                <img src="assets/icon/searchicon.png" alt="search" class="w-10 h-10 md:w-12 md:h-12">
            </a>
            <!-- Order History -->
            <a href="orderhistory.php" class="p-2 rounded-lg bg-[#ffffff] transform transition-all duration-300 hover:scale-110 shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                <img src="assets/icon/orderhistoryicon.png" alt="order" class="w-10 h-10 md:w-12 md:h-12">
            </a>
            
            <!-- Account -->
            <a href="profile.php" class="p-2 rounded-lg bg-[#ffffff] transform transition-all duration-300 hover:scale-110 shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                <img src="assets/icon/accounticon.png" alt="account" class="w-10 h-10 md:w-12 md:h-12">
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="bg-[#31AEFF] min-h-screen">
        <section class="px-10">
            <!-- Title (Search) -->
            <h1 class="text-4xl text-align-left font-semibold text-white py-8 ml-10">Order History</h1>
            <!-- Product List -->
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    
                    <!-- Ordered Item Details -->
                    <div class="flex justify-between items-center bg-white p-5 rounded-lg shadow-[0_0_20px_rgba(0,0,0,0.25)] mb-5">
                        <!-- Product Image -->
                        <div class="w-1/3 flex space-x-4">
                            <!-- photo_1 -->
                            <div class="p-2 rounded-lg bg-[#F5F5F5] shadow-[0_0_10px_rgba(0,0,0,0.25)]">
                                <img src="<?php echo $row['photo_1']; ?>" alt="Product Image" class="w-[300px] h-[300px] rounded-lg">
                            </div>
                            <!-- photo_2 -->
                            <div class="p-2 rounded-lg bg-[#F5F5F5] shadow-[0_0_10px_rgba(0,0,0,0.25)]">
                                <img src="<?php echo $row['photo_2']; ?>" alt="Product Image" class="w-[300px] h-[300px] rounded-lg">
                            </div>
                        </div>

                        <!-- Order Details -->
                        <div class="w-2/3 pl-10">
                            <!-- Order ID -->
                            <h2 class="text-4xl font-semibold mb-5">Order ID: <?php echo $row['product_name']; ?></h2>
                            <!-- product name -->
                            <h2 class="text-3xl font-semibold mb-5"><?php echo $row['product_name']; ?></h2>
                            <!-- quantity the user bought -->
                            <p class="text-2xl font-normal"><?php echo $row['quantity']; ?> Pieces</p>
                            <!-- product price -->
                            <p class="text-2xl font-normal">Price: $<?php echo $row['price']; ?></p>
                            <!-- Order Date -->
                            <p class="text-2xl font-normal">Ordered at </p>
                            <div class="flex items-center mt-10">
                                <button class="px-4 py-2 bg-[#31AEFF] text-white text-2xl rounded-lg shadow hover:bg-blue-600 tsransition-all duration-300">Print Invoice</button>
                            </div>
                        </div>

                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>

<?php
$conn->close();
?>