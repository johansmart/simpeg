<?php
session_start();

$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
$sesi_id_jab			= isset($_SESSION['id_jab']) ? $_SESSION['id_jab'] : NULL;
if ($sesi_level !='1' && $sesi_level !='3' && $sesi_level !='6' && $sesi_level !='7' ){
    header('location:../index.php');

} 

	mb_internal_encoding('UTF-8');
	
	
	$aColumns = array( 'kdcuti','nama', 'tgl_pengajuan', 'n_cuti', 'tgl_mulai', 'tgl_akhir', 'lama_cuti','approve','alasan' ); 
	
	$sIndexColumn = 'kdcuti';
	
	
	$sTable = 'ajuancuti'; 
	
	$sJoin = 'left join pegawai ON ajuancuti.id=pegawai.id
	left join tbl_cuti ON ajuancuti.id_cuti=tbl_cuti.id_cuti
	left join status_app ON ajuancuti.kd_approve=status_app.kd_approve';
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
		$sOrder = " ORDER BY approve desc,".implode(", ", $aOrderingRules);
		} else {
		$sOrder = " ";
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

	if ($sesi_level==1 || $sesi_level==3){
		if (!empty($aFilteringRules)) {
			$sWhere = " WHERE ".implode(" AND ajuancuti.kd_approve not in (3,4) AND ", $aFilteringRules);
		} else {
			$sWhere = " where ajuancuti.kd_approve not in (3,4) ";
		}
	}

	if ($sesi_level==6){
		if (!empty($aFilteringRules)) {
			$sWhere = " WHERE ".implode(" AND jab_atasan='$sesi_id_jab' AND ", $aFilteringRules);
		} else {
			$sWhere = " where jab_atasan='".$sesi_id_jab."' ";
		}
	}

	if ($sesi_level==7){
		if (!empty($aFilteringRules)) {
			$sWhere = " WHERE ".implode(" AND ", $aFilteringRules);
		} else {
			$sWhere = "";
		}
	}





	
	
	
	

	$aQueryColumns = array();
	foreach ($aColumns as $col) {
		if ($col != ' ') {
			$aQueryColumns[] = $col;
		}
	}
	
	$sQuery = "
    SELECT SQL_CALC_FOUND_ROWS ajuancuti.nip,ajuancuti.id_cuti,`".implode("`, `", $aQueryColumns)."`
    FROM `".$sTable."`".$sJoin.$sWhere.$sOrder.$sLimit;
	
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
		if($aRow['approve']=='Approved'){
			$btn = ''.$aRow['approve'].' 
			| <a class="red" href="?id=datacuti&mod=del&kdcuti='.$aRow['kdcuti'].'" onclick="return confirm(\'Are you sure, you want to delete?\')"> 
				<i class="ace-icon fa fa-trash-o bigger-130"></i>
			</a>
			';
			if($aRow['id_cuti']=='1'){
				$btn .='| <a class="red" href="cetak/cetak_cuti_tahunan.php?kdcuti='.$aRow['kdcuti'].'&nip='.$aRow['nip'].' "> 
				<i class="ace-icon fa fa-print bigger-130"></i>
			</a>';
			}
			if($aRow['id_cuti']=='2'){
				$btn .='| <a class="red" href="cetak/cetak_cuti_alsnpenting.php?kdcuti='.$aRow['kdcuti'].'&nip='.$aRow['nip'].' "> 
				<i class="ace-icon fa fa-print bigger-130"></i>
			</a>';
			}
			if($aRow['id_cuti']=='3'){
				$btn .='| <a class="red" href="cetak/cetak_cuti_sakit.php?kdcuti='.$aRow['kdcuti'].'&nip='.$aRow['nip'].' "> 
				<i class="ace-icon fa fa-print bigger-130"></i>
			</a>';
			}
			if($aRow['id_cuti']=='4'){
				$btn .='| <a class="red" href="cetak/cetak_cuti_melahirkan.php?kdcuti='.$aRow['kdcuti'].'&nip='.$aRow['nip'].' "> 
				<i class="ace-icon fa fa-print bigger-130"></i>
			</a>';
			}
			if($aRow['id_cuti']=='8'){
				$btn .='| <a class="red" href="cetak/cetak_cuti_besar.php?kdcuti='.$aRow['kdcuti'].'&nip='.$aRow['nip'].' "> 
				<i class="ace-icon fa fa-print bigger-130"></i>
			</a>';
			}
		}else if($aRow['approve']=='Bloked'){
			$btn = '<a  href="?id=appcuti&kdcuti='.$aRow['kdcuti'].'" data-rel="tooltip" title="Klik Disini" class="btn btn-danger btn-sm">'.$aRow['approve'].'</a> 
			| <a class="red" href="?id=datacuti&mod=del&id_n='.$aRow['kdcuti'].'" onclick="return confirm(\'Are you sure, you want to delete?\')"> 
				<i class="ace-icon fa fa-trash-o bigger-130"></i>
			</a>
			';
		}else{
			$btn = '<a  href="?id=appcuti&kdcuti='.$aRow['kdcuti'].'" data-rel="tooltip" title="Klik Disini" class="btn btn-primary btn-sm">'.$aRow['approve'].'</a>
			| <a class="red" href="?id=datacuti&mod=del&kdcuti='.$aRow['kdcuti'].'" onclick="return confirm(\'Are you sure, you want to delete?\')"> 
				<i class="ace-icon fa fa-trash-o bigger-130"></i>
			</a>

			';
		}
		
		for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
			$row[] = $aRow[ $aColumns[$i] ];
		}
		$row = array( $aRow['nip'],$aRow['nama'], $aRow['tgl_pengajuan'], $aRow['n_cuti'],$aRow['tgl_mulai'],$aRow['tgl_akhir'],$aRow['lama_cuti'],$aRow['alasan'],$btn );
		
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
	
?>