<?php 
include('admin/config/config.php');

if(isset($_SESSION['user_id']))
{
$usr_id=$_SESSION['user_id'];
$cart_id=$_POST['txt1'];

$clt_crt_Dtl="select * from `cart` where `id`='$cart_id' and `user_id`='$usr_id' ";
$qst_clt_crt_Dtl=$db->query($clt_crt_Dtl);
$clct_clt_crt_Dtl=$qst_clt_crt_Dtl->fetch_assoc();

$qnty=$clct_clt_crt_Dtl['quantity'];


$updt_qty=$qnty+1;

$updt_crt="update `cart` set 
`quantity`='$updt_qty' where `user_id`='$usr_id' and `id`='$cart_id'";

$qst_updt_crt=$db->query($updt_crt);
if($qst_updt_crt)
{
    echo json_encode(["status"=>'1',"response"=>"Updated successfully"]);
    
}

}

else
{
    echo json_encode(["status"=>'0',"response"=>"Please login"]);
}


?>