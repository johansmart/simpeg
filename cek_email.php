<?php 
error_reporting(0);
	$email = trim(strip_tags($_POST['email']));
	include "config/koneksi.php";	
	$query = mysqli_query($mysqli,"select * from tbl_user where email='$email'"); 
	$hasil=mysqli_num_rows($query);
	if ($hasil==1) {
	date_default_timezone_set("Asia/Jakarta");
	$pass="1A2B4HTjsk5kwhadbwlff"; $panjang='8'; $len=strlen($pass);
	$start=$len-$panjang; $xx=rand('0',$start);
	$yy=str_shuffle($pass);
	$passwordbaru=substr($yy, $xx, $panjang);
	$password = md5($passwordbaru);
	$datetime=date("h:i:s-j-M-Y");
		mysqli_query($mysqli,"update tbl_user set pass='$password' where email='$email' ");
		$query_username=mysqli_query($mysqli,"select username from tbl_user where email='$email'");
		$h_username=mysqli_fetch_array($query_username);
		$username=$h_username[0];
		$message="Anda telah berhasil reset password ASKA, username anda $username dan password anda $passwordbaru";
		mail($email, "admin@andeznet.com", $message);
        echo "<div id='sukses' class='alert alert-info'><strong>BERHASIL...Silahkan cek email anda!!!</strong><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
	} else{
        echo "<div id='gagal' class='alert alert-danger'>Maaf Email anda tidak terdaftar<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";

	}
?>