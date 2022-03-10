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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
  $show="";
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
      <li class="nav-item ">
        <a class="nav-link" href="index.php">Tampilan</a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link  dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Survey
          </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="survey.php"><i class="fa fa-list"></i> List</a></li>
          <li><a class="dropdown-item" href="survey-kategori.php"><i class="fa fa-edit"></i> Kategori</a></li>
        </ul>
      </li>
      <li class="nav-item ">
        <a class="nav-link active" href="report.php">Report</a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Video
          </a>
        <ul class="dropdown-menu">
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
<?php 
        $id=isset($_GET['user']) ? $_GET['user'] : '';
        $use=mysqli_query($connect,"select * from user_survey where identitas='$id'");
        $user=mysqli_fetch_assoc($use);
        $judul="Halaman Pelaporan Hasil Survey <br> Individual ";
        ?>
    <div class="col-12" style="background-image: url(../assets/images/slide.jpg);background-repeat: no-repeat;background-size: cover;">
        <div class="row col-12 m-0 justify-content-center" style="min-height: 280px;background: rgb(0 0 0 / 38%);">
            <div class="my-auto">
                <p class="h3 text-center text-white"><?php echo $judul;?></p>
            </div>
        </div>
    </div>
    <div class="col-12 row m-0 justify-content-center mt-2 mb-2">
        <div class="col-10">
          <div class="col-12 p-3">
            <p class="fw-bold mb-0">Nama Siswa : <?php echo $user['nama'];?>
            <p>Kelas : <?php echo $user['kelas'];?>
          </div>
          <div class="card">
            <div class="card-body">
        <?php 
        $pert=mysqli_query($connect,"select * from survey_pertanyaan where survey_induk='$user[survey_induk]'");
        $no=0;
        while($pertanyaan=mysqli_fetch_array($pert)){
          $no++;
          function cekJ($jawaban, $kunci){
            if($jawaban==$kunci){
              echo " checked";
            }
          }
          $op=mysqli_query($connect,"select * from survey_opsi where survey_pertanyaan='$pertanyaan[id]'");
          $jumlah_opsi=mysqli_num_rows($op);
          $hasil_opsi=array();
          $det=mysqli_query($connect,"select * from detail_survey where survey_pertanyaan='$pertanyaan[id]' and survey_siswa='$id'");
          $detail=mysqli_fetch_assoc($det);
          ?>
           <p class=><?php echo $no.". ".$pertanyaan['pertanyaan'];?></p>
          <?php
          while($opsi=mysqli_fetch_array($op)){
            ?>
            <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pertanyaan<?php echo $pertanyaan['id'];?>" value="<?php echo $opsi['id'];?>" <?php cekJ($detail['survey_opsi'], $opsi['id']);?>>
                                                        <label class="form-check-label"><?php echo $opsi['opsi'];?></label>
                                                    </div>
                                                </div>
            <?php
            
          }
        }
        ?>
            </div>
          </div>
          </div>
        </div>
        </div>