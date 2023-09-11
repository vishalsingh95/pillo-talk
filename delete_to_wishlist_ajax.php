<?php 
include('admin/config/config.php');
if(isset($_SESSION['user_id']))
{
 $usr_id=$_SESSION['user_id'];
 $wishlist_id=$_POST['txt1'];

$dlt_wsh_lst="delete from `wishlist` where `id`='$wishlist_id' and `user_id`='$usr_id'";
$qst_dlt_wsh_lst=$db->query($dlt_wsh_lst);
if($qst_dlt_wsh_lst)
{
    echo json_encode(['status'=>'1','response'=>'Product removed successfully']);
}
    
}
else
{
    echo json_encode(['status'=>0,'response'=>'Please Login']);
}


?>