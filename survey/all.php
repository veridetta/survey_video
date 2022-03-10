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
        include '../config/connect.php';
        $btn_cari=isset($_POST['btn_cari']) ? $_POST['btn_cari'] : '';
        $judul="Menampilkan semua survey";
        $su=mysqli_query($connect,"select * from survey_induk ");
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
    <div class="col-12 row m-0 justify-content-center">
        <div class=col-12>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><?php echo $judul;?></li>
                </ol>
            </nav>
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
            while($survey=mysqli_fetch_array($su)){
                ?>
            <div class="col-lg-3 col-xl-3 col-sm-11 col-xs-11 col-md-4 col-3 mt-3">
                <div class="col-12">
                    <div class="card" >
                        <img src="../admin/upload/<?php echo $survey['gambar'];?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="../survey.php?induk=<?php echo $survey['id'];?>"><h5 class="card-title"><?php echo $survey['judul'];?></h5></a>
                            <p class="card-text"><?php echo $survey['ket'];?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }?>
        </div>
        <?php
         }
         ?>
         
    <div class="col-12 p-3 row m-0 bg-primary text-white mt-3">
        <div class="col">
            <h5>Tentang Kita</h5>
            <small>Kita adalah lembaga survey yang bekerja pada bidangnya menginput data sesuai dengan minat</small>
        </div>
    </div>