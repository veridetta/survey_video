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
        $btn_cari=isset($_POST['btn_cari']) ? $_POST['btn_cari'] : '';
        $judul="Halaman Pelaporan Hasil Survey";
        $su=mysqli_query($connect,"select i.*, k.* from survey_induk i inner join survey_kategori k on i.kategori_id=k.id ");
        $kunci=mysqli_escape_string($connect, isset($_POST['kunci']) ? $_POST['kunci'] : '');
        if($btn_cari){
            $kategori=mysqli_escape_string($connect, $_POST['kategori']);
            if($kategori=='all'){
                $judul="Menampilkan hasil pencarian ".$kunci;
                $su=mysqli_query($connect,"select * from survey_induk where judul like '%$kunci%'");
            }else{
                $judul="Menampilkan hasil pencarian ".$kunci;
                $su=mysqli_query($connect,"select * from survey_induk where kategori_id='$kategori' and judul like '%$kunci%'");
            }
        }
        $hitung=mysqli_num_rows($su);
        ?>
    <div class="col-12" style="background-image: url(../assets/images/slide.jpg);background-repeat: no-repeat;background-size: cover;">
        <div class="row col-12 m-0 justify-content-center" style="min-height: 280px;background: rgb(0 0 0 / 38%);">
            <div class="my-auto">
                <p class="h3 text-center text-white"><?php echo $judul;?></p>
            </div>
        </div>
    </div>
    <div class="col-12 row m-0 justify-content-center mt-2 mb-2">
        <div class="col-12">
            <form method="post">
                <div class="col-12 pt-2">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">Kata Kunci</span>
                            <input type="text" name="kunci" class="form-control" value="<?php echo $kunci;?>">
                        </div>
                    </div>
                </div>
                <div class="col-12 pt-2">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">Kategori</span>
                            <select name="kategori" class="form-control">
                                <option value="all">Semua</option>
                                <?php $ka=mysqli_query($connect, "select * from survey_kategori order by nama");
                                while($kategori=mysqli_fetch_array($ka)){
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
                    <div class="form-group">
                        <div class="input-group">
                            <input type="submit" name="btn_cari" class="form-control btn btn-info btn-block" value="Mulai Pencarian">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php 
         if($hitung<1){
             ?>
            <div class="col-12 mt-4 row justify-content-center" style="min-height:300px;background:#f4f4f4;">
                <div class="my-auto">
                    <p clas="h2 text-dark"><i class="fa fa-find"></i></p>
                    <p class="h5 text-dark text-center">Tidak ada hasil yang ditemukan</p>
                </div>
            </div>
             <?php
         }else{
             ?>
             <div class="row justify-content-center p-3 col-12">
                 <div class="col-12">

                
             <table class="table table-bordered table-responsive">
                 <thead>
                     <tr>
                         <td class="text-center fw-bold">No</td>
                         <td class="text-center fw-bold">Judul</td>
                         <td class="text-center fw-bold">Kategori</td>
                         <td class="text-center fw-bold">Peserta</td>
                         <td class="text-center fw-bold">Aksi</td>
                     </tr>
                 </thead>
                 <tbody>

             <?php
             $po=0;
            while($survey=mysqli_fetch_array($su)){
                $pes=mysqli_query($connect, "select * from user_survey where survey_induk='$survey[id]'");
                $po++;
                ?>
                <tr>
                    <td><?php echo $po;?></td>
                    <td><?php echo $survey['judul'];?></td>
                    <td><?php echo $survey['nama'];?></td>
                    <td><?php echo mysqli_num_rows($pes);?> Peserta</td>
                    <td><a href="report-user.php?induk=<?php echo  $survey['id'];?>" class="btn btn-primary" style="margin-right:2px;"><i class="fa fa-user"> </i></a><a href="report-detail.php?induk=<?php echo  $survey['id'];?>" class="btn btn-success"><i class="fa fa-file"> </i></a></td>
                </tr>
            <?php
            }?>
             </tbody>
             </table>
             </div>
             </div>
        </div>
        <?php
         }
         ?>