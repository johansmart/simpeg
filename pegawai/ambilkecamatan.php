<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1' && $sesi_level !='2' && $sesi_level !='3' && $sesi_level !='4' && $sesi_level !='5' ){
    header('location:../index.php');

} 
include "../config/koneksi.php";
$kota = $_GET['kota'];
$kec = mysqli_query($mysqli,"SELECT id_kec,nama_kec FROM kec WHERE id_kabkot='$kota' order by nama_kec");
echo "<option>-- Pilih Kecamatan --</option>";
while($k = mysqli_fetch_array($kec)){
    echo "<option value=\"".$k['id_kec']."\">".$k['nama_kec']."</option>\n";
}
?>