<?php include "include/header.php";?>
<?php

if(isset($_GET['id']))
{
    $iid=$_GET['id'];

$sql = "SELECT * FROM `blog` where `id`='$iid'";
$result = mysqli_query($db, $sql);
$fetch_blog=$result->fetch_assoc();

$blg_ttle=$fetch_blog['title'];
$blg_dscptn=$fetch_blog['description'];
$blg_img=$fetch_blog['image'];


$dateString = $fetch_blog['date'];
$date = DateTime::createFromFormat('Y-m-d', $dateString);
$dateFormatted = $date->format('F j, Y');

}
?>

            <!--Body Container-->
            <div id="page-content">
                <!--Breadcrumbs-->
				<div class="collection-header">
				<div class="collection-hero  d-flex justify-content-center align-items-center"style="background-color: #f2f2f2; height: 100px;opacity: 1;">
				<!--<div class="collection-hero__image"></div>-->
				<div class="container">
				<div class="row justify-content-between">
				<div class="col-md-2 col-md-offset-2">
				<h2 class="text-start">Blog Details</h2>
			
				</div>

				<div class="col-md-2 col-md-offset-2 ">
				<span class="text-md-end d-flex align-items-center">
				<i class="icon an an-home-l me-2"></i>
				<p>Blog Details</p>
				</span>
			
				</div>

				</div>
				</div>
				<!--End Collection Banner-->
				</div>
				</div>
                <!--End Breadcrumbs-->

                <!--Container-->
                <div class="container">
                    <div class="row">
                        <!--Sidebar-->
                        <!--Main Content-->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-10 mx-auto main-col">
                            <div class="article"> 
                              
                                <!-- Article Image --> 
    <div class="article_featured-image"><img class="blur-up ls-is-cached lazyloaded" data-src="<?php if($blg_img!='') { ?>admin/blog_images/<?php echo $blg_img; } else {?>admin/blog_images/no_image/noimg.png<?php }?>" src="<?php if($blg_img!='') { ?>admin/blog_images/<?php echo $blg_img; } else {?>admin/blog_images/no_image/noimg.png<?php }?>" alt="<?php echo $blg_ttle;?>" /></div> 
                                <!-- Article Content --> 
								<h3 class="webtitle text-center"> <strong><?php echo $blg_ttle;?></strong></h3>
								  
                                <ul class="publish-detail d-flex mb-4 pt-1 justify-content-center">                      
                                    <li><i class="icon an an-clock-r"></i><time datetime="<?php echo $dateFormatted;?>"><?php echo $dateFormatted;?></time></li>
                                    <li><i class="icon an an-user-al"></i><span class="clr-555 me-1">Posted by:</span>Admin</li>
                                    
                                </ul>
                                <div class="rte">
                                   <?php echo $blg_dscptn;?>
                                   </div>
                                <!-- Article Tags --> 
                             
                                <hr>
                                <!-- Article Social -->
                             
                                <!-- Article Nav -->
                              
                                <hr>
                                <!-- Article Comment -->
                            
                            </div>
                        </div>
                        <!--End Main Content-->
                    </div>
                </div>
                <!--End Container-->
            </div>
            <!--End Body Container-->

            <!--Footer-->
           
		   <?php include "include/footer.php"?>