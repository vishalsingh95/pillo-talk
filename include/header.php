<?php 
date_default_timezone_set('Asia/kolata');
include('admin/config/config.php');
$curt_dete=date('Y-m-d');

if(isset($_SESSION['user_id']))
{
$usr_id=$_SESSION['user_id'];

$clt_usr_dtl="select * from `users` where `id`='$usr_id'";
$qst_clt_usr_dtl=$db->query($clt_usr_dtl);
$clct_clt_usr_dtl= $qst_clt_usr_dtl->fetch_assoc();


$usr_neme=$clct_clt_usr_dtl['name'];
$usr_mbbbl=$clct_clt_usr_dtl['mobile'];


$clt_cart_cnt="select count(`id`) as `cart_count` from `cart` where `user_id`='$usr_id'";
$qst_clt_cart_cnt=$db->query($clt_cart_cnt);
$clct_clt_cart_cnt=$qst_clt_cart_cnt->fetch_assoc();

$crt_cnt=$clct_clt_cart_cnt['cart_count'];



$clt_wshlst = "select count(`id`) as `wish_count` from `wishlist` where `user_id`='$usr_id'";
$qst_clt_wshlst=$db->query($clt_wshlst);
$clct_wshlst = $qst_clt_wshlst->fetch_assoc();

$whs_count=$clct_wshlst['wish_count'];



}
?>
<!doctype html>
<html lang="en">

<head>
<!--Required Meta Tags-->
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="description">
<!-- Title Of Site -->
<title>Textiles </title>
<!-- Favicon -->
<link rel="shortcut icon" href="assets/images/favicon.png" />
<!-- Plugins CSS -->
<link rel="stylesheet" href="assets/css/plugins.css" />
<!-- Main Style CSS -->
<link rel="stylesheet" href="assets/css/style.css" />
<link rel="stylesheet" href="assets/css/custom.css" />
<link rel="stylesheet" href="assets/css/responsive.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>
<style>
/* Override toastr positioning */
#toast-container {
top: 0;
right: 0;
}
</style>
<body class="template-index index-demo3">

<!-- Page Loader -->
<!--<div id="pre-loader"><img src="assets/images/loader.gif" alt="Loading..." /></div>-->
<!-- End Page Loader -->

<!--Page Wrapper-->
<div class="page-wrapper">
<!--Header-->
<div id="header" class="header-3">
<!--Topbar-->

<div class="top-bar">
<div class="container-fluid">
<div class="inner d-flex align-items-center">
<div class="col-12 col-sm-12 col-md-12 col-lg-6 d-none d-lg-flex d-md-flex">

<!--<ul class="social-icons list-inline align-items-center">
<li class="list-inline-item"><a href="#"><i class="an text-dark an-facebook" aria-hidden="true"></i><span class="tooltip-label">Facebook</span></a></li>
<li class="list-inline-item"><a href="#"><i class="an text-dark an-twitter" aria-hidden="true"></i><span class="tooltip-label">Twitter</span></a></li>
<li class="list-inline-item"><a href="#"><i class="an text-dark an-pinterest-p" aria-hidden="true"></i><span class="tooltip-label">Pinterest</span></a></li>
<li class="list-inline-item"><a href="#"><i class="an text-dark an-instagram" aria-hidden="true"></i><span class="tooltip-label">Instagram</span></a></li>
<li class="list-inline-item"><a href="#"><i class="an text-dark an-whatsapp" aria-hidden="true"></i><span class="tooltip-label">Whatsapp</span></a></li>
</ul>-->
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-6 text-dark d-md-block text-sm-right text-right FREE_DELIVERY_OVER">
FREE DELIVERY ON ALL PRODUCTS
</div>
</div>
</div>
</div>
<!--End Topbar-->

<!--Header Content-->
<div class="header-main mih-80 classicHeader d-flex align-items-center">
<div class="container-fluid">        
<div class="row">
<!--Logo / Menu Toggle-->
<div class="col-6 col-sm-6 col-md-6 col-lg-2 align-self-center justify-content-start d-flex">
<!--Mobile Toggle-->
<button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open me-3 d-lg-none"><i class="icon an an-times-l"></i><i class="icon an an-bars-l"></i></button>
<!--End Mobile Toggle-->
<!--Logo-->
<div class="logo">
<a href="index.php">
<img src="assets/images/logo.jpeg" class="logo-img default-logo mh-100" alt="text" title="Vallabh Textiles " width="220" style="
    max-width: 120px;
"/>
<img src="assets/images/logo.jpeg" class="logo-img sticky-logo mh-100" alt="Vallabh Textiles " title="Vallabh Textiles " width="220" style="
    max-width: 120px;
"/>
<span class="logo-txt d-none">textiles</span>
</a>
</div>
<!--End Logo-->
</div>
<!--End Logo / Menu Toggle-->
<!--Main Navigation Desktop-->
<div class="col-1 col-sm-1 col-md-1 col-lg-9 col-xl-9 align-self-center d-menu-col">                              
<!--Desktop Menu-->
<nav class="grid__item" id="AccessibleNav">
<ul id="siteNav" class="site-nav medium right hidearrow">
<li class="lvl1 parent megamenu"><a href="index.php">Home </a> </li>
<li class="lvl1 parent megamenu"><a href="shop.php">Shop </a> </li>
<!--<li class="lvl1 parent megamenu"><a href="products_details.php">Products Details </a> </li>-->
<li class="lvl1 parent megamenu"><a href="blog.php">Blog </a> </li>
<!--<li class="lvl1 parent megamenu"><a href="blog_details.php">Blog Details</a> </li>-->
<li class="lvl1 parent megamenu"><a href="contact.php">Contact </a> </li>



<?php 
if(isset($_SESSION['user_id']))
{
?>  
<li class="lvl1 parent megamenu"><a href="#"><b>Hello <?php echo $usr_neme;?>!</b></a> 
<?php 
}
else
{
?>

<li class="lvl1 parent megamenu"><a href="login.php">Sign-in</a> </li>

<?php
}
?>									

</ul>
</nav>
<!--End Desktop Menu-->                                   
</div>
<!--End Main Navigation Desktop-->
<!--Right Action-->
<div class="col-6 col-sm-6 col-md-6 col-lg-1 col-xl-1 align-self-center icons-col text-right d-flex justify-content-end">
<!--Search-->
<!--<div class="site-search iconset"><i class="icon an an-search-l"></i><span class="tooltip-label">Search</span></div>-->
<!--End Search-->
<!--Wishlist-->
<!-- <div class="wishlist-link iconset">
<a href="my-wishlist.php"><i class="icon an an-heart-l"></i><span class="wishlist-count counter d-flex-center justify-content-center position-absolute translate-middle rounded-circle">0</span><span class="tooltip-label">Wishlist</span></a>
</div>-->
<!--End Wishlist-->
<!--Setting Dropdown-->


<?php 
if(isset($_SESSION['user_id']))
{
?>  

<div class="user-link iconset"><i class="icon an an-user"></i><span class="tooltip-label">Account</span></div>
<div id="userLinks">
<ul class="user-links">
<li><a href="my_order.php">Your Orders</a></li>
<li><a href="signout.php">Sign Out</a></li>

</ul>
</div>


<!--End Setting Dropdown-->
<!--Minicart Drawer-->
<div class="header-cart iconset" id="cart_ounts">
<a href="#" class="site-header__cart btn-minicart" data-bs-toggle="modal" data-bs-target="#minicart-drawer">
<i class="icon an an-sq-bag"></i><span class="site-cart-count counter d-flex-center justify-content-center position-absolute translate-middle rounded-circle"><?php echo $crt_cnt;?></span><span class="tooltip-label">Cart</span>
</a>
</div>
<!--End Minicart Drawer-->
<!--Setting Dropdown-->
<div class="setting-link iconset pe-0" id="wish_count"><a href="wishlist.php"><i class="icon an an-heart-l"></i><span class="wishlist-count counter d-flex-center justify-content-center position-absolute translate-middle rounded-circle"><?php  echo $whs_count;?></span></a><span class="tooltip-label">Wishlist</span></div>
<?php
}
?>
<!--End Setting Dropdown-->
</div>
<!--End Right Action-->
</div>
</div>
<!--Search Popup-->
<div id="search-popup" class="search-drawer">
<div class="container-fluid px-0">
<span class="closeSearch an an-times-l"></span>
<form class="form minisearch" id="header-search" action="#" method="get">
<label class="label"><span>Search</span></label>
<div class="control">
<div class="searchField">
<div class="search-category">
<select id="rgsearch-category" name="rgsearch[category]" data-default="All Categories">
<option value="00" label="All Categories" selected="selected">All Categories</option>
<optgroup id="rgsearch-shop" label="Shop">
<option value="0">- All</option>
<option value="1">- Men</option>
<option value="2">- Women</option>
<option value="3">- Shoes</option>
<option value="4">- Blouses</option>
<option value="5">- Pullovers</option>
<option value="6">- Bags</option>
<option value="7">- Accessories</option>
</optgroup>
</select>
</div>
<div class="input-box">
<button type="submit" title="Search" class="action search" disabled=""><i class="icon an an-search-l"></i></button>
<input type="text" name="q" value="" placeholder="Search by keyword or #" class="input-text">
</div>
</div>
</div>
</form>
</div>
</div>
<!--End Search Popup-->
</div>
<!--End Header Content-->
</div>
<!--End Header-->
<!--Mobile Menu-->
<div class="mobile-nav-wrapper" role="navigation">
<div class="closemobileMenu"><i class="icon an an-times-l pull-right"></i> Close Menu</div>
<ul id="MobileNav" class="mobile-nav">



<li class="lvl1 parent megamenu"><a href="index.php">Home </a> </li>
<li class="lvl1 parent megamenu"><a href="shop.php">Shop </a> </li>
<!--<li class="lvl1 parent megamenu"><a href="products_details.php">Products Details </a> </li>-->
<li class="lvl1 parent megamenu"><a href="blog.php">Blog </a> </li>
<!--<li class="lvl1 parent megamenu"><a href="blog_details.php">Blog Details</a> </li>-->
<li class="lvl1 parent megamenu"><a href="contact.php">Contact </a> </li>



<?php 
if(isset($_SESSION['user_id']))
{
?>  
<li class="lvl1 parent megamenu"><a href="#"><b>Hello <?php echo $usr_neme;?>!</b></a> 
<?php 
}
else
{
?>

<li class="lvl1 parent megamenu"><a href="login.php">Sign-in</a> </li>

<?php
}
?>									
</ul>
</div>
<!--End Mobile Menu-->