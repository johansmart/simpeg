<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5' )

{
    $id_sert	    = isset($_GET['idsert']) ? $_GET['idsert'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL; //

    $p_id_sert  	= isset($_POST['id_sert']) ? $_POST['id_sert'] : NULL;
    $p_sertifikat 	= isset($_POST['sertifikat']) ? $_POST['sertifikat'] : NULL;
    $p_no_s 	    = isset($_POST['no_s']) ? $_POST['no_s'] : NULL;
    $p_id_daftar  	= isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL; //
    $p_tgl_awal  	= isset($_POST['tglawal']) ? $_POST['tglawal'] : NULL; //
    $p_tgl_akhir  	= isset($_POST['tglakhir']) ? $_POST['tglakhir'] : NULL; //
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;
    $nama_file		=$_FILES['file']['name'];
    $size_file 		=$_FILES['file']['size'];
    $type_file		=pathinfo($nama_file);


    if ($tb_act == "Tambah") {
        if($size_file >= 2000000){
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Maaf file tidak boleh melebihi 2mb<br/></div>";

		} else {

            if ($type_file['extension']=='pdf') {
                $uploaddir = './pdfupload/';
                $alamatfile = $uploaddir . $nama_file;
                if (move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile)) {
                    $q_tambah_sert = mysqli_query($mysqli, "INSERT INTO sertifikat2 VALUES ('','$p_tgl_awal','$p_tgl_akhir','$p_sertifikat','$p_no_s','$p_id_daftar','$alamatfile')");
                    if ($q_tambah_sert > 0) {
                        if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Sertifikat  Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
                        } else {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Sertifikat Pegawai Berhasil di Simpan <a href='?id=profil'>KEMBALI</a><br/></div>";
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
        if ($size_file == 0) {
            $q_edit_sert = mysqli_query($mysqli, "UPDATE sertifikat2 SET tgl_awal='$p_tgl_awal',
                                                  tgl_akhir='$p_tgl_akhir',sertifikat='$p_sertifikat',
                                                  nosertifikat='$p_no_s' where idsertifikat = '$p_id_sert' ");
            if ($q_edit_sert > 0) {
                if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Keahlian Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
                } else {
                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Keahlian Berhasil di Ubah <a href='?id=profil'>KEMBALI</a><br/></div>";
                }

            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
            }
        } else {
            if ($type_file['extension']=='pdf') {
                $uploaddir = './pdfupload/';
                $alamatfile = $uploaddir . $nama_file;
                if (move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile)) {
                    $q_edit_sert = mysqli_query($mysqli, "UPDATE sertifikat2 SET tgl_awal='$p_tgl_awal',
                                                  tgl_akhir='$p_tgl_akhir',sertifikat='$p_sertifikat',
                                                  nosertifikat='$p_no_s',file='$alamatfile' where idsertifikat = '$p_id_sert'");
                    if ($q_edit_sert > 0) {
                        if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Sertifikat Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
                        } else {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Sertifikat Berhasil di Ubah <a href='?id=profil'>KEMBALI</a><br/></div>";
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

    <div class="col-sm-12" xmlns="http://www.w3.org/1999/html">
    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#pk">
                    <i class="green ace-icon  fa fa-bookmark-o  bigger-120"></i>
                    Data Sertifikat (Keahlian/Keterampilan)
                </a>
            </li>
        </ul>


        <?php
        if ($mod == "edit") {
            $q_edit_sert	= mysqli_query($mysqli,"SELECT * FROM sertifikat2 WHERE	idsertifikat='$id_sert'");
            $a_edit_sert	= mysqli_fetch_array($q_edit_sert);
            $id_sert        = $a_edit_sert[0];
            $awal           = $a_edit_sert[1]; //
            $akhir          = $a_edit_sert[2]; //
            $sertifikat     = $a_edit_sert[3]; //
            $nosertifikat   = $a_edit_sert[4]; //
            $id_d           = $a_edit_sert[5]; //
            $view   = "Edit";

        } else if ($mod == "add") {
            $awal           = "";
            $akhir          = "" ;
            $sertifikat     = "" ;
            $nosertifikat   =="";
            $view   = "Tambah";
        }


        ?>
        <div class="tab-content profile-edit-tab-content">
            <div id="pk" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" enctype="multipart/form-data">
                    <input type="text" name="id_sert" id="id_sert" class="col-xs-10 col-sm-1" hidden="hidden" value="<?php echo $id_sert; ?>" />
                    <input type="text" name="id_daftar" id="id_daftar" class="col-xs-10 col-sm-1"  value="<?php echo $id_d; ?>" hidden />

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Awal:</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tglawal" value="<?php echo $awal;?>" id="tglawal" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Akhir:</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tglakhir" value="<?php echo $akhir;?>" id="tglakhir" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"  >Sertifikat :</label>
                        <div class="col-sm-9">
                            <input type="text" name="sertifikat" id="sertifikat" class="col-xs-10 col-sm-5" value="<?php echo $sertifikat; ?>" placeholder="Sertifikat" required/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"  >No Sertifikat :</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_s" id="no_s" class="col-xs-10 col-sm-5" value="<?php echo $nosertifikat; ?>" placeholder="no Sertifikat" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Upload Scan Sertifikat :</label>
                        <div class="col-sm-9">
                            <input type="file" name="file" id="file" /> * Harus dalam bentuk PDF & Tidak boleh melebihi 200 Kb
                        </div>

                    </div>



                    <div class="form-group">
                        <label class="col-sm-10 control-label no-padding-right" ></label>
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