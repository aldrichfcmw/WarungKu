<?php
session_start();
// Jika bisa login maka ke index.php
if (isset($_SESSION['login'])) {
    header('location:index');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

if (isset($_POST['regis'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $repassword = md5($_POST["repassword"]);

    if($password==$repassword){
        $sql= "select * from users where email=$email";
        $hasil = mysqli_query($conn, $sql);
        if(!$result ->num_rows > 0){
            $sqlstr="insert into users (name,email,password) values ('$name','$email','$password')";
            $hasil = mysqli_query($conn,$sqlstr);
            if($hasil){
                echo "<script>alert('Registrasi berhasil')</script>";  
            } else {
                echo "<script>alert('Terdapak Kesalahan')</script>"; 
            }
        } else {
            echo "<script>alert('Email sudah dipakai')</script>"; 
        }
    } else {
        echo "<script>alert('Password harus sama')</script>"; 
    }
}

if (isset($_POST['login'])) {
	$email = $_POST['emaillogin'];
	$password = md5($_POST['Passwordlogin']);
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	$cek = mysqli_num_rows($result);
    if ($cek > 0) {
		$row = mysqli_fetch_assoc($result);
        $_SESSION['login'] = true;
        $_SESSION['id'] = $row['id'];
		$_SESSION['name'] = $row['name'];
        $_SESSION['title'] = "WarungKu";
        $_SESSION['level'] = $row['level'];
        $level=$row['level'];
        if($level == 0){
            header("Location: dagangan");
        }
        else{
            header("Location: index");
        }
		
	} else {
		echo "<script>alert('Woops! Email Atau Password anda Salah.')</script>";
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
                    <input id="pass" type="password" name="password" placeholder="Password" required>
                    <input id="pass" type="password" placeholder="Re-Password">
                </div> 
                <input type="submit" name="regis" value="regist" value="Regist">
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