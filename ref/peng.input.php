<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  ) 

{
include "../config/koneksi.php";
error_reporting(0);



if(isset($_POST['hapus1'])) {
	mysqli_query($mysqli,"DELETE FROM tbl_peng WHERE id_pes=".$_POST['hapus1']);
} else {

	$id_pes	= $_POST['id_pes'];
	$header	= $_POST['header'];
	$body	= $_POST['body'];
	$footer	= $_POST['footer'];
	
	
	if($header!="") {

		if($id_pes == 0) {
			mysqli_query($mysqli,"INSERT INTO tbl_peng VALUES('','$header','$body','$footer',NOW())");
		
		} else {
			$q_jab=mysqli_query($mysqli,"UPDATE tbl_peng SET 
			header = '$header',
			body = '$body',
			footer = '$footer'
			WHERE id_pes= $id_pes
			");
			
		}
	}
}

?>
<?php
}else{
	session_destroy();
	header('Location:../index.php?status=Silahkan Login');
}
?>