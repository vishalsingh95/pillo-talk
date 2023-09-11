<?php 
include('config/config.php');
if(isset($_SESSION['a_email']))
{
   if(isset($_GET['id']))
   {
     $iid=$_GET['id'];
         $dlt_ctgy="delete from `blog` where `id`='$iid'";
         $qst_dlt_ctgy=$db->query($dlt_ctgy);
         if($qst_dlt_ctgy)
         {
             echo "<script>window.alert('Blog deleted successfully');window.location='view_blog.php';</script>";
         }
     }
     
     

}
else
{
    echo "<script>window.alert('Please login');window.location='login.php';</script>";
}


?>