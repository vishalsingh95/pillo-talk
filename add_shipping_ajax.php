<?php 
include('admin/config/config.php');
if(isset($_SESSION['user_id']))
{
    $user_id=$_SESSION['user_id'];
    
$name=mysqli_real_escape_string($db ,$_POST['name']);
$mobl=mysqli_real_escape_string($db ,$_POST['mobile']);
$landmrk=mysqli_real_escape_string($db ,$_POST['landmark']);
$cty=mysqli_real_escape_string($db ,$_POST['city']);
$adrs=mysqli_real_escape_string($db ,$_POST['address']);
$pncde=mysqli_real_escape_string($db ,$_POST['pincode']);

$dplc_data = "select * from `shipping_address` where `address`='$adrs' and `user_id`='$user_id'";
$qst_dplc_data=$db->query($dplc_data);
$dplc_cnt=mysqli_num_rows($qst_dplc_data);
if($dplc_cnt==0)
{
$ad_shpng_adrs="insert into `shipping_address` set 

`name`='$name',
`mobile`='$mobl',
`landmark`='$landmrk',
`city`='$cty',
`address`='$adrs',
`pincode`='$pncde',
`user_id`='$user_id'";

$qst_ad_shpng_adrs=$db->query($ad_shpng_adrs);
if($qst_ad_shpng_adrs)
{
    echo json_encode(["status"=>"1","response"=>"Shipping address added successfully"]);
    
}
}
else
{
   echo json_encode(["status"=>"0","response"=>"This address is already updated"]); 
}
}
else
{
    echo json_encode(["status"=>'0',"response"=>"Please Login"]);
}
?>