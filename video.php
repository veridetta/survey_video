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
    <?php 
        include 'config/connect.php';
        $link=isset($_GET['link']) ? $_GET['link'] : '';
        $vid=mysqli_query($connect,"select * from video where id='$link'");
        $show="";
        $video=mysqli_fetch_assoc($vid);
        if($link==''){
            header('location:index.php');
        }
        ?>
    <div class="col-12" style="background-image: url(assets/images/slide.jpg);background-repeat: no-repeat;background-size: cover;">
        <div class="row col-12 m-0 justify-content-center" style="min-height: 100vh;background: rgb(0 0 0 / 38%);">
            <div class="my-auto col-sm-11 col-lg-8 col-xl-8 col-md-10 col-xs-11">
                <div class="col-12 p-4">
                    <div class='card'>
                        <div class="card-body">
                            <div class=col-12>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item" aria-current="page"><?php echo $video['judul'];?></li>
                                    </ol>
                                </nav>
                            </div> 
                            <div class="embed-responsive embed-responsive-16by9 col-12 text-center">
                                <iframe class="embed-responsive-item col-12" style="min-height:400px;" src="<?php echo $video['link'];?>" allowfullscreen></iframe>
                            </div>
                            <div class="card-body">
                                <a href="<?php echo $video['link'];?>"><h5 class="card-title"><?php echo $video['judul'];?></h5></a>
                                <p class="card-text"><?php echo $video['ket'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 p-3 row m-0 bg-primary text-white">
        <div class="col">
            <h5>Tentang Kita</h5>
            <small>Kita adalah lembaga survey yang bekerja pada bidangnya menginput data sesuai dengan minat</small>
        </div>
    </div>