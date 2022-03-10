<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
</head>
<body>
<?php
error_reporting(error_reporting() & ~E_NOTICE);
$error="";
    session_start();
    if($_SESSION){
        header('location:index.php');
    }
    if($_POST){
        include '../config/connect.php';
        $username=$_POST['email'];
        $password=$_POST['password'];
        $cek=mysqli_query($connect,"select * from users where email='$username' and password='$password'");
        $status="alert-success";
        if(mysqli_num_rows($cek)>0){
          while($data=mysqli_fetch_array($cek)){
            if($data['status']>0){
              $dat=mysqli_fetch_assoc($cek);
              session_start();
              $_SESSION['status']="login";
              $_SESSION['id']=$data['id'];
              $_SESSION['role']=$data['role'];
              $_SESSION['nama']=$data['nama'];
              $error="Login berhasil, kamu akan dialihkan";
              header( "refresh:3; url=index.php" ); 
            }else{
                $status="alert-danger";
              $error="Akun kamu masih dalam peninjauan oleh admin";
            }
          }
            ?>
            <?php
        }else{
            $status="alert-danger";
            $error="Silahkan periksa kembali data login anda.";
        }
    }?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary p-2">
  <a class="navbar-brand" href="login.php">Survey</a>
</nav>
<div class="alert <?php echo $status;?> alert-dismissible fade" role="alert">
    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
  <strong>Warning..! </strong> <?php echo $error;?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<div class="container" style="padding-top:25px; padding-bottom:25px;">
  <div class="col-12 row justify-content-center " style="min-height:10vh">
    <div class="col-xl-5 col-md-8 col-lg-5 col-xs-11 col-11 my-auto">
      <div class="card">
        <div class="card-header">
          Login
        </div>
        <div class="card-body">
          <form method="post" id="form_login" action="login.php">
            <div class="col-12">
              <div class="form-group mb-2">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                  <input placeholder="Email" type="text" id="email" name="email" class="form-control">
                </div>
              </div>
              <div class="form-group mb-2">
                <div class="input-group">
                <span class="input-group-text"><i class="fa fa-key"></i></span>
                  <input  placeholder="Password" type="password" id="password" name ="password" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input  type="submit" name="login_sumbit" value="Login" id="login_btn" class="btn btn-primary form-control">
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="card-footer">
            <div class="col-12 text-center">
              <small>Hanya admin yang bisa masuk</small>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready( function() {
    <?php if($_POST){
        echo "$('.alert').addClass('show');";
    }else{
       echo  "var kosong='kosong';";
    }?>
})
</script>