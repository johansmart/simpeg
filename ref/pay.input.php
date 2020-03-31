<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  ) 

{
include "../config/koneksi.php";
error_reporting(0);

if(isset($_POST['hapus'])) {
	mysqli_query($mysqli,"DELETE FROM tbl_payroll WHERE idpay=".$_POST['hapus']);
} else {
	// deklarasikan variabel
	$idpay	= $_POST['idpay'];
	$kode	= $_POST['kode'];
	$nm_pay	= $_POST['nm_pay'];
	$pengurang	= $_POST['pengurang'];
	$penambah	= $_POST['penambah'];
	$ket    	= $_POST['ket'];
	

	if($kode!="") {

		if($idpay == 0) {
			mysqli_query($mysqli,"INSERT INTO tbl_payroll VALUES('','$kode','$nm_pay','$penambah','$pengurang','$ket')");

		} else {
			$q_pay=mysqli_query($mysqli,"UPDATE tbl_payroll SET
			kode = '$kode',
			nm_pay = '$nm_pay',
			pengurang = '$pengurang',
			penambah = '$penambah',
			keterangan = '$ket'
			WHERE idpay= $idpay
			");
			
			if ($q_pay) {
					echo "<h4 class='alert_success'>Data berhasil ditambahkan <a href=''>Cetak</a><span id='close'>[<a href='#'>X</a>]</span></h4>";
				} else {
					echo "<h4 class='alert_error'>".mysqli_error($mysqli)."<span id='close'>[<a href='#'>X</a>]</span></h4>";
				}
			
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