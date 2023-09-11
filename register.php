<?php
include "include/header.php";
?>


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
				<h2 class="text-start">REGISTER</h2>
				</div>

				<div class="col-md-2 col-md-offset-2 ">
				<span class="text-md-end d-flex align-items-center">
				<i class="icon an an-home-l me-2"></i>
				<p>REGISTER</p>
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
                    <div class="login-register pt-2 pt-lg-5">
                        <div class="row">
                            <div class="col-12 col-sm-12  col-md-8 mx-auto mb-4 ">
							<h2 class="webtitle text-center mb-3"> <strong>REGISTER </strong></h2>
                                <div class="inner">
                                    
        <?php 
        
        if(isset($_POST['register']))
        {
            
            
            $neme= mysqli_real_escape_string($db ,$_POST['name']);
            $emnl = mysqli_real_escape_string($db ,$_POST['email']);
            $mbel = mysqli_real_escape_string($db ,$_POST['mobile']);
            $password= mysqli_real_escape_string($db ,$_POST['password']);
            
            
            $cpassword = mysqli_real_escape_string($db ,$_POST['cpassword']);
            $mdf_pswd= md5($password);
            
            if($neme!='' and $emnl!='' and $mbel!='' and $password!='' and $cpassword!='')
            {
            if($cpassword==$password)
            {
            $clt_dplc_data="select count(id) as duplicate_data from `users` where email='$emnl'";
            $qst_clt_dplc_data=$db->query($clt_dplc_data);
            $clct_clt_dplc_data=$qst_clt_dplc_data->fetch_assoc();
            
            $dplct_cnt= $clct_clt_dplc_data['duplicate_data'];
            
            
            
            $clt_dplc_mobl="select count(id) as duplicate_mbel from `users` where `mobile`='$mbel'";
            $qst_clt_dplc_mobl=$db->query($clt_dplc_mobl);
            $clct_clt_dplc_mobl=$qst_clt_dplc_mobl->fetch_assoc();
            
            $dplct_mbrl= $clct_clt_dplc_mobl['duplicate_mbel'];
            
            if($dplct_cnt==0 and $dplct_mbrl==0)
            {
            
            $ad_data = "insert into `users` set
            name='$neme',
            email='$emnl',
            mobile='$mbel',
            date='$curt_dete',
            without_md5_pwd='$password',
            password='$mdf_pswd'";
            
            $qst_ad_data=$db->query($ad_data);
            if($qst_ad_data)
{
    ?>
    <script>
               toastr.success('Registered successfully please login');
                
            setTimeout(function() {
     window.location='login.php';
    }, 3000);
            </script>
<?php
}                
            }
            else if($dplct_cnt > 0)
            {
                ?>
                <script>
              alert('This email is already registered please try again');        
            </script>
            <?php
                
            }
            else if($dplct_mbrl > 0)
            {
                ?>
            <script>
            alert('This mobile is already registered please try again');        
            </script>
            <?php
            }
            }
            else
            {
                echo "<script>window.alert('Password and confirm password is not matched');</script>";
            }
    
        }
        else
        {
            ?>
            <script>
              toastr.error('Please Fill all fields');        
            </script>
       <?php
        }
        }
       
        ?>
                                    
                                    
    <form method="POST" action="" class="customer-form" >	
					
<!-- <h3 class="h4 text-uppercase">REGISTERED CUSTOMERS</h3>
<p>If you have an account with us, please log in.</p>-->
    <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group">
    <label for="CustomerEmail">Name <span class="required">*</span></label>
    <input type="text" name="name" placeholder="Enter name" id="CustomerEmail" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];} ?>" required />
    </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group">
    <label for="CustomerPassword" >Email <span class="required">*</span></label>
    <input type="email" name="email" placeholder="Enter email" id="CustomerPassword" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>" required />                        	
    </div>
    </div>
    
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group">
    <label for="CustomerPassword" >Mobile <span class="required">*</span></label>
    <input type="number" name="mobile" placeholder="Enter mobile" value="<?php if(isset($_POST['mobile'])){echo $_POST['mobile'];} ?>" required />                        	
    </div>
    </div>

<div class="col-12 col-sm-12 col-md-12 col-lg-12">
<div class="form-group">
<label for="CustomerPassword" >Password <span class="required">*</span></label>
<input type="password" name="password" value="<?php if(isset($_POST['password'])){ echo $_POST['password'];} ?>" placeholder="Enter password"  required />                        	
</div>
</div>


<div class="col-12 col-sm-12 col-md-12 col-lg-12">
<div class="form-group">
<label for="CustomerPassword" >Confirm Password <span class="required">*</span></label>
<input type="password" name="cpassword" value="<?php if(isset($_POST['cpassword'])){ echo $_POST['cpassword'];} ?>" placeholder="Enter password"  required />                        	
</div>
</div>
    
    
    
										
	</div>
    <div class="row">
    <div class=" col-12 col-sm-12 col-md-12 text-center">
   <p class="text-center my-3">
    <input type="submit" name="register" class="btn twl_btn me-auto w-50" value="Register">
                                                    
                                                </p>
												<!--<a href="lost-password.php">Lost your password?</a> 	<a href="login.php">Already have an account?</a>-->
												
												
												<p style="display: flex; justify-content: space-between;">
                            <span class="fw-bold text-start">	Lost your <a href="lost-password.php" style="color:#318cc9;"> password? </a></span>
                            <span class="fw-bold text-end"> Already  <a href="login.php" style="color:#318cc9;"> have an account?</a></span>
                            </p>
												
												
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Main Content-->
                </div>
                <!--End Container-->
           
		   <?php include "include/footer.php"?>