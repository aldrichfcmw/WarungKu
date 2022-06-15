<?php
  session_start();
    require 'function.php';
    // Menampilkan semua data dari table  Descending
    $kategori = query("SELECT * FROM kategori ORDER BY id_kategori");
    $admin=0;

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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>WarungKu</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="asset/images/icon/Icon WK.png" type="image/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="asset/css/mdb.min.css" />
    <!-- Style -->
    <link rel="stylesheet" href="asset/css/style.css">
  </head>
  <style>
    .bg1{background-color:#f4f4f4;}
    .bg{background-color:white;}
    body{background-color:#f4f4f4;}
    .detail{font-size:12px;font-weight:400;}
    .produk{font-size:13px;margin-top:-15px;font-weight:600;}
    .harga{font-size:16px;font-weight:600;color:#40aa54;}
    .text-grey{color:grey;}
  </style>
  <body>
    <div class="container">
      <div class="row bg1 justify-content-center">
        <div class="col-md-7 bg-light">
          <!-- <img src="asset/images/mywallpaper.png" width="1000px" alt="" srcset=""> -->

          <?php include 'nav.blade.php';?>

          <!-- carousel -->
          <div class="row justify-content-center mt-2">
            <div class="col-md-10">
              <div id="carouselExampleCaptions" class="carousel slide" data-mdb-ride="carousel">
                <div class="carousel-indicators">
                  <button
                    type="button"
                    data-mdb-target="#carouselExampleCaptions"
                    data-mdb-slide-to="0"
                    class="active"
                    aria-current="true"
                    aria-label="Slide 1"
                  ></button>
                  <button
                    type="button"
                    data-mdb-target="#carouselExampleCaptions"
                    data-mdb-slide-to="1"
                    aria-label="Slide 2"
                  ></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="asset/images/promo/2kai3oj5d1vfzs2426ftcm.webp" class="d-block w-100" alt="Wild Landscape"/>
                  </div>
                  <div class="carousel-item">
                    <img src="asset/images/promo/au20u9s76zb75og60azt.png" class="d-block w-100" alt="Wild Landscape"/>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <!-- carousel -->

          <!-- category -->
          <div class="container mt-2">
            <div class="row">
              <b>Category</b>
              <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4">
                <?php foreach ($kategori as $row) : ?>
                <a href="#">
                  <div class="col">
                    <div class="card text-center">
                      <div class="card-body">
                        <img src="asset/images/icon/<?= $row['icon']; ?>" alt="" srcset=""><br>
                        <span class="link"><?= $row['kategori']; ?></span>
                      </div>
                    </div>
                  </div>
                </a>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <!-- category -->

          <!-- card -->
          <div class="container mt-2">
            <div class="row">
              <b>Items</b>
              <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4">
                <?php 
                  $dagangan = mysqli_query($koneksi,"select * from dagangan order by nama_barang");
                  while ($barang = mysqli_fetch_array($dagangan)) {
                ?>
                <div class="col">
                  <div class="card">
                    <img src="asset/images/produk/<?= $barang['gambar_barang']; ?>" class="card-img-top" alt="Hollywood Sign on The Hill"/>
                    <div class="card-body">
                      <div class="card-text produk mb-1"><?= $barang['nama_barang']; ?></div>
                       <div class="row">
                        <div class="col-10">
                            <div class="card-text detail">
                            Stok <?= $barang['jumlah_barang']; ?><br>
                            <div class="harga">Rp. <?= $barang['harga_barang']; ?></div>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="d-flex">
                              <a href="index?add_item=<?= $barang['id_barang']; ?>">
                                <i class="fa fa-cart-shopping" style="color:grey;"></i>
                              </a>
                            </div>
                        </div>
                       </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- card -->

          <?php include "footer.blade.php"; ?>         
        
        </div>
        
      </div>
      <!-- row -->
    </div>
    <!-- Container -->
    
    <!-- MDB -->
    <script type="text/javascript" src="asset/js/mdb.min.js"></script>
  </body>
</html>
