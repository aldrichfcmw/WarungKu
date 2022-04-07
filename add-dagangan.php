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

// Menampilkan semua data dari table siswa berdasarkan nis secara Descending
$dagangan = query("SELECT * FROM kategori ORDER BY id_kategori");


// Jika fungsi tambah lebih dari 0/data tersimpan, maka munculkan alert dibawah
if (isset($_POST['simpan'])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Data Dagangan berhasil ditambahkan!');
                document.location.href = 'dagangan';
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
    <style>
        /* Create the look of a generic thumbnail */
        .thumbnail {
        position:relative;
        display:inline-block;
        width:8em;
        height:6em;
        border-radius:0.6em;
        border:0.25em solid white;
        vertical-align:middle;
        box-shadow:0 0.15em 0.35em 0.1em rgba(0,0,0,0.2);
        margin:0.5em;
        
        background-position:center;
        background-size:cover;
        }



        /* This will hide the file input */
        .imagepicker input {
        display:none;
        }
        .imagepicker {
        cursor:pointer;
        color:white;
        background-color:rgba(0,0,0,0.3);
        }
        /* This will add the floating plus symbol to the imagepicker */
        .imagepicker:before {
        content:'+';
        position:absolute;
        font-size:3em;
        vertical-align:middle;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        }
        /* This will hide the plus symbol behind the background of the imagepicker if the class "picked" is added to the element */
        .imagepicker.picked:before {
        z-index:-1;
        }
    </style>

</head>
<body>
    <?php include 'side.blade.php';?>
    <section class="home">
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Tambah Dagangan</span>
                </div>
            </div>
            <div class="container-fluid" >
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row mt-2">
                
                    <div class="col-8">
                        <h4>Tipe Produk</h4>
                        <div class="form-group ml-4">
                            <select class="form-control" name="id_kategori">                            
                                <option disabled selected value>Default select</option>
                                <?php foreach ($dagangan as $row) : ?>
                                <option value="<?= $row['id_kategori'];?>"><?= $row['id_kategori']; ?> - <?= $row['kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label class="mt-4" for="">Nama Produk</label>
                                <input type="text" name="nama" class="form-control" required>                
                        </div>
                        <div class="form-group mt-4">
                            <h4>Informasi Produk</h4>
                            <div class="col">
                                <label >Gambar Produk</label><br>
                                <label class="imagepicker imagepicker-add thumbnail">
                                <input type='file' id="gambar" name="gambar" required>
                                </label>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="col">
                                <div class="mb-3 ">
                                    <label for="validationTextarea">Deskripsi Produk</label>
                                    <textarea class="form-control" id="validationTextarea" name="deskripsi" placeholder="Masukkan Deskripsi Produk" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <h4>Informasi Stok dan Harga</h4>
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
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js" ></script>
    <script>
        // This function just works and can be used for many file types.
        // It will accept multiple files, and will only fire the callback once for each file.
        // Don't try to reinvent this
        function readFiles(files,callback,index=0) {
        if (files && files[0]) {
            let file = files[index++],
                reader = new FileReader();
            reader.onload = function(e){
            callback(e);
            if(index<files.length) readFiles(files,callback,index);
            }
            reader.readAsDataURL(file);
        }
        }

        // Create a selector for an input and then do whatever you want using the callback function.
        $("body")
        .on("change",".imagepicker-replace input",function() {
        // store the current "this" into a variable
        var imagepicker = this;
        readFiles(this.files,function(e) {
            // "this" will be different in the callback function
            $(imagepicker).parent()
            .addClass("picked")
            .css({"background-image":"url("+e.target.result+")"});
        });
        })

        // This example will add a new thumbnail each time
        $("body")
        .on("change",".imagepicker-add input",function() {
        var imagepicker = this;
        readFiles(this.files,function(e) {
            $(imagepicker).parent().before(
            "<div class='thumbnail' style='background-image:url("+e.target.result+")'></div>"
            )
        });
        });
    </script>
</body>
</html>