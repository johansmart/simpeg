<?php
ob_start();
include "../config/koneksi.php";
require_once '../dompdf/autoload.inc.php';
include "../config/fungsi_indotgl.php";

$nip 		= isset($_GET['nip']) ? $_GET['nip'] : "";
$kd_cuti 	= isset($_GET['kdcuti']) ? $_GET['kdcuti'] : "";

$query=mysqli_query($mysqli,"select a.nama,a.nip,b.gol,c.n_jab from pegawai a 
	left join tbl_gol b on a.id_gol=b.id_gol 
	left join jabatan c on a.id_jab=c.kode 
	where nip='$nip'");

$row=mysqli_fetch_array($query);

$query2=mysqli_query($mysqli,"select *,year(tgl_pengajuan) as tahun from ajuancuti where kdcuti='$kd_cuti'");

$row2=mysqli_fetch_array($query2);
// mysqli_query($mysqli,"update ajuancuti set cetak='1' where kdcuti='$kd_cuti'");


$html = "
<html>
<body>
<div style='text-align: center;''>
<h1></h1>
</div>
<div style='text-align: right;'>
	<p><i>10 Agustus 2016</i></p>
</div>
<div style='text-align: center;'>
	<p>
		<u><i>".tgl_indo($row2['tgl_approve'])."</i></u><br>
		Nomor : 
	</p>
</div>
<div style='text-align: left;'>
	<table>
		<tr>
			<td>1.</td>
			<td></td>
			<td colspan='3'>Diberikan cuti sakit kepada :</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Nama</td>
			<td>: ".$row['nama']."</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Nomor Induk Pegawai</td>
			<td>: ".$row['nip']."</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Pangkat/gol.ruang</td>
			<td>: ".$row['gol']."</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Jabatan</td>
			<td>: ".$row['n_jab']."</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td colspan='2'>Selama <i>".$row2['lama_cuti']." hari</i> kerja terhitung mulai tanggal <i>".tgl_indo($row2['tgl_mulai'])."</i> sampai dengan <i>".tgl_indo($row2['tgl_akhir'])."</i> dengan ketentuan setelah berakhir jangka waktu cuti sakit tersebut, wajib melaporkan diri kepada atasan langsungnya dan bekerja kembali sebagaimana biasa.</td>
		</tr>
		<tr>
			<td>2.</td>
			<td></td>
			<td colspan='2'>Demikian surat izin cuti sakit ini dibuat untuk dapat digunakan sebagaimana mestinya.</td>
		</tr>
		<tr>
			<td colspan='3'></td>
			<td>
				<i>
					Pejabat Cuti<br><br><br><br>
					<br>
					NIP. ......................
				</i>
			</td>
		</tr>
	</table>
</div>
</body>
</html>";
 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('surat_cuti_sakit.pdf');
?>