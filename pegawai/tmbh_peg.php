<?php
error_reporting(0); 		
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2' ) 

{

$id_user=$_SESSION['kode'];	

$nipmax=mysqli_fetch_array(mysqli_query($mysqli,"SELECT max(nip) FROM pegawai"));
$nomor_nip      =$nipmax[0];
$display 		= "style='display: none'";
$p_tgl_jab      = isset($_POST['tanggaljab']) ? $_POST['tanggaljab'] : "";
$mode_form	    = isset($_GET['mod']) ? $_GET['mod'] : "";
$id_daftar	    = isset($_GET['id_n']) ? $_GET['id_n'] : "";
$p_tombol	    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$p_id           = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : "";
$p_nip			= isset($_POST['nip']) ? $_POST['nip'] : "";
$p_nama 		= isset($_POST['nama']) ? strtoupper($_POST['nama']) : "";
$p_tmptlahir 	= isset($_POST['tmptlahir']) ? strtoupper($_POST['tmptlahir']) : "";
$p_tgl_lahir	= isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : "";	
$p_gender	    = isset($_POST['gender']) ? $_POST['gender'] : "";
$p_alamat	    = isset($_POST['alamat']) ? $_POST['alamat'] : "";
$p_datemasuk	= isset($_POST['datemasuk']) ? $_POST['datemasuk'] : "";
$p_datekontrak	= isset($_POST['datekontrak']) ? $_POST['datekontrak'] : "";
$p_bag	        = isset($_POST['bag']) ? $_POST['bag'] : "";
$p_jab	        = isset($_POST['jab']) ? $_POST['jab'] : "";
$p_tlpn	        = isset($_POST['tlpn']) ? $_POST['tlpn'] : "";
$p_hp	        = isset($_POST['hp']) ? $_POST['hp'] : "";
$p_noktp	    = isset($_POST['noktp']) ? $_POST['noktp'] : "";
$p_nonpwp	    = isset($_POST['nonpwp']) ? $_POST['nonpwp'] : "";
$p_id_bank	    = isset($_POST['id_bank']) ? $_POST['id_bank'] : "";
$p_norek	    = isset($_POST['norek']) ? $_POST['norek'] : "";
$p_id_agm	    = isset($_POST['id_agm']) ? $_POST['id_agm'] : "";
$p_kdpndidik	= isset($_POST['kdpndidik']) ? $_POST['kdpndidik'] : "";
$p_kdstatusk	= isset($_POST['kdstatusk']) ? $_POST['kdstatusk'] : "";
$p_kdstatusp	= isset($_POST['kdstatusp']) ? $_POST['kdstatusp'] : "";
$p_jnspeg	    = isset($_POST['id_jns']) ? $_POST['id_jns'] : "";
$p_kdkpkrn	    = isset($_POST['kdkpkrn']) ? $_POST['kdkpkrn'] : "";
$p_jbfungsi	    = isset($_POST['kd_jbfungsi']) ? $_POST['kd_jbfungsi'] : "";
$p_jbstruk	    = isset($_POST['kd_jbstruk']) ? $_POST['kd_jbstruk'] : "";
$p_kd_sub	    = isset($_POST['kd_sub']) ? $_POST['kd_sub'] : "";
$p_id_gol	    = isset($_POST['id_gol']) ? $_POST['id_gol'] : "";
$p_glrd	        = isset($_POST['glrd']) ? $_POST['glrd'] : "";
$p_glrb	        = isset($_POST['glrb']) ? $_POST['glrb'] : "";
$p_alamatrs	    = isset($_POST['alamatrs']) ? $_POST['alamatrs'] : "";
$p_email_k	    = isset($_POST['email_k']) ? $_POST['email_k'] : "";
$p_nojamsos	    = isset($_POST['nojamsos']) ? $_POST['nojamsos'] : "";
$p_nodplk	    = isset($_POST['nodplk']) ? $_POST['nodplk'] : "";
$p_nojiwa	    = isset($_POST['nojiwa']) ? $_POST['nojiwa'] : "";
$p_nofax	    = isset($_POST['fax']) ? $_POST['fax'] : "";
$p_nidn	    	= isset($_POST['nidn']) ? $_POST['nidn'] : "";
$p_stsk    		= isset($_POST['id_stsk']) ? $_POST['id_stsk'] : "";
$p_id_prov      = isset($_POST['propinsi']) ? $_POST['propinsi'] : NULL;
$p_id_kabkot    = isset($_POST['kota']) ? $_POST['kota'] : NULL;
$p_id_kec       = isset($_POST['kecamatan']) ? $_POST['kecamatan'] : NULL;

    $maxsize        = 2097152;
    $nama_file      = $_FILES['file']['name'];
    $size_file      = $_FILES['file']['size'];
    $type_file      = $_FILES['file']['type'];

$id_kel	        = isset($_GET['idkel']) ? $_GET['idkel'] : NULL;
$id_rj	        = isset($_GET['idrj']) ? $_GET['idrj'] : NULL;
$id_pl          = isset($_GET['idpl']) ? $_GET['idpl'] : NULL;
$id_pk          = isset($_GET['idpk']) ? $_GET['idpk'] : NULL;
$id_pndk        = isset($_GET['idpndk']) ? $_GET['idpndk'] : NULL;
$id_pg          = isset($_GET['idpg']) ? $_GET['idpg'] : NULL;
$id_gol         = isset($_GET['idgol']) ? $_GET['idgol'] : NULL;
$id_sert        = isset($_GET['idsert']) ? $_GET['idsert'] : NULL;
$id_pen         = isset($_GET['idpen']) ? $_GET['idpen'] : NULL;
$id_ki          = isset($_GET['idki']) ? $_GET['idki'] : NULL;
$idjbf         	= isset($_GET['idjbf']) ? $_GET['idjbf'] : NULL;
$idjbs         	= isset($_GET['idjbs']) ? $_GET['idjbs'] : NULL;
$idub           = isset($_GET['idub']) ? $_GET['idub'] : NULL;


    $p_submit		= "DAFTAR";

if ($mode_form == "add") {
$display        = "style='display: none'";
$p_foto	        = "logo/noname.jpg";
} else if ($mode_form == "edit") {
$display        = "";
$q_data_edit	= mysqli_query($mysqli,"SELECT * FROM pegawai WHERE id= '$id_daftar'");
$a_data_edit	= mysqli_fetch_array($q_data_edit);
$id_daftar		= $a_data_edit[0];
$p_nip			= $a_data_edit[1];	
$p_nama			= $a_data_edit[2];		
$p_tmptlahir 	= $a_data_edit[3];
$p_tgl_lahir 	= $a_data_edit[4]; 		
$p_gender 	    = $a_data_edit[5];
$p_alamat 	    = $a_data_edit[6];
$p_datemasuk	= $a_data_edit[7];	
$p_bag			= $a_data_edit[8];
$p_jab	        = $a_data_edit[9];
$p_foto	        = $a_data_edit[11];
$p_tlpn 		= $a_data_edit[12];	
$p_hp	        = $a_data_edit[13];
$p_nonpwp 	    = $a_data_edit[14];
$p_id_agm 		= $a_data_edit[15];	
$p_kdpndidik 	= $a_data_edit[16];		
$p_noktp 		= $a_data_edit[17];
$p_nojamsos	    = $a_data_edit[18];
$p_norek 	    = $a_data_edit[19];
$p_id_bank 	    = $a_data_edit[20];
$p_kdstatusk 	= $a_data_edit[21];		
$p_kdstatusp 	= $a_data_edit[22];
$p_tgl_jab 	    = $a_data_edit[23];
$p_jnspeg       = $a_data_edit[24];
$p_kdkpkrn	    = $a_data_edit[25];
$p_jbfungsi	    = $a_data_edit[26];
$p_jbstruk	    = $a_data_edit[27];
$p_kd_sub	    = $a_data_edit[28];
$p_id_gol	    = $a_data_edit[29];
$p_glrd	        = $a_data_edit[30];
$p_glrb	        = $a_data_edit[31];
$p_alamatrs	    = $a_data_edit[32];
$p_nofax        = $a_data_edit[33];
$p_email_k	    = $a_data_edit[34];
$p_nodplk	    = $a_data_edit[35];
$p_nojiwa	    = $a_data_edit[36];
$p_nidn	    	= $a_data_edit[37];
$p_stsk			= $a_data_edit[38];
$p_datekontrak	= $a_data_edit[39];
$p_id_prov	    = $a_data_edit[40];
$p_id_kabkot	= $a_data_edit[41];
$p_id_kec		= $a_data_edit[42];

    $readonly	= "readonly";
    $true	    = "disabled='true'";
    $p_submit	= "EDIT";

}else {
    $p_foto	        = "logo/noname.jpg";
}
if ($p_tombol == "DAFTAR") {
	if ($p_nama == "" ||$p_nip == ""||$p_tmptlahir == ""||$p_tgl_lahir == "" ||$p_alamat == ""|| $p_datemasuk == ""
	||$p_bag == ""|| $p_kdpndidik == ""|| $p_kdstatusk == ""|| $p_kdstatusp == ""
	
	) {
		
		echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Form Isian Masih Belum lengkap mohon di lengkapi, <a href='?id=tambahpeg'>Kembali</a><br/></div>";
	} else {
			$q_cek_ganda = mysqli_query($mysqli,"SELECT * FROM pegawai WHERE nip = '$p_nip'");
			$j_cek_ganda = mysqli_fetch_array($q_cek_ganda);
			
			if ($j_cek_ganda > 0) {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> NIP Pegawai Sudah Terdaftar, <a href='?id=tambahpeg'>Kembali</a><br/></div>";
			}else{
				 if(($_FILES['file']['size'] >= $maxsize))
            {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong> File foto tidak boleh melebihi 2Mb <br/></div>";
            }
            else {
                if (($_FILES['file']['size'] == 0) ){
                    $q_daftar	= mysqli_query($mysqli,"INSERT INTO pegawai VALUES ('','$p_nip','$p_nama','$p_tmptlahir','$p_tgl_lahir',
					'$p_gender','$p_alamat','$p_datemasuk','$p_bag','$p_jab','5','assets/avatars/avatar5.png','$p_tlpn','$p_hp',
					'$p_nonpwp','$p_id_agm','$p_kdpndidik','$p_noktp','$p_nojamsos','$p_norek','$p_id_bank','$p_kdstatusk','$p_kdstatusp',
					'$p_tgl_jab','$p_jnspeg','$p_kdkpkrn','$p_jbfungsi','$p_jbstruk','$p_kd_sub','$p_id_gol','$p_glrd','$p_glrb','$p_alamatrs',
					 '$p_nofax ','$p_email_k','$p_nodplk','$p_nojiwa','$p_nidn','$p_stsk','$p_datekontrak','$p_id_prov','$p_id_kabkot','$p_id_kec',NOW())");

                    if ($q_daftar > 0) {
                        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pegawai Berhasil di simpan, selanjutnya update data lengkap <a href='?id=data_pegawai'>DISINI</a><br/></div>";

                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>".mysqli_error($mysqli)."<br/></div>";
                    }
                } else {
                    $uploaddir = 'examples/';
                    $alamatfile = $uploaddir . $nama_file;
                    move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile);
                    $q_daftar	= mysqli_query($mysqli,"INSERT INTO pegawai VALUES ('','$p_nip','$p_nama','$p_tmptlahir','$p_tgl_lahir',
					'$p_gender','$p_alamat','$p_datemasuk','$p_bag','$p_jab','5','$alamatfile','$p_tlpn','$p_hp',
					'$p_nonpwp','$p_id_agm','$p_kdpndidik','$p_noktp','$p_nojamsos','$p_norek','$p_id_bank','$p_kdstatusk','$p_kdstatusp',
					'$p_tgl_jab','$p_jnspeg','$p_kdkpkrn','$p_jbfungsi','$p_jbstruk','$p_kd_sub','$p_id_gol','$p_glrd','$p_glrb	','$p_alamatrs',
					 '$p_nofax ','$p_email_k','$p_nodplk','$p_nojiwa','$p_nidn','$p_stsk','$p_datekontrak','$p_id_prov','$p_id_kabkot','$p_id_kec',NOW())");

                    if ($q_daftar > 0) {
                        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pegawai Berhasil di simpan, selanjutnya update data lengkap <a href='?id=data_pegawai'>DISINI</a><br/></div>";

                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>".mysqli_error($mysqli)."<br/></div>";
                    }


                }

			}
				
			}
           
		}
			
} else if ($p_tombol == "EDIT") {
	if ($p_nama == "" ||$p_nip == ""||$p_tmptlahir == ""||$p_tgl_lahir == "" ||$p_alamat == ""
	) {
		echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Form Isian Masih Belum lengkap mohon di lengkapi, <a href='?id=tambahpeg'>Kembali</a><br/></div>";
	}else {
		
		if(($_FILES['file']['size'] >= $maxsize))
			{
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong> File foto tidak boleh melebihi 2Mb <br/></div>";
			} else {
				
            if (($_FILES['file']['size'] == 0) ) {
                $q_edit = mysqli_query($mysqli, "UPDATE pegawai SET nip='$p_nip', nama='$p_nama',tmpt_lahir='$p_tmptlahir',tgl_lahir='$p_tgl_lahir',
									jenis_kelamin='$p_gender',alamat='$p_alamat',tgl_masuk='$p_datemasuk',id_bag='$p_bag',
									tlpn='$p_tlpn',nohp='$p_hp',npwp='$p_nonpwp',id_agm='$p_id_agm',kdpndidik='$p_kdpndidik',noktp='$p_noktp',
									norek='$p_norek',id_bank='$p_id_bank',kdstatusk='$p_kdstatusk',kdstatusp='$p_kdstatusp',
									tgl_jab='$p_tgl_jab',idjns='$p_jnspeg ',nmkepakaran='$p_kdkpkrn',kd_sub='$p_kd_sub',
                                    g_dpn='$p_glrd',g_blkng='$p_glrb',alamat_s='$p_alamatrs',nofax='$p_nofax',email_k='$p_email_k',nodplk='$p_nodplk',nojw='$p_nojiwa',nidn='$p_nidn',id_stsk='$p_stsk',tgl_kontrak='$p_datekontrak',
									id_prov='$p_id_prov',id_kabkot='$p_id_kabkot',id_kec='$p_id_kec',
									time_update=NOW() where id='$p_id'");
                mysqli_query($mysqli, "UPDATE tbl_user SET nip='$p_nip' WHERE id='$p_id'");


                if ($q_edit > 0) {
                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pegawai Berhasil di Ubah, kembali ke data lengkap <script>document.location.href='javascript:history.back(-1)';</script><br/></div>";
                } else {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>".mysqli_error($mysqli)."<br/></div>";
                }

            } else {
                $uploaddir = 'examples/';
                $alamatfile = $uploaddir . $nama_file;
                move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile);
                $q_edit = mysqli_query($mysqli, "UPDATE pegawai SET nip='$p_nip', nama='$p_nama',tmpt_lahir='$p_tmptlahir',tgl_lahir='$p_tgl_lahir',
									jenis_kelamin='$p_gender',alamat='$p_alamat',tgl_masuk='$p_datemasuk',id_bag='$p_bag',
									tlpn='$p_tlpn',nohp='$p_hp',npwp='$p_nonpwp',id_agm='$p_id_agm',kdpndidik='$p_kdpndidik',noktp='$p_noktp',
									norek='$p_norek',id_bank='$p_id_bank',kdstatusk='$p_kdstatusk',kdstatusp='$p_kdstatusp',
									tgl_jab='$p_tgl_jab',idjns='$p_jnspeg ',nmkepakaran='$p_kdkpkrn',kd_sub='$p_kd_sub',
                                    g_dpn='$p_glrd',foto='$alamatfile',g_blkng='$p_glrb',alamat_s='$p_alamatrs',nofax='$p_nofax',email_k='$p_email_k',nodplk='$p_nodplk',nojw='$p_nojiwa',nidn='$p_nidn',id_stsk='$p_stsk',tgl_kontrak='$p_datekontrak',
									id_prov='$p_id_prov',id_kabkot='$p_id_kabkot',id_kec='$p_id_kec',
									time_update=NOW() where id='$p_id'");
                mysqli_query($mysqli, "UPDATE tbl_user SET nip='$p_nip',photo='$alamatfile' WHERE id='$p_id'");


                if ($q_edit > 0) {
                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pegawai Berhasil di Ubah, kembali ke data lengkap <script>document.location.href='javascript:history.back(-1)';</script><br/></div>";
                } else {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>".mysqli_error($mysqli)."<br/></div>";
                }

            }
         }
		
	}
		
		
		
     
    }
    else if ($mode_form =="delk") {
        $q_delete_kel = mysqli_query($mysqli,"DELETE FROM keluarga WHERE id_k='$id_kel'");
        if ($q_delete_kel) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='javascript:history.back(-1)';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>".mysqli_error($mysqli)."<br/></div>";
        }

    } else if ($mode_form =="delrj") {
        $q_delete_rj = mysqli_query($mysqli,"DELETE FROM h_jabatan WHERE idh='$id_rj'");
        if ($q_delete_rj) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='javascript:history.back(-1)';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }
    } else if ($mode_form =="delpl") {
    $q_delete_pl = mysqli_query($mysqli,"DELETE FROM pelatihan WHERE id_pelatihan='$id_pl'");
    if ($q_delete_pl) {
        echo "<script>alert('Berhasil');</script>";
        echo "<script>document.location.href='javascript:history.back(-1)';</script>";
    } else {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
    }

    } else if ($mode_form =="delpk") {
        $q_delete_pk = mysqli_query($mysqli,"DELETE FROM pengalaman_kerja WHERE id_peker='$id_pk'");
        if ($q_delete_pk) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='javascript:history.back(-1)';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }

    } else if ($mode_form =="delpndk") {
    $q_delete_pndk = mysqli_query($mysqli,"DELETE FROM pendidikan WHERE idp='$id_pndk'");
    if ($q_delete_pndk) {
        echo "<script>alert('Berhasil');</script>";
        echo "<script>document.location.href='javascript:history.back(-1)';</script>";
    } else {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
    }

    } else if ($mode_form =="delpg") {
        $q_delete_pg = mysqli_query($mysqli, "DELETE FROM penghargaan WHERE id_penghargaan='$id_pg'");
        if ($q_delete_pg) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='javascript:history.back(-1)';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
        }
    } else if ($mode_form =="delgol") {
        $q_delete_gol = mysqli_query($mysqli, "DELETE FROM golongan WHERE kdgol='$id_gol'");
        if ($q_delete_gol) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='javascript:history.back(-1)';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
        }
    }  else if ($mode_form =="delsert") {
        $q_delete_sert = mysqli_query($mysqli, "DELETE FROM sertifikat2 WHERE idsertifikat='$id_sert'");
        if ($q_delete_sert) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='javascript:history.back(-1)';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
        }
    }else if ($mode_form =="delpen") {
        $q_delete_pen = mysqli_query($mysqli, "DELETE FROM penugasan WHERE idpng='$id_pen'");
        if ($q_delete_pen) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='javascript:history.back(-1)';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
        }
    }else if ($mode_form =="delki") {
        $q_delete_ki = mysqli_query($mysqli, "DELETE FROM karya_ilmiah WHERE id_ki='$id_ki'");
        if ($q_delete_ki) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='javascript:history.back(-1)';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
        }
	}else if ($mode_form =="deljbf") {
        $q_delete_jbf = mysqli_query($mysqli, "DELETE FROM h_jbfungsi WHERE idjf='$idjbf'");
        if ($q_delete_jbf > 0) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='javascript:history.back(-1)';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
        }
    }else if ($mode_form =="deljbs") {
        $q_delete_jbs = mysqli_query($mysqli, "DELETE FROM h_jbstruk WHERE idjs='$idjbs'");
        if ($q_delete_jbs > 0) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='javascript:history.back(-1)';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
        }
    }else if ($mode_form =="delberkas") {
        $q_delete_berkas = mysqli_query($mysqli, "DELETE FROM tbl_upload_berkas WHERE idub='$idub'");
        if ($q_delete_berkas > 0) {
            echo "<script>alert('Berhasil');</script>";
            echo "<script>document.location.href='javascript:history.back(-1)';</script>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
        }
    }
?>



<div class="col-sm-12">
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
    <li class="active">
        <a data-toggle="tab" href="#input">
            <i class="green ace-icon  fa fa-pencil bigger-120"></i>
            <?php echo $p_submit; ?>
        </a>
    </li>

    <li>
        <a data-toggle="tab" href="#pf" <?php echo $display;?>>
            <i class="green ace-icon fa fa-bookmark bigger-120"></i>
            Riwayat Pendidikan

        </a>
    </li>

    <li>
        <a data-toggle="tab" href="#pk" <?php echo $display;?>>
            <i class="green ace-icon fa fa-bookmark-o bigger-120"></i>
            Pengalaman Kerja

        </a>
    </li>

    <li>
        <a data-toggle="tab" href="#pl" <?php echo $display;?>>
            <i class="green ace-icon  fa fa-eye bigger-120"></i>
            Pelatihan

        </a>
    </li>

    <li>
        <a data-toggle="tab" href="#rj" <?php echo $display;?>>
            <i class="green ace-icon fa fa-certificate  bigger-120"></i>
            R Jabatan

        </a>
    </li>

    <li>
        <a data-toggle="tab" href="#dk" <?php echo $display;?>>
            <i class="green ace-icon fa fa-users bigger-120"></i>
            Keluarga

        </a>
    </li>

    <li>
        <a data-toggle="tab" href="#pg" <?php echo $display;?>>
            <i class="green ace-icon fa fa-asterisk bigger-120"></i>
            Penghargaan

        </a>
    </li>

    <li>
        <a data-toggle="tab" href="#gol" <?php echo $display;?>>
            <i class="green ace-icon fa fa-globe bigger-120"></i>
            R Kepangkatan / Golongan

        </a>
    </li>

    <li>
        <a data-toggle="tab" href="#sert" <?php echo $display;?>>
            <i class="green ace-icon fa fa-circle-o bigger-120"></i>
            Sertifikat

        </a>
    </li>

    <li>
        <a data-toggle="tab" href="#pen" <?php echo $display;?>>
            <i class="green ace-icon fa fa-briefcase bigger-120"></i>
            Penugasan

        </a>
    </li>
    <li>
        <a data-toggle="tab" href="#ki" <?php echo $display;?>>
            <i class="green ace-icon fa fa-book bigger-120"></i>
           Karya Ilmiah

        </a>
    </li>

    <li>
        <a data-toggle="tab" href="#jabf" <?php echo $display;?>>
            <i class="green ace-icon fa fa-book bigger-120"></i>
            R Jabatan Fungsional

        </a>
    </li>

    <li>
        <a data-toggle="tab" href="#jabs" <?php echo $display;?>>
            <i class="green ace-icon fa fa-book bigger-120"></i>
            R Jabatan Struktural

        </a>
    </li>

    <li>
        <a data-toggle="tab" href="#berkas" <?php echo $display;?>>
            <i class="green ace-icon fa fa-file-o bigger-120"></i>
            Upload Berkas

        </a>
    </li>
</ul>

<div class="tab-content profile-edit-tab-content">
<div id="input" class="tab-pane fade in active">



<a  href="?id=tambahpeg&mod=add" class="btn btn-app btn-purple btn-xs">
    <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
    Tambah
    <span class="badge badge-warning badge-right"></span>
</a>

<a href="?id=tambahpeg" class="btn btn-app btn-success btn-xs">
    <i class="ace-icon fa fa-refresh bigger-160"></i>
    Refresh
</a>

<a  href="?id=data_pegawai" class="btn btn-app btn-purple btn-xs">
    <i class="ace-icon fa fa-users bigger-160"></i>
    Pegawai
    <span class="badge badge-warning badge-right"></span>
</a>


						<form class="form-horizontal" action="?id=tambahpeg" method="post"  id="tambahpegawai" role="form" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right">Foto :</label>
                            <div class="col-sm-9">
                                <div id="image_preview">
                                    <img id="previewing" src="<?php echo $p_foto; ?>" width="250" height="230"/></div>
                                <span id='loading'></span>
                                <div id="message"></div>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-3 control-label no-padding-right"></label>
                            <div class="col-sm-9">
                                <input type="file"  id="file" name="file"/>

                            </div>
                        </div>
							    <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="nip" >NIP :</label>

									<div class="col-sm-9">
                                        <input type="text" name="id_daftar" id="id_daftar" value="<?php echo $id_daftar; ?>" hidden>
										<input type="text" name="nipakhir" class="col-xs-10 col-sm-3" id="nipakhir" readonly="" id="form-input-readonly" data-rel="tooltip" title="Nip Terakhir" value="<?php echo $nomor_nip;?>" />
										<input type="text" name="nip" id="nip" class="col-xs-10 col-sm-3" data-rel="tooltip" title="NIP BARU" placeholder="NIP" value="<?php echo $p_nip;?>" required/>

                                    </div>
								
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="nama">NIDN:</label> 

									<div class="col-sm-9">
                                        <input type="text" name="nidn" id="nidn" class="col-xs-10 col-sm-5" placeholder="NIDN" value="<?php echo $p_nidn;?>" />
									
									</div>
					
								</div>
					
							
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="nama">Nama Lengkap:</label> 

									<div class="col-sm-9">
                                        <input type="text" name="glrd" id="glrb" class="col-xs-10 col-sm-2" placeholder="Gelar depan" value="<?php echo $p_glrd	;?>" />
										<input type="text" name="nama" id="nama" class="col-xs-10 col-sm-5" placeholder="Nama lengkap" value="<?php echo $p_nama;?>" required/>
                                        <input type="text" name="glrb" id="glrb" class="col-xs-10 col-sm-2" placeholder="Gelar Belakang" value="<?php echo $p_glrb	;?>" />
									</div>
					
								</div>
								
								<div class="form-group">
										
											<label class="col-sm-3 control-label no-padding-right">Jenis Kelamin :</label>

											<div class="col-sm-9">
												
											<label class="blue">
											<input name="gender" class="col-xs-10 col-sm-3" id="gender" value="L" <?=$p_gender =='L' ? ' checked="checked"' : '';?> type="radio" />
											<span class="lbl"> Laki-Laki</span>
											</label>

											<label class="blue">
											<input name="gender" class="col-xs-10 col-sm-2" id="gender" value="P" <?=$p_gender =='P' ? ' checked="checked"' : '';?> type="radio" />
											<span class="lbl"> Perempuan</span>
											</label>
											
											</div>		
								</div>

								
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="tmpt_lahir">Tempat Tgl Lahir:</label>

									<div class="col-xs-8 col-sm-5">
										
										<div class="input-group col-sm-8">
										<input type="text" class="form-control" name="tmptlahir" id="tmpt_lahir" value="<?php echo $p_tmptlahir;?>" placeholder="Tempat Lahir" />
										<input class="form-control date-picker " type="text" name="tgl_lahir" id="tgl_lahir"  value="<?php echo $p_tgl_lahir;?>" data-date-format="yyyy-mm-dd" required/>
										<input class="form-control " type="text" name="umur" id="umur" placeholder="Umur Pegawai" data-date-format="yyyy-mm-dd" required readonly="readonly">
										
											<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
											</span>
											</div>
										
										
									
									</div>
								
								</div>
								
								
					                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="alamat">Alamat:</label>
                                    <div class="col-xs-10 col-sm-9">
                                        <textarea name="alamat" placeholder="Mohon Isi Alamat dengan lengkap..." required><?php echo $p_alamat;?></textarea>
										<select name="propinsi" id="propinsi">
											<option>--Pilih Provinsi--</option>
											<?php
											
											$propinsi = mysqli_query($mysqli,"SELECT * FROM prov ORDER BY nama_prov");
											while($p=mysqli_fetch_array($propinsi))
											if ($p['id_prov'] ==$p_id_prov)  {
											echo "<option value=\"$p[id_prov]\" selected>$p[nama_prov]</option>\n";
											} else {
												echo "<option value=\"$p[id_prov]\">$p[nama_prov]</option>\n";
												
											}
											?>
										</select>
										<select name="kota" id="kota">
											<option>--Pilih Kabupaten/Kota--</option>
											<?php
												
											$kota = mysqli_query($mysqli,"SELECT * FROM kabkot where id_prov=".$p_id_prov." ORDER BY nama_kabkot");
											while($p=mysqli_fetch_array($kota))
											
											if ($p['id_kabkot']==$p_id_kabkot) {
											echo "<option value=\"$p[id_kabkot]\" selected>$p[nama_kabkot]</option>\n";
											} else{
												echo "<option value=\"$p[id_kabkot]\" >$p[nama_kabkot]</option>\n";
											}
											?>
											</select>
										
										
										 <select name="kecamatan" id="kecamatan">
											<option>--Pilih Kecamatan--</option>
											<?php
												
											$kec = mysqli_query($mysqli,"SELECT * FROM kec where id_prov=".$p_id_prov." and id_kabkot=".$p_id_kabkot." ORDER BY nama_kec");
											while($p=mysqli_fetch_array($kec))
											
											if ($p['id_kec']==$p_id_kec) {
											echo "<option value=\"$p[id_kec]\" selected>$p[nama_kec]</option>\n";
											} else{
												echo "<option value=\"$p[id_kec]\" >$p[nama_kec]</option>\n";
											}
											?>
											</select>
										
                                    </div>
                                    </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="alamat">Alamat Rumah Sementara:</label>
                                    <div class="col-xs-8 col-sm-9">
                                        <textarea name="alamatrs" placeholder="Mohon Isi Alamat dengan lengkap..." ><?php echo $p_alamatrs;?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="alamat">Email:</label>
                                    <div class="col-xs-8 col-sm-9">
                                        <input type="email" name="email_k" id="email_k" class="col-xs-10 col-sm-3" placeholder="Email Kantor" value="<?php echo $p_email_k;?>" />
                                    </div>
                                </div>
				
				
				<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="tlpn">Tlp.Rumah:</label> 

				<div class="col-xs-8 col-sm-9">
				<input type="text" name="tlpn" id="tlpn" class="col-xs-10 col-sm-2" placeholder="(021) 999-9999" value="<?php echo $p_tlpn;?>"/>
				<input class="col-xs-10 col-sm-2" value="<?php echo $p_hp;?>" type="text" name="hp" id="hp" placeholder="Isikan No Hp">
                    <input class="col-xs-10 col-sm-2" value="<?php echo $p_nofax;?>" type="text" name="fax" id="fax" placeholder="Isikan No Fax">

                </div>
				</div>
								<div class="form-group ">
									<label class="col-sm-3 control-label no-padding-right" for="noktp">KTP :</label> 

									<div class="col-sm-9">
										<input type="text" name="noktp" id="noktp" class="col-xs-10 col-sm-4" placeholder="Nomer Induk Kepegawaian" value="<?php echo $p_noktp;?>" required/>
									</div>
					
								</div>				
								
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="nonpwp">NPWP:</label> 

									<div class="col-sm-9">
										<input type="text" name="nonpwp" id="nonpwp" class="input-mask-npwp  col-xs-10 col-sm-4" placeholder="Nomer Pokok Wajib Pajak" value="<?php echo $p_nonpwp;?>"/>
									</div>
					
								</div>	

					
						
							<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right">Bagian :</label>
											<div class="col-sm-9">
											
											<select name="bag" value="">
												<option>-- Bagian --</option>
													<?php
												$q = mysqli_query($mysqli,"select * from bagian order by n_bag");

													while ($a = mysqli_fetch_array($q)){
													if ($a[1] ==$p_bag) {
														echo "<option value='$a[1]' selected>$a[2]</option>";
													} else {
													echo "<option value='$a[1]'>$a[2]</option>";
													}
														}
													?>
											</select>
											
											</div>
			
							</div>
						

						
						
							<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right">Bank Transfer & Asuransi :</label>
											<div class="col-sm-9">
											<span>
											<select name="id_bank" value="">
												<option>-- Pilih Bank Transfer --</option>
													<?php
												$q = mysqli_query($mysqli,"select * from tbl_bank");

													while ($a = mysqli_fetch_array($q)){
													if ($a['0'] ==$p_id_bank) {
														echo "<option value='$a[0]' selected>$a[1]</option>";
													} else {
													echo "<option value='$a[0]'>$a[1]</option>";
													}
														}
													?>
											</select>
											<input type="text" name="norek" value="<?php echo $p_norek;?>" id="norek" placeholder="Nomer Rekening" />
                                                <input type="text" name="nojamsos" value="<?php echo $p_nojamsos;?>" id="nojamsostek" placeholder="No.Jamsostek" />
                                                 <input type="text" name="nodplk" value="<?php echo $p_nodplk;?>" id="norek" placeholder="No.DPLK Manulife:" />
                                                 <input type="text" name="nojiwa" value="<?php echo $p_nojiwa;?>" id="No.Jiwasaraya" placeholder="No.Jiwasaraya" />
											</span>
											</div>
											
										
											
							</div>

							
							<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right ">Agama :</label>
											<div class="col-sm-9">
											<select name="id_agm" value="" id="id_agm">
												<option>-- Pilih Agama --</option>
													<?php
												$q = mysqli_query($mysqli,"select * from tbl_agama");

													while ($a = mysqli_fetch_array($q)){
													if ($a['0'] ==$p_id_agm) {
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
                            <label class="col-sm-3 control-label no-padding-right ">Jenis Pegawai :</label>
                            <div class="col-sm-9">
                                <select name="id_jns" value="" id="id_jns" required>
                                    <option>-- Pilih Jenis Pegawai --</option>
                                    <?php
                                    $q = mysqli_query($mysqli,"select * from jns_pegawai");

                                    while ($a = mysqli_fetch_array($q)){
                                        if ($a['0'] ==$p_jnspeg) {
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
									<label class="col-sm-3 control-label no-padding-right" for="nonpwp">Kepakaran:</label> 
									<div class="col-sm-9">
										<input type="text" name="kdkpkrn" id="kdkpkrn" class="col-xs-10 col-sm-4" placeholder="Kepakaran" value="<?php echo $p_kdkpkrn;?>"/>
									</div>
						</div>	

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right ">Jabatan Fungsional :</label>
                            <div class="col-sm-9">
                                <select name="kd_jbfungsi" value="" id="kd_jbfungsi" title="Untuk Merubah silahkan ke tabs R Jabatan Fungsional pada Edit Data Lengkap" disabled>
                                    <option>-- Pilih Jabatan Fungsional --</option>
                                    <?php
                                    $q = mysqli_query($mysqli,"select * from jb_fungsi");

                                    while ($a = mysqli_fetch_array($q)){
                                        if ($a['0'] ==$p_jbfungsi) {
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
                            <label class="col-sm-3 control-label no-padding-right ">Jabatan Struktural :</label>
                            <div class="col-sm-9">
                                <select name="kd_jbstruk" value="" id="kd_jbstruk" title="Untuk Merubah silahkan ke tabs R Jabatan Struktural pada Edit Data Lengkap" disabled >
                                    <option>-- Pilih Jabatan Struktural --</option>
                                    <?php
                                    $q = mysqli_query($mysqli,"select * from jb_struk");

                                    while ($a = mysqli_fetch_array($q)){
                                        if ($a['0'] ==$p_jbstruk) {
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
                            <label class="col-sm-3 control-label no-padding-right ">Sub Bagian :</label>
                            <div class="col-sm-9">
                                <select name="kd_sub" value="" id="kd_sub" required>
                                    <option>-- Pilih Sub Bagian --</option>
                                    <?php
                                    $q = mysqli_query($mysqli,"select * from sub_bagian");

                                    while ($a = mysqli_fetch_array($q)){
                                        if ($a['0'] ==$p_kd_sub) {
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
                            <label class="col-sm-3 control-label no-padding-right ">Golongan :</label>
                            <div class="col-sm-9">
                                <select name="id_gol" value="" title="Untuk merubah golongan silahkan ke menu History golongan" id="id_gol" disabled required>
                                    <option>-- Pilih Golongan --</option>
                                    <?php
                                    $q = mysqli_query($mysqli,"select * from tbl_gol");

                                    while ($a = mysqli_fetch_array($q)){
                                        if ($a['0'] ==$p_id_gol) {
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
									<label class="col-sm-3 control-label no-padding-right" for="platform">Status Kawin :</label>

										<div class="col-sm-9">
											
											<select name="kdstatusk"  value="" id="kdstatusk" required>
												<option>-- Status Kawin--</option>
														<?php
												$q = mysqli_query($mysqli,"select * from tbl_statusk");

													while ($a = mysqli_fetch_array($q)){
													if ($a['0'] ==$p_kdstatusk) {
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
									<label class="col-sm-3 control-label no-padding-right" for="platform">Status Pegawai:</label>

										<div class="col-sm-9">
										
											<select name="kdstatusp" class="chzn-select" value="" id="kdstatusp" required>
												<option>-- Status Pegawai --</option>
													<?php
												$q = mysqli_query($mysqli,"select * from tbl_statusp");

													while ($a = mysqli_fetch_array($q)){
													if ($a['0'] ==$p_kdstatusp) {
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
						<label class="col-sm-3 control-label no-padding-right">Tanggal Masuk:</label>
					<div class="row">
						<div class="col-xs-8 col-sm-3">
							<div class="input-group">
								<input class="form-control date-picker" name="datemasuk" required value="<?php echo $p_datemasuk;?>" id="tgl_masuk" type="text" data-date-format="yyyy-mm-dd" />
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
							</div>
						</div>
					</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right">Tanggal Habis Kontrak:</label>
					<div class="row">
						<div class="col-xs-8 col-sm-3">
							<div class="input-group">
								<input class="form-control date-picker" name="datekontrak" value="<?php echo $p_datekontrak;?>" id="tgl_habis" type="text" data-date-format="yyyy-mm-dd" />
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
							</div>
						</div>
					</div>
					</div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="platform">Pendidikan:</label>

                            <div class="col-sm-9">
											<span class="span12">
											<select name="kdpndidik" class="chzn-select" required id="kdpndidik">
                                                <option>-- Pendidikan Terakhir--</option>
                                                <?php
                                                $q = mysqli_query($mysqli,"select * from tbl_pendidikan");

                                                while ($a = mysqli_fetch_array($q)){
                                                    if ($a['0'] ==$p_kdpndidik) {
                                                        echo "<option value='$a[0]' selected>$a[1]</option>";
                                                    } else {
                                                        echo "<option value='$a[0]'>$a[1]</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
											</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Jabatan:</label>

                            <div class="col-xs-8 col-sm-3">
                                <div class="input-group">
                                    <input class="form-control date-picker" name="tanggaljab" value="<?php echo $p_tgl_jab;?>" id="tgl_jab" type="text" data-date-format="yyyy-mm-dd" <?php echo $readonly ;?> />
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                                </div>
                            </div>

                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right">Jabatan :</label>
                            <div class="span12">
                                <div class="col-sm-9">
                                <select name="jab" title="Untuk rubah jabatan silahkan ke menu History Jabatan" class="" value="" <?php echo $true; ?>  ">
                                    <option>-- Pilih Jabatan --</option>
                                    <?php
                                    $q = mysqli_query($mysqli,"select * from jabatan order by n_jab ");

                                    while ($a = mysqli_fetch_array($q)){
                                        if ($a[1] ==$p_jab) {
                                            echo "<option value='$a[1]' selected>$a[2]</option>";
                                        } else {
                                            echo "<option value='$a[1]' >$a[2]</option>";
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                                </div>

                        </div>
						
						
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right">Status Keaktifan :</label>
                            <div class="span12">
                                <div class="col-sm-9">
                                <select name="id_stsk" class="" value="" required>
                                    <option>-- Pilih Status Keaktifan --</option>
                                    <?php
                                    $q = mysqli_query($mysqli,"select * from sts_keaktifan order by nm_stsk");
                                    while ($a = mysqli_fetch_array($q)){
                                        if ($a[0] ==$p_stsk) {
                                            echo "<option value='$a[0]' selected>$a[1]</option>";
                                        } else {
                                            echo "<option value='$a[0]' >$a[1]</option>";
                                        }
                                    }
                                    ?>
                                </select>

								</div>
                            </div>

                        </div>




                        <div>

                            <input class="btn btn-success btn-big btn-next" type="submit" name="kirim_daftar" value="<?php echo $p_submit; ?>">


                            <a href="?id=tambahpeg" class="btn" type="reset">
                                <i class="icon-undo bigger-110"></i>
                                RESET
                            </a>

                        </div>
                        </form>

</div>

<div id="pf" class="tab-pane fade">
    <span class="input-icon"></span>

    <a  href="?id=pendidikan&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>

    <?php
    $q_nm_pegawai	    = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai	    = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";
    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th>
    <th>Tahun</th><th>Jenjang</th><th>Asal Sekolah</th><th>Kota</th><th>Jurusan</th><th>No Ijazah</th><th>Bidang Ilmu</th><th>Gelar Akademik</th><th>Keterangan</th><th>Control</th></tr>";

    $q_pndk	= mysqli_query($mysqli,"SELECT a.*,b.nmpndidik FROM pendidikan a
        left join tbl_pendidikan b on a.kdpndidik=b.kdpndidik
     where a.id='$id_daftar' ORDER BY a.idp ASC") or die (mysqli_error($mysqli));
    $j_datapndk 	= mysqli_num_rows($q_pndk);

    if ($j_datapndk == 0) {
        echo "<tr><td colspan='10'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($a_pndk = mysqli_fetch_array($q_pndk)) {
            echo "<tr>
				<td>$no</td>
				<td>$a_pndk[t_pdk]</td>
				<td>$a_pndk[nmpndidik]</td>
				<td>$a_pndk[asl_sekolah]</td>
				<td>$a_pndk[kota]</td>
				<td>$a_pndk[jurusan]</td>
				<td>$a_pndk[noijazah]</td>
				<td>$a_pndk[b_ilmu]</td>
				<td>$a_pndk[g_akademik]</td>
				<td>$a_pndk[ket]</td>
				<td><a href='?id=pendidikan&mod=edit&idpndk=$a_pndk[idp]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='$a_pndk[file]' title='Download'><span class='blue'><i class='ace-icon fa fa-download bigger-120'></i></span></a> |
					<a href='?id=tambahpeg&mod=delpndk&idpndk=$a_pndk[idp]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
            $no++;
        }
    }
    echo "</table>";
    ?>

</div>

<div id="berkas" class="tab-pane fade">
    <span class="input-icon"></span>

    <a  href="?id=berkasfile&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>

    <?php
    $q_nm_pegawai       = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai       = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";
    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'>
    <tr>
    <th>ID</th>
    <th>Nama Berkas</th>
    <th>Tgl Upload</th>
    <th>Action</th>
    </tr>";

    $q_berkas = mysqli_query($mysqli,"SELECT a.*,b.nama_berkas FROM tbl_upload_berkas a
        left join tbl_berkas b on a.id_berkas=b.id_berkas
     where a.id='$id_daftar' ORDER BY a.idub ASC") or die (mysqli_error($mysqli));
    $j_databerkas     = mysqli_num_rows($q_berkas);

    if ($j_databerkas == 0) {
        echo "<tr><td colspan='4'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($a_berkas = mysqli_fetch_array($q_berkas)) {
            echo "<tr>
                <td>$no</td>
                <td>$a_berkas[nama_berkas]</td>
                <td>$a_berkas[tgl_upload]</td>
                <td><a href='?id=berkasfile&mod=edit&idub=$a_berkas[idub]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
                    <a href='$a_berkasfile[file]' title='Download'><span class='blue'><i class='ace-icon fa fa-download bigger-120'></i></span></a> |
                    <a href='?id=tambahpeg&mod=delberkas&idub=$a_berkas[idub]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
                </tr>";
            $no++;
        }
    }
    echo "</table>";
    ?>

</div>

<div id="pk" class="tab-pane fade">
    <span class="input-icon"></span>
    <a  href="?id=pengalaman&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>
    <?php
    $q_nm_pegawai	    = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai	    = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";

    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Awal</th><th>Akhir</th><th>Jabatan</th><th>Perusahaan</th><th>Detail</th><th>Tahun</th><th>Control</th></tr>";

    $q_pk	= mysqli_query($mysqli,"SELECT * FROM pengalaman_kerja where id='$id_daftar' ORDER BY id_peker ASC") or die (mysqli_error($mysqli));
    $j_data 	= mysqli_num_rows($q_pk);

    if ($j_data == 0) {
        echo "<tr><td colspan='3'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($a_pk = mysqli_fetch_array($q_pk)) {
            echo "<tr>
				<td>$no</td>
				<td>$a_pk[5]</td>
				<td>$a_pk[6]</td>
				<td>$a_pk[1]</td>
				<td>$a_pk[7]</td>
				<td>$a_pk[2]</td>
				<td>$a_pk[3]</td>
				<td><a href='?id=pengalaman&mod=edit&idpk=$a_pk[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=tambahpeg&mod=delpk&idpk=$a_pk[0]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
            $no++;
        }
    }
    echo "</table>";
    ?>

</div>

<div id="pl" class="tab-pane fade">
    <span class="input-icon"></span>
    <a  href="?id=pelatihan&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>
    <?php
    $q_nm_pegawai	    = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai	    = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";
    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Tanggal Mulai</th><th>Topik / Nama Pelatihan</th><th>Penyelengara</th><th>Tempat</th><th>Jumlah Jam/Hari</th><th>Control</th></tr>";

    $q_pl	= mysqli_query($mysqli,"SELECT * FROM pelatihan where id='$id_daftar' ORDER BY id_pelatihan ASC") or die (mysqli_error($mysqli));
    $j_data 	= mysqli_num_rows($q_pl);

    if ($j_data == 0) {
        echo "<tr><td colspan='7'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($a_pl = mysqli_fetch_array($q_pl)) {
            echo "<tr>
				<td>$no</td>
				<td>$a_pl[1]</td>
				<td>$a_pl[2]</td>
				<td>$a_pl[3]</td>
				<td>$a_pl[5]</td>
				<td>$a_pl[6]</td>
				<td><a href='?id=pelatihan&mod=edit&idpl=$a_pl[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=tambahpeg&mod=delpl&idpl=$a_pl[0]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
            $no++;
        }
    }
    echo "</table>";
    ?>
</div>




<div id="rj" class="tab-pane fade">
    <span class="input-icon"></span>
    <a  href="?id=hjabatan&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>
    <?php
    $q_nm_pegawai	    = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai	    = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";
    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th width='10%'>ID</th><th>Tanggal</th><th>Jabatan</th><th>Control</th></tr>";

    $q_rj	= mysqli_query($mysqli,"SELECT * FROM h_jabatan a,jabatan b where a.kode=b.kode and a.id='$id_daftar' ORDER BY tgl_jab DESC") or die (mysqli_error($mysqli));
    $j_data 	= mysqli_num_rows($q_rj);

    if ($j_data == 0) {
        echo "<tr><td colspan='4'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($a_rj = mysqli_fetch_array($q_rj)) {
            echo "<tr>
				<td>$no</td>
				<td>$a_rj[1]</td>
				<td>$a_rj[6]</td>
				<td><a href='?id=hjabatan&mod=edit&idrj=$a_rj[0]'><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=tambahpeg&mod=delrj&idrj=$a_rj[0]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
            $no++;
        }
    }
    echo "</table>";
    ?>
</div>


<div id="dk" class="tab-pane fade">
    <span class="input-icon"></span>
    <a  href="?id=keluarga&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>

    <?php
    $q_nm_pegawai	    = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai	    = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";

    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Nama Keluarga</th><th>Hubungan</th><th>Pekerjaan</th><th>Tempat</th><th>Tgl Lahir</th><th>Control</th></tr>";

    $q_dk	= mysqli_query($mysqli,"SELECT * FROM keluarga WHERE id='$id_daftar'") or die (mysqli_error($mysqli));
    $j_data 	= mysqli_num_rows($q_dk);

    if ($j_data == 0) {
        echo "<tr><td colspan='5'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($a_dk = mysqli_fetch_array($q_dk)) {
            echo "<tr>
				<td>$no</td>
				<td>$a_dk[nm_k]</td>
				<td>$a_dk[ket]</td>
				<td>$a_dk[pekerjaan]</td>
				<td>$a_dk[tempat_lahir]</td>
				<td>$a_dk[tgl_lahirk]</td>
				<td><a href='?id=keluarga&mod=edit&idkel=$a_dk[id_k]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=tambahpeg&mod=delk&idkel=$a_dk[id_k]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
            $no++;
        }
    }
    echo "</table>";


    ?>



</div>

<div id="pg" class="tab-pane fade">
    <span class="input-icon"></span>
    <a  href="?id=penghargaan&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>

    <?php

    $q_nm_pegawai	    = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai	    = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";
    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th width='10%'>ID</th><th>Penghargaan</th><th>No SK</th><th>Tanggal SK</th><th>Instansi</th><th>Tahun</th><th>Control</th></tr>";

    $q_pg	= mysqli_query($mysqli,"SELECT * FROM penghargaan WHERE id='$id_daftar'") or die (mysqli_error($mysqli));
    $j_datapg 	= mysqli_num_rows($q_pg);

    if ($j_datapg == 0) {
        echo "<tr><td colspan='7'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($a_pg = mysqli_fetch_array($q_pg)) {
            echo "<tr>
				<td>$no</td>
				<td>$a_pg[1]</td>
				<td>$a_pg[2]</td>
				<td>$a_pg[3]</td>
				<td>$a_pg[4]</td>
				<td>$a_pg[5]</td>
				<td><a href='?id=penghargaan&mod=edit&idpg=$a_pg[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=tambahpeg&mod=delpg&idpg=$a_pg[0]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
            $no++;
        }
    }
    echo "</table>";


    ?>



</div>


<div id="gol" class="tab-pane fade">
    <span class="input-icon"></span>
    <a  href="?id=golongan&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>

    <?php
    $q_nm_pegawai	    = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai	    = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";

    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th width='10%'>ID</th>
    <th>No SK</th><th>Tanggal SK</th><th>Tanggal TMT</th><th>Golongan</th><th>Control</th></tr>";

    $q_gol	= mysqli_query($mysqli,"SELECT kdgol,no_sk,tgl_sk,tmt_tgl,a.id_gol,b.gol FROM golongan a, tbl_gol b
              WHERE a.id_gol=b.id_gol and a.id='$id_daftar'") or die (mysqli_error($mysqli));
    $j_datagol 	= mysqli_num_rows($q_gol);

    if ($j_datagol == 0) {
        echo "<tr><td colspan='7'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($a_gol = mysqli_fetch_array($q_gol)) {
            echo "<tr>
				<td>$no</td>
				<td>$a_gol[1]</td>
				<td>$a_gol[2]</td>
				<td>$a_gol[3]</td>
				<td>$a_gol[5]</td>
				<td><a href='?id=golongan&mod=edit&idgol=$a_gol[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=tambahpeg&mod=delgol&idgol=$a_gol[0]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
            $no++;
        }
    }
    echo "</table>";


    ?>



</div>

<div id="sert" class="tab-pane fade">
    <span class="input-icon"></span>
    <a  href="?id=keahlian&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>

    <?php
    $q_nm_pegawai	    = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai	    = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";

    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th>
    <th>Tanggal Awal</th><th>Tanggal Akhir</th><th>Sertifikat</th><th>No Sertifikat</th><th>Control</th></tr>";

    $q_sert	        = mysqli_query($mysqli,"select * from sertifikat2 where id='$id_daftar'") or die (mysqli_error($mysqli));
    $j_datasert 	= mysqli_num_rows($q_sert);

    if ($j_datasert == 0) {
        echo "<tr><td colspan='6'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($a_sert = mysqli_fetch_array($q_sert)) {
            echo "<tr>
				<td>$no</td>
				<td>$a_sert[1]</td>
				<td>$a_sert[2]</td>
				<td>$a_sert[3]</td>
				<td>$a_sert[4]</td>
				<td><a href='?id=keahlian&mod=edit&idsert=$a_sert[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
				 <a href='$a_sert[6]' title='Download'><span class='blue'><i class='ace-icon fa fa-download bigger-120'></i></span></a> |
					<a href='?id=tambahpeg&mod=delsert&idsert=$a_sert[0]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
            $no++;
        }
    }
    echo "</table>";


    ?>
</div>

<div id="pen" class="tab-pane fade">
    <span class="input-icon"></span>
    <a  href="?id=penugasan&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>

    <?php
    $q_nm_pegawai	    = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai	    = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";

    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th>
    <th>Tanggal Awal</th><th>Tanggal Akhir</th><th>No SK</th><th>Tempat</th><th>Unit Kerja</th><th>Jabatan</th><th>Control</th></tr>";

    $q_pen	        = mysqli_query($mysqli,"select * from penugasan where id='$id_daftar'") or die (mysqli_error($mysqli));
    $j_datapen 	    = mysqli_num_rows($q_pen);

    if ($j_datapen == 0) {
        echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($a_pen = mysqli_fetch_array($q_pen)) {
            echo "<tr>
				<td>$no</td>
				<td>$a_pen[1]</td>
				<td>$a_pen[2]</td>
				<td>$a_pen[3]</td>
				<td>$a_pen[4]</td>
				<td>$a_pen[5]</td>
				<td>$a_pen[6]</td>
				<td><a href='?id=penugasan&mod=edit&idpen=$a_pen[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=tambahpeg&mod=delpen&idpen=$a_pen[0]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
            $no++;
        }
    }
    echo "</table>";


    ?>
</div>


<div id="ki" class="tab-pane fade">
    <span class="input-icon"></span>
    <a  href="?id=karyailmiah&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>

    <?php
    $q_nm_pegawai	    = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai	    = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";

    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th>
    <th>Tanggal</th><th>Judul</th><th>Tempat</th><th>Sifat Karya ilmiah</th><th>Lingkup Kegiatan</th><th>Referensi</th><th>Control</th></tr>";

    $q_ki	        = mysqli_query($mysqli,"select * from karya_ilmiah where id='$id_daftar'") or die (mysqli_error($mysqli));
    $j_dataki 	    = mysqli_num_rows($q_ki);

    if ($j_dataki == 0) {
        echo "<tr><td colspan='8'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($a_ki = mysqli_fetch_array($q_ki)) {
            echo "<tr>
				<td>$no</td>
				<td>$a_ki[1]</td>
				<td>$a_ki[2]</td>
				<td>$a_ki[3]</td>
				<td>$a_ki[4]</td>
				<td>$a_ki[5]</td>
				<td>$a_ki[6]</td>
				<td><a href='?id=karyailmiah&mod=edit&idki=$a_ki[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=tambahpeg&mod=delki&idki=$a_ki[0]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
            $no++;
        }
    }
    echo "</table>";


    ?>
</div>


<div id="jabf" class="tab-pane fade">
    <span class="input-icon"></span>
    <a  href="?id=hjabfungsi&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>

    <?php
    $q_nm_pegawai	    = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai	    = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";

    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th>
    <th>Jabatan Fungsional</th><th>Tanggal TMT SK</th><th>No SK</th><th>Control</th></tr>";

    $q_jbf	        = mysqli_query($mysqli,"select * from h_jbfungsi,jb_fungsi where h_jbfungsi.kd_jbfungsi=jb_fungsi.kd_jbfungsi and id='$id_daftar'") or die (mysqli_error($mysqli));
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
				<td><a href='?id=hjabfungsi&mod=edit&idjbf=$a_jbf[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=tambahpeg&mod=deljbf&idjbf=$a_jbf[0]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
            $no++;
        }
    }
    echo "</table>";


    ?>
</div>

<div id="jabs" class="tab-pane fade">
    <span class="input-icon"></span>
    <a  href="?id=hjabstruk&mod=add&id_d=<?php echo $id_daftar; ?>" class="btn btn-app btn-purple btn-xs">
        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
        Tambah
        <span class="badge badge-warning badge-right"></span>
    </a>

    <?php
    $q_nm_pegawai	    = mysqli_query($mysqli,"SELECT nama FROM pegawai WHERE id ='$id_daftar'");
    $a_nm_pegawai	    = mysqli_fetch_array($q_nm_pegawai);
    echo "Nama Pegawai : <b>$a_nm_pegawai[0]</b>";

    // ================ TAMPILKAN DATANYA =====================//
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th>
    <th>Jabatan Struktural</th><th>Tanggal TMT SK</th><th>No SK</th><th>Control</th></tr>";

    $q_jbs	        = mysqli_query($mysqli,"select * from h_jbstruk,jb_struk where h_jbstruk.kd_jbstruk=jb_struk.kd_jbstruk and id='$id_daftar'") or die (mysqli_error($mysqli));
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
				<td><a href='?id=hjabstruk&mod=edit&idjbs=$a_jbs[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=tambahpeg&mod=deljbs&idjbs=$a_jbs[0]' onclick=\"return confirm('Menghapus data')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
            $no++;
        }
    }
    echo "</table>";


    ?>
</div>

</div>
</div>

</div>


</div>
<?php
}else{
	  header('Location:../index.php?status=Silahkan Login');
}
?>	