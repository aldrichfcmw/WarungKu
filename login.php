<?php
session_start();
// Jika bisa login maka ke index.php
if (isset($_SESSION['login'])) {
    header('location:index');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';
if (isset($_POST['regis'])){
    if (regis($_POST) > 0) {
        echo "<script>
            document.location.href = 'index';
        </script>";
    }
}
if (isset($_POST['login'])){
    if (login($_POST) > 0) {
        echo "<script>
            document.location.href = 'index';
        </script>";
    } else {
        // Jika fungsi add dibawah dari 0/data tidak tertambah, maka munculkan alert dibawah
        echo "<script>
            alert('Item gagal ditambah');
        </script>";
    }
}

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>WarungKu - Login</title>
        <!--====== Favicon Icon ======-->
        <link rel="shortcut icon" href="asset/images/icon/icon WK.png" type="image/png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="asset/css/log.css">
    </head>
    <body>
        <input type='checkbox' id='form-switch'>
        <div class="loginBox" id="login-form">
            <h1>Warung<span>Ku</span></h1>
            <h5>Sign in here</h5>
            <form action="" method="post">
                <div class="inputBox"> 
                    <input id="email" type="text" name="emaillogin" placeholder="E-mail" required> 
                    <input id="pass" type="password" name="Passwordlogin" placeholder="Password" required> 
                </div> 
                <input type="submit" name="login" value="Login">
            </form> 
            <div class="forget">
                <a href="#">Forget Password<br> </a>
            </div>
            <div class="text-center">
                <label for='form-switch'>Sign up</label>
            </div>
        </div>
        <div class="RegisBox" id="register-form">
            <h1>Warung<span>Ku</span></h1>
            <h5>Sign Up here</h5>
            <form action="" method="post">
                <div class="inputBox"> 
                    <input id="name" type="text" name="name" placeholder="Name" required> 
                    <input id="email" type="text" name="email" placeholder="email" required> 
                    <input id="password" type="password" name="password" placeholder="Password" required>
                    <input id="repassword" type="password" name="repassword" placeholder="Re-Password">
                </div> 
                <input type="submit" name="regis" value="Registrasi">
            </form> 
            <div class="forget">
                <a href="#">already have an account?<br> </a>
            </div>
            <div class="text-center">
                <label for='form-switch'>Sign-In</label>
            </div>
        </div>
    </body>
</html>