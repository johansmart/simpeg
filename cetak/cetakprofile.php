<?php
 session_start();
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'  ) 

{


?>

<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Dashboard - ASKA Admin</title>

	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<link rel="shortcut icon" href="../favicon.ico" />
	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../assets/font-awesome/4.1.0/css/font-awesome.min.css" />
	
	<link rel="stylesheet" href="../assets/css/jquery-ui.custom.min.css" />
	<link rel="stylesheet" href="" />
	<link rel="stylesheet" href="../assets/css/bootstrap-editable.css" />	
	
	<!-- page specific plugin styles -->

	<!-- text fonts -->
	<link rel="stylesheet" href="../assets/fonts/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="../assets/css/ace.min.css" id="main-ace-style" />

	<!--[if lte IE 9]>
	<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
	<![endif]-->
	<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />

	<!--[if lte IE 9]>
	<link rel="stylesheet" href="assets/css/ace-ie.min.css" />
	<![endif]-->

	<!-- ace settings handler -->
	<script src="../assets/js/ace-extra.min.js"></script>
	<script src="../assets/js/time.js" type="text/javascript"></script>
	<script src="../assets/js/jquery.2.1.1.min.js"></script>
	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
    	<!--[if lte IE 8]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>


	<![endif]-->
</head>

<body onLoad="window.print()">





<?php 
$id_pegawai	= $_GET['id_n'];
include "../config/koneksi.php";
include "../config/fungsi_masakerja.php";
include "../config/fungsi_indotgl.php";



            $data = mysqli_query($mysqli,"SELECT tbl_user.id_user,pegawai.id,pegawai.foto,tbl_user.username,tbl_user.facebook,tbl_user.twitter,tbl_user.googleplus,
pegawai.nip,pegawai.nama,pegawai.g_dpn,pegawai.g_blkng,pegawai.tmpt_lahir,pegawai.tgl_lahir,
pegawai.alamat,prov.nama_prov,kabkot.nama_kabkot,kec.nama_kec,
pegawai.alamat_s,pegawai.tlpn,tbl_user.email,pegawai.nohp,pegawai.nofax,
pegawai.email_k,pegawai.jenis_kelamin,tbl_agama.nmagama,tbl_statusk.nmstatusk,
pegawai.tgl_masuk,tbl_user.w_login,tbl_bank.nm_bank,pegawai.norek,pegawai.npwp,pegawai.nojamsos,
pegawai.nodplk,pegawai.nojw,(year(curdate()) - year(pegawai.tgl_masuk)) AS t_mk  FROM pegawai
left join tbl_user on tbl_user.nip=pegawai.nip
left join jabatan on  pegawai.id_jab=jabatan.kode 
left join tbl_agama on pegawai.id_agm=tbl_agama.id_agm 
left join tbl_statusk on pegawai.kdstatusk=tbl_statusk.kdstatusk 
left join tbl_bank on pegawai.id_bank=tbl_bank.id_bank 
left join prov on pegawai.id_prov=prov.id_prov 
left join kabkot on pegawai.id_kabkot=kabkot.id_kabkot 
left join kec on pegawai.id_kec=kec.id_kec
							where pegawai.id=$id_pegawai");
            $j_data 	= mysqli_num_rows($data);
            $masakerja=MasaKerja($b['tgl_masuk'],$tahunM,$bulanM,$tanggalM);
                if ($j_data == 0){
                    echo "<div class='alert alert-danger'>Pegawai Belum Melakukan Registrasi / Data belum lengkap</div>";
                }
                else {
                   
				   
				   $b = mysqli_fetch_array($data) ;

                        echo "<div>";
                        echo "<span class='profile-picture'>";
                        echo "<img width='200px' height='200px' src='../" . $b['foto'] . "'/>";
                        echo "</span>";
                        echo "<div class='space-4'></div>";
                        

                       
                       
                        echo "    <div class='col-xs-12 col-sm-12'>";
                        echo "    <div class='center'>";
                        echo "    <span class='btn btn-light no-hover'>";
                        echo " <span class='line-height-1 bigger-200 blue'>Profil Pegawai
						 
						</span>";
						
                        echo " <br />";
						
						
                        echo "</div>";
						echo"";
						
                        echo "<div class='space-12'></div>";
                        echo "<h4 class='widget-title smaller'>";
                        echo "<i class='ace-icon fa fa-check-square-o bigger-110'></i>	";
                        echo "Data Pribadi";
                        echo "</h4>";

                        echo "<div class='profile-user-info profile-user-info-striped'>";
						 echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'>NIP</div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span class='' id='nip'>" . $b['nip'] . "</span>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'> Nama Lengkap</div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span class='' id='nama'>" . $b['g_dpn'] . " " . $b['nama'] . " " . $b['g_blkng'] . "</span>";
                        echo "</div>";
                        echo "</div>";
						
                        echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'> Tempat Tanggal Lahir </div>";
                        echo "<div class='profile-info-value'>";
                        echo "<i class='fa fa-map-marker light-orange bigger-110'></i>";
                        echo "<span class='' id='tempatlhr'>" . $b['tmpt_lahir'] . ", " . tgl_indo($b['tgl_lahir']) . "</span>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'>Alamat Rumah Tetap</div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span id='motto'>" . $b['alamat'] . " Provinsi : <b>".$b['nama_prov']."</b> Kabupaten: <b>".$b['nama_kabkot']."</b> Kecamatan : <b>".$b['nama_kec']."</b></span>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'>Alamat Rumah Sementara</div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span id='motto'>" . $b['alamat_s'] . "</span>";
                        echo "</div>";
                        echo "</div>";
                       
                        echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'> Tlp </div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span class='editable'>" . $b['tlpn'] . " / No.Hp." . $b['nohp'] . " / Fax." . $b['nofax'] . " </span>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'> Email</div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span class='' id='email'>Pribadi: " . $b['email'] . " Kantor : " . $b['email_k'] . "  </span>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'> Jenis Kelamin </div>";
                        echo "<div class='profile-info-value'>";
						
                        echo "<span>".($b['jenis_kelamin'] == "L" ? "Laki-laki" : "Perempuan")."</span>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'>Agama</div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span>" . $b['nmagama'] . "</span>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'>Status Perkawainan</div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span>" . $b['nmstatusk'] . "</span>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'> Tanggal Masuk </div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span class='editable' id='tgldaftar'>" . tgl_indo($b['tgl_masuk']) . "</span>";
                        echo "</div>";
                        echo "</div>";
                       
                        echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'>Bank & Asuransi</div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span>Nama Bank :<b> " . $b['nm_bank'] . "</b>| Norekening :<b> " . $b['norek'] . "</b>|No.NPWP:<b> " . $b['npwp'] . "</b>|No.Jamsostek:<b> " . $b['nojamsos'] . "</b>|No.DPLK Manulife:<b> ". $b['nodplk'] . "</b> | No.Jiwasaraya:<b> ". $b['nojw'] . "</b></span>";
                        echo "</div>";
                        echo "</div>";
						
						echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'>Masa Kerja</div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span>".$masakerja['masa_kerja']."</span>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";

                        echo "</div>";
                        echo "<div class='space-20'></div>";
						echo "</div>";
                        echo "<div class='col-xs-12 col-sm-12'>";
                        echo "<div class='widget-box transparent'>";

                        echo "</br></br></br></br></br></br></br></br></br><div class='widget-header widget-header-small'>";
                        echo "<h4 class='widget-title smaller'>";
                        echo "<i class='ace-icon fa fa-check-square-o bigger-110'></i>	";
                        echo "Keluarga";
                        echo "</h4>";
                        echo "</div>";
                        echo "<div class='widget-body'>";
                        echo "<div class='widget-main'>";
                        echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Nama</th><th>Hubungan</th><th>Pekerjaan</th><th>Tempat Lahir</th><th>Tanggal Lahir</th></tr>";
                        $q_klg 	= mysqli_query($mysqli,"SELECT * FROM keluarga where id=$id_pegawai ORDER BY id_k ASC") or die (mysqli_error($mysqli));
                        $j_data 	= mysqli_num_rows($q_klg);

                        if ($j_data == 0) {
                            echo "<tr><td colspan='6'>-- Tidak Ada Data --</td></tr>";
                        } else {
                            $no=1;
                            while ($a_klg = mysqli_fetch_array($q_klg)) {
                                echo "<tr><td>$no</td><td>$a_klg[nm_k]</td><td>$a_klg[ket]</td><td>$a_klg[pekerjaan]</td><td>$a_klg[tempat_lahir]</td><td>$a_klg[tgl_lahirk]</td></td>
						</tr>";
                                $no++;
                            }
                        }
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";


                        echo "<div class='widget-header widget-header-small'>";
                        echo "<h4 class='widget-title smaller'>";
                        echo "<i class='ace-icon fa fa-check-square-o bigger-110'></i>	";
                        echo "Pendidikan Formal";
                        echo "</h4>";
                        echo "</div>";
                        echo "<div class='widget-body'>";
                        echo "<div class='widget-main'>";
						echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Jenjang</th><th>Asal Sekolah</th><th>Kota</th><th>Jurusan</th><th>Tahun Lulus</th><th>No Ijazah</th></tr>";
						$q_pend 	= mysqli_query($mysqli,"SELECT * FROM pendidikan where id=$id_pegawai ORDER BY idp ASC") or die (mysqli_error($mysqli));
						$j_data 	= mysqli_num_rows($q_pend);

						if ($j_data == 0) {
						echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
						} else {
						$no=1;
						while ($a_pndk = mysqli_fetch_array($q_pend)) {
						echo "<tr><td>$no</td><td>$a_pndk[2]</td><td>$a_pndk[5]</td><td>$a_pndk[6]</td><td>$a_pndk[7]</td><td>$a_pndk[1]</td><td>$a_pndk[8]</td>
						</tr>";
						$no++;
						}
						}
						echo "</table>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='widget-header widget-header-small'>";
                        echo "<h4 class='widget-title smaller'>";
                        echo "<i class='ace-icon fa fa-check-square-o bigger-110'></i>	";
                        echo "Data Sertifikat (Keahlian/Keterampilan)";
                        echo "</h4>";
                        echo "</div>";
                        echo "<div class='widget-body'>";
                        echo "<div class='widget-main'>";
                        echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal Mulai</th><th>Tanggal Akhir</th><th>Kota</th><th>Sertifikat</th><th>No Sertifikat</th><th>Institusi</th><th>File</th></tr>";
                        $q_sert 	= mysqli_query($mysqli,"SELECT * FROM sertifikat2 where id=$id_pegawai ORDER BY idsertifikat ASC") or die (mysql_error());
                        $j_data 	= mysqli_num_rows($q_sert);

                        if ($j_data == 0) {
                            echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
                        } else {
                            $no=1;
                            while ($a_sert = mysqli_fetch_array($q_sert)) {
                                echo "<tr><td>$no</td><td>$a_sert[1]</td><td>$a_sert[2]</td><td>$a_sert[3]</td><td>$a_sert[4]</td><td>$a_sert[5]</td><td></td>
						</tr>";
                                $no++;
                            }
                        }
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";

						echo "<div class='widget-header widget-header-small'>";
                echo "<h4 class='widget-title smaller'>";
                echo "<i class='ace-icon fa fa-check-square-o bigger-110'></i>	";
                echo "Data Pelatihan & Pengembangan";
                echo "</h4>";
                echo "</div>";
                echo "<div class='widget-body'>";
                echo "<div class='widget-main'>";
                echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal Mulai</th><th>Nama Pelatihan</th><th>Tempat</th><th>Jumlah Jam / Hari</th><th>Peyelengara</th></tr>";
                $q_pel 	    = mysqli_query($mysqli,"SELECT * FROM pelatihan where id=$id_pegawai ORDER BY id_pelatihan ASC") or die (mysqli_error($mysqli));
                $j_data 	= mysqli_num_rows($q_pel);

                if ($j_data == 0) {
                    echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
                } else {
                    $no=1;
                    while ($a_pel = mysqli_fetch_array($q_pel)) {
                        echo "<tr><td>$no</td><td>$a_pel[tgl_pelatihan]</td><td>$a_pel[topik_pelatihan]</td><td>$a_pel[tempat]</td><td>$a_pel[jam]</td><td>$a_pel[penyelenggara]</td>
						</tr>";
                        $no++;
                    }
                }
                echo "</table>";
                echo "</div>";
                echo "</div>";
				
				
				echo "<div class='widget-header widget-header-small'>";
                echo "<h4 class='widget-title smaller'>";
                echo "<i class='ace-icon fa fa-check-square-o bigger-110'></i>	";
                echo "Pengalaman Kerja";
                echo "</h4>";
                echo "</div>";
                echo "<div class='widget-body'>";
                echo "<div class='widget-main'>";
                echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal Mulai</th><th>Tanggal Akhir</th><th>Organisasi/Perusahaan</th><th>Jabatan</th><th>Keterangan</th><th>File</th></tr>";
                $q_pek 	    = mysqli_query($mysqli,"SELECT * FROM pengalaman_kerja where id=$id_pegawai ORDER BY id_peker ASC") or die (mysqli_error($mysqli));
                $j_data 	= mysqli_num_rows($q_pek);

                if ($j_data == 0) {
                    echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
                } else {
                    $no=1;
                    while ($a_pek = mysqli_fetch_array($q_pek)) {
                        echo "<tr><td>$no</td><td>$a_pek[tgl_awal]</td><td>$a_pek[tgl_akhir]</td><td>$a_pek[pt]</td><td>$a_pek[nm_pekerjaan]</td><td>$a_pek[d_pekerjaan]</td><td></td>
						</tr>";
                        $no++;
                    }
                }
                echo "</table>";
                echo "</div>";
                echo "</div>";
				
				
				echo "<div class='widget-header widget-header-small'>";
                echo "<h4 class='widget-title smaller'>";
                echo "<i class='ace-icon fa fa-check-square-o bigger-110'></i>	";
                echo "Data Penugasan Karyawan";
                echo "</h4>";
                echo "</div>";
                echo "<div class='widget-body'>";
                echo "<div class='widget-main'>";
                echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal Mulai</th><th>Tanggal Akhir</th><th>No.SK</th><th>Jabatan</th><th>Unit Bisnis Kerja</th><th>Tempat Kerja/Proyek</th><th>Renc</th><th>Real</th><th>Nama Atasan</th><th>Jabatan Atasan</th></tr>";
                $q_pen 	    = mysqli_query($mysqli,"SELECT * FROM penugasan where id=$id_pegawai ORDER BY idpng ASC") or die (mysqli_error($mysqli));
                $j_data 	= mysqli_num_rows($q_pen);

                if ($j_data == 0) {
                    echo "<tr><td colspan='12'>-- Tidak Ada Data --</td></tr>";
                } else {
                    $no=1;
                    while ($a_pen = mysqli_fetch_array($q_pen)) {
                        echo "<tr><td>$no</td><td>$a_pen[tgl_awal]</td><td>$a_pen[tgl_akhir]</td><td>$a_pen[no_sk]</td><td>$a_pen[jabatan]</td><td>$a_pen[unit_kerja]</td><td>$a_pen[tempat]</td><td>$a_pen[d_renc]</td><td>$a_pen[d_real]</td><td>$a_pen[nm_atasan]</td><td>$a_pen[jb_atasan]</td>
						</tr>";
                        $no++;
                    }
                }
                echo "</table>";
                echo "Untuk Kepala Proyek (Ex Kapro) diisi BK/PU & Kepala Cabang (Ex Kacab) diisi NKB)";

                echo "</div>";
                echo "</div>";
                echo "</div>";
				
				echo "<div class='widget-header widget-header-small'>";
                echo "<h4 class='widget-title smaller'>";
                echo "<i class='ace-icon fa fa-check-square-o bigger-110'></i>	";
                echo "Karya Ilmiah";
                echo "</h4>";
                echo "</div>";
                echo "<div class='widget-body'>";
                echo "<div class='widget-main'>";
                echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal</th><th>Judul</th><th>Tempat</th><th>Sifat Karya Ilmiah</th><th>Lingkup Kegiatan</th><th>Referensi</th></tr>";
                $q_ki 	    = mysqli_query($mysqli,"SELECT * FROM karya_ilmiah where id=$id_pegawai ORDER BY id_ki ASC") or die (mysqli_error($mysqli));
                $j_data 	= mysqli_num_rows($q_ki);

                if ($j_data == 0) {
                    echo "<tr><td colspan='7'>-- Tidak Ada Data --</td></tr>";
                } else {
                    $no=1;
                    while ($a_ki = mysqli_fetch_array($q_ki)) {
                        echo "<tr><td>$no</td><td>$a_ki[tgl]</td><td>$a_ki[judul]</td><td>$a_ki[tempat]</td><td>$a_ki[sifat_karyailmiah]</td><td>$a_ki[lingkup_kegiatan]</td><td>$a_ki[referensi]</td>
						</tr>";
                        $no++;
                    }
                }
                echo "</table>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

                        echo "</div>";
                        echo "</div>";


                        echo " <div class='space-6'></div>";






                    
            }
            ?>






</body>
</html>
<?php
}else{
	  echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>