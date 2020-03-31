<?php
session_start();

$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1' && $sesi_level !='2'){
    header('location:../index.php');

} 
include "../config/koneksi.php";

$result = mysqli_query($mysqli,"SELECT * FROM jabatan");

$rows = array();
while($r = mysqli_fetch_array($result)) {


    $kode= $r[1];
    $row[0] = $r[2];

    $hasil2 = mysqli_query($mysqli,"SELECT count(*) as jum FROM pegawai WHERE id_jab = '$kode'");
    $data2 = mysqli_fetch_row($hasil2);
    $row[1] = $data2[0];


    array_push($rows,$row);
}

print json_encode($rows, JSON_NUMERIC_CHECK);
?> 
