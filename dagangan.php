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

    // Menampilkan semua data dari table siswa berdasarkan nis secara Descending
    $dagangan = query("SELECT * FROM dagangan ORDER BY id_barang DESC");

    
    // delete task
    if (isset($_GET['del_item'])){
        $id_barang = $_GET['del_item'];
        mysqli_query($db, "DELETE FROM dagangan WHERE id_barang='$id_barang'");
        // Jika fungsi hapus lebih dari 0/data terhapus, maka munculkan alert dibawah
        if (hapus($id_barang) > 0) {
            echo "<script>
                        alert('Data berhasil dihapus!');
                        document.location.href = 'dagangan.php';
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
                    <a href="add-dagangan.php" class="btn  btn-sm btn-primary btn-flat">
                        <i class="fa fa-plus"></i> Tambah Barang
                    </a>
                    <a href="" onclick="return confirm('Hapus semua barang?')"  class="btn btn-danger btn-sm btn-flat"> 
                        <i class="fa fa-trash"></i> Hapus Semua Barang
                    </a>
                    <a href="" onclick="return confirm('Export semua barang?')"  class="btn btn-success btn-sm btn-flat"> 
                        <i class="fa fa-file-excel"></i> Export Semua Barang
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
                    <?php foreach ($dagangan as $row) : ?>
                        <tr>
                            <td><?= $row['id_kategori']; ?></td>
                            <td><?= $row['id_barang']; ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['jumlah_barang']; ?></td>
                            <td><?= $row['harga_barang']; ?></td>
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
                        <?php endforeach; ?>
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