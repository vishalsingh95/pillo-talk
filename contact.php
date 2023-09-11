<?php include "include/header.php"?>
            <!--Body Container-->
            <div id="page-content">   
                <!--Collection Banner-->
                <div class="collection-header">
				 <div class="collection-hero  d-flex justify-content-center align-items-center"style="    background-color: #f2f2f2; height: 100px;opacity: 1;">
                        <!--<div class="collection-hero__image"></div>-->
						<div class="container">
						<div class="row justify-content-between">
						<div class="col-md-2 col-md-offset-2">
                       <h2 class="text-start">Contact</h2>
                         <!-- <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="index.html" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Compare Product Style1</span></div>-->
                       </div>
						
						<div class="col-md-2 col-md-offset-2 ">
						<span class="text-md-end d-flex align-items-center">
						<i class="icon an an-home-l me-2"></i>
						<p>Contact</p>
						</span>
						<!-- <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="index.html" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Compare Product Style1</span></div>-->
                       </div>
						
                    </div>
                </div>
                <!--End Collection Banner-->

                <!--Main Content-->
               </div>
            </div>
			
			<section class="py-4">
			    <form action='' method="POST">
			<div class="container">
			<div class="row">
			<div class="col-md-6 mb-3">
			<div class="row">
			<div class="col-md-6">
			<div class="mb-3">
			<label class="form-label fs-6 fw-bolder"> Name <span class="text-danger"> *</span></label>
			<input name="name" type="text" class="form-control" required>
			<!--<p>First</p>-->
			</div>
			</div>
			
			<div class="col-md-6">
			<div class="mb-3">
			<label class="form-label fs-6 fw-bolder"> Email <span class="text-danger"> *</span></label>
			<input type="text" name="email" class="form-control" required>
		
			</div>
			
			</div>
			
			<div class="col-md-12">
			<div class="mb-3">
			<label class="form-label fs-6 fw-bolder">Mobile <span class="text-danger"> *</span></label>
			<input type="number" name="mobile" class="form-control" required>
			</div>
			
			</div>
			
			
			<div class="col-md-12">
			<div class="form-group">
			<label class="fw-bold fs-6">Comment or Message <span class="text-danger">* </span></label>
			<textarea name="message" class="form-control" rows="3" required></textarea>
			</div>
			</div>
			
			<button type="submit" name="submit" class="twl_btn" style="width:160px;">Send Message </button>
			
			</div>
			</div>
			
			<div class="col-md-6">
			<div class="row">
			<h2>REACH US TO SAY HI!</h2>
			<!--<p>Mauris viverra, massa ut volutpat aliquet, libero tortor ullamcorper magna, in lobortis felis tellus ut erat. Fusce pretium et ex interdum vestibulum vivamus porttitor euismod luctus.</p>-->
			</div>
			<div class="row my-3">
			<div class="col-12 col-sm-12 col-md-3 col-lg-6 footer-links">
			<h4 class="address d-flex align-items-center my-3"><!--<i class="an an-map-marker-al me-2"></i> 3208, 2nd Floor, Mahindra Park, Fountain Chowk,near Rani Bagh, New Delhi, Delhi 110034</h4>-->
			<!--<h4 class="phone d-flex align-items-center my-3"><i class="an an-phone-l me-2"></i>  <b class="me-1 d-none">Phone:</b> <a href="tel:(440)0000000000">(440) 000 000 0000</a></h4>-->
			<h4 class="email d-flex align-items-center my-3"><i class="an an-envelope-l me-2"></i> <b class="me-1 d-none">Email:</b> <a href="mailto:mail@vallabhtextiles.com">mail@vallabhtextiles.com</a></h4>
			</div>
			</div>
			
			<div class="row">
			<div class="col-md-12">
			<!--<a href="#" class="tiles_social_media"> 
			<i class="an an-facebook" aria-hidden="true"></i>
			</a>
			
			<a href="#" class="tiles_social_media"> 
			<i class="an an-twitter" aria-hidden="true"></i>
			</a>
			
			<a href="#" class="tiles_social_media"> 
			<i class="an an-youtube-s" aria-hidden="true"></i>
			</a>
			
			<a href="#" class="tiles_social_media"> 
			<i class="an an-instagram" aria-hidden="true"></i>
			</a>-->
		
			</div>
			</div>
			</div>
			
			</div>
			</div>
			</form>
			
			<?php
			if(isset($_POST['submit']))
			{
			    
			    $neme=mysqli_real_escape_string($db , $_POST['name']);
			    $emnl=mysqli_real_escape_string($db , $_POST['email']);
			    $mbel=mysqli_real_escape_string($db , $_POST['mobile']);
			    $messg=mysqli_real_escape_string($db , $_POST['message']);
			    
		$cnt_dtl="insert into contact set
		name='$neme',
		email='$emnl',
		mobile='$mbel',
		message='$messg',
		date='$curt_dete'";
		
		$qst_cnt_dtl=$db->query($cnt_dtl);
		
		if($qst_cnt_dtl)
		{
		  ?>
		   <script>
                             
      $(document).ready(function() {
         
  
  // Display a toast message
  toastr.success('Thankyou we will contact you soon !!');
});
                           </script>
		  
		  <?php
		}
			    
			    
			    
			}
			?>
			
			</section>
			
			
			
			</div>
            <!--End Body Container-->
			
			
			
					
			
			
			

            <!--Footer-->
           
		   <?php include "include/footer.php"?>