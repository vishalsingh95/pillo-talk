<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');

if (!empty($_SESSION['ibc'])) {
if ($_SESSION['ibc'] != session_id()) {
header('Location: index.php');
exit;
}
} else {
header('Location: login.php');
exit;
}
$logintype = $_SESSION['logintype'];
$a_idchk = $_SESSION['a_id'];

$ausernmae = $_SESSION['a_name'];

$comp_select = $db->query("SELECT * FROM `admin`");
$comp_fetch = $comp_select->fetch_object();
$a_company = $comp_fetch->a_company;
$check_a_name = $_SESSION['a_name'];





?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>


<?php

if(isset($_GET['id']))
{
    $ctgy_id=$_GET['id'];

$clt_prdt = "SELECT * FROM `product_category` where `id`='$ctgy_id'";
$qst_clt_prdt=$db->query($clt_prdt);
$clct_clt_prdt=$qst_clt_prdt->fetch_assoc();

$predt_neme=$clct_clt_prdt['name'];
$expld_img=$clct_clt_prdt['image'];
$predt_type=$clct_clt_prdt['type'];
}
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">

<ol class="breadcrumb mb-30 mt-2">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Edit Category </li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Category name <span style="color:red;">*</span></label>
<input type='text' name="prdt_neme" value="<?php echo $predt_neme?>" placeholder="Enter product name" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>




<div class="form-group col-md-6 col-xs-12">
<label class="form-label" style="font-size:16px !important;">Category type <span style="color:red;"></span></label>
<select name="prdt_type" id="ddsd" class="form-control"  style="border: 2px solid grey!important;" > 
<option value="<?php echo $predt_type;?>"><?php echo $predt_type;?></option>

<option value="normal">normal</option>
<option value="front_display">front_display</option>
</select>
</div>

<div class="form-group col-md-12 col-xs-12">
<label class="form-label" style="font-size:16px !important;">Image </label>
<input type="file" accept="image/*" multiple="multiple" name="ctgy_image" class="form-control"  style="border: 2px solid grey!important;"> 
</div>
<div class='col-md-12' id="all_image">
    
       
       <img src="category_images/<?php echo $expld_img;?>" style="height:50px; width:50px;"> 
 
</div>
<div class="form-group col-md-12" style="margin-top:15px">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</div>
</div>
</form>


<?php 
if(isset($_POST['submit']))
{

$ctgy_pst_neme=mysqli_real_escape_string($db ,$_POST['prdt_neme']);
$ctgy_pst_type=$_POST['prdt_type'];

$filename6 = $_FILES["ctgy_image"]["name"];




//print_r($filename6);

//die();
if($filename6!="")
{
$tempname6 = $_FILES["ctgy_image"]["tmp_name"];    
$folder6= "category_images/".$filename6;
move_uploaded_file($tempname6, $folder6);
}
else
{
    $filename6=$expld_img;
}

$ad_prdt="update `product_category` set
`name`='$ctgy_pst_neme',
`image`='$filename6',
`type`='$ctgy_pst_type' where `id`='$ctgy_id'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Category updated Successfully');window.location='';</script>";

}
else
{
    echo "<script>window.alert('Error');window.location='';</script>";
}


}
?>


</div>
</div>
</main>




<?php include 'footer.php'; 
?>


<script>




$(document).ready(function() { 
 $("#ddsd").select2();
});
</script>


<script>
CKEDITOR.replace( 'descptn' );
CKEDITOR.replace( 'short_descptn' );

</script>

<?php
ob_flush();

?>