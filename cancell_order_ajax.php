<?php 
include('admin/config/config.php');

if(isset($_SESSION['user_id']))
{
    $user_id=$_SESSION['user_id'];
    $ord_prdt_id=$_POST['txt1'];
    $cancel_reason=mysqli_real_escape_string($db , $_POST['txt2']);
    
$upd_cancel="update `orders` set 
`cancel_reason`='$cancel_reason',
`status`='Canceled' where `id`='$ord_prdt_id' and `user_id`='$user_id'";
$qst_upd_cancel=$db->query($upd_cancel);
    if($qst_upd_cancel)
    {
        echo json_encode(["status"=>"1","response"=>"Order cancelled successfully"]);
    }
}
else
{
    echo json_encode(["status"=>"0","response"=>"Please login"]);
}

?>