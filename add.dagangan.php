<?php
    //connect to the database
    $db= mysqli_connect('localhost','root','','warungku');

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
            <form action="" method="post">
            <div class="container-fluid" >
                <div class="row mt-2">
                    <div class="col-8">
                        <h4>Tipe Produk</h4>
                        <div class="form-group ml-4">
                            <select class="form-control">
                                <option>Default select</option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <h4>Informasi Produk</h4>
                            <div class="col">
                                <label >Gambar Produk</label><br>
                                <label class="imagepicker imagepicker-add thumbnail">
                                <input type='file' id="imagepicker2" multiple>
                                </label>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="col">
                                <div class="mb-3 ">
                                    <label for="validationTextarea">Deskripsi Produk</label>
                                    <textarea class="form-control" id="validationTextarea" placeholder="Masukkan Deskripsi Produk" required></textarea>
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
                                    <input type="text" class="form-control">
                                </div>
                                <label for="">Stok</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col text-align-center">
                            <button type="button" class="btn btn-lg btn-primary btn-block">Buat Dagangan</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
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