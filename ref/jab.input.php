

<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  ) 

{
include "../config/koneksi.php";
error_reporting(0);


// buat koneksi ke database mysql


// proses menghapus data mahasiswa
if(isset($_POST['hapus1'])) {
	mysqli_query($mysqli,"DELETE FROM jabatan WHERE id_jab=".$_POST['hapus1']);
} else {
	// deklarasikan variabel
	$id_jab	= $_POST['id_jab'];
	$kode	= $_POST['kode'];
	$n_jab	= $_POST['n_jab'];
	$gapok	= $_POST['gapok'];
	$tunj_jab	= $_POST['tunj_jab'];
	$m_kerja	= $_POST['m_kerja'];
	
	// validasi agar tidak ada data yang kosong
	if($kode!="") {
		// proses tambah data mahasiswa
		if($id_jab == 0) {
			mysqli_query($mysqli,"INSERT INTO jabatan VALUES('','$kode','$n_jab','$gapok','$tunj_jab','$m_kerja')");
		// proses ubah data mahasiswa
		} else {
			$q_jab=mysqli_query($mysqli,"UPDATE jabatan SET 
			kode = '$kode',
			n_jab = '$n_jab',
			gapok = '$gapok',
			tunj_jab = '$tunj_jab',
			m_kerja = '$m_kerja'
			WHERE id_jab= $id_jab
			");
			
			if ($q_jab) {
					echo "<h4 class='alert_success'>Data berhasil ditambahkan <a href=''>Cetak</a><span id='close'>[<a href='#'>X</a>]</span></h4>";
				} else {
					echo "<h4 class='alert_error'>".mysql_error()."<span id='close'>[<a href='#'>X</a>]</span></h4>";
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