
<?php 
error_reporting(0);

$mod 			= isset($_GET['mod']) ? $_GET['mod'] : NULL;
$id_n 		    = isset($_GET['id_n']) ? $_GET['id_n'] : NULL;

if ($mod == "del") {
	$q_del = mysqli_query($mysqli,"DELETE FROM pegawai WHERE id = '$id_n'");

	if ($q_del > 0) {
		echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='icon-ok'></i>BERHASIL</strong> Data Pegawai Berhasil di hapus<br/></div>";
        mysqli_query($mysqli,"DELETE FROM golongan WHERE id = '$id_n'");
        mysqli_query($mysqli,"DELETE FROM pelatihan WHERE id = '$id_n'");
        mysqli_query($mysqli,"DELETE FROM pendidikan WHERE id = '$id_n");
        mysqli_query($mysqli,"DELETE FROM pengalaman_kerja WHERE id = '$id_n'");
        mysqli_query($mysqli,"DELETE FROM pengahargaan WHERE id = '$id_n'");
        mysqli_query($mysqli,"DELETE FROM h_jabatan WHERE id = '$id_n'");
        mysqli_query($mysqli,"DELETE FROM tbl_user WHERE id = '$id_n'");

    } else {
		echo "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='icon-remove'></i>MAAF!</strong>".mysql_error()."<br/></div>";
	}
}


$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'  ) 

{



?>

<div class="row">
<div class="col-xs-12">
<h3 class="header smaller lighter blue">Data Pegawai</h3>
<div class="table-header">
	Semua Daftar Data Pegawai
</div>

<!-- <div class="table-responsive"> -->

<!-- <div class="dataTables_borderWrap"> -->
<div class="table-responsive">
<table id="sample-table-2" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
<thead>
<tr>

	<th>NIP</th>
	<th>NAMA</th>
    <th>JABATAN</th>
	<th class="hidden-480">TELPON</th>

	<th>
		<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
		Alamat
	</th>
	<th>AKSI</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>

<?php
}else{
	  echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>	