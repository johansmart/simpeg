<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2' )

{
    $idjbs	        = isset($_GET['idjbs']) ? $_GET['idjbs'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL;//

    $p_id_jbs  	    = isset($_POST['id_jbs']) ? $_POST['id_jbs'] : NULL;
    $p_id_daftar  	= isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL;
    $p_kd_jbs 	    = isset($_POST['kdjbs']) ? $_POST['kdjbs'] : NULL;
    $p_tgl_jbs 	    = isset($_POST['tgljbs']) ? $_POST['tgljbs'] : NULL;
    $p_no_sk 	    = isset($_POST['nosk']) ? $_POST['nosk'] : NULL;
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;


    if ($tb_act == "Tambah") {
        $q_tambah_jbs	= mysqli_query($mysqli,"INSERT INTO h_jbstruk VALUES ('','$p_kd_jbs','$p_tgl_jbs','$p_no_sk','$p_id_daftar')");
        if ($q_tambah_jbs) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Riwayat Jabatan Struktural Pegawai Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            mysqli_query($mysqli,"UPDATE pegawai SET kd_jbstruk='$p_kd_jbs' where id='$p_id_daftar'");

        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }
    } else if ($tb_act == "Edit") {
        $q_edit_jbs	= mysqli_query($mysqli,"UPDATE h_jbstruk SET kd_jbstruk='$p_kd_jbs',tgl_tmt_sk='$p_tgl_jbs',no_sk='$p_no_sk' WHERE idjs = '$p_id_jbs'");
        if ($q_edit_jbs >0) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Riwayat Jabatan Struktural Pegawai Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            $q_cek          =mysqli_query($mysqli,"SELECT id,kd_jbstruk FROM h_jbstruk WHERE id='$p_id_daftar' and idjs=(select max(idjs) from h_jbstruk where id='$p_id_daftar')");
            $a_cek	        = mysqli_fetch_array($q_cek);
            mysqli_query($mysqli,"UPDATE pegawai SET kd_jbstruk='$a_cek[1]' where id='$a_cek[0]'");
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
                    Riwayat Jabatan Struktural

                </a>
            </li>
        </ul>


        <?php
        if ($mod == "edit") {

            $q_edit_jbs	= mysqli_query($mysqli,"SELECT * FROM h_jbstruk WHERE idjs ='$idjbs'");
            $a_edit_jbs	= mysqli_fetch_array($q_edit_jbs);
            $id_jbs  = $a_edit_jbs[0];
            $kdjbs   = $a_edit_jbs[1];
            $tgljbs  = $a_edit_jbs[2];
            $no_sk   = $a_edit_jbs[3];
            $id_d   = $a_edit_jbs[4]; //
            $view   = "Edit";

        } else if ($mod == "add") {
            $kdjbs   = "";
            $tgljbs  = "";
            $no_sk   = "";
            $view    = "Tambah";
        }


        ?>
        <div class="tab-content profile-edit-tab-content">
            <div id="rj" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
                    <input type="text" name="id_jbs" id="id_jbs" class="col-xs-10 col-sm-1"  value="<?php echo $id_jbs; ?>" hidden/>
                    <input type="text" name="id_daftar" id="id_daftar" class="col-xs-10 col-sm-1"  value="<?php echo $id_d; ?>" hidden/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Jabatan Struktural:</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tgljbs" value="<?php echo $tgljbs;?>" id="tgljbs" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">No SK:</label>

                        <div class="col-xs-8 col-sm-3">
                            <input type="text" name="nosk" id="nosk" class="col-xs-10 col-sm-5"  value="<?php echo $no_sk; ?>" required/>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Jabatan Struktural :</label>
                        <div class="span12">
                            <div class="col-sm-9">
                                <select name="kdjbs" class="" value="">
                                <option>-- Pilih Jabatan Struktural --</option>
                                <?php
                                $q = mysqli_query($mysqli,"select * from jb_struk order by nm_jbstruk");
                                while ($a = mysqli_fetch_array($q)){
                                    if ($a[0] ==$kdjbs) {
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