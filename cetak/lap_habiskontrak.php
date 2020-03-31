<?php
ob_start();
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username)){
 include "../fpdf17/fpdf.php";
 include "../config/koneksi.php";
 include "../config/fungsi_indotgl.php";

$pdf=new FPDF('P','cm','A4');
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
$pdf->MultiCell(19.5,0.5,'LAPORAN PEGAWAI HABIS KONTRAK',0,'L');

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
$pdf->Cell(4,0.8,'Nip',1,0,'C');
$pdf->Cell(7,0.8,'NAMA',1,0,'C');
$pdf->Cell(4,0.8,'TANGGAL',1,0,'C');
$pdf->Cell(2,0.8,'SISA HARI',1,0,'C');



$pdf->SetFont('Arial','',10);
$pdf->Ln();



$hasi=mysqli_query($mysqli,"SELECT a.id,a.nip,a.nama,a.foto,datediff(a.tgl_kontrak,current_date()) as sisa,a.tgl_kontrak,b.username from pegawai a 
left join tbl_user b on a.id=b.id 
where datediff(a.tgl_kontrak,current_date()) BETWEEN 1 and 30");
$no = 1;

while($hasil=mysqli_fetch_array($hasi)){

$pdf->SetFillColor(255,255,255);
$pdf->Cell(1,0.8,$no++,1,0,'L',true);
$pdf->Cell(4,0.8,$hasil['nip'],1,0,'L',true);
$pdf->Cell(7,0.8,$hasil['nama'],1,0,'L',true);
$pdf->Cell(4,0.8,tgl_indo($hasil['tgl_kontrak']),1,0,'L',true);
$pdf->Cell(2,0.8,$hasil['sisa'],1,0,'L',true);
	


$pdf->Ln();
}

$pdf->Ln();
$pdf->Output();
} else {
 header('location:../index.php');
}
?>