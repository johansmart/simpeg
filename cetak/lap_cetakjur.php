<?php
ob_start();
session_start();

$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1'){
    header('location:../index.php');

} 
function rupiah($nilai, $pecahan = 0) {
    return number_format($nilai, $pecahan, ',', '.');
};


 include "../fpdf17/fpdf.php";
 include "../config/koneksi.php";

$pdf=new FPDF('L','cm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);

$query = mysqli_query($mysqli,"SELECT * FROM master");
while ($data1 = mysqli_fetch_row($query)) {
$nm_pt		=$data1[1];
$alamat		=$data1[2];
$logo		=$data1[5];
$email_pt	=$data1[6];
$web		=$data1[7];
$gabung2	= "Web:".$web." Email:".$email_pt."";


$pdf->Image('../'.$logo,1,1,2,2);

$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,$nm_pt,0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,'LAPORAN DATA JABATAN',0,'L');

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

$pdf->SetFont('Arial','B',10);


$pdf->Cell(1,0.8,'NO',1,0,'C');
$pdf->Cell(1.5,0.8,'KODE',1,0,'C');
$pdf->Cell(7,0.8,'JABATAN',1,0,'C');
$pdf->Cell(4,0.8,'GAPOK (Rp)',1,0,'C');
$pdf->Cell(4,0.8,'Tunjangan (Rp)',1,0,'C');
$pdf->Cell(6,0.8,'Masa Kerja (Rp)',1,0,'C');

$pdf->SetFont('Arial','',10);
$pdf->Ln();



$hasi=mysqli_query($mysqli,"SELECT * FROM jabatan order by id_jab desc");
$no = 1;

while($hasil=mysqli_fetch_array($hasi)){

$pdf->SetFillColor(255,255,255);
$pdf->Cell(1,0.8,$no++,1,0,'C',true);
$pdf->Cell(1.5,0.8,$hasil[1],1,0,'C',true);
$pdf->Cell(7,0.8,$hasil[2],1,0,'L',true);
$pdf->Cell(4,0.8,rupiah($hasil[3]),1,0,'L',true);
$pdf->Cell(4,0.8,rupiah($hasil[4]),1,0,'L',true);
$pdf->Cell(6,0.8,rupiah($hasil[5]),1,0,'L',true);
$pdf->Ln();
}



$pdf->SetFont('Arial','B',10);
$pdf->SetX(1);
$pdf->MultiCell(25,3,'HRD',0,'R');

$pdf->SetFont('Arial','B',10);
$pdf->SetX(1);
$pdf->MultiCell(25,0.5,'ttd',0,'R');

$pdf->SetFont('Arial','B',10);
$pdf->SetX(1);
$pdf->MultiCell(25,0.8,'MUHLIS, S.Kom',0,'R');

$pdf->Ln();
$pdf->Output();

?>