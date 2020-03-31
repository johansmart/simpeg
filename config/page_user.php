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
    $ambiljs1			="assets/js/hm.js";
    $ambiljs2			="assets/js/highcharts.js";
    $ambiljs3           ="exporting.js";
    $ambilfungsi		="config/fungsihome.php";
	$classmenu1			="";
	$classmenu2			="";
	$classmenu3			="";
	$classmenu4			="";
	$classmenu5			="";
	$classmenu6			="";
	$classmenu7			="";
	
} elseif ($id == "berkas") {
    $nav                = "Data Berkas";
    $ambil              = "absen/data_berkas.php";
    $ambilcss1          ="";
    $ambiljs0           ="assets/js/jquery-1.8.3.min.js";
    $ambiljs1           ="";
 
} elseif ($id == "msg") {
    $nav 				= "Inbox";
    $ambil 				= "inbox/inbox.php";
    $ambiljs0			="assets/js/jquery-1.8.3.min.js";
    $ambiljs1			="assets/js/inbox.js";
	
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
		$classmenu1			="";
	$classmenu2			="active open";
	$classmenu3			="active";
	$classmenu4			="";
	$classmenu5			="";
	$classmenu6			="";
	$classmenu7			="";

    } elseif ($id == "ajuan_cuti") {
    $nav 				= "Pengajuan Cuti";
    $ambil 				= "user/ajuancuti.php";
    $ambilcss1			="assets/css/jquery-ui.custom.min.css";
    $ambilcss2			="assets/css/jquery.gritter.css";
    $ambilcss3			="assets/css/select2.css";
    $ambilcss4			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="";
    $ambiljs2			="";
    $ambiljs3			="";
    $ambiljs4			="";
    $ambiljs5			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambiljs6			="";
    $ambiljs7			="";
    $ambiljs8			="";
    $ambiljs9			="";
    $ambiljs10			="";
    $ambiljs11			="";
    $ambiljs12			="";
    $ambilfungsi		="config/fungsi_ajuancuti.php";
	$classmenu1			="";
	$classmenu2			="";
	$classmenu3			="";
	$classmenu4			="active open";
	$classmenu5			="active";
	$classmenu6			="";
	$classmenu7			="";

} elseif ($id == "pendidikan") {
    $nav 				= "Data Pendidikan";
    $ambil 				= "pegawai/pendidikan.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";

} elseif ($id == "pelatihan") {
    $nav 				= "Pelatihan";
    $ambil 				= "pegawai/pelatihan.php";
    $ambilcss1			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

} elseif ($id == "pengalaman") {
    $nav 				= "Data Pengalaman Kerja";
    $ambil 				= "pegawai/pengalaman.php";
    $ambilcss1			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
} elseif ($id == "keluarga") {
    $nav 				= "Data Keluarga";
    $ambil 				= "pegawai/keluarga.php";
    $ambilcss1			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

} elseif ($id == "keahlian") {
    $nav 				= "Data Sertifikat (Keahlian/Keterampilan)";
    $ambil 				= "pegawai/keahlian.php";
    $ambilcss1			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

} elseif ($id == "karyailmiah") {
    $nav 				= "Karya Ilmiah";
    $ambil 				= "pegawai/karyailmiah.php";
    $ambilcss1			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

} elseif ($id == "vwprofil") {
    $nav 				= "Profile Pegawai";
    $ambil 				= "pegawai/view_profile.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs4			="assets/js/jquery.easypiechart.min.js";
    $ambiljs10			="assets/js/x-editable/bootstrap-editable.min.js";
    $ambiljs11			="assets/js/x-editable/ace-editable.min.js";
    $ambilfungsi		="config/fungsi_profil.php";

		
} elseif ($id == "absensi") {
		$nav 				= "Absensi";
		$ambil 				= "user/absensi.php";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";	
		$ambiljs1			="assets/js/time2.js";
		$classmenu1			="";
	$classmenu2			="";
	$classmenu3			="";
	$classmenu4			="active open";
	$classmenu5			="";
	$classmenu6			="active";
	$classmenu7			="";

}elseif($id=="datacuti"){
	$nav                = "Data Cuti";
    $ambil              = "absen/data_cuti.php";
    $ambiljs0           ="assets/js/jquery.2.1.1.min.js";
    $ambilfungsi        ="config/fungsi_dafcuti.php";
    $ambiljs3           ="assets/js/jquery.dataTables.min.js";
    $ambiljs4           ="assets/js/jquery.dataTables.bootstrap.js";
    $ambiljs5           ="assets/js/dataTables.tableTools.min.js";
    $ambiljs6           ="assets/js/dataTables.colVis.min.js";
    $classmenu1         ="";
    $classmenu4         ="active open";
    $classmenu8         ="active";

}elseif($id=="databerkas"){
    $nav                = "Data berkas";
    $ambil              = "absen/data_berkas.php";
    $ambiljs0           ="assets/js/jquery.2.1.1.min.js";


}elseif($id=="appcuti"){


    $ambil                = "absen/app_cuti.php";
    $ambiljs0           ="assets/js/jquery.2.1.1.min.js";
    $ambilfungsi        ="";
    $classmenu1         ="";
    $classmenu4         ="active open";
    $classmenu8         ="active";


		
} elseif ($id == "lapabsensi") {
		$nav 				= "Laporan Absensi";
		$ambil 				= "user/lapabsensi.php";
		$ambilcss1			="assets/css/datepicker.css";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";	
		$ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
		$ambilfungsi		="config/fungsi_tmbhpeg.php";
		$classmenu1			="";
	$classmenu2			="";
	$classmenu3			="";
	$classmenu4			="active absen";
	$classmenu5			="";
	$classmenu6			="";
	$classmenu7			="active";

} elseif ($id == "cari") {
    $nav 				= "Cari Pegawai";
    $ambil 				= "pegawai/caripegawai.php";
    $ambiljs0			= "assets/js/jquery.2.1.1.min.js";
	} 
else {
    $nav 				= "Dashboard";
    $ambil 				= "home.php";
    $ambilcss2			="";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/hm.js";
    $ambiljs2			="assets/js/highcharts.js";
    $ambiljs3           ="assets/js/exporting.js";
    $ambilfungsi		="config/fungsihome.php";
	$classmenu1			="active";
	$classmenu2			="";
	$classmenu3			="";
	$classmenu4			="";
	$classmenu5			="";
	$classmenu6			="";
	$classmenu7			="";

	}
	?>