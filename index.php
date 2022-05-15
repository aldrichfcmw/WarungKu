<?php
  session_start();
    require 'function.php';
    // Menampilkan semua data dari table siswa berdasarkan nis secara Descending
    $kategori = query("SELECT * FROM kategori ORDER BY id_kategori");
    $admin=0;
?>  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>WarungKu</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="asset/css/mdb.min.css" />
    <!-- Style -->
    <link rel="stylesheet" href="asset/css/style.css">
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <!-- <img src="asset/images/mywallpaper.png" width="1000px" alt="" srcset=""> -->

          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
              <!-- Navbar brand -->
              <a class="navbar-brand logo" href="#">
                Warung<span>Ku</span>
              </a>

              <!-- Right elements -->
              <div class="d-flex align-items-center">
                <!-- Icon -->
                <a class="text-reset me-3" href="#">
                  <i class="fas fa-shopping-cart"></i>
                </a>

                <!-- Notifications -->
                <div class="dropdown">
                  <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false" >
                    <i class="fas fa-bell"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">1</span>
                  </a>
                  <ul
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="navbarDropdownMenuLink"
                  >
                    <li>
                      <a class="dropdown-item" href="#">Some news</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">Another news</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </li>
                  </ul>
                </div>
                <!-- Avatar -->
                <div class="dropdown">
                  <a
                    class="dropdown-toggle d-flex align-items-center hidden-arrow"
                    href="#"
                    id="navbarDropdownMenuAvatar"
                    role="button"
                    data-mdb-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <img
                      src="asset/images/foto/fotolaki.png"
                      class="rounded-circle"
                      height="25"
                      alt="Black and White Portrait of a Man"
                      loading="lazy"
                    />
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar" >
                  
                    <?php if(!isset($_SESSION['login'])):?>
                      <li>
                        <a class="dropdown-item" href="login">Login</a>
                      </li>
                    <?php else :?>
                      <li>
                        <a class="dropdown-item disabled" href="#"><?php echo $_SESSION['name'];?></a>
                      </li>
                      <?php if(isset($_SESSION['level']) == $admin){?>
                        <li>
                          <a class="dropdown-item" href="dagangan">Dashboard</a>
                        </li>
                      <?php } ?>
                      <li>
                        <a class="dropdown-item" href="#">My profile</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#">Settings</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="logout">Logout</a>
                      </li>
                    <?php endif; ?>
                      
                  </ul>
                </div>
              </div>
              <!-- Right elements -->
            </div>
            <!-- Container wrapper -->
          </nav>
          <!-- Navbar -->

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
              <div class="row row-cols-1 row-cols-md-4 g-4">
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
              <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php 
                  $dagangan = mysqli_query($koneksi,"select * from dagangan order by nama_barang");
                  while ($barang = mysqli_fetch_array($dagangan)) {
                ?>
                <div class="col">
                  <div class="card">
                    <img src="asset/images/produk/<?= $barang['gambar_barang']; ?>" class="card-img-top" alt="Hollywood Sign on The Hill"/>
                    <div class="card-body">
                      <h5 class="card-text"><?= $barang['nama_barang']; ?></h5>
                      <p class="card-text">
                        Rp. <?= $barang['harga_barang']; ?><br>
                        Stok <?= $barang['jumlah_barang']; ?>
                      </p>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- card -->

        </div>
      </div>
    </div>
    <!-- MDB -->
    <script type="text/javascript" src="asset/js/mdb.min.js"></script>
  </body>
</html>
