<?php
session_start();

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

$questions_answers = [];
$sql = "SELECT question, answer FROM chatbot";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions_answers[$row['question']] = $row['answer'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIPPY "Driplet" ChatBot</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .chat-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.25);
        }
        .chat-box {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }
        .chat-message {
            margin-bottom: 10px;
        }
        .chat-message.user {
            text-align: right;
        }
        .chat-message.bot {
            text-align: left;
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
    <main class="bg-[#31AEFF] min-h-screen flex items-center justify-center">
        <div class="chat-container">
            <div class="chat-box" id="chat-box">
                <!-- Chat messages will be appended here -->
            </div>
            <form id="chat-form">
                <input type="text" id="user-input" class="border border-gray-300 px-3 py-2 rounded-md w-full" placeholder="Ask Driplet...">
                <button type="submit" class="bg-[#050A30] text-white font-bold py-2 px-4 rounded-md w-full mt-2 hover:bg-[#040820]">Send</button>
            </form>
        </div>
    </main>

    <script>
        const questionsAnswers = <?php echo json_encode($questions_answers); ?>;
        const chatBox = document.getElementById('chat-box');
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');

        chatForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const userQuestion = userInput.value.trim();
            if (userQuestion === '') return;

            // Display user question
            const userMessage = document.createElement('div');
            userMessage.classList.add('chat-message', 'user');
            userMessage.textContent = userQuestion;
            chatBox.appendChild(userMessage);

            // Find the answer
            let botAnswer = 'Sorry, I do not understand that question.';
            for (const [question, answer] of Object.entries(questionsAnswers)) {
                if (userQuestion.toLowerCase() === question.toLowerCase()) {
                    botAnswer = answer;
                    break;
                }
            }

            // Display bot answer
            const botMessage = document.createElement('div');
            botMessage.classList.add('chat-message', 'bot');
            botMessage.textContent = botAnswer;
            chatBox.appendChild(botMessage);

            // Scroll to the bottom of the chat box
            chatBox.scrollTop = chatBox.scrollHeight;

            // Clear the input field
            userInput.value = '';
        });
    </script>
</body>
</html>