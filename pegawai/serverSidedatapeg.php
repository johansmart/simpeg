<?php
session_start();

$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1' && $sesi_level !='2'){
    header('location:../index.php');

} 

	mb_internal_encoding('UTF-8');
	
	
	$aColumns = array( 'id','nip','n_jab','nama', 'nohp', 'alamat' );
	
	$sIndexColumn = 'id';
	
	
	$sTable = 'pegawai';

	$sJoin = 'left join jabatan b ON a.id_jab=b.kode';
	

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
		$sOrder = " ORDER BY nama ASC";
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
        $sQuery = "
        SELECT SQL_CALC_FOUND_ROWS a.nip," . str_replace(" , ", " ", implode(", ", $aColumns)) . "
        FROM  pegawai a
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
		$btn = '<a class="blue" href="?id=vwprofil&id_n='.$aRow['id'].'">
				<i class="ace-icon fa fa-search-plus bigger-130"></i>
			</a>

			<a class="green" href="?id=tambahpeg&mod=edit&id_n='.$aRow['id'].'">
				<i class="ace-icon fa fa-pencil bigger-130"></i>
			</a>
			<a class="red" href="?id=data_pegawai&mod=del&id_n='.$aRow['id'].'" onclick="return confirm(\'Are you sure, you want to delete?\')"> 
				<i class="ace-icon fa fa-trash-o bigger-130"></i>
			</a>';
		for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
			$row[] = $aRow[ $aColumns[$i] ];
		}
		$row = array( $aRow['nip'], $aRow['nama'],$aRow['n_jab'], $aRow['nohp'], $aRow['alamat'],$btn );
		
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
	
?>