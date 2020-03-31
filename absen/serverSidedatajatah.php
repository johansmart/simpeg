<?php
session_start();

$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1' && $sesi_level !='3'){
    header('location:../index.php');

} 

	mb_internal_encoding('UTF-8');
	
	
	$aColumns = array('idjc','nama','jatahcuti','cutiambil','sisacuti','tahun' );
	
	
	$sIndexColumn = 'idjc';
	
	$sTable = 'tbl_jatahcuti';
	
	$sJoin = 'left join pegawai b ON a.nip=b.nip';
	
	
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
        SELECT SQL_CALC_FOUND_ROWS a.nip," . str_replace(" , ", " ", implode(", ", $aColumns)) . "
        FROM  tbl_jatahcuti a
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

		
		for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
			$row[] = $aRow[ $aColumns[$i] ];
		}
		
		$row = array( $aRow['nip'],
		$aRow['nama'], 
		$aRow['jatahcuti'],
		$aRow['cutiambil'],
		$aRow['sisacuti'],
		$aRow['tahun']
		);
		
		$output['aaData'][] = $row;
	}
    echo json_encode($output);
	
?>