<?php
 session_start();
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'  ) 

{


?>

<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Dashboard - ASKA Admin</title>

	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<link rel="shortcut icon" href="../favicon.ico" />
	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../assets/font-awesome/4.1.0/css/font-awesome.min.css" />
	
	<link rel="stylesheet" href="../assets/css/jquery-ui.custom.min.css" />
	<link rel="stylesheet" href="" />
	<link rel="stylesheet" href="../assets/css/bootstrap-editable.css" />	
	
	<!-- page specific plugin styles -->

	<!-- text fonts -->
	<link rel="stylesheet" href="../assets/fonts/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="../assets/css/ace.min.css" id="main-ace-style" />

	<!--[if lte IE 9]>
	<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
	<![endif]-->
	<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />

	<!--[if lte IE 9]>
	<link rel="stylesheet" href="assets/css/ace-ie.min.css" />
	<![endif]-->

	<!-- ace settings handler -->
	<script src="../assets/js/ace-extra.min.js"></script>
	<script src="../assets/js/time.js" type="text/javascript"></script>
	<script src="../assets/js/jquery.2.1.1.min.js"></script>
	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
    	<!--[if lte IE 8]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>


	<![endif]-->
</head>

<body onLoad="window.print()">





<?php 
include "../config/koneksi.php";
include "../config/fungsi_masakerja.php";
include "../config/fungsi_indotgl.php";

echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover h6 small' <tbody> ";
    echo "
    
    <tr >
        <td rowspan='2' align='center'><b>No Urut</b> </td>
        <td rowspan='2' align='center'><b>NAMA</b></td>
        <td rowspan='2' align='center'><b>NIP</b></td>
        <td colspan='4' align='center'><b>Pangkat/Jabatan</b></td>
        <td colspan='2' align='center'><b>Masa Kerja</b></td>
        <td colspan='4' align='center'><b>Latihan Jabatan</b></td>
        <td colspan='3' align='center'><b>Pendidikan</b></td>
        <td rowspan='2' align='center'><b>U<br>S<br>I<br>A</b></td>
        <td rowspan='2' align='center'><b>Catatan <br>Mutasi </br>Kepegawaian</b></td>
        <td rowspan='2' align='center'><b>Ket</b></td>
    </tr>

    <tr>
        <td align='center'>Gol.<br>Ruang</td>
        <td align='center'>T.M.T</td>
        <td align='center'>Nama</td>
        <td align='center'>T.M.T</td>  
        <td align='center'>THN</td>
        <td align='center'>BLN</td> 
        <td align='center'>Nama</td>
        <td align='center'>BLN</td>  
        <td align='center'>THN</td>
        <td align='center'>JML<br>JAM</td>  
        <td align='center'>Nama</td>
        <td align='center'>Lulus<br>THN</td>  
        <td align='center'>TKT<br>IJZ</td>
    </tr>
    ";

$query = "SELECT *,(year(curdate()) - year(tgl_lahir)) AS umur FROM pegawai order by id_jab DESC ";
$result = mysqli_query($mysqli,$query);
$no=1;
while ($data = mysqli_fetch_array($result))
{

    echo "
    <tr>
        <td>".$no++."</td>
        <td>".$data['nama']."</td>
        <td>".$data['nip']."</td>";
    $querygol=mysqli_query($mysqli,"SELECT b.gol,a.tmt_tgl from golongan a
        left join tbl_gol b on a.id_gol=b.id_gol 
        where a.id_gol='".$data['id_gol']."' and id='".$data['id']."'");
    $rowgol=mysqli_fetch_array($querygol);
        echo"<td>".$rowgol['gol']."</td>";
        echo"<td>".$rowgol['tmt_tgl']."</td>";

    $queryjab=mysqli_query($mysqli,"SELECT b.n_jab,a.tgl_jab from h_jabatan a
        left join jabatan b on a.kode=b.kode 
        where a.kode='".$data['id_jab']."' and id='".$data['id']."'");
    $rowjab=mysqli_fetch_array($queryjab);
        echo"<td>".$rowjab['n_jab']."</td>";
        echo"<td>".$rowjab['tgl_jab']."</td>";
        echo"<td>".MasaKerjaTahun($data['tgl_masuk'],$tahunM,$bulanM,$tanggalM)."</td>";
        echo"<td>".MasaKerjaBulan($data['tgl_masuk'],$tahunM,$bulanM,$tanggalM)."</td>";
    $querypelatihan=mysqli_query($mysqli,"select * from pelatihan where id='".$data['id']."'");
        echo"<td>";
        while ($rowpel=mysqli_fetch_array($querypelatihan)){
             echo"".$rowpel['topik_pelatihan']."";
             echo "<br>";
        }
        echo "</td>";
        echo"<td></td>";
        echo"<td></td>";
        echo"<td>";
    $querypelatihan2=mysqli_query($mysqli,"select * from pelatihan where id='".$data['id']."'");    
        while ($rowpel2=mysqli_fetch_array($querypelatihan2)){
             echo"".$rowpel2['jam']."";
             echo "<br>";
        }
        echo "</td>";

   
    $querypendidikan=mysqli_query($mysqli,"select a.*,b.nmpndidik from pendidikan a left join tbl_pendidikan b on a.kdpndidik=b.kdpndidik
        where a.id='".$data['id']."' and a.kdpndidik='".$data['kdpndidik']."' ");    
        $rowpen=mysqli_fetch_array($querypendidikan);
             echo"<td>".$rowpen['jurusan']."</td>";
             echo"<td>".$rowpen['t_pdk']."</td>";
             echo"<td>".$rowpen['nmpndidik']."</td>";
             echo"<td>".$data['umur']."</td>";
             echo"<td></td>";
             echo"<td></td>";
             

    echo"</tr>
    ";
}        


echo "</tbody></table> ";







?>


</body>
</html>
<?php
}else{
	  echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>