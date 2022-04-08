    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="asset/images/foto/fotolaki.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name"><?php echo $_SESSION['name'];?></span>
                    <span class="profession">Dashboard Admin</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>
        

        <div class="menu-bar">
            <div class="menu">

                <!--<li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>-->

                <ul class="menu-links">
                    <li class="  ">
                        <a href="index">
                            <i class='bx bxs-home icon' ></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>

                    <li class="  ">
                        <a href="dagangan">
                            <i class='bx bxs-data icon' ></i>
                            <span class="text nav-text">Produk</span>
                        </a>
                    </li>

                    <li class="  ">
                        <a href="add-dagangan">
                            <i class='bx bxs-file-plus icon'></i>
                            <span class="text nav-text">Add Produk</span>
                        </a>
                    </li>

                    <li class="  ">
                        <a href="#">
                            <i class='bx bx-wallet icon' ></i>
                            <span class="text nav-text">Wallets</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="logout">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                
                
            </div>
        </div>

    </nav>

    <section class="home">
        <div class="text">Dashboard Sidebar</div>
    </section>

    <script>
        const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");


toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () =>{
    sidebar.classList.remove("close");
})


    </script>
