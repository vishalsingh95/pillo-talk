<?php include  "include/header.php"?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php 
if(isset($_GET['ctgy_id']))
{
    $ctg_id=$_GET['ctgy_id'];
    
    $clt_ctgy_dtl="select * from `product_category` where `id`='$ctg_id'";
    $qst_clt_ctgy_dtl=$db->query($clt_ctgy_dtl);
    $clct_clt_ctgy_dtl=$qst_clt_ctgy_dtl->fetch_assoc();
    
    $ctgy_nenem=$clct_clt_ctgy_dtl['name'];
    
    $clt_latest_products="select * from products where `category_id`='$ctg_id' order by `id` desc";
$qst_clt_latest_products=$db->query($clt_latest_products);
$prdt_cnt=mysqli_num_rows($qst_clt_latest_products);
}
else
{
$clt_latest_products="select * from products order by `id` desc";
$qst_clt_latest_products=$db->query($clt_latest_products);
$prdt_cnt=mysqli_num_rows($qst_clt_latest_products);
}
?>
            <!--Body Container-->
            <div id="page-content">
                <!--Collection Banner-->
               <div class="collection-header">
				 <div class="collection-hero  d-flex justify-content-center align-items-center"style="    background-color: #f2f2f2; height: 100px;opacity: 1;">
                        <!--<div class="collection-hero__image"></div>-->
						<div class="container">
						<div class="row justify-content-between">
						<div class="col-md-2 col-md-offset-2">
                        <h2 class="text-start"><?php if(isset($_GET['ctgy_id'])){ echo $ctgy_nenem; } else { echo "All";}?> Products </h2>
                         <!-- <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="index.html" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Compare Product Style1</span></div>-->
                        </div>
						
						<div class="col-md-2 col-md-offset-2 ">
						<span class="text-md-end d-flex align-items-center">
					<a href="index.php"><i class="icon an an-home-l me-2"></i></a>
						<p><?php if(isset($_GET['ctgy_id'])){ echo $ctgy_nenem; } else { echo "All";}?> Products </p>
						</span> 
						<!-- <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="index.html" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Compare Product Style1</span></div>-->
                        </div>
						
						</div>
						</div>
                <!--End Collection Banner-->
               </div>
            </div>
                <!--End Collection Banner-->

                <div class="container-fluid">
                    <div class="row">
                        <!--Sidebar-->
                       

                        <!--Main Content-->
                      
        <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
                            <div class="closeFilter d-block d-lg-none"><i class="icon icon an an-times-r"></i></div>
                            <div class="sidebar_tags">
                                <!--Categories-->
        <div class="sidebar_widget categories filterBox filter-widget">
            <div class="widget-title"><h2 class="mb-0">Categories</h2></div>
            <div class="widget-content filterDD">
                    <ul class="clearfix sidebar_categories mb-0">
                        <?php 
                        
                        $clt_ctgy_dtl="select * from `product_category`";
                        $qst_clt_ctgy_dtl=$db->query($clt_ctgy_dtl);
    while($clct_clt_ctgy_dtl=$qst_clt_ctgy_dtl->fetch_assoc())
{
    $ctgy_id=$clct_clt_ctgy_dtl['id'];
    $ctgy_neme=$clct_clt_ctgy_dtl['name'];
    
    
    
    
    
    
                        ?>
        <li class="lvl-1"><a href="shop.php?ctgy_id=<?php echo $ctgy_id;?>" class="site-nav"><?php echo $ctgy_neme; ?></a>
                                           
                                            </li>
                                          <?php 
}
                                          ?>  
                                        </ul>
                                    </div>
                                </div>
                                <!--Categories-->
                                <!--Price Filter-->
                               
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                            <!--Active Filters-->
                            <ul class="active-filters d-flex flex-wrap align-items-center m-0 list-unstyled d-none">
                                <li><a href="#">Clear all</a></li>
                                <li><a href="#">Men <i class="an an-times-l"></i></a></li>
                                <li><a href="#">Neckalses <i class="an an-times-l"></i></a></li>
                                <li><a href="#">Accessories <i class="an an-times-l"></i></a></li>
                            </ul>
                            <!--End Active Filters-->
                            <!--Toolbar-->
                            <div class="toolbar mt-0">
                                <div class="filters-toolbar-wrapper">
                                    <ul class="list-unstyled d-flex align-items-center">
                                        <li class="product-count d-flex align-items-center">
                                            <div class="filters-toolbar__item">
                                                <span class="filters-toolbar__product-count d-none d-sm-block">Showing: <?php echo $prdt_cnt;?> products</span>
                                            </div>
                                        </li>
                                        <li class="product-count d-flex align-items-center">
                                            <button type="button" class="btn btn-filter an an-slider-3 d-inline-flex d-lg-none me-2 me-sm-3"><span class="hidden">Filter</span></button>
                                            
                                        </li>
                                        <li class="collection-view ms-sm-auto">
                                            <div class="filters-toolbar__item collection-view-as d-flex align-items-center me-3">
                                                <a href="javascript:void(0)" class="change-view prd-grid change-view--active"><i class="icon an an-th" aria-hidden="true"></i><span class="tooltip-label">Grid View</span></a>
                                                <!--<a href="javascript:void(0)" class="change-view prd-list"><i class="icon an an-th-list" aria-hidden="true"></i><span class="tooltip-label">List View</span></a>-->
                                            </div>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <!--End Toolbar-->

                            <!--Product Grid-->
                            <div class="grid-products grid--view-items shop-grid-5 prd-grid">
                                <div class="row">
                                   <?php

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
   
   
   
   
   
  $clt_whs_count="select count(`id`) as `wishcount` from `wishlist` where `product_id`='$prdt_id' and `user_id`='$usr_id'";
   $qst_clt_whs_count=$db->query($clt_whs_count);
   $clct_whs_count = $qst_clt_whs_count->fetch_assoc();
   
   
  $whish_count=$clct_whs_count['wishcount'];
   
   
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
<a class="btn-icon wishlist add-to-wishlist rounded" href="javascript:void(0);" onClick="<?php if(isset($_SESSION['user_id'])) { ?> add_wishlist(<?php echo $prdt_id;?>); <?php } else { ?> alert('Please login') <?php } ?>" id="like<?php echo $prdt_id?>"><?php if($whish_count==0) { ?><i style="font-size:24px;color:#F9B5B2" class="fa">&#xf08a;</i> <span class="tooltip-label">Add To Wishlist</span><?php } else { ?><i class="icon an an-heart"></i> <span class="tooltip-label">Remove To Wishlist</span><?php } ?></a>
<a class="btn-icon quick-view-popup quick-view rounded" href="javascript:void(0)" data-toggle="modal" onClick="get_product_data(<?php echo $prdt_id;?>)" data-target="#content_quickview"><i class="icon an an-search-l"></i> <span class="tooltip-label">Quick View</span></a>
<!--<a class="btn-icon compare add-to-compare rounded" href="compare-style2.html"><i class="icon an an-sync-ar"></i> <span class="tooltip-label">Add to Compare</span></a>-->
</div>
<div class="button-set-bottom position-absolute">
<a class="btn-icon btn btn-addto-cart rounded" href="javascript:void(0)" onClick="<?php if(isset($_SESSION['user_id'])) { ?>  add_to_cart(<?php echo $prdt_id;?>) <?php } else { ?> toastr.error('Please login') <?php } ?>"><i class="icon an an-cart-l"></i> <span>Add To Cart</span></a>
</div>
<?php if(isset($_SESSION['user_id'])) ?>

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
<div class="compare-btn">
<a class="btn btn-icon compare add-to-compare" href="compare.html"><i class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to Compare</span></a>
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

                          
                            <!--  <hr class="clear">
								<div class="pagination">
                                <ul>
                                    <li class="prev"><a href="#"><i class="icon align-middle an an-caret-left" aria-hidden="true"></i></a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">...</a></li>
                                    <li><a href="#">5</a></li>
                                    <li class="next"><a href="#"><i class="icon align-middle an an-caret-right" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                           

                           
                            <div class="collection-description mt-4 pt-2">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard reader dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen the book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </div>-->
                            
                        </div>
                        <!--End Main Content-->
                    </div>
                </div>
            </div>
            <!--End Body Container-->

<?php include "include/footer.php"?>