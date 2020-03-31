<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2' )

{
    $id_pen	        = isset($_GET['idpen']) ? $_GET['idpen'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL; //

    $p_id_pen  	    = isset($_POST['id_png']) ? $_POST['id_png'] : NULL;
    $p_tempat 	    = isset($_POST['tempat']) ? $_POST['tempat'] : NULL;
    $p_no_sk 	    = isset($_POST['no_sk']) ? $_POST['no_sk'] : NULL;
    $p_unit_kerja	= isset($_POST['unit_kerja']) ? $_POST['unit_kerja'] : NULL;
    $p_jabatan 	    = isset($_POST['jabatan']) ? $_POST['jabatan'] : NULL;
    $p_id_daftar  	= isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL; //
    $p_tgl_awal  	= isset($_POST['tglawal']) ? $_POST['tglawal'] : NULL; //
    $p_tgl_akhir  	= isset($_POST['tglakhir']) ? $_POST['tglakhir'] : NULL; //
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;


    if ($tb_act == "Tambah") {
        $q_tambah_pen	= mysqli_query($mysqli,"INSERT INTO penugasan VALUES ('','$p_tgl_awal','$p_tgl_akhir','$p_no_sk','$p_tempat','$p_unit_kerja','$p_jabatan','','','','','$p_id_daftar')");
        if ($q_tambah_pen > 0) {

            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Penugasan Pegawai Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a> <br/></div>";

        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }
    } else if ($tb_act == "Edit") {
        $q_edit_pen	= mysqli_query($mysqli,"UPDATE penugasan SET tgl_awal='$p_tgl_awal',tgl_akhir='$p_tgl_akhir',no_sk='$p_no_sk',tempat='$p_tempat',unit_kerja='$p_unit_kerja',jabatan='$p_jabatan' where idpng = '$p_id_pen'");
        if ($q_edit_pen > 0) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Penugasan Pegawai Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
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
                    Data Penugasan Pegawai
                </a>
            </li>
        </ul>


        <?php
        if ($mod == "edit") {
            $q_edit_pen	= mysqli_query($mysqli,"SELECT * FROM penugasan WHERE idpng='$id_pen'");
            $a_edit_pen	= mysqli_fetch_array($q_edit_pen);
            $id_pen        = $a_edit_pen[0];
            $awal           = $a_edit_pen[1]; //
            $akhir          = $a_edit_pen[2]; //
            $no_sk          = $a_edit_pen[3]; //
            $tempat         = $a_edit_pen[4]; //
            $unit_kerja     = $a_edit_pen[5]; //
            $jabatan        = $a_edit_pen[6]; //
            $id_d           = $a_edit_pen[11]; //
            $view   = "Edit";

        } else if ($mod == "add") {
            $awal           = ""; //
            $akhir          = ""; //
            $no_sk          = ""; //
            $tempat         = ""; //
            $unit_kerja     = ""; //
            $jabatan        = ""; //
            $view   = "Tambah";
        }


        ?>
        <div class="tab-content profile-edit-tab-content">
            <div id="pk" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
                    <input type="text" name="id_png" id="id_png" class="col-xs-10 col-sm-1" hidden value="<?php echo $id_pen; ?>" />
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
                        <label class="col-sm-3 control-label no-padding-right"  >Tempat :</label>
                        <div class="col-sm-9">
                            <input type="text" name="tempat" id="tempat" class="col-xs-10 col-sm-5" value="<?php echo $tempat; ?>" placeholder="Tempat" required/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"  >No SK :</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_sk" id="no_sk" class="col-xs-10 col-sm-5" value="<?php echo $no_sk; ?>" placeholder="No SK" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"  >Unit Kerja :</label>
                        <div class="col-sm-9">
                            <input type="text" name="unit_kerja" id="unit_kerja" class="col-xs-10 col-sm-5" value="<?php echo $unit_kerja; ?>" placeholder="Unit Kerja" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Jabatan :</label>
                        <div class="span12">
                            <div class="col-sm-9">
                                <select name="jabatan" class="" value="">
                                    <option>-- Pilih Jabatan --</option>
                                    <?php
                                    $q = mysqli_query($mysqli,"select * from jabatan order by n_jab ");

                                    while ($a = mysqli_fetch_array($q)){
                                        if ($a[2] ==$jabatan) {
                                            echo "<option value='$a[2]' selected>$a[2]</option>";
                                        } else {
                                            echo "<option value='$a[2]' >$a[2]</option>";
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
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