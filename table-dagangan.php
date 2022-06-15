<?php
    session_start();
    // Jika tidak bisa login maka balik ke login.php
    // jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
    if (!isset($_SESSION['login'])) {
        header('location:login');
        exit;
    }

    // Memanggil atau membutuhkan file function.php
    require 'function.php';

    // Menampilkan semua data dari table barang berdasarkan id
    $dagangan = query("SELECT * FROM dagangan ORDER BY id_barang");

    
    // delete task
    if (isset($_GET['del_item'])){
        $id_barang = $_GET['del_item'];
        // Jika fungsi hapus lebih dari 0/data terhapus, maka munculkan alert dibawah
        if (hapus($id_barang) > 0) {
            echo "<script>
                        alert('Data berhasil dihapus!');
                        document.location.href = 'dagangan';
                    </script>";
        } else {
            // Jika fungsi hapus dibawah dari 0/data tidak terhapus, maka munculkan alert dibawah
            echo "<script>
                    alert('Data gagal dihapus!');
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

    <title>WK Admin - Tables</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="asset/images/icon/Icon WK.png" type="image/png">

    <!----===== Boxicons CSS ===== -->
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="asset/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php include 'side.blade.php';?>
    
    

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php include 'navbar.blade.php';?>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tabel Dagangan</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Product</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Kategori</th>
                                            <th>ID Barang</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID Kategori</th>
                                            <th>ID Barang</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($dagangan as $row) : ?>
                                        <tr>
                                            <td><?= $row['id_kategori']; ?></td>
                                            <td><?= $row['id_barang']; ?></td>
                                            <td><?= $row['nama_barang']; ?></td>
                                            <td><?= $row['jumlah_barang']; ?></td>
                                            <td><?= $row['harga_barang']; ?></td>
                                            <td>
                                                <a href="edit-dagangan?id_barang=<?= $row['id_barang']; ?>" class="btn btn-sm btn-flat btn-warning">
                                                <i class='fas fa-fw fa-file' ></i>
                                                </a>
                                                <a href="dagangan?del_item=<?= $row['id_barang']; ?>" 
                                                class="btn btn-sm btn-flat btn-danger" onclick="return confirm('Hapus barang <?= $row['nama_barang']; ?>?')">
                                                <i class='fas fa-fw fa-trash'></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include 'footer.blade.php'?>

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

    <!-- Page level plugins -->
    <script src="asset/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="asset/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="asset/js/demo/datatables-demo.js"></script>

</body>

</html>