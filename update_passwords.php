<?php
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

// Fetch all users
$sql = "SELECT user_id, username, password FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $hashed_password = password_hash($row['password'], PASSWORD_DEFAULT);
        $update_sql = "UPDATE users SET password='$hashed_password' WHERE user_id=" . $row['user_id'];
        if ($conn->query($update_sql) === TRUE) {
            echo "Password updated for user: " . $row['username'] . "<br>";
        } else {
            echo "Error updating password for user: " . $row['username'] . "<br>";
        }
    }
} else {
    echo "No users found.";
}

$conn->close();
?>