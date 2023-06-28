<?php
    require "session.php";
    require "../koneksi.php";
    $querykategori =mysqli_query($con, "SELECT * FROM kategori");
    $jumlahkategori =mysqli_num_rows($querykategori);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori </title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>
        <style>
                .main{
                    height: 100vh;
                }
                .login-box{
                    width: 450px;
                    height: 160px;
                    box-sizing:border-box;
                    border-radius: 10px;
                }
                .no-decoration{
                    text-decoration: none;
                }
                .panjang{
                    width: 1200px;
                }
                .kotak{
                    border-radius:20px;
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
                    <a href="../adminpanel" class = "no-decoration text-muted">
                        <i class="fa-solid fa-house-user"></i>
                        Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-paperclip"></a>
                    </i>
                     Kategori</li>
                </ol>
                </nav>

                   
                    <form action="" method ="post">
                        <div class="container mt-5">
                            <div class ="row">
                                    <div class="kotak navbar-dark bg-success p-5 col-lg-4 col-lg-6 col-12">
                                        <label for="kategori"  class =" text-white">Tambah kategori &ensp;:&ensp;</label>
                                            <input type="text" id="kategori1" name ="kategori1" placeholder="input nama kategori"
                                            class="from-control"><br>
                                            <button class="btn btn-light mt-3 " type="submit" name="simpan_kategori">simpan</button>
                            </div>
                        </div>
                                
                    </form>
                    <div class="mt-3" style = "width: 450px">
                    <?php
                        if(isset($_POST['simpan_kategori'])){
                            $kategori = htmlspecialchars($_POST['kategori1']);
                            $cekDataKategori = mysqli_query($con, "SELECT nama FROM kategori WHERE nama ='$kategori'");
                            $jumlahKategoriBaru =mysqli_num_rows($cekDataKategori);

                            if($jumlahKategoriBaru > 0){
                                ?>
                                <div class="alert alert-danger mt-3" role="alert ">
                                    Kategori Sudah Ada, Coba Lagi!
                                </div>
                                <?php
                            }else{
                                $simpanDataKategori = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$kategori')");

                                if($simpanDataKategori){
                                   ?>
                                <div class="alert alert-info mt-3" role="alert ">
                                    Kategori Berhasil Disimpan!

                                    <meta http-equiv="refresh" content="1; url=kategori.php" />
                                </div>
                                   <?php
                                }else{
                                    echo mysqli_error($con);
                                }
                                   ?>
                                   <?php  
                                
                            }
                        }
                    ?>
                    </div>
                <div class="mt-3">
                    <h2>List kategori</h2>
                    <div class="table-responsive  mt-5">
                    <table class ="table">
                        <thead class = "navbar-dark bg-success text-white">
                                <tr>
                                    <th>Nomer</th>
                                    <th>Kategori</th>
                                    <th>Edit / Delete</th>
                                </tr>   
                        </thead>
                        <tbody>
                            <?php
                            if($jumlahkategori==0){
                           ?>
                            <tr>
                                <td>data tidak ada </td>
                            </tr>
                            <?php
                            }else{
                                $jumlah = 1;
                                while($data=mysqli_fetch_array($querykategori)){
                                ?>
                                <tr>
                                    <td><?php echo $jumlah;?>.</td>
                                    <td><?php echo $data['nama'];?></td>
                                    <td>&ensp;&ensp;
                                        <a href="kategori-detail.php?id=<?php echo $data['id'];?>"
                                        class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $jumlah++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    </din>
                </div>
        </div>
        <script src = "../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src ="../fontawesome/js/all.min.js"></script>
</body>
</html>