<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2' )

{
    $idjbf	        = isset($_GET['idjbf']) ? $_GET['idjbf'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL;//
    $p_id_jbf  	    = isset($_POST['id_jbf']) ? $_POST['id_jbf'] : NULL;
    $p_id_daftar  	= isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL;
    $p_kd_jbf 	    = isset($_POST['kdjbf']) ? $_POST['kdjbf'] : NULL;
    $p_tgl_jbf 	    = isset($_POST['tgljbf']) ? $_POST['tgljbf'] : NULL;
    $p_no_sk 	    = isset($_POST['nosk']) ? $_POST['nosk'] : NULL;
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;

    if ($tb_act == "Tambah") {
        $q_tambah_jbf	= mysqli_query($mysqli,"INSERT INTO h_jbfungsi VALUES ('','$p_kd_jbf','$p_tgl_jbf','$p_no_sk','$p_id_daftar')");
        if ($q_tambah_jbf) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Riwayat Jabatan Fungsional Pegawai Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            mysqli_query($mysqli,"UPDATE pegawai SET kd_jbfungsi='$p_kd_jbf' where id='$p_id_daftar'");

        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }
    } else if ($tb_act == "Edit") {
        $q_edit_jbf	= mysqli_query($mysqli,"UPDATE h_jbfungsi SET kd_jbfungsi='$p_kd_jbf',tgl_tmt_sk='$p_tgl_jbf',no_sk='$p_no_sk' WHERE idjf = '$p_id_jbf'");
        if ($q_edit_jbf >0) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Riwayat Jabatan Fungsional Pegawai Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            $q_cek          = mysqli_query($mysqli,"SELECT id,kd_jbfungsi FROM h_jbfungsi WHERE id='$p_id_daftar' and idjf=(select max(idjf) from h_jbfungsi where id='$p_id_daftar')");
            $a_cek	        = mysqli_fetch_array($q_cek);
            mysqli_query($mysqli,"UPDATE pegawai SET kd_jbfungsi='$a_cek[1]' where id='$a_cek[0]'");
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }

    }


    ?>

    <div class="col-sm-12">
    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#rj">
                    <i class="green ace-icon fa fa-certificate  bigger-120"></i>
                    Riwayat Jabatan Fungsional

                </a>
            </li>
        </ul>


        <?php
        if ($mod == "edit") {

            $q_edit_jbf	= mysqli_query($mysqli,"SELECT * FROM h_jbfungsi WHERE idjf ='$idjbf'");
            $a_edit_jbf	= mysqli_fetch_array($q_edit_jbf);
            $id_jbf  = $a_edit_jbf[0];
            $kdjbf   = $a_edit_jbf[1];
            $tgljbf  = $a_edit_jbf[2];
            $no_sk   = $a_edit_jbf[3];
            $id_d   = $a_edit_jbf[4]; //
            $view   = "Edit";

        } else if ($mod == "add") {
            $kdjbf   = "";
            $tgljbf  = "";
            $no_sk   = "";
            $view    = "Tambah";
        }


        ?>
        <div class="tab-content profile-edit-tab-content">
            <div id="rj" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
                    <input type="text" name="id_jbf" id="id_jbf" class="col-xs-10 col-sm-1"  value="<?php echo $id_jbf; ?>" hidden/>
                    <input type="text" name="id_daftar" id="id_daftar" class="col-xs-10 col-sm-1"  value="<?php echo $id_d; ?>" hidden/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Jabatan Fungsional:</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tgljbf" value="<?php echo $tgljbf;?>" id="tgljbf" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">No SK:</label>

                        <div class="col-xs-8 col-sm-5">
                            <input type="text" name="nosk" id="nosk" class="col-xs-10 col-sm-5"  value="<?php echo $no_sk; ?>" required/>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Jabatan Fungsional :</label>
                        <div class="span12">
                            <div class="col-sm-9">
                                <select name="kdjbf" class="" value="">
                                    <option>-- Pilih Jabatan Fungsional --</option>
                                    <?php
                                    $q = mysqli_query($mysqli,"select * from jb_fungsi order by nm_jbfungsi");
                                    while ($a = mysqli_fetch_array($q)){
                                        if ($a[0] ==$kdjbf) {
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