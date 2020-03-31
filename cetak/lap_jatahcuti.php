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
$pdf->MultiCell(19.5,0.5,'LAPORAN JATAH CUTI PEGAWAI ',0,'L');

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



$pdf->SetFont('Arial','B',10);
$pdf->Cell(1,0.8,'NO',1,0,'C');
$pdf->Cell(3,0.8,'NIP',1,0,'C');
$pdf->Cell(7,0.8,'NAMA',1,0,'C');
$pdf->Cell(2,0.8,'JATAH',1,0,'C');
$pdf->Cell(2,0.8,'AMBIL',1,0,'C');
$pdf->Cell(2,0.8,'SISA',1,0,'C');
$pdf->Cell(2,0.8,'TAHUN',1,0,'C');

$pdf->SetFont('Arial','',10);
$pdf->Ln();


$no = 1;
$hasil = mysqli_query($mysqli,"select a.nip,b.nama,a.jatahcuti,a.cutiambil,a.sisacuti,a.tahun FROM tbl_jatahcuti a
left join pegawai b on a.nip=b.nip");
while ($data = mysqli_fetch_row($hasil)) {
			$nip		= $data[0];
			$nama		= $data[1];	
			$jatahcuti	= $data[2];	
			$cutiambil	= $data[3];	
			$sisacuti	= $data[4];	
			$tahun		= $data[5];	
			
$pdf->SetFillColor(255,255,255);
$pdf->Cell(1,0.8,$no++,1,0,'C',true);
$pdf->Cell(3,0.8,$nip,1,0,'C',true);
$pdf->Cell(7,0.8,$nama,1,0,'L',true);
$pdf->Cell(2,0.8,$jatahcuti,1,0,'C',true);
$pdf->Cell(2,0.8,$cutiambil,1,0,'C',true);
$pdf->Cell(2,0.8,$sisacuti,1,0,'C',true);
$pdf->Cell(2,0.8,$tahun,1,0,'C',true);

$pdf->Ln();
}

$pdf->SetFont('Arial','B',10);
$pdf->SetX(1);
$pdf->MultiCell(15,3,'HRD',0,'R');

$pdf->SetFont('Arial','B',10);
$pdf->SetX(1);
$pdf->MultiCell(15,0.5,'ttd',0,'R');

$pdf->Ln();
$pdf->Output();

?>