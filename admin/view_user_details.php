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


$usr_iid=$_GET['id'];

$clt_usr_dtl="select * from `users` where `id`='$usr_iid'";
$qst_clt_usr_dtl=$db->query($clt_usr_dtl);
$clct_clt_usr_dtl=$qst_clt_usr_dtl->fetch_assoc();

$neme= $clct_clt_usr_dtl['name'];
$eml= $clct_clt_usr_dtl['email'];
$mbel= $clct_clt_usr_dtl['mobile'];
$pswd= $clct_clt_usr_dtl['without_md5_pwd'];

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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">View User details</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Name <span style="color:red;">*</span></label>
<input type='text' name="prdt_neme" value="<?php echo $neme;?>" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Email <span style="color:red;">*</span></label>
<input type="email" value="<?php echo $eml;?>" class="form-control"  style="border: 2px solid grey!important;" required> 
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Mobile<span style="color:red;">*</span></label>
<input type="text" name="mobile"  value="<?php echo $mbel;?>" class="form-control"  style="border: 2px solid grey!important;" required>
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">password<span style="color:red;">*</span></label>
<input type="text" name="pswd" value="<?= $pswd;?>" class="form-control"  style="border: 2px solid grey!important;" required>
</div>


</div>
</form>


<?php 
if(isset($_POST['submit']))
{

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