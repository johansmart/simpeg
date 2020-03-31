<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5' )

{
    $id_pndk	    = isset($_GET['idpndk']) ? $_GET['idpndk'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;

    $p_id_pndk  	= isset($_POST['id_pndk']) ? $_POST['id_pndk'] : NULL;
    $p_t_pdk 	    = isset($_POST['t_pdk']) ? $_POST['t_pdk'] : NULL;
    $p_d_pdk 	    = isset($_POST['d_pdk']) ? $_POST['d_pdk'] : NULL;
    $p_id_daftar  	= isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL;
    $p_ket 	        = isset($_POST['ket']) ? $_POST['ket'] : NULL;
    $p_kotas 	    = isset($_POST['kotas']) ? $_POST['kotas'] : NULL;
    $p_asl_sekolah 	= isset($_POST['asl_sekolah']) ? $_POST['asl_sekolah'] : NULL;
    $p_kotas 	    = isset($_POST['kotas']) ? $_POST['kotas'] : NULL;
    $p_jurusan	    = isset($_POST['jurusan']) ? $_POST['jurusan'] : NULL;
    $p_noijazah 	= isset($_POST['noijazah']) ? $_POST['noijazah'] : NULL;
    $p_bidilmu	    = isset($_POST['bidilmu']) ? $_POST['bidilmu'] : NULL;
    $p_ga 	        = isset($_POST['ga']) ? $_POST['ga'] : NULL;
	$nama_file		=$_FILES['file']['name'];
	$size_file 		=$_FILES['file']['size'];
	$type_file		=pathinfo($nama_file);
	
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;


    if ($tb_act == "Tambah") {
		if ($size_file >= 2000000){
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Maaf file tidak boleh melebihi 2mb<br/></div>";
			
		} else if($size_file == 0) {
             $q_tambah_pendidikan = mysqli_query($mysqli, "INSERT INTO pendidikan VALUES ('','$p_t_pdk','$p_d_pdk','$p_ket','$p_id_daftar','$p_asl_sekolah','$p_kotas','$p_jurusan','$p_noijazah','$p_bidilmu','$p_ga','$alamatfile')");
                    if ($q_tambah_pendidikan > 0) {
                        if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
                        } else {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Simpan <a href='?id=profil'>KEMBALI</a><br/></div>";
                        }

                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                    }
        }else {
            if ($type_file['extension']=='pdf') {
                $uploaddir = './pdfupload/';
                $alamatfile = $uploaddir . $nama_file;
                if (move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile)) {
                    $q_tambah_pendidikan = mysqli_query($mysqli, "INSERT INTO pendidikan VALUES ('','$p_t_pdk','$p_d_pdk','$p_ket','$p_id_daftar','$p_asl_sekolah','$p_kotas','$p_jurusan','$p_noijazah','$p_bidilmu','$p_ga','$alamatfile')");
                    if ($q_tambah_pendidikan > 0) {
                        if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
                        } else {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Simpan <a href='?id=profil'>KEMBALI</a><br/></div>";
                        }

                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                    }
                }
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Maaf hanya file PDF yang bisa di upload<br/></div>";
            }
        }
		
		
    } else if ($tb_act == "Edit") {
        if ($size_file >= 2000000){
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Maaf file tidak boleh melebihi 2mb<br/></div>";

        }
        if ($size_file == 0){

            $q_edit_pendidikan	= mysqli_query($mysqli,"UPDATE pendidikan SET t_pdk='$p_t_pdk',kdpndidik='$p_d_pdk',ket='$p_ket',asl_sekolah='$p_asl_sekolah',kota='$p_kotas',jurusan='$p_jurusan',noijazah='$p_noijazah',b_ilmu='$p_bidilmu',g_akademik='$p_ga' WHERE idp = '$p_id_pndk'");
            if ($q_edit_pendidikan > 0) {
                if ($_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2') {
                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
                } else {
                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Ubah <a href='?id=profil'>KEMBALI</a><br/></div>";
                }

            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
            }
        } else {

            if ($type_file['extension']=='pdf') {
                $uploaddir = './pdfupload/';
                $alamatfile = $uploaddir . $nama_file;
                if (move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile)) {
                    $q_edit_pendidikan = mysqli_query($mysqli, "UPDATE pendidikan SET t_pdk='$p_t_pdk',kdpndidik='$p_d_pdk',ket='$p_ket',asl_sekolah='$p_asl_sekolah',kota='$p_kotas',jurusan='$p_jurusan',noijazah='$p_noijazah',b_ilmu='$p_bidilmu',g_akademik='$p_ga', file='$alamatfile' WHERE idp = '$p_id_pndk'");
                    if ($q_edit_pendidikan > 0) {
                        if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
                        } else {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Ubah <a href='?id=profil'>KEMBALI</a><br/></div>";
                        }

                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                    }
                }
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Maaf hanya file PDF yang bisa di upload<br/></div>";
            }
        }



    }


    ?>

    <div class="col-sm-12">
    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#dk">
                    <i class="green ace-icon fa fa-bookmark bigger-120"></i>
                    Pendidikan

                </a>
            </li>
        </ul>


        <?php
        if ($mod == "edit") {
            $q_edit_pendidikan	= mysqli_query($mysqli,"SELECT * FROM pendidikan WHERE idp ='$id_pndk'");
            $a_edit_pendidikan	= mysqli_fetch_array($q_edit_pendidikan);
            $id_k               = $a_edit_pendidikan[0];
            $t_pdk              = $a_edit_pendidikan[1];
            $d_pdk              = $a_edit_pendidikan[2];
            $ket                = $a_edit_pendidikan[3];
            $id_d               = $a_edit_pendidikan[4];
            $asl_s               = $a_edit_pendidikan[5];
            $kotas               = $a_edit_pendidikan[6];
            $jurusan             = $a_edit_pendidikan[7];
            $noijazah            = $a_edit_pendidikan[8];
            $bid_ilmu            = $a_edit_pendidikan[9];
            $gelar_a            = $a_edit_pendidikan[10];
            $view               = "Edit";

        } else if ($mod == "add") {
            $t_pdk               = "";
            $d_pdk               = "";
            $ket                 = "";
            $asl_s               = "";
            $kotas               = "";
            $jurusan             = "";
            $noijazah            = "";
            $bid_ilmu            = "";
            $gelar_a             = "";
            $view = "Tambah";
        }


        ?>
        <div class="tab-content profile-edit-tab-content">
            <div id="dk" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" enctype="multipart/form-data" >
                    <input type="text" name="id_pndk" id="id_pndk" class="col-xs-10 col-sm-1" hidden="hidden" value="<?php echo $id_pndk; ?>" />
                    <input type="text" name="id_daftar" id="id_daftar" class="col-xs-10 col-sm-1"  value="<?php echo $id_d; ?>" hidden/>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Tahun :</label>
                        <div class="col-sm-9">
                            <input type="text" name="t_pdk" id="t_pdk" class="col-xs-10 col-sm-3" value="<?php echo $t_pdk; ?>" placeholder="Tahun Lulus" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Jenjang :</label>
                        <div class="span12">
                            <div class="col-sm-9">
                                <select name="d_pdk" class="" value="">
                                    <option>-- Pilih Jenjang --</option>
                                    <?php
                                    $q = mysqli_query($mysqli,"select * from tbl_pendidikan order by kdpndidik ");

                                    while ($a = mysqli_fetch_array($q)){
                                        if ($a[0] ==$d_pdk) {
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

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Asal sekolah :</label>
                        <div class="col-sm-9">
                            <input type="text" name="asl_sekolah" id="asl_sekolah" class="col-xs-10 col-sm-3" value="<?php echo $asl_s; ?>" placeholder="Asal Sekolah" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Kota :</label>
                        <div class="col-sm-9">
                            <input type="text" name="kotas" id="kotas" class="col-xs-10 col-sm-3" value="<?php echo $kotas; ?>" placeholder="Kota" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Jurusan :</label>
                        <div class="col-sm-9">
                            <input type="text" name="jurusan" id="jurusan" class="col-xs-10 col-sm-3" value="<?php echo $jurusan; ?>" placeholder="Jurusan" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >No Ijazah :</label>
                        <div class="col-sm-9">
                            <input type="text" name="noijazah" id="noijazah" class="col-xs-10 col-sm-3" value="<?php echo $noijazah; ?>" placeholder="No Ijazah" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"  >Bidang Ilmu  :</label>
                        <div class="col-sm-9">
                            <input type="text" name="bidilmu" id="bidilmu" class="col-xs-10 col-sm-5" placeholder="bidang ilmu " value="<?php echo $bid_ilmu; ?>" />
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Gelar Akademik :</label>
                        <div class="col-sm-9">
                            <input type="text" name="ga" id="ga" class="col-xs-10 col-sm-5" placeholder="Gelar Akademik " value="<?php echo $gelar_a; ?>" />
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Keterangan :</label>
                        <div class="col-sm-9">
                            <input type="text" name="ket" id="ket" class="col-xs-10 col-sm-5" placeholder="Formal/Non Formal " value="<?php echo $ket; ?>" />
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Upload Scan Ijazah :</label>
                        <div class="col-sm-9">
                            <input type="file" name="file" id="file" /> * Harus dalam bentuk PDF & Tidak boleh melebihi 200 Kb
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" ></label>
                        <div class="col-sm-9">
                            <input type="submit" class="btn btn-info" name="tb_act" id="simpan" value="<?php echo $view; ?>" />
                            <a href="javascript:history.back(-1)" class="btn btn-danger"/>Kembali</a>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

<?php
}else{
    header('Location:../index.php?status=Silahkan Login');
}