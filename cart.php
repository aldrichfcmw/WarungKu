<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:login');
    exit;
}
$admin=0;
// Memanggil atau membutuhkan file function.php
require 'function.php';
$id=$_SESSION['id'];
$cart = query("SELECT * FROM keranjang where id_user=$id");

// delete task
if (isset($_GET['delete_item'])){
    $id_keranjang = $_GET['delete_item'];
    // Jika fungsi delete lebih dari 0/data tertambah, maka munculkan alert dibawah
    if (delete($id_keranjang) > 0) {
        echo "<script>
                    alert('Item berhasil dihapus');
                    document.location.href = 'cart';
                </script>";
    } else {
        // Jika fungsi delete dibawah dari 0/data tidak tertambah, maka munculkan alert dibawah
        echo "<script>
                alert('Item gagal dihapus');
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

    <!-- Custom styles for this page -->
    <link href="asset/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
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
                        <div class="col-6 col-xs-12">
                            <?php include "navbar.blade.php";?>

                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between">
                                    <div class="m-2 font-weight-bold text-primary">
                                        Data Cart Product
                                    </div>
                                    <div class="">
                                        <a class=" btn btn-md btn-flat btn-primary" href="index">
                                                <i class="fa fa-undo fa-sm fa-fw mr-2 text-white-400"></i>
                                                Kembali
                                            </a>

                                        <a class=" btn btn-md btn-flat btn-success" href="#" data-toggle="modal" data-target="#cartModal">
                                            <i class="fa fa-shopping-cart fa-sm fa-fw mr-2 text-white-400"></i>
                                            Bayar
                                        </a>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Gambar</th>
                                                    <th>Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Gambar</th>
                                                    <th>Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $no=1;?>
                                                <?php foreach ($cart as $row) : ?>
                                                
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td>
                                                        <img src="asset/images/produk/<?= $row['gambar_barang']; ?>" width="100px" class="" alt=""/>
                                                    </td>
                                                    <td><?= $row['barang']; ?></td>
                                                    <td><?= $row['jumlah']; ?></td>
                                                    <td><?= $row['harga']; ?></td>
                                                    <td>
                                                        <a href="cart?delete_item=<?= $row['id_keranjang']; ?>" 
                                                        class="btn btn-sm btn-flat btn-danger" onclick="return confirm('Hapus barang <?= $row['barang']; ?>?')">
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

    <!-- cart Modal-->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah pesanan anda sudah sesuai?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Belum</button>
                    <a class=" btn btn-primary" href="metode.php">
                        <i class="fa fa-shopping-cart fa-sm fa-fw mr-2 text-white-400"></i>
                        Bayar
                    </a>
                </div>
            </div>
        </div>
    </div>

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
    
</body>

</html>