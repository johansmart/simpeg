<?php
$id_cuti	= isset($_GET['kdcuti']) ? $_GET['kdcuti'] : NULL;
$mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;

// ================ DATA FORM ( POST ) =====================//
$display 		= "style='display: none'"; 	//default = formnya dihidden
$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;				//ambil variabel POST value Tombol FOrm
$p_kd_cuti 		= isset($_POST['kdcuti']) ? $_POST['kdcuti'] : NULL;
$p_kd_approve 	= isset($_POST['kd_approve']) ? $_POST['kd_approve'] : NULL;
$p_id_cuti		= isset($_POST['id_cuti']) ? $_POST['id_cuti'] : NULL;
$p_pesan_approve= isset($_POST['pesan']) ? $_POST['pesan'] : NULL;
$nip_u			= isset($_POST['nip']) ? $_POST['nip'] : NULL;
$tgl_awal		= $_POST['tgl_awal'];
$tgl_akhir		= $_POST['tgl_akhir'];
$lama			= isset($_POST['lama']) ? $_POST['lama'] : NULL;
$alasan			= isset($_POST['alasan']) ? $_POST['alasan'] : NULL;	


			$queryjatahcuti=mysqli_query($mysqli,"select * from tbl_jatahcuti where nip='$nip_u'");
			$rowjatah=mysqli_fetch_array($queryjatahcuti);
			$jatahcuti=$rowjatah['jatahcuti'];
			$cutiambil=$rowjatah['cutiambil'];
			$sisacuti=$rowjatah['sisacuti'];

			$hasilcutidiambil=$cutiambil + $lama; 
			$hasilsisa=$jatahcuti - $hasilcutidiambil;


$kdcuti 		    = isset($_GET['kdcuti']) ? $_GET['kdcuti'] : NULL;

if ($mod == "del") {
	$q_del = mysqli_query($mysqli,"DELETE FROM ajuancuti WHERE kdcuti = '$id_cuti'");

	if ($q_del > 0) {
		echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='icon-ok'></i>BERHASIL</strong> Data Cuti Pegawai Berhasil di hapus<br/></div>";

    } else {
		echo "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='icon-remove'></i>MAAF!</strong>".mysql_error()."<br/></div>";
	}
}

if ($tb_act == "Konfirmasi") {
    $display = "style='display: none'";
	$querycek="select * from ajuancuti where nip='$nip' and tgl_mulai='$tgl_awal' and tgl_akhir='$tgl_akhir' and kd_approve='1'";
	$hasil=mysqli_query($mysqli,$querycek);
	$ketemu=mysqli_num_rows($hasil);
	if ($ketemu > 0){
		  echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Anda sudah Approve data ini sebelumnya<br/></div>";
	} else {
		
		if($p_kd_approve==1 && $p_id_cuti==1){
			
			$q_edit_cuti	= mysqli_query($mysqli,"UPDATE ajuancuti SET kd_approve = '$p_kd_approve',tgl_approve=NOW(),pesan_approve='$p_pesan_approve',kdnotif='1' WHERE kdcuti='$p_kd_cuti'");
			if($_SESSION['leveluser']=='1'){
				mysqli_query($mysqli, "update tbl_jatahcuti set cutiambil='$hasilcutidiambil', sisacuti='$hasilsisa' WHERE tahun=NOW() and  nip='$nip_u'") ;
			}
				
	
		}else {
			$q_edit_cuti	= mysqli_query($mysqli,"UPDATE ajuancuti SET kd_approve = '$p_kd_approve',tgl_approve=NOW(),pesan_approve='$p_pesan_approve',kdnotif='1' WHERE kdcuti='$p_kd_cuti'");
		}
		
	
	
    if ($q_edit_cuti > 0) {	
    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL </strong>Data Cuti Berhasil di Konfirmasiiii <br/></div>";
       
    } else {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
    }
		
	//if ($p_kd_approve==1){
		
		//while (strtotime($tgl_awal)<=strtotime($tgl_akhir)){
		//$sql="INSERT INTO absensi (nip,tanggal_absen,ket,id_ijin) VALUES ('$nip_u','$tgl_awal\n','$alasan','3')";
		//$hasil=mysqli_query($mysqli,$sql);
		//$tgl_awal=date("Y-m-d",strtotime("+1 day",strtotime($tgl_awal)));
		//} 		
	//}	
		
		
	
}
}
	
  
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='3' || $_SESSION['leveluser']=='6' ||$_SESSION['leveluser']=='7' )

{

?>

<div class="row">
<div class="col-xs-12">
<h3 class="header smaller lighter blue">Data Cuti Pegawai</h3>
<div class="col-xs-12">
<a href="?id=inputcuti" class="btn btn-success">Input Cuti</a>
<a href="?id=rekapcuti" class="btn btn-danger">Rekap Cuti</a>
<a href="?id=datajatah" class="btn btn-warning">Jatah Cuti</a>
</div>
<div class="table-header">
	Semua Daftar
</div>

<!-- <div class="table-responsive"> -->

<!-- <div class="dataTables_borderWrap"> -->
<div>
<table id="sample-table-2" class="table table-striped table-bordered table-hover">
<thead>
<tr>
	<th>NIP</th>
	<th>NAMA</th>
    <th>TANGGAL</th>
	<th>CUTI</th>

	<th>
		<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
		Tanggal Awal
	</th>
	<th>
		<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
		Tanggal Akhir
	</th>
    <th>Lama Cuti</th>
    <th>Alasan</th>
	<th>STATUS</th>

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