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
    $prdt_id=$_GET['id'];

$clt_prdt = "SELECT * FROM `products` where `id`='$prdt_id'";
$qst_clt_prdt=$db->query($clt_prdt);
$clct_clt_prdt=$qst_clt_prdt->fetch_assoc();

$predt_neme=$clct_clt_prdt['product_name'];
$predt_img=$clct_clt_prdt['product_image'];

$shrt_desc=$clct_clt_prdt['short_description'];
$expld_img=explode(", ",$predt_img);

$img_ar_count=count($expld_img);

$predt_price=$clct_clt_prdt['price'];
$predt_descptn=$clct_clt_prdt['description'];
$predt_type=$clct_clt_prdt['product_type'];

$predt_cetg=$clct_clt_prdt['category_id'];

$clt_ctgy_dtl="select * from `product_category` where `id`='$predt_cetg'";
$qst_clt_ctgy_dtl=$db->query($clt_ctgy_dtl);
$clct_clt_ctgy_dtl=$qst_clt_ctgy_dtl->fetch_assoc();

$cetgy_neme=$clct_clt_ctgy_dtl['name'];

}
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">

<ol class="breadcrumb mb-30 mt-2">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Edit Product </li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Product name <span style="color:red;">*</span></label>
<input type='text' name="prdt_neme" value="<?php echo $predt_neme?>" placeholder="Enter product name" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Price <span style="color:red;">*</span></label>
<input type="number" name="prdt_prec"  value="<?php echo $predt_price?>" class="form-control"  style="border: 2px solid grey!important;" required> 
</div>



<div class="form-group col-md-6 col-xs-12">
<label class="form-label" style="font-size:16px !important;">Product type <span style="color:red;">*</span></label>
<select name="prdt_type" id="ddsd" class="form-control"  style="border: 2px solid grey!important;" required> 
<option value="<?php echo $predt_type;?>"><?php echo $predt_type;?></option>

<option value="normal">normal</option>
<option value="latest">latest</option>
</select>
</div>


<div class="form-group col-md-6 col-xs-12">
<label class="form-label" style="font-size:16px !important;">Product Category <span style="color:red;">*</span></label>
<select name="caegty" id="dssdsd" class="form-control"  style="border: 2px solid grey!important;" required> 
<option value="<?php echo $predt_cetg;?>"><?php echo $cetgy_neme;?></option>
<?php 
$clt_ctgy_dtl="select * from `product_category`";
$qst_clt_ctgy_dtl=$db->query($clt_ctgy_dtl);
while($clct_clt_ctgy_dtl=$qst_clt_ctgy_dtl->fetch_assoc())
{
    $cetg_neme=$clct_clt_ctgy_dtl['name'];
    $cetg_id=$clct_clt_ctgy_dtl['id'];
?>
<option value="<?php echo $cetg_id;?>"><?php echo $cetg_neme;?></option>
<?php 
}
?>
</select>
</div>










<div class="form-group col-md-12 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Description <span style="color:red;">*</span></label>
<textarea name="descptn" class="form-control"  style="font-size: 10px !important;font-weight: 600 !important;border: 1px solid grey!important;der-radius: 15px !important; */" required><?php echo $predt_descptn;?></textarea>
</div>


<div class="form-group col-md-12 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Short Description <span style="color:red;">*</span></label>
<textarea name="short_descptn" class="form-control"  style="font-size: 10px !important;font-weight: 600 !important;border: 1px solid grey!important;der-radius: 15px !important; */" required><?php echo $shrt_desc;?></textarea>
</div>




<div class="form-group col-md-12 col-xs-12">
<label class="form-label" style="font-size:16px !important;">Images </label>
<input type="file" accept="image/*" multiple="multiple" name="prdt_image[]" class="form-control"  style="border: 2px solid grey!important;"> 
</div>
<div class='col-md-12' id="all_image">
    <?php 
    if($predt_img!='')
    {
    for($i=0; $i<$img_ar_count; $i++)
    {
       ?>
       
       <img src="product_images/<?php echo $expld_img[$i];?>" style="height:50px; width:50px;"> <button type="button" class="btn btn-danger" onClick="delete_img(<?php echo $i;?>)"><i class='fa fa-trash'></i></button>
       <?php
    }
    
    }
    ?>
</div>
<div class="form-group col-md-12" style="margin-top:15px">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</div>
</div>
</form>


<?php 
if(isset($_POST['submit']))
{

$prdt_cety=mysqli_real_escape_string($db , $_POST['caegty']);
$product_neme=mysqli_real_escape_string($db ,$_POST['prdt_neme']);
$prdt_price=$_POST['prdt_prec'];
$descptn=mysqli_real_escape_string($db ,$_POST['descptn']);
$shrt_descptn=mysqli_real_escape_string($db ,$_POST['short_descptn']);

$product_type=$_POST['prdt_type'];

$filename6 = $_FILES["prdt_image"]["name"];


$images_count=count($filename6);

//print_r($filename6);

//die();
if($filename6[0]!="")
{
    if($predt_img!='')
    {
$combined_images=array_merge($expld_img,$filename6);
}
else
{
    $combined_images=$filename6;
}
$all_images = implode(", ",$combined_images);

for($i=0; $i<=$images_count; $i++)
{
$tempname6 = $_FILES["prdt_image"]["tmp_name"];    
$folder6= "product_images/".$filename6[$i];
move_uploaded_file($tempname6[$i], $folder6);
}
}
else
{
    $all_images=$predt_img;
}

$ad_prdt="update `products` set
`product_name`='$product_neme',
`product_image`='$all_images',
`description`='$descptn',
`short_description`='$shrt_descptn',
`price`='$prdt_price',
`category_id`='$prdt_cety',
`product_type`='$product_type' where `id`='$prdt_id'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Product updated Successfully');window.location='';</script>";

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



const delete_img = (txt)=>{
if(confirm('Are you sure want to delete this image ?'))
{
$.ajax
(
{
url: "delete_img_ajax.php",
type: "POST",
data    : {txt1:txt,txt2:'<?php echo $prdt_id?>'},
cache: false,
success: function(data)
{
$('#all_image').load(location.href + " #all_image");

}
}
);
}
}



$(document).ready(function() { 
 $("#ddsd , #dssdsd").select2();
});
</script>


<script>
CKEDITOR.replace( 'descptn' );
CKEDITOR.replace( 'short_descptn' );

</script>

<?php
ob_flush();

?>