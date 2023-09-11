<?php
@ob_start();
//session_start();
require_once 'config/config.php';
require_once 'config/helper.php';


if (isset($_GET['active'])) {

$activate = $_GET['active'];
$sql=$db->query("UPDATE users SET status='0' WHERE user_id=$activate ");
echo "<script>alert(' Deactivate Successfully.'); window.location = 'users_list.php';</script>";
}
if (isset($_GET['deactivate'])) {
$deactivate = $_GET['deactivate'];
$sql1=$db->query("UPDATE users SET status='1' WHERE user_id=$deactivate");
echo "<script>alert('Activate Successfully.'); window.location = 'users_list.php';</script>";
}






if (!empty($_SESSION['ibc'])) {
if ($_SESSION['ibc'] != session_id()) {
header('Location: index.php');
exit;
}
} else {
header('Location: login.php');
exit;
}
$logintype = $_SESSION['logintype'];
$a_idchk = $_SESSION['a_id'];

$ausernmae = $_SESSION['a_name'];
ob_start("ob_html_compress");
$comp_select = $db->query("SELECT * FROM `admin`");
$comp_fetch = $comp_select->fetch_object();
$a_company = $comp_fetch->a_company;
$check_a_name = $_SESSION['a_name'];
function facebook_time_ago($timestamp)
{
$time_ago = strtotime($timestamp);
$current_time = time();
$time_difference = $current_time - $time_ago;
$seconds = $time_difference;
$minutes      = round($seconds / 60);           // value 60 is seconds
$hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
$days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;
$weeks          = round($seconds / 604800);          // 7*24*60*60;
$months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
$years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
if ($seconds <= 60) {
return "Just Now";
} else if ($minutes <= 60) {
if ($minutes == 1) {
return "one minute ago";
} else {
return "$minutes minutes ago";
}
} else if ($hours <= 24) {
if ($hours == 1) {
return "an hour ago";
} else {
return "$hours hrs ago";
}
} else if ($days <= 7) {
if ($days == 1) {
return "yesterday";
} else {
return "$days days ago";
}
} else if ($weeks <= 4.3) //4.3 == 52/12
{
if ($weeks == 1) {
return "a week ago";
} else {
return "$weeks weeks ago";
}
} else if ($months <= 12) {
if ($months == 1) {
return "a month ago";
} else {
return "$months months ago";
}
} else {
if ($years == 1) {
return "one year ago";
} else {
return "$years years ago";
}
}
}
?>

<?php include 'header.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<?php

?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title">All Bidders</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">All Orders</li>
</ol>
<div id="order_div">
<?php
if(isset($_GET['id']))
{
    $unsr_id=$_GET['id'];
$ord_dtl="select * from `address_of_orders` where `user_id`='$unsr_id' order by `id` DESC";
$qst_ord_dtl=$db->query($ord_dtl);
while($clct_ord_dtl=$qst_ord_dtl->fetch_assoc())
{
$ord_id=$clct_ord_dtl['order_id'];
$ussr_iid=$clct_ord_dtl['user_id'];
$ord_dete=$clct_ord_dtl['order_date'];


$sh_usr_nmae=$clct_ord_dtl['name'];
$sh_mobile=$clct_ord_dtl['mobile'];
$sh_lnd_mrk=$clct_ord_dtl['landmark'];
$sh_adrs=$clct_ord_dtl['address'];
$sh_pncode=$clct_ord_dtl['pincode'];

$sh_city=$clct_ord_dtl['city'];



$order_word_date=date("M jS, Y", strtotime("$ord_dete"));


$clt_usr_dtl="select * from `users` where `id`='$ussr_iid'";
$qst_clt_usr_dtl=$db->query($clt_usr_dtl);
$clct_clt_usr_dtl=$qst_clt_usr_dtl->fetch_assoc();

$uuse_neme=$clct_clt_usr_dtl['name'];
?>
<div class='ord'>
    
<div class='px-3 table table-responsive' style="border: none !important;background:white;padding-top: 40px;border: 1px solid black !important;">
    <div class="row">
<div class="col-md-8">
<h5 class="order-title mb-3">Order id # <b><?php echo $ord_id;?></b> </h5>
    <h3 style="font-size:14px;">[Date:- <b><?php echo $order_word_date;?></b> ]</h3>
    </div>
    <div class="col-md-4">
    <div class="user_details">
        
        <p style="font-size:16px;font-weight:bold;padding-bottom: 0px;margin-bottom: 10px;">Username : <?php echo $uuse_neme;?> [<a href="view_user_details.php?id=<?php echo $ussr_iid;?>">View user details</a>]</p>
        
        <h5>Shipping details</h5>
        <p style="
    margin-bottom: 2px;
"><?php echo $sh_usr_nmae;?> , <?php echo $sh_mobile;?></p>
        <p style="
    margin-bottom: 2px;
"><?php echo $sh_adrs;?>, <?php echo $sh_city;?> <?= $sh_pncode;?></p>
        <p>Landmark :- <?= $sh_lnd_mrk;?></p>
    </div>
    </div>
    </div>
    

<table class='table'  style="border: 2px solid black !important;">
<thead>
<tr>
<th class="text-start">Order </th>
<th>Product </th>
<th>Name</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php 
$clt_ord_dtl="select * from `orders` where `order_id`='$ord_id'";
$qst_clt_ord_dtl=$db->query($clt_ord_dtl);
$sno=1;
while($clct_clt_ord_dtl=$qst_clt_ord_dtl->fetch_assoc())

{
$prdt_img=$clct_clt_ord_dtl['product_image'];
$prdt_neme=$clct_clt_ord_dtl['product_name'];
$prdt_prece=$clct_clt_ord_dtl['price'];
$prdt_qnty=$clct_clt_ord_dtl['quantity'];
$prdt_stts=$clct_clt_ord_dtl['status'];
$prdt_iid=$clct_clt_ord_dtl['product_id'];
$ord_prdt_unique_id=$clct_clt_ord_dtl['id'];
$cancwel_reason = $clct_clt_ord_dtl['cancel_reason'];
$expl_prdt=explode(", ",$prdt_img);
?>
           
<tr>
        <td class="text-start"><?php echo $sno++;?></td>
        <td class="thumbImg"><img class="cart__image" src="product_images/<?php echo $expl_prdt[0];?>" style="
    height: 100px;
    width: 100px;
"></td>
        <td style="width:200px;">
        <?php echo $prdt_neme;?>
        
        </td>
        
        <td>₹ <?php echo $prdt_prece;?></td>
        <td><?php echo $prdt_qnty;?></td>
        
        <td>₹ <?php echo $prdt_prece*$prdt_qnty;?></td>
        <td class="text-success"><b><?php echo $prdt_stts;?> <?php if($prdt_stts=="Canceled"){ ?><span style="color:red"> (<?php echo $cancwel_reason; ?>)</span><?php }?> </b></td>
        <td><div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #697ceb;">
      Change order status
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="javascript:void(0)" onClick="change_order_status('Ordered' , <?php echo $ord_prdt_unique_id;?>, '<?php echo $ord_id;?>')">Ordered</a>
      <a class="dropdown-item" href="javascript:void(0)" onClick="change_order_status('Dispatched' , <?php echo $ord_prdt_unique_id; ?>, '<?php echo $ord_id;?>')">Dispatched</a>
       <a class="dropdown-item" href="javascript:void(0)" onClick="change_order_status('On_the_way' , <?php echo $ord_prdt_unique_id; ?>, '<?php echo $ord_id;?>')">On_the_way</a>
        <a class="dropdown-item" href="javascript:void(0)" onClick="change_order_status('Delivered' , <?php echo $ord_prdt_unique_id; ?>, '<?php echo $ord_id;?>')">Delivered</a>
         <a class="dropdown-item" href="javascript:void(0)" onClick="change_order_status('Canceled' , <?php echo $ord_prdt_unique_id; ?>, '<?php echo $ord_id;?>')">Canceled</a>
         <a class="dropdown-item" href="javascript:void(0)" onClick="change_order_status('Refunded' , <?php echo $ord_prdt_unique_id; ?>, '<?php echo $ord_id;?>')">Refunded</a>
      
    </div>
  </div></td>
                                                </tr>
<?php 
}
?>
<tr><td colspan="7"></td><td><a href="view_order_details.php?ord_id=<?php echo $ord_id; ?>" class="btn btn-warning" style="
    /* display: flex; */
">View Order details</a></td></tr>
</tbody>

</table>
</div>
</div>
<?php 
}
}
?>
</div>
</div>
</main>

<script>


function dlt_lqdtr(txt)
{
var txt1=txt;


$.ajax({
url: "dlt_lqdtor.php",
type: "POST",
data    : {txt1:txt1},
cache: false,
success: function(data){
Swal.fire({

icon: 'success',
title: 'Your work has been saved',
showConfirmButton: false,
timer: 1500
});
window.location='';

}
});






}


</script>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>


<script>

function change_order_status(txt , txt1 ,ord_id) {
  
  if (confirm('Do you want to change order status ' +txt) == true) {
    
$.ajax
(
{
url     : 'change_order_status_ajax.php',
type    : 'POST',
data    :{txt1:txt,txt2:txt1,txt3:ord_id},
success : function(resp){
var obj=jQuery.parseJSON( resp );
if(obj.status==1)
{
    
    $('#order_div').load(window.location.href + ' #order_div');
    
Swal.fire({
  icon: 'success',
  title: obj.repsonse,
  text: '',

});



}
else
{

}
},
error   : function(resp){
}  
}
);
    
    
  } else {
    return false;
  }

}
</script>

<?php include 'footer.php'; 

ob_flush();

?>