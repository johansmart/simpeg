<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5' )

{
    $id_ki	        = isset($_GET['idki']) ? $_GET['idki'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL; //

    $p_id_ki  	    = isset($_POST['id_ki']) ? $_POST['id_ki'] : NULL;
    $p_tanggal	    = isset($_POST['tgl']) ? $_POST['tgl'] : NULL;
    $p_judul 	    = isset($_POST['judul']) ? $_POST['judul'] : NULL;
    $p_tempat	    = isset($_POST['tempat']) ? $_POST['tempat'] : NULL;
    $p_sifat 	    = isset($_POST['sifat']) ? $_POST['sifat'] : NULL;
    $p_id_daftar  	= isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL; //
    $p_lingkup  	= isset($_POST['lingkup']) ? $_POST['lingkup'] : NULL; //
    $p_referensi  	= isset($_POST['referensi']) ? $_POST['referensi'] : NULL; //
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;


    if ($tb_act == "Tambah") {
        $q_tambah_ki	= mysqli_query($mysqli,"INSERT INTO karya_ilmiah VALUES ('','$p_tanggal','$p_judul','$p_tempat','$p_sifat','$p_lingkup','$p_referensi','$p_id_daftar')");
        if ($q_tambah_ki > 0) {

            if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Karya Ilmiah Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            } else {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Karya Ilmiah Berhasil di Ubah <a href='?id=profil'>KEMBALI</a><br/></div>";
            }
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }
    } else if ($tb_act == "Edit") {
        $q_edit_ki	= mysqli_query($mysqli,"UPDATE karya_ilmiah SET tgl='$p_tanggal',judul='$p_judul',tempat='$p_tempat',sifat_karyailmiah='$p_sifat',lingkup_kegiatan='$p_lingkup',referensi='$p_referensi' where id_ki = '$p_id_ki'");
        if ($q_edit_ki > 0) {
            if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Karya Ilmiah Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            } else {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Karya Ilmiah Berhasil di Ubah <a href='?id=profil'>KEMBALI</a><br/></div>";
            }
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }
    }


    ?>

    <div class="col-sm-12" xmlns="http://www.w3.org/1999/html">
    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#pk">
                    <i class="green ace-icon  fa fa-bookmark-o  bigger-120"></i>
                    Data Karya Ilmiah Pegawai
                </a>
            </li>
        </ul>


        <?php
        if ($mod == "edit") {
            $q_edit_ki	            = mysqli_query($mysqli,"SELECT * FROM karya_ilmiah WHERE id_ki='$id_ki'");
            $a_edit_ki	            = mysqli_fetch_array($q_edit_ki);
            $id_ki                  = $a_edit_ki[0];
            $tgl                    = $a_edit_ki[1]; //
            $judul                  = $a_edit_ki[2]; //
            $tempat                 = $a_edit_ki[3]; //
            $sifat_karyailmiah      = $a_edit_ki[4]; //
            $lingkup_kegiatan       = $a_edit_ki[5]; //
            $referensi              = $a_edit_ki[6]; //
            $id_d                   = $a_edit_ki[7]; //
            $view                   = "Edit";

        } else if ($mod == "add") {
            $tgl                    = ""; //
            $judul                  = ""; //
            $tempat                 = ""; //
            $sifat_karyailmiah      = ""; //
            $lingkup_kegiatan       = ""; //
            $referensi              = ""; //
            $view   = "Tambah";
        }


        ?>
        <div class="tab-content profile-edit-tab-content">
            <div id="pk" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
                    <input type="text" name="id_ki" id="id_ki" class="col-xs-10 col-sm-1" hidden value="<?php echo $id_ki; ?>" />
                    <input type="text" name="id_daftar" id="id_daftar" class="col-xs-10 col-sm-1"  value="<?php echo $id_d; ?>" hidden />

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal :</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tgl" value="<?php echo $tgl;?>" id="tgl" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"  >Tempat :</label>
                        <div class="col-sm-9">
                            <input type="text" name="tempat" id="tempat" class="col-xs-10 col-sm-5" value="<?php echo $tempat; ?>" placeholder="Tempat" required/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"  >Judul :</label>
                        <div class="col-sm-9">
                            <input type="text" name="judul" id="judul" class="col-xs-10 col-sm-5" value="<?php echo $judul; ?>" placeholder="Judul Karya Ilmiah" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Sifat Karya Ilmiah :</label>
                        <div class="span12">
                            <div class="col-sm-9">
                                <select name="sifat" id="sifat">
                                    <?php
                                    if ($sifat_karyailmiah =='Gagasan') {
                                        echo "<option value='Gagasan' selected>Gagasan</option>";
                                        echo "<option value='Ulasan'>Ulasan</option>";
                                        echo "<option value='Tinjauan'>Tinjauan</option>";
                                    } elseif ($sifat_karyailmiah =='Ulasan'){
                                        echo "<option value='Gagasan'>Gagasan</option>";
                                        echo "<option value='Ulasan' selected>Ulasan</option>";
                                        echo "<option value='Tinjauan'>Tinjauan</option>";
                                    } elseif ($sifat_karyailmiah =='Tinjauan'){
                                        echo "<option value='Gagasan'>Open</option>";
                                        echo "<option value='Ulasan' >Ulasan</option>";
                                        echo "<option value='Tinjauan' selected>Tinjauan</option>";
                                    } else {
                                        echo "<option value='' selected>---</option>";
                                        echo "<option value='Gagasan'>Open</option>";
                                        echo "<option value='Ulasan' >Ulasan</option>";
                                        echo "<option value='Tinjauan'>Tinjauan</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Lingkup Kegiatan :</label>
                        <div class="span12">
                            <div class="col-sm-9">
                                <select name="lingkup" id="lingkup">
                                    <?php
                                    if ($lingkup_kegiatan =='Internasional') {
                                        echo "<option value='Internasional' selected>Internasional</option>";
                                        echo "<option value='Nasional'>Nasional</option>";
                                        echo "<option value='Lokal'>Lokal</option>";
                                    } elseif ($lingkup_kegiatan =='Nasional'){
                                        echo "<option value='Internasional' >Internasional</option>";
                                        echo "<option value='Nasional' selected>Nasional</option>";
                                        echo "<option value='Lokal'>Lokal</option>";
                                    } elseif ($lingkup_kegiatan =='Lokal'){
                                        echo "<option value='Internasional' >Internasional</option>";
                                        echo "<option value='Nasional'>Nasional</option>";
                                        echo "<option value='Lokal' selected>Lokal</option>";
                                    } else {
                                        echo "<option value='' selected>---</option>";
                                        echo "<option value='Internasional' >Internasional</option>";
                                        echo "<option value='Nasional'>Nasional</option>";
                                        echo "<option value='Lokal'>Lokal</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"  >Referensi :</label>
                        <div class="col-sm-9">
                            <input type="text" name="referensi" id="referensi" class="col-xs-10 col-sm-5" value="<?php echo $referensi; ?>" placeholder="Referensi" required/>
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