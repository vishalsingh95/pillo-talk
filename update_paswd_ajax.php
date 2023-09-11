<?php 
include("admin/config/config.php");
$crt_det_tme=date('Y-m-d h:i:s');
$emnl=$_POST['txt1'];
$pswd=$_POST['txt2'];
$otp=$_POST['txt3'];
$mdf_paswd = md5($pswd);

$clt_dlt="select * from `users` where `email`='$emnl' and `otp`='$otp' ";
$qst_clt_dlt=$db->query($clt_dlt);
$clt_count=mysqli_num_rows($qst_clt_dlt);
if($clt_count==1)
{

$updt_otp="update `users` set `password`='$mdf_paswd',`without_md5_pwd`='$pswd' where `email`='$emnl' and `otp`='$otp'";
$qst_updt_otp=$db->query($updt_otp);
if($qst_updt_otp)
{
echo json_encode(["status"=>"1","response"=>"Password updated successfully"]);
}
else
{
    echo json_encode(["status"=>"0","response"=>"error"]);
}
}
else
{
     echo json_encode(["status"=>"0","response"=>"Please enter valid OTP"]);
}


?>