<?php
session_start();
if (!isset($_SESSION['username'])) {
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];
    $user_id = $_SESSION['user_id'];

    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username='$new_username', password='$hashed_password' WHERE user_id='$user_id'";
    } else {
        $sql = "UPDATE users SET username='$new_username' WHERE user_id='$user_id'";
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $new_username;
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIPPY User Account</title>
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
            <a href="profileuser.php" class="p-2 rounded-lg bg-[#ffffff] transform transition-all duration-300 hover:scale-110 shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                <img src="assets/icon/accounticon.png" alt="account" class="w-10 h-10 md:w-12 md:h-12">
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="bg-[#31AEFF] min-h-screen">
        <section class="px-10">
            <!-- Title (User Account) -->
            <h1 class="text-4xl text-align-left font-semibold text-white py-8 ml-10">User Account</h1>

            <!-- Profile Form -->
            <div class="bg-white p-5 rounded-lg shadow-[0_0_20px_rgba(0,0,0,0.25)] mb-5">
                <?php if ($message): ?>
                    <p class="text-green-500 text-xl mb-5"><?php echo $message; ?></p>
                <?php endif; ?>
                <form method="POST" action="profileuser.php">
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                        <input type="text" id="username" name="username" class="border border-gray-300 px-3 py-2 rounded-md w-full" value="<?php echo $_SESSION['username']; ?>" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-bold mb-2">New Password (leave blank to keep current password)</label>
                        <input type="password" id="password" name="password" class="border border-gray-300 px-3 py-2 rounded-md w-full">
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" name="save_changes" class="bg-[#31AEFF] text-white font-bold py-2 px-4 rounded-md w-full mt-5 hover:bg-[#040820]">Save Changes</button>
                        <button type="submit" name="logout" class="bg-red-500 text-white font-bold py-2 px-4 rounded-md w-full mt-5 hover:bg-red-700">Logout</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>