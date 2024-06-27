<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for search
$searchFirstName = "";
$searchLastName = "";

// Handle search form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchFirstName = $_POST['searchFirstName'];

    $sql = "SELECT id, title, first_name, last_name, birthday, gender, description, address, additional_info, zip_code, place, country, code, phone, email 
            FROM users 
            WHERE first_name LIKE '%$searchFirstName%' OR last_name LIKE '%$searchLastName%'";
} else {
    // Default query to fetch all users
    $sql = "SELECT id, title, first_name, last_name, birthday, gender, description, address, additional_info, zip_code, place, country, code, phone, email FROM users";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
    <link rel="stylesheet" href="style.css">
    <style>
        th,td{
            min-width: 150px;
            overflow: hidden;
        }
        td {
            padding: 40px;
            text-align: left;
            vertical-align: top;
        }
        
        th {
            color: #000000;
        }
        input[type="text"]{
            width: 20%;
            height:03%;
            border: 1px solid #ccc;
            padding:0px;
        }
        button{
            padding:0px;
            margin-right: 5px;
            margin-left: 700px;
        }
        img{
            height:20px;
            width: 20px;
        }
        form{
            width: auto;
            max-width: 10000px;
            min-width: 300px;
            margin: auto;
            height:auto;
            max: height 1000px;
            min: height 300px;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2>Registered Users</h2>
    <button type="search">Search: </button>
        <input type="text" id="searchFirstName" name="searchFirstName" value="<?php echo $searchFirstName; ?>">
        
        <table border="0">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact no</th>
            <th>Company</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['first_name']} {$row['last_name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['title']}</td>
                        <td>
                            <a href='edit_user.php?id={$row['id']}'><img src='OIP.jpeg' alt='Edit'></a>
                            <a href='delete_user.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this user?\")'><img src='delete.jpeg' alt='Delete'></a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
        }
        ?>
    </table>
    </form>
</body>
</html>

<?php
$conn->close();
?>
