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
$pdf->MultiCell(19.5,0.5,'LAPORAN REKAP DATA CUTI PEGAWAI Per Periode',0,'L');

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
$pdf->Cell(4,0.8,'NIP',1,0,'C');
$pdf->Cell(6,0.8,'NAMA',1,0,'C');
$pdf->Cell(1.5,0.8,'CM',1,0,'C');
$pdf->Cell(1.5,0.8,'CN',1,0,'C');
$pdf->Cell(1.5,0.8,'CS',1,0,'C');
$pdf->Cell(1.5,0.8,'CT',1,0,'C');
$pdf->Cell(1.5,0.8,'CAP',1,0,'C');

$pdf->SetFont('Arial','',10);
$pdf->Ln();


$no = 1;
$hasil = mysqli_query($mysqli,"select nip, nama from pegawai where kdstatusp NOT IN ('0','4')");
while ($data = mysqli_fetch_row($hasil)) {
			$nip	= $data[0];
			$nama	= $data[1];	

	 //query untuk menghitung CM		
	  $queryCM = mysqli_query($mysqli,"SELECT sum(lama_cuti) as jum FROM ajuancuti WHERE id_cuti ='4' and kd_approve='1' and tgl_pengajuan between '$p_awal' and '$p_akhir' and nip='$nip'  ");
      $rowCM = mysqli_fetch_row($queryCM);
      $hasilCM = $rowCM[0];
	  
	  //query untuk menghitung CN
	  $queryCN = mysqli_query($mysqli,"SELECT sum(lama_cuti)  as jum FROM ajuancuti WHERE id_cuti ='7' and kd_approve='1' and tgl_pengajuan between '$p_awal' and '$p_akhir' and nip='$nip' ");
      $rowCN = mysqli_fetch_row($queryCN);
      $hasilCN = $rowCN[0];
	  
	  //query untuk menghitung CS
	  $queryCS = mysqli_query($mysqli,"SELECT sum(lama_cuti)  as jum FROM ajuancuti WHERE id_cuti ='3' and kd_approve='1' and tgl_pengajuan between '$p_awal' and '$p_akhir' and nip='$nip' ");
      $rowCS = mysqli_fetch_row($queryCS);
      $hasilCS = $rowCS[0];
	  
	  //query untuk menghitung CT
	  $queryCT = mysqli_query($mysqli,"SELECT sum(lama_cuti)  as jum FROM ajuancuti WHERE id_cuti ='1' and kd_approve='1' and tgl_pengajuan between '$p_awal' and '$p_akhir' and nip='$nip'  ");
      $rowCT = mysqli_fetch_row($queryCT);
      $hasilCT = $rowCT[0];
	  
	  //query untuk menghitung CB
	  $queryCAP = mysqli_query($mysqli,"SELECT sum(lama_cuti)  as jum FROM ajuancuti WHERE id_cuti ='2' and kd_approve='1' and tgl_pengajuan between '$p_awal' and '$p_akhir' and nip='$nip'  ");
      $rowCAP = mysqli_fetch_row($queryCAP);
      $hasilCAP = $rowCAP[0];
      
	  
			

$pdf->SetFillColor(255,255,255);
$pdf->Cell(1,0.8,$no++,1,0,'C',true);
$pdf->Cell(4,0.8,$nip,1,0,'L',true);
$pdf->Cell(6,0.8,$nama,1,0,'L',true);
$pdf->Cell(1.5,0.8,$hasilCM,1,0,'C',true);
$pdf->Cell(1.5,0.8,$hasilCN,1,0,'C',true);
$pdf->Cell(1.5,0.8,$hasilCS,1,0,'C',true);
$pdf->Cell(1.5,0.8,$hasilCT,1,0,'C',true);
$pdf->Cell(1.5,0.8,$hasilCAP,1,0,'C',true);
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



$pdf->SetFont('Arial','B',8);
$pdf->SetX(1);
$pdf->MultiCell(10,0.8,"Keterangan:",0,'L');

$pdf->SetFont('Arial','B',8);
$pdf->SetX(1);
$pdf->MultiCell(10,0.8,"CM=Cuti Melahirkan",0,'L');

$pdf->SetFont('Arial','B',8);
$pdf->SetX(1);
$pdf->MultiCell(10,0.8,"CN=Cuti Nikah",0,'L');


$pdf->SetFont('Arial','B',8);
$pdf->SetX(1);
$pdf->MultiCell(10,0.8,"CS=Cuti Sakit",0,'L');

$pdf->SetFont('Arial','B',8);
$pdf->SetX(1);
$pdf->MultiCell(10,0.8,"CT=Cuti Tahunan",0,'L');


$pdf->SetFont('Arial','B',8);
$pdf->SetX(1);
$pdf->MultiCell(10,0.8,"CAP=Cuti Alasan Penting",0,'L');





$pdf->Ln();
$pdf->Output();

?>