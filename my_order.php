<?php include "include/header.php"?>
<?php
if(!isset($_SESSION['user_id']))
{
    echo "<script>window.location='login.php';</script>";
}

?>

            <!--Body Container-->
            <div id="page-content">
                <!--Collection Banner-->
               <div class="breadcrumbs-wrapper text-uppercase mt-2">
                    <div class="container">
                        <div class="breadcrumbs"><a href="index.php" title="Back to the home page">Home</a><span>|</span> <a href="javascript:void(0)">Order </a><span>|</span><span class="fw-bold">My Order</span></div>
                    </div>
                </div>
                <!--End Collection Banner-->

                <!--Container-->
                <div class="container pt-2">
                    <!--Main Content-->
                   
                    <div class="row ">
                     <div class="col-xl-12 col-lg-12 col-md-12">
                            <!-- Tab panes -->
                            
                            
                            <?php
                            $ord_dtl="select * from `address_of_orders` where `user_id`='$usr_id' order by `id` DESC";
                            $qst_ord_dtl=$db->query($ord_dtl);
                            while($clct_ord_dtl=$qst_ord_dtl->fetch_assoc())
                            {
                                $ord_id=$clct_ord_dtl['order_id'];
                                $ord_dete=$clct_ord_dtl['order_date'];
                                $order_word_date=date("M jS, Y", strtotime("$ord_dete"));
                            ?>
                            
                          <div class="your-order-payment mb-4">
                                <div class="your-order">
                                    <h2 class="order-title mb-3">Order id # <?php echo $ord_id;?> </h2>
                                    <h3 style="font-size:12px;">[Date:- <?php echo $order_word_date;?> ]</h3>
                                    <div class="table-responsive order-table style2"> 
                                        <table class="bg-white table table-bordered align-middle table-hover text-center mb-1">
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
$clt_ord_dtl="select * from `orders` where `user_id`='$usr_id' and `order_id`='$ord_id'";
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
$ordr_prdt_id=$clct_clt_ord_dtl['id'];

$expl_prdt=explode(", ",$prdt_img);
?>
                                                <tr>
        <td class="text-start"><?php echo $sno++?></td>
        <td class="thumbImg"><a href="products_details.php?id=<?php echo $prdt_iid;?>" class="thumb d-inline-block"><img class="cart__image" src="admin/product_images/<?php echo $expl_prdt[0];?>" alt="<?php echo $prdt_neme;?>" width="100"></a></td>
        <td style="width:200px;">
        <a href="products_details.php?id=<?php echo $prdt_iid;?>"><?php echo $prdt_neme;?></a>
        
        </td>
        
        <td>₹ <?php echo $prdt_prece;?></td>
        <td><?php echo $prdt_qnty;?></td>
        
        <td>₹ <?php echo $prdt_prece*$prdt_qnty;?></td>
        <td class="text-success"><b><?php echo $prdt_stts;?></b></td>
        <td><?php if($prdt_stts!="Canceled") { ?><button data-bs-toggle="modal" data-bs-target="#cancel_order_modal" type="button" onClick="order_data(<?php echo $ordr_prdt_id;?>)" class="btn btn-small text-transform-none">Cancel order</button> <?php 
        }
        ?></td>
                                                </tr>
                                                
<?php 
}
?>                                          
<tr><td colspan="7"></td><td>
    <a href="checkout_success.php?ord_id=<?php echo $ord_id; ?>&view_ord=1" class="btn btn-primary" >View Order details</a></td></tr>
                                                
                                            </tbody>
                                          
                                        </table>
                                    </div>
                                    
                                  
                                </div>

                            </div>
                            <?php 
                            }
                            ?>
                            
							<!--order -->
                        </div>
                        
                        
                        
                        
                        
                        
        <!---------Bootstrap modal start------------->

<div class="modal fade" id="cancel_order_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cancellation of Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div id="cancel_div">
      
      </div>
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>

<!-----------Bootstrap modal end----------->
                    </div>
                    <!--End Main Content-->
                </div>
                <!--End Container-->
            </div>
            <!--End Body Container-->

            <!--Footer-->
            
<script>
function order_data(txt)
{
$.ajax
(
{
url: "order_prdt_data_ajax.php",
type: "POST",
data    : {txt1:txt},
cache: false,
success: function(data)
{

$('#cancel_div').html(data);
}
}
);
}
                
            </script>
           <?php include "include/footer.php"?>