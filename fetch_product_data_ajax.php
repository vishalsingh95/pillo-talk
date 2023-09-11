<?php 
include('admin/config/config.php');

$prdt_id=$_POST['txt1'];

$clt_latest_products="select * from products where `id`='$prdt_id'";
$qst_clt_latest_products=$db->query($clt_latest_products);
$clct_clt_latest_products=$qst_clt_latest_products->fetch_assoc();

    
    $product_neme=$clct_clt_latest_products['product_name'];
     $prdt_prec=$clct_clt_latest_products['price'];
     $prdt_img=$clct_clt_latest_products['product_image'];
    $prdt_id=$clct_clt_latest_products['id'];
    $prd_desc=$clct_clt_latest_products['short_description'];
    $prdt_explode = explode(", ",$prdt_img);
 $img_count = count($prdt_explode);
 
 
 
  $clt_wh_count="select count(`id`) as `wishcount` from `wishlist` where `product_id`='$prdt_id' and `user_id`='$usr_id'";
   $qst_clt_wh_count=$db->query($clt_wh_count);
   $clct_wh_count = $qst_clt_wh_count->fetch_assoc();
   
   
  $whih_count=$clct_wh_count['wishcount'];
 
 
?>

<div class="row">
<div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3 mb-md-0">
<!--Model thumbnail -->
<div id="quickView" class="carousel slide">
<!-- Image Slide carousel items -->
<div class="carousel-inner">
    
    <?php
     if($prdt_img!='')
 {
    for($i=0; $i<$img_count; $i++)
    {
    ?>
<div class="item carousel-item <?php if($i==0){?> active <?php }?>" data-bs-slide-number="<?php echo $i;?>">
<img class="blur-up lazyload" data-src="admin/product_images/<?php echo $prdt_explode[$i];?>" src="admin/product_images/<?php echo $prdt_explode[$i];?>" alt="image" style="height:414px; width:100%"/>
</div>

<?php 
}
}
else
{
    ?>
    <div class="item carousel-item active " data-bs-slide-number="0">
<img class="blur-up lazyload" data-src="admin/product_images/no_image/noimg.png" src="admin/product_images/no_image/noimg.png" alt="image" style="height:414px; width:100%"/>
</div>

    <?php
}
?>


</div>
<!-- End Image Slide carousel items -->
<!-- Thumbnail image -->
<div class="model-thumbnail-img">
<!-- Thumbnail slide -->
<div class="carousel-indicators list-inline">
    <?php 
    if($prdt_img!='')
 {
    for($i=0; $i<$img_count; $i++)
    {
    
    ?>
<div class="list-inline-item <?php if($i==0){?> active <?php }?>" id="carousel-selector-0" data-bs-slide-to="<?php echo $i;?>" data-bs-target="#quickView">
<img class="blur-up lazyload" data-src="admin/product_images/<?php echo $prdt_explode[$i];?>" src="admin/product_images/<?php echo $prdt_explode[$i];?>"  style="
    height: 50px;
    width: 50px;
" />
</div>

<?php 
}
}
else
{
    ?>
    <div class="list-inline-item active " id="carousel-selector-0" data-bs-slide-to="0" data-bs-target="#quickView">
<img class="blur-up lazyload" data-src="admin/product_images/no_image/noimg.png" src="admin/product_images/admin/product_images/no_image/noimg.png"  style="
    height: 50px;
    width: 50px;
" />
</div>
    <?php
}
?>

</div>
<!-- End Thumbnail slide -->
<!-- Carousel arrow button -->
<a class="carousel-control-prev carousel-arrow" href="#quickView" data-bs-target="#quickView" data-bs-slide="prev"><i class="icon an-3x an an-angle-left"></i><span class="visually-hidden">Previous</span></a>
<a class="carousel-control-next carousel-arrow" href="#quickView" data-bs-target="#quickView" data-bs-slide="next"><i class="icon an-3x an an-angle-right"></i><span class="visually-hidden">Next</span></a>
<!-- End Carousel arrow button -->
</div>
<!-- End Thumbnail image -->
</div>
<!--End Model thumbnail -->
<div class="text-center mt-3"><a href="products_details.php?id=<?php echo $prdt_id;?>">VIEW MORE DETAILS</a></div>
</div>
<div class="col-12 col-sm-6 col-md-6 col-lg-6">
<h2 class="product-title"><?php echo $product_neme?></h2>


<div class="pro-stockLbl my-2">
<span class="d-flex-center stockLbl instock"><i class="icon an an-check-cil"></i><span> In stock</span></span>
<span class="d-flex-center stockLbl preorder d-none"><i class="icon an an-clock-r"></i><span> Pre-order Now</span></span>
<span class="d-flex-center stockLbl outstock d-none"><i class="icon an an-times-cil"></i> <span>Sold out</span></span>
<span class="d-flex-center stockLbl lowstock d-none" data-qty="15"><i class="icon an an-exclamation-cir"></i><span> Order now, Only  <span class="items">10</span>  left!</span></span>
</div>
<div class="pricebox">
<span class="price old-price"></span><span class="price product-price__sale text-success">₹ <?php echo $prdt_prec;?></span>
</div>
<div class="sort-description"><?php 
 echo $prd_desc;   

?></div>
<form method="post" action="#" id="product_form--option" class="product-form">
<div class="product-options d-flex-wrap">

<div class="product-action d-flex-wrap w-100 mb-3 clearfix">
<div class="quantity">
<div class="qtyField rounded">
<a class="qtyBtn minus" href="javascript:void(0);" onClick="minus_value()"><i class="icon an an-minus-r" aria-hidden="true"></i></a>
<input type="text" id="cart_qnty" name="quantity" min='1' value="1" class="product-form__input qty rounded-0" readonly>
<a class="qtyBtn plus" onClick="add_value()" href="javascript:void(0);"><i class="icon an an-plus-l" aria-hidden="true"></i></a>
</div>
</div>                                
<div class="add-to-cart ms-3 fl-1">
<button type="button" onClick="add_to_qty_cart(<?php echo $prdt_id;?>)" class="btn button-cart rounded-0"><span>Add to cart</span></button>
</div>
</div>
</div>
</form>
<div class="wishlist-btn d-flex-center">
<a style="margin-right:3px !important;" class="add-wishlist d-flex-center text-uppercase me-3" id="liked<?php echo $prdt_id?>" onClick="<?php if(isset($_SESSION['user_id']))
{ ?> add_wishlist(<?php echo $prdt_id;?>) <?php } else { ?> toastr.error('Please login') <?php }?>" href="javascript:void(0)" title="Add to Wishlist"> <?php if($whish_count==0) { ?><i style="font-size:24px;color:#F9B5B2" class="fa">&#xf08a;</i> <?php } else { ?><i class="icon an an-heart me-1" aria-hidden="true"></i><?php } ?> </a><span onClick="<?php if(isset($_SESSION['user_id']))
{ ?> add_wishlist(<?php echo $prdt_id;?>) <?php } else { ?> toastr.error('Please login') <?php }?>" style="cursor:pointer">Add to Wishlist</span>
<!--<a class="add-compare d-flex-center text-uppercase" href="compare-style1.html" title="Add to Compare"><i class="icon an an-random-r me-2"></i> <span>Add to Compare</span></a>-->
</div>
<!-- Social Sharing -->
<!--<div class="social-sharing share-icon d-flex-center mx-0 mt-3">-->
<!--<span class="sharing-lbl me-2">Share :</span>-->
<!--<a href="#" class="d-flex-center btn btn-link btn--share share-facebook" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Facebook"><i class="icon an an-facebook mx-1"></i><span class="share-title d-none">Facebook</span></a>-->
<!--<a href="#" class="d-flex-center btn btn-link btn--share share-twitter" data-bs-toggle="tooltip" data-bs-placement="top" title="Tweet on Twitter"><i class="icon an an-twitter mx-1"></i><span class="share-title d-none">Tweet</span></a>-->
<!--<a href="#" class="d-flex-center btn btn-link btn--share share-pinterest" data-bs-toggle="tooltip" data-bs-placement="top" title="Pin on Pinterest"><i class="icon an an-pinterest-p mx-1"></i> <span class="share-title d-none">Pin it</span></a>-->
<!--<a href="#" class="d-flex-center btn btn-link btn--share share-linkedin" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Instagram"><i class="icon an an-instagram mx-1"></i><span class="share-title d-none">Instagram</span></a>-->
<!--<a href="#" class="d-flex-center btn btn-link btn--share share-whatsapp" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on WhatsApp"><i class="icon an an-whatsapp mx-1"></i><span class="share-title d-none">WhatsApp</span></a>-->
<!--<a href="#" class="d-flex-center btn btn-link btn--share share-email" data-bs-toggle="tooltip" data-bs-placement="top" title="Share by Email"><i class="icon an an-envelope-l mx-1"></i><span class="share-title d-none">Email</span></a>-->
<!--</div>-->
<!-- End Social Sharing -->
</div>
</div>

