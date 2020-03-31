<?php
$nav				= "";
$ambil				= "home.php";
$ambilcss1			="";
$ambilcss2			="";
$ambilcss3			="";
$ambilcss4			="";
$ambilcss5			="";
$ambilcss6			="";
$ambilcss7			="";
$ambilcss8			="";
$ambilcss9			="";
$ambilcss10			="";

$ambiljs0			="";
$ambiljs1			="";
$ambiljs2			="";
$ambiljs3			="";
$ambiljs4			="";
$ambiljs5			="";
$ambiljs6			="";
$ambiljs7			="";
$ambiljs8			="";
$ambiljs9			="";
$ambiljs10			="";
$ambiljs11			="";
$ambiljs12			="";
$ambilfungsi		="";
$ambilfungsi2		="";



$id 				= isset($_GET['id']) ? $_GET['id'] : "";
if ($id == "") {
    $nav 				= "Dashboard";
    $ambil 				= "home.php";
    $ambilcss2			="";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="";
    $ambiljs2			="";
    $ambiljs3           ="";
    $ambilfungsi		="";
	$classmenu1		="active";
	$classmenu2		="";
	$classmenu3		="";
	$classmenu4		="";
	$classmenu5		="";
	$classmenu6		="";
	$classmenu7		="";
	$classmenu8		="";

} elseif ($id == "statistik") {
    $nav 				=  "Statistik";
    $ambil 				=  "statistik.php";
    $ambiljs0			=  "assets/js/jquery.2.1.1.min.js";
    $ambiljs1			=  "assets/js/hm.js";
    $ambiljs2			=  "assets/js/highcharts.js";
    $ambiljs3           =   "exporting.js";
    $ambilfungsi		=   "config/fungsihome.php";
	$classmenu1		="";
	$classmenu2		="active open";
	$classmenu3		="";
	$classmenu4		="";
	$classmenu5		="";
	$classmenu6		="active";
	$classmenu7		="";
	$classmenu8		="";

} elseif ($id == "msg") {
    $nav 				= "Inbox";
    $ambil 				= "inbox/inbox.php";
    $ambiljs0			="assets/js/jquery-1.8.3.min.js";
    $ambiljs1			="assets/js/inbox.js";

} elseif ($id == "keluarga") {
    $nav 				= "Data Keluarga";
    $ambil 				= "pegawai/keluarga.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

} elseif ($id == "gol") {
    $nav 				= "Refernsi golongan";
    $ambil 				= "ref/t_gol.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";

} elseif ($id == "hjabatan") {
    $nav 				= "History Jabatan";
    $ambil 				= "pegawai/hjabatan.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

} elseif ($id == "hjabfungsi") {
    $nav 				= "History Jabatan Fungsional";
    $ambil 				= "pegawai/hjabfungsi.php";
    $ambilcss1			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

} elseif ($id == "hjabstruk") {
    $nav 				= "History Jabatan Struktural";
    $ambil 				= "pegawai/hjabstruk.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

} elseif ($id == "pelatihan") {
    $nav 				= "Pelatihan";
    $ambil 				= "pegawai/pelatihan.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

} elseif ($id == "keahlian") {
    $nav 				= "Data Sertifikat (Keahlian/Keterampilan)";
    $ambil 				= "pegawai/keahlian.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
} elseif ($id == "penugasan") {
    $nav 				= "Data Sertifikat (Keahlian/Keterampilan)";
    $ambil 				= "pegawai/penugasan.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
} elseif ($id == "karyailmiah") {
    $nav 				= "Karya Ilmiah";
    $ambil 				= "pegawai/karyailmiah.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

} elseif ($id == "pendidikan") {
    $nav 				= "Data Pendidikan";
    $ambil 				= "pegawai/pendidikan.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";


} elseif ($id == "pengalaman") {
    $nav 				= "Data Pengalaman Kerja";
    $ambil 				= "pegawai/pengalaman.php";
    $ambilcss1			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

} elseif ($id == "penghargaan") {
    $nav 				= "Penghargaan";
    $ambil 				= "pegawai/penghargaan.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
} elseif ($id == "golongan") {
    $nav 				= "Golongan";
    $ambil 				= "pegawai/hgolongan.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

	} elseif ($id == "profil") {
		$nav 				= "Profile Pegawai";
		$ambil 				= "pegawai/profile.php";
		$ambilcss1			="assets/css/jquery-ui.custom.min.css";
		$ambilcss2			="assets/css/jquery.gritter.css";
		$ambilcss3			="assets/css/select2.css";
		$ambilcss4			="assets/css/datepicker.css";
		$ambilcss5			="assets/css/bootstrap-editable.css";
		$ambilcss6			="";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$ambiljs1			="";
		$ambiljs2			="assets/js/jquery.gritter.min.js";
		$ambiljs3			="assets/js/bootbox.min.js";
		$ambiljs4			="assets/js/jquery.easypiechart.min.js";
		$ambiljs5			="assets/js/date-time/bootstrap-datepicker.min.js";
		$ambiljs6			="assets/js/jquery.hotkeys.min.js";
		$ambiljs7			="assets/js/bootstrap-wysiwyg.min.js";
		$ambiljs8			="assets/js/select2.min.js";
		$ambiljs9			="assets/js/fuelux/fuelux.spinner.min.js";
		$ambiljs10			="assets/js/x-editable/bootstrap-editable.min.js";
		$ambiljs11			="assets/js/x-editable/ace-editable.min.js";
		$ambiljs12			="assets/js/jquery.maskedinput.min.js";
		$ambilfungsi		="config/fungsi_profil.php";
		

	} elseif ($id == "data_pegawai") {
		$nav 				= "Data Pegawai";
		$ambil 				= "pegawai/data_peg.php";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$ambilfungsi		="config/fungsi_dafpeg.php";
		$ambiljs2			="assets/js/jquery.dataTables.min.js";
		$ambiljs3			="assets/js/jquery.dataTables.bootstrap.js";
		$ambiljs4			="assets/js/dataTables.tableTools.min.js";
		$ambiljs5			="assets/js/dataTables.colVis.min.js";
		$classmenu1		="";
	$classmenu2		="active open";
	$classmenu3		="";
	$classmenu4		="active";
	$classmenu5		="";
	$classmenu6		="";
	$classmenu7		="";
	$classmenu8		="";
		
		} elseif ($id == "vwprofil") {
    $nav 				= "Profile Pegawai";
    $ambil 				= "pegawai/view_profile.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs4			="assets/js/jquery.easypiechart.min.js";
    $ambiljs10			="assets/js/x-editable/bootstrap-editable.min.js";
    $ambiljs11			="assets/js/x-editable/ace-editable.min.js";
    $ambilfungsi		="config/fungsi_profil.php";


} elseif ($id == "tambahpeg") {
    $nav 				= "Tambah Pegawai";
    $ambil 				= "pegawai/tmbh_peg.php";
    $ambilcss3			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs3			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
	$classmenu1		="";
	$classmenu2		="active open";
	$classmenu3		="active";
	$classmenu4		="";
	$classmenu5		="";
	$classmenu6		="";
	$classmenu7		="";
	$classmenu8		="";

	
    } elseif ($id == "rekapitulasi") {
    $nav 				= "Rekapitulasi";
    $ambil 				= "pegawai/rekap.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
	$classmenu1		="";
	$classmenu2		="active open";
	$classmenu3		="";
	$classmenu4		="";
	$classmenu5		="active";
	$classmenu6		="";
	$classmenu7		="";
	$classmenu8		="";

} elseif ($id == "cari") {
    $nav 				= "Cari Pegawai";
    $ambil 				= "pegawai/caripegawai.php";
    $ambiljs0			= "assets/js/jquery.2.1.1.min.js";
		
	} else {
    $nav 				= "Dashboard";
    $ambil 				= "home.php";
    $ambilcss2			="";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/hm.js";
    $ambiljs2			="assets/js/highcharts.js";
    $ambiljs3           ="exporting.js";
    $ambilfungsi		="config/fungsihome.php";
	$classmenu1		="active";
	$classmenu2		="";
	$classmenu3		="";
	$classmenu4		="";
	$classmenu5		="";
	$classmenu6		="";
	$classmenu7		="";
	$classmenu8		="";

	}
	
?>	