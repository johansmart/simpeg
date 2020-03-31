<?php

session_start();
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser'] >='1' ) {
//mengambil Get tgl awal dan tgl akhir
    $tgl_awal = $_GET['tgl_awal'];
    $tgl_akhir = $_GET['tgl_akhir'];

//query cek libur
    include "config/koneksi.php";///include koneksi ke mysql
    $cek_libur = mysqli_query($mysqli, "SELECT count(*) from tbl_libur where tgllibur between '$tgl_awal' and '$tgl_akhir'");//query cek libur
    $hasil = mysqli_fetch_array($cek_libur);

    echo "$hasil[0]";//hasil cek

}else {
    echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = 'index.php'</script>";
}

?>