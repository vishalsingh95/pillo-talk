<?php include "include/header.php"?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php 
if(isset($_GET['id']))
{

    $prdt_id=$_GET['id'];
    

    $clt_products_dt="select * from `products` where `id`='$prdt_id'";
    $qst_clt_products_dt=$db->query($clt_products_dt);
    $clct_clt_products_dt=$qst_clt_products_dt->fetch_assoc();
    
    $pro_neme=$clct_clt_products_dt['product_name'];
    $pro_price=$clct_clt_products_dt['price'];
    $pro_img=$clct_clt_products_dt['product_image'];
    $pro_id=$clct_clt_products_dt['id'];
    $pro_shrt_desc= $clct_clt_products_dt['short_description'];
    $pro_desc= $clct_clt_products_dt['description'];
    $pro_explode = explode(", ",$pro_img);
    $frsts_img=$pro_explode[0];
    $image_count=count($pro_explode);
    $category_id=$clct_clt_products_dt['category_id'];

$clt_ctgy="select * from `product_category` where `id`='$category_id'";
$qst_clt_ctgy=$db->query($clt_ctgy);
$clct_clt_ctgy=$qst_clt_ctgy->fetch_assoc();

$ctgy_neme=$clct_clt_ctgy['name'];
    //echo $frst_img;
   // print_r($prdt_explode); 


   
  $clt_whs_count="select count(`id`) as `wishcount` from `wishlist` where `product_id`='$prdt_id' and `user_id`='$usr_id'";
   $qst_clt_whs_count=$db->query($clt_whs_count);
   $clct_whs_count = $qst_clt_whs_count->fetch_assoc();
   
   
  $whish_count=$clct_whs_count['wishcount'];
}
?>
<style>
.zoompro-span img#zoompro {
    width: 100%;
    height: 464px;
}


</style>
            <!--Body Container-->
            <div id="page-content">
               	<div id="toast-container"></div>
			    <!--Collection Banner-->
               <div class="collection-header">
				 <div class="collection-hero  d-flex justify-content-center align-items-center"style="    background-color: #f2f2f2; height: 100px;opacity: 1;">
                        <!--<div class="collection-hero__image"></div>-->
						<div class="container">
						<div class="row justify-content-between">
						<div class="col-md-2 col-md-offset-2">
                        <h2 class="text-start">Products</h2>
                       
                        </div>
						
						<div class="col-md-2 col-md-offset-2 ">
						<span class="text-md-end d-flex align-items-center">
						<i class="icon an an-home-l me-2"></i>
						<p>Products</p>
						</span>
					
                        </div>
						
						</div>
						</div>
                <!--End Collection Banner-->
               </div>
            </div>
                <!--End Collection Banner-->

                <!--Main Content-->
                <div class="container mb-2">
                    <!--Product Content-->
                    <div class="product-single">
                        <div class="row">
<div class="col-lg-6 col-md-6 col-sm-12 col-12">
<div class="product-details-img product-horizontal-style clearfix mb-3 mb-md-0">
<div class="zoompro-wrap product-zoom-right w-100 p-0">
<div class="zoompro-span">
    <img id="zoompro" class="zoompro" src="<?php if($pro_img!=''){ ?>admin/product_images/<?php echo $frsts_img; } else {?>admin/product_images/no_image/noimg.png<?php }?>" data-zoom-image="<?php if($pro_img!=''){ ?>admin/product_images/<?php echo $frsts_img; } else {?>admin/product_images/no_image/noimg.png<?php }?>" alt="product" /></div>
<div class="product-labels d-none"><span class="lbl pr-label1">new</span></div>
<div class="product-buttons">
<a href="#" class="btn rounded-0 prlightbox"><i class="icon an an-expand-l-arrows"></i><span class="tooltip-label">Zoom Image</span></a>
</div>
</div>
<div class="product-thumb product-horizontal-thumb w-100 pt-2 mt-1">
<div id="gallery" class="product-thumb-style1 overflow-hidden">
    <?php 
    if($pro_img!='')
    {
    for($i=0; $i < $image_count; $i++)
    {
    ?>
<a data-image="admin/product_images/<?php echo $pro_explode[$i];?>" data-zoom-image="admin/product_images/<?php echo $pro_explode[$i];?>" class="slick-slide slick-cloned <?php if($i==0){?>active<?php }?>">
<img class="blur-up lazyload" data-src="admin/product_images/<?php echo $pro_explode[$i];?>" src="admin/product_images/<?php echo $pro_explode[$i];?>" alt="product" style="height:80px; width:80px;"/>
</a>
<?php 
}
}
else
{
    ?>
    <a data-image="admin/product_images/no_image/noimg.png" data-zoom-image="admin/product_images/no_image/noimg.png" class="slick-slide slick-cloned active">
<img class="blur-up lazyload" data-src="admin/product_images/no_image/noimg.png" src="admin/product_images/no_image/noimg.png" alt="product" style="height:80px; width:80px;"/>
</a>
    <?php
}
?>
</div>
</div>
<div class="lightboximages">
 <?php 
     if($pro_img!='')
    {
    for($i=0; $i < $image_count; $i++)
    {
    ?>
    <a href="admin/product_images/<?php echo $pro_explode[$i];?>" data-size="1000x1280"></a>
    <?php 
    }
    }
    else
    {
     
         ?>
    <a href="admin/product_images/no_image/noimg.png" src="admin/product_images/no_image/noimg.png" data-size="1000x1280"></a>
        <?php
    }
    ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <!-- Product Info -->
                                <div class="product-single__meta">
                                    <div class="title-nav d-flex justify-content-between">
                                        <h1 class="product-single__title pe-5"><?php echo $pro_neme;?></h1>
                                      
                                    </div>
                                    <!-- Product Reviews -->
                                   <!-- <div class="product-review mb-2"><a class="reviewLink d-flex-center" href="#reviews"><i class="an an-star"></i><i class="an an-star mx-1"></i><i class="an an-star"></i><i class="an an-star mx-1"></i><i class="an an-star-o"></i><span class="spr-badge-caption ms-2">16 Reviews</span></a></div>-->
                                    <!-- End Product Reviews -->
                                 
                                    <!-- Product Price -->
                                    <div class="product-single__price pb-0 mb-0">
                                        <span class="visually-hidden">Regular price</span>
                                        <span class="product-price__sale--single">
                                            <span class="product-price-old-price d-none"></span><span class="product-price__price product-price__sale-d">₹ <?php echo $pro_price;?></span>   
                                            <span class="discount-badge d-none"><span class="devider me-2">|</span><span>Save: </span><span class="product-single__save-amount"><span class="money">$99.00</span></span><span class="off ms-1">(<span>25</span>%)</span></span> 
                                        </span>

                                    </div>
                                    <!-- End Product Price -->
                                </div>
                                <!-- End Product Info -->
                                <div class="product-single__description rte">
                                   <?php echo $pro_shrt_desc;?>
                                </div>
                                <!-- Product Form -->
                                <form method="post" action="#" class="product-form form-bordered hidedropdown">
                                    <!-- Product Action -->
                                    <div class="product-action w-100 clearfix">
                                        <div class="product-form__item--quantity d-flex-center mb-3">
                                            <div class="qtyField">
                                                <a class="qtyBtn minus" href="javascript:void(0);"><i class="icon an an-minus-r" aria-hidden="true"></i></a>
                                                <input type="text" id="cart_qnty" min='1' value="1" readonly class="product-form__input qty rounded-0">
                                                <a class="qtyBtn plus" href="javascript:void(0);" ><i class="icon an an-plus-r" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pro-stockLbl ms-3">
                                                <span class="d-flex-center stockLbl instock"><i class="icon an an-check-cil"></i><span> In stock</span></span>
                                                <span class="d-flex-center stockLbl preorder d-none"><i class="icon an an-clock-r"></i><span> Pre-order Now</span></span>
                                                <span class="d-flex-center stockLbl outstock d-none"><i class="icon an an-times-cil"></i> <span>Sold out</span></span>
                                                <span class="d-flex-center stockLbl lowstock d-none" data-qty="15"><i class="icon an an-exclamation-cir"></i><span> Order now, Only  <span class="items">10</span>  left!</span></span>
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="product-form__item--submit">
    <button type="button" onClick="add_to_qty_cart(<?php echo $prdt_id;?>)" class="btn rounded-0 product-form__cart-submit mb-0"><span>Add to cart</span></button>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="product-form__item--buyit clearfix">
                                                    <!--<button type="button" class="btn rounded-0 btn-outline-primary proceed-to-checkout">Buy it now</button>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="agree-check customCheckbox clearfix d-none">
                                            <input id="prTearm" name="tearm" type="checkbox" value="tearm" required />
                                            <label for="prTearm">I agree with the terms and conditions</label>
                                        </div>
                                    </div>
                                    <!-- End Product Action -->
                                    <!-- Product Info link -->
                                    <p class="infolinks d-flex-center mt-2 mb-0">
                                        <a style="
    margin-right: 3px;
" class="btn add-to-wishlist" id="like<?php echo $prdt_id;?>" onclick=" add_wishlist(<?php echo $prdt_id?>)" href="javascript:void(0)"><?php if($whish_count==0) { ?><i style="font-size:24px;color:#F9B5B2" class="fa">&#xf08a;</i> <?php } else { ?><i class="icon an an-heart me-1" aria-hidden="true"></i><?php } ?></a><span style="cursor:pointer" onclick=" add_wishlist(<?php echo $prdt_id?>)"> Add to Wishlist</span>
                                    </p>
                                    <!-- End Product Info link -->
                                </form>
                                <!-- End Product Form -->
                              
                                <!-- Product Info -->
                                <div class="freeShipMsg"> <b>Category:</b><a href="shop.php?ctgy_id=<?php echo $category_id;?>"> <?php echo $ctgy_neme;?> </a></div>
                                <!-- End Product Info -->
                            </div>
                        </div>
                    </div>
                    <!--Product Content-->

                    <!--Product Tabs-->
					<div class="row tab-vertical-style my-3">
					<div class="col-12 col-sm-3 md-0">
					<div class="nav flex-column nav-pills" id="vertical-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link active" id="description-tab" data-bs-toggle="pill" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
				<!--	<a class="nav-link" id="Reviews-tab" data-bs-toggle="pill" href="#Reviews" role="tab" aria-controls="sizeChart" aria-selected="false">Reviews</a>-->
					
					</div>
					</div>
					<div class="col-12 col-sm-9">
					<div class="tab-content d-block" id="vertical-tabContent">
					<div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
					<h4>Description</h4>
				<?php echo $pro_desc; ?>
					</div>
					<div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
					<h4>Description</h4>
					<p>There are no reviews yet.</p>
					</div>
					
				
					</div>
					</div>
					</div>   
					<!--End Product Tabs-->
                </div>
                <!--End Container-->

<!--New Arrivals Product Grid-->
					<section class="section pb-0">
                    <div class="container">
                        <h1 class="product-single__title my-3">Other Products</h1>
                    						<!--Product Grid-->
                            <div class="grid-products grid--view-items shop-grid-5 prd-grid">
                                <div class="row">
                                   <?php
$clt_latest_products="select * from products where `id`!='$prdt_id' order by `id` desc";
$qst_clt_latest_products=$db->query($clt_latest_products);
while($clct_clt_latest_products=$qst_clt_latest_products->fetch_assoc())
{
    
    $product_neme=$clct_clt_latest_products['product_name'];
     $prdt_prec=$clct_clt_latest_products['price'];
     $prdt_img=$clct_clt_latest_products['product_image'];
    $prdt_id=$clct_clt_latest_products['id'];
    $prdt_explode = explode(", ",$prdt_img);
    $frst_img=$prdt_explode[0];
    //echo $frst_img;
   // print_r($prdt_explode); 
   
   
   
  $clt_hs_count="select count(`id`) as `wiscount` from `wishlist` where `product_id`='$prdt_id' and `user_id`='$usr_id'";
   $qst_clt_hs_count=$db->query($clt_hs_count);
   $clct_hs_count = $qst_clt_hs_count->fetch_assoc();
   
   
  $wsh_cunt=$clct_hs_count['wiscount'];
   
   
   
?>

<div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 item">
<!--Start Product Image-->
<div class="product-image">
<!--Start Product Image-->
<a href="products_details.php?id=<?php echo $prdt_id;?>" class="product-img">
<!-- image -->
<img class=" blur-up lazyload" data-src="admin/product_images/<?php if($frst_img!=''){ echo $frst_img;}else{?>/no_image/noimg.png<?php } ?>" src="admin/product_images/<?php if($frst_img!=''){ echo $frst_img;}else{?>/no_image/noimg.png<?php } ?>" alt="image" title="<?php echo $product_neme;?>" style="height:280px;">
<!-- End image -->
</a>
<!--End Product Image-->

<div class="button-set-top position-absolute">
<a class="btn-icon wishlist add-to-wishlist rounded" id="like<?php echo $prdt_id;?>" href="javascript:void(0);" onClick="<?php if(isset($_SESSION['user_id']))
{ ?> add_wishlist(<?php echo $prdt_id;?>) <?php } else { ?> toastr.error('Please login')  <?php }?>"><?php if($wsh_cunt==0) { ?><i style="font-size:24px;color:#F9B5B2" class="fa" >&#xf08a;</i> <span class="tooltip-label">Add To Wishlist</span><?php } else { ?><i class="icon an an-heart"></i> <span class="tooltip-label">Remove To Wishlist</span><?php } ?></a>
<a class="btn-icon quick-view-popup quick-view rounded" href="javascript:void(0)" data-toggle="modal" onClick="get_product_data(<?php echo $prdt_id;?>)" data-target="#content_quickview"><i class="icon an an-search-l"></i> <span class="tooltip-label">Quick View</span></a>
<!--<a class="btn-icon compare add-to-compare rounded" href="compare-style2.html"><i class="icon an an-sync-ar"></i> <span class="tooltip-label">Add to Compare</span></a>-->
</div>
<div class="button-set-bottom position-absolute">
<a class="btn-icon btn btn-addto-cart rounded" href="javascript:void(0)" onClick="<?php if(isset($_SESSION['user_id'])) { ?>  add_to_cart(<?php echo $prdt_id;?>) <?php } else { ?> toastr.error('Please login') <?php } ?>"><i class="icon an an-cart-l"></i> <span>Add To Cart</span></a>
</div>

<!--Countdown Timer-->


<!--End Product Button-->  
</div>
<!--End Product Image-->
<!--Start Product Details-->
<div class="product-details text-center">

<!--Product Price-->
<div class="product-price home_produc_price">
<!--<p class="m-0">towel</p>-->
<h5><?php 
if(strlen($product_neme) > 10)
{
echo substr($product_neme, 0, 10)."...";
}
else
{
 echo $product_neme;   
}
?></h5>
<span class="old-price"></span>
<span class="price">₹ <?php echo $prdt_prec;?></span>
</div>
<!--End Product Price-->
<!--Product Review-->
<!--<div class="product-review d-flex align-items-center justify-content-center">
<i class="an an-star"></i><i class="an an-star"></i><i class="an an-star"></i><i class="an an-star"></i><i class="an an-star-o"></i>
<span class="caption hidden ms-2">3 reviews</span>
</div>-->
<!--End Product Review-->


<!-- Product Button -->
<div class="button-action d-flex">
<div class="addtocart-btn">
<form class="addtocart" action="#" method="post">
<a class="btn pro-addtocart-popup" href="#pro-addtocart-popup"><i class="icon hidden an an-cart-l"></i>Add To Cart</a>
</form>
</div>
<div class="quickview-btn">
<a class="btn btn-icon quick-view quick-view-popup" href="javascript:void(0)" data-toggle="modal" data-target="#content_quickview"><i class="icon an an-search-l"></i> <span class="tooltip-label top">Quick View</span></a>
</div>
<div class="wishlist-btn">
<a class="btn btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To Wishlist</span></a>
</div>

</div>
<!-- End Product Button -->
</div>
<!--End Product Details-->
</div>
<?php 
}

?>
       
                                   
                                </div>
                            </div>
                            <!--End Product Grid-->
					
                    </div>
                </section>
                <!--End New Arrivals Product Grid-->
				
           
            </div>
            <!--End Body Container-->

            <!--Footer-->
            <?php include "include/footer.php"?>