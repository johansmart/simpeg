<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5' )

{
    $id_ub	        = isset($_GET['idub']) ? $_GET['idub'] : NULL;
    $id_d	        = isset($_GET['id_d']) ? $_GET['id_d'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;

    $p_id_ub  	    = isset($_POST['idub']) ? $_POST['idub'] : NULL;
    $p_id_berkas 	= isset($_POST['id_berkas']) ? $_POST['id_berkas'] : NULL;
    $p_id_daftar    = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : NULL;
	$nama_file		=$_FILES['file']['name'];
	$size_file 		=$_FILES['file']['size'];
	$type_file		=pathinfo($nama_file);
	
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;


    if ($tb_act == "Tambah") {
		if ($size_file >= 2000000){
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Maaf file tidak boleh melebihi 2mb<br/></div>";
			
		} else if($size_file == 0) {
             $q_tambah = mysqli_query($mysqli, "INSERT INTO tbl_upload_berkas VALUES ('','$p_id_berkas',NOW(),'',$p_id_daftar')");
                    if ($q_tambah > 0) {
                        if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
                        } else {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pendidikan Pegawai Berhasil di Simpan <a href='?id=profil'>KEMBALI</a><br/></div>";
                        }

                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                    }
        }else {
            if ($type_file['extension']=='pdf') {
                $uploaddir = './pdfupload/';
                $alamatfile = $uploaddir . $nama_file;
                if (move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile)) {
                  
                    $q_tambah = mysqli_query($mysqli, "INSERT INTO tbl_upload_berkas VALUES ('','$p_id_berkas',NOW(),'$alamatfile','$p_id_daftar')");
                    if ($q_tambah > 0) {
                        if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Berkas Pegawai Berhasil di Simpan <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
                        } else {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Berkas Pegawai Berhasil di Simpan <a href='?id=profil'>KEMBALI</a><br/></div>";
                        }

                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                    }
                }
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Maaf hanya file PDF yang bisa di upload<br/></div>";
            }
        }
		
		
    } else if ($tb_act == "Edit") {
        if ($size_file >= 2000000){
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Maaf file tidak boleh melebihi 2mb<br/></div>";

        }
        if ($size_file == 0){

            $q_edit	= mysqli_query($mysqli,"UPDATE tbl_upload_berkas SET id_berkas='$p_id_berkas',tgl_upload=NOW(),id='$p_id_daftar' WHERE idub = '$p_id_ub'");
            if ($q_edit > 0) {
                if ($_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2') {
                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Berkas Pegawai Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
                } else {
                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Berkas Pegawai Berhasil di Ubah <a href='?id=profil'>KEMBALI</a><br/></div>";
                }

            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
            }
        } else {

            if ($type_file['extension']=='pdf') {
                $uploaddir = './pdfupload/';
                $alamatfile = $uploaddir . $nama_file;
                if (move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile)) {
                    $q_edit    = mysqli_query($mysqli,"UPDATE tbl_upload_berkas SET id_berkas='$p_id_berkas',tgl_upload=NOW(),id='$p_id_daftar',file='$alamatfile' WHERE idub = '$p_id_ub'");
                    
                    if ($q_edit > 0) {
                        if ($_SESSION['leveluser'] == '1' || $_SESSION['leveluser'] == '2') {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Berkas Pegawai Berhasil di Ubah <a href='?id=tambahpeg&mod=edit&id_n=$p_id_daftar'>KEMBALI</a><br/></div>";
                        } else {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Berkas Pegawai Berhasil di Ubah <a href='?id=profil'>KEMBALI</a><br/></div>";
                        }

                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                    }
                }
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Maaf hanya file PDF yang bisa di upload<br/></div>";
            }
        }



    }


    ?>

    <div class="col-sm-12">
    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#dk">
                    <i class="green ace-icon fa fa-bookmark bigger-120"></i>
                    Upload Berkas

                </a>
            </li>
        </ul>


        <?php
        if ($mod == "edit") {
            $q_edit	= mysqli_query($mysqli,"SELECT * FROM tbl_upload_berkas WHERE idub ='$id_ub'");
            $a_edit	= mysqli_fetch_array($q_edit);
            $id_ub               = $a_edit[0];
            $id_berkas           = $a_edit[1];
            $id_d                = $a_edit[4];
            $view               = "Edit";

        } else if ($mod == "add") {
            $id_ub               = $a_edit[0];
            $id_berkas           = $a_edit[1];
            $view = "Tambah";
        }


        ?>
        <div class="tab-content profile-edit-tab-content">
            <div id="dk" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" enctype="multipart/form-data" >
                    <input type="text" name="idub" id="idub" class="col-xs-10 col-sm-1" hidden="hidden" value="<?php echo $id_ub; ?>" />
                    <input type="text" name="id_daftar" id="id_daftar" hidden="hidden" class="col-xs-10 col-sm-1"  value="<?php echo $id_d; ?>"  />
                  

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Nama Berkas :</label>
                        <div class="span12">
                            <div class="col-sm-9">
                                <select name="id_berkas" >
                                    <option>-- Pilih Nama Berkas --</option>
                                    <?php
                                    $q = mysqli_query($mysqli,"select * from tbl_berkas ");

                                    while ($a = mysqli_fetch_array($q)){
                                        if ($a[0] ==$id_berkas) {
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
                        <label class="col-sm-3 control-label no-padding-right" for="nip" >Upload Scan Ijazah :</label>
                        <div class="col-sm-9">
                            <input type="file" name="file" id="file" /> * Harus dalam bentuk PDF & Tidak boleh melebihi 200 Kb
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