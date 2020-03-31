<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2' )

{
    $idrj	        = isset($_GET['idrj']) ? $_GET['idrj'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL;//

    $p_id_rj  	    = isset($_POST['id_rj']) ? $_POST['id_rj'] : NULL;
    $p_id_daftar  	= isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL;
    $p_kd_rj 	    = isset($_POST['kdrj']) ? $_POST['kdrj'] : NULL;
    $p_tglrj 	    = isset($_POST['tglrj']) ? $_POST['tglrj'] : NULL;
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;


    if ($tb_act == "Tambah") {
        $q_tambah_rj	= mysqli_query($mysqli,"INSERT INTO h_jabatan VALUES ('','$p_tglrj','$p_kd_rj','$p_id_daftar')");
        if ($q_tambah_rj) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Riwayat Jabatan Pegawai Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            mysqli_query($mysqli,"UPDATE pegawai SET id_jab='$p_kd_rj',tgl_jab='$p_tglrj' where id='$p_id_daftar'");

        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }
    } else if ($tb_act == "Edit") {


        $q_edit_rj	= mysqli_query($mysqli,"UPDATE h_jabatan SET tgl_jab='$p_tglrj',kode='$p_kd_rj' WHERE idh = '$p_id_rj'");
        if ($q_edit_rj >0) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Riwayat Jabatan Pegawai Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            $q_cek          =mysqli_query($mysqli,"SELECT id,tgl_jab,kode FROM h_jabatan WHERE id='$p_id_daftar' and idh=(select max(idh) from h_jabatan where id='$p_id_daftar')");
            $a_cek	        = mysqli_fetch_array($q_cek);
            mysqli_query($mysqli,"UPDATE pegawai SET id_jab='$a_cek[2]',tgl_jab='$a_cek[1]' where id='$a_cek[0]'");
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
                    Riwayat Jabatan

                </a>
            </li>
        </ul>


        <?php
        if ($mod == "edit") {

            $q_edit_rj	= mysqli_query($mysqli,"SELECT * FROM h_jabatan WHERE idh ='$idrj'");
            $a_edit_rj	= mysqli_fetch_array($q_edit_rj);
            $id_rj  = $a_edit_rj[0];
            $tglrj  = $a_edit_rj[1];
            $kdrj   = $a_edit_rj[2];
            $id_d   = $a_edit_rj[3]; //
            $view   = "Edit";

        } else if ($mod == "add") {
            $tglrj      = "";
            $kdrj       = "";
            $view       = "Tambah";
        }


        ?>
        <div class="tab-content profile-edit-tab-content">
            <div id="rj" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
                    <input type="text" name="id_rj" id="id_rj" class="col-xs-10 col-sm-1"  value="<?php echo $id_rj; ?>" hidden/>
                    <input type="text" name="id_daftar" id="id_daftar" class="col-xs-10 col-sm-1"  value="<?php echo $id_d; ?>" hidden/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Jabatan:</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tglrj" value="<?php echo $tglrj;?>" id="tglrj" type="text" data-date-format="yyyy-mm-dd"/>
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
                                <select name="kdrj" class="" value="">
                                <option>-- Pilih Jabatan --</option>
                                <?php
                                $q = mysqli_query($mysqli,"select * from jabatan order by n_jab ");

                                while ($a = mysqli_fetch_array($q)){
                                    if ($a[1] ==$kdrj) {
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