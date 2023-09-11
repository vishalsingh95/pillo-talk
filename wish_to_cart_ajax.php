<?php 
include("admin/config/config.php");

if(isset($_SESSION['user_id']))
{
$usr_id=$_SESSION['user_id'];

$prdt_id=$_POST['txt1'];
$wishlst_id=$_POST['txt2'];

$clt_cart_dplc="select * from `cart` where `product_id`='$prdt_id' and `user_id`='$usr_id'";
$qst_clt_cart_dplc=$db->query($clt_cart_dplc);
$cart_count=mysqli_num_rows($qst_clt_cart_dplc);
if($cart_count==0)
{

$cart_add="insert into `cart` set
product_id='$prdt_id',
user_id='$usr_id',
quantity='1'";
$qst_cart_add=$db->query($cart_add);
if($qst_cart_add)
{
$dlt_wshlst="delete from `wishlist` where `user_id`='$usr_id' and `id`='$wishlst_id'";
$qst_dlt_wshlst=$db->query($dlt_wshlst);
if($qst_dlt_wshlst)
{
echo json_encode(["status"=>'1',"response"=>"Add to cart successfully"]);
}
}
}
else
{
echo json_encode(["status"=>'0',"response"=>"This product is already in your cart"]);
}
}
else
{
 echo json_encode(["status"=>'0',"response"=>"Please Login"]);   
}

?>