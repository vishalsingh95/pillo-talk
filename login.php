<?php include "include/header.php"?>

<?php 
if(isset($_SESSION['user_id']))
{
?>
<script>
window.location='index.php';
</script>
<?php
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
				<h2 class="text-start">Login</h2>
				</div>

				<div class="col-md-2 col-md-offset-2 ">
				<span class="text-md-end d-flex align-items-center">
				<i class="icon an an-home-l me-2"></i>
				<p>Login</p>
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
                    
                    
                    <div id="toast-container"></div>

                    <div class="login-register pt-2 pt-lg-5">
                        <div class="row">
                            <div class="col-12 col-sm-12  col-md-8 mx-auto mb-4 ">
							<h2 class="webtitle text-center mb-3"> <strong>LOGIN </strong></h2>
                                <div class="inner">
                <form method="post" action="" class="customer-form">	
									
                        <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                            <label for="CustomerEmail">Mobile or email address  <span class="required">*</span></label>
                            <input type="text" name="email" placeholder="Email" id="CustomerEmail" required />
                                </div>
                                </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
   
<label for="CustomerPassword" >Password <span class="required">*</span></label>
<input type="password" name="password" placeholder="Password" id="CustomerPassword" value="" required />                        	
        </div>
        </div>
											
	</div>
                            <div class="row">
                            <div class=" col-12 col-sm-12 col-md-12 text-center">
                            <p class="text-center my-3">
                            <input type="submit" name="login" class="btn twl_btn me-auto w-50" value="Log In">
                            
                            </p>
                            <p style="display: flex; justify-content: space-between;">
                            <span class="fw-bold text-start">	Lost your <a href="lost-password.php" style="color:#318cc9;"> password? </a></span>
                            <span class="fw-bold text-end"> If you don't  <a href="register.php"style="color:#318cc9;"> have an account?</a></span>
                            </p>
                            </div>
                            </div>
                                    </form>
  
                                    
                        <?php 
                        if(isset($_POST['login']))
                        {
                        $emnl = $_POST['email'];
                        $password = $_POST['password'];
                        
                        $mdf_pswd=md5($password);
                        
                        $clt_dtl="select * from users where (`email`='$emnl' or `mobile`='$emnl') and `password`='$mdf_pswd'";
                        $qst_clt_dtl=$db->query($clt_dtl);
                        $usr_cnt= mysqli_num_rows($qst_clt_dtl);
                        if($usr_cnt==0)
                        {
                          ?>
                          <script>
      $(document).ready(function() {
  toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    preventDuplicates: true,
    timeOut: 3000
  };
  
  // Display a toast message
  toastr.error('Wrong Credentials');
});
                          </script>
                          <?php
                            }
                            else if($usr_cnt==1)
                            {
                        
                        @ob_start();
                        
                        session_start();
                        
                        $clct_usr_dtl=$qst_clt_dtl->fetch_assoc();
                        $usr_id=$clct_usr_dtl['id'];
                        
                        $_SESSION['user_id']=$usr_id;
                        
                        if(isset($_SESSION['user_id']))
                        {
                        ?>
                        <script>
                             
      $(document).ready(function() {
         
  
  // Display a toast message
  toastr.success('Logged In successfully');
setTimeout(window.location='index.php', 3000);
});
                           </script>
                        <?php
                        }
                        ob_flush();

                            }
                            
                            
                        
                        }
                        
                        ?>
                                    
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Main Content-->
                </div>
                <!--End Container-->
           
		   <?php include "include/footer.php"?>