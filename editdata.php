<?php
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

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_product'])) {
        // Add product
        $product_name = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $photo_1 = $_POST['photo_1'];
        $photo_2 = $_POST['photo_2'];

        $sql = "INSERT INTO products (product_name, quantity, price, photo_1, photo_2) VALUES ('$product_name', '$quantity', '$price', '$photo_1', '$photo_2')";
        if ($conn->query($sql) === TRUE) {
            $message = "Product added successfully!";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['update_product'])) {
        // Update product
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $photo_1 = $_POST['photo_1'];
        $photo_2 = $_POST['photo_2'];

        $sql = "UPDATE products SET product_name='$product_name', quantity='$quantity', price='$price', photo_1='$photo_1', photo_2='$photo_2' WHERE product_id='$product_id'";
        if ($conn->query($sql) === TRUE) {
            $message = "Product updated successfully!";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['delete_product'])) {
        // Delete product
        $product_id = $_POST['product_id'];

        $sql = "DELETE FROM products WHERE product_id='$product_id'";
        if ($conn->query($sql) === TRUE) {
            $message = "Product deleted successfully!";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Fetch products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DRIPPY Edit Data</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
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
            <!-- Title (Edit Product Data) -->
            <h1 class="text-4xl text-align-left font-semibold text-white py-8 ml-10">Edit Product Data</h1>

            <!-- Edit Product Data -->
            <div class="bg-white p-5 rounded-lg shadow-[0_0_20px_rgba(0,0,0,0.25)] mb-5">
                <?php if ($message): ?>
                    <p class="text-green-500 text-xl mb-5"><?php echo $message; ?></p>
                <?php endif; ?>
                <form method="POST" action="editdata.php" class="mb-5">
                    <h2 class="text-2xl font-semibold mb-5">Add New Product</h2>
                    <div class="mb-4">
                        <label for="product_name" class="block text-gray-700 font-bold mb-2">Product Name</label>
                        <input type="text" id="product_name" name="product_name" class="border border-gray-300 px-3 py-2 rounded-md w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="quantity" class="block text-gray-700 font-bold mb-2">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="border border-gray-300 px-3 py-2 rounded-md w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
                        <input type="number" step="0.01" id="price" name="price" class="border border-gray-300 px-3 py-2 rounded-md w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="photo_1" class="block text-gray-700 font-bold mb-2">Photo 1 URL</label>
                        <input type="text" id="photo_1" name="photo_1" class="border border-gray-300 px-3 py-2 rounded-md w-full">
                    </div>
                    <div class="mb-4">
                        <label for="photo_2" class="block text-gray-700 font-bold mb-2">Photo 2 URL</label>
                        <input type="text" id="photo_2" name="photo_2" class="border border-gray-300 px-3 py-2 rounded-md w-full">
                    </div>
                    <button type="submit" name="add_product" class="bg-[#050A30] text-white font-bold py-2 px-4 rounded-md w-full mt-5 hover:bg-[#040820]">Add Product</button>
                </form>

                <h2 class="text-2xl font-semibold mb-5">Existing Products</h2>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <form method="POST" action="editdata.php" class="mb-5">
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                            <div class="mb-4">
                                <label for="product_name_<?php echo $row['product_id']; ?>" class="block text-gray-700 font-bold mb-2">Product Name</label>
                                <input type="text" id="product_name_<?php echo $row['product_id']; ?>" name="product_name" class="border border-gray-300 px-3 py-2 rounded-md w-full" value="<?php echo $row['product_name']; ?>" required>
                            </div>
                            <div class="mb-4">
                                <label for="quantity_<?php echo $row['product_id']; ?>" class="block text-gray-700 font-bold mb-2">Quantity</label>
                                <input type="number" id="quantity_<?php echo $row['product_id']; ?>" name="quantity" class="border border-gray-300 px-3 py-2 rounded-md w-full" value="<?php echo $row['quantity']; ?>" required>
                            </div>
                            <div class="mb-4">
                                <label for="price_<?php echo $row['product_id']; ?>" class="block text-gray-700 font-bold mb-2">Price</label>
                                <input type="number" step="0.01" id="price_<?php echo $row['product_id']; ?>" name="price" class="border border-gray-300 px-3 py-2 rounded-md w-full" value="<?php echo $row['price']; ?>" required>
                            </div>
                            <div class="mb-4">
                                <label for="photo_1_<?php echo $row['product_id']; ?>" class="block text-gray-700 font-bold mb-2">Photo 1 URL</label>
                                <input type="text" id="photo_1_<?php echo $row['product_id']; ?>" name="photo_1" class="border border-gray-300 px-3 py-2 rounded-md w-full" value="<?php echo $row['photo_1']; ?>">
                            </div>
                            <div class="mb-4">
                                <label for="photo_2_<?php echo $row['product_id']; ?>" class="block text-gray-700 font-bold mb-2">Photo 2 URL</label>
                                <input type="text" id="photo_2_<?php echo $row['product_id']; ?>" name="photo_2" class="border border-gray-300 px-3 py-2 rounded-md w-full" value="<?php echo $row['photo_2']; ?>">
                            </div>
                            <div class="flex space-x-4">
                                <button type="submit" name="update_product" class="bg-[#050A30] text-white font-bold py-2 px-4 rounded-md w-full mt-5 hover:bg-[#040820]">Update Product</button>
                                <button type="submit" name="delete_product" class="bg-red-500 text-white font-bold py-2 px-4 rounded-md w-full mt-5 hover:bg-red-700">Delete Product</button>
                            </div>
                        </form>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-gray-700 text-xl">No products found.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>

<?php
$conn->close();
?>