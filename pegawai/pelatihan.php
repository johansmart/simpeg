<?php
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5' )


{
    $id_pl	        = isset($_GET['idpl']) ? $_GET['idpl'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL; //
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;

    $p_id_pl  	    = isset($_POST['id_pl']) ? $_POST['id_pl'] : NULL;
    $p_id_daftar  	= isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL; //
    $p_tglpl 	    = isset($_POST['tglpl']) ? $_POST['tglpl'] : NULL;
    $p_topikpl 	    = isset($_POST['topikpl']) ? $_POST['topikpl'] : NULL;
    $p_pypl 	    = isset($_POST['pypl']) ? $_POST['pypl'] : NULL;
    $p_jam 	        = isset($_POST['jam']) ? $_POST['jam'] : NULL;
    $p_tempat 	    = isset($_POST['tempat']) ? $_POST['tempat'] : NULL;
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;


    if ($tb_act == "Tambah") {
        $q_tambah_pl	= mysqli_query($mysqli,"INSERT INTO pelatihan VALUES ('','$p_tglpl','$p_topikpl','$p_pypl','$p_id_daftar','$p_tempat','$p_jam')");
        if ($q_tambah_pl > 0) {
            if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pelatihan Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            } else {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pelatihan Berhasil di Simpan <a href='?id=profil'>KEMBALI</a><br/></div>";
            }

        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
        }
    } else if ($tb_act == "Edit") {
        $q_edit_pl	= mysqli_query($mysqli,"UPDATE pelatihan SET  tgl_pelatihan='$p_tglpl',topik_pelatihan='$p_topikpl',tempat='$p_tempat', jam='$p_jam' WHERE id_pelatihan = '$p_id_pl'");
        if ($q_edit_pl > 0) {
            if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pelatihan Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            } else {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pelatihan Berhasil di Ubah <a href='?id=profil'>KEMBALI</a><br/></div>";
            }

        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
        }
    }


    ?>

    <div class="col-sm-12">
    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#pl">
                    <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
                    Pelatihan

                </a>
            </li>
        </ul>


        <?php
        if ($mod == "edit") {
            $q_edit_pl	= mysqli_query($mysqli,"SELECT * FROM pelatihan WHERE id_pelatihan ='$id_pl'");
            $a_edit_pl	= mysqli_fetch_array($q_edit_pl);
            $id_pl      = $a_edit_pl[0];
            $tglpl      = $a_edit_pl[1];
            $topikpl    = $a_edit_pl[2];
            $pypl       = $a_edit_pl[3];
            $id_d       = $a_edit_pl[4]; //
            $tempat       = $a_edit_pl[5]; //
            $jam       = $a_edit_pl[6]; //

            $view       = "Edit";

        } else if ($mod == "add") {
            $id_pl = "";
            $tglpl= "";
            $topikpl = "";
            $pypl = "";
            $tempat="";
            $jam ="";
            $view = "Tambah";
        }


        ?>
        <div class="tab-content profile-edit-tab-content">
            <div id="pl" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
                    <input type="text" name="id_pl" id="id_pl" class="col-xs-10 col-sm-1" hidden="hidden" value="<?php echo $id_pl; ?>" />
                    <input type="text" name="id_daftar" id="id_daftar" class="col-xs-10 col-sm-1"  value="<?php echo $id_d; ?>" hidden/>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Pelatihan:</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tglpl" value="<?php echo $tglpl;?>" id="tglpl" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Topik Pelatihan :</label>

                        <div class="col-sm-9">
                            <input type="text" name="topikpl" id="topikpl" class="col-xs-10 col-sm-5" placeholder="Topik Pelatihan" value="<?php echo $topikpl; ?>" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Penyelengara :</label>

                        <div class="col-sm-9">
                            <input type="text" name="pypl" id="pypl" class="col-xs-10 col-sm-3" placeholder="Penyelengara" value="<?php echo $pypl; ?>" required/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Tempat :</label>

                        <div class="col-sm-9">
                            <input type="text" name="tempat" id="tempat" class="col-xs-10 col-sm-3" placeholder="Tempat" value="<?php echo $tempat; ?>" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Jam / hari:</label>

                        <div class="col-sm-9">
                            <input type="text" name="jam" id="jam" class="col-xs-10 col-sm-3" placeholder="Jam" value="<?php echo $jam; ?>" required/>
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