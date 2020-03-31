<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5' ) 



{

?>
<!-- PAGE CONTENT BEGINS -->
<div class="clearfix">
	<div class="pull-left alert alert-success no-margin">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>

		<i class="ace-icon fa fa-umbrella bigger-120 blue"></i>
		Silahkan Pilih Edit Profile-Settings untuk merubah foto anda...
    </div>

    <?php
    $mod 			= isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;
    $p_user 		= isset($_POST['username']) ? $_POST['username'] : NULL;
    $p_nama	   		= isset($_POST['nama']) ? $_POST['nama'] : NULL;
    $p_ttl 		    = isset($_POST['ttl']) ? $_POST['ttl'] : NULL;
	$p_nip 		    = isset($_POST['nip']) ? $_POST['nip'] : NULL;
    $p_tgl_lahir	= isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : NULL;
    $p_jk		    = isset($_POST['jk']) ? $_POST['jk'] : NULL;
    $p_alamat 		= isset($_POST['alamat']) ? $_POST['alamat'] : NULL;
    $p_about		= isset($_POST['about']) ? $_POST['about'] : NULL;
    $p_email		= isset($_POST['email']) ? $_POST['email'] : NULL;
    $p_web          = isset($_POST['web']) ? $_POST['web'] : NULL;
    $p_tlpn		    = isset($_POST['tlpn']) ? $_POST['tlpn'] : NULL;
    $p_nohp		    = isset($_POST['nohp']) ? $_POST['nohp'] : NULL;
    $p_fb     	    = isset($_POST['fb']) ? $_POST['fb'] : NULL;
    $p_twitter	    = isset($_POST['twitter']) ? $_POST['twitter'] : NULL;
    $p_googleplus   = isset($_POST['googleplus']) ? $_POST['googleplus'] : NULL;
    $p_pass 		= isset($_POST['pass2']) ? $_POST['pass2'] : NULL;
    $p_gdpn 		= isset($_POST['g_dpn']) ? $_POST['g_dpn'] : NULL;
    $p_gblkng		= isset($_POST['g_blkng']) ? $_POST['g_blkng'] : NULL;
    $p_alamats 		= isset($_POST['alamat_s']) ? $_POST['alamat_s'] : NULL;
    $p_nofax 		= isset($_POST['nofax']) ? $_POST['nofax'] : NULL;
    $p_id_agm 		= isset($_POST['id_agm']) ? $_POST['id_agm'] : NULL;
    $p_kdstatusk 	= isset($_POST['kdstatusk']) ? $_POST['kdstatusk'] : NULL;
	$p_id_prov      = isset($_POST['propinsi']) ? $_POST['propinsi'] : NULL;
	$p_id_kabkot    = isset($_POST['kota']) ? $_POST['kota'] : NULL;
	$p_id_kec       = isset($_POST['kecamatan']) ? $_POST['kecamatan'] : NULL;
    $id_kel	        = isset($_GET['idkel']) ? $_GET['idkel'] : NULL;
    $id_pndk        = isset($_GET['idpndk']) ? $_GET['idpndk'] : NULL;
    $id_sert        = isset($_GET['idsert']) ? $_GET['idsert'] : NULL;
    $id_pelt        = isset($_GET['idpl']) ? $_GET['idpl'] : NULL;
    $id_peker       = isset($_GET['idpeker']) ? $_GET['idpeker'] : NULL;
    $id_ki          = isset($_GET['idki']) ? $_GET['idki'] : NULL;
	$passhash 		= password_hash($p_pass , PASSWORD_DEFAULT);
    $maxsize        = 2097152;
    $nama_file      = $_FILES['file']['name'];
    $size_file      = $_FILES['file']['size'];
    $type_file      = $_FILES['file']['type'];
    //============================
    //===================

    //===================
    if ($tb_act == "UPDATE") {
        $display ="#edit-settings";
        if(($_FILES['file']['size'] >= $maxsize))
        {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong> upload erors<br/></div>";
         }
        if (($_FILES['file']['size'] == 0) ){

            if ($p_pass != "") {
                $u_pass = mysqli_query($mysqli,"UPDATE tbl_user SET pass ='$passhash' WHERE nip ='$nip'");
                 if ($u_pass) {
                echo "<div class='alert alert alert-info'><button type='button' class='close' data-dismiss='alert'><i class='id=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data password anda Berhasil di simpan<br/></div>";
                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF ! </strong>" .mysqli_error($mysqli)."<br/></div>";
                    }

            }else {
                 $q_edit_profil = mysqli_query($mysqli,"UPDATE pegawai SET
                                nama = '$p_nama',
                                alamat = '$p_alamat',
                                tmpt_lahir = '$p_ttl',
                                jenis_kelamin='$p_jk',
                                tgl_lahir= '$p_tgl_lahir',
                                nohp = '$p_nohp',
                                g_dpn= '$p_gdpn',
                                g_blkng='$p_gblkng',
                                alamat_s = '$p_alamats',
                                nofax='$p_nofax',
                                id_agm = '$p_id_agm',
                                kdstatusk='$p_kdstatusk',
                                id_prov='$p_id_prov',
                                id_kabkot='$p_id_kabkot',
                                id_kec='$p_id_kec'
                                WHERE nip = '$nip'");

            mysqli_query($mysqli,"UPDATE tbl_user SET
            username='$p_user',
            email='$p_email',
            aboutme='$p_about',
            facebook='$p_fb',
            twitter='$p_twitter',
            googleplus='$p_googleplus',
            web='$p_web'
            WHERE nip ='$nip'");


            if ($q_edit_profil) {
                echo "<div class='alert alert alert-info'><button type='button' class='close' data-dismiss='alert'><i class='id=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Profil anda Berhasil di simpan<br/></div>";
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF ! </strong>" .mysqli_error($mysqli)."<br/></div>";
            }
            }


           
        }    else {
            $uploaddir = 'examples/';
            $alamatfile = $uploaddir . $nama_file;
            move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile);
            if ($p_pass != "") {
                $u_pass = mysqli_query($mysqli,"UPDATE tbl_user SET pass ='$passhash' WHERE nip ='$nip'");
                if ($u_pass) {
                echo "<div class='alert alert alert-info'><button type='button' class='close' data-dismiss='alert'><i class='id=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> password anda Berhasil di simpan<br/></div>";
                } else {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF ! </strong>" .mysqli_error($mysqli)."<br/></div>";
                }

            }else {
                $q_edit_profil  = mysqli_query($mysqli,"UPDATE pegawai SET
                                nama = '$p_nama',
                                alamat = '$p_alamat',
                                tmpt_lahir = '$p_ttl',
                                jenis_kelamin='$p_jk',
                                foto='$alamatfile',
                                tgl_lahir= '$p_tgl_lahir',
                                nohp = '$p_nohp',
                                g_dpn= '$p_gdpn',
                                g_blkng='$p_gblkng',
                                alamat_s = '$p_alamats',
                                nofax='$p_nofax',
                                id_agm = '$p_id_agm',
                                kdstatusk='$p_kdstatusk',
                                id_prov='$p_id_prov',
                                id_kabkot='$p_id_kabkot',
                                id_kec='$p_id_kec'
                                WHERE nip = '$nip'");

            mysqli_query($mysqli,"UPDATE tbl_user SET
            username='$p_user',
            email='$p_email',
            aboutme='$p_about',
            facebook='$p_fb',
            photo='$alamatfile',
            twitter='$p_twitter',
            googleplus='$p_googleplus',
            web='$p_web'
            WHERE nip ='$nip'");


            if ($q_edit_profil) {
                echo "<div class='alert alert alert-info'><button type='button' class='close' data-dismiss='alert'><i class='id=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Profil anda Berhasil di simpan<br/></div>";
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF ! </strong>" .mysqli_error($mysqli)."<br/></div>";
            }
            }

            




        }


        }

    if ($mod =="delk") {
        $q_delete_kel = mysqli_query($mysqli,"DELETE FROM keluarga WHERE id_k='$id_kel'");
        if ($q_delete_kel) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='?id=profil';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>".mysqli_error($mysqli)."<br/></div>";
        }
    }
    if ($mod =="delpndk") {
        $q_delete_pndk = mysqli_query($mysqli,"DELETE FROM pendidikan WHERE idp='$id_pndk'");
        if ($q_delete_pndk) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='?id=profil';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }

    }
    if ($mod =="delsert") {
        $q_delete_sert = mysqli_query($mysqli,"DELETE FROM sertifikat2 WHERE idsertifikat='$id_sert'");
        if ($q_delete_sert) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='?id=profil';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }

    }
    if ($mod =="delpel") {
        $q_delete_pelt = mysqli_query($mysqli,"DELETE FROM pelatihan WHERE id_pelatihan='$id_pelt'");
        if ($q_delete_pelt) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='?id=profil';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }

    }
    if ($mod =="delpeker") {
        $q_delete_pek = mysqli_query($mysqli,"DELETE FROM pengalaman_kerja WHERE id_peker='$id_peker'");
        if ($q_delete_pek) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='?id=profil';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }

    }
    if ($mod =="delki") {
        $q_delete_ki = mysqli_query($mysqli,"DELETE FROM karya_ilmiah WHERE id_ki='$id_ki'");
        if ($q_delete_ki) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='?id=profil';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }

    }


    ?>



	<div class="pull-right">
		<span class="green middle bolder">Choose profile: &nbsp;</span>

		<div class="btn-toolbar inline middle no-margin">
			<div data-toggle="buttons" class="btn-group no-margin">
				<label class="btn btn-sm btn-yellow active">
					<span class="bigger-110">Profile</span>

					<input type="radio" value="1" />
				</label>

				<label class="btn btn-sm btn-yellow">
					<span class="bigger-110">Edit Profile</span>

					<input type="radio" value="2" />
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
pegawai.nodplk,pegawai.nojw FROM pegawai
left join tbl_user on tbl_user.nip=pegawai.nip
left join jabatan on  pegawai.id_jab=jabatan.kode 
left join tbl_agama on pegawai.id_agm=tbl_agama.id_agm 
left join tbl_statusk on pegawai.kdstatusk=tbl_statusk.kdstatusk 
left join tbl_bank on pegawai.id_bank=tbl_bank.id_bank 
left join prov on pegawai.id_prov=prov.id_prov 
left join kabkot on pegawai.id_kabkot=kabkot.id_kabkot 
left join kec on pegawai.id_kec=kec.id_kec
where pegawai.id=$iduser");
            $j_data 	= mysqli_num_rows($data);
                if ($j_data == 0){
                    echo "<div class='alert alert-danger'>Pegawai Belum Melakukan Registrasi / data belum lengkap</div>";
                }
                else {
                    $b = mysqli_fetch_array($data);
                    $masakerja=MasaKerja($b['tgl_masuk'],$tahunM,$bulanM,$tanggalM);
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
                        echo "<a href='".$b['facebook']."' class='tooltip-info' title='' >";
                        echo "<i class='middle ace-icon fa fa-facebook-square fa-2x blue'></i>";
                        echo "</a>";
                        echo "<a href='".$b['twitter']."' class='tooltip-info' title='' ";
                        echo "<i class='middle ace-icon fa fa-twitter-square fa-2x light-blue'></i>";
                        echo "</a>";
                        echo "<a href='".$b['googleplus']."' class='tooltip-info' title='' >";
                        echo "<i class='middle ace-icon fa fa-google-plus fa-2x red'></i>";
                        echo "</a>";
						echo "<a href='cetak/cetakprofile.php?id_n=".$b['id']."' target='_blank'  >";
                        echo "<i class='middle ace-icon fa fa-print fa-2x red'></i>";
                        echo "</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";



						echo "<div></div>";
                        echo "<div class='col-xs-12 col-sm-9'>";
                        echo "<div class='center'>";
                        echo "<span class='btn btn-light no-hover'>";
                        echo "<span class='line-height-1 bigger-200 blue'>Profile Pegawai
						 
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
                        echo "<span class='editable' id='tgldaftar'>".($b['jenis_kelamin'] =="L" ? "Laki-laki" : "Perempuan")."</span>";
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
					    echo "<span>".$masakerja['masa_kerja']."</span>";
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
                        echo "Riwayat Jabatan Fungsional";
                        echo "</h4>";
                        echo "</div>";
                        echo "<div class='widget-body'>";
                        echo "<div class='widget-main'>";
                        echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th>
                        <th>Jabatan Fungsional</th><th>Tanggal TMT SK</th><th>No SK</th></tr>";

                        $q_jbf	        = mysqli_query($mysqli,"select * from h_jbfungsi,jb_fungsi where h_jbfungsi.kd_jbfungsi=jb_fungsi.kd_jbfungsi and id='$iduser'") or die (mysqli_error($mysqli));
                        $j_datajbf 	    = mysqli_num_rows($q_jbf);

                        if ($j_datajbf == 0) {
                            echo "<tr><td colspan='4'>-- Tidak Ada Data --</td></tr>";
                        } else {
                            $no = 1;
                            while ($a_jbf = mysqli_fetch_array($q_jbf)) {
                                echo "<tr>
                        <td>$no</td>
				        <td>$a_jbf[6]</td>
				        <td>$a_jbf[2]</td>
				        <td>$a_jbf[3]</td>

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
                        $q_pen 	    = mysqli_query($mysqli,"SELECT * FROM penugasan where id=$iduser ORDER BY idpng ASC") or die (mysqli_error($mysqli));
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


                        echo "</div>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='widget-header widget-header-small'>";
                        echo "<h4 class='widget-title smaller'>";
                        echo "<i class='ace-icon fa fa-check-square-o bigger-110'></i>	";
                        echo "Riwayat Jabatan Stuktural";
                        echo "</h4>";
                        echo "</div>";
                        echo "<div class='widget-body'>";
                        echo "<div class='widget-main'>";
                        echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th>
                        <th>Jabatan Struktural</th><th>Tanggal TMT SK</th><th>No SK</th></tr>";

                        $q_jbs	        = mysqli_query($mysqli,"select * from h_jbstruk,jb_struk where h_jbstruk.kd_jbstruk=jb_struk.kd_jbstruk and id='$iduser'") or die (mysqli_error($mysqli));
                        $j_datajbs 	    = mysqli_num_rows($q_jbs);

                        if ($j_datajbs == 0) {
                            echo "<tr><td colspan='4'>-- Tidak Ada Data --</td></tr>";
                        } else {
                            $no = 1;
                            while ($a_jbs = mysqli_fetch_array($q_jbs)) {
                                echo "<tr>
				        <td>$no</td>
				        <td>$a_jbs[6]</td>
				        <td>$a_jbs[2]</td>
				        <td>$a_jbs[3]</td>
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
                        echo "Keluarga";
                        echo "</h4>";
                        echo "</div>";
                        echo "<div class='widget-body'>";
                        echo "<div class='widget-main'>";
                        echo "<a  href='?id=keluarga&mod=add&id_d=$iduser' class='btn btn-primary btn-sm'>
						 <i class='ace-icon fa fa-pencil-square-o'></i>
							Tambah
						<span class='badge badge-warning badge-right'></span></a>";
                        echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Nama</th><th>Hubungan</th><th>Pekerjaan</th><th>Tempat Lahir</th><th>Tanggal Lahir</th><th>Action</th></tr>";
                        $q_klg 	= mysqli_query($mysqli,"SELECT * FROM keluarga where id=$iduser ORDER BY id_k ASC") or die (mysqli_error($mysqli));
                        $j_data 	= mysqli_num_rows($q_klg);

                        if ($j_data == 0) {
                            echo "<tr><td colspan='7'>-- Tidak Ada Data --</td></tr>";
                        } else {
                            $no=1;
                            while ($a_klg = mysqli_fetch_array($q_klg)) {
                                echo "<tr><td>$no</td>
                                        <td>$a_klg[nm_k]</td>
                                        <td>$a_klg[ket]</td>
                                        <td>$a_klg[pekerjaan]</td>
                                        <td>$a_klg[tempat_lahir]</td>
                                        <td>$a_klg[tgl_lahirk]</td>
                                       	<td><a href='?id=keluarga&mod=edit&idkel=$a_klg[id_k]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					                    <a href='?id=profil&mod=delk&idkel=$a_klg[id_k]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
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
						echo "<a  href='?id=pendidikan&mod=add&id_d=$iduser' class='btn btn-primary btn-sm'>
						 <i class='ace-icon fa fa-pencil-square-o'></i>
							Tambah
						<span class='badge badge-warning badge-right'></span></a>";
						echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Jenjang</th><th>Asal Sekolah</th><th>Kota</th><th>Jurusan</th><th>Tahun Lulus</th><th>No Ijazah</th><th>File</th><th>Action</th></tr>";
						$q_pend   = mysqli_query($mysqli,"SELECT a.*,b.nmpndidik FROM pendidikan a
                            left join tbl_pendidikan b on a.kdpndidik=b.kdpndidik
                         where a.id=$id_user ORDER BY a.idp ASC") or die (mysqli_error($mysqli));
                        $j_data     = mysqli_num_rows($q_pend);

						if ($j_data == 0) {
						echo "<tr><td colspan='9'>-- Tidak Ada Data --</td></tr>";
						} else {
						$no=1;
						while ($a_pndk = mysqli_fetch_array($q_pend)) {
						echo "<tr><td>$no</td>
                              <td>$a_pndk[12]</td>
                              <td>$a_pndk[5]</td>
                              <td>$a_pndk[6]</td>
                              <td>$a_pndk[7]</td>
                              <td>$a_pndk[1]</td>
                              <td>$a_pndk[8]</td>
                              <td><a href='$a_pndk[11]'>Download</a></td>
                             <td><a href='?id=pendidikan&mod=edit&idpndk=$a_pndk[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					        <a href='?id=profil&mod=delpndk&idpndk=$a_pndk[0]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>

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
                        echo "<a  href='?id=keahlian&mod=add&id_d=$iduser' class='btn btn-primary btn-sm'>
						 <i class='ace-icon fa fa-pencil-square-o'></i>
							Tambah
						<span class='badge badge-warning badge-right'></span></a>";
                        echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal Mulai</th><th>Tanggal Akhir</th><th>Sertifikat</th><th>No Sertifikat</th><th>File</th><th>Action</th></tr>";
                        $q_sert 	= mysqli_query($mysqli,"SELECT * FROM sertifikat2 where id=$iduser ORDER BY idsertifikat ASC") or die (mysqli_error($mysqli));
                        $j_data 	= mysqli_num_rows($q_sert);

                        if ($j_data == 0) {
                            echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
                        } else {
                            $no=1;
                            while ($a_sert = mysqli_fetch_array($q_sert)) {
                                echo "<tr><td>$no</td>
                                        <td>$a_sert[1]</td>
                                        <td>$a_sert[2]</td>
                                        <td>$a_sert[3]</td>
                                        <td>$a_sert[4]</td>
                                        <td><a href='$a_sert[6]'>Download</a></td>
                                        <td><a href='?id=keahlian&mod=edit&idsert=$a_sert[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					        <a href='?id=profil&mod=delsert&idsert=$a_sert[0]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>

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
                        echo "<a  href='?id=pelatihan&mod=add&id_d=$iduser' class='btn btn-primary btn-sm'>
						 <i class='ace-icon fa fa-pencil-square-o'></i>
							Tambah
						<span class='badge badge-warning badge-right'></span></a>";
                echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal Mulai</th><th>Nama Pelatihan</th><th>Tempat</th><th>Jumlah Jam / Hari</th><th>Peyelengara</th><th>Action</th></tr>";
                $q_pel 	    = mysqli_query($mysqli,"SELECT * FROM pelatihan where id=$iduser ORDER BY id_pelatihan ASC") or die (mysqli_error($mysqli));
                $j_data 	= mysqli_num_rows($q_pel);

                if ($j_data == 0) {
                    echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
                } else {
                    $no=1;
                    while ($a_pel = mysqli_fetch_array($q_pel)) {
                        echo "<tr><td>$no</td>
                                <td>$a_pel[tgl_pelatihan]</td>
                                <td>$a_pel[topik_pelatihan]</td>
                                <td>$a_pel[tempat]</td>
                                <td>$a_pel[jam]</td>
                                <td>$a_pel[penyelenggara]</td>
                             <td><a href='?id=pelatihan&mod=edit&idpl=$a_pel[id_pelatihan]'><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					        <a href='?id=profil&mod=delpel&idpl=$a_pel[id_pelatihan]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>

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
                        echo "<a  href='?id=pengalaman&mod=add&id_d=$iduser' class='btn btn-primary btn-sm'>
						 <i class='ace-icon fa fa-pencil-square-o'></i>
							Tambah
						<span class='badge badge-warning badge-right'></span></a>";
                echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal Mulai</th><th>Tanggal Akhir</th><th>Organisasi/Perusahaan</th><th>Jabatan</th><th>Keterangan</th><th>File</th><th>Action</th></tr>";
                $q_pek 	    = mysqli_query($mysqli,"SELECT * FROM pengalaman_kerja where id=$iduser ORDER BY id_peker ASC") or die (mysqli_error($mysqli));
                $j_data 	= mysqli_num_rows($q_pek);

                if ($j_data == 0) {
                    echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
                } else {
                    $no=1;
                    while ($a_pek = mysqli_fetch_array($q_pek)) {
                        echo "<tr><td>$no</td>
                            <td>$a_pek[tgl_awal]</td>
                            <td>$a_pek[tgl_akhir]</td>
                            <td>$a_pek[pt]</td>
                            <td>$a_pek[nm_pekerjaan]</td>
                            <td>$a_pek[d_pekerjaan]</td>
							<td><a href='$a_pek[file]'>Download</a></td>
                            <td><a href='?id=pengalaman&mod=edit&id_peker=$a_pek[id_peker]'><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					        <a href='?id=profil&mod=delpeker&idpeker=$a_pek[id_peker]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>

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
                echo "Karya Ilmiah";
                echo "</h4>";
                echo "</div>";
                echo "<div class='widget-body'>";
                echo "<div class='widget-main'>";
                        echo "<a  href='?id=karyailmiah&mod=add&id_d=$iduser' class='btn btn-primary btn-sm'>
						 <i class='ace-icon fa fa-pencil-square-o'></i>
							Tambah
						<span class='badge badge-warning badge-right'></span></a>";
                echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal</th><th>Judul</th><th>Tempat</th><th>Sifat Karya Ilmiah</th><th>Lingkup Kegiatan</th><th>Referensi</th><th>Action</th></tr>";
                $q_ki 	    = mysqli_query($mysqli,"SELECT * FROM karya_ilmiah where id=$iduser ORDER BY id_ki ASC") or die (mysqli_error($mysqli));
                $j_data 	= mysqli_num_rows($q_ki);

                if ($j_data == 0) {
                    echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
                } else {
                    $no=1;
                    while ($a_ki = mysqli_fetch_array($q_ki)) {
                        echo "<tr><td>$no</td><td>$a_ki[tgl]</td><td>$a_ki[judul]</td>
                        <td>$a_ki[tempat]</td>
                        <td>$a_ki[sifat_karyailmiah]</td>
                        <td>$a_ki[lingkup_kegiatan]</td>
                        <td>$a_ki[referensi]</td>
                        <td><a href='?id=karyailmiah&mod=edit&id_ki=$a_ki[id_ki]'><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					     <a href='?id=profil&mod=delki&idki=$a_ki[id_ki]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>

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

<div class="space-6"></div>





<div class="hide">
<div id="user-profile-2" class="user-profile row">
<div class="col-sm-offset-1 col-sm-10">

<?php
$data2 = mysqli_query($mysqli,"SELECT a.*,b.*,c.n_jab FROM pegawai a
left join tbl_user b on a.nip=b.nip 
left join jabatan c on a.id_jab=c.kode 
where a.id=$iduser");
$c = mysqli_fetch_array($data2);

?>

<form class="form-horizontal" name="form" id="valid-profil" method="post" action="" enctype="multipart/form-data">
<div class="tabbable">
<ul class="nav nav-tabs padding-16">
	<li class="active">
		<a data-toggle="tab" href="#edit-basic">
			<i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
			Basic Info
		</a>
	</li>

	<li>
		<a data-toggle="tab" href="#edit-settings">
			<i class="purple ace-icon fa fa-cog bigger-125"></i>
			Upload Foto
		</a>
	</li>

	<li>
		<a data-toggle="tab" href="#edit-password">
			<i class="blue ace-icon fa fa-key bigger-125"></i>
			Password
		</a>
	</li>
</ul>

<div class="tab-content profile-edit-tab-content">
<div id="edit-basic" class="tab-pane in active">
	<h4 class="header blue bolder smaller">General <?php echo $iduser;?></h4>

	<div class="row">

        <div class="vspace-12-sm"></div>

		<div class="col-xs-12 col-sm-8">
		
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="form-field-username">NIP</label>

				<div class="col-sm-8">
					<input class="col-xs-12 col-sm-5" type="text" id="form-field-username" readonly="true" placeholder="Nomor Induk Pegawai" name="nip" value="<?php echo $c['nip'];?>" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="form-field-username">Username</label>

				<div class="col-sm-8">
					<input class="col-xs-12 col-sm-10" type="text" id="form-field-username" placeholder="Username" name="username" value="<?php echo $c[username];?>" />
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="form-field-first">Nama</label>

				<div class="col-sm-8">
                    <input class="col-xs-12 col-sm-5" type="text" id="form-field-first" placeholder="Gelar Depan" name="g_dpn" value="<?php echo $c['g_dpn'];?>" />
					<input class="col-xs-12 col-sm-10" type="text" id="form-field-first" placeholder="Nama Lengkap" name="nama" value="<?php echo $c['nama'];?>" />
                    <input class="col-xs-12 col-sm-5" type="text" id="form-field-first" placeholder="Gelar Belakang" name="g_blkng" value="<?php echo $c['g_blkng'];?>" />
				</div>
			</div>
		</div>
	</div>

	<hr />


    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-first">Tempat Lahir</label>

        <div class="col-sm-9">
            <input class="col-xs-7 col-sm-5" type="text" id="ttl" placeholder="ttl" name="ttl" value="<?php echo $c['tmpt_lahir'];?>" />
        </div>
    </div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-date">Tanggal Lahir</label>

		<div class="col-sm-9">
			<div class="input-medium">
				<div class="input-group">
					<input class="input-medium date-picker" id="tgl_lahir" type="text" data-date-format="yyyy-mm-dd" name="tgl_lahir" placeholder="yyyy-mm-dd" value="<?php echo $c['tgl_lahir'];?>" />
																			<span class="input-group-addon">
																				<i class="ace-icon fa fa-calendar"></i>
																			</span>
				</div>
			</div>
		</div>
	</div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-date">Tanggal masuk</label>

        <div class="col-sm-9">
            <div class="input-medium">
                <div class="input-group">
                    <input class="input-medium date-picker" id="tgl_masuk" type="text"  data-date-format="yyyy-mm-dd" name="tgl_masuk" placeholder="yyyy-mm-dd" value="<?php echo $c['tgl_masuk'];?>" readonly/>
																			<span class="input-group-addon">
																				<i class="ace-icon fa fa-calendar"></i>
																			</span>
                </div>
            </div>
        </div>
    </div>

	<div class="space-4"></div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Jenis Kelamin</label>

		<div class="col-sm-9">
			<label class="inline">
				<input name="jk" type="radio" value="L" id="jk" class="ace" <?php echo $c['jenis_kelamin'] =='L' ? ' checked="checked"' : '';?> />
				<span class="lbl middle"> Laki-laki</span>
			</label>

			&nbsp; &nbsp; &nbsp;
			<label class="inline">
				<input name="jk" type="radio" value="P" id="jk" class="ace" <?php echo $c['jenis_kelamin'] =='P' ? ' checked="checked"' : '';?> />
				<span class="lbl middle"> Perempuan</span>
			</label>
		</div>
	</div>

	<div class="space-4"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-comment">Alamat Rumah Tetap</label>

        <div class="col-xs-20 col-sm-9">
            <textarea type="text" id="alamat" maxlength="200" name="alamat"><?php echo $c['alamat'];?></textarea>
			
			<select name="propinsi" id="propinsi">
											<option>--Pilih Provinsi--</option>
											<?php
											
											$propinsi = mysqli_query($mysqli,"SELECT * FROM prov ORDER BY nama_prov");
											while($p=mysqli_fetch_array($propinsi))
											if ($p['id_prov'] ==$c['id_prov'])  {
											echo "<option value=\"$p[id_prov]\" selected>$p[nama_prov]</option>\n";
											} else {
												echo "<option value=\"$p[id_prov]\">$p[nama_prov]</option>\n";
												
											}
											?>
										</select>
										<select name="kota" id="kota">
											<option>--Pilih Kabupaten/Kota--</option>
											<?php
												
											$kota = mysqli_query($mysqli,"SELECT * FROM kabkot where id_prov=".$c['id_prov']." ORDER BY nama_kabkot");
											while($p=mysqli_fetch_array($kota))
											
											if ($p['id_kabkot']==$c['id_kabkot']) {
											echo "<option value=\"$p[id_kabkot]\" selected>$p[nama_kabkot]</option>\n";
											} else{
												echo "<option value=\"$p[id_kabkot]\" >$p[nama_kabkot]</option>\n";
											}
											?>
											</select>
										
										
										 <select name="kecamatan" id="kecamatan">
											<option>--Pilih Kecamatan--</option>
											<?php
												
											$kec = mysqli_query($mysqli,"SELECT * FROM kec where id_prov=".$c['id_prov']." and id_kabkot=".$c['id_kabkot']." ORDER BY nama_kec");
											while($p=mysqli_fetch_array($kec))
											
											if ($p['id_kec']==$c['id_kec']) {
											echo "<option value=\"$p[id_kec]\" selected>$p[nama_kec]</option>\n";
											} else{
												echo "<option value=\"$p[id_kec]\" >$p[nama_kec]</option>\n";
											}
											?>
											</select>
			
			
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-comment">Alamat Rumah Sementara </label>

        <div class="col-xs-20 col-sm-9">
            <textarea type="text" id="alamat_s" maxlength="200" name="alamat_s"><?php echo $c['alamat_s'];?></textarea>
        </div>
    </div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-comment">Tentang Saya</label>

		<div class="col-sm-9">
            <textarea type="text" id="abouttea" maxlength="200" name="about"><?php echo $c['aboutme'];?></textarea>
		</div>
	</div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right ">Agama </label>
        <div class="col-sm-9">
            <select name="id_agm" value="" id="id_agm">
                <option>-- Pilih Agama --</option>
                <?php
                $q = mysqli_query($mysqli,"select * from tbl_agama");

                while ($a = mysqli_fetch_array($q)){
                    if ($a['0'] ==$c['id_agm']) {
                        echo "<option value='$a[0]' selected>$a[1]</option>";
                    } else {
                        echo "<option value='$a[0]'>$a[1]</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="platform">Status Kawin</label>

        <div class="col-sm-9">

            <select name="kdstatusk"  value="" id="kdstatusk" required>
                <option>-- Status Kawin--</option>
                <?php
                $q = mysqli_query($mysqli,"select * from tbl_statusk");

                while ($a = mysqli_fetch_array($q)){
                    if ($a['0'] ==$c['kdstatusk']) {
                        echo "<option value='$a[0]' selected>$a[1]</option>";
                    } else {
                        echo "<option value='$a[0]'>$a[1]</option>";
                    }
                }
                ?>
            </select>

        </div>
    </div>


    <div class="space-4"></div>

	<h4 class="header blue bolder smaller">Contact</h4>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-email">Email</label>

		<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input type="email" id="email" name="email" value="<?php echo $c['email'];?>" />
																		<i class="ace-icon fa fa-envelope"></i>
																	</span>
		</div>
	</div>

	<div class="space-4"></div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-website">Website</label>

		<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input type="url" id="web" name="web" value="<?php echo $c['web'];?>" />
																		<i class="ace-icon fa fa-globe"></i>
																	</span>
		</div>
	</div>

	<div class="space-4"></div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-phone">Phone</label>

		<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input class="input-medium input-mask-phone" type="text" name="tlpn" id="tlpn" value="<?php echo $c['tlpn'];?>" />
																		<i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
																	</span>
		</div>
	</div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-first">Hp</label>

        <div class="col-sm-9">
            <input class="input-medium" type="text" name="nohp" id="nohp" placeholder="Handphone" value="<?php echo $c['nohp'];?>"/>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-first">No Fax</label>

        <div class="col-sm-9">
            <input class="input-medium" type="text" name="nofax" id="nofax" placeholder="NoFax" value="<?php echo $c['nofax'];?>"/>
        </div>
    </div>





	<div class="space"></div>
	<h4 class="header blue bolder smaller">Social</h4>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-facebook">Facebook</label>

		<div class="col-sm-9">
																	<span class="input-icon">
																		<input type="text" name="fb" value="<?php echo $c['facebook'];?>" id="fb" />
																		<i class="ace-icon fa fa-facebook blue"></i>
																	</span>
		</div>
	</div>

	<div class="space-4"></div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-twitter">Twitter</label>

		<div class="col-sm-9">
																	<span class="input-icon">
																		<input type="text" name="twitter" value="<?php echo $c['twitter'];?>" id="form-field-twitter" />
																		<i class="ace-icon fa fa-twitter light-blue"></i>
																	</span>
		</div>
	</div>

	<div class="space-4"></div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-gplus">Google+</label>

		<div class="col-sm-9">
																	<span class="input-icon">
																		<input type="text" name="googleplus" value="<?php echo $c['googleplus'];?>" id="form-field-gplus" />
																		<i class="ace-icon fa fa-google-plus red"></i>
																	</span>
		</div>
	</div>

</div>

<div id="edit-settings" class="tab-pane">
	<div class="space-10"></div>

    <div class="form-group" id="selectImage">
        <label class="col-sm-2 col-sm-2 control-label">Upload Photo</label>
        <div class="col-sm-10">
            <input type="file" name="file" id="file"/>

        </div>
    </div>




</div>

<div id="edit-password" class="tab-pane">
	<div class="space-10"></div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">New Password</label>

		<div class="col-sm-9">
			<input type="password" name="pass1" id="pass1" />
		</div>
	</div>

	<div class="space-4"></div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-pass2">Confirm Password</label>

		<div class="col-sm-9">
			<input type="password" name="pass2" id="pass2" />
		</div>
	</div>





</div>
</div>
</div>

<div class="clearfix form-actions">

    <tr><td></td><td><input class="width-35 pull-right btn btn-sm btn-primary" type="submit" name="tb_act" value="UPDATE"></td></tr>

</div>
</form>




</div><!-- /.span -->
</div><!-- /.user-profile -->
</div>

<?php
}else{
	  header('Location:../index.php?status=Silahkan Login');
}
?>	
