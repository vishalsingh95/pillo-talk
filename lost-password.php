<?php include "include/header.php"?>


            <!--Body Container-->
            <div id="page-content">   
            <div id="toast-container"></div>
                <!--Collection Banner-->
               <div class="collection-header">
				<div class="collection-hero  d-flex justify-content-center align-items-center"style="    background-color: #f2f2f2; height: 100px;opacity: 1;">
				<!--<div class="collection-hero__image"></div>-->
				<div class="container">
				<div class="row justify-content-between">
				<div class="col-md-3 col-md-offset-2">
				<h2 class="text-start">Lost password</h2>
				</div>

				<div class="col-md-2 col-md-offset-2">
				<span class="text-md-end d-flex align-items-center">
				<i class="icon an an-home-l me-2"></i>
				<p>Lost password</p>
				</span>
				</div>

				</div>
				</div>
				<!--End Collection Banner-->
				</div>
				</div>
                <!--End Collection Banner-->

                <!--Container-->
                <div class="container">
                    <!--Main Content-->
                    <div class="login-register pt-2 pt-lg-0">
                        <div class="row">
                            <div class="col-12 col-sm-12  col-md-8 mx-auto mb-4 ">
							<!--<h2 class="webtitle text-center mb-3"> <strong>LOGIN </strong></h2>-->
                                <div class="inner border-0">
                                    <div class="customer-form">	
										<p>Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.</p>
										<div id="forget_dv">
                                        <div class="row">
                                           
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="CustomerEmail"> email </label>
                            <input type="email" name="email" placeholder="Enter email" id="emnl" value="" required />
                                                </div>
                                            </div>
                                            
                                      
                                            <div class=" col-12 col-sm-12 col-md-12 text-center">
                                                <p class="text-center my-3">
        <input type="button" onClick="send_email()" class="btn twl_btn me-auto w-100" value="RESET PASSWORD">
                                                </p>
										   </div>
										   
										 	</div>
                                            </div>
                                            
                                            <div id="verification" style="display:none">
                                                 <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                        <label for="CustomerEmail">Enter Otp</label>
                        <input type="number" id="ootp" value="" required />
                        </div>
                        </div>
                                                
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                        <label for="CustomerEmail">new Password </label>
                        <input type="password"  id="passd" value="" required />
                        </div>
                        </div>
                        
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                        <label for="CustomerEmail">confirm Password </label>
                        <input type="password"  id="cpassd" value="" required />
                        </div>
                        </div>
                           <div class=" col-12 col-sm-12 col-md-12 text-center">
                                                <p class="text-center my-3">
        <input type="button" onClick="update_pswd()" class="btn twl_btn me-auto w-100" value="SUBMIT">
                                                </p>
										   </div>
                                 
                                                </div>
                                         
											
										
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Main Content-->
                </div>
                <!--End Container-->
                
                <script>
                function send_email()
                {
var email = $('#emnl').val();
$.ajax
(
{
url     : 'sent_otp_ajax.php',
type    : 'POST',
data    :{txt1:email},
success : function(resp)
{
var obj=jQuery.parseJSON( resp );
if(obj.status=='1')
{
toastr.success(obj.response)      
$('#forget_dv').hide();
$('#verification').show();

// $('#cart_intmes').load(window.location.href + ' #cart_intmes');
// $('#cart_ounts').load(window.location.href + ' #cart_ounts');

} 
else if(obj.status=='0')
{
toastr.warning(obj.response)        
}
},
error   : function(resp)
{
}  
}
);  
                 
                }
                
                
                
function update_pswd()
{
var email = $('#emnl').val();
var pwd = $('#passd').val();
var cpwd = $('#cpassd').val();
var otp = $('#ootp').val();

if(pwd==cpwd)
{
$.ajax
(
{
url     : 'update_paswd_ajax.php',
type    : 'POST',
data    :{txt1:email,txt2:pwd,txt3:otp},
success : function(resp)
{
var obj=jQuery.parseJSON( resp );
if(obj.status=='1')
{
toastr.success(obj.response)      

setTimeout(function() {
  window.location = "login.php"; // Replace with the URL you want to redirect to
}, 5000);
} 
else if(obj.status=='0')
{
toastr.warning(obj.response)        
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
toastr.error('Password and confirm password is not matched')   
}
}
                </script>
           
		   <?php include "include/footer.php"?>