<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description-gambolthemes" content="">
<meta name="author-gambolthemes" content="">

<title>Admin</title>
<link href="css/styles.css" rel="stylesheet">
<link href="css/admin-style.css" rel="stylesheet">

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/typing.css">
<link rel="stylesheet" href="css/chat.css">


<!--<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">-->
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/froala_editor.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/froala_style.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/code_view.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/colors.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/emoticons.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/image_manager.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/image.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/line_breaker.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/table.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/char_counter.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/video.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/fullscreen.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/file.css">
<!--<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.mn.js"></script>

<style type="text/css">
.chatbox__button button {
visibility: hidden;
}
</style>


</head>

<?php 
$usr_eml=$_SESSION['a_email'];



$usr_dtl="select * from admin where a_email='$usr_eml' and status='enable'";
$qst_usr_dtl=$db->query($usr_dtl);
$clct_usr_dtl=$qst_usr_dtl->fetch_assoc();

$usr_typ=$clct_usr_dtl['user_type'];
$emp_id=$clct_usr_dtl['a_id'];
$usr_nme=$clct_usr_dtl['a_name'];
?>

<body id="body" class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-light bg-clr">
<a class="navbar-brand logo-brand" href="index.php"><span style="color:#00bc00">Welcome</span> <?php echo $usr_nme?></a>
<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i onclick="myFunction()" class="fas fa-bars"></i></button>
<!--<a href="index.php" class="frnt-link"><i class="fas fa-external-link-alt"></i>Home</a>-->
<ul class="navbar-nav ml-auto mr-md-0">
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
<!-- <a class="dropdown-item admin-dropdown-item" href="edit_profile.php">Edit Profile</a> -->
  <?php 
  if($usr_typ==1)
  {
  ?>
<a class="dropdown-item admin-dropdown-item" href="ch_pwd.php">Change Password</a>
  <?php } ?>
  <a class="dropdown-item admin-dropdown-item" href="logout.php">Logout</a>
</div>
</li>
</ul>
</nav>

<script>
function myFunction() {
var body = document.getElementById("body");
if (body.className == "sb-nav-fixed") {
body.classList.add("sb-nav-fixed");
body.classList.add("sb-sidenav-toggled");
} else {
body.classList.remove("sb-nav-fixed");
body.classList.remove("sb-sidenav-toggled");
body.classList.add("sb-nav-fixed");
}
}
</script>

<div id="layoutSidenav">
<div id="layoutSidenav_nav">

<?php 
$usr_eml=$_SESSION['a_email'];



$usr_dtl="select * from admin where a_email='$usr_eml' and status='enable'";
$qst_usr_dtl=$db->query($usr_dtl);
$clct_usr_dtl=$qst_usr_dtl->fetch_assoc();

$usr_typ=$clct_usr_dtl['user_type'];
$emp_id=$clct_usr_dtl['a_id'];
if($usr_typ=='1')
{
?>
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
<div class="sb-sidenav-menu">
<div class="nav">
<a class="nav-link active" href="index.php">
<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
Dashboard
</a>

<!--<a class="nav-link collapsed" href="bdr_otp_cnsnt.php" >-->
<!--<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>-->
<!--Bidder Login OTP consent -->
<!--<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>-->
<!--</a>-->
<!--<div class="collapse" id="collapsseLayoutdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
     <a class="nav-link sub_nav_link" href="bdr_otp_cnsnt.php">View OTP consent</a>
   
</nav>
</div>-->

<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
Users
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayoutdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
     <a class="nav-link sub_nav_link" href="view_users.php">View users</a>
</nav>
</div>



<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoudsdfgdtdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Category
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayoudsdfgdtdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="add_category.php">Add Category</a>
<a class="nav-link sub_nav_link" href="view_category.php">View Category</a>
</nav>
</div>







<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouddtdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Products
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayouddtdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="add_product.php">Add Products</a>
<a class="nav-link sub_nav_link" href="view_product.php">View Products</a>
</nav>
</div>



<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayodddutdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Orders
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayodddutdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="view_all_orders.php">Total orders</a>
<a class="nav-link sub_nav_link" href="view_pending_orders.php?ord_sts=Ordered">Pending orders</a>
<a class="nav-link sub_nav_link" href="view_pending_orders.php?ord_sts=Dispatched">Dispatch orders</a>
<a class="nav-link sub_nav_link" href="view_pending_orders.php?ord_sts=On_the_way">On the way orders</a>
<a class="nav-link sub_nav_link" href="view_pending_orders.php?ord_sts=Delivered">Delivered orders</a>
<a class="nav-link sub_nav_link" href="view_pending_orders.php?ord_sts=Canceled">Canceled orders</a>
<a class="nav-link sub_nav_link" href="view_pending_orders.php?ord_sts=Refunded">Refunded orders</a>



</nav>
</div>




<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouddtsssdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Blogs
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayouddtsssdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="add_blog.php">Add Blog</a>
<a class="nav-link sub_nav_link" href="view_blog.php">View Blog</a>
</nav>
</div>



<a class="nav-link" href="contact_us.php">
<div class="sb-nav-link-icon"><i class="fa fa-question"></i></div>
Contact us
</a>


</div>
</div>
</nav>
<?php 
}
?>


</div>