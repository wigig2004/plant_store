<?php
    require "session.php";
    require "../koneksi.php";
    
    $id = $_GET['id'];

    $dataYgDiBuka = mysqli_query($con, "SELECT * FROM kategori WHERE id='$id'");
    $tampil = mysqli_fetch_array($dataYgDiBuka);
    
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>
<style>
                .kotak{
                    border-radius:20px;
                    width: 1000px;
                }    
                .main{
                    height: 100vh;
                    
                }
                .login-box{
                    width: 700px;
                    height: 200px;
                    box-sizing:border-box;
                    border-radius: 10px;
                }
                .no-decoration{
                    text-decoration: none;
                }
                .panjang{
                    width: 400px;
                    border-radius: 10px;
                }
                .tombol{
                    border-radius: 10px;
                    width: 70px;
                }
                .panjangalert{
                    width: 500px;
                    border-radius: 10px;
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
                    <a href="kategori.php" class = "no-decoration text-muted">
                        <i class="fa-solid fa-backward"></i>
                        kembali</a>
                    </li>
        </div>
                    <div class="container mt-5">
                <div class ="row">
            <form action="" method ="post">
                    <div class ="row">
                        <div class="kotak p-5 navbar-dark bg-success col-lg-4 col-lg-6 col-12 mt-3">
                        <div class="row">
                            <div class="col-6">
                            <i class="fa-solid fa-pen-to-square fa-3x text-black-50"></i>
                            </div>
                            <label class ="mt-5 text-white" ><h4>Detail kategori &ensp;:&ensp;</label>
                                <input type="text" id="detail_kategori" name ="detail_kategori" value="<?php echo $tampil['nama'];?>"
                                class="from-control panjang col-lg-4 col-lg-6 col-12" ></h4><br>
                                <button class=" btn btn-light mt-3 tombol" type="submit" name="edit">Edit</button>&ensp;   
                                <button class=" btn btn-light mt-3 tombol" type="submit" name="delete">Delete</button>  
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
        <div class="container mt-5">
        <?php
       
                        if(isset($_POST['edit'])){
                            $kategori = htmlspecialchars($_POST['detail_kategori']);
                            
                            if($tampil['nama']==$kategori){
                                ?>
                                  <meta http-equiv="refresh" content="0; url=kategori.php" />
                                
                                <?php
                            }else{
                                $cekDataKategori = mysqli_query($con, "SELECT * FROM kategori WHERE nama ='$kategori'");
                                $jumlahKategoriBaru =mysqli_num_rows($cekDataKategori);
    
                                if($jumlahKategoriBaru > 0){
                                   ?>
                                <div class="  alert alert-danger mt-3 panjangalert col-lg-4 col-lg-6 col-12" role="alert ">
                                    Kategori Sudah Ada, Coba Lagi!
                                </div>
                                   <?php
                                }else{
                                    $simpanDataKategori = mysqli_query($con, " UPDATE kategori SET  nama = '$kategori'   WHERE   id='$id'");

                                    if($simpanDataKategori){
                                   ?>
                                         <div class="  alert alert-info mt-3 panjangalert col-lg-4 col-lg-6 col-12" role="alert ">
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
                    }if(isset($_POST['delete'])){
                        $delete = mysqli_query($con, "DELETE FROM kategori WHERE id='$id'" );
                        ?>
                        <div class="  alert alert-danger mt-3 panjangalert col-lg-4 col-lg-6 col-12" role="alert ">
                            Kategori Berhasil Dihapus!

                            <meta http-equiv="refresh" content="1; url=kategori.php" />
                        </div>
                        <?php
                    }
                    ?>
                    </div>
        <script src = "../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src ="../fontawesome/js/all.min.js"></script>
</body>
</html>