<?php 
include("admin/config/config.php");
if(isset($_SESSION['user_id']))
{
    $usr_iid=$_SESSION['user_id'];
    $cart_iid=$_POST['txt1'];
    
$delete_cart="delete from `cart` where `id`='$cart_iid' and `user_id`='$usr_iid'";    
$qst_delete_cart=$db->query($delete_cart);
if($qst_delete_cart)
{
    echo json_encode(["status"=>'1',"response"=>"Deleted successfully"]);
}

}
else
{
     echo json_encode(["status"=>'0',"response"=>"Please Login"]);
}
?>