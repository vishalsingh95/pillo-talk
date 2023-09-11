    <?php
    @ob_start();
    //session_start();
    require_once 'config/config.php';
    require_once 'config/helper.php';
    
    if (isset($_GET['active'])) {
    
    $activate = $_GET['active'];
    $sql=$db->query("UPDATE users SET status='0' WHERE user_id=$activate ");
    echo "<script>alert(' Deactivate Successfully.'); window.location = 'users_list.php';</script>";
    }
    if (isset($_GET['deactivate'])) {
    $deactivate = $_GET['deactivate'];
    $sql1=$db->query("UPDATE users SET status='1' WHERE user_id=$deactivate");
    echo "<script>alert('Activate Successfully.'); window.location = 'users_list.php';</script>";
    }
    
    if(isset($_GET['ord_id']))
    {
    $ord_id=$_GET['ord_id'];
    
    $clt_shp_dtl="select * from `address_of_orders` where `order_id`='$ord_id'";
    $qst_clt_shp_dtl=$db->query($clt_shp_dtl);
    $clct_clt_shp_dtl=$qst_clt_shp_dtl->fetch_assoc();
    
    $ordr_date=$clct_clt_shp_dtl['order_date'];
    $ordr_amount=$clct_clt_shp_dtl['order_total_amount'];
    
    $shp_neme=$clct_clt_shp_dtl['name'];
    $shp_lndmrk=$clct_clt_shp_dtl['landmark'];
    $shp_cty=$clct_clt_shp_dtl['city'];
    $shp_adrs=$clct_clt_shp_dtl['address'];  
    $shp_pnced=$clct_clt_shp_dtl['pincode'];
    $mbel_nber=$clct_clt_shp_dtl['mobile'];
    $pymt_mthd=$clct_clt_shp_dtl['payment_type'];
    
    
    
    
    $timestamp = strtotime($ordr_date);
    $wordFormat = date("F j, Y g:i A", $timestamp);
    
    
    }
    
    
    
    
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
    ob_start("ob_html_compress");
    $comp_select = $db->query("SELECT * FROM `admin`");
    $comp_fetch = $comp_select->fetch_object();
    $a_company = $comp_fetch->a_company;
    $check_a_name = $_SESSION['a_name'];
    function facebook_time_ago($timestamp)
    {
    $time_ago = strtotime($timestamp);
    $current_time = time();
    $time_difference = $current_time - $time_ago;
    $seconds = $time_difference;
    $minutes      = round($seconds / 60);           // value 60 is seconds
    $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
    $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;
    $weeks          = round($seconds / 604800);          // 7*24*60*60;
    $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
    $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
    if ($seconds <= 60) {
    return "Just Now";
    } else if ($minutes <= 60) {
    if ($minutes == 1) {
    return "one minute ago";
    } else {
    return "$minutes minutes ago";
    }
    } else if ($hours <= 24) {
    if ($hours == 1) {
    return "an hour ago";
    } else {
    return "$hours hrs ago";
    }
    } else if ($days <= 7) {
    if ($days == 1) {
    return "yesterday";
    } else {
    return "$days days ago";
    }
    } else if ($weeks <= 4.3) //4.3 == 52/12
    {
    if ($weeks == 1) {
    return "a week ago";
    } else {
    return "$weeks weeks ago";
    }
    } else if ($months <= 12) {
    if ($months == 1) {
    return "a month ago";
    } else {
    return "$months months ago";
    }
    } else {
    if ($years == 1) {
    return "one year ago";
    } else {
    return "$years years ago";
    }
    }
    }
    ?>
    
    <?php include 'header.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    
    
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    
    <style>
    
    @media print
    {
        #prnt_btrn{
            display:none;
        }
        
        .bg-footer{
            
            display:none;
        }
        
        .breadcrumb 
        {
            display:none;
        }
        
        .ord_smry{
            display:block !important;
        }
        
        
        .usrlink{
            text-decoration:none !important;
            color:black;
        }
        
        
    }
    
    
    
    
    
    .shsp_adrs {
            background-color: #fbfbfb;
    font-size: 15px;
    font-weight: 600;
    padding: 10px 15px;
    margin: -1px 0 15px;
    border-bottom: 1px solid #ddd;
    border-top: 1px solid #ddd;
    }
    </style>
    
    
    <div id="layoutSidenav_content">
    <main>
    <div class="container-fluid">
    <!--<h2 class="mt-30 page-title">All Bidders</h2>-->
    <ol class="breadcrumb mb-30">
    <li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Order Summary</li>
    </ol>
    
    <?php
    $ord_dtl="select * from `address_of_orders` where `order_id`='$ord_id'";
    $qst_ord_dtl=$db->query($ord_dtl);
    while($clct_ord_dtl=$qst_ord_dtl->fetch_assoc())
    {
    $ord_id=$clct_ord_dtl['order_id'];
    $ussr_iid=$clct_ord_dtl['user_id'];
    $ord_dete=$clct_ord_dtl['order_date'];
    
    
    $sh_usr_nmae=$clct_ord_dtl['name'];
    $sh_mobile=$clct_ord_dtl['mobile'];
    $sh_lnd_mrk=$clct_ord_dtl['landmark'];
    $sh_adrs=$clct_ord_dtl['address'];
    $sh_pncode=$clct_ord_dtl['pincode'];
    
    $sh_city=$clct_ord_dtl['city'];
    
    
    
    $order_word_date=date("M jS, Y", strtotime("$ord_dete"));
    
    
    $clt_usr_dtl="select * from `users` where `id`='$ussr_iid'";
    $qst_clt_usr_dtl=$db->query($clt_usr_dtl);
    $clct_clt_usr_dtl=$qst_clt_usr_dtl->fetch_assoc();
    
    $uuse_neme=$clct_clt_usr_dtl['name'];
        $uuse_mob=$clct_clt_usr_dtl['mobile'];
    ?>
    <div class='ord'>
    <div class="row">
        <div class="col-md-12 mb-5 ord_smry"  style="display:none"><center><h3 style="font-weight:bold;">Order Summary</h3></center></div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <div class="checkout-item-ordered">
    <h5 class="fs-6 mb-3" style="
    font-size: 16px;
">Order Id : (<span style="font-weight:650"><?php echo $ord_id;?>)</span></h5>
   <p class="fs-6 mb-3" style="
    font-size: 14px;">Order date : (<span style="font-weight:650"><?php echo $order_word_date;?>)</span></p>
    
    
    
    <div class="table-content table-responsive order-table mb-4">
    <table class="table table-bordered align-middle table-hover text-center mb-0">
    <thead>
    <tr>
    <th class="fw-bold">Image</th>
    <th class="text-start fw-600">Product Name</th>
    <th class="fw-600" style="width:100px;">Price</th>
    <th class="fw-600">Qty</th>
    <th class="fw-600" style="
    width: 100px;
    ">Status</th>
    <th class="fw-600" style="
    width: 100px;
    ">Subtotal</th>
     
    </tr>
    </thead>
    <tbody>
    <?php 
  $clct_ordr_dtls="select * from `orders` where `order_id`='$ord_id'";
    $qst_clct_ordr_dtls=$db->query($clct_ordr_dtls);
    while($clct_clct_ordr_dtls=$qst_clct_ordr_dtls->fetch_assoc())
    {
    
    $prdt_nemee=$clct_clct_ordr_dtls['product_name'];
    
    $prdt_img=$clct_clct_ordr_dtls['product_image'];
    $prdt_prce=$clct_clct_ordr_dtls['price'];
    $prdt_qnty=$clct_clct_ordr_dtls['quantity'];
    $prdt_iid=$clct_clct_ordr_dtls['product_id'];
    $ord_sts=$clct_clct_ordr_dtls['status'];
    
    $prdt_imgg_epx=explode(", ",$prdt_img);
    
    ?>
    <tr>
    <td class="pro-img">
    <?php if($prdt_img!=''){ ?>
    <img class="primary blur-up lazyload" src="product_images/<?php echo $prdt_imgg_epx[0];?>" alt="image" title="product" width="80" /><?php
    } else { ?>   <img class="primary blur-up lazyload" src="product_images/no_image/noimg.png" alt="image" title="product" width="80" /> <?php } ?></td>
    <td class="pro-name text-start">
    <?php echo $prdt_nemee;?>
    
    </td>
    <td class="pro-price">₹ <?php echo $prdt_prce;?></td>
    <td class="pro-qty"><?php echo $prdt_qnty;?></td>
     <td class="pro-total fw-500"><b><?php echo $ord_sts;?></b></td>
    <td class="pro-total fw-500">₹ <?php echo $prdt_prce*$prdt_qnty;?></td>
     
    </tr>
    <?php 
    }
    ?>          
    </tbody>
    <tfoot>
    <tr>
    <td colspan="5" class="item subtotal text-end fw-bolder">Subtotal:</td>
    <td class="fw-500 last">₹ <?php echo $ordr_amount;?></td>
    
    </tr><tr>
    <td colspan="5" class="item shipping text-end fw-bolder">Shipping:</td>
    <td class="fw-500 last">Free</td>
    </tr>
    <tr>
    <td colspan="5" class="item total text-end fw-bolder">Grand Total:</td>
    <td class="fw-500 last"><b>₹ <?php echo $ordr_amount;?></b></td>
    </tr>
    </tfoot>
    </table>
    </div>
    </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6" style="
    margin-top: 72px;
    ">
    <div class="ship-info-details shipping-method-details" style="
    border: 1px solid #dddddd;
">
    <div class="row g-0">
    <div class="col-12 col-sm-6 col-md-6 col-lg-6 pr-0" >
    <div class="shipping-details mb-4 mb-sm-0 clearfix">
    <h3 class="shsp_adrs">Shipping Address</h3>
    <p class="pl-2 pb-0 mb-1" style="font-size: 14px;"> <b><?php echo $shp_neme;?> , <?php echo $mbel_nber?></b> </p>
    
    <p class="pl-2" style="font-size:14px;"><?php echo $shp_adrs; ?></p>
    <p class="pl-2 mb-0" style="font-size:14px;"><?php echo $shp_cty?>, <?php echo $shp_pnced;?></p>
    <p class="pl-2" style="font-size:14px;"><b>landmark :- <?php echo $shp_lndmrk;?></b></p>
    </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-6 pl-0">
    <div class="shipping-details mb-4 mb-sm-0 clearfix">
    <h3 class='shsp_adrs'>Billing Address</h3>
    <p class="pl-2 pb-0 mb-1" style="font-size: 14px;"><a title="Click to view this user details" class='usrlink' href="view_user_details.php?id=<?php echo $ussr_iid;?>"> <b><?php echo $uuse_neme;?> , <?php echo $uuse_mob?></b></a> </p>
   
    <p class="pl-2" style="font-size:14px;"><?php echo $shp_adrs; ?></p>
    <p class="pl-2 mb-0" style="font-size:14px;"><?php echo $shp_cty?>, <?php echo $shp_pnced;?></p>
    <p class="pl-2" style="font-size:14px;"><b>landmark :- <?php echo $shp_lndmrk;?></b></p>
    </div>
    </div>
    </div>
    </div>
    <div class="ship-info-details billing-payment-details">
    <div class="row g-0">
    
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <div class="billing-details clearfix" style="margin-top: 15px;border: 1px solid #dddddd;">
    <h3 style="font-size:18px;padding-top: 10px;font-weight: bold;padding-left: 5px;">Payment Method</h3>
    
    <p style="
    padding-left: 5px;
"><?php if($pymt_mthd=="COD") { ?> Cash on delivery <?php } else { ?> Online <?php } ?></p>
    </div>
    
    
    
    
    </div>
    
    
    
    <div class="col-md-12 mt-2">
    <button type="button" id="prnt_btrn" class="btn btn-warning" onClick="print_bill()">Print Order</button>    
    </div>
    </div>
    </div>
    
   
    </div>
    </div>
    
    </div>
    <?php 
    }
    ?>
    </div>
    </main>
    
    <script>
    
    
    function dlt_lqdtr(txt)
    {
    var txt1=txt;
    
    
    $.ajax({
    url: "dlt_lqdtor.php",
    type: "POST",
    data    : {txt1:txt1},
    cache: false,
    success: function(data){
    Swal.fire({
    
    icon: 'success',
    title: 'Your work has been saved',
    showConfirmButton: false,
    timer: 1500
    });
    window.location='';
    
    }
    });
  
    
    }
    
    
    </script>
    
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    
    
    <script>
      
    
    function print_bill()
    {
        window.print();
    }
    $(document).ready( function () {
    $('#myTable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ]
    } );
    
    
    
    
  
    
    
    
    
    });
    </script>
    
    <?php include 'footer.php'; 
    
    ob_flush();
    
    ?>