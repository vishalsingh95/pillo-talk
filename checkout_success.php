<?php include "include/header.php";?>
	<?php 
	if(!isset($_SESSION['user_id']))
	{
	    echo "<script>window.location='login.php';</script>";
	}
	if(isset($_GET['ord_id']))
	{
	    $ord_id=$_GET['ord_id'];
	    
	    $clt_shp_dtl="select * from `address_of_orders` where `order_id`='$ord_id'";
	    $qst_clt_shp_dtl=$db->query($clt_shp_dtl);
	    $clct_clt_shp_dtl=$qst_clt_shp_dtl->fetch_assoc();
    
$ordr_date=$clct_clt_shp_dtl['order_date'];
$ordr_amount=$clct_clt_shp_dtl['order_total_amount'];

$shp_neme=$clct_clt_shp_dtl['name'];
$shp_lndmrk=$clct_clt_shp_dtl['landmark'];
$shp_cty=$clct_clt_shp_dtl['city'];
$shp_adrs=$clct_clt_shp_dtl['address'];  
$shp_pnced=$clct_clt_shp_dtl['pincode'];
$mbel_nber=$clct_clt_shp_dtl['mobile'];
$pymt_mthd=$clct_clt_shp_dtl['payment_type'];

$timestamp = strtotime($ordr_date);
$wordFormat = date("F j, Y g:i A", $timestamp);
}
?>

<!--Body Container-->
<style>
@media print {
#site-scroll{
display:none;
}
#header {
display:none;
}

.collection-header{

display:none;
}

.store-features{

display:none;
}

.newsletter-section{
display:none;
}
.footer {
display:none;
}
#pren_btn{

display:none;
}



}
</style>
            <div id="page-content">
                <!--Collection Banner-->
          	<div class="collection-header">
			<div class="collection-hero  d-flex justify-content-center align-items-center"style="background-color: #f2f2f2; height: 100px;opacity: 1;">
			<!--<div class="collection-hero__image"></div>-->
			<div class="container">
			<div class="row justify-content-between">
			<div class="col-md-3 col-md-offset-2">
			<h2 class="text-start">Order Success</h2>
			</div>

			<div class="col-md-2 col-md-offset-2">
			<span class="text-md-end d-flex align-items-center">
			<i class="icon an an-home-l me-2"></i>
			<p>Order Success</p>
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
                    <div class="checkout-success-content py-2">
                        <!--Order Card-->
                        <?php 
                        if(!isset($_GET['view_ord']))
                        {
                        ?>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="checkout-scard card border-0 rounded">
                                    <div class="card-body text-center">
                                        <p class="card-icon"><i class="icon an an-shield-check fs-1"></i></p>
                                        <h4 class="card-title">Thank you for your order!</h4>
                                        <p class="card-text mb-1">You will receive an order confirmation email with details of your order and a link to track its progress.</p>
                                        <p class="card-text mb-1">All necessary information about the delivery, we sent to your email</p>
                                        <p class="card-text text-order badge bg-success my-3">Your order id is: <b><?php echo $ord_id;?></b></p>
                                        <p class="card-text mb-0">Order date: <?php echo $wordFormat;    ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        }
                        ?>
                        <!--End Order Card-->
                        <!--Order Summary-->
                        <div class="row" id="myDiv">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="checkout-item-ordered">
                                    <h2 class="fs-6 mb-3">Order Summary (<span style="font-weight:650"><?php echo $ord_id;?>)</span></h2>
                                  <?php 
                        if(isset($_GET['view_ord']))
                        {
                        ?>  <h3 style="font-size:12px;">[Date:- <?php echo $wordFormat;    ?> ]</h3><?php }?>
                                    <div class="table-content table-responsive order-table mb-4">
                                        <table class="table table-bordered align-middle table-hover text-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="fw-bold">Image</th>
                                                    <th class="text-start fw-600">Product Name</th>
                                                    <th class="fw-600" style="width:100px;">Price</th>
                                                    <th class="fw-600">Qty</th>
                                                    <th class="fw-600" style="
    width: 100px;
">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
    <?php 
    $clct_ordr_dtls="select * from `orders` where `order_id`='$ord_id'";
    $qst_clct_ordr_dtls=$db->query($clct_ordr_dtls);
    while($clct_clct_ordr_dtls=$qst_clct_ordr_dtls->fetch_assoc())
    {
        
        $prdt_nemee=$clct_clct_ordr_dtls['product_name'];
        
        $prdt_img=$clct_clct_ordr_dtls['product_image'];
        $prdt_prce=$clct_clct_ordr_dtls['price'];
        $prdt_qnty=$clct_clct_ordr_dtls['quantity'];
        $prdt_iid=$clct_clct_ordr_dtls['product_id'];
        
        $prdt_imgg_epx=explode(", ",$prdt_img);
     
    ?>
<tr>
<td class="pro-img"><a href="products_details.php?id=<?php echo $prdt_iid;?>">
    <?php if($prdt_img!=''){ ?>
    <img class="primary blur-up lazyload" src="admin/product_images/<?php echo $prdt_imgg_epx[0];?>" alt="image" title="product" width="80" /><?php
    } else { ?>   <img class="primary blur-up lazyload" src="admin/product_images/no_image/noimg.png" alt="image" title="product" width="80" /> <?php } ?></a></td>
<td class="pro-name text-start">
<a href="products_details.php?id=<?php echo $prdt_iid;?>" class="d-block"><?php echo $prdt_nemee;?></a>

</td>
<td class="pro-price">₹ <?php echo $prdt_prce;?></td>
<td class="pro-qty"><?php echo $prdt_qnty;?></td>
<td class="pro-total fw-500">₹ <?php echo $prdt_prce*$prdt_qnty;?></td>
</tr>
    <?php 
    }
    ?>          
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4" class="item subtotal text-end fw-bolder">Subtotal:</td>
                                                    <td class="fw-500 last">₹ <?php echo $ordr_amount;?></td>
                                              
                                                </tr><tr>
                                                    <td colspan="4" class="item shipping text-end fw-bolder">Shipping:</td>
                                                    <td class="fw-500 last">Free</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="item total text-end fw-bolder">Grand Total:</td>
                                                    <td class="fw-500 last"><b>₹ <?php echo $ordr_amount;?></b></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6" style="
    margin-top: 35px;
">
        <div class="ship-info-details shipping-method-details">
        <div class="row g-0">
        <div class="col-12 col-sm-6 col-md-6 col-lg-6" >
        <div class="shipping-details mb-4 mb-sm-0 clearfix">
        <h3>Shipping Address</h3>
        <p> <b><?php echo $shp_neme;?> , <?php echo $mbel_nber?></b> </p>
        
        <p><?php echo $shp_adrs; ?></p>
        <p><?php echo $shp_cty?>, <?php echo $shp_pnced;?></p>
        <p><b>landmark :- <?php echo $shp_lndmrk;?></b></p>
        </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
        <div class="shipping-details mb-4 mb-sm-0 clearfix">
        <h3>Billing Address</h3>

        <p> <b><?php echo $usr_neme;?> , <?php echo $usr_mbbbl?></b> </p>
        
        <p><?php echo $shp_adrs; ?></p>
        <p><?php echo $shp_cty?>, <?php echo $shp_pnced;?></p>
        <p><b>landmark :- <?php echo $shp_lndmrk;?></b></p>
        </div>
        </div>
                                    </div>
                                </div>
                                <div class="ship-info-details billing-payment-details">
                                    <div class="row g-0">
                                      
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="billing-details clearfix">
                                                <h3>Payment Method</h3>
                                               
                                                <p><?php if($pymt_mthd=="COD") { ?> Cash on delivery <?php } else {
                                                ?>
                                                <?php echo $pymt_mthd;?>
                                                <?php
                                                } ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="pren_btn" class="d-flex-wrap w-100 mt-4 text-center">
                                    <a href="index.php" class="d-inline-flex align-items-center btn rounded me-2 mb-2 me-sm-3"><i class="me-2 icon an an-angle-left-r"></i>Continue Shopping</a> 
                                    <button type="button" id="printButton" class="d-inline-flex align-items-center btn rounded me-2 mb-2 me-sm-3"><i class="me-2 icon an an-print"></i>Print Order</button>
                                   <!-- 
                                    <button type="button" class="d-inline-flex align-items-center btn rounded me-2 mb-2 me-sm-3"><i class="me-2 icon an an-sync-ar"></i>Re-Order</button>-->
                                </div>
                            </div>
                        </div>
                        <!--End Order Summary-->
                    </div>
                </div>
                <!--End Main Content-->
            </div>
            <!--End Body Container-->


<script>
$(document).ready(function() {
  $('#printButton').click(function() {
     window.print();
  });
});
</script>
            <!--Footer-->
            <?php include "include/footer.php"?>