<?php 
include("admin/config/config.php");

if(isset($_SESSION['user_id']))
{
$ordr_product_id=$_POST['txt1'];

$clt_ord_dtl="select * from `orders` where `id`='$ordr_product_id'";
$qst_clt_ord_dtl=$db->query($clt_ord_dtl);
$sno=1;
$clct_clt_ord_dtl=$qst_clt_ord_dtl->fetch_assoc();


$prdt_img=$clct_clt_ord_dtl['product_image'];
$prdt_neme=$clct_clt_ord_dtl['product_name'];
$prdt_prece=$clct_clt_ord_dtl['price'];
$prdt_qnty=$clct_clt_ord_dtl['quantity'];
$prdt_stts=$clct_clt_ord_dtl['status'];
$prdt_iid=$clct_clt_ord_dtl['product_id'];
$ord_id=$clct_clt_ord_dtl['order_id'];
$ordr_prdt_id=$clct_clt_ord_dtl['id'];

$expl_prdt=explode(", ",$prdt_img);
?>
<div class='row'>
<div class="col-12 col-sm-12 col-md-12 col-lg-6">
<div class="checkout-item-ordered">
<h2 class="fs-6 mb-3">Order Id (<span style="font-weight:650"><?php echo $ord_id;?>)</span></h2>

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
">Status</th>
<th class="fw-600" style="
width: 100px;
">Subtotal</th>


</tr>
</thead>
<tbody>


<tr>
<td class="pro-img"><a href="products_details.php?id=3">
<img class="primary blur-up lazyloaded" src="admin/product_images/<?php echo $expl_prdt[0]?>" alt="image" title="product" width="80"></a></td>
<td class="pro-name text-start">
<a href="products_details.php?id=3" class="d-block"><?php echo $prdt_neme;?></a>

</td>
<td class="pro-price">₹ <?php echo $prdt_prece;?></td>
<td class="pro-qty"><?php echo $prdt_qnty;?></td>
<td class="pro-total fw-500"><?php echo $prdt_stts;?></td>
<td class="pro-total fw-500">₹ <?php echo $prdt_prece*$prdt_qnty;?></td>

</tr>

</tbody>
<tfoot>
<tr>
<td colspan="5" class="item subtotal text-end fw-bolder">Subtotal:</td>
<td class="fw-500 last">₹ <?php echo $prdt_prece*$prdt_qnty;?></td>

</tr>
<tr>
<td colspan="5" class="item total text-end fw-bolder">Grand Total:</td>
<td class="fw-500 last"><b>₹ <?php echo $prdt_prece*$prdt_qnty;?></b></td>
</tr>
</tfoot>
</table>
</div>
</div>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-6">
<form action="" method="POST"> 
<div class="checkout-item-ordered">
<h2 class="fs-6 mb-3" style="
text-transform: capitalize;
">Reason for cancellation</span></h2>

<textarea class="form-control" id="cancel_reason" placeholder="Enter Reason for cancellation "></textarea>
<button type="button" onClick="cancel_orddd()" class='btn btn-primary mt-2'>Submit Request</button>

</div>   
</form>
</div>

</div>

<script>
function cancel_orddd()
{
    var reason=$('#cancel_reason').val();
    if(reason!='')
    {
    $.ajax
(
{
url     : 'cancell_order_ajax.php',
type    : 'POST',
data    :{txt1:<?php echo $ordr_product_id;?>,txt2:reason},
success : function(resp){
var obj=jQuery.parseJSON( resp );
if(obj.status==1)
{
alert('Order Cancelled successfully');
$('#order_diiiv').load(window.location.href + (' #order_diiiv'));
$('#cancel_order_modal').modal('hide');
}
},
error   : function(resp)
{
}  
}
);
}
else
{
    alert('Please Fill Cancellation reason');
}
}
</script>
<?php
}
else
{
?>
<center><h3>Your Session is out please refresh and login</h3></center>
<?php
    
}
?>