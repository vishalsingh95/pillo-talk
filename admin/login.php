<?php
@ob_start();
require_once 'config/config.php';
// $action = $_POST['submit'];
if (isset($_SESSION['ibc'])) {
header("location: index.php");
}
if (isset($_POST['admin_login'])) {
$a_email = $_POST['a_email'];
$a_password = md5($_POST['a_password']);
$results = $db->query("SELECT * FROM `admin` WHERE a_email='$a_email' AND a_password='$a_password'");
$row_select = $results->fetch_object();
$a_name = $row_select->a_name;
$a_email = $row_select->a_email;




$whois = $a_name;
// if ($a_name == 'Admin') {
//     $a_name = 'You have';
// } else {
//     $a_name = $a_name . ' has';
// }
$num_rows = $results->num_rows; //mysqli_num_rows($results);
if ($num_rows > 0) {
session_start();
$sid = session_id();
$_SESSION['ibc'] = $sid;
$_SESSION['logintype'] = $row_select->a_name; // set user type
$_SESSION['a_id'] = $row_select->a_id;
$_SESSION['a_email'] = $row_select->a_email;
$_SESSION['a_name'] = $row_select->a_name;
$db->close();
header("Location:index.php");
exit;
} 
else
{
echo "<script>window.alert('Wrong credentials please try again.');window.location='login.php';</script>";
// header("Location:login.php");
exit;
}
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">


<style>
    
    .auth-one-bg-position {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 380px;
}

.auth-one-bg {
   background-position: center;
    background-size: cover;
    background-image: radial-gradient(rgba(0, 0, 0, 0) 0%, rgb(25 75 255 / 17%) 100%), radial-gradient(rgba(0, 0, 0, 0) 33%, rgb(9 87 255 / 47%) 166%);
}

#video-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
}

#video-container video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.auth-one-bg .bg-overlay {
    background: linear-gradient(to right, rgb(99 41 255 / 6%), rgb(120 247 40 / 18%));
    opacity: 0.9;
}

.bg-overlay {
    position: absolute;
    height: 100%;
    width: 100%;
    right: 0;
    bottom: 0;
    left: 0;
    top: 0;
    opacity: 0.7;
    background-color: #000;
}

.auth-one-bg .shape {
    position: absolute;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 1;
    pointer-events: none;
}

.auth-one-bg .shape > svg {
    width: 100%;
    height: auto;
    fill: #ecf0fa;
}

.particles-js-canvas-el {
    position: relative;
}

.auth-page-wrapper .auth-page-content {
    /*padding-bottom: 60px;*/
    position: relative;
    z-index: 2;
    width: 100%;
}

.login-bg {
    background-color: rgb(255 255 255 / 75%);
    backdrop-filter: saturate(180%) blur(3px);
    border: 2px solid rgb(0 246 253 / 0%);
    box-shadow: rgb(0 0 0 / 10%) 0px 10px 15px -3px, rgb(0 0 0 / 5%) 0px 4px 6px -2px;
}

.card-body {
    box-shadow: rgb(0 0 0 / 45%) 0px 25px 20px -20px;
}

.form-label {
    font-size: 17px;
    font-family: calibri;
}

body {
    background: #ecf0fa !important;
}


</style>

<div class="auth-page-wrapper pt-5">
    <!-- page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div id="video-container">
            <video autoplay="" loop="" muted="">
                <source src="login_video/back.mp4" type="video/mp4" />
            </video>
        </div>

        <div class="bg-overlay"></div>
        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
        <canvas class="particles-js-canvas-el" width="1349" height="380" style="width: 100%; height: 100%;"></canvas>
    </div>

    <!-- page content -->
    <div class="auth-page-content"><form action="" method="POST">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-5 login-bg">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="d-inline-block auth-logo">
                                    <img src="login_video/advtr.svg" alt="JSLPS image" height="80" />
                                </div>
                                <h3 class="text-dark mt-3">Admin Login</h3>
                            </div>

                            <div class="p-2 mt-3">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input name="a_email" type="text" id="txtusername" class="form-control" placeholder="Enter username" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password-input">Password</label>
                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                        <input name="a_password" type="password" id="txtpassword" class="form-control pe-5 password-input" placeholder="Enter password" />
                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                    </div>
                                </div>

                               

                                <div class="mt-4">
                                    <input type="submit"  name="admin_login" value="Login" id="btnlogin" class="btn btn-primary w-100" />
                                </div>
                            </div>
                        </div>
                        <!-- card body -->
                    </div>
                    <!-- card -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </form></div>
    <!-- end page content -->
</div>
