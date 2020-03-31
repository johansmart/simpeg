<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5' )

{
    $id_pk	        = isset($_GET['idpk']) ? $_GET['idpk'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL; //

    $p_id_pk  	    = isset($_POST['id_pk']) ? $_POST['id_pk'] : NULL;
    $p_nama_pk 	    = isset($_POST['nmpk']) ? $_POST['nmpk'] : NULL;
    $p_d_pk 	    = isset($_POST['d_pk']) ? $_POST['d_pk'] : NULL;
    $p_thn 	        = isset($_POST['thn']) ? $_POST['thn'] : NULL;
    $p_id_daftar  	= isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL; //
    $p_tgl_awal  	= isset($_POST['tglawal']) ? $_POST['tglawal'] : NULL; //
    $p_tgl_akhir  	= isset($_POST['tglakhir']) ? $_POST['tglakhir'] : NULL; //
    $p_pt  	        = isset($_POST['pt']) ? $_POST['pt'] : NULL; //
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;


    if ($tb_act == "Tambah") {
        $q_tambah_pk	= mysqli_query($mysqli,"INSERT INTO pengalaman_kerja VALUES ('','$p_nama_pk','$p_d_pk','$p_thn','$p_id_daftar','$p_tgl_awal','$p_tgl_akhir','$p_pt')");
        if ($q_tambah_pk > 0) {
            if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pengalaman Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            } else {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pengalaman Berhasil di Ubah <a href='?id=profil'>KEMBALI</a><br/></div>";
            }
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }
    } else if ($tb_act == "Edit") {
        $q_edit_pk	= mysqli_query($mysqli,"UPDATE pengalaman_kerja SET nm_pekerjaan='$p_nama_pk',d_pekerjaan='$p_d_pk',tahun='$p_thn',tgl_awal='$p_tgl_awal',
        tgl_akhir='$p_tgl_akhir',pt='$p_pt' WHERE id_peker = '$p_id_pk'");
        if ($q_edit_pk > 0) {
            if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pengalaman Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            } else {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pengalaman Berhasil di Ubah <a href='?id=profil'>KEMBALI</a><br/></div>";
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
                    Pengalaman Kerja

                </a>
            </li>
        </ul>


        <?php
        if ($mod == "edit") {
            $q_edit_pk	= mysqli_query($mysqli,"SELECT * FROM pengalaman_kerja WHERE id_peker ='$id_pk'");
            $a_edit_pk	= mysqli_fetch_array($q_edit_pk);
            $id_pk  = $a_edit_pk[0];
            $nmpk   = $a_edit_pk[1];
            $d_pk   = $a_edit_pk[2];
            $thn    = $a_edit_pk[3];
            $id_d   = $a_edit_pk[4]; //
            $awal   = $a_edit_pk[5]; //
            $akhir  = $a_edit_pk[6]; //
            $pt     = $a_edit_pk[7]; //
            $view   = "Edit";

        } else if ($mod == "add") {
            $nmpk   = "";
            $d_pk   = "";
            $thn    = "";
            $awal   ="";
            $akhir  ="";
            $pt     ="";
            $view   = "Tambah";
        }


        ?>
        <div class="tab-content profile-edit-tab-content">
            <div id="pk" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
                    <input type="text" name="id_pk" id="id_pk" class="col-xs-10 col-sm-1" hidden="hidden" value="<?php echo $id_pk; ?>" />
                    <input type="text" name="id_daftar" id="id_daftar" class="col-xs-10 col-sm-1"  value="<?php echo $id_d; ?>" hidden/>

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
                        <label class="col-sm-3 control-label no-padding-right"  >Perusahaan :</label>
                        <div class="col-sm-9">
                            <input type="text" name="pt" id="pt" class="col-xs-10 col-sm-5" value="<?php echo $pt; ?>" placeholder="Nama Perusahaan" required/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"  >Nama Pekerjaan / Jabatan :</label>
                        <div class="col-sm-9">
                            <input type="text" name="nmpk" id="nmpk" class="col-xs-10 col-sm-5" value="<?php echo $nmpk; ?>" placeholder="Nama Pekerjaan" required/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Tahun :</label>
                        <div class="col-sm-9">
                            <input type="text" name="thn" id="thn" class="col-xs-10 col-sm-5" value="<?php echo $thn; ?>" placeholder="Tahun" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Detail Pekerjaan :</label>
                        <div class="col-sm-9">
                            <textarea name="d_pk" id="d_pk" class="col-xs-10 col-sm-12" placeholder="Isikan dengan detail pekerjaan "  required/><?php echo $d_pk; ?></textarea
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