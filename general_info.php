<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>General Information</title>
    <link rel="stylesheet" href="others/style.css">
    <style>
        h2 {
            color: blue;
        }

        label {
            color: #7373a5;
        }

        select {
            color: #7373a5;
        }

        input[type="date"] {
            width: 100%;
        }
    </style>
</head>
<body>
    <form action="others/contact_details.php" method="post">
        <h2>General Information</h2>
        <table border="0">
            <input type="hidden" name="id" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>">
            <tr>
                <td colspan="2">
                    <select id="title" name="title" required>
                        <option value="" disabled selected>Title</option>
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Miss">Miss</option>
                        <option value="Ven">Ven</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" placeholder="First Name" id="first_name" name="first_name" required style="width: 100%;"><br>
                </td>
                <td>
                    <input type="text" placeholder="Last Name" id="last_name" name="last_name" required><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="Birthday">Birthday: <input type="date" id="birthday" name="birthday" required></label><br>
                </td>
                <td>
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea id="description" placeholder="Description" name="description"></textarea><br>
                </td>
            </tr>
        </table>
        <button type="submit" name="submit_general">Next</button>
    </form>
</body>
</html>
