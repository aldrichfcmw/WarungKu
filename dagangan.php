<?php
    //connect to the database
    $db= mysqli_connect('localhost','root','','warungku');
    // delete task
    if (isset($_GET['del_item'])){
        $id = $_GET['del_item'];
        mysqli_query($db, "DELETE FROM dagangan WHERE id='$id'");
        header('location: dagangan.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="asset/css/side.css">
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!----===== DataTable CSS ===== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <?php include 'side.blade.php';?>
    <section class="home">
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dagangan</span>
                </div>
            </div>
            <div class="box-header" style="margin-top: 20px;margin-left: 2px">
                <p>
                    <a href="add.dagangan.php" class="btn  btn-sm btn-primary btn-flat">
                        <i class="fa fa-plus"></i> Tambah Barang
                    </a>
                    <a href="" onclick="return confirm('Hapus semua barang?')"  class="btn btn-danger btn-sm btn-flat"> 
                        <i class="fa fa-trash"></i> Hapus Semua Barang
                    </a>
                </p>
            </div>
            <div class="container-fluid">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                    <tbody>
                    <?php $data = mysqli_query($db,"select * from dagangan");
                    while($d = mysqli_fetch_array($data))
                    {?>
                        <tr>
                            <td><?php echo $d['id_kategori']; ?></td>
                            <td><?php echo $d['id_barang']; ?></td>
                            <td><?php echo $d['nama_barang']; ?></td>
                            <td><?php echo $d['jumlah_barang']; ?></td>
                            <td><?php echo $d['harga_barang']; ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-flat btn-warning">
                                <i class='bx bx-edit-alt' ></i>
                                </a>
                                <a href="todo-editor.php?del_task=<?php echo $d['id_barang']; ?>" 
                                class="btn btn-sm btn-flat btn-danger" onclick="return confirm('Hapus barang <?php echo $d['nama_barang'];  ?>?')">
                                <i class='bx bx-trash'></i>
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
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
                </table>
            </div>
            
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js" ></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</body>
</html>