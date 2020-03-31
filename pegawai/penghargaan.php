<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2' )

{
    $id_pg	        = isset($_GET['idpg']) ? $_GET['idpg'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL;//
    $p_id_daftar  	= isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL; //
    $p_id_pg  	    = isset($_POST['id_pg']) ? $_POST['id_pg'] : NULL;
    $p_nm_pg 	    = isset($_POST['nm_pg']) ? $_POST['nm_pg'] : NULL;
    $p_no_sk	    = isset($_POST['no_sk']) ? $_POST['no_sk'] : NULL;
    $p_tgl_sk 	    = isset($_POST['tgl_sk']) ? $_POST['tgl_sk'] : NULL;
    $p_ins	        = isset($_POST['ins']) ? $_POST['ins'] : NULL;
    $p_thn 	        = isset($_POST['thn']) ? $_POST['thn'] : NULL;
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;


    if ($tb_act == "Tambah") {
        $q_tambah_penghargaan	= mysqli_query($mysqli,"INSERT INTO penghargaan VALUES ('','$p_nm_pg','$p_no_sk','$p_tgl_sk','$p_ins','$p_thn','$p_id_daftar')");
        if ($q_tambah_penghargaan) {

            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Penghargaan Pegawai Berhasil di Simpan  <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";

        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }
    } else if ($tb_act == "Edit") {
        $q_edit_penghargaan	= mysqli_query($mysqli,"UPDATE penghargaan SET nm_penghargaan='$p_nm_pg',no_sk='$p_no_sk',tgl_sk='$p_tgl_sk',instansi='$p_ins',tahun='$p_thn' WHERE id_penghargaan = '$p_id_pg'");
        if ($q_edit_penghargaan) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Penghargaan Pegawai Berhasil di Ubah  <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
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
            $q_edit_penghargaan	= mysqli_query($mysqli,"SELECT * FROM penghargaan WHERE id_penghargaan ='$id_pg'");
            $a_edit_penghargaan	= mysqli_fetch_array($q_edit_penghargaan);
            $id_pg  = $a_edit_penghargaan[0];
            $nm_pg  = $a_edit_penghargaan[1];
            $no_sk  = $a_edit_penghargaan[2];
            $tgl_sk = $a_edit_penghargaan[3];
            $ins    = $a_edit_penghargaan[4];
            $thn    = $a_edit_penghargaan[5];
            $id_d   = $a_edit_penghargaan[6]; //
            $view   = "Edit";

        } else if ($mod == "add") {
            $nipt= isset($_GET['id_nip']) ? $_GET['id_nip'] : NULL;
            $nm_pg = "";
            $no_sk = "";
            $tgl_sk = "";
            $ins = "";
            $thn = "";
            $view = "Tambah";
        }


        ?>
        <div class="tab-content profile-edit-tab-content">
            <div id="dk" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
                    <input type="text" name="id_pg" id="id_pg" class="col-xs-10 col-sm-1" hidden="hidden" value="<?php echo $id_pg; ?>" />
                    <input type="text" name="id_daftar" id="id_daftar" class="col-xs-10 col-sm-1"  value="<?php echo $id_d; ?>" hidden/>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Nama Penghargaan :</label>
                        <div class="col-sm-9">
                            <input type="text" name="nm_pg" id="nm_pg" class="col-xs-10 col-sm-5" value="<?php echo $nm_pg; ?>" placeholder="Nama Penghargaan" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >No SK :</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_sk" id="no_sk" class="col-xs-10 col-sm-5" value="<?php echo $no_sk; ?>" placeholder="No SK" required/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal SK:</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tgl_sk" value="<?php echo $tgl_sk;?>" id="tgl_sk" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Instansi :</label>
                        <div class="col-sm-9">
                            <input type="text" name="ins" id="ins" class="col-xs-10 col-sm-5" placeholder="Instansi" value="<?php echo $ins; ?>" required/>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Tahun :</label>
                        <div class="col-sm-9">
                            <input type="text" name="thn" id="thn" class="col-xs-10 col-sm-5" placeholder="tahun" value="<?php echo $thn; ?>" required/>
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