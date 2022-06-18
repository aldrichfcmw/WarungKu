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
// delete task
if (isset($_GET['pay_item'])){
    // Jika fungsi delete lebih dari 0/data tertambah, maka munculkan alert dibawah
    if(checkout($id) > 0){
        if (deleted($id) > 0 ) {
            echo "<script>
                        alert('Pembayaran Berhasil');
                        document.location.href = 'index';
                    </script>";
        } else {
            echo "<script>
                    alert('Pembayaran gagal');
                </script>";
        }
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
                        <div class="col-sm-6 col-md-6 col-xs-12 bg-white">
                            <?php include "navbar.blade.php";?>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="m-2 font-weight-bold text-black text-center">
                                        <?php $cart = mysqli_query($koneksi,"SELECT * FROM keranjang where id_user=$id");
                                        $pilih = mysqli_fetch_array($cart);
                                        $jumlah = mysqli_num_rows($cart);?>
                                        <?php if ($jumlah > 0):?>                                        
                                            Total Pembayaran <br> Rp.
                                        <?php echo $pilih['harga']; else : ?>
                                            Total Pembayaran Rp. 0
                                        <?php endif ?>
                                    </div>  
                                </div>
                            </div>
                            <?php if($jumlah > 0):?>
                                <?php 
                                $payment = mysqli_query($koneksi,"SELECT * FROM metode_pembayaran ORDER BY metode");
                                while ($row = mysqli_fetch_array($payment)) {
                                ?>
                                    <a class="" href="" data-toggle="modal" data-target="#thankyouModal">
                                        <div class="col-sm-12 p-1">
                                            <div class="card border-left-primary shadow">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="h5 mb-0 text-gray-600"><?= $row['metode']; ?></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <img src="asset/images/icon/<?= $row['gambar']; ?>" width="50px" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>
                            <?php else : ?>
                                <div class="col-sm-12 p-1">
                                    <div class="card border-left-danger shadow">
                                        <div class="card-body">
                                            <div class="row no-gutters text-center align-items-center">
                                                <div class="col mr-2">
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">No Item Added</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <a class="mt-2 btn btn-md btn-block btn-primary" href="cart">
                                                <i class="fa fa-undo fa-sm fa-fw mr-2 text-white-400"></i>
                                                Kembali
                        </a>



                            
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
    <div class="modal fade text-dark" id="thankyouModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transksi Berhasil</h5>
                    <button class="close" type="button" data-dismiss="modal" onClick="showDiv('toggle')" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Terimakasih Telah Berbelanja di WarungKu</div>
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
    <script type="text/javascript">
    function showDiv(toggle){
        document.location.href = 'metode?pay_item=<?= $id;?>';
    }
    </script>
</body>

</html>