<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$nip			= isset($_SESSION['nip']) ? $_SESSION['nip'] : NULL;


if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5'  ) {





    $q = $_POST['q'];

// ================ TAMPILKAN DATANYA =====================//
    echo "<div class='body' >";
    echo "<table  id='sample-table-2' class='table table-striped table-bordered table-hover'>
		<tr>
		<th>No</th>
		<th>Nip</th>
		<th>Nama</th>
		<th>Foto</th>
		<th>View Profile</th></tr>";

    $q_cari = mysqli_query($mysqli, "select * from pegawai where nip like '%$q%' or nama like '%$q%' ") or die (mysql_error());
    $j_data = mysqli_num_rows($q_cari);

    if ($j_data == 0) {
        echo "<tr><td colspan='5'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($a_cari = mysqli_fetch_array($q_cari)) {
            echo "<tr>
				<td>$no</td>
				<td>$a_cari[nip]</td>
				<td >$a_cari[nama]</td>
				<td><img src='$a_cari[foto]' width='100px' height='100px'></td>
				<td><a class='blue' href='?id=vwprofil&id_n=$a_cari[id]'><i class='ace-icon fa fa-search-plus bigger-130'></i></a></td>
				</tr>";
            $no++;
        }
    }
    echo "</table></div>";


}else{
    echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>
	
