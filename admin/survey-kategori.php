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
  $btn_tambah=isset($_POST['kategori_tambah']) ? $_POST['kategori_tambah'] : '';
  $btn_ubah=isset($_POST['kategori_ubah']) ? $_POST['kategori_ubah'] : '';
  $btn_hapus=isset($_POST['kategori_hapus']) ? $_POST['kategori_hapus'] : '';
  $show="";
  if($btn_tambah){
        $nama=mysqli_escape_string($connect, $_POST['nama']);
        $show=" show";
        $insert=mysqli_query($connect, "insert into survey_kategori (nama) values('$nama')");
          if($insert){
            $error="Data berhasil ditambahkan.";
            $status=1;
          }else{
            $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);
          }
    }
    if ($btn_ubah){
        $nama=mysqli_escape_string($connect, $_POST['nama']);
        $urutan=mysqli_escape_string($connect, $_POST['urutan']);
        $show=" show";
        $insert=mysqli_query($connect, "update survey_kategori set nama='$nama' where id='$urutan'");
          if($insert){
            $error="Data berhasil diubah.";
            $status=1;
          }else{
            $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);
          }
    }
    if ($btn_hapus){
        $urutan=mysqli_escape_string($connect, $_POST['urutan']);
        $show=" show";
        $insert=mysqli_query($connect, "delete from survey_kategori where id='$urutan'");
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
          <li><a class="dropdown-item" href="survey.php"><i class="fa fa-list"></i> List</a></li>
          <li><a class="dropdown-item active" href="survey-kategori.php"><i class="fa fa-edit"></i> Kategori</a></li>
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
                Tambah Kategori Baru
            </div>
                <div class="card-body" >
                        <div class="row col-12 justify-content-center">
                        <form method="post">
                        <div class="col-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group mb-1">
                                          <span class="input-group-text" id="basic-addon1">Nama Kategori</span>
                                          <input type="text" class="form-control" name="nama" placeholder="Nama kategori max 30 char" aria-label="Username" aria-describedby="basic-addon1" maxlength="30">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-12">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <input type="submit" name="kategori_tambah" class="btn btn-primary btn-sm form-control" value="Tambah Kategori">
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
                List Kategori Survey
            </div>
                <div class="card-body" >
                    <?php $lis=mysqli_query($connect, "Select * from survey_kategori");
                    $o=0;
                    while($list=mysqli_fetch_array($lis)){
                        $o++;
                        ?>
                <form method="post">
                        <div class="row col-12 justify-content-center">
                        <div class="col-xl-8 col-lg-8 col-sm-12 col-md-12 pt-2">
                                      <div class="form-group">
                                        <div class="input-group mb-1">
                                          <span class="input-group-text" id="basic-addon1"><?php echo $o;?>. </span>
                                          <input type="text" class="form-control" name="nama" placeholder="Judul Survey max 30 char" aria-label="Username" aria-describedby="basic-addon1" maxlength="30" value="<?php echo $list['nama'];?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-6 col-md-6 pt-2">
                                      <div class="form-group">
                                        <div class="input-group mb-1">
                                          <input type="submit" name="kategori_ubah" class="btn btn-success btn-sm form-control" value="Ubah">
                                        </div>
                                      </div>
                                    </div>
                                    <input type="hidden" value="<?php echo $list['id'];?>" name="urutan">
                                    <div class="col-xl-2 col-lg-2 col-sm-6 col-md-6 pt-2">
                                      <div class="form-group">
                                        <div class="input-group mb-1">
                                          <input type="submit" name="kategori_hapus" class="btn btn-danger btn-sm form-control" value="Hapus">
                                        </div>
                                      </div>
                                    </div>
                    </div>
                </form>
                <?php
                    }
                    ?>
                </div>
    </div>
  </div>
</div>