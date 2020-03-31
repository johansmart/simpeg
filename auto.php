<?php
include "config/koneksi.php";

$term = $_GET['term'];
 
$query = mysqli_query($mysqli,"select * from pegawai where nip like '%".$term."%'");
$json = array();
while($hasil = mysqli_fetch_array($query)){
	$json[] = array(
		'label' => $hasil['nip'].' - '.$hasil['nama'], 
		'value' => $hasil['nip'],
		'name' => $hasil['nama']
	);
}
header("Content-Type: text/json");
echo json_encode($json);
?>


