<?php
// panggil fungsi validasi xss dan injection
require_once('fungsi_validasi.php');
// definisikan koneksi ke database
$server = "localhost";
$usermysql = "root";
$password = "";
$database = "db_pegawai";

// Koneksi dan memilih database di server
$mysqli= new mysqli ($server,$usermysql,$password,$database);
if ($mysqli->connect_error){
	echo "Gagal terkoneksi ke database : (".$mysqli->connect_eror.")";
}
	$val = new Lokovalidasi;

?>

