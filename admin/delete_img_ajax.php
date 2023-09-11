<?php 
include('config/config.php');
$array_index=$_POST['txt1'];
$product_id=$_POST['txt2'];


$clt_prdt = "SELECT * FROM `products` where `id`='$product_id'";
$qst_clt_prdt=$db->query($clt_prdt);
$clct_clt_prdt=$qst_clt_prdt->fetch_assoc();

$predt_img=$clct_clt_prdt['product_image'];

$expld_img=explode(", ",$predt_img);

$img_ar_count=count($expld_img);

unset($expld_img[$array_index]);

$all_images = implode(", ",$expld_img);

$updt_product_img="update `products` set `product_image`='$all_images' where `id`='$product_id'";
$qst_updt_product_img=$db->query($updt_product_img);
if($qst_updt_product_img)
{
  echo "success";  
}
?>