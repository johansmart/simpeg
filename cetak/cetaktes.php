<?php
ob_start();
require('../config/html_table.php');
require('../config/koneksi.php');

$hasi=mysqli_query($mysqli,"select t_pdk,d_pdk,asl_sekolah,jurusan,noijazah from pendidikan");
$no = 1;

$header='<TABLE>
<TR>
<TD>TAHUN</TD>
<TD>PDK</TD>
<TD>Age</TD>
<TD>ASAL</TD>
<TD>JURUSAN</TD>
</TR>
';

while($hasil=mysqli_fetch_array($hasi)){
$isitable='<TR>
<TD>'.$hasil['t_pdk'].'</TD>
<TD>'.$hasil['d_pdk'].'</TD>
<TD>'.$hasil['asl_sekolah'].'</TD>
<TD>'.$hasil['jurusan'].'</TD>
<TD>'.$hasil['jurusan'].'</TD>
</TR>
</TABLE>';	
}



$hasi2=mysqli_query($mysqli,"select t_pdk,d_pdk,asl_sekolah,jurusan,noijazah from pendidikan");
$no = 1;

$header2='<TABLE>
<TR>
<TD>TAHUN</TD>
<TD>PDK</TD>
<TD>Age</TD>
<TD>ASAL</TD>
<TD>JURUSAN</TD>
</TR>
';

while($hasil2=mysqli_fetch_array($hasi2)){
$isitable2='<TR>
<TD>'.$hasil2['t_pdk'].'</TD>
<TD>'.$hasil2['d_pdk'].'</TD>
<TD>'.$hasil2['asl_sekolah'].'</TD>
<TD>'.$hasil2['jurusan'].'</TD>
<TD>'.$hasil2['jurusan'].'</TD>
</TR>
</TABLE>';	
}
	


$pdf=new PDF_HTML_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->WriteHTML("Start of the HTML table.<br>".$header." ".$isitable."<br> End of the table.");
$pdf->WriteHTML("Start of the HTML table.<br>".$header2." ".$isitable2."<br> End of the table.");
$pdf->Output();
?>