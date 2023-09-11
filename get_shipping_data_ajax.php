<?php 
include("admin/config/config.php");

if(isset($_SESSION['user_id']))
{
    $usr_id=$_SESSION['user_id'];
    $adrs_id=$_POST['txt1'];
    $clt_Dtl="select * from `shipping_address` where `user_id`='$usr_id' and `id`='$adrs_id'";
    $qst_clt_Dtl=$db->query($clt_Dtl);
    $clct_fetch_Dtl=$qst_clt_Dtl->fetch_assoc();
    
    $nme=$clct_fetch_Dtl['name'];
    $mobl=$clct_fetch_Dtl['mobile'];
    $lnd_mrk=$clct_fetch_Dtl['landmark'];
    $cty=$clct_fetch_Dtl['city'];
    $adrss=$clct_fetch_Dtl['address'];
    $pncde=$clct_fetch_Dtl['pincode'];
    
    
    echo json_encode(["status"=>"1","response"=>"fetched","data"=>$clct_fetch_Dtl]);

    
    
}
else
{
    echo json_encode(["status"=>"0","response"=>"Please login"]);
}

?>