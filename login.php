<?php
session_start();

$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;

if ($sesi_level=='1'){
   echo"<script>window.location.href='media.php';</script>";

} else if ($sesi_level=='2'){
   echo"<script>window.location.href='pegawai.php';</script>";

} else if ($sesi_level=='3'){
     echo"<script>window.location.href='absen.php';</script>";

} else if ($sesi_level=='4'){
     echo"<script>window.location.href='payroll.php';</script>";

} else if ($sesi_level=='5') {
     echo"<script>window.location.href='user.php';</script>";

} else if ($sesi_level=='6') {
     echo"<script>window.location.href='kabag.php';</script>";
} else if ($sesi_level=='7') {
     echo"<script>window.location.href='kabag.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Login Page - ASKA (Administrasi Sistem Kepegawaian)</title>
	<link rel="shortcut icon" href="favicon.ico" />
	<meta name="description" content="User login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/font-awesome/4.1.0/css/font-awesome.min.css" />

		<link rel="stylesheet" href="assets/css/select2.css" />
	<!-- text fonts -->
	<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css" />

	<!--[if lte IE 9]>
	<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
	<![endif]-->
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

	<!--[if lte IE 9]>
	<link rel="stylesheet" href="assets/css/ace-ie.min.css" />
	<![endif]-->
<style>

    .paypalbox{
        position:relative;
        width:250px;
        height:auto;
        position:fixed;
        bottom:0;
        left:60px;
    }
    .tombolpaypal{
        text-align:center;
        text-decoration:none;
        width:240px;
        height:auto;
        background:#555;
        padding:5px 5px 15px;
        display:none;
    }
    .paypal{
        background:#efefef;
        border:0;
        margin:0 auto;
        padding:5px 18px;
        font-size:18px;
        font-weight:700;
        color:#333;
        text-align:center;
        display:inline-block;
        border-radius:3px;
    }
    .paypal:hover{
        background:#ddd;
    }
    .paypalheader{
        background:#5090c1;
        border-radius:3px 3px 0 0;
        margin:0 auto;
        padding:8px 23px;
        font-size:18px;
        font-weight:700;
        color:#fff;
        text-align:center;
        display:block;
        cursor:pointer;
    }
    .tombolpaypal a{
        text-decoration:none;
    }
    .tombolpaypal p{
        color:#ddd;
        font-size:14px;
        margin:5px 0 10px;
    }

</style>

</head>

<body class="login-layout blur-login" OnLoad="document.login.username.focus();">
<div class="main-container">
<div class="main-content">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<div class="login-container">
<div class="center">
	<h1>
		<i class="ace-icon fa fa-eye green"></i>
		<span class="red">ASKA</span><span class="white">ONLINE</span>
	</h1>
	<span class="white"><h5>Administrasi System Kepegawaian</h5></span>
</div>


<div class="space-6"></div>
<div id="loading" style="text-align: center"></div>
<div class="position-relative">
	<div id="login-box" class="login-box visible widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header blue lighter bigger">
					<i class="ace-icon fa fa-coffee green"></i>
					Please Enter Your Information
				</h4>

				<div class="space-6"></div>

				<form name="form" id="loginF" method="post" action="" class="form-horizontal">
					<fieldset>


						<div class="form-group">
						<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text"  name="username" id="username" value="" class="form-control"  placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
						</label>
						</div>

						<div class="form-group">
						<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="passlogin"  value="" id="passlogin" class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
						</label>
						</div>

						<div class="space"></div>

						<div class="clearfix">
							<label class="inline">
								<input type="checkbox" class="ace" />
								<span class="lbl"> Remember Me</span>
							</label>

							<div class="form-group">
							<button class="width-35 pull-right btn btn-sm btn-primary">
								<i class="ace-icon fa fa-key"></i>
								<span class="bigger-110">Login</span>
							</button>
							<div>
						</div>

						<div class="space-4"></div>
					</fieldset>
				</form>
                <?php
                include "config/koneksi.php";
                $q_nm_pt	    = mysqli_query($mysqli,"SELECT nm_pt FROM master WHERE id='1'") or die ("Error: ".mysqli_error($mysqli)) ;
                $a_nm_pt	    = mysqli_fetch_array($q_nm_pt);
				
                echo "<h4 class='blue'>&copy; $a_nm_pt[0]</h4>";
                ?>
				<div class="social-or-login center">
					<span class="bigger-110">Contact Person</span>
				</div>

				<div class="space-6"></div>

			
			</div><!-- /.widget-main -->

			<div class="toolbar clearfix">
				<div>
					<a href="forgot.php" class="forgot-password-link">
						<i class="ace-icon fa fa-arrow-left"></i>
						I forgot my password
					</a>
				</div>

				<div>
					<a href="register.php" class="user-signup-link">
						I want to register
						<i class="ace-icon fa fa-arrow-right"></i>
					</a>
				</div>
			</div>
		</div><!-- /.widget-body -->
	</div><!-- /.login-box -->






<div class="navbar-fixed-top align-right">
	<br />
	&nbsp;
	<a id="btn-login-dark" href="#">Dark</a>
	&nbsp;
	<span class="blue">/</span>
	&nbsp;
	<a id="btn-login-blur" href="#">Blur</a>
	&nbsp;
	<span class="blue">/</span>
	&nbsp;
	<a id="btn-login-light" href="#">Light</a>
	&nbsp; &nbsp; &nbsp;
</div>
</div>
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.main-content -->
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="assets/js/jquery.2.1.1.min.js"></script>

<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>

<!-- <![endif]-->
<?php include "config/fungsi_login.php" ?>
<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if IE]>
<script type="text/javascript">
	window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>




<!-- inline scripts related to this page -->
</body>
</html>
