<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Use a prepared statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $user_id);

    if ($stmt->execute() === false) {
        die("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result === false) {
        die("Getting result set failed: " . $stmt->error);
    }

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        $first_name = htmlspecialchars($user['first_name']);
        $last_name = htmlspecialchars($user['last_name']);
        $email = htmlspecialchars($user['email']);
    } else {
        $message = "User not found.";
    }

    $stmt->close();
} else {
    $message = "Invalid request.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
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
            width: 300px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            font-size: 18px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($user)): ?>
            <form method="post" action="update_user.php">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                </div>
                <button type="submit">Update</button>
            </form>
        <?php else: ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
