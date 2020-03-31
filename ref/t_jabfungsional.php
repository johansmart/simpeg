<?php
$kdjbfungsi	= isset($_GET['kdjbfungsi']) ? $_GET['kdjbfungsi'] : NULL;
$mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;	

		if ($mod == "del") {
			$q_delete_jbfungsi = mysqli_query($mysqli,"DELETE FROM jb_fungsi WHERE kd_jbfungsi='$kdjbfungsi'");
			if ($q_delete_jbfungsi) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Jabatan Fungsional Berhasil di hapus<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		}
		
	
		$display 		 = "style='display: none'";
		$tb_act 		 = isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;
		$p_id_jbfungsi   = isset($_POST['kdjbfungsi']) ? $_POST['kdjbfungsi'] : NULL;
		$p_nm_jbfungsi   = isset($_POST['nmjbfungsi']) ? $_POST['nmjbfungsi'] : NULL;
        $p_kls_jbfungsi  = isset($_POST['klsjbfungsi']) ? $_POST['klsjbfungsi'] : NULL;
        $p_t_pensiun     = isset($_POST['t_pensiun']) ? $_POST['t_pensiun'] : NULL;
		
		
		if ($tb_act == "Tambah") {
			$display = "style='display: none'";
			$q_tambah_jbfungsi	= mysqli_query($mysqli,"INSERT INTO jb_fungsi VALUES ('','$p_nm_jbfungsi','$p_kls_fungsi','$p_t_pensiun')");
			if ($q_tambah_jbfungsi >0) {
			
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Jabatan Fungsional Berhasil di simpan<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else if ($tb_act == "Edit") {
			$display = "style='display: none'";
			$q_edit_jbfungsi	= mysqli_query($mysqli,"UPDATE jb_fungsi SET  nm_jbfungsi='$p_nm_jbfungsi',kls_fungsi='$p_kls_jbfungsi',t_pensiun='$p_t_pensiun' WHERE kd_jbfungsi ='$p_id_jbfungsi'");
			if ($q_edit_jbfungsi >0) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Jabatan Fungsional Berhasil di update<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else {
			$display = "style='display: none'";
		}
?>

		<h3 class="header smaller lighter blue">Referensi Jabatan Fungsional</h3>
		<div class="module_content">
		<h5><a href="?id=jbf&mod=add" class="btn btn-primary" >Tambah Data</a></h5>
	
		
			
		<?php		
		// ================ TAMPILKAN DATANYA =====================//
		echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th width='10%'>ID</th><th width='50%'>Jabatan Fungsional</th><th width='10%'>Kelas</th><th width='10%'>Umur Pensiun</th><th width='30%'>Control</th></tr>";
		$q_jbfungsi 	= mysqli_query($mysqli,"SELECT * FROM jb_fungsi ORDER BY kd_jbfungsi ASC") or die (mysqli_error($mysqli));
		$j_data 	= mysqli_num_rows($q_jbfungsi);

		if ($j_data == 0) {
			echo "<tr><td id='tengah' colspan='3'>-- Tidak Ada Data --</td></tr>";
		} else {
			$no = 1;
			while ($a_jbfungsi = mysqli_fetch_array($q_jbfungsi)) {
				echo "<tr>
				<td id='tengah'>$a_jbfungsi[0]</td>
				<td>$a_jbfungsi[1]</td>
				<td>$a_jbfungsi[2]</td>
				<td>$a_jbfungsi[3]</td>
				<td><a href='?id=jbf&mod=edit&kdjbfungsi=$a_jbfungsi[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=jbf&mod=del&kdjbfungsi=$a_jbfungsi[0]' onclick=\"return confirm('Menghapus data $a_jbfungsi[1]')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
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
			$q_edit_jbfungsi	= mysqli_query($mysqli,"SELECT * FROM jb_fungsi WHERE kd_jbfungsi = '$kdjbfungsi'");
			$a_edit_jbfungsi	= mysqli_fetch_array($q_edit_jbfungsi);
            $id_jbfungsi =$a_edit_jbfungsi[0];
			$n_jbfungsi = $a_edit_jbfungsi[1];
            $k_jbfungsi = $a_edit_jbfungsi[2];
            $t_pensiun = $a_edit_jbfungsi[3];
			$view = "Edit";
			
		} else if ($mod == "add") {
			$display = "";
			$id_jbfungsi = "";
			$n_jbfungsi = "";
            $k_jbfungsi ="";
            $t_pensiun ="";
			$view = "Tambah";
		} else {
			$display = "style='display: none'";
		}

		?>

<div  <?php echo $display;?>>
	<header><h3 class="header smaller lighter blue"><?php echo $view;?> Data Jabatan Fungsional</h3></header>
		<div class="form-group">
		<form action="?id=jbf" class="form-horizontal" method="post" id="ft_kpkrn">
		<table class="tbl_form">

            <div class="form-group" style='display: none'>
                <label class="col-sm-2 control-label no-padding-right" for="kode">ID</label>
                <div class="col-sm-9">
                    <input type="text" size="3" name="kdjbfungsi" readonly value="<?php echo $id_jbfungsi; ?>">
                </div>
            </div>

            <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="kode">Jabatan Fungsional</label>
                    <div class="col-sm-9">
                        <input type="text" size="30" name="nmjbfungsi" value="<?php echo $n_jbfungsi; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="kode">Kelas</label>
                <div class="col-sm-3">
                    <input type="text" size="30" name="klsjbfungsi" value="<?php echo $k_jbfungsi; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="kode">Umur Pensiun</label>
                <div class="col-sm-3">
                    <input type="text" size="30" name="t_pensiun" value="<?php echo $t_pensiun; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="kode"></label>
                <div class="col-sm-9">
                    <input type="submit" class="btn btn-primary" name="tb_act" value="<?php echo $view; ?>">
                </div>
            </div>

		</table>
		</div>
</div>
