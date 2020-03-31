<?php
session_start();

$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1' && $sesi_level !='2' && $sesi_level !='3' && $sesi_level !='4' && $sesi_level !='5' ){
    header('location:../index.php');

} 
include "../config/koneksi.php";
$propinsi = $_GET['propinsi'];
$kota = mysqli_query($mysqli,"SELECT id_kabkot,nama_kabkot FROM kabkot WHERE id_prov='$propinsi' order by nama_kabkot");
echo "<option>-- Pilih Kabupaten/Kota --</option>";
while($k = mysqli_fetch_array($kota)){
    echo "<option value=\"".$k['id_kabkot']."\">".$k['nama_kabkot']."</option>\n";
}
?>
