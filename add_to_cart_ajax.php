<?php 
include("admin/config/config.php");

if(isset($_SESSION['user_id']))
{
$usr_id=$_SESSION['user_id'];
$prdt_id=$_POST['txt1'];
$prdt_qty = $_POST['txt2'];
if($prdt_qty=='')
{
$pro_qty=1;
}
else
{
  $pro_qty =$prdt_qty;
}

$clt_cart_check = "select count(id) as `cart_count` from `cart` where `product_id`='$prdt_id' and `user_id`='$usr_id'";

$qst_clt_cart_check=$db->query($clt_cart_check);
$clct_clt_cart_check=$qst_clt_cart_check->fetch_assoc();

$crt_count= $clct_clt_cart_check['cart_count'];
if($crt_count==0)
{
$add_cart="insert into `cart` set
product_id='$prdt_id',
user_id='$usr_id',
quantity='$pro_qty'";
$qst_add_cart=$db->query($add_cart);

if($qst_add_cart)
{
    echo json_encode(["status"=>'1',"response"=>"Add to cart successfully"]);
}
}
else
{
    echo json_encode(["status"=>'0',"response"=>"This product is already in your cart."]);
}
}
else
{
    echo json_encode(['status'=>'0',"response"=>"Please Login"]);
    
}

?>