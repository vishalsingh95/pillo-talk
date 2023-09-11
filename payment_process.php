<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
include('admin/config/config.php');


$date_time=date('Y-m-d H:i:s');
$year=date('Y');
$month = date('m');
$dete=date('d');

$mrege=$year.$month.$dete;
    $usr_id=$_SESSION['user_id'];
$adrds_id=$_POST['address_id'];
$pymt_mthd=$_POST['payment_method'];

$clt_cart_dtl="select `products`.`product_name`,`products`.`price` ,`products`.`product_image`,`cart`.`id` as `cart_id`,`cart`.`quantity`,`products`.`id` as `product_id` from `cart` left join  `products` ON  `cart`.`product_id`=`products`.`id` where `cart`.`user_id`='$usr_id'";


$qst_clt_cart_dtl=$db->query($clt_cart_dtl);
$cart_count=mysqli_num_rows($qst_clt_cart_dtl);

if(isset($_POST['amt']) && isset($_POST['name'])){
    


    
    $amt=$_POST['amt'];
    $name=$_POST['name'];
    $payment_status="pending";
    $added_on=date('Y-m-d h:i:s');
    mysqli_query($db,"insert into payment(name,amount,payment_status,added_on) values('$name','$amt','$payment_status','$added_on')");
    $_SESSION['OID']=mysqli_insert_id($db);
}

if($cart_count > 0)
{

$ord_id="VLBH".$mrege.rand(99999,999999999999);
if($adrds_id!='' and $pymt_mthd!='')
{
if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
    $payment_id=$_POST['payment_id'];
  $queyr=  mysqli_query($db,"update payment set payment_status='complete',payment_id='$payment_id',order_id='$ord_id' where id='".$_SESSION['OID']."'");
  
  if($queyr)
  {
      //my code start
$clt_shp_adrs="select * from `shipping_address` where `user_id`='$usr_id' and `id`='$adrds_id'";
$qst_clt_shp_adrs=$db->query($clt_shp_adrs);
$clt_count=mysqli_num_rows($qst_clt_shp_adrs);
if($clt_count > 0)
{
//shipping address fetch_start 
$clct_clt_shp_adrs=$qst_clt_shp_adrs->fetch_assoc();
$neeme=mysqli_real_escape_string($db , $clct_clt_shp_adrs['name']);
$mobile=mysqli_real_escape_string($db , $clct_clt_shp_adrs['mobile']);
$lndmrk=mysqli_real_escape_string($db , $clct_clt_shp_adrs['landmark']);
$cety=mysqli_real_escape_string($db , $clct_clt_shp_adrs['city']);
$adrss=mysqli_real_escape_string($db , $clct_clt_shp_adrs['address']);
$pncde=mysqli_real_escape_string($db , $clct_clt_shp_adrs['pincode']);

//shipping address fetch_end

//fetch_user_cart_details_start
while($clct_crt_Dtl=$qst_clt_cart_dtl->fetch_assoc())
{
$prdt_cart_neme=mysqli_real_escape_string($db , $clct_crt_Dtl['product_name']);
$prdt_cart_price=mysqli_real_escape_string($db , $clct_crt_Dtl['price']);
$prdt_cart_qty=mysqli_real_escape_string($db , $clct_crt_Dtl['quantity']);
$prdt_cart_image=mysqli_real_escape_string($db , $clct_crt_Dtl['product_image']);
$prdt_cart_id=mysqli_real_escape_string($db , $clct_crt_Dtl['product_id']);
$cartt_iid=$clct_crt_Dtl['cart_id'];

$prdt_ttl_price=$prdt_cart_price*$prdt_cart_qty;
$prdt_total +=$prdt_ttl_price;
$prdt_cart_img_expld=explode(", ",$prdt_cart_image);
$prdt_frst_img=$prdt_cart_img_expld[0];


$make_order="insert into `orders` set
`user_id`='$usr_id',
`product_id`='$prdt_cart_id',
`product_name`='$prdt_cart_neme',
`product_image`='$prdt_cart_image',
`price`='$prdt_cart_price',
`quantity`='$prdt_cart_qty',
`order_id`='$ord_id',
`status`='Ordered'";

$qst_make_order=$db->query($make_order);


}
//fetch_user_cart_details_end
if($qst_make_order)
{
$dlt_crt_prdts="delete from `cart` where `user_id`='$usr_id'";
$qst_dlt_crt_prdts=$db->query($dlt_crt_prdts);
if($qst_dlt_crt_prdts)
{
$ad_shpng_addrs="insert into `address_of_orders` set 
`user_id`='$usr_id',
`order_id`='$ord_id',
`name`='$neeme',
`mobile`='$mobile',
`landmark`='$lndmrk',
`city`='$cety',
`address`='$adrss',
`shipping_address_id`='$adrds_id',
`order_date`='$date_time',
`order_total_amount`='$prdt_total',
`payment_type`='$pymt_mthd',
`pincode`='$pncde'";
$qst_ad_shpng_addrs=$db->query($ad_shpng_addrs);
if($qst_ad_shpng_addrs)
{
echo json_encode(["status"=>"1","response"=>"Order placed successfully","order_id"=>"$ord_id"]);
}

}
}
}      
      //my code end
  }
  
  
}
}
    
}
?>