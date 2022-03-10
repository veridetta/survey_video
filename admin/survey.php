<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
<style>
  <?php
  include '../config/connect.php';
    //error_reporting(error_reporting() & ~E_NOTICE);
    session_start();
    if(!$_SESSION){
        header('location:login.php');
    }else
    ?>

  /*POSTT============================ */
  <?php
  $btn_tambah=isset($_POST['survey_tambah']) ? $_POST['survey_tambah'] : '';
  $btn_ubah=isset($_POST['survey_ubah']) ? $_POST['survey_ubah'] : '';
  $btn_hapus=isset($_POST['survey_hapus']) ? $_POST['survey_hapus'] : '';
  $show="";
  if($btn_tambah){
    print_r($_POST);
    $judul=mysqli_escape_string($connect, $_POST['judul']);
    $kate=mysqli_escape_string($connect, $_POST['kategori']);
    $ket=mysqli_escape_string($connect, $_POST['keterangan']);
    $show=" show";
          $target_dir = "upload/";
          date_default_timezone_set('Asia/Jakarta');
          $tanggal=date('d-m-Y-H-i-s');
          $tgl=date('d-m-Y H:i:s');
          $nama_file=$tanggal.basename($_FILES["poto"]["name"]);
          $target_file = $target_dir . $nama_file;
          $nama_tmp_poto= $_FILES['poto']['tmp_name'];
          $nama_poto=$_FILES['poto']['name'];
          $ukuran_poto=$_FILES['poto']['size'];
          $errorz=$_FILES['poto']['error'];
          $poto=$nama_file;
          if($errorz>0){
            $error="Terjadi kesalahan awal saat upload photo, silahkan coba lagi atau ganti dengan yang lain";
        }else{
            if($ukuran_poto>500000){
                $error="Ukuran photo lebih dari 500kb";
            }else{
                if (is_dir($target_dir) && is_writable($target_dir)) {
                    if (move_uploaded_file($nama_tmp_poto, $target_file)) {
                      $insert=mysqli_query($connect, "insert into survey_induk  (judul, ket, gambar, kategori_id) values('$judul','$ket','$poto','$kate')");
                        if($insert){
                            $error="Data berhasil diubah.";
                            $status=1;
                        }else{
                            $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);;
                        }
                    } else {
                        $error="Terjadi kesalahan saat upload photo, silahkan coba lagi atau ganti dengan yang lain";
                    }
                } else {
                    $error='Upload directory is not writable, or does not exist.';
                }
                
            }
        }
    }
    if ($btn_ubah){
      $judul=mysqli_escape_string($connect, $_POST['judul']);
      $kate=mysqli_escape_string($connect, $_POST['kategori']);
      $ket=mysqli_escape_string($connect, $_POST['keterangan']);
        $urutan=mysqli_escape_string($connect, $_POST['urutan']);
        $show=" show";
        
          if($_FILES['poto']['size']<1){
            $insert=mysqli_query($connect, "update survey_induk set judul='$judul', kategori_id='$kate', ket='$ket' where id='$urutan'");
            if($insert){
              $error="Data berhasil diubah.";
              $status=1;
            }else{
              $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);
            }
          }else{
            $target_dir = "upload/";
            date_default_timezone_set('Asia/Jakarta');
            $tanggal=date('d-m-Y-H-i-s');
            $tgl=date('d-m-Y H:i:s');
            $nama_file=$tanggal.basename($_FILES["poto"]["name"]);
            $target_file = $target_dir . $nama_file;
            $nama_tmp_poto= $_FILES['poto']['tmp_name'];
            $nama_poto=$_FILES['poto']['name'];
            $ukuran_poto=$_FILES['poto']['size'];
            $errorz=$_FILES['poto']['error'];
            $poto=$nama_file;
            if($errorz>0){
              $error="Terjadi kesalahan awal saat upload photo, silahkan coba lagi atau ganti dengan yang lain";
            }else{
              if($ukuran_poto>500000){
                  $error="Ukuran photo lebih dari 500kb";
              }else{
                  if (is_dir($target_dir) && is_writable($target_dir)) {
                      if (move_uploaded_file($nama_tmp_poto, $target_file)) {
                        $insert=mysqli_query($connect, "update survey_induk set judul='$judul', kategori_id='$kate', ket='$ket', gambar='$poto' where id='$urutan'");
                          if($insert){
                              $error="Data berhasil diubah.";
                              $status=1;
                          }else{
                              $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);;
                          }
                      } else {
                          $error="Terjadi kesalahan saat upload photo, silahkan coba lagi atau ganti dengan yang lain";
                      }
                  } else {
                      $error='Upload directory is not writable, or does not exist.';
                  }
                  
              }
            }
          }
    }
    if ($btn_hapus){
        $urutan=mysqli_escape_string($connect, $_POST['urutan']);
        $show=" show";
          $pert=mysqli_query($connect, "select * from survey_pertanyaan where survey_induk='$urutan'");
          while($pertanyaan=mysqli_fetch_array($pert)){
            $del_opsi=mysqli_query($connect, "delete from survey_opsi where survey_pertanyaan='$pertanyaan[id]'");
          }
          $del_pert=mysqli_query($connect, "delete from survey_pertanyaan where survey_induk='$urutan'");
          $insert=mysqli_query($connect, "delete from survey_induk where id='$urutan'");
          if($insert){
            $error="Data berhasil dihapus.";
            $status=1;
          }else{
            $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);
          }
    }
    ?>
.modal {
  text-align: center;
}

@media screen and (min-width: 768px) { 
  .modal:before {
    display: inline-block;
    vertical-align: middle;
    content: " ";
    height: 100%;
  }
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary p-2">
  <a class="navbar-brand" href="data.php">Survey</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
    <li class="nav-item">
        <a class="nav-link" href="index.php">Tampilan</a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Survey
          </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item active" href="survey.php"><i class="fa fa-list"></i> List</a></li>
          <li><a class="dropdown-item " href="survey-kategori.php"><i class="fa fa-edit"></i> Kategori</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Video
          </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="video-baru.php"><i class="fa fa-plus"></i> Baru</a></li>
          <li><a class="dropdown-item" href="video.php"><i class="fa fa-list"></i> List</a></li>
          <li><a class="dropdown-item" href="video-kategori.php"><i class="fa fa-edit"></i> Kategori</a></li>
        </ul>
      </li>
      <?php
        error_reporting(error_reporting() & ~E_NOTICE);
        session_start();
        if($_SESSION){
            ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
            <?php
            $remove=isset($_POST['remove']) ? $_POST['remove'] : '';
            if($_SESSION['role']=="admin"){
              if($remove){
                include '../config/connect.php';
                $idremovee=$_POST['idremove'];
                $hapus=mysqli_query($connect, "DELETE from data where id='$idremovee'");
                if($hapus){
                  $error="Hapus data berhasil.";
                  $status=1;
              }else{
                  $error="Terjadi kesalahan saat menghapus data, silahkan coba lagi.".mysqli_error($connect);;
              }
              }
            }
        }else{
          ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <?php
        }
      ?>
    </ul>
  </div>
</nav>
<div class="alert alert-warning alert-dismissible fade <?php echo $show;?>" role="alert">
  <strong>Info!</strong> <?php echo $error;?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="container pt-3 pb-3">
  <div class="row col-12 justify-content-center">
    <div class="col-11 col-lg-11 col-xs-12 col-md-11 col-sm-11 col-xl-11">
        <div class="card">
            <div class="card-header">
                Tambah Survey Baru
            </div>
                <div class="card-body" >
                        <div class="row col-12 justify-content-center">
                        <form method="post"  enctype="multipart/form-data">
                                  <div class="col-12 pt-2 pd-2">
                                      <div class="form-group">
                                        <div class="input-group mb-1">
                                          <span class="input-group-text" id="basic-addon1">Nama Survey</span>
                                          <input type="text" class="form-control" name="judul" placeholder="Judul Survey max 30 char" aria-label="Username" aria-describedby="basic-addon1" maxlength="30">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-text">Keterangan</span>
                                          <textarea class="form-control" aria-label="With textarea" name="keterangan"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-text">Kategori</span>
                                          <select name="kategori" class="form-control">
                                          <?php $kat=mysqli_query($connect,"select * from survey_kategori");
                                          while($kategori=mysqli_fetch_array($kat)){
                                            ?>
                                            <option value="<?php echo $kategori['id'];?>"><?php echo $kategori['nama'];?></option>
                                            <?php
                                          }
                                          ?>
                                          </select>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-12 pt-2">
                                    <span class="badge bg-success ">Cover Survey</span>
                                      <span class="badge bg-warning text-dark">max 500k</span>
                                            <span class="badge bg-info text-dark">ukuran gambar 1200x600 pixel</span>
                                    </div>
                                  <div class="row mt-2">
                                    <div class="col-12 pt-1">
                                        <div class="form-group">
                                          <div class="input-group">
                                            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="poto">
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <input type="submit" name="survey_tambah" class="btn btn-primary btn-sm form-control" value="Tambah Baru">
                                        </div>
                                      </div>
                                    </div>
                         </form>
                    </div>
                </div>
    </div>
  </div>
  
  <div class="col-11 col-lg-11 col-xs-12 col-md-11 col-sm-11 col-xl-11 mt-2">
        <div class="card">
            <div class="card-header">
                List Survey
            </div>
                <div class="card-body" >
                    <?php $lis=mysqli_query($connect, "Select * from survey_induk");
                    $o=0;
                    while($list=mysqli_fetch_array($lis)){
                        $o++;
                        $j_pert=mysqli_query($connect, "select * from survey_pertanyaan where survey_induk='$list[id]'");
                        ?>
                  <div class="card mt-2">
                    <div class="card-header">
                      <a href="#slide<?php echo $list['id'];?>" style="text-decoration: none;" class="text-dark" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="slide<?php echo $list['id'];?>">
                        <div class="row col-12 justify-content-center">
                          <div class="col">
                            <b><?php echo $list['judul'];?></b> 
                          </div>
                          <div class="col position-relative">
                            <span class="position-absolute end-0 badge rounded-pill bg-danger"><?php echo mysqli_num_rows($j_pert);?> Pertanyaan</span>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="card-body collapse" id="slide<?php echo $list['id'];?>">
                      <form method="post">
                      <div class="col-12 pt-2 pd-2">
                                      <div class="form-group">
                                        <div class="input-group mb-1">
                                          <span class="input-group-text" id="basic-addon1">Nama Survey</span>
                                          <input type="text" class="form-control" name="judul" placeholder="Judul Survey max 30 char" aria-label="Username" aria-describedby="basic-addon1" maxlength="30" value="<?php echo $list['judul'];?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-text">Keterangan</span>
                                          <textarea class="form-control" aria-label="With textarea" name="keterangan"><?php echo $list['ket'];?></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-text">Kategori</span>
                                          <select name="kategori" class="form-control">
                                          <?php $kat1=mysqli_query($connect,"select * from survey_kategori where id='$list[kategori_id]'");
                                          while($kategori1=mysqli_fetch_array($kat1)){
                                            ?>
                                            <option value="<?php echo $kategori1['id'];?>"><?php echo $kategori1['nama'];?></option>
                                            <?php
                                          }
                                          ?>
                                          <?php $kat=mysqli_query($connect,"select * from survey_kategori");
                                          while($kategori=mysqli_fetch_array($kat)){
                                            ?>
                                            <option value="<?php echo $kategori['id'];?>"><?php echo $kategori['nama'];?></option>
                                            <?php
                                          }
                                          ?>
                                          </select>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-12 pt-2">
                                    <span class="badge bg-success ">Cover Survey</span>
                                      <span class="badge bg-warning text-dark">max 500k</span>
                                            <span class="badge bg-info text-dark">ukuran gambar 1200x600 pixel</span>
                                    </div>
                                  <div class="row mt-2">
                                    <div class="col-12 pt-1">
                                        <div class="form-group">
                                          <div class="input-group">
                                            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="poto">
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                  <input type="hidden" name="urutan" value="<?php echo $list['id'];?>">
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <input type="submit" name="survey_ubah" class="btn btn-primary btn-sm form-control" value="Ubah Survey">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <input type="submit" name="survey_hapus" class="btn btn-danger btn-sm form-control" value="Hapus Survey">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <a href="pertanyaan.php?induk=<?php echo $list['id'];?>"  class="btn btn-info btn-sm form-control">Lihat Pertanyaan</a>
                                        </div>
                                      </div>
                                    </div>
                      </form>
                    </div>
                  </div>
                
                <?php
                    }
                    ?>
                </div>
    </div>
  </div>
</div>