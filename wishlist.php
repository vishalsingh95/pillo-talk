<?php include "include/header.php"?>
<?php 
if(!isset($_SESSION['user_id']))
{
    echo "<script>window.location='login.php';</script>";
}

?>
            <!--Body Container-->
            <div id="page-content">  
            	<div id="toast-container"></div>
            <div id="toast-container"></div>
                <!--Collection Banner-->
               	<div class="collection-header">
			<div class="collection-hero  d-flex justify-content-center align-items-center"style="background-color: #f2f2f2; height: 100px;opacity: 1;">
			<!--<div class="collection-hero__image"></div>-->
			<div class="container">
			<div class="row justify-content-between">
			<div class="col-md-3 col-md-offset-2">
			<h2 class="text-start">Wishlist</h2>
			</div>

			<div class="col-md-2 col-md-offset-2">
			<span class="text-md-end d-flex align-items-center">
			<i class="icon an an-home-l me-2"></i>
			<p>Wishlist</p>
			</span>
			</div>

			</div>
			</div>
			<!--End Collection Banner-->
			</div>
			</div>
                <!--End Collection Banner-->

                <!--Main Content-->
                <div class="container">
                    <!--Wishlist-->
               
                        <div class="wishlist-table table-content text-nowrap table-responsive py-2" id="wish_table">
                            <table class="table table-bordered align-middle">
                                <thead class="bg-light thead-bg">
                                    <tr>
                                        <th class="product-name text-center alt-font">Remove</th>
                                        <th class="product-price text-center alt-font">Images</th>
                                        <th class="product-name alt-font">Product</th>
                                        <th class="product-price text-center alt-font">Unit Price</th>
                                        <!--<th class="stock-status text-center alt-font">Stock Status</th>-->
                                        <th class="product-subtotal text-center alt-font">Add to Cart</th>
                                    </tr>
                                </thead>
                                <tbody>
                <?php 
                $clt_wsh_dtl="SELECT `products`.`product_name`,`wishlist`.`id` as `wishlist_id`,`products`.`id` as `prdt_id`,`products`.`product_image`,`products`.`price`
                FROM `wishlist`
                LEFT JOIN `products`
                ON `wishlist`.`product_id` = `products`.`id` where `wishlist`.`user_id`='$usr_id' ";
                $qst_clt_wsh_dtl=$db->query($clt_wsh_dtl);
                
                while($clct_clt_wsh_dtl=$qst_clt_wsh_dtl->fetch_assoc())
                {
                $prd_id=$clct_clt_wsh_dtl['prdt_id'];
                $prd_neme=$clct_clt_wsh_dtl['product_name'];
                $prd_img=$clct_clt_wsh_dtl['product_image'];
                $prdt_prec=$clct_clt_wsh_dtl['price'];
                $wish_list_id=$clct_clt_wsh_dtl['wishlist_id'];
                
                $expld_img = explode(", ",$prd_img);
                
                $dsp_frst_img=$expld_img[0];
                
                
                ?>
                                    <tr>
                                        <td class="product-remove text-center"><a href="javascript:void(0)" onClick="delete_wish(<?php echo $wish_list_id;?>)"  title="Remove"><i class="icon icon an an-times-l"></i></a></td>
                                        <td class="product-thumbnail text-center">
                                            <a href="products_details.php?id=<?php echo $prd_id;?>"><img src="<?php if($prd_img!='') { ?>admin/product_images/<?php echo $dsp_frst_img;?><?php } else { ?>admin/product_images/no_image/noimg.png<?php }?>" width="100" alt="" title=""></a>
                                        </td>
                                        <td class="product-name"><h6 class="mb-0" title="<?php echo $prd_neme;?>"><a href="products_details.php?id=<?php echo $prd_id;?>"><?php
if(strlen($prd_neme) > 15) {
   echo $prd_neme = substr($prd_neme, 0, 15)."...";
}
else
{
    echo $prd_neme;
}
?></a></h6></td>
                                        <td class="product-price text-center"><span class="amount fw-500">₹ <?php echo $prdt_prec;?></span></td>

                                        <td class="product-subtotal text-center"><a href="javascript:void(0)" onClick="<?php if(isset($_SESSION['user_id'])) {?>wish_to_cart(<?php echo $prd_id;?>,<?php echo $wish_list_id;?>)<?php } else { ?> toastr.error('Please login') <?php } ?>" class="btn btn-small rounded-1 text-nowrap">Add To Cart</a></td>
                                    </tr>
                                <?php 
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
              
                    <!--End Wishlist-->
                </div>
                <!--End Main Content-->
            </div>
            <!--End Body Container-->

            <!--Footer-->
           <?php include "include/footer.php"?>