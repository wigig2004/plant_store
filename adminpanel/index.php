<?php

    require "session.php";
    require "../koneksi.php";

    $querykategori =mysqli_query($con, "SELECT * FROM kategori");
    $jumlahkategori =mysqli_num_rows($querykategori);

    $queryproduk =mysqli_query($con, "SELECT * FROM produk");
    $jumlahproduk =mysqli_num_rows($queryproduk);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>toko tanaman hias</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    </head>
        <style>
                .kotak{
                    border-radius:20px;
                    
                }    
                .no-decoration{
                    text-decoration: none;
                }
        </style>
        <body>
            <?php
            require "navbar.php";
            ?>
            <div class="container mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-house-user"></i>
                     Home</li>
                </ol>
                </nav>
            <h3>Hai admin! </h3>
            <div class="container mt-5">
                <div class ="row">
                    <div class="col-lg-4 col-lg-6 col-12 mb-3">
                        <div class = "kotak navbar-dark bg-success p-3">
                        <div class="row">
                            <div class="col-6">
                            <i class="fa-solid fa-paperclip fa-3x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Kategori</h3>
                                <p class="fs-4"><?php echo $jumlahkategori; ?>. Kategori</p>
                                <p>
                                    <a href="kategori.php" class ="text-white no-decoration" >Klik untuk melihat</a>
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-lg-6 col-12 mb-3">
                    <div class = "kotak navbar-dark bg-success p-3">
                        <div class="row">
                            <div class="col-6">
                            <i class="fa-solid fa-tree fa-3x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Produk</h3>
                                <p class="fs-4"><?php echo $jumlahproduk; ?>. Produk tanaman</p>
                                <p>
                                    <a href="produk.php" class ="text-white no-decoration" >Klik untuk melihat</a>
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
             </div>
            </div>
            <script src = "../bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src ="../fontawesome/js/all.min.js"></script>
        </body>
</html>