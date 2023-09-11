<?php include "include/header.php"?>

<?php 
if(!isset($_SESSION['user_id']))
{
    echo "<script>window.location='login.php'</script>";
}
?>
            <!--Body Container-->
            <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <div id="page-content">
                			<div id="toast-container"></div>
                <!--Collection Banner-->
                 <div class="collection-header">
				<div class="collection-hero  d-flex justify-content-center align-items-center"style="    background-color: #f2f2f2; height: 100px;opacity: 1;">
				<!--<div class="collection-hero__image"></div>-->
				<div class="container">
				<div class="row justify-content-between">
				<div class="col-md-3 col-md-offset-2">
				<h2 class="text-start">Checkout</h2>
				</div>

				<div class="col-md-2 col-md-offset-2">
				<span class="text-md-end d-flex align-items-center">
				<i class="icon an an-home-l me-2"></i>
				<p>Checkout</p>
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
                
                    <div class="row billing-fields" id="shh_addresses">
                        <div class="col-lg-6 col-md-12 col-sm-12 mb-3 mb-lg-0" id="">
                            
                            <!---------My new div start--------->
                              <?php 
                              
                              $clt_shp_adrs="select * from `shipping_address` where `user_id`='$usr_id'";
                              $qst_clt_shp_adrs=$db->query($clt_shp_adrs);
                              while($clct_clt_shp_adrs=$qst_clt_shp_adrs->fetch_assoc())
                              {
                            $sh_neme=$clct_clt_shp_adrs['name'];
                            $sh_mbel=$clct_clt_shp_adrs['mobile'];
                            $sh_lndmrk=$clct_clt_shp_adrs['landmark'];
                            $sh_cty=$clct_clt_shp_adrs['city'];
                            $sh_adrs=$clct_clt_shp_adrs['address'];
                            $sh_pncode=$clct_clt_shp_adrs['pincode'];
                            $sh_iid=$clct_clt_shp_adrs['id'];
                                  
                              
                              ?>
                              
                               <label for="sh<?php echo $sh_iid;?>"  onClick="chose_opton(<?php echo $sh_iid;?>)">
                             <div class="create-ac-content mb-2"  >
                            
                                    <fieldset >
                                        <input type="radio" class="raidos" id="sh<?php echo $sh_iid;?>" name="fav_language" value="HTML">  <button type="button" style="float:right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal" onClick="fetch_shipping_data(<?php echo $sh_iid;?>)">Edit </button>
                                        <h2 class="login-title mb-3" >Shipping Address</h2>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-lg-12">
                                                <span><?php echo $sh_neme;?> - <b><?php echo $sh_mbel;?></b></span><br>
                                                 <span for="input-firstname"><?php echo $sh_adrs;?> <?php echo $sh_cty;?>  </span><br>
                                                 <span><b>Pincode :- <?php echo $sh_pncode;?> &nbsp , Landmark :- <?php echo $sh_lndmrk;?></b></span>
                                                 
                                            </div>
                                            
                                        </div>
                                        
                                    </fieldset>
                                    
                                    
                                
                            </div>
                            </label>
                          <?php 
                              }
                          ?>
                            <!---------My new dvi end------------------->
                             
                              <div class="create-ac-content mb-2" onClick="add_new_address()" style="cursor:pointer;">
                                
                                    <fieldset>
                                       
                                        <h2 class="login-title mb-3" style="cursor:pointer;color: #2323c7;">+ Add new Address</h2>
                                        
                                        
                                    </fieldset>
                                    
                              
                            </div>
                        
                            
                            <div class="create-ac-content mt-3 mb-5" id="shipping_add_form" style="display:none">
                                <form id="add_shipping" action="" method="POST">
                                    <fieldset>
                                        <h2 class="login-title mb-3">Add new shipping address</h2>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="input-firstname">Name <span class="required-f">*</span></label>
                                                <input name="name" id="input-firstname" type="text" required>
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="input-telephone">Mobile <span class="required-f">*</span></label>
                                                <input name="mobile"  id="input-telephone" type="tel" required>
                                            </div>
                                        </div>
                                       
                                       <div class="row">
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="sst-firstname">Landmark <span class="required-f">*</span></label>
                                                <input name="landmark" value="" id="input-firstname" type="text" required>
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="inpsdfut-telephone">City <span class="required-f">*</span></label>
                                                <input name="city" value="" id="inpsdfut-telephone" type="text" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                              <div class="form-group col-md-6 col-lg-6">
                                                <label for="input-address-1">Address <span class="required-f">*</span></label>
                                                <input name="address" value="" id="input-address-1" type="text" required>
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="input-company">Pincode</label>
                                                <input name="pincode" value="" id="input-company" type="text" required>
                                            </div>
                                          
                                        </div>
                                        <div class='row'>
                                        <input type='submit' class="fs-6 btn twl_btn  rounded-pill btn-lg  w-100  fw-600 text-white" style="background:#325aa7" value="save">
                                            </div>
                                       
                                       
                                        
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="your-order-payment mb-3">
                                <div class="your-order">
                                    <h2 class="order-title mb-3">Your Order</h2>
                                    <div class="table-responsive order-table style2" id="checkout_dv"> 
                                        <table class="bg-white table table-bordered align-middle table-hover text-center mb-1">
                                            <thead>
                                                <tr>
                                                    <th class="text-start">Product Name</th>
                                                    <th>Price</th>
                                                    <th>Qty</th>
                                                    <th>Subtotal</th>
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
                                                <tr>
                                                    <td class="text-start">
                                                        <a href="products_details.php?id=<?php echo $prdt_cart_id;?>"><?php 
if(strlen($prdt_cart_neme) > 30)
{
echo substr($prdt_cart_neme, 0, 30)."...";
}
else
{
 echo $prdt_cart_neme;   
}
?></a>
                                                        
                                                    </td>
                                                    <td>₹ <?php echo $prdt_cart_price?></td>
                                                
                                                    <td><?php echo $prdt_cart_qty?></td>
                                                    <td class="text-success">₹ <?php echo $prdt_ttl_price; ?></td>
                                                </tr>
                                               <?php 
}
                                               ?>
                                            </tbody>
                                            <tfoot class="font-weight-600">
                                                <tr>
                                                    <td colspan="3" class="text-end fw-bolder">Shipping </td>
                                                    <td class="fw-bolder text-success">Free</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end fw-bolder">Total</td>
                                                    <td class="fw-bolder text-success">₹ <?php echo $prdt_total; ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <hr>
                         <div id="plc_oder_adrrs">
                         <?php 
                         if($crt_cnt > 0)
{
                         ?>       
<form id="place_order" action="" method="POST">
                                <div class="your-payment">
                                    <h2 class="payment-title mb-3">payment method</h2>
                                    <div class="payment-method">
                                        <div class="payment-accordion">
                                            <div class="accordion" id="accordionExample">
                    <input type="text" name="address_id" id="address_id" style="display:none;">              
                            <select name="payment_method" id="paymethd" onChange="choose_method(this.value)" class="form-control">
                            <option value="">Choose method</option>
                            <option value="COD">COD</option>
                            <option value="ONLINE">Pay Online</option>
                            </select> 

                                       
                                            </div>
                                        </div>
                                        <div class="order-button-payment mt-3 clearfix">
                                            <button type="submit" class="fs-6 btn twl_btn  rounded-pill btn-lg  w-100  fw-600 text-white">Place order</button>
                                        </div>
                                    </div>
                                </div>
</form>
 
 <?php 
}
 ?>      
 </div>
 </div>
                        </div>
                    </div>
                </div>
                
                
                
                
                <!---------Edit Shipping address modal start------------>
                <!-- Modal -->
<div class="modal fade" id="edit_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit shipping address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <form id="edt_shipping" action="" method="POST">
    <fieldset>
   
    <div class="row">
    <div class="form-group col-md-6 col-lg-6">
    <label for="input-firstname">Name <span class="required-f">*</span></label>
    <input name="edtname" id="edtname" type="text" required="">
    </div>
    <div class="form-group col-md-6 col-lg-6">
    <label for="input-telephone">Mobile <span class="required-f">*</span></label>
    <input name="edtmobile" id="edtmobile" type="tel" required="">
    </div>
    </div>
    
    <div class="row">
    <div class="form-group col-md-6 col-lg-6">
    <label for="sst-firstname">Landmark <span class="required-f">*</span></label>
    <input name="edtlandmark" id="edtlandmark" type="text" required="">
    </div>
    <div class="form-group col-md-6 col-lg-6">
    <label for="inpsdfut-telephone">City <span class="required-f">*</span></label>
    <input name="edtcity" id="edtcity" type="text" required="">
     <input type="text" name="shp_id" id="shp_id" style="display:none">
    </div>
    </div>
    <div class="row">
    <div class="form-group col-md-6 col-lg-6">
    <label for="input-address-1">Address <span class="required-f">*</span></label>
    <input name="edtaddress" id="edtaddress" type="text" required="">
    </div>
    <div class="form-group col-md-6 col-lg-6">
    <label for="input-company">Pincode</label>
    <input name="edtpincode" id="edtpincode" type="text" required="">
   
    </div>
    
    </div>
    <div class="row">
 <button type="submit" class="btn btn-primary" style="
    margin-left: 13px;
">Update</button>
    </div>
    
    
    
    </fieldset>
    </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
                <!---------Edit Shipping address modal end--------->
                
                
                
                <!--End Main Content-->
            </div>
            <!--End Body Container-->

<script>
function add_new_address()
{

$('#shipping_add_form').slideDown('slow');

$('.raidos').prop('checked', false);
$('#address_id').val('');
}

function chose_opton(txt)
{
$('#shipping_add_form').slideUp('slow');

$('#address_id').val(txt);
}
</script>

<script>
 $(document).ready(function() {
$('#edt_shipping').submit(function(event) {
event.preventDefault();

var formData = $(this).serialize();

$.ajax({
url: "edit_shipping_ajax.php",
type: "POST",
data: formData,
success: function(resp) {
    var obj=jQuery.parseJSON( resp );
// Handle the response from the server
if(obj.status=="1")
{
//toastr.success(obj.response)     
alert(obj.response);
    $('#shh_addresses').load(window.location.href + ' #shh_addresses');
    $('#edit_modal').modal('hide');
    window.location='';
}
else
{
  //toastr.warning(obj.response)      
alert(obj.response);
}
    
},
error: function(jqXHR, textStatus, errorThrown) {
// Handle any errors that occurred during the request
console.error(errorThrown);
}
});
});
});
            </script>
            <script>
            $(document).ready(function() {
$('#add_shipping').submit(function(event) {
event.preventDefault(); // Prevent the default form submission

var formData = $(this).serialize();

$.ajax({
url: "add_shipping_ajax.php",
type: "POST",
data: formData,
success: function(resp) {
    var obj=jQuery.parseJSON( resp );
// Handle the response from the server
if(obj.status=="1")
{
//toastr.success(obj.response)     
  alert(obj.response);
    $('#add_shipping')[0].reset();
    $('#shh_addresses').load(window.location.href + ' #shh_addresses');
    window.location='';
}
else
{
    alert(obj.response);
 // toastr.warning(obj.response)          
}
    
},
error: function(jqXHR, textStatus, errorThrown) {
// Handle any errors that occurred during the request
console.error(errorThrown);
}
});
});
});

$(document).ready(function() {
$('#place_order').submit(function(event) {
event.preventDefault(); // Prevent the default form submission

var formData = $(this).serialize();

$.ajax({
url: "place_order_ajax.php",
type: "POST",
data: formData,
success: function(resp) {
    var obj=jQuery.parseJSON( resp );
// Handle the response from the server
if(obj.status=="1")
{
//toastr.success(obj.response)     
  
   alert(obj.response);
$('#cart_intmes').load(window.location.href + ' #cart_intmes');
$('#cart_ounts').load(window.location.href + ' #cart_ounts');
$('#crt_tbl').load(window.location.href + ' #crt_tbl');
$('#subtotalss').load(window.location.href + ' #subtotalss');

$('#checkout_dv').load(window.location.href + ' #checkout_dv');
$('#shh_addresses').load(window.location.href + ' #shh_addresses');

      setTimeout(function() {
     window.location='checkout_success.php?ord_id='+obj.order_id;
    }, 3000);
}
else if(obj.status==2)
{
  
  
  //razorpay start
  var pymt_mthd=$('#paymethd').val();
  var adrs_id=$('#address_id').val();
  var amt = <?php echo $prdt_total;?>;
  var name = "<?php echo $usr_neme;?>";
    jQuery.ajax({
    type:'post',
    url:'payment_process.php',
    data:{amt:amt,name:name,address_id:adrs_id,payment_method:pymt_mthd},
    
    success:function(result){
    var options = {
    "key": "rzp_test_uyjwTZ4f2Hw97d", 
    "amount": amt*100, 
    "currency": "INR",
    "name": "Vallabh textiles",
    "description": "Test Transaction",
    "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
    "handler": function (response){
    jQuery.ajax({
    type:'post',
    url:'payment_process.php',
    data: {payment_id:response.razorpay_payment_id,amt:amt,name:name,address_id:adrs_id,payment_method:pymt_mthd},
    
    
    
    
    success:function(result){
    var obj=jQuery.parseJSON( result );
    window.location.href="checkout_success.php?ord_id="+obj.order_id;
    }
    });
    }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
    }
    });
  //razorpay end
  
  
}
else
{
    //toastr.warning(obj.response);
    alert(obj.response);
}
    
},
error: function(jqXHR, textStatus, errorThrown) {
// Handle any errors that occurred during the request
console.error(errorThrown);
}
});
});

});



function fetch_shipping_data(txt)
{
 $.ajax
(
{
url     : 'get_shipping_data_ajax.php',
type    : 'POST',
data    :{txt1:txt},
success : function(resp)
{
var obj=jQuery.parseJSON( resp );
if(obj.status==1)
{
   
$('#edtname').val(obj.data.name);
$('#edtmobile').val(obj.data.mobile);
$('#edtlandmark').val(obj.data.landmark);
$('#edtcity').val(obj.data.city);
$('#edtaddress').val(obj.data.address);
$('#shp_id').val(obj.data.id);
$('#edtpincode').val(obj.data.pincode);



}
}
});
    
}

function choose_method(txt)
{
   
}
            </script>
            
            
			<?php include "include/footer.php"?>