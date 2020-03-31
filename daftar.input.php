<?php
error_reporting(0);
include "config/koneksi.php";

$username	= trim($_POST['username2']);
$password	= $_POST['password2'];
$hash 		= password_hash($password, PASSWORD_DEFAULT);
$email		= trim($_POST['email2']);
$nip		= trim($_POST['nip']);



$cek_username	=mysqli_num_rows(mysqli_query($mysqli,"SELECT username FROM tbl_user WHERE username='$username'"));
$ceknipdaftar	=mysqli_num_rows(mysqli_query($mysqli,"SELECT nip FROM tbl_user WHERE nip='$nip'"));
$cek_email		=mysqli_num_rows(mysqli_query($mysqli,"SELECT email FROM tbl_user WHERE email='$email'"));
$cek_nip		=mysqli_num_rows(mysqli_query($mysqli,"SELECT nip FROM pegawai WHERE nip='$nip'"));

	
if ($cek_username > 0){
    echo "<div id='gagal' class='alert alert-danger'>Maaf Username sudah terdaftar<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";

	} else if ($cek_nip ==0 ) {

    echo "<div id='gagal' class='alert alert-danger'>Mohon maaf NIP anda tidak terdaftar mohon menghubungi HRD<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
   
	}else if ($cek_email > 0){
    echo "<div id='gagal' class='alert alert-danger'>Mohon maaf Email anda tidak terdaftar<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";

	}else if ($ceknipdaftar > 0){
    echo "<div id='gagal' class='alert alert-danger'>Mohon maaf NIP anda sudah terdaftar<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";



}else {$inputuser=mysqli_query($mysqli,"INSERT INTO tbl_user(id_user,username,
                                 pass,
                                 email,
                                 level_user,w_daftar,nip,photo,kd_approve)
								VALUES('','$username',
								'$hash',
								'$email',
								'5',NOW(),'$nip','../assets/avatars/avatar5.png','3')") ;
								
    mysqli_query($mysqli, "UPDATE tbl_user a, pegawai b SET a.id= b.id WHERE a.nip=b.nip and a.nip='$nip';");
	if ($inputuser > 0){
		 echo "<div id='sukses' class='alert alert-info'><strong>BERHASIL...Mohon tunggu konfirmasi dari HRD</strong><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
		
	}else{
		 echo "<div id='sukses' class='alert alert-danger'><strong>GAGAL Daftar User Baru</strong><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
	}
   
} 
										 
	
?>
