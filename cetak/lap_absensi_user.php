<?php
ob_start();
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='5'){
    header('location:../index.php');

} 
 include "../fpdf17/fpdf.php";
 include "../config/koneksi.php";
$p_awal      	= isset($_POST['awal']) ? $_POST['awal'] : "";
$p_akhir      	= isset($_POST['akhir']) ? $_POST['akhir'] : "";
$nip     		= isset($_POST['nip']) ? $_POST['nip'] : "";
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
$pdf->MultiCell(19.5,0.5,'LAPORAN ABSENSI PEGAWAI Per Periode',0,'L');

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



$querynm = mysqli_query($mysqli,"SELECT nama FROM pegawai where nip='$nip'");
while ($data2 = mysqli_fetch_array($querynm)) {
	$nama=$data2[0];
	
$pdf->SetFont('Arial','',10);
$pdf->Cell(1.5,0.5,'Nama',0,0,'L');

$pdf->SetFont('Arial','',10);
$pdf->Cell(1.5,0.5,':',0,0,'C');
	
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,$nama,0,'L');

}

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
$pdf->Cell(3,0.8,'SHIFT',1,0,'C');
$pdf->Cell(3,0.8,'TANGGAL',1,0,'C');
$pdf->Cell(3,0.8,'JAM IN',1,0,'C');
$pdf->Cell(3,0.8,'JAM OUT',1,0,'C');
$pdf->Cell(3,0.8,'LEMBUR JAM',1,0,'C');


$pdf->SetFont('Arial','',10);
$pdf->Ln();


$no = 1;
$hasil = mysqli_query($mysqli,"

	SELECT id_absensi,absensi.id_ijin,d.nm_ijin,absensi.nip,b.nama,tanggal_absen,c.shift,jam_in,c.jam_masuk,jam_out,c.jam_pulang, TIMESTAMPDIFF(HOUR,c.jam_pulang,jam_out)as lembur_jam,TIMEDIFF(jam_out,c.jam_pulang)as lembur,status_masuk,status_keluar,terlambat,pulangcepat,ket,TIMEDIFF(jam_in,c.jam_masuk)as jam_telat, TIMEDIFF(c.jam_pulang,jam_out)as jam_p_cepat from absensi 
	LEFT JOIN pegawai b ON absensi.nip = b.nip 
	LEFT JOIN tbl_absen c ON absensi.id_abs = c.id_abs 
	LEFT JOIN tbl_ijin d ON absensi.id_ijin=d.id_ijin 
	where tanggal_absen BETWEEN '$p_awal' AND '$p_akhir'
	AND absensi.nip='$nip' order by absensi.tanggal_absen desc




	");
while ($data = mysqli_fetch_row($hasil)) {
			$nip		= $data[3];
			$shift		= $data[6];	
			$tanggal	= $data[5];	
            $jamin 		= $data[7];
			$jamout 	= $data[9];
			$jamlembur 	= $data[12];
			

$pdf->SetFillColor(255,255,255);
$pdf->Cell(1,0.8,$no++,1,0,'C',true);
$pdf->Cell(3,0.8,$nip,1,0,'C',true);
$pdf->Cell(3,0.8,$shift,1,0,'C',true);
$pdf->Cell(3,0.8,$tanggal,1,0,'C',true);
$pdf->Cell(3,0.8,$jamin,1,0,'C',true);
$pdf->Cell(3,0.8,$jamout,1,0,'C',true);
$pdf->Cell(3,0.8,$jamlembur,1,0,'C',true);
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