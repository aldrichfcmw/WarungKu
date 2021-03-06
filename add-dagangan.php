<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Menampilkan semua data dari table kategori berdasarkan id
$dagangan = query("SELECT * FROM kategori ORDER BY id_kategori");


// Jika fungsi tambah lebih dari 0/data tersimpan, maka munculkan alert dibawah
if (isset($_POST['simpan'])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Data Dagangan berhasil ditambahkan!');
                document.location.href = 'table-dagangan';
            </script>";
    } else {
        // Jika fungsi tambah dari 0/data tidak tersimpan, maka munculkan alert dibawah
        echo "<script>
                alert('Data Dagangan gagal ditambahkan!');
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

    <title>WK Admin - Add Product</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="asset/images/icon/icon WK.png" type="image/png">

    <!----===== Boxicons CSS ===== -->
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

        <?php include 'side.blade.php';?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <?php include 'navbar.blade.php';?>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Add Product</h1>
                    <p class="mb-2"></p>
                    
                    <!-- form -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col col-md-8">
                                <div class="form-group ml-4">
                                    <label class="mt-2" for="">Tipe Produk</label>
                                    <select class="form-control" name="id_kategori">                            
                                        <option disabled selected value>Default select</option>
                                        <?php foreach ($dagangan as $row) : ?>
                                        <option value="<?= $row['id_kategori'];?>"><?= $row['id_kategori']; ?> - <?= $row['kategori']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                        <label class="mt-2" for="">Nama Produk</label>
                                        <input type="text" name="nama" class="form-control" required>
                                        <label class="mt-2" for="">Kode Produk</label>
                                        <input type="text" name="kode" class="form-control" required>                   
                                </div>
                                <div class="form-group mt-2">
                                <h1 class="h3 mb-2 text-gray-800">Informasi Product</h1>
                                    <div class="col">
                                        <label >Gambar Produk</label><br>
                                            <div class="mb-3">
                                                <input class="form-control" type="file" id="formFile" name="gambar">
                                            </div>
                                            
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <div class="col">
                                        <div class="mb-3 ">
                                            <label for="validationTextarea">Deskripsi Produk</label>
                                            <textarea class="form-control" id="validationTextarea" name="deskripsi" placeholder="Masukkan Deskripsi Produk" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                <h1 class="h3 mb-2 text-gray-800">Informasi Stok dan Harga</h1>
                                    <div class="col">
                                        <label >Harga Produk</label><br>
                                        <div class=" input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" name="harga" class="form-control" required>
                                        </div>
                                        <label for="">Stok</label>
                                        <input type="text" name="jumlah" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col text-align-center mb-5">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block" name="simpan">Buat Dagangan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; WarungKu </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

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

</body>

</html>