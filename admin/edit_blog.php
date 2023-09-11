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
    $iid=$_GET['id'];

$sql = "SELECT * FROM `blog` where `id`='$iid'";
$result = mysqli_query($db, $sql);
$fetch_blog=$result->fetch_assoc();

$blg_ttle=mysqli_real_escape_string($db , $fetch_blog['title']);
$blg_dscptn=$fetch_blog['description'];
$blg_image=mysqli_real_escape_string($db , $fetch_blog['image']);
}
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">

<ol class="breadcrumb mb-30 mt-2">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Edit Blog</li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-6 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Blog title <span style="color:red;">*</span></label>
<input type='text' name="blg_ttle" value="<?php echo $blg_ttle;?>" placeholder="Enter blog title" class="form-control"  style="border: 2px solid grey!important;" required>
 
</div>


<div class="form-group col-md-4 col-xs-4">
<label class="form-label" style="font-size:16px !important;">Image </label>
<input type="file" accept="image/*"  name="blog_image" class="form-control"  style="border: 2px solid grey!important;" >

</div>
<div class="form-group col-md-2 col-xs-2">
<br>
<img src="blog_images/<?php echo $blg_image;?>" style="height:50px; width:50px;">

</div>



<div class="form-group col-md-12 col-xs-12">
<label class="form-label" style="font-size:16px !important;">Description<span style="color:red;">*</span></label>
<textarea name="descptn" class="form-control"  style="border: 2px solid grey!important;" required><?php echo $blg_dscptn;?></textarea>
</div>

<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</div>
</div>
</form>


<?php 
if(isset($_POST['submit']))
{

$bolg_ttle=mysqli_real_escape_string($db , $_POST['blg_ttle']);

$cat_type=mysqli_real_escape_string($db , $_POST['descptn']);



$filename6 = $_FILES["blog_image"]["name"];
if($filename6!='')
{
    $image_name=$_FILES["blog_image"]["name"];
$tempname6 = $_FILES["blog_image"]["tmp_name"];    
$folder6= "blog_images/".$image_name;
move_uploaded_file($tempname6, $folder6);
}
else
{
   $image_name= $blg_image;
}
$ad_prdt="update `blog` set
`title`='$bolg_ttle',
`image`='$image_name',
`description`='$cat_type' where `id`='$iid'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Blog updated Successfully');window.location='';</script>";

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