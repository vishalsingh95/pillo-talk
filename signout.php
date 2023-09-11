<?php 
@ob_start();
session_start();
if(isset($_SESSION['user_id']))
{
session_destroy();
echo "<script>window.location='index.php';</script>";
}
ob_flush();
?>