<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Update user in the database
    $sql = "UPDATE users SET first_name=?, last_name=?, email=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);

    if ($stmt->execute() === true) {
        $message= "User updated successfully";
        $message_class = "success";
    } else {
        $message ="Error updating user: " . $stmt->error;
        $message_class = "error";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
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
