<?php
session_start();

$admin=0;
// Memanggil atau membutuhkan file function.php
require 'function.php';

// add task
if (isset($_GET['add_item'])){
    $id_barang = $_GET['add_item'];
    // Jika fungsi add lebih dari 0/data tertambah, maka munculkan alert dibawah
    if (add($id_barang) > 0) {
        echo "<script>
                    alert('Item berhasil ditambah');
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
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WarungKu</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="asset/images/icon/Icon WK.png" type="image/png">

    <!-- Custom fonts for this template-->
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">
    
    <!-- Required Core Stylesheet -->
    <link rel="stylesheet" href="node_modules/@glidejs/glide/dist/css/glide.core.min.css">
    <!-- Optional Theme Stylesheet -->
    <link rel="stylesheet" href="node_modules/@glidejs/glide/dist/css/glide.theme.min.css">
    <style>
        @media screen and (max-width: 800px){
            .hide-on-mobile {
                display: none;
            }
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- row -->
                    <div class="row justify-content-center">
                        <!-- navbar -->
                        <div class="col-sm-6 col-md-12 col-xs-12">
                            <?php include "navbar.blade.php";?>

                            <!-- carousel -->
                            <div class="glide mb-4">
                                    <div class="glide__track" data-glide-el="track">
                                        <ul class="glide__slides">
                                        <li class="glide__slide">
                                        <img src="asset/images/promo/2kai3oj5d1vfzs2426ftcm.webp" class="d-block w-100" alt="Wild Landscape"/>
                                        </li>
                                        <li class="glide__slide">
                                        <img src="asset/images/promo/au20u9s76zb75og60azt.png" class="d-block w-100" alt="Wild Landscape"/>
                                        </li>
                                    </div>
                                    <div class="glide__bullets" data-glide-el="controls[nav]">
                                        <button class="glide__bullet" data-glide-dir="=0"></button>
                                        <button class="glide__bullet" data-glide-dir="=1"></button>
                                    </div>
                            </div>
                            <!-- carousel -->

                            <!-- Page Heading -->
                            <h1 class="h3 mb-1 text-gray-800">Kategori</h1>
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 p-4">
                                    <?php 
                                    $dagangan = mysqli_query($koneksi,"SELECT * FROM kategori ORDER BY id_kategori");
                                    while ($kategori = mysqli_fetch_array($dagangan)) {
                                    ?>
                                    <div class="col-xl-4 col-md-3 mb-4">
                                        <div class="card shadow text-center">
                                            <div class="card-body">
                                                <div class="row no-gutters">
                                                    <div class="col mr-2">
                                                        <img src="asset/images/icon/<?= $kategori['icon']; ?>" alt="" srcset=""><br>
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800"><?= $kategori['kategori']; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>

                            <!-- Page Heading -->
                            <h1 class="h3 mb-1 text-gray-800">Produk</h1>
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 p-4">
                                    <?php 
                                    $dagangan = mysqli_query($koneksi,"select * from dagangan order by nama_barang");
                                    while ($barang = mysqli_fetch_array($dagangan)) {
                                    ?>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card border-left-success shadow">
                                        <img src="asset/images/produk/<?= $barang['gambar_barang']; ?>" class="card-img-top" alt=""/>
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            <?= $barang['nama_barang']; ?>
                                                        </div>
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Stok <?= $barang['jumlah_barang']; ?>
                                                        </div>
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">Rp. <?= $barang['harga_barang']; ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="index?add_item=<?= $barang['id_barang']; ?>">
                                                            <i class="fa fa-shopping-cart" style="color:grey;"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>



                            
                            <?php include "footer.blade.php";?>
                        </div>
                        
                        </div>
                        
                    </div>
                    <!-- end row -->


                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    

    <!-- Bootstrap core JavaScript-->
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="asset/js/sb-admin-2.min.js"></script>
    
    <!-- Glide plugin JavaScript-->    
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
        <script>
            const config={
                type: "carousel",
                autoplay: 4000,
                perView:1,
                gap:0,
            }
            new Glide(".glide",config).mount();
        </script>
</body>

</html>