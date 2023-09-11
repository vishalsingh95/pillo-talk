<?php 
include("config/config.php");

if(isset($_SESSION['a_email']))
{
    $ad_id=$_SESSION['a_email'];
    $order_status=$_POST['txt1'];
    $order_product_id=$_POST['txt2'];
    $order_id=$_POST['txt3'];

$upd_prd_sts="update `orders` set `status`='$order_status' where `id`='$order_product_id' and `order_id`='$order_id'";
$qst_upd_prd_sts=$db->query($upd_prd_sts);
    if($qst_upd_prd_sts)
    {
        echo json_encode(["status"=>1,"repsonse"=>"Order status updated successfully"]);
    }
}
else
{
    echo json_encode(["status"=>0,"response"=>"Please Login"]);
}

?>