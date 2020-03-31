<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2' )

{
    $idgol	        = isset($_GET['idgol']) ? $_GET['idgol'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL;//

    $p_kd_rg  	    = isset($_POST['kd_rg']) ? $_POST['kd_rg'] : NULL;
    $p_id_daftar  	= isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL;
    $p_nosk_rg 	    = isset($_POST['nosk']) ? $_POST['nosk'] : NULL;
    $p_tglrg 	    = isset($_POST['tglrg']) ? $_POST['tglrg'] : NULL;
    $p_tmtrg 	    = isset($_POST['tmtrg']) ? $_POST['tmtrg'] : NULL;
    $p_id_rg 	    = isset($_POST['idgol']) ? $_POST['idgol'] : NULL;
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;


    if ($tb_act == "Tambah") {
        $q_tambah_rj	= mysqli_query($mysqli,"INSERT INTO golongan VALUES ('','$p_nosk_rg','$p_tglrg','$p_tmtrg','$p_id_rg','$p_id_daftar')");
        if ($q_tambah_rj) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Riwayat Jabatan Pegawai Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            mysqli_query($mysqli,"UPDATE pegawai SET id_gol='$p_id_rg' where id='$p_id_daftar'");

        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }
    } else if ($tb_act == "Edit") {
        $q_edit_rj	= mysqli_query($mysqli,"UPDATE golongan SET no_sk='$p_nosk_rg',tgl_sk='$p_tglrg',tmt_tgl='$p_tmtrg',id_gol='$p_id_rg' WHERE kdgol='$p_kd_rg'");
        if ($q_edit_rj >0) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Riwayat Jabatan Pegawai Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            $q_cek          = mysqli_query($mysqli,"SELECT id,kdgol,id_gol FROM golongan WHERE id='$p_id_daftar' and kdgol=(select max(kdgol) from golongan where id='$p_id_daftar')");
            $a_cek	        = mysqli_fetch_array($q_cek);
            mysqli_query($mysqli,"UPDATE pegawai SET id_gol='$a_cek[2]' where id='$a_cek[0]'");
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
                    Riwayat Golongan

                </a>
            </li>
        </ul>


        <?php
        if ($mod == "edit") {

            $q_edit_rg	= mysqli_query($mysqli,"SELECT * FROM golongan WHERE kdgol='$idgol'");
            $a_edit_rg	= mysqli_fetch_array($q_edit_rg);
            $id_rg  = $a_edit_rg[0];
            $nosk   = $a_edit_rg[1];
            $tglrg  = $a_edit_rg[2];
            $tmtrg  = $a_edit_rg[3];
            $id_gol = $a_edit_rg[4];
            $id_d   = $a_edit_rg[5]; //
            $view   = "Edit";

        } else if ($mod == "add") {
            $nosk       = "";
            $tglrg      = "";
            $tmtrg      = "";
            $id_gol     = "";
            $view       = "Tambah";
        }


        ?>
        <div class="tab-content profile-edit-tab-content">
            <div id="rj" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
                    <input type="text" name="kd_rg" id="kd_rg" class="col-xs-10 col-sm-1"  value="<?php echo $id_rg; ?>" hidden/>
                    <input type="text" name="id_daftar" id="id_daftar" class="col-xs-10 col-sm-1"  value="<?php echo $id_d; ?>" hidden/>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >No SK :</label>
                        <div class="col-sm-9">
                            <input type="text" name="nosk" id="nosk" class="col-xs-10 col-sm-5" value="<?php echo $nosk; ?>" placeholder="No SK" required/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal :</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tglrg" value="<?php echo $tglrg;?>" id="tglrg" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal TMT :</label>
                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tmtrg" value="<?php echo $tmtrg;?>" id="tmtrg" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Golongan :</label>
                        <div class="span12">
                            <div class="col-sm-9">
                                <select name="idgol" class="" value="">
                                    <option>-- Pilih Golongan --</option>
                                    <?php
                                    $q = mysqli_query($mysqli,"select * from tbl_gol order by gol ");

                                    while ($a = mysqli_fetch_array($q)){
                                        if ($a[0] ==$id_gol) {
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