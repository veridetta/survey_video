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
        $induk=isset($_GET['induk']) ? $_GET['induk'] : '';
        $su=mysqli_query($connect,"select * from survey_induk where id='$induk'");
        $survey=mysqli_fetch_assoc($su);
        $show="";
        if($induk==''){
            header('location:index.php');
        }
        $per=mysqli_query($connect, "select * from survey_pertanyaan where survey_induk='$induk'");
        $pert=mysqli_query($connect, "select * from survey_pertanyaan where survey_induk='$induk'");

        $selesai=isset($_POST['btn_selesai']) ? $_POST['btn_selesai'] : '';
        if($selesai){
            //input peserta
            $show=" show";
            date_default_timezone_set('Asia/Jakarta');
            $identitas=date('d-m-Y-H-i-s');
            $nama=mysqli_escape_string($connect, $_POST['nama']);
            $kelas=mysqli_escape_string($connect, $_POST['kelas']);
            $survey_induk=mysqli_escape_string($connect, $_POST['survey_induk']);
            $jumlah_soal=mysqli_escape_string($connect, $_POST['jumlah_soal']);
            $so=mysqli_query($connect,"select * from survey_pertanyaan where survey_induk='$induk'");
            $iden=mysqli_query($connect,"insert into user_survey (nama, kelas, survey_induk, tanggal, identitas) values ('$nama','$kelas','$survey_induk','$identitas','$identitas')");
            while($soal=mysqli_fetch_array($so)){
                $soal_id=$soal['id'];
                $ambil="pertanyaan".$soal['id'];
                $survey_opsi=mysqli_escape_string($connect, $_POST[$ambil]);
                $insert=mysqli_query($connect, "insert into detail_survey (survey_pertanyaan, survey_opsi, survey_siswa, survey_induk) values('$soal_id','$survey_opsi','$identitas','$survey_induk')");
                echo mysqli_error($connect);
            }
            if($iden){
                $error="Data berhasil dikirim. Kamu akan dialihkan ke menu utama";
                header( "refresh:3; url=index.php" ); 
                $status=1;
            }else{
                $error="Terjadi kesalahan saat menginput data, silahkan coba lagi.".mysqli_error($connect);
            }
        }
        ?>
    <div class="col-12" style="background-image: url(assets/images/slide.jpg);background-repeat: no-repeat;background-size: cover;">
        <div class="row col-12 m-0 justify-content-center" style="min-height: 100vh;background: rgb(0 0 0 / 38%);">
            <div class="my-auto col-sm-11 col-lg-6 col-xl-6 col-md-8 col-xs-11">
                <div class="col-12 p-3">
                    <div class="alert alert-success alert-dismissible fade <?php echo $show;?>" role="alert">
                    <strong>Info!</strong> <?php echo $error;?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class='card'>
                        <div class="card-body">
                            <div class=col-12>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item" aria-current="page"><?php echo $survey['judul'];?></li>
                                    </ol>
                                </nav>
                            </div> 
                            <form method="post">
                                <input type="hidden" name="jumlah_soal" value="<?php echo mysqli_num_rows($per);?>">
                                <input type="hidden" name="survey_induk" value="<?php echo $induk;?>">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="identitas-tab" data-bs-toggle="tab" data-bs-target="#identitas" type="button" role="tab" aria-controls="identitas" aria-selected="true">Identitas</button>
                                    </li>
                                    <?php
                                    $p=0; 
                                    while($nav=mysqli_fetch_array($per)){
                                        $p++;
                                        ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="survey<?php echo $p;?>-tab" data-bs-toggle="tab" data-bs-target="#survey<?php echo $p;?>" type="button" role="tab" aria-controls="survey<?php echo $p;?>" aria-selected="false"><?php echo $p;?></button>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="finish-tab" data-bs-toggle="tab" data-bs-target="#finish" type="button" role="tab" aria-controls="finish" aria-selected="false">Selesai</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <!--IDENTITAS-->
                                    <div class="tab-pane fade show active" id="identitas" role="tabpanel" aria-labelledby="pills-identitas-tab">
                                        <div class="col-12 pt-2">
                                            <p>Silahkan isi identitas terlebih dahulu, sebelum melanjutkan ke tahap berikutnya.</p>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-text">Nama</span>
                                                    <input type="text" name="nama" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-text">Kelas</span>
                                                    <input type="text" name="kelas" class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $q=0; 
                                    while($pertanyaan=mysqli_fetch_array($pert)){
                                        $ops=mysqli_query($connect,"select * from survey_opsi where survey_pertanyaan='$pertanyaan[id]'");
                                        $q++;
                                        ?>
                                        <div class="tab-pane fade" id="survey<?php echo $q;?>" role="tabpanel" aria-labelledby="survey<?php echo $q;?>-tab">
                                            <div class="col-12 pt-2">
                                                <p><b>Pertanyaan nomor <?php echo $q;?></b></p>
                                                <p><?php echo $pertanyaan['pertanyaan'];?></p>
                                                <?php
                                                while($opsi=mysqli_fetch_array($ops)){
                                                    ?>
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pertanyaan<?php echo $pertanyaan['id'];?>" value="<?php echo $opsi['id'];?>">
                                                        <label class="form-check-label"><?php echo $opsi['opsi'];?></label>
                                                    </div>
                                                </div>
                                                <?php
                                                }?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="tab-pane fade" id="finish" role="tabpanel" aria-labelledby="finish-tab">
                                        <div class="col-12 pt-2">
                                            <p>Pastikan kamu sudah mengisi semua survey ini, silahkan lakukan pengecekan ulang kembali, namun jika sudah yakin, silahkan klik selesai untuk menyelesaikan survey ini. Terimakasih</p>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="submit" name="btn_selesai" class="form-control btn btn-info btn-block" value="Kirim Jawaban">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </form>
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