<?php 
include("admin/config/config.php");
$crt_det_tme=date('Y-m-d h:i:s');
$emnl=$_POST['txt1'];

$clt_usr_dtl="select * from `users` where `email`='$emnl'";
$qst_clt_usr_dtl=$db->query($clt_usr_dtl);
$usr_emnl_cont=mysqli_num_rows($qst_clt_usr_dtl);

if($usr_emnl_cont==0)
{
    echo json_encode(["status"=>"0","response"=>"Invalid email"]);
}
else 
{
    $rand_id=rand(11111,999999);
    $clct_usr_dtl=$qst_clt_usr_dtl->fetch_assoc();
    $usr_id=$clct_usr_dtl['id'];
    
    $updt_otp="update `users` set `otp`='$rand_id' where `id`='$usr_id'";
    $qst_updt_otp=$db->query($updt_otp);
    if($qst_updt_otp)
    {
    $to = "$emnl";                                                        
$subject = "Vallabh textiles Date-time ($crt_det_tme)";
   $txt='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verify your account</title>
  <!--[if mso]><style type="text/css">body, table, td, a { font-family: Arial, Helvetica, sans-serif !important; }</style><![endif]-->
</head>

<body style="font-family: Helvetica, Arial, sans-serif; margin: 0px; padding: 0px; background-color: #ffffff;">
  <table role="presentation"
    style="width: 100%; border-collapse: collapse; border: 0px; border-spacing: 0px; font-family: Arial, Helvetica, sans-serif; background-color: rgb(239, 239, 239);">
    <tbody>
      <tr>
        <td align="center" style="padding: 1rem 2rem; vertical-align: top; width: 100%;">
          <table role="presentation" style="max-width: 600px; border-collapse: collapse; border: 0px; border-spacing: 0px; text-align: left;">
            <tbody>
              <tr>
                <td style="padding: 40px 0px 0px;">
                  <div style="text-align: left;">
                    <div style="padding-bottom: 20px;"><img src="https://i.ibb.co/Qbnj4mz/logo.png" alt="Company" style="width: 56px;"></div>
                  </div>
                  <div style="padding: 20px; background-color: rgb(255, 255, 255);">
                    <div style="color: rgb(0, 0, 0); text-align: left;">
                      <h1 style="margin: 1rem 0">Verification code</h1>
                      <p style="padding-bottom: 16px">Please use the verification code below to sign in.</p>
                      <p style="padding-bottom: 16px"><strong style="font-size: 130%">'.$rand_id.'</strong></p>
                      <p style="padding-bottom: 16px">If you didn’t request this, you can ignore this email.</p>
                      <p style="padding-bottom: 16px">Thanks,<br>The Vallabhtextiles team</p>
                    </div>
                  </div>
                  <div style="padding-top: 20px; color: rgb(153, 153, 153); text-align: center;">
                    <p style="padding-bottom: 16px">Made with ♥ in india</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</body>

</html>'; 

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <support@ipsupport.in>' . "\r\n";

if(mail($to,$subject,$txt,$headers))
{
    echo json_encode(["status"=>"1","response"=>"Email sent successfully"]);
}
}
}


?>