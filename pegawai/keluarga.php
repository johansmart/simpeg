<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5' )

{
    $id_kel	        = isset($_GET['idkel']) ? $_GET['idkel'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL;//
    $p_id_daftar  	= isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL; //

    $p_id_kel  	    = isset($_POST['id_kel']) ? $_POST['id_kel'] : NULL;
    $p_nama_kel 	= isset($_POST['nmk']) ? $_POST['nmk'] : NULL;
    $p_ket 	        = isset($_POST['ket']) ? $_POST['ket'] : NULL;
    $p_pekerjaan 	= isset($_POST['pekerjaan']) ? $_POST['pekerjaan'] : NULL;
    $p_tempat 	    = isset($_POST['t_lahir']) ? $_POST['t_lahir'] : NULL;
    $p_tgllahir 	= isset($_POST['tgllahir']) ? $_POST['tgllahir'] : NULL;
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;


    if ($tb_act == "Tambah") {
        $q_tambah_keluarga	= mysqli_query($mysqli,"INSERT INTO keluarga VALUES ('','$p_nama_kel','$p_ket','$p_id_daftar','$p_pekerjaan','$p_tempat','$p_tgllahir')");
        if ($q_tambah_keluarga > 0) {
            if ($_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2') {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            } else {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Simpan <a href='?id=profil'>KEMBALI</a><br/></div>";
            }

        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }

    } else if ($tb_act == "Edit") {
        $q_edit_keluarga	= mysqli_query($mysqli,"UPDATE keluarga SET nm_k='$p_nama_kel',ket='$p_ket',pekerjaan='$p_pekerjaan',tempat_lahir='$p_tempat',tgl_lahirk='$p_tgllahir' WHERE id_k = '$p_id_kel'");
        if ($q_edit_keluarga > 0) {

            if ($_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2') {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
            } else {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Simpan <a href='?id=profil'>KEMBALI</a><br/></div>";
            }

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
                    <i class="green ace-icon fa fa-users bigger-120"></i>
                    Daftar Keluarga

                </a>
            </li>
     </ul>


<?php
if ($mod == "edit") {
    $q_edit_keluarga	= mysqli_query($mysqli,"SELECT * FROM keluarga WHERE id_k ='$id_kel'");
    $a_edit_keluarga	= mysqli_fetch_array($q_edit_keluarga);
    $id_k               = $a_edit_keluarga[0];
    $nmk                = $a_edit_keluarga[1];
    $ket                = $a_edit_keluarga[2];
    $id_d               = $a_edit_keluarga[3]; //
    $pekerjaan          = $a_edit_keluarga[4];
    $tempat_lahir       = $a_edit_keluarga[5];
    $tgl_lahir          = $a_edit_keluarga[6];

    $view = "Edit";

} else if ($mod == "add") {
    $nmk = "";
    $ket = "";
    $pekerjaan="";
    $tempat_lahir="";
    $tgl_lahir="";
    $view = "Tambah";
}


?>
<div class="tab-content profile-edit-tab-content">
<div id="dk" class="tab-pane fade in active">
<form class="form-horizontal" action="" method="post"  role="form" >
<input type="text" name="id_kel" id="id_kel" class="col-xs-10 col-sm-1" hidden="hidden" value="<?php echo $id_k; ?>" />
    <input type="text" name="id_daftar" id="id_daftar" class="col-xs-10 col-sm-1"  value="<?php echo $id_d; ?>" hidden/>



    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="nip" >Nama Keluarga :</label>
        <div class="col-sm-9">
            <input type="text" name="nmk" id="nmk" class="col-xs-10 col-sm-5" value="<?php echo $nmk; ?>" placeholder="Nama Keluarga" required/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="nip" >Status :</label>
        <div class="col-sm-9">
            <input type="text" name="ket" id="ket" class="col-xs-10 col-sm-5" placeholder="Suami/Istri/Anak Pertama/Anak Kedua/dst " value="<?php echo $ket; ?>" required/>
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="nip" >Pekerjaan :</label>
        <div class="col-sm-9">
            <input type="text" name="pekerjaan" id="pekerjaan" class="col-xs-10 col-sm-5" placeholder="Kosongkan bila tidak ada " value="<?php echo $pekerjaan; ?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="nip" >Tempat Lahir :</label>
        <div class="col-sm-9">
            <input type="text" name="t_lahir" id="t_lahir" class="col-xs-10 col-sm-5" placeholder="Tempat Lahir " value="<?php echo $tempat_lahir; ?>" required/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Lahir:</label>

        <div class="col-xs-8 col-sm-3">
            <div class="input-group">
                <input class="form-control date-picker" name="tgllahir" value="<?php echo $tgl_lahir;?>" id="tgllahir" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
            </div>
        </div>

    </div>


    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" ></label>
        <div class="col-sm-9">
            <input type="submit" class="btn btn-info" name="tb_act" id="simpan" value="<?php echo $view; ?>" />
            <a href="javascript:history.back(-2)" class="btn btn-danger"/>Kembali</a>
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