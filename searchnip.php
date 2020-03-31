<?php
session_start();

$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level =='1' && $sesi_level=='3'){
    header('location:index.php');

} 
include('config/koneksi.php');
if(isset($_POST['search_keyword']))
{
    $search_keyword = $mysqli->real_escape_string($_POST['search_keyword']);
    $query="SELECT * FROM pegawai WHERE nip LIKE '%$search_keyword%' ";
    $res=$mysqli->query($query);

    if($res === false) {
        trigger_error('Error: ' . $mysqli->error, E_USER_ERROR);
    }else{
        $rows_returned = $res->num_rows;
    }

    $bold_search_keyword = '<strong>'.$search_keyword.'</strong>';
    if($rows_returned > 0){
        while($row = $res->fetch_assoc())
        {
            echo '<div class="show" align="left">
			<span id="nama" class="nip">'.str_ireplace($search_keyword,$bold_search_keyword,$row['nip']).'</span>&nbsp 
			<span id="nama" class="nama">'.str_ireplace($search_keyword,$bold_search_keyword,$row['nama']).'</span></div>';
        }
    }else{
        echo '<div class="show" align="left">No matching records.</div>';
    }
}
?>