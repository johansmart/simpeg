<?php
ob_start();
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1'&& $sesi_level !='3'){
    header('location:../index.php');

} 
 include "../fpdf17/fpdf.php";
 include "../config/koneksi.php";
$p_awal      	= isset($_POST['awal']) ? $_POST['awal'] : "";
$p_akhir      	= isset($_POST['akhir']) ? $_POST['akhir'] : "";
$ttd     		= isset($_POST['ttd']) ? $_POST['ttd'] : "";
$gabung		 	= "".$p_awal." s/d ".$p_akhir."";
 
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


$pdf->SetFont('Arial','B',14);
$pdf->Image('../'.$logo,1,1,2,2);

$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,$nm_pt,0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,'LAPORAN REKAP DATA ABSEN PEGAWAI Per Periode',0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,$alamat,0,'L');
	
$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,$gabung2,0,'L');	

$pdf->Line(1,3.1,29,3.1);
$pdf->SetLineWidth(0.1);
$pdf->Line(1,3.2,29,3.2);




}
$pdf->SetLineWidth(0);
$pdf->Ln();

$pdf->SetFont('Arial','',10);
$pdf->Cell(1.5,0.5,'Periode',0,0,'L');

$pdf->SetFont('Arial','',10);
$pdf->Cell(1.5,0.5,':',0,0,'C');

$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,$gabung,0,'L');

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
$hasil = mysqli_query($mysqli,"select nip, nama from pegawai where kdstatusp NOT IN ('0','4') ");
while ($data = mysqli_fetch_row($hasil)) {
			$nip_a	= $data[0];
			$nama	= $data[1];	

	  $hasilhadir = mysqli_query($mysqli,"SELECT count(*) as jum FROM absensi WHERE id_ijin ='0' and tanggal_absen between '$p_awal' and '$p_akhir' and nip='$nip_a'");
      $datahadir = mysqli_fetch_row($hasilhadir);
      $jumlahhadir = $datahadir[0];
	  
	  $hasilsakit = mysqli_query($mysqli,"SELECT count(*) as jum FROM absensi WHERE id_ijin = '2' and tanggal_absen between '$p_awal' and '$p_akhir' and nip='$nip_a'");
      $datasakit = mysqli_fetch_row($hasilsakit);
      $jumlahsakit = $datasakit[0];
	  
	  $hasilijin = mysqli_query($mysqli,"SELECT count(*) as jum FROM absensi WHERE id_ijin = '1' and tanggal_absen between '$p_awal' and '$p_akhir' and nip='$nip_a'");
      $dataijin = mysqli_fetch_row($hasilijin);
      $jumlahijin = $dataijin[0];
	  
	  $hasilcuti = mysqli_query($mysqli,"SELECT  sum(lama_cuti) as jum FROM ajuancuti WHERE tgl_pengajuan between '$p_awal' and '$p_akhir' and nip='$nip_a'");
      $datacuti = mysqli_fetch_row($hasilcuti);
	  if ($datacuti[0]==0){
		  $jumlahcuti = 0;
	  }else {
		   $jumlahcuti = $datacuti[0];
	  }
     
	  
	  $hasilalfa = mysqli_query($mysqli,"SELECT count(*) as jum FROM absensi WHERE id_ijin = '4' and tanggal_absen between '$p_awal' and '$p_akhir' and nip='$nip_a'");
      $dataalfa = mysqli_fetch_row($hasilalfa);
      $jumlahalfa = $dataalfa[0];
	  
	 

$pdf->SetFillColor(255,255,255);
$pdf->Cell(1,0.8,$no++,1,0,'C',true);
$pdf->Cell(3,0.8,$nip_a,1,0,'C',true);
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