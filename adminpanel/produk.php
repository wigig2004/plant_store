<?php
    require "session.php";
    require "../koneksi.php";

    $queryproduk =mysqli_query($con, "SELECT * FROM produk");
    $jumlahproduk =mysqli_num_rows($queryproduk);

    $querykategori =mysqli_query($con, "SELECT * FROM kategori");

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
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
                form div{
                    margin-bottom : 10px;
                } .kotak{
                    border-radius:20px;
                }
                .forCB2{
                    margin-top: -5%;
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
                    <i class="fa-solid fa-tree"></a>
                    </i>
                     produk</li>
                </ol>
                </nav>

                <form action="" method ="post" enctype="multipart/form-data">
                <div class="container mt-5">
                                    <div class ="row">
                                    <div class="kotak navbar-dark bg-success p-5 col-lg-4 col-lg-6 col-12">
                                    
                                        <div>
                                        <label for="nama" class =" text-white">Nama &ensp;&ensp;&ensp;:&ensp;</label>
                                            <input type="text" id="nama" name ="nama" class="from-control" required>
                                        </div>
                                        <div>
                                        <label for="kategori" class =" text-white">Kategori &ensp;:&ensp;</label>
                                            <select name="kategori" id="kategori" class="from-control " style = "width: 175px" required>
                                                <option value="">pilih</option>
                                                <?php
                                                   $query = "SELECT id, nama FROM kategori
                                                   ORDER BY nama";
                                                   $sql = mysqli_query ($con,$query);
                                                   while ($hasil = mysqli_fetch_array ($sql)) {
                                                   echo "<option value='$hasil[id]'>$hasil[nama]</option>";
                                                   }
                                                ?>
                                            </select>
                                        </div>
                                        <div>
                                        <label for="harga" class =" text-white">Harga &ensp;&ensp;&ensp;:&ensp;</label>
                                            <input type="number" id="harga" name ="harga" class="from-control" required>
                                        </div>
                                        <div>
                                        <label for="foto" class =" text-white">Foto &nbsp;&ensp;&ensp;&ensp;&ensp;:&ensp;</label>
                                            <input type="file" id="foto" name ="foto" class="from-control" >
                                        </div>
                                        <div>
                                        <label for="detail" class =" text-white ">Detail &nbsp;&ensp;&ensp;&ensp;:&ensp;</label>
                                            <textarea id="detail" name ="detail" class="from-control" cols="23"></textarea>
                                        </div>
                                        <div>
                                        <label for="stok" class =" text-white">Stok &nbsp;&nbsp;&ensp;&ensp;&ensp;&ensp;:&ensp;</label>
                                            <select name="stok" id="stok" class="from-control">
                                                <option value="tersedia">Tersedia</option>
                                                <option value="habis">Habis</option>
                                            </select>
                                        </div>
                                        <div>
                                            <button class="btn btn-light mt-3 " type="submit" name="simpan">simpan</button>
                                            </div>
                                        </div>
                                        </div>
                                    
                                    </div>
                                
                </form>
                <div class="mt-3" style = "width: 650px">
                <?php
                        if(isset($_POST['simpan'])){
                            $nama = htmlspecialchars($_POST['nama']);
                            $kategori =$_POST['kategori'];
                            $harga = htmlspecialchars($_POST['harga']);
                            $detail = htmlspecialchars($_POST['detail']);
                            $stok = htmlspecialchars($_POST['stok']);
                            $target_dir = "../img/";
                            $fileName = basename($_FILES["foto"]["name"]);
                            $target_file = $target_dir . $fileName;
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                            $img_size = $_FILES["foto"]["size"];
                            $renameauto = generateRandomString(10);
                            $rename = $renameauto . "." . $imageFileType;

                            // echo $target_dir."<br>";
                            //echo $fileName."<br>";
                            //echo $target_file."<br>";
                            //echo $imageFileType."<br>";
                            //echo $img_size."<br>";

                            if($nama=="" || $kategori =="" || $harga ==""){
                                ?>
                                <div class="alert alert-danger mt-3" role="alert ">
                                        Nama, Kategori, Harga Tidak Boleh Konsong!
                                </div>
                                <?php
                            }else{
                                if($fileName !=''){
                                    if ($img_size > 1000000) {
                                    ?>
                                    <div class="alert alert-danger mt-3" role="alert ">
                                            file tidak boleh lebih dari 500kb !
                                        </div>
                                    <?php
                                    }else{
                                        if($imageFileType != "jpg" && $imageFileType != "png"  ) {
                                            ?>
                                            <div class="alert alert-danger mt-3" role="alert ">
                                                    file harus jpg atau png !
                                            </div>
                                            <?php
                                        }else{
                                            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $rename);
                                        }
                                    }
                                }
                                
                                $query = "INSERT INTO produk
                                VALUES('','$kategori','$nama','$harga','$rename','$detail','$stok')";
                                $simpanDataKategori = mysqli_query($con,$query); 

                                if($simpanDataKategori){
                                   ?>
                                <div class="alert alert-info mt-3" role="alert ">
                                    Produk Berhasil Disimpan!

                                    <meta http-equiv="refresh" content="1; url=produk.php" />
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
                    <h2>List produk</h2>
                    <div class="table-responsive  mt-5">
                    <table class ="table">
                        <thead class = "navbar-dark bg-success text-white">
                                <tr>
                                    <th>Nomer</th>
                                    <th>Nama</th>
                                    <th>kategori</th>
                                    <th>stok</th>
                                    <th>Harga</th>
                                </tr>   
                        </thead>
                        <tbody>
                            <?php
                            if($jumlahproduk==0){
                           ?>
                            <tr>
                                <td  colspan=5 class="tekt-center">data tidak ada </td>
                            </tr>
                            <?php
                            }else{
                                $jumlah = 1;
                                while($data=mysqli_fetch_array($queryproduk)){
                                ?>
                                <tr>
                                    <td><?php echo $jumlah;?>.</td>
                                    <td><?php echo $data['nama'];?></td>
                                    <td><?php echo $data['kategori_id'];?></td>
                                    <td><?php echo $data['ketersediaan_stok'];?></td>
                                    <td><?php echo $data['harga'];?></td>
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