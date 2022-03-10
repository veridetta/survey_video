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
        $induk=isset($_GET['induk']) ? $_GET['induk'] : '';
        $judul="Halaman Pelaporan Hasil Survey";
        $su=mysqli_query($connect,"select u.*, i.* from user_survey u inner join survey_induk i on u.survey_induk=i.id where u.survey_induk='$induk'");
        $hitung=mysqli_num_rows($su);
        $kunci=mysqli_escape_string($connect, isset($_POST['kunci']) ? $_POST['kunci'] : '');
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
          <div class="card">
            <div class="card-body">
        <?php 
        $pert=mysqli_query($connect,"select * from survey_pertanyaan where survey_induk='$induk'");
        $no=0;
        while($pertanyaan=mysqli_fetch_array($pert)){
          $no++;
          $op=mysqli_query($connect,"select * from survey_opsi where survey_pertanyaan='$pertanyaan[id]'");
          $pilihan="[";
          $jumlah_opsi=mysqli_num_rows($op);
          $hasil_opsi=array();
          while($opsi=mysqli_fetch_array($op)){
            $pilihan.="'".$opsi['opsi']."',";
            $det=mysqli_query($connect,"select * from detail_survey where survey_opsi='$opsi[id]'");
              $hasil_opsi[]=mysqli_num_rows($det);;
          }
          $dat="[";
          foreach($hasil_opsi as $hasil){
            $dat.=$hasil.",";
          }
          $dat.="]";
          $pilihan.="]";
          ?>
          <p class=><?php echo $no.". ".$pertanyaan['pertanyaan'];?></p>
          <canvas id="myChart<?php echo $pertanyaan['id'];?>" width="400" height="100"></canvas>
          <script>
            const ctx = document.getElementById('myChart<?php echo $pertanyaan['id'];?>').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo $pilihan;?>,
                    datasets: [{
                        label: 'Ringkasan jawaban',
                        data: <?php echo $dat;?>,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
          </script>
          <?php
        }
        ?>
            </div>
          </div>
          </div>
        </div>
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
                         <td class="text-center fw-bold">Nama Siswa</td>
                         <td class="text-center fw-bold">Judul Survey</td>
                         <td class="text-center fw-bold">Bobot Survey</td>
                         <td class="text-center fw-bold">Pelaksanaan</td>
                         <td class="text-center fw-bold">Aksi</td>
                     </tr>
                 </thead>
                 <tbody>

             <?php
             $po=0;
            while($survey=mysqli_fetch_array($su)){
                $bob=mysqli_query($connect, "select d.*, o.* from detail_survey d inner join survey_opsi o on d.survey_opsi=o.id where d.survey_siswa='$survey[identitas]'");
                $nilai=0;
                while($bobot=mysqli_fetch_array($bob)){
                    $nilai+=$bobot['nilai'];
                    
                }
                $po++;
                ?>
                <tr>
                    <td><?php echo $po;?></td>
                    <td><?php echo $survey['nama'];?></td>
                    <td><?php echo $survey['judul'];?></td>
                    <td><?php echo $nilai;?> </td>
                    <td><?php echo $survey['identitas'];?> </td>
                    <td><a href="report-user.php?<?php echo $survey['identitas'];?>" class="btn btn-primary" style="margin-right:2px;"><i class="fa fa-info"> </i> Detail</a></td>
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