<?php
session_start();

$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
$sesi_id_jab			= isset($_SESSION['id_jab']) ? $_SESSION['id_jab'] : NULL;
if ($sesi_level !='1' && $sesi_level !='3' && $sesi_level !='6' && $sesi_level !='7' ){
    header('location:../index.php');

} 

	mb_internal_encoding('UTF-8');
	
	
	$aColumns = array( 'nama','tanggal_absen' ); 
	
	
	$sIndexColumn = 'id_absensi';
	
	$sTable = 'absensi'; 
	
	$sJoin = 'LEFT JOIN pegawai b ON absensi.nip = b.nip LEFT JOIN tbl_absen c ON absensi.id_abs = c.id_abs LEFT JOIN tbl_ijin d ON absensi.id_ijin=d.id_ijin ';
	
	
	$input =& $_POST;

	$gaSql['charset']  = 'utf8';
	
	
	include "../config/koneksi.php";
	
	
$sLimit = "";
	if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
		$sLimit = " LIMIT ".intval( $input['iDisplayStart'] ).", ".intval( $input['iDisplayLength'] );
	}
	
	
	$aOrderingRules = array();
	if ( isset( $input['iSortCol_0'] ) ) {
		$iSortingCols = intval( $input['iSortingCols'] );
		for ( $i=0 ; $i<$iSortingCols ; $i++ ) {
			if ( $input[ 'bSortable_'.intval($input['iSortCol_'.$i]) ] == 'true' ) {
				$aOrderingRules[] =
                "`".$aColumns[ intval( $input['iSortCol_'.$i] ) ]."` "
                .($input['sSortDir_'.$i]==='asc' ? 'asc' : 'desc');
			}
		}
	}
	
	if (!empty($aOrderingRules)) {
		$sOrder = " ORDER BY ".implode(", ", $aOrderingRules);
		} else {
		$sOrder = "";
	}
	

	$iColumnCount = count($aColumns);
	
	
	
	if ( isset($input['sSearch']) && $input['sSearch'] != "" ) {
		$aFilteringRules = array();
		for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
			if ( isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' ) {
				
				$aFilteringRules[] = "`".$aColumns[$i]."` LIKE '%".$mysqli->real_escape_string( $input['sSearch'] )."%'";
			}
		}
		if (!empty($aFilteringRules)) {
			$aFilteringRules = array('('.implode(" OR ", $aFilteringRules).')');
		}
	}
	
	// Individual column filtering
	for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
		if ( isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' && $input['sSearch_'.$i] != '' ) {
			$aFilteringRules[] = "`".$aColumns[$i]."` LIKE '%".$mysqli->real_escape_string($input['sSearch_'.$i])."%'";
		}
	}
	
	if (!empty($aFilteringRules)) {
		$sWhere = " WHERE ".implode(" AND ", $aFilteringRules);
		} else {
		$sWhere = "";
	}
	

	$aQueryColumns = array();
	foreach ($aColumns as $col) {
		if ($col != ' ') {
			$aQueryColumns[] = $col;
		}
	}
	
    /*
     * SQL queries
     * Get data to display
     */
    $sQuery = "
        SELECT SQL_CALC_FOUND_ROWS absensi.id_absensi,absensi.nip,absensi.id_ijin,d.nm_ijin,c.shift,jam_in,c.jam_masuk,jam_out,c.jam_pulang, TIMESTAMPDIFF(HOUR,c.jam_pulang,jam_out)as lembur_jam,TIMEDIFF(jam_out,c.jam_pulang)as lembur,status_masuk,status_keluar,terlambat,pulangcepat,ket,TIMEDIFF(jam_in,c.jam_masuk)as jam_telat, TIMEDIFF(c.jam_pulang,jam_out)as jam_p_cepat," . str_replace(" , ", " ", implode(", ", $aColumns)) . "
        FROM   $sTable
        $sJoin
        $sWhere
        $sOrder
        $sLimit
    ";
	
$rResult = $mysqli->query( $sQuery ) or die($mysqli->error);
	
	
	$sQuery = "SELECT FOUND_ROWS()";
	$rResultFilterTotal = $mysqli->query( $sQuery ) or die($mysqli->error);
	list($iFilteredTotal) = $rResultFilterTotal->fetch_row();
	
	
	$sQuery = "SELECT COUNT(`".$sIndexColumn."`) FROM `".$sTable."`";
	$rResultTotal = $mysqli->query( $sQuery ) or die($mysqli->error);
	list($iTotal) = $rResultTotal->fetch_row();
	
	
	
	$output = array(
    "sEcho"                => intval($input['sEcho']),
    "iTotalRecords"        => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData"               => array(),
	);
	
   	while ( $aRow = $rResult->fetch_assoc() ) {
		$row = array();
		$btn = '
			<a class="green" href="?id=inputabsen&id_absensi='.$aRow['id_absensi'].'">
				<i class="ace-icon fa fa-pencil bigger-130"></i>
			</a>
			<a class="red" href="?id=data_absen&mod=del&id_absensi='.$aRow['id_absensi'].'" onclick="return confirm(\'Are you sure, you want to delete?\')"> 
				<i class="ace-icon fa fa-trash-o bigger-130"></i>
			</a>';
			
		if ($aRow['terlambat']=="Y")	 {
			$lmbt=''.$aRow['terlambat'].'   <span class="badge badge-danger">'.$aRow['jam_telat'].'</span>';	
		} else {
			$lmbt=''.$aRow['terlambat'].'';	
		}
		
		if ($aRow['pulangcepat']=="Y")	 {
			$p_cepat=''.$aRow['pulangcepat'].'   <span class="badge badge-danger">'.$aRow['jam_p_cepat'].'</span>';	
		} else {
			$p_cepat=''.$aRow['pulangcepat'].'';	
		}
		
		
		for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
			$row[] = $aRow[ $aColumns[$i] ];
		}
		
		$row = array( $aRow['nip'], 
		$aRow['nama'], 
		$aRow['tanggal_absen'],
		$aRow['shift'],
		$aRow['jam_in'],
		$aRow['jam_out'],
		$lmbt,
		$p_cepat,
		$aRow['nm_ijin'],
		$btn
		
		);
		
		$output['aaData'][] = $row;
	}
    echo json_encode($output);
	
?>