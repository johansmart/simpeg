<?php
error_reporting(0);
include "config/koneksi.php";
include "config/timeout.php";

$user = trim($_POST['username']);
$pass = $_POST['passlogin'];

// pastikan username dan password adalah berupa huruf atau angka.

if ($user==""){
	 header('location:index.php');
} else {
	
$cek_lagi	=mysqli_query($mysqli,"SELECT id_user,username,pass,level_user,nip,photo,status,w_login,id,id_jab FROM tbl_user WHERE username='$user' and kd_approve='1'");
$ketemu		=mysqli_num_rows($cek_lagi);
$r			=mysqli_fetch_array($cek_lagi);
$passhash	=$r['pass'];

// Apabila username 
if ($ketemu > 0){
	
	if(password_verify($pass, $passhash)){
		login_validate();
		$_SESSION['kode']           = $r['id_user'];
		$_SESSION['nip']            = $r['nip'];
		$_SESSION['username']       = $r['username'];
		//$_SESSION['passuser']       = $r['pass'];
		$_SESSION['leveluser']      = $r['level_user'];
		$_SESSION['photo']          = $r['photo'];
		$_SESSION['status']         = $r['status'];
		$_SESSION['w_login']        = $r['w_login'];
		$_SESSION['id_daftar']      = $r['id'];
		$_SESSION['id_jab']      	= $r['id_jab'];
		$id_user=$_SESSION['kode'];

		$cek_kontrak=mysqli_query($mysqli,"SELECT current_date() as tgl_skrng,datediff(tgl_kontrak,current_date()) as sisa,tgl_kontrak from pegawai WHERE id=".$r['id']." and tgl_kontrak > '0000-00-00'");
		$k=mysqli_fetch_array($cek_kontrak);
		$sisa=$k['sisa'];

		if ($sisa < 0){
			echo "<div  class='alert alert-danger'>Masa kontrak anda habis, anda tidak bisa login !!! <button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
			session_destroy();
		} else{
			if ($_SESSION['leveluser']==1){
				echo "<div id='sukses' class='alert alert-info'><strong>BERHASIL...</strong><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div><script>window.location ='media.php?id=home'</script>";
				mysqli_query($mysqli,"update tbl_user set status=1,w_login=NOW() where id_user='$id_user'");
			} elseif($_SESSION['leveluser']==2){
				echo "<div id='sukses' class='alert alert-info'><strong>BERHASIL...</strong><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div><script>window.location ='pegawai.php'</script>";
				mysqli_query($mysqli,"update tbl_user set status=1,w_login=NOW() where id_user='$id_user'");
			} elseif($_SESSION['leveluser']==3){
				echo "<div id='sukses' class='alert alert-info'><strong>BERHASIL...</strong><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div><script>window.location ='absen.php?id=home'</script>";
				mysqli_query($mysqli,"update tbl_user set status=1,w_login=NOW() where id_user='$id_user'");
			} elseif($_SESSION['leveluser']==4){
				echo "<div id='sukses' class='alert alert-info'><strong>BERHASIL...</strong><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div><script>window.location ='payroll.php?id=home'</script>";
				mysqli_query($mysqli,"update tbl_user set status=1,w_login=NOW() where id_user='$id_user'");
			} elseif($_SESSION['leveluser']==5){
				echo "<div id='sukses' class='alert alert-info'><strong>BERHASIL...</strong><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div><script>window.location ='user.php?id=home'</script>";
				mysqli_query($mysqli,"update tbl_user set status=1,w_login=NOW() where id_user='$id_user'");
			} elseif($_SESSION['leveluser']==6){
				echo "<div id='sukses' class='alert alert-info'><strong>BERHASIL...</strong><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div><script>window.location ='kabag.php?id=home'</script>";
				mysqli_query($mysqli,"update tbl_user set status=1,w_login=NOW() where id_user='$id_user'");
			} elseif($_SESSION['leveluser']==7){
				echo "<div id='sukses' class='alert alert-info'><strong>BERHASIL...</strong><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div><script>window.location ='manager.php?id=home'</script>";
				mysqli_query($mysqli,"update tbl_user set status=1,w_login=NOW() where id_user='$id_user'");
			}
		}
	
	}else{
		 echo "<div  class='alert alert-danger'>Mohon maaf password anda salah<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
	}

}
else{

  echo "<div  class='alert alert-danger'>Mohon maaf username anda tidak terdaftar<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
}
}

