<?php 
include('config/config.php');
if(isset($_SESSION['a_email']))
{
   if(isset($_GET['id']))
   {
       $iid=mysqli_real_escape_string($db ,$_GET['id']);
     $clt_dtl="select * from `products` where `category_id`='$iid'";
     $qst_clt_dtl=$db->query($clt_dtl);
     $prdt_cnt=mysqli_num_rows($qst_clt_dtl);
     if($prdt_cnt==0)
     {
         $dlt_ctgy="delete from `product_category` where `id`='$iid'";
         $qst_dlt_ctgy=$db->query($dlt_ctgy);
         if($qst_dlt_ctgy)
         {
             echo "<script>window.alert('Category deleted successfully');window.location='view_category.php';</script>";
         }
     }
     else
     {
         
             echo "<script>window.alert('This category is assigned to product please delete assigned product first then delete this category');window.location='view_category.php';</script>";
     }
     
   }
}
else
{
    echo "<script>window.alert('Please login');window.location='login.php';</script>";
}


?>