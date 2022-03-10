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
  $induk=isset($_GET['induk']) ? $_GET['induk'] : '';
  $btn_tambah=isset($_POST['pertanyaan_tambah']) ? $_POST['pertanyaan_tambah'] : '';
  $btn_ubah=isset($_POST['pertanyaan_ubah']) ? $_POST['pertanyaan_ubah'] : '';
  $btn_hapus=isset($_POST['pertanyaan_hapus']) ? $_POST['pertanyaan_hapus'] : '';
  $btn_opsi=isset($_POST['opsi_tambah']) ? $_POST['opsi_tambah'] : '';
  $btn_opsi_ubah=isset($_POST['opsi_ubah']) ? $_POST['opsi_ubah'] : '';
  $btn_opsi_hapus=isset($_POST['opsi_hapus']) ? $_POST['opsi_hapus'] : '';
  $show="";
  if($btn_tambah){
    print_r($_POST);
    $pertanyaan=mysqli_escape_string($connect, $_POST['pertanyaan']);
    $survey_induk=mysqli_escape_string($connect, $_POST['survey_induk']);
    
    $show=" show";
    $insert=mysqli_query($connect, "insert into survey_pertanyaan (pertanyaan,survey_induk) values('$pertanyaan','$survey_induk')");
    if($insert){
      $error="Data berhasil ditambahkan.";
      $status=1;
    }else{
      $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);
    }
  }
  if($btn_ubah){
    $pertanyaan=mysqli_escape_string($connect, $_POST['pertanyaan']);
    $survey_induk=mysqli_escape_string($connect, $_POST['survey_induk']);
    $urutan=mysqli_escape_string($connect, $_POST['urutan']);
    $show=" show";
    $insert=mysqli_query($connect, "update survey_pertanyaan set pertanyaan='$pertanyaan' where id='$urutan'");
      if($insert){
        $error="Data berhasil diubah.";
        $status=1;
      }else{
        $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);
      }
}
  if($btn_opsi){
    $opsi=mysqli_escape_string($connect, $_POST['opsi']);
    $survey_pertanyaan=mysqli_escape_string($connect, $_POST['survey_pertanyaan']);
    $nilai=mysqli_escape_string($connect, $_POST['nilai']);
    $show=" show";
    $insert=mysqli_query($connect, "insert into survey_opsi (opsi,survey_pertanyaan,nilai) values('$opsi','$survey_pertanyaan','$nilai')");
    if($insert){
      $error="Data berhasil ditambahkan.";
      $status=1;
    }else{
      $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);
    }
  }
    if($btn_opsi_ubah){
        $opsi=mysqli_escape_string($connect, $_POST['opsi']);
        $survey_pertanyaan=mysqli_escape_string($connect, $_POST['survey_pertanyaan']);
        $nilai=mysqli_escape_string($connect, $_POST['nilai']);
        $urutan=mysqli_escape_string($connect, $_POST['urutan']);
        $show=" show";
        $insert=mysqli_query($connect, "update survey_opsi set opsi='$opsi', nilai='$nilai' where id='$urutan'");
          if($insert){
            $error="Data berhasil diubah.";
            $status=1;
          }else{
            $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);
          }
    }
    if ($btn_opsi_hapus){
        $opsi=mysqli_escape_string($connect, $_POST['opsi']);
        $survey_pertanyaan=mysqli_escape_string($connect, $_POST['survey_pertanyaan']);
        $nilai=mysqli_escape_string($connect, $_POST['nilai']);
        $urutan=mysqli_escape_string($connect, $_POST['urutan']);
        $show=" show";
        $insert=mysqli_query($connect, "delete from survey_opsi where id='$urutan'");
          if($insert){
            $error="Data berhasil dihapus.";
            $status=1;
          }else{
            $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);
          }
    }
    if ($btn_hapus){
        $urutan=mysqli_escape_string($connect, $_POST['urutan']);
        $show=" show";
          $del_opsi=mysqli_query($connect, "delete from survey_opsi where survey_pertanyaan='$urutan'");
          $insert=mysqli_query($connect, "delete from survey_pertanyaan where id='$urutan'");
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
        <div class="col-12 row mb-2 justify-content-center"><?php $da=mysqli_query($connect, "select i.judul, k.nama from survey_induk i inner join survey_kategori k on i.kategori_id=k.id where i.id='$induk' limit 1");
        $dat=mysqli_fetch_assoc($da);?>
        <div class="col">
            <p class="h5 text-success"><i class="fa fa-edit"></i> <?php echo $dat['judul'];?></p>
        </div>
        <div class="col  position-relative">
            <span class=" position-absolute end-0  badge rounded-pill bg-primary"><?php echo $dat['nama'];?></span>  
        </div>
        <hr>
        
        </div>
        <div class="card">
            <div class="card-header">
                Tambah Pertanyaan Baru
            </div>
                <div class="card-body" >
                        <div class="row col-12 justify-content-center">
                        <form method="post"  enctype="multipart/form-data">
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-text">Pertanyaan</span>
                                          <textarea class="form-control" aria-label="With textarea" name="pertanyaan"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <input type="hidden" name="survey_induk" value="<?php echo $induk;?>">
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <input type="submit" name="pertanyaan_tambah" class="btn btn-primary btn-sm form-control" value="Tambah Baru">
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
                List Pertanyaan
            </div>
                <div class="card-body" >
                    <?php $lis=mysqli_query($connect, "Select * from survey_pertanyaan where survey_induk='$induk'");
                    $o=0;
                    while($list=mysqli_fetch_array($lis)){
                        $o++;
                        $op=mysqli_query($connect, "Select * from survey_opsi where survey_pertanyaan='$list[id]'");
                        ?>
                  <div class="card mt-2">
                    <div class="card-header">
                      <a href="#slide<?php echo $list['id'];?>" style="text-decoration: none;" class="text-dark" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="slide<?php echo $list['id'];?>">
                        <div class="row col-12 justify-content-center">
                          <div class="col">
                            <b><?php echo $list['pertanyaan'];?></b> 
                          </div>
                          <div class="col position-relative">
                            <span class="position-absolute end-0 badge rounded-pill bg-primary"><?php echo mysqli_num_rows($op);?> Opsi</span>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="card-body collapse" id="slide<?php echo $list['id'];?>">
                        <form method="post"  enctype="multipart/form-data">
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-text">Pertanyaan</span>
                                          <textarea class="form-control" aria-label="With textarea" name="pertanyaan"><?php echo $list['pertanyaan'];?></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <input type="hidden" name="survey_induk" value="<?php echo $induk;?>">
                                    <input type="hidden" name="urutan" value="<?php echo $list['id'];?>">
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <input type="submit" name="pertanyaan_ubah" class="btn btn-info btn-sm form-control" value="Ubah Pertanyaan">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <input type="submit" name="pertanyaan_hapus" class="btn btn-danger btn-sm form-control" value="Hapus Pertanyaan">
                                        </div>
                                      </div>
                                    </div>
                         </form>
                    <?php 
                    $p=0;
                    while($opse=mysqli_fetch_array($op)){
                        $p++;
                        ?>
                     <div class="card mt-2">
                         <div class="card-header">
                            <a href="#opsi<?php echo $opse['id'];?>" style="text-decoration: none;" class="text-dark" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="slide<?php echo $opse['id'];?>">
                                <div class="row col-12 justify-content-center">
                                    <div class="col">
                                        <b>Opsi <?php echo $p;?></b> 
                                    </div>
                                </div>
                            </a>
                         </div>
                         <div class="card-body collapse" id="opsi<?php echo $opse['id'];?>">
                            <form method="post">
                                    <div class="col-12 pt-2">
                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-text">Opsi</span>
                                            <textarea class="form-control" aria-label="With textarea" name="opsi"><?php echo $opse['opsi'];?></textarea>
                                            </div>
                                        </div>
                                        </div>
                                            <div class="col-12 pt-2 pd-2">
                                            <div class="form-group">
                                                <div class="input-group mb-1">
                                                <span class="input-group-text" id="basic-addon1">Nilai</span>
                                                <input type="number" class="form-control" name="nilai" placeholder="1-100" aria-label="Username" aria-describedby="basic-addon1" maxlength="2" value="<?php echo $opse['nilai'];?>">
                                                </div>
                                            </div>
                                            </div>
                                            <input type="hidden" name="survey_pertanyaan" value="<?php echo $list['id'];?>">
                                            <input type="hidden" name="urutan" value="<?php echo $opse['id'];?>">
                                            <div class="col-12 pt-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                <input type="submit" name="opsi_ubah" class="btn btn-warning btn-sm form-control" value="Ubah Opsi">
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-12 pt-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                <input type="submit" name="opsi_hapus" class="btn btn-danger btn-sm form-control" value="Hapus Opsi">
                                                </div>
                                            </div>
                                            </div>
                            </form>
                         </div>
                     </div>
                     <?php };?>
                     <div class="card mt-2">
                         <div class='card-header'>
                            <a href="#opsiBaru" style="text-decoration: none;" class="text-dark" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="opsiBaru">
                                <div class="row col-12 justify-content-center">
                                    <div class="col">
                                        <b>Tambah Opsi Baru</b> 
                                    </div>
                                </div>
                            </a>
                         </div>
                         <div class="card-body collapse" id="opsiBaru">
                            <form method="post">
                                    <div class="col-12 pt-2">
                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-text">Opsi</span>
                                            <textarea class="form-control" aria-label="With textarea" name="opsi"></textarea>
                                            </div>
                                        </div>
                                        </div>
                                            <div class="col-12 pt-2 pd-2">
                                            <div class="form-group">
                                                <div class="input-group mb-1">
                                                <span class="input-group-text" id="basic-addon1">Nilai</span>
                                                <input type="number" class="form-control" name="nilai" placeholder="1-100" aria-label="Username" aria-describedby="basic-addon1" maxlength="2">
                                                </div>
                                            </div>
                                            </div>
                                            <input type="hidden" name="survey_pertanyaan" value="<?php echo $list['id'];?>">
                                            <div class="col-12 pt-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                <input type="submit" name="opsi_tambah" class="btn btn-success btn-sm form-control" value="Tambah Opsi">
                                                </div>
                                            </div>
                                            </div>
                            </form>
                         </div>
                     </div>
                    </div>
                  </div>
                
                <?php
                    }
                    ?>
                </div>
    </div>
  </div>
</div>