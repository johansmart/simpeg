<?php
$id_agama	= isset($_GET['idagm']) ? $_GET['idagm'] : NULL;
$mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;	

		if ($mod == "del") {
			$q_delete_agama = mysqli_query($mysqli,"DELETE FROM tbl_agama WHERE id_agm = '$id_agama'");
			if ($q_delete_agama) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Agama Berhasil di hapus<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
			}
		}
		
		// ================ DATA FORM ( POST ) =====================//
		$display 		= "style='display: none'"; 	//default = formnya dihidden
		$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;				//ambil variabel POST value Tombol FOrm
		$p_id_agama   	= isset($_POST['id_agama']) ? $_POST['id_agama'] : NULL;			//ambil variabel POST id_agama
		$p_nama_agama 	= isset($_POST['nama_agama']) ? $_POST['nama_agama'] : NULL;		//ambil variabel POST nama_agama
		
		
		if ($tb_act == "Tambah") {
			$display = "style='display: none'";
			$q_tambah_agama	= mysqli_query($mysqli,"INSERT INTO tbl_agama VALUES ('', '$p_nama_agama')");
			if ($q_tambah_agama) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Agama Berhasil di simpan<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else if ($tb_act == "Edit") {
			$display = "style='display: none'";
			$q_edit_agama	= mysqli_query($mysqli,"UPDATE tbl_agama SET nmagama = '$p_nama_agama' WHERE id_agm = '$p_id_agama'");
			if ($q_edit_agama) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Agama Berhasil di update<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else {	
			$display = "style='display: none'";
		}
?>

		<h3 class="header smaller lighter blue">Referensi Agama</h3>
		<div class="module_content">
		<h5><a href="?id=agama&mod=add" class="btn btn-primary" >Tambah Data</a></h5>
	
		
			
		<?php		
		// ================ TAMPILKAN DATANYA =====================//
		echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th width='10%'>ID</th><th width='60%'>Agama</th><th width='30%'>Control</th></tr>";
		$q_agama 	= mysqli_query($mysqli,"SELECT * FROM tbl_agama ORDER BY id_agm ASC") or die (mysql_error());
		$j_data 	= mysqli_num_rows($q_agama);

		if ($j_data == 0) {
			echo "<tr><td id='tengah' colspan='3'>-- Tidak Ada Data --</td></tr>";
		} else {

			while ($a_agama = mysqli_fetch_array($q_agama)) {
				echo "<tr><td id='tengah'>$a_agama[0]</td><td>$a_agama[1]</td>
				<td id='tengah'><a href='?id=agama&mod=edit&idagm=$a_agama[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=agama&mod=del&idagm=$a_agama[0]' onclick=\"return confirm('Menghapus data $a_agama[1]')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
				</tr>";
				$no++;
			}
		}
		echo "</table>";
		?>

		</div>


		<?php
		// ================ DATA URL "mod" ( GET ) =====================//

		if ($mod == "edit") {
			$display = "";
			$q_edit_agm	= mysqli_query($mysqli,"SELECT * FROM tbl_agama WHERE id_agm = '$id_agama'");
			$a_edit_agm	= mysqli_fetch_array($q_edit_agm);
			
			$nama_agama = $a_edit_agm[1];
			$view = "Edit";
			
		} else if ($mod == "add") {
			$display = "";
			$id_agama = "";
			$nama_agama = "";
			$view = "Tambah";
		} else {
			$display = "style='display: none'";
		}

		?>

<div class="module width_full" <?php echo $display;?>>
	<header><h3 class="header smaller lighter blue"><?php echo $view;?> Data Agama</h3></header>
		<div class="module_content">
		<form action="?id=agama" method="post" class="form-horizontal" id="ft_agama">
            <div class="form-group" style='display: none'>
                <div class="col-sm-9">
                    <input type="text" size="3" name="id_agama" readonly value="<?php echo $id_agama; ?>">
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="kode">Nama Agama</label>
                <div class="col-sm-9">
                    <input type="text" size="30" name="nama_agama" value="<?php echo $nama_agama; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="kode"></label>
                <div class="col-sm-9">
                    <input type="submit" class="btn btn-primary" name="tb_act" value="<?php echo $view; ?>">
                </div>
            </div>
        </form>
            </div>
    </div>


