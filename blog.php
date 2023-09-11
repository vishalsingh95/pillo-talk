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
                        <h2 class="text-start">Blog</h2>
                       
                        </div>
						
						<div class="col-md-2 col-md-offset-2 ">
						<span class="text-md-end d-flex align-items-center">
						<i class="icon an an-home-l me-2"></i>
						<p>Blog</p>
						</span>
					
                        </div>
						
						</div>
						</div>
                <!--End Collection Banner-->
               </div>
            </div>
            <!--End Collection Banner-->
				
				<section class="blog my-5">
                <div class="container">
                    <div class="row">
                        <!--Main Content-->
                        
                        
                        	<?php 
				$usr_lst="select * from `blog`";
$qst_usr_lst=$db->query($usr_lst);

$bedr_cmt=mysqli_num_rows($qst_usr_lst);

$sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $blg_ttl_neme=$clct_usr_lst['title'];
        $blg_img=$clct_usr_lst['image'];
$blg_desc=$clct_usr_lst['description'];
        $blg_id=$clct_usr_lst['id'];
        $blg_dete=$clct_usr_lst['date'];
     //  $dateString = '2023-07-01';
$date = DateTime::createFromFormat('Y-m-d', $blg_dete);
$dateFormatted = $date->format('F j, Y');


				
				?>
                        
                        
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                            <div class="blog--list-view blog-grid-view no-border">
							<div class="row">
							<div class="col-sm-6 col-md-6 col-lg-5">

							<!-- Article Image --> 
							<div class="post-img">
							<a class="article_featured-image zoom-scal" href="blog_details.php?id=<?php echo $blg_id;?>"><img class="blur-up lazyload" data-src="<?php if($blg_img!='') { ?>admin/blog_images/<?php echo $blg_img; } else {?>admin/blog_images/no_image/noimg.png<?php }?>" src="<?php if($blg_img!='') { ?>admin/blog_images/<?php echo $blg_img; } else {?>admin/blog_images/no_image/noimg.png<?php }?>" alt="<?php echo $blg_ttl_neme;?>"></a> 
							</div>

							<!-- Article Content -->
							</div>
							<div class="col-sm-6 col-md-6 col-lg-7">
							<div class="post-content">
							<h2 class="h3 text-transform-none"><a href="blog_details.php?id=<?php echo $blg_id;?>"><?php echo $blg_ttl_neme;?></a></h2>
							
							<div class="rte"> 
						<?php echo substr($blg_desc ,0, 200);?>...
							</div>
							<hr class="clear">
							<ul class="publish-detail d-flex justify-content-between">                      
							<li><i class="icon an an-clock-r"></i><time datetime="<?php echo $dateFormatted;?>"><?php echo $dateFormatted;?></time></li>
						
							</ul>
						
							</div>
							</div>

							</div>

                                <!--Pagination Classic-->
                                
                               <!-- <div class="pagination">
                                    <ul>
                                        <li class="prev"><a href="#"><i class="icon align-middle an an-caret-left" aria-hidden="true"></i></a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">...</a></li>
                                        <li><a href="#">5</a></li>
                                        <li class="next"><a href="#"><i class="icon align-middle an an-caret-right" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>-->
                                <!--End Pagination Classic-->
                            </div>
                        </div>
                        <!--End Main Content-->
						
						<?php 
    }
						?>
						
					
						
						
                    </div>
                </div>
				</section>
           
            <!--End Body Container-->


<?php include "include/footer.php"?>