<?php 
include('config/config.php');

$prdt_id=$_GET['id'];

$dlt_prdt="delete from `products` where `id`='$prdt_id'";
$qst_dlt_prdt=$db->query($dlt_prdt);
if($qst_dlt_prdt)
{
    echo "<script>window.alert('Product deleted successfully');window.location='view_product.php';</script>";
}
?>