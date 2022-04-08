<?php
    require 'function.php';
    // Menampilkan semua data dari table siswa berdasarkan nis secara Descending
    $kategori = query("SELECT * FROM kategori ORDER BY id_kategori");
    
?>  
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <title>WarungKu</title>
        <!-- <link rel="stylesheet" href="asset/css/animate.css"> -->
        <link rel="stylesheet" href="asset/css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    </head>
    <body>
        <header>
            <nav class="navbar bg-light navbar-expand-lg justify-content-between" id="navbar_top">
                <a class="navbar-brand logo" href="index">Warung<span>Ku</span></a>
                <div class="right-nav">
                    <!--like----->
                    <a href="#" class="like">
                        <i class="far fa-heart"></i>
                        <span>0</span>
                    </a>
                    <!--cart----->
                    <a href="#" class="cart">
                        <i class="fas fa-shopping-cart"></i>
                        <span>0</span>
                    </a>
                    <a href="login" class="user">
                        <i class="fas fa-user"></i>
                    </a>
                </div>
            </nav> <!-- navbar -->          
        </header>

        <div class="container">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="asset/images/promo/2kai3oj5d1vfzs2426ftcm.webp" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="asset/images/promo/au20u9s76zb75og60azt.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleFade" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleFade" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
        </div>
               
        <section id="category">
            <div class="container">
                <div class="category-head">
                    <h2>Category</h2>
                    <span>All</span>
                </div>
                <div class="category-container">
                    <?php foreach ($kategori as $row) : ?>
                    <!-- DaftarBox -->
                    <div class="box-item">
                    <a href="#" class="category-box text-decoration-none shadow">
                        <img src="asset/images/icon/<?= $row['icon']; ?>" alt="">
                        <span><?= $row['kategori']; ?></span>
                    </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <div class="container" >
            <div class="row mb-4">
                <h2>Product List</h2>
            </div>
            
            <div class="row row-cols-1 row-cols-md-3">
            <?php 
                $dagangan = mysqli_query($koneksi,"select * from dagangan order by nama_barang");
                while ($barang = mysqli_fetch_array($dagangan)) {
            ?>
                <div class="col mb-4 d-flex">
                    <div class="card" >
                    <img src="asset/images/produk/<?= $barang['gambar_barang']; ?>" class="card-img-top" alt="...">
                    <div class="card-body" >
                        <h4 class="card-title"><?= $barang['nama_barang']; ?></h4>
                        <h6 class="card-text">Rp. <?= $barang['harga_barang']; ?></h6>
                        <p class="card-text">Stok <?= $barang['jumlah_barang']; ?></p>
                    </div>
                    </div>
                </div>
                <?php } ?>
            </div>

        </div>                
        



        <!-- <footer>
            <div class="footer-container">
                <div class="footer-logo">
                    <a href="#">Warung<span>Ku</span></a>
                    <ul>
                        <li><a href="#">Masuk</a></li>
                        <li><a href="#">Daftar</a></li>
                    </ul>
                </div>
            </div>
        </footer> -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function(){
  window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        document.getElementById('navbar_top').classList.add('fixed-top');
        // add padding top to show content behind navbar
        navbar_height = document.querySelector('.navbar').offsetHeight;
        document.body.style.paddingTop = navbar_height + 'px';
      } else {
        document.getElementById('navbar_top').classList.remove('fixed-top');
         // remove padding top from body
        document.body.style.paddingTop = '0';
      } 
  });
}); 
        </script>
    </body>
    
</html>