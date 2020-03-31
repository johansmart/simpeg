<?php
$nav				= "";
$ambil				= "home.php";


$id 				= isset($_GET['id']) ? $_GET['id'] : "";
if ($id == "") {
		$nav 				= "Dashboard";
		$ambil 				= "home.php";
		$ambilcss2			="";
        $ambiljs0			="assets/js/jquery.2.1.1.min.js";

		$classmenu1			="active";
	
		

    } elseif ($id == "statistik") {
    $nav 				=  "Statistik";
    $ambil 				=  "statistik.php";
    $ambiljs0			=  "assets/js/jquery.2.1.1.min.js";
    $ambiljs1			=  "assets/js/hm.js";
    $ambiljs2			=  "assets/js/highcharts.js";
    $ambiljs3           =   "exporting.js";
    $ambilfungsi		=   "config/fungsihome.php";

		$classmenu16		="active open";
		$classmenu20		="active";


	} elseif ($id == "list_user") {
		$nav 				= "List User";
		$ambil 				= "lu.php";
		$ambilcss1			="";
		$ambiljs0			="assets/js/jquery-1.8.3.min.js";
		$ambiljs1			="assets/js/lu.js";

		$classmenu26		="active open";
		$classmenu27		="";
		$classmenu28		="active";
		$classmenu29		="";
		$classmenu30		="";
		$classmenu31		="";



	} elseif ($id == "msg") {
		$nav 				= "Inbox";
		$ambil 				= "inbox/inbox.php";
		$ambiljs0			="assets/js/jquery-1.8.3.min.js";
		$ambiljs1			="assets/js/inbox.js";

	} elseif ($id == "jabatan") {
		$nav 				= "Referensi Jabatan";
		$ambil 				= "ref/jab.php";
		$ambilcss1			="";
		$ambiljs0			="assets/js/jquery-1.8.3.min.js";
		$ambiljs1			="assets/js/jab.js";
		$classmenu1			="";
		$classmenu2			="active open";
		$classmenu3			="active";

		
	} elseif ($id == "pengumuman") {
		$nav 				= "Pengumuman";
		$ambil 				= "ref/peng.php";
		$ambilcss1			="";
		$ambiljs0			="assets/js/jquery-1.8.3.min.js";
		$ambiljs1			="assets/js/peng.js";	

		$classmenu26		="active open";
		$classmenu27		="";
		$classmenu28		="";
		$classmenu29		="active";
		$classmenu30		="";
		$classmenu31		="";

} elseif ($id == "kepakaran") {
    $nav 				= "Referensi Kepakaran";
    $ambil 				= "ref/t_kep.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
	$classmenu1			="";
		$classmenu2			="active open";

		$classmenu10		="active";


} elseif ($id == "berkas") {
    $nav 				= "Referensi Berkas";
    $ambil 				= "ref/t_berkas.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
	$classmenu1			="";
		$classmenu2			="active open";

		$classmenu30		="active";

} elseif ($id == "jbs") {
    $nav 				= "Referensi Jabatan Struktural";
    $ambil 				= "ref/t_jabstruktural.php";
    $ambiljs0			= "assets/js/jquery.2.1.1.min.js";
	$classmenu1			="";
		$classmenu2			="active open";

		$classmenu11		="active";


} elseif ($id == "jbf") {
    $nav 				= "Referensi Jabatan Fungsional";
    $ambil 				= "ref/t_jabfungsional.php";
    $ambiljs0			= "assets/js/jquery.2.1.1.min.js";
	$classmenu1			="";
		$classmenu2			="active open";
		
		$classmenu12		="active";
		

} elseif ($id == "payroll") {
    $nav 				= "Referensi Payroll";
    $ambil 				= "ref/pay.php";
    $ambilcss1			="";
    $ambiljs0			="assets/js/jquery-1.8.3.min.js";
    $ambiljs1			="assets/js/pay.js";
	$classmenu1			="";
		$classmenu2			="active open";
		$classmenu15		="active";
		

} elseif ($id == "libur") {
    $nav 				= "Data Hari Libur";
    $ambil 				= "ref/libur.php";
    $ambilcss1			="";
    $ambiljs0			="assets/js/jquery-1.8.3.min.js";
    $ambiljs1			="assets/js/libur.js";
    $classmenu1			="";
    $classmenu2			="active open";
   
    $classmenu32		="active";

} elseif ($id == "formlibur") {
    $nav 				= "Form Libur";
    $ambil 				= "ref/libur.form.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi        ="config/fungsi_inpucuti.php";
    $classmenu1			="";
    $classmenu2			="active open";
   
    $classmenu32		="active";
} elseif ($id == "struktur") {
    $nav 				= "Data Struktur";
    $ambil 				= "ref/struktur.php";
    $ambilcss1			="";
    $ambiljs0			="assets/js/jquery-1.8.3.min.js";
    $ambiljs1			="";
    $classmenu1			="";
    $classmenu2			="active open";
   
    $classmenu33		="active";

} elseif ($id == "formstruktur") {
    $nav 				= "Form Stuktur";
    $ambil 				= "ref/struktur.form.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi        ="";
    $classmenu1			="";
    $classmenu2			="active open";
   
    $classmenu33		="active";
} elseif ($id == "agama") {
		$nav 				= "Referensi Agama";
		$ambil 				= "ref/t_agama.php";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$classmenu1			="";
		$classmenu2			="active open";
		$classmenu5			="active";

} elseif ($id == "duk") {
		$nav 				= "Daftar Urut Kepangkatan";
		$ambil 				= "pegawai/duk.php";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$classmenu16		="active open";
		$classmenu29		="active";

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
	$classmenu1			="";
		$classmenu2			="active open";
		
		$classmenu14		="active";
		

} elseif ($id == "hjabatan") {
    $nav 				= "History Jabatan";
    $ambil 				= "pegawai/hjabatan.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
	$classmenu1			="";
		

} elseif ($id == "hjabfungsi") {
    $nav 				= "History Jabatan Fungsional";
    $ambil 				= "pegawai/hjabfungsi.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
	$classmenu1			="";
		

} elseif ($id == "hjabstruk") {
    $nav 				= "History Jabatan Struktural";
    $ambil 				= "pegawai/hjabstruk.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
	$classmenu1			="";
		

} elseif ($id == "pelatihan") {
    $nav 				= "Pelatihan";
    $ambil 				= "pegawai/pelatihan.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
	$classmenu1			="";
		

} elseif ($id == "keahlian") {
    $nav 				= "Data Sertifikat (Keahlian/Keterampilan)";
    $ambil 				= "pegawai/keahlian.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
	$classmenu1			="";
		
		
} elseif ($id == "penugasan") {
    $nav 				= "Data Sertifikat (Keahlian/Keterampilan)";
    $ambil 				= "pegawai/penugasan.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
	$classmenu1			="";
		
		
} elseif ($id == "karyailmiah") {
    $nav 				= "Karya Ilmiah";
    $ambil 				= "pegawai/karyailmiah.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
	$classmenu1			="";
		

} elseif ($id == "pendidikan") {
    $nav 				= "Data Pendidikan";
    $ambil 				= "pegawai/pendidikan.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
	$classmenu1			="";
		
} elseif ($id == "berkasfile") {
    $nav 				= "Form Berkas File";
    $ambil 				= "pegawai/berkasfile.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
	$classmenu1			="";

} elseif ($id == "pengalaman") {
    $nav 				= "Data Pengalaman Kerja";
    $ambil 				= "pegawai/pengalaman.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
	$classmenu1			="";
		

} elseif ($id == "penghargaan") {
    $nav 				= "Penghargaan";
    $ambil 				= "pegawai/penghargaan.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
	$classmenu1			="";
		
		
} elseif ($id == "golongan") {
    $nav 				= "Golongan";
    $ambil 				= "pegawai/hgolongan.php";
    $ambilcss2			="assets/css/datepicker.css";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_tmbhpeg.php";
	$classmenu1			="";
		

	
	} elseif ($id == "statusp") {
		$nav 				= "Referensi Status Pegawai";
		$ambil 				= "ref/t_statuspeg.php";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$classmenu1			="";
		$classmenu2			="active open";
		$classmenu3			="";
		$classmenu4			="";
		$classmenu5			="";
		$classmenu6			="";
		$classmenu7			="";
		$classmenu8			="active";
		
		
	} elseif ($id == "bank") {
		$nav 				= "Referensi Bank Transfer";
		$ambil 				= "ref/t_bank.php";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$classmenu1			="";
		$classmenu2			="active open";
		$classmenu9			="active";
		

	} elseif ($id == "bagian") {
		$nav 				= "Referensi Bagian";
		$ambil 				= "ref/t_bag.php";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$classmenu1			="";
		$classmenu2			="active open";
		$classmenu3			="";
		$classmenu4			="active";
		
		
	} elseif ($id == "absen") {
		$nav 				= "Referensi Absen";
		$ambil 				= "ref/abs.php";
		$ambiljs0			="assets/js/jquery-1.8.3.min.js";
		$ambiljs1			="assets/js/abs.js";
		$classmenu1			="";
		$classmenu2			="active open";
		$classmenu3			="";
		$classmenu4			="";
		$classmenu5			="";
		$classmenu6			="active";
		
		
    } elseif ($id == "cuti") {
        $nav 				= "Referensi Cuti";
        $ambil 				= "ref/t_cuti.php";
        $ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$classmenu1			="";
		$classmenu2			="active open";
		$classmenu3			="";
		$classmenu4			="";
		$classmenu5			="";
		$classmenu6			="";
		$classmenu7			="active";
		
		
    
		
    } elseif ($id == "subbg") {
    $nav 				= "Referensi Sub Bagian";
    $ambil 				= "ref/t_subbg.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
	$classmenu1			="";
		$classmenu2			="active open";
		
		$classmenu13		="active";
		
		

} elseif ($id == "hasil") {
    $nav 				= "hasilcari";
    $ambil 				= "hasil.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
	$classmenu1			="";
		
	
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

	} elseif ($id == "data_pegawai") {
		$nav 				= "Data Pegawai";
		$ambil 				= "pegawai/data_peg.php";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$ambilfungsi		="config/fungsi_dafpeg.php";
		$ambiljs2			="assets/js/jquery.dataTables.min.js";
		$ambiljs3			="assets/js/jquery.dataTables.bootstrap.js";
		$ambiljs4			="assets/js/dataTables.tableTools.min.js";
		$ambiljs5			="assets/js/dataTables.colVis.min.js";
	
		$classmenu16		="active open";
		$classmenu17		="";
		$classmenu18		="active";
		

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
	
		$classmenu21		="active open";
		$classmenu22		="";
		$classmenu23		="active";
		

} elseif ($id == "datajatah") {
    $nav 				= "Data Jatah Cuti";
    $ambil 				= "absen/data_jatah.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambilfungsi		="config/fungsi_datajatah.php";
    $ambiljs2			="assets/js/jquery.dataTables.min.js";
    $ambiljs3			="assets/js/jquery.dataTables.bootstrap.js";
    $ambiljs4			="assets/js/dataTables.tableTools.min.js";
    $ambiljs5			="assets/js/dataTables.colVis.min.js";
    

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
		
		$classmenu21		="active open";
		$classmenu22		="active";
		
		
		
	 } elseif ($id == "appcuti") {
    $nav 				= "Approve Cuti";
    $ambil 				= "absen/app_cuti.php";
    $ambiljs0			="assets/js/jquery.2.1.1.min.js";
    $ambilfungsi		="";
	$classmenu1			="";
		
		$classmenu21		="active open";
		$classmenu22		="active";
		
	
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
		
		$classmenu21		="active open";
		$classmenu22		="";
		$classmenu23		="";
		$classmenu24		="active";
		
	} elseif ($id == "proses_pay") {
		$nav 				= "Proses Payrol";
		$ambil 				= "payroll/proses_p.php";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
	} elseif ($id == "tambahpeg") {
		$nav 				= "Tambah Pegawai";
		$ambil 				= "pegawai/tmbh_peg.php";
		$ambilcss3			="assets/css/datepicker.css";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$ambiljs3			="assets/js/date-time/bootstrap-datepicker.min.js";
		$ambilfungsi		="config/fungsi_tmbhpeg.php";
		$classmenu16		="active open";
		$classmenu17		="active";
		

    } elseif ($id == "rekapitulasi") {
        $nav 				= "Rekapitulasi";
        $ambil 				= "pegawai/rekap.php";
        $ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$classmenu16		="active open";
		$classmenu17		="";
		$classmenu18		="";
		$classmenu19		="active";
		
	} elseif ($id == "rekapcuti") {
		$nav 				= "Rekap Cuti";
		$ambil 				= "absen/rekapcuti.php";
		$ambilcss3			="assets/css/datepicker.css";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$ambiljs3			="assets/js/date-time/bootstrap-datepicker.min.js";
		$ambilfungsi		="config/fungsi_tmbhpeg.php";	
		
		
	} elseif ($id == "rekapabsen") {
		$nav 				= "Rekap Absen";
		$ambil 				= "absen/rekapabsen.php";
		$ambilcss3			="assets/css/datepicker.css";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
		$ambiljs3			="assets/js/date-time/bootstrap-datepicker.min.js";
		$ambilfungsi		="config/fungsi_tmbhpeg.php";	
		

	} elseif ($id == "set") {
		$nav 				= "Setting";
		$ambil 				= "setting.php";
		$ambiljs0			="assets/js/jquery.2.1.1.min.js";
        $ambilfungsi        = "config/fungsi_image.php";
		
		$classmenu26		="active open";
		$classmenu27		="active";

    } elseif ($id == "cari") {
    $nav 				= "Cari Pegawai";
    $ambil 				= "pegawai/caripegawai.php";
    $ambiljs0			= "assets/js/jquery.2.1.1.min.js";
	
    } elseif ($id == "search") {
    $nav 				= "Advanced Search";
    $ambil 				= "search.php";
    $ambiljs0			= "assets/js/jquery.2.1.1.min.js";
    $ambilfungsi        = "config/fungsi_search.php";
	$classmenu1			="";
		
		$classmenu25		="active";
		


} elseif ($id == "import") {
    $nav 				= "Import data pegawai";
    $ambil 				= "importxls.php";
    $ambiljs0			= "assets/js/jquery.2.1.1.min.js";
    $ambilfungsi        = "config/fungsi_import.php";
	
		$classmenu26		="active open";
		$classmenu31		="active";
	
} elseif ($id == "inputijin") {
    $nav 				= "Form Input Ijin";
    $ambil 				= "absen/inputijin.php";
    $ambilcss1			="assets/css/datepicker.css";
	$ambilcss2			="assets/css/autocomplete.css";
    $ambiljs0			="assets/js/jquery-1.8.3.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_ijin.php";	
	$classmenu1			="";
		
		
} elseif ($id == "inputcuti") {
    $nav 				= "Form Input Cuti";
    $ambil 				= "absen/inputcuti.php";
    $ambilcss2			="assets/css/datepicker.css";
	$ambilcss3			="assets/css/autocomplete.css";
    $ambiljs0			="assets/js/jquery-1.8.3.min.js";
    $ambiljs1			="assets/js/date-time/bootstrap-datepicker.min.js";
    $ambilfungsi		="config/fungsi_inpucuti.php";	
	
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
	
    } elseif ($id == "bnr") {
        $nav 				= "Backup & Restore";
        $ambil 				= "bnr.php";
        $ambilcss2			="assets/css/chosen.css";
        $ambiljs0			="assets/js/jquery.2.1.1.min.js";
        $ambiljs2			="assets/js/chosen.jquery.min.js";
        $ambilfungsi        ="config/fungsi_backup.php";
		
		$classmenu26		="active open";
		
		$classmenu30		="active";
	
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
		

	}
?>	