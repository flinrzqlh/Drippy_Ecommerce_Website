<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drippy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['user_id']; // Simpan user_id dalam session
            $_SESSION['level'] = $row['level'];
            if ($row['level'] == 'admin') {
                header("Location: statistics.php");
            } else {
                header("Location: search.php");
            }
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to DRIPPY</title>
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
<body class="bg-[#31AEFF] flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="mb-6 text-center">
            <img src="assets/logo/LogoDrippy.png" alt="Drippy Logo" class="w-16 h-16 mx-auto mb-2">
            <h1 class="text-2xl font-bold text-[#050A30]">Drippy</h1>
            <p class="text-gray-600">Elevate your drip</p>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="space-y-4">
                <div>
                    <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username" class="border border-gray-300 px-3 py-2 rounded-md w-full" placeholder="Enter your username">
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" class="border border-gray-300 px-3 py-2 rounded-md w-full" placeholder="Enter your password">
                </div>
                <div>
                    <button class="bg-[#050A30] text-white font-bold py-2 px-4 rounded-md w-full mt-5 hover:bg-[#040820]">Login to Account</button>
                </div>
                <div class="text-center">
                    <a href="register.php" class="text-[#050A30] font-medium hover:underline">Register Account</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
