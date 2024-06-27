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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_contact'])) {
        $id= $_SESSION['id'];
        $title = $_SESSION['title'];
        $first_name = $_SESSION['first_name'];
        $last_name = $_SESSION['last_name'];
        $birthday = $_SESSION['birthday'];
        $gender = $_SESSION['gender'];
        $description = $_SESSION['description'];
        $address = $_POST['address'];
        $additionalInformation = $_POST['additionalInformation'];
        $zip = $_POST['zip'];
        $place = $_POST['place'];
        $country = $_POST['country'];
        $code = $_POST['code'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $sql = "INSERT INTO users (id, title, first_name, last_name, birthday, gender, description, address, additional_info, zip_code, place, country, code, phone, email)
                VALUES ('$id','$title', '$first_name', '$last_name', '$birthday', '$gender', '$description', '$address', '$additionalInformation', '$zip', '$place', '$country', '$code', '$phone', '$email')";

        if ($conn->query($sql) === TRUE) {
            $message= "New record created successfully";
            $message_class = "success";
        } else {
            $message= "Error: " . $sql . "<br>" . $conn->error;
            $message_class = "error";
        }

        session_unset();
        session_destroy();
    } elseif (isset($_POST['view_users'])) {
        header("Location: view_users.php");
        exit();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registered User</title>
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
        <button><a href="view_users.php">Viewuser</a></button>
    </div>
</body>
</html>