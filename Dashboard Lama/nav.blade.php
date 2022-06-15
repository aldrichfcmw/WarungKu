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
                <!-- Notifications -->
                <div class="dropdown">
                  <?php if(isset($_SESSION['id'])):?>
                    <?php 
                      $id=$_SESSION['id'];
                      $kj = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE id_user=$id");
                      $jumlah =mysqli_num_rows($kj);
                    ?>
                    <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false" >
                      <i class="fa fa-cart-shopping"></i>
                        <span class="badge rounded-pill badge-notification bg-danger"><?php echo $jumlah; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                      <?php while ( $keranjang = mysqli_fetch_array($kj)) { ?>
                        <li>
                          <a class="dropdown-item" href="#">
                            <div class="row">
                              <div class="col">
                                @<?php echo $keranjang['jumlah']; ?> |
                                <?php echo $keranjang['barang']; ?>
                              </div>
                              <div class="col">
                                Rp. <?php echo $keranjang['harga']; ?>
                              </div>
                            </div>
                          </a>
                        </li>
                      <?php } ?>
                      <li>
                        <a class="dropdown-item btn btn-success" href="checkout" style="color: black">Checkout</a>
                      </li>
                    </ul>   
                  <?php else :?>
                    <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false" >
                      <i class="fa fa-cart-shopping"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">0</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                      <li>
                        <a class="dropdown-item" href="#">Nothing</a>
                      </li>
                    </ul>
                  <?php endif; ?>
                </div>

                <!-- Notifications -->
                <div class="dropdown">
                  <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false" >
                  <i class="fa fa-bell"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">3</span>
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
                      src="asset/images/profile/fotolaki.png"
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
                      <?php if($_SESSION['level'] == $admin){?>
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