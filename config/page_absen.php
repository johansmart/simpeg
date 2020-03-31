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
$ambilfungsi2		="";



$id 				= isset($_GET['id']) ? $_GET['id'] : "";
if ($id == "") {
		$nav 				= "Dashboard";
		$ambil 				= "home.php";
		$ambilcss2			="";
        $ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$ambiljs1			="active";
		$ambiljs2			="";
        $ambiljs3           ="";
		$ambilfungsi		="";
		$classmenu1			="";
		$classmenu2			="";
		$classmenu3			="";
		$classmenu4			="";
		$classmenu5			="";
		$classmenu6			="";

    } elseif ($id == "statistik") {
    $nav 				=  "Statistik";
    $ambil 				=  "statistik.php";
    $ambiljs0			=  "assets/js/jquery.2.1.1.min.js";
    $ambiljs1			=  "assets/js/hm.js";
    $ambiljs2			=  "assets/js/highcharts.js";
    $ambiljs3           =   "exporting.js";
    $ambilfungsi		=   "config/fungsihome.php";
	$classmenu1			="";
		$classmenu2			="";
		$classmenu3			="";
		$classmenu4			="";
		$classmenu5			="";
		$classmenu6			="";

	} elseif ($id == "list_user") {
		$nav 				= "List User";
		$ambil 				= "lu.php";
		$ambilcss1			="";
		$ambiljs0			="assets/js/jquery-1.8.3.min.js";
		$ambiljs1			="assets/js/lu.js";

    }elseif ($id == "berkas") {
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

} elseif ($id == "datajatah") {
    $nav 				= "Data Jatah Cuti";
    $ambil 				= "absen/data_jatah.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambilfungsi		="config/fungsi_datajatah.php";
    $ambiljs2			="assets/js/jquery.dataTables.min.js";
    $ambiljs3			="assets/js/jquery.dataTables.bootstrap.js";
    $ambiljs4			="assets/js/dataTables.tableTools.min.js";
    $ambiljs5			="assets/js/dataTables.colVis.min.js";
    $classmenu1			="";
    $classmenu2			="";
    $classmenu3			="";
    $classmenu4			="";
    $classmenu5			="";
    $classmenu6			="";
    $classmenu7			="";
    $classmenu8			="";
    $classmenu9			="";
    $classmenu10		="";
    $classmenu11		="";
    $classmenu12		="";
    $classmenu13		="";
    $classmenu14		="";
    $classmenu15		="";
    $classmenu16		="";
    $classmenu17		="";
    $classmenu18		="";
    $classmenu19		="";
    $classmenu20		="";
    $classmenu21		="";
    $classmenu22		="";
    $classmenu23		="";
    $classmenu24		="";
    $classmenu25		="";
    $classmenu26		="";
    $classmenu27		="";
    $classmenu28		="";
    $classmenu29		="";
    $classmenu30		="";
    $classmenu31		="";

    

} elseif ($id == "keluarga") {
    $nav 				= "Data Keluarga";
    $ambil 				= "pegawai/keluarga.php";
    $ambilcss1			="assets/css/datepicker.css";
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
    $ambilcss1			="assets/css/datepicker.css";
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
    $ambilcss1			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";

} elseif ($id == "pelatihan") {
    $nav 				= "Pelatihan";
    $ambil 				= "pegawai/pelatihan.php";
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
} elseif ($id == "penugasan") {
    $nav 				= "Data Sertifikat (Keahlian/Keterampilan)";
    $ambil 				= "pegawai/penugasan.php";
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
    $ambilcss1			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
} elseif ($id == "golongan") {
    $nav 				= "Golongan";
    $ambil 				= "pegawai/hgolongan.php";
    $ambilcss1			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";


} elseif ($id == "hasil") {
    $nav 				= "hasilcari";
    $ambil 				= "hasil.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
	
} elseif ($id == "profil") {
		$nav 				= "Profile Pegawai";
		$ambil 				= "pegawai/profile.php";
		$ambilcss2			="assets/css/jquery.gritter.css";
		$ambilcss3			="assets/css/select2.css";
		$ambilcss4			="assets/css/datepicker.css";
		$ambilcss5			="assets/css/bootstrap-editable.css";
		$ambilcss6			="";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$ambiljs1			="";
		$ambiljs2			="assets/js/jquery.maskedinput.min.js";
		$ambiljs3			="";
		$ambiljs4			="assets/js/jquery.easypiechart.min.js";
		$ambiljs5			="assets/js/date-time/bootstrap-datepicker.min.js";
		$ambiljs6			="assets/js/jquery.hotkeys.min.js";
		$ambiljs7			="assets/js/bootstrap-wysiwyg.min.js";
		$ambiljs8			="assets/js/select2.min.js";
		$ambiljs9			="assets/js/fuelux/fuelux.spinner.min.js";
		$ambiljs10			="assets/js/x-editable/bootstrap-editable.min.js";
		$ambiljs11			="assets/js/x-editable/ace-editable.min.js";
		$ambiljs12			="assets/js/jquery.gritter.min.js";
		$ambilfungsi		="config/fungsi_profil.php";

} elseif ($id == "vwprofil") {
    $nav 				= "Profile Pegawai";
    $ambil 				= "pegawai/view_profile.php";
    $ambilcss3			="assets/css/select2.css";
		$ambilcss4			="assets/css/datepicker.css";
		$ambilcss5			="assets/css/bootstrap-editable.css";
		$ambilcss6			="";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$ambiljs1			="";
		$ambiljs2			="assets/js/jquery.maskedinput.min.js";
		$ambiljs3			="";
		$ambiljs4			="assets/js/jquery.easypiechart.min.js";
		$ambiljs5			="assets/js/date-time/bootstrap-datepicker.min.js";
		$ambiljs6			="assets/js/jquery.hotkeys.min.js";
		$ambiljs7			="assets/js/bootstrap-wysiwyg.min.js";
		$ambiljs8			="assets/js/select2.min.js";
		$ambiljs9			="assets/js/fuelux/fuelux.spinner.min.js";
		$ambiljs10			="assets/js/x-editable/bootstrap-editable.min.js";
		$ambiljs11			="assets/js/x-editable/ace-editable.min.js";
		$ambiljs12			="assets/js/jquery.gritter.min.js";
		$ambilfungsi		="config/fungsi_profil.php";


} elseif ($id == "data_absen") {
    $nav 				= "Data Absen";
    $ambil 				= "absen/data_absen.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambilfungsi		="config/fungsi_dataabsen.php";
    $ambiljs2			="assets/js/jquery.dataTables.min.js";
    $ambiljs3			="assets/js/jquery.dataTables.bootstrap.js";
    $ambiljs4			="assets/js/dataTables.tableTools.min.js";
    $ambiljs5			="assets/js/dataTables.colVis.min.js";
	$classmenu1			="";
		$classmenu2			="active open";
		$classmenu3			="";
		$classmenu4			="active";
		$classmenu5			="";
		$classmenu6			="";

    } elseif ($id == "datacuti") {
    $nav 				= "Data Cuti";
    $ambil 				= "absen/data_cuti.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambilfungsi		="config/fungsi_dafcuti.php";
    $ambiljs2			="assets/js/jquery.dataTables.min.js";
    $ambiljs3			="assets/js/jquery.dataTables.bootstrap.js";
	$ambiljs4			="assets/js/dataTables.tableTools.min.js";
	$ambiljs5			="assets/js/dataTables.colVis.min.js";
	$classmenu1			="";
		$classmenu2			="active open";
		$classmenu3			="active";
		$classmenu4			="";
		$classmenu5			="";
		$classmenu6			="";
		
		
		
		
		
		} elseif ($id == "inputcuti") {
    $nav 				= "Form Input Cuti";
    $ambil 				= "absen/inputcuti.php";
    $ambilcss1			="assets/css/datepicker.css";
	$ambilcss2			="assets/css/autocomplete.css";
    $ambiljs0			="assets/js/jquery-1.8.3.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_inpucuti.php";	
	$classmenu1			="";
		$classmenu2			="active open";
		$classmenu3			="active";
		$classmenu4			="";
		$classmenu5			="";
		$classmenu6			="";	
	
			
		
	 } elseif ($id == "appcuti") {
    $nav 				= "Approve Cuti";
    $ambil 				= "absen/app_cuti.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambilfungsi		="";
	$classmenu1			="";
		$classmenu2			="active open";
		$classmenu3			="active";
		$classmenu4			="";
		$classmenu5			="";
		$classmenu6			="";	
	
} elseif ($id == "lembur") {
    $nav 				= "Data Lembur";
    $ambil 				= "absen/data_lembur.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambilfungsi		="config/fungsi_datalembur.php";
    $ambiljs2			="assets/js/jquery.dataTables.min.js";
    $ambiljs3			="assets/js/jquery.dataTables.bootstrap.js";
    $ambiljs4			="assets/js/dataTables.tableTools.min.js";
    $ambiljs5			="assets/js/dataTables.colVis.min.js";	
	$classmenu1			="";
		$classmenu2			="active open";
		$classmenu3			="";
		$classmenu4			="";
		$classmenu5			="active";
		$classmenu6			="";
		
	} elseif ($id == "rekapcuti") {
		$nav 				= "Rekap Cuti";
		$ambil 				= "absen/rekapcuti.php";
		$ambilcss3			="assets/css/datepicker.css";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$ambiljs3			="assets/js/date-time/bootstrap-datepicker.min.js";
		$ambilfungsi		="config/fungsi_tmbhpeg.php";	
		$classmenu1			="";
		$classmenu2			="active open";
		$classmenu3			="";
		$classmenu4			="";
		$classmenu5			="";
		$classmenu6			="active";


    } elseif ($id == "cari") {
    $nav 				= "Cari Pegawai";
    $ambil 				= "pegawai/caripegawai.php";
    $ambiljs0			= "assets/js/jquery.2.1.1.min.js";
	


    } elseif ($id == "search") {
    $nav 				= "Advanced Search";
    $ambil 				= "search.php";
    $ambiljs0			= "assets/js/jquery.2.1.1.min.js";
    $ambilfungsi        = "config/fungsi_search.php";
	
} elseif ($id == "rekapabsen") {
		$nav 				= "Rekap Absen";
		$ambil 				= "absen/rekapabsen.php";
		$ambilcss3			="assets/css/datepicker.css";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$ambiljs3			="assets/js/date-time/bootstrap-datepicker.min.js";
		$ambilfungsi		="config/fungsi_tmbhpeg.php";	
		$classmenu1			="";
		$classmenu2			="";
		$classmenu3			="";
		$classmenu4			="";
		$classmenu5			="";
		$classmenu6			="";

	
} elseif ($id == "inputijin") {
    $nav 				= "Form Input Ijin";
    $ambil 				= "absen/inputijin.php";
    $ambilcss1			="assets/css/datepicker.css";
	$ambilcss2			="assets/css/autocomplete.css";
    $ambiljs0			="assets/js/jquery-1.8.3.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_ijin.php";	
	
	
	
} elseif ($id == "inputabsen") {
    $nav 				= "Form Input Absen";
    $ambil 				= "absen/inputabsen.php";
    $ambilcss1			="assets/css/datepicker.css";
	$ambilcss2			="assets/css/autocomplete.css";
	$ambilcss3			="assets/css/bootstrap-timepicker.css";
    $ambiljs0			="assets/js/jquery-1.8.3.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
	$ambiljs2			="assets/js/date-time/bootstrap-timepicker.min.js";
    $ambilfungsi		="config/fungsi_absen.php";	



} elseif ($id == "cekalfa") {
    $nav 				= "Form Cek Alfa";
    $ambil 				= "absen/cekalfa.php";
    $ambilcss1			="assets/css/datepicker.css";
	$ambilcss2			="assets/css/autocomplete.css";
    $ambiljs0			="assets/js/jquery-1.8.3.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_ijin.php";	
	
} else {
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

	}
?>	