<?php 
include('admin/config/config.php');
if(isset($_SESSION['user_id']))
{
    $user_id=$_SESSION['user_id'];
    
$name=mysqli_real_escape_string($db ,$_POST['edtname']);
$mobl=mysqli_real_escape_string($db ,$_POST['edtmobile']);
$landmrk=mysqli_real_escape_string($db ,$_POST['edtlandmark']);
$cty=mysqli_real_escape_string($db ,$_POST['edtcity']);
$adrs=mysqli_real_escape_string($db ,$_POST['edtaddress']);
$pncde=mysqli_real_escape_string($db ,$_POST['edtpincode']);
$shp_id=mysqli_real_escape_string($db ,$_POST['shp_id']);

$dplc_data = "select * from `shipping_address` where `address`='$adrs' and `user_id`='$user_id'";
$qst_dplc_data=$db->query($dplc_data);
$dplc_cnt=mysqli_num_rows($qst_dplc_data);

$ad_shpng_adrs="update `shipping_address` set 

`name`='$name',
`mobile`='$mobl',
`landmark`='$landmrk',
`city`='$cty',
`address`='$adrs',
`pincode`='$pncde'
 where `id`='$shp_id' and `user_id`='$user_id'";

$qst_ad_shpng_adrs=$db->query($ad_shpng_adrs);
if($qst_ad_shpng_adrs)
{
    echo json_encode(["status"=>"1","response"=>"Shipping address updated successfully"]);
    
}

}
else
{
    echo json_encode(["status"=>'0',"response"=>"Please Login"]);
}
?>