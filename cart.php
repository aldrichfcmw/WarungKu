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
if (isset($_POST['rubah'])) {
    if (ubahitem($_POST) > 0) {
        echo "<script>
                alert('Jumlah Item berhasil diubah!');
                document.location.href = 'cart';
            </script>";
    } else {
        // Jika fungsi tambah dari 0/data tidak tersimpan, maka munculkan alert dibawah
        echo "<script>
                alert('Jumlah Item gagal diubah!');
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
        .full{
            height:100vh;
        }
    </style>
</head>

<body id="page-top" class="full">
    <!-- Page Wrapper -->
    <div id="wrapper" class="full">
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
                                    <div class="m-2 font-weight-bold text-danger text-center">
                                        Hanya dapat melakukan 1 item pertransaksi !
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex">
                                    <div class="m-2 font-weight-bold text-primary">
                                        Data Cart Product
                                    </div>
                                    
                                    
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center " id="dataTable" width="100%" cellspacing="0" >
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
                                            
                                            <tbody>
                                                <?php $no=1;$total=0;$harga=0;?>
                                                <?php foreach ($cart as $row) : ?>
                                                
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td>
                                                        <img src="asset/images/produk/<?= $row['gambar_barang']; ?>" width="100px" class="" alt=""/>
                                                    </td>
                                                    <td><?= $row['barang']; ?></td>
                                                    <td><?= $row['jumlah']; ?></td>
                                                    <td>Rp. <?= $row['harga']; ?></td>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-flat btn-warning" data-toggle="modal" data-target="#<?= $row['kode_barang']; ?>">
                                                            <i class='fas fa-fw fa-file'></i>
                                                        </a>
                                                        <a href="cart?delete_item=<?= $row['id_keranjang']; ?>" 
                                                        class="btn btn-sm btn-flat btn-danger" onclick="return confirm('Hapus barang <?= $row['barang']; ?>?')">
                                                            <i class='fas fa-fw fa-trash'></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php 
                                                    $total=$total+$row['jumlah'];
                                                    $harga=$harga+$row['harga'];
                                                ?>
                                                <?php endforeach; ?>
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <th colspan="3"></th>
                                                    <th><?php echo $total;?></th>
                                                    <th>Rp. <?php echo $harga;?></th>
                                                    <th>
                                                    <?php if($jumlah == 1):?>
                                                        <a class="btn btn-md btn-flat btn-success mb-1" href="" data-toggle="modal" data-target="#cartModal">
                                                            <i class="fa fa-shopping-cart fa-sm fa-fw mr-2 text-white-400"></i>
                                                            Bayar
                                                        </a>
                                                    <?php elseif($jumlah == 2):?>
                                                        <button class="btn btn-md btn-flat btn-secondary mb-1 disabled" href="" data-toggle="modal" data-target="#cartModal2">
                                                            <i class="fa fa-shopping-cart fa-sm fa-fw mr-2 text-white-400"></i>
                                                            Bayar
                                                        </button>    
                                                    <?php else:  ?>
                                                        <button class=" btn btn-md btn-flat btn-secondary mb-1 disbaled" href="#" data-toggle="modal" data-target="#cartModal3">
                                                            <i class="fa fa-shopping-cart fa-sm fa-fw mr-2 text-white-400"></i>
                                                            Bayar
                                                        </button>    
                                                    <?php endif; ?>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <a class=" btn btn-block btn-md btn-flat btn-primary mb-1" href="index">
                                        <i class="fa fa-undo fa-sm fa-fw mr-2 text-white-400"></i>
                                        Kembali
                                    </a>
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

    <!-- cart Modal-->
    <div class="modal fade text-dark" id="cartModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">Mohon Maaf pembelian lebih dari 1 masih dalam tahap pengembangan</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <!-- cart Modal-->
    <div class="modal fade text-dark" id="cartModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Terjadi Kesalahan, tidak ada item yang dibayar</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
    
    <?php 
        $dagangan = mysqli_query($koneksi,"select * from keranjang where id_user=$id");
        while ($barang = mysqli_fetch_array($dagangan)) {
    ?>
    <!-- cart Modal-->
    <div class="modal fade text-dark" id="<?php echo $barang['kode_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post" enctype="">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Edit Jumlah</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $barang['barang']; ?></div>
                <div class="mb-3 col">
                    <input class="form-control" type="hidden" name="id_keranjang" value="<?php echo $barang['id_keranjang']; ?>">
                    <input class="form-control" type="hidden" name="harga" value="<?php echo $barang['harga']; ?>">
                    Masukkan jumlah item
                    <input class="form-control" type="text" name="jumlah" value="<?php echo $barang['jumlah']; ?>">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" name="rubah" > 
                        Next
                </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

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