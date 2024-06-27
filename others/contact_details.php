<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_general'])) {
    $_SESSION['id'] = $_POST['id'];
    $_SESSION['title'] = $_POST['title'];
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['last_name'] = $_POST['last_name'];
    $_SESSION['birthday'] = $_POST['birthday'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['description'] = $_POST['description'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            color:white;
            background-color:#3366ff;
        }
        form{
            background:#3366ff;
        }
        input[type="text"], input[type="date"],input[type="email"], select, textarea {
            background:#3366ff;
            placeholder-color:white;
        }
        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        select::placeholder,
        textarea::placeholder {
            color: white;
        }
    </style>
    <script>
        function getPlaceByZipCode() {
            const zipCode = document.getElementById('zip').value;
            if (zipCode.length >= 5) {
                fetch(https://api.zippopotam.us/us/${zipCode})
                    .then(response => response.json())
                    .then(data => {
                        if (data.places && data.places.length > 0) {
                            document.getElementById('place').value = data.places[0]['place name'];
                        } else {
                            document.getElementById('place').value = '';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching place by zip code:', error);
                        document.getElementById('place').value = '';
                    });
            } else {
                document.getElementById('place').value = '';
            }
        }
    </script>
</head>
<body>
    <form action="register.php" method="post">
    <h2>Contact Details</h2>
        <table border="0">
            <tr>
                <td colspan="2">
                    <input type="text" placeholder="Address" id="address" name="address" required><br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea id="additionalInformation" placeholder="Additional info" name="additionalInformation"></textarea><br>
                </td>
            </tr>
            <tr>
                <td><input type="text" placeholder="Zip Code" id="zip" name="zip" required style="width: 100%;"><br></td>
                <td style=width:75%><input type="text" placeholder="Place" id="place" name="place" required><br></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" placeholder="Country" id="country" name="country" required><br>
                </td>
            </tr>
            <tr>
                <td><input type="text" placeholder="Code" id="code" name="code" required style="width: 100%;"><br></td>
                <td><input type="text" placeholder="Phone" id="phone" name="phone" required><br></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="email" placeholder="Email" id="email" name="email" required><br>
                </td>
            </tr>
        </table>
        <input type="radio" id="radio" name="radio">I do accept the <a href="https://onedrive.live.com/edit.aspx?resid=697112686ff09c56!s4ecbfd6d-b573-4931-b4b4-743f717cb97e&cid=697112686ff09c56&login_hint=binul2015%40gmail.com&action=editnew&wdNewAndOpenCt=1719400013410&ct=1719400015512&wdOrigin=OFFICECOM-WEB.START.NEW&wdPreviousSessionSrc=HarmonyWeb&wdPreviousSession=fde8c616-ebc7-4287-bc54-1ebb7fa97933" target="black">Terms and conditions</a> of your site<br><br>
        <button type="submit" name="submit_contact">Submit</button>
        <button name="view_users"><a href="view_users.php" style="text-decoration: none;">Viewuser</a></button>
    </form>
</body>
</html>