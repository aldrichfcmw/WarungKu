<?php 
session_start();
if (isset($_SESSION['is_login'])) {
    header("Location: welcome.php");
}
if (isset($_POST['send'])) {
    $file = $_FILES["file"]["name"];
    move_uploaded_file($_FILES['file']['tmp_name'], "images/".$_FILES['file']['name']);
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>WarungKu</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="asset/log.css">
    </head>
    <body>
        <div class="loginBox" id="login-form">
            <h1>Warung<span>Ku</span></h1>
            <h5>Selamat Datang <?php echo $_SESSION['name'];?></h5>
            <form action="welcome.php" method="post" enctype="multipart/form-data">
                <p style="text-align:center;">Silakan Upload Foto</p>
                <input type="file" name="file" style="margin-left:10%;">
                <input type="submit" name="send" value="submit">
            </form>
            <a href="logout.php"><input type="submit" name="logout" value="Logout"></a>
        </div>
    </body>
</html>