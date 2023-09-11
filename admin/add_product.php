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
$sql = "SELECT * FROM blog";
if ($result = mysqli_query($db, $sql)) {
$rowcount = mysqli_num_rows($result);
// echo "The total number of rows are: " . $rowcount;
}
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">

<ol class="breadcrumb mb-30 mt-2">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add New Product</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Product name <span style="color:red;">*</span></label>
<input type='text' name="prdt_neme" placeholder="Enter product name" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Price <span style="color:red;">*</span></label>
<input type="number" name="prdt_prec" class="form-control"  style="border: 2px solid grey!important;" required> 
</div>

<div class="form-group col-md-12 col-xs-12">
<label class="form-label" style="font-size:16px !important;">Images <span style="color:red;">*</span></label>
<input type="file" accept="image/*" multiple="multiple" name="prdt_image[]" class="form-control"  style="border: 2px solid grey!important;" required> 
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Product type <span style="color:red;">*</span></label>
<select name="prdt_type"  id="prdt_ttyp" class="form-control"  style="border: 2px solid grey!important;" required> 
<option value="">Choose type</option>

<option value="normal">normal</option>
<option value="latest">latest</option>
</select>
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Product Category <span style="color:red;">*</span></label>
<select name="cetgyneme" id="catery" class="form-control"  style="border: 2px solid grey!important;" required> 
<option value="">Choose Category</option>

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
<textarea name="descptn" class="form-control"  style="font-size: 10px !important;font-weight: 600 !important;border: 1px solid grey!important;der-radius: 15px !important; */" required></textarea>
</div>

<div class="form-group col-md-12 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Short Description <span style="color:red;">*</span></label>
<textarea name="short_descptn" class="form-control"  style="font-size: 10px !important;font-weight: 600 !important;border: 1px solid grey!important;der-radius: 15px !important; */" required></textarea>
</div>


<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</div>
</div>
</form>


<?php 
if(isset($_POST['submit']))
{
$ctegt_id=mysqli_real_escape_string($db , $_POST['cetgyneme']);
$product_neme=mysqli_real_escape_string($db , $_POST['prdt_neme']);
$prdt_price=$_POST['prdt_prec'];
$descptn=mysqli_real_escape_string($db , $_POST['descptn']);
$product_type=$_POST['prdt_type'];

$short_descprion =mysqli_real_escape_string($db , $_POST['short_descptn']);

$filename6 = $_FILES["prdt_image"]["name"];
$all_images = implode(", ",$filename6);

$images_count=count($filename6);

for($i=0; $i<=$images_count; $i++)
{
$tempname6 = $_FILES["prdt_image"]["tmp_name"];    
$folder6= "product_images/".$filename6[$i];
move_uploaded_file($tempname6[$i], $folder6);
}

$ad_prdt="insert into products set
product_name='$product_neme',
product_image='$all_images',
description='$descptn',
short_description='$short_descprion',
price='$prdt_price',
category_id='$ctegt_id',
product_type='$product_type'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Product Added Successfully');window.location='';</script>";

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
 $("#catery,#prdt_ttyp").select2();
});
</script>


<script>
CKEDITOR.replace( 'descptn' );
CKEDITOR.replace( 'short_descptn' );
</script>

<?php
ob_flush();

?>