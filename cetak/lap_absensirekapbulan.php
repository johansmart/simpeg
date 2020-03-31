<?php
ob_start();
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1' && $sesi_level !='3'){
    header('location:../index.php');

} 

 include "../fpdf17/fpdf.php";
 include "../config/koneksi.php";

$pdf=new FPDF('P','cm','A4');
$pdf->AddPage();

$query = mysqli_query($mysqli,"SELECT * FROM master");
while ($data1 = mysqli_fetch_row($query)) {
$nm_pt		=$data1[1];
$alamat		=$data1[2];
$logo		=$data1[5];
$email_pt	=$data1[6];
$web		=$data1[7];
$gabung2	= "Web:".$web." Email:".$email_pt."";

if ($_POST['bulan']=='01'){
	$lap = "LAPORAN REKAP DATA ABSEN PEGAWAI BULAN JANUARI TAHUN  ".$_POST['tahun']." ";
} else if ($_POST['bulan']=='02'){
		$lap = "LAPORAN REKAP DATA ABSEN PEGAWAI BULAN JANUARI TAHUN  ".$_POST['tahun']." ";
} else if ($_POST['bulan']=='03'){
		$lap = "LAPORAN REKAP DATA ABSEN PEGAWAI BULAN JANUARI TAHUN  ".$_POST['tahun']." ";
} else if ($_POST['bulan']=='04'){
		$lap = "LAPORAN REKAP DATA ABSEN PEGAWAI BULAN JANUARI TAHUN  ".$_POST['tahun']." ";
} else if ($_POST['bulan']=='05'){
		$lap = "LAPORAN REKAP DATA ABSEN PEGAWAI BULAN JANUARI TAHUN  ".$_POST['tahun']." ";
} else if ($_POST['bulan']=='06'){
		$lap = "LAPORAN REKAP DATA ABSEN PEGAWAI BULAN JANUARI TAHUN  ".$_POST['tahun']." ";
} else if ($_POST['bulan']=='07'){
		$lap = "LAPORAN REKAP DATA ABSEN PEGAWAI BULAN JANUARI TAHUN  ".$_POST['tahun']." ";
} else if ($_POST['bulan']=='08'){
		$lap = "LAPORAN REKAP DATA ABSEN PEGAWAI BULAN JANUARI TAHUN  ".$_POST['tahun']." ";
} else if ($_POST['bulan']=='09'){
		$lap = "LAPORAN REKAP DATA ABSEN PEGAWAI BULAN JANUARI TAHUN  ".$_POST['tahun']." ";
} else if ($_POST['bulan']=='10'){
		$lap = "LAPORAN REKAP DATA ABSEN PEGAWAI BULAN JANUARI TAHUN  ".$_POST['tahun']." ";
} else if ($_POST['bulan']=='11'){
		$lap = "LAPORAN REKAP DATA ABSEN PEGAWAI BULAN JANUARI TAHUN  ".$_POST['tahun']." ";
} else if ($_POST['bulan']=='12'){
		$lap = "LAPORAN REKAP DATA ABSEN PEGAWAI BULAN JANUARI TAHUN  ".$_POST['tahun']." ";
} 

$pdf->SetFont('Arial','B',14);
$pdf->Image('../'.$logo,1,1,2,2);

$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,$nm_pt,0,'L');



$pdf->SetFont('Arial','B',10);
$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,$lap,0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,$alamat,0,'L');
	
$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,$gabung2,0,'L');	

$pdf->Line(1,3.1,29,3.1);
$pdf->SetLineWidth(0.1);
$pdf->Line(1,3.2,29,3.2);



$pdf->SetLineWidth(0);
$pdf->Ln();
}

$pdf->SetFont('Arial','B',10);
$pdf->Cell(1,0.8,'NO',1,0,'C');
$pdf->Cell(3,0.8,'NIP',1,0,'C');
$pdf->Cell(5,0.8,'NAMA',1,0,'C');
$pdf->Cell(2,0.8,'HADIR',1,0,'C');
$pdf->Cell(2,0.8,'SAKIT',1,0,'C');
$pdf->Cell(2,0.8,'IJIN',1,0,'C');
$pdf->Cell(2,0.8,'CUTI',1,0,'C');
$pdf->Cell(2,0.8,'ALFA',1,0,'C');

$pdf->SetFont('Arial','',10);
$pdf->Ln();


$no = 1;
$p_bulan      	= isset($_POST['bulan']) ? $_POST['bulan'] : "";
$p_tahun      	= isset($_POST['tahun']) ? $_POST['tahun'] : "";
$ttd     		= isset($_POST['ttd']) ? $_POST['ttd'] : "";

$hasil = mysqli_query($mysqli,"select nip, nama from pegawai where kdstatusp NOT IN ('0','4')");
while ($data = mysqli_fetch_row($hasil)){
			$nip		= $data[0];
			$nama		= $data[1];	
              $hasil2 	= mysqli_query($mysqli,"SELECT count(*) as jum FROM absensi WHERE nip = '$nip' and month(tanggal_absen)='$p_bulan' and year(tanggal_absen)='$p_tahun' and id_ijin='3' ");
              $data2 	= mysqli_fetch_row($hasil2);
              $jumlahcuti = $data2[0];
			 
			  
			  
	  $hasilhadir = mysqli_query($mysqli,"SELECT count(*) as jum FROM absensi WHERE nip = '$nip' and month(tanggal_absen)='$p_bulan' and year(tanggal_absen)='$p_tahun' and id_ijin='0' ");
      $datahadir = mysqli_fetch_row($hasilhadir);
      $jumlahhadir = $datahadir[0];
	  
	  $hasilsakit = mysqli_query($mysqli,"SELECT count(*) as jum FROM absensi WHERE nip = '$nip' and month(tanggal_absen)='$p_bulan' and year(tanggal_absen)='$p_tahun' and id_ijin='2' ");
      $datasakit = mysqli_fetch_row($hasilsakit);
      $jumlahsakit = $datasakit[0];
	  
	  $hasilijin = mysqli_query($mysqli,"SELECT count(*) as jum FROM absensi WHERE nip = '$nip' and month(tanggal_absen)='$p_bulan' and year(tanggal_absen)='$p_tahun' and id_ijin='1' ");
      $dataijin = mysqli_fetch_row($hasilijin);
      $jumlahijin = $dataijin[0];
	  
	  $hasilcuti = mysqli_query($mysqli,"SELECT count(*) as jum FROM absensi WHERE nip = '$nip' and month(tanggal_absen)='$p_bulan' and year(tanggal_absen)='$p_tahun' and id_ijin='3' ");
      $datacuti = mysqli_fetch_row($hasilcuti);
      $jumlahcuti = $datacuti[0];
	  
	  $hasilcuti = mysqli_query($mysqli,"SELECT  sum(lama_cuti) as jum FROM ajuancuti WHERE month(tgl_pengajuan)='$p_bulan' and year(tgl_pengajuan)='$p_tahun' and nip='$nip'");
      $datacuti = mysqli_fetch_row($hasilcuti);
      $jumlahcuti = $datacuti[0];
	  
	  if ($datacuti[0]==0){
		  $jumlahcuti = 0;
	  }else {
		   $jumlahcuti = $datacuti[0];
	  }
	  
	  
	  $hasilalfa = mysqli_query($mysqli,"SELECT count(*) as jum FROM absensi WHERE nip = '$nip' and month(tanggal_absen)='$p_bulan' and year(tanggal_absen)='$p_tahun' and id_ijin='4' ");
      $dataalfa = mysqli_fetch_row($hasilalfa);
      $jumlahalfa = $dataalfa[0];

$pdf->SetFillColor(255,255,255);
$pdf->Cell(1,0.8,$no++,1,0,'C',true);
$pdf->Cell(3,0.8,$nip,1,0,'C',true);
$pdf->Cell(5,0.8,$nama,1,0,'L',true);
$pdf->Cell(2,0.8,$jumlahhadir,1,0,'C',true);
$pdf->Cell(2,0.8,$jumlahsakit,1,0,'C',true);
$pdf->Cell(2,0.8,$jumlahijin,1,0,'C',true);
$pdf->Cell(2,0.8,$jumlahcuti,1,0,'C',true);
$pdf->Cell(2,0.8,$jumlahalfa,1,0,'C',true);
$pdf->Ln();
}

$pdf->SetFont('Arial','B',10);
$pdf->SetX(1);
$pdf->MultiCell(15,3,'HRD',0,'R');

$pdf->SetFont('Arial','B',10);
$pdf->SetX(1);
$pdf->MultiCell(15,0.5,'ttd',0,'R');

$pdf->SetFont('Arial','B',10);
$pdf->SetX(1);
$pdf->MultiCell(15,0.8,$ttd,0,'R');

$pdf->Ln();
$pdf->Output();

?>