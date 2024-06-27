<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$message_class = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete user from database
    $sql = "DELETE FROM users WHERE id = $user_id";

    if ($conn->query($sql) === TRUE) {
        $message = "User deleted successfully";
        $message_class = "success";
    } else {
        $message = "Error deleting user: " . $conn->error;
        $message_class = "error";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .message {
            font-size: 18px;
            color: #333;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message <?php echo $message_class; ?>">
            <?php echo $message; ?>
        </div>
    </div>
</body>
</html>
