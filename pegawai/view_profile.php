<?php
error_reporting(0);
$id_pegawai	= $_GET['id_n'];

$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5' )
{

?>
<div class="clearfix">



    <div class="pull-right">
        <span class="green middle bolder">Pilih: &nbsp;</span>

        <div class="btn-toolbar inline middle no-margin">
            <div data-toggle="buttons" class="btn-group no-margin">
                <label class="btn btn-sm btn-yellow active">
                    <span class="bigger-110">Form 1</span>

                    <input type="radio" value="1" />
                </label>

            </div>
			
        </div>
    </div>
</div>

<div class="hr dotted"></div>

<div>
    <div id="user-profile-1" class="user-profile row">
        <div class="col-xs-12 col-sm-3 center">

            <?php
            $data = mysqli_query($mysqli,"SELECT tbl_user.id_user,pegawai.id,pegawai.foto,tbl_user.username,tbl_user.facebook,tbl_user.twitter,tbl_user.googleplus,
pegawai.nip,pegawai.nama,pegawai.g_dpn,pegawai.g_blkng,pegawai.tmpt_lahir,pegawai.tgl_lahir,
pegawai.alamat,prov.nama_prov,kabkot.nama_kabkot,kec.nama_kec,
pegawai.alamat_s,pegawai.tlpn,tbl_user.email,pegawai.nohp,pegawai.nofax,
pegawai.email_k,pegawai.jenis_kelamin,tbl_agama.nmagama,tbl_statusk.nmstatusk,
pegawai.tgl_masuk,tbl_user.w_login,tbl_bank.nm_bank,pegawai.norek,pegawai.npwp,pegawai.nojamsos,
pegawai.nodplk,pegawai.nojw,(year(curdate()) - year(pegawai.tgl_masuk)) AS t_mk,
(month(pegawai.tgl_masuk)-month(curdate())) AS b_mk   FROM pegawai
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
                if ($j_data == 0){
                    echo "<div class='alert alert-danger'>Pegawai Belum Melakukan Registrasi / Data belum lengkap</div>";
                }
                else {
                    while($b = mysqli_fetch_array($data)) {

                        echo "<div>";
                        echo "<span class='profile-picture'>";
                        echo "<img width='200px' height='200px' src='" . $b['foto'] . "'/>";
                        echo "</span>";
                        echo "<div class='space-4'></div>";
                        echo "<div class='width-80 label label-info label-xlg arrowed-in arrowed-in-right'>";
                        echo "<div class='inline position-relative'>";
                        echo "<a href='#' class='user-title-label dropdown-toggle' data-toggle='dropdown'>";
                        echo "<i class='ace-icon fa fa-circle light-green'></i>";
                        echo "&nbsp;";
                        echo "<span class='white' >" . $b['username'] . "</span>";
                        echo "</a>";

                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='space-6'></div>";
                        echo "<div class='profile-contact-info'>";
                        echo "<div class='profile-contact-links align-center'>";
                        echo "<a href='".$b['facebook']."' class='tooltip-info' title='' data-original-title='Visit my Facebook'>";
                        echo "<i class='middle ace-icon fa fa-facebook-square fa-2x blue'></i>";
                        echo "</a>";
                        echo "<a href='".$b['twitter']."' class='tooltip-info' title='' data-original-title='Visit my Twitter'>";
                        echo "<i class='middle ace-icon fa fa-twitter-square fa-2x light-blue'></i>";
                        echo "</a>";
                        echo "<a href='".$b['googleplus']."' class='tooltip-info' title='' data-original-title='Visit my Google+'>";
                        echo "<i class='middle ace-icon fa fa-google-plus fa-2x red'></i>";
                        echo "</a>";
						echo "<a href='cetak/cetakprofile.php?id_n=".$b['id']."' target='_blank'  >";
                        echo "<i class='middle ace-icon fa fa-print fa-2x red'></i>";
                        echo "</a>";


                        echo "</div>";
                        echo "</div>";

                        echo "</div>";
						echo "<div></div>";
                        echo "    <div class='col-xs-12 col-sm-9'>";
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
                        echo "<span class='' id='nama'>" . $b['nama'] . "</span>";
                        echo "</div>";
                        echo "</div>";
						 echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'> Gelar Depan</div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span class='' id='nama'>" . $b['g_dpn'] . "</span>";
                        echo "</div>";
                        echo "</div>";
						 echo "<div class='profile-info-row'>";
                        echo "<div class='profile-info-name'> Gelar Belakang</div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span class='' id='nama'>" . $b['g_blkng'] . "</span>";
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
						
						if($b['jenis_kelamin'] == 'L'){
							echo"<span>Laki-laki</span>";
						}else{
							echo"<span>Perempuan</span>";
						}
                        
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
                        echo "<div class='profile-info-name'>Online Terakhir</div>";
                        echo "<div class='profile-info-value'>";
                        echo "<span class='editable'>" . relative_format($b['w_login']) . "</span>";
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
						if ($b['t_mk']==0) {
                             echo "<span>".$b['b_mk']." Bulan</span>";
                        }else {
                             echo "<span>".$b['t_mk']." Tahun ".$b['b_mk']." Bulan</span>";
                        }
                       
                        echo "</div>";
                        echo "</div>";

                        echo "</div>";
                        echo "<div class='space-20'></div>";
						echo "</div>";
                        echo "<div class='col-xs-12 col-sm-12'>";
                        echo "<div class='widget-box transparent'>";

                        echo "<div class='widget-header widget-header-small'>";
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
                            echo "<tr><td colspan='4'>-- Tidak Ada Data --</td></tr>";
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
						echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Jenjang</th><th>Asal Sekolah</th><th>Kota</th><th>Jurusan</th><th>Tahun Lulus</th><th>No Ijazah</th><th>File</th><th>*Check List</th></tr>";
						$q_pend 	= mysqli_query($mysqli,"SELECT a.*,b.nmpndidik FROM pendidikan a
                            left join tbl_pendidikan b on a.kdpndidik=b.kdpndidik
                         where a.id=$id_pegawai ORDER BY a.idp ASC") or die (mysqli_error($mysqli));
						$j_data 	= mysqli_num_rows($q_pend);

						if ($j_data == 0) {
						echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
						} else {
						$no=1;
						while ($a_pndk = mysqli_fetch_array($q_pend)) {
						echo "<tr><td>$no</td><td>$a_pndk[12]</td><td>$a_pndk[5]</td><td>$a_pndk[6]</td><td>$a_pndk[7]</td><td>$a_pndk[1]</td><td>$a_pndk[8]</td><td><a href='$a_pndk[11]'>Download</a></td><td></td>
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
                        echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal Mulai</th><th>Tanggal Akhir</th><th>Kota</th><th>Sertifikat</th><th>No Sertifikat</th><th>Institusi</th><th>File</th><th>*Check List</th></tr>";
                        $q_sert 	= mysqli_query($mysqli,"SELECT * FROM sertifikat2 where id=$id_pegawai ORDER BY idsertifikat ASC") or die (mysql_error());
                        $j_data 	= mysqli_num_rows($q_sert);

                        if ($j_data == 0) {
                            echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
                        } else {
                            $no=1;
                            while ($a_sert = mysqli_fetch_array($q_sert)) {
                                echo "<tr><td>$no</td><td>$a_sert[1]</td><td>$a_sert[2]</td><td>$a_sert[3]</td><td>$a_sert[4]</td><td>$a_sert[5]</td><td><a href='$a_sert[6]'>Download</a></td>
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
                echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal Mulai</th><th>Nama Pelatihan</th><th>Tempat</th><th>Jumlah Jam / Hari</th><th>Peyelengara</th><th>*Check List</th></tr>";
                $q_pel 	    = mysqli_query($mysqli,"SELECT * FROM pelatihan where id=$id_pegawai ORDER BY id_pelatihan ASC") or die (mysqli_error($mysqli));
                $j_data 	= mysqli_num_rows($q_pel);

                if ($j_data == 0) {
                    echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
                } else {
                    $no=1;
                    while ($a_pel = mysqli_fetch_array($q_pel)) {
                        echo "<tr><td>$no</td><td>$a_pel[tgl_pelatihan]</td><td>$a_pel[topik_pelatihan]</td><td>$a_pel[tempat]</td><td>$a_pel[jam]</td><td>$a_pel[penyelenggara]</td><td></td></td></td>
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
                echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal Mulai</th><th>Tanggal Akhir</th><th>Organisasi/Perusahaan</th><th>Jabatan</th><th>Keterangan</th><th>File</th><th>*Check List</th></tr>";
                $q_pek 	    = mysqli_query($mysqli,"SELECT * FROM pengalaman_kerja where id=$id_pegawai ORDER BY id_peker ASC") or die (mysqli_error($mysqli));
                $j_data 	= mysqli_num_rows($q_pek);

                if ($j_data == 0) {
                    echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
                } else {
                    $no=1;
                    while ($a_pek = mysqli_fetch_array($q_pek)) {
                        echo "<tr><td>$no</td><td>$a_pek[tgl_awal]</td><td>$a_pek[tgl_akhir]</td><td>$a_pek[pt]</td><td>$a_pek[nm_pekerjaan]</td><td>$a_pek[d_pekerjaan]</td><td><a href='$a_pek[file]'>Download</a></td>
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
                echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal Mulai</th><th>Tanggal Akhir</th><th>No.SK</th><th>Jabatan</th><th>Unit Bisnis Kerja</th><th>Tempat Kerja/Proyek</th><th>Renc</th><th>Real</th><th>Nama Atasan</th><th>Jabatan Atasan</th><th>*Check List</th></tr>";
                $q_pen 	    = mysqli_query($mysqli,"SELECT * FROM penugasan where id=$id_pegawai ORDER BY idpng ASC") or die (mysqli_error($mysqli));
                $j_data 	= mysqli_num_rows($q_pen);

                if ($j_data == 0) {
                    echo "<tr><td colspan='12'>-- Tidak Ada Data --</td></tr>";
                } else {
                    $no=1;
                    while ($a_pen = mysqli_fetch_array($q_pen)) {
                        echo "<tr><td>$no</td><td>$a_pen[tgl_awal]</td><td>$a_pen[tgl_akhir]</td><td>$a_pen[no_sk]</td><td>$a_pen[jabatan]</td><td>$a_pen[unit_kerja]</td><td>$a_pen[tempat]</td><td>$a_pen[d_renc]</td><td>$a_pen[d_real]</td><td>$a_pen[nm_atasan]</td><td>$a_pen[jb_atasan]</td><td></td></td>
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
            }
            ?>

</div>
    </div>
    </div>


            <?php
            }else{
                header('Location:../index.php?status=Silahkan Login');
            }
            ?>