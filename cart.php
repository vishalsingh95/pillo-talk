<?php include "include/header.php"?>
<?php
if(!isset($_SESSION['user_id']))
{
    echo "<script>window.location='login.php'</script>";
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
				<div class="col-md-3 col-md-offset-2">
				<h2 class="text-start">Cart</h2>
				</div>

				<div class="col-md-2 col-md-offset-2">
				<span class="text-md-end d-flex align-items-center">
				<i class="icon an an-home-l me-2"></i>
				<p>Cart</p>
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
                    <!--Cart Page-->
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                            <!--<div class="alert alert-success py-2 rounded-1 alert-dismissible fade show cart-alert" role="alert">
                                <i class="align-middle icon an an-truck icon-large me-2"></i><strong class="text-uppercase">Congratulations!</strong> You've got free shipping!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>-->
<div id="crt_tbl">
                            <form action="#" method="post" class="cart style1">
                                <table>
                                    <thead class="cart__row cart__header small--hide">
                                        <tr>
                                            <th class="action">&nbsp;</th>
                                            <th colspan="2" class="text-start">Product</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                       $clt_cart_dta="select `products`.`product_name`,`products`.`price` ,`products`.`product_image`,`cart`.`id` as `cart_id`,`cart`.`quantity`,`products`.`id` as `product_id` from `cart` left join  `products` ON  `cart`.`product_id`=`products`.`id` where `cart`.`user_id`='$usr_id'";
                        $qst_clt_cart_dta=$db->query($clt_cart_dta);
                                   $crt_count=mysqli_num_rows($qst_clt_cart_dta);
                                      $prdt_total=0;

while($clct_crt_Dtl=$qst_clt_cart_dta->fetch_assoc())
{
$prdt_cart_neme=$clct_crt_Dtl['product_name'];
$prdt_cart_price=$clct_crt_Dtl['price'];
$prdt_cart_qty=$clct_crt_Dtl['quantity'];
$prdt_cart_image=$clct_crt_Dtl['product_image'];
$prdt_cart_id=$clct_crt_Dtl['product_id'];
$cartt_iid=$clct_crt_Dtl['cart_id'];

$prdt_ttl_price=$prdt_cart_price*$prdt_cart_qty;
$prdt_total +=$prdt_ttl_price;
$prdt_cart_img_expld=explode(", ",$prdt_cart_image);
$prdt_frst_img=$prdt_cart_img_expld[0];
                                        ?>
                                        <tr class="cart__row border-bottom line1 cart-flex border-top">
    <td class="cart-delete text-center small--hide"><a href="javascript:void(0)" onClick="remove_cart(<?php echo $cartt_iid;?>)" class="btn btn--secondary cart__remove remove-icon position-static" data-bs-toggle="tooltip" data-bs-placement="top" ><i class="icon an an-times-r"></i></a></td>
    <td class="cart__image-wrapper cart-flex-item">
    <a href="products_details.php?id=<?php echo $prdt_cart_id;?>"><?php 
    if($prdt_cart_image!='')
    {
    ?>
<img class="lazyload" src="admin/product_images/<?php echo $prdt_frst_img;?>" data-src="admin/product_images/<?php echo $prdt_frst_img;?>" alt="<?php echo $prdt_cart_neme;?>" >
<?php 
    }
else
{
?>
<img class="blur-up lazyload" src="admin/product_images/no_image/noimg.png" data-src="admin/product_images/no_image/noimg.png" >
<?php 
}
?></a>
    </td>
    <td class="cart__meta small--text-left cart-flex-item">
    <div class="list-view-item__title">
  <a class="product-title" href="products_details.php?id=<?php echo $prdt_cart_id;?>" title="<?php echo $prdt_cart_neme;?>"><?php 
if(strlen($prdt_cart_neme) > 30)
{
echo substr($prdt_cart_neme, 0, 30)."...";
}
else
{
 echo $prdt_cart_neme;   
}
?></a>
    </div>
   
                                                <div class="cart-price d-md-none">
                                                    <span class="money fw-500"></span>
                                                </div>
                                            </td>
                                            <td class="cart__price-wrapper cart-flex-item text-center small--hide">
                                                <span class="money text-success">₹ <?php echo $prdt_cart_price;?></span>
                                            </td>
                                            <td class="cart__update-wrapper cart-flex-item text-end text-md-center">
                                                <div class="cart__qty d-flex justify-content-end justify-content-md-center">
                                                    <div class="qtyField">
                                                        <a class="qtyBtn minus" href="javascript:void(0);" onclick="minus_cart(<?php echo $cartt_iid;?>)"><i class="icon an an-minus-r"></i></a>
                                                        <input class="cart__qty-input qty" type="text" value="<?php echo $prdt_cart_qty;?>" pattern="[0-9]*" readonly/>
                                                        <a class="qtyBtn plus" href="javascript:void(0);" onclick="addition_cart(<?php echo $cartt_iid;?>)"> <i class="icon an an-plus-r"></i></a>
                                                    </div>
                                                </div>
                                                <a href="#" title="Remove" class="removeMb d-md-none d-inline-block text-decoration-underline mt-2 me-3">Remove</a>
                                            </td>
                                            <td class="cart-price cart-flex-item text-center small--hide">
                                                <span class="money fw-500 text-success">₹ <?php echo $prdt_ttl_price;?></span>
                                            </td>
                                        </tr>
<?php 
}
?>
                                    </tbody>
                                   
                                </table> 
								</div>
                            </form>                   
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4 cart-col">
                           <!-- <h5>Discount Codes</h5>
                            <form action="#" method="post">
                                <div class="form-group">
                                    <label for="address_zip">Enter your coupon code if you have one.</label>
                                    <input type="text" name="coupon" />
                                </div>
                                <div class="actionRow">
                                    <input type="button" class="btn btn--small rounded" value="Apply Coupon" />
                                </div>
                            </form>-->
                          <!--  <div class="cart-note mt-4">
                                <div class="form-group mb-0">
                                    <h5>Add a note to your order</h5>
                                    <textarea name="note" id="cart-note" class="form-control cart-note__input" rows="4" required=""></textarea>
                                </div>
                            </div>-->
                        </div>
                       
						
						
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 cart__footer">
                            <div class="solid-border" id="subtotalss">	
                            <?php if($crt_count > 0)
                            {
                            ?>
                            
							 <div class="row border-bottom pb-2">
                                    <span class="col-12 col-sm-12 cart__subtotal-title text-center p-2" style="background-color:#f7f7f7;font-weight:bold">CART TOTALS</span>
                                   </div>
                                <div class="row border-bottom pb-2">
                                    <span class="col-6 col-sm-6 cart__subtotal-title">Subtotal</span>
                                    <span class="col-6 col-sm-6 text-right text-black"><span class="money">₹ <?php echo $prdt_total;?></span></span>
                                </div>
                                <!--<div class="row border-bottom pb-2 pt-2">-->
                                <!--    <span class="col-6 col-sm-6 cart__subtotal-title">Tax</span>-->
                                <!--    <span class="col-6 col-sm-6 text-right text-success">$10.00</span>-->
                                <!--</div>-->
                                <div class="row border-bottom pb-2 pt-2">
                                    <span class="col-6 col-sm-6 cart__subtotal-title">Shipping</span>
                                    <span class="col-6 col-sm-6 text-right text-success">Free shipping</span>
                                </div>
                                <div class="row border-bottom pb-2 pt-2">
                                    <span class="col-6 col-sm-6 cart__subtotal-title"><strong>Grand Total</strong></span>
                                    <span class="col-6 col-sm-6 cart__subtotal-title cart__subtotal text-right text-black"><span class="money">₹ <?php echo $prdt_total;?></span></span>
                                </div>
                                <p class="cart__shipping m-0">Shipping &amp; taxes calculated at checkout</p>
                                <p class="cart__shipping pt-0 m-0 fst-normal freeShipclaim"><i class="me-1 align-middle icon an an-truck-l"></i><b>FREE SHIPPING</b> ELIGIBLE</p>
                                <div class="customCheckbox cart_tearm">
                                    <input type="checkbox" checked value="allen-vela" id="cart_tearm">
                                    <label for="cart_tearm">I agree with the terms and conditions</label>
                                </div>  
                                <a href="checkout.php" id="cartCheckout" class="btn btn--small-wide  mt-4 checkout twl_btn  rounded-pill">Proceed To Checkout</a>
                               <?php
                               }
                               
                               ?>
                            </div>
                        </div>
                    </div>
                    <!--End Cart Page-->
                </div>
                <!--End Main Content-->
            </div>
            <!--End Body Container-->

            <!--Footer-->
            
			<?php include "include/footer.php"?>