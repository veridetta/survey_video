<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <?php 
        include 'config/connect.php';
        $sli=mysqli_query($connect, "select * from slider ");
        while($slider=mysqli_fetch_array($sli)){
            ?>
             <div class="carousel-item <?php if($slider['id']<2){echo 'active';}?>">
                <img src="<?php echo "admin/upload/".$slider['gambar'];?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $slider['judul'];?></h5>
                    <p><?php echo $slider['ket'];?></p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
    <div class="col-12 row p-2">
        <div class=col-12>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="survey/all.php">Semua Survey</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Survey Terbaru</li>
                </ol>
            </nav>
        </div>
        <?php 
         $su=mysqli_query($connect,"select * from survey_induk limit 6");
         while($survey=mysqli_fetch_array($su)){
            ?>
        <div class="col-lg-4 col-xl-4 col-sm-11 col-xs-11 col-md-6 col-4 mt-3">
            <div class="col-12">
                <div class="card" >
                    <img src="admin/upload/<?php echo $survey['gambar'];?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="survey.php?induk=<?php echo $survey['id'];?>"><h5 class="card-title"><?php echo $survey['judul'];?></h5></a>
                        <p class="card-text"><?php echo $survey['ket'];?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }?>
    </div>
    <div class="col-12 row p-2">
        <div class=col-12>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="video/all.php">Semua Video</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Video Terbaru</li>
                </ol>
            </nav>
        </div>
        <?php 
        $vid=mysqli_query($connect, "select * from video limit 5");
        while($video=mysqli_fetch_array($vid)){
            ?>
        <div class="col-lg-4 col-xl-4 col-sm-11 col-xs-11 col-md-6 col-4 mt-3">
            <div class="col-12">
                <div class="card" >
                    <div class="embed-responsive embed-responsive-16by9 col-12 text-center">
                        <iframe class="embed-responsive-item col-12" style="min-height:200px;" src="<?php echo $video['link'];?>" allowfullscreen></iframe>
                    </div>
                    <div class="card-body">
                        <a href="video.php?link=<?php echo $video['id'];?>"><h5 class="card-title"><?php echo $video['judul'];?></h5></a>
                        <p class="card-text"><?php echo $video['ket'];?></p>
                    </div>
                </div>
                
            </div>
        </div>
        <?php
        }?>
    </div>
</body>
<script>
    $(function(){
    $('.carousel').carousel({
      interval: 2000
        });
    });
</script>
<footer>
    <div class="col-12 p-3 row bg-primary text-white">
        <div class="col">
            <h5>Tentang Kita</h5>
            <small>Kita adalah lembaga survey yang bekerja pada bidangnya menginput data sesuai dengan minat</small>
        </div>
    </div>
</footer>