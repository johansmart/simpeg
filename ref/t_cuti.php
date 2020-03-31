<?php
$id_cuti	= isset($_GET['idcuti']) ? $_GET['idcuti'] : NULL;
$mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;	

		if ($mod == "del") {
			$q_delete_cuti = mysqli_query($mysqli,"DELETE FROM tbl_cuti WHERE id_cuti= '$id_cuti'");
			if ($q_delete_cuti) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Cuti Berhasil di hapus<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
			}
		}
		
	
		$display 		= "style='display: none'"; 	
		$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;				
		$p_id_cuti  	= isset($_POST['id_cuti']) ? $_POST['id_cuti'] : NULL;
		$p_nama_cuti 	= isset($_POST['n_cuti']) ? $_POST['n_cuti'] : NULL;
        $p_jatah_cuti 	= isset($_POST['jatah_cuti']) ? $_POST['jatah_cuti'] : NULL;
		
		
		if ($tb_act == "Tambah") {
			$display = "style='display: none'";
			$q_tambah_cuti	= mysqli_query($mysqli,"INSERT INTO tbl_cuti VALUES ('','$p_nama_cuti','$p_jatah_cuti')");
			if ($q_tambah_cuti) {
			
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Cuti Berhasil di simpan<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
			}
		} else if ($tb_act == "Edit") {
			$display = "style='display: none'";
			$q_edit_cuti	= mysqli_query($mysqli,"UPDATE tbl_cuti SET id_cuti = '$p_id_cuti', n_cuti='$p_nama_cuti',jatah_cuti='$p_jatah_cuti' WHERE id_cuti = '$p_id_cuti'");
			if ($q_edit_cuti) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Cuti Berhasil di update<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
			}
		} else {	
			$display = "style='display: none'";
		}
?>

		<h3 class="header smaller lighter blue">Referensi Cuti</h3>
		<div class="module_content">
		<h5><a href="?id=cuti&mod=add" class="btn btn-primary" >Tambah Data</a></h5>
	
		
			
		<?php		
		// ================ TAMPILKAN DATANYA =====================//
		echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Cuti</th><th>Jatah Cuti</th><th>Control</th></tr>";
		$q_cuti 	= mysqli_query($mysqli,"SELECT * FROM tbl_cuti ORDER BY id_cuti ASC") or die (mysqli_error($mysqli));
		$j_data 	= mysqli_num_rows($q_cuti);

		if ($j_data == 0) {
			echo "<tr><td colspan='3'>-- Tidak Ada Data --</td></tr>";
		} else {
			while ($a_cuti = mysqli_fetch_array($q_cuti)) {
				echo "<tr>
				<td>$a_cuti[0]</td>
				<td>$a_cuti[1]</td>
				<td>$a_cuti[2]</td>
				<td><a href='?id=cuti&mod=edit&idcuti=$a_cuti[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=cuti&mod=del&idcuti=$a_cuti[0]' onclick=\"return confirm('Menghapus data $a_cuti[1]')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
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
			$q_edit_cuti	= mysqli_query($mysqli,"SELECT * FROM tbl_cuti WHERE id_cuti = '$id_cuti'");
			$a_edit_cuti	= mysqli_fetch_array($q_edit_cuti);

			$n_cuti = $a_edit_cuti[1];
            $j_cuti = $a_edit_cuti[2];
			$view = "Edit";
			
		} else if ($mod == "add") {
			$display = "";
			$id_cuti = "";
			$n_cuti = "";
            $j_cuti = "";
			$view = "Tambah";
		} else {
			$display = "style='display: none'";
		}

		?>


<div  <?php echo $display;?>>
    <header><h3 class="header smaller lighter blue"><?php echo $view;?> Data Cuti</h3></header>
    <div class="form-group">
        <form action="?id=cuti" class="form-horizontal" method="post" id="ft_kpkrn">
            <table class="tbl_form">

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="kode">ID</label>
                    <div class="col-sm-9">
                        <input type="text" size="3" name="id_cuti" readonly value="<?php echo $id_cuti; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="kode">Cuti</label>
                    <div class="col-sm-9">
                        <input type="text" size="30" name="n_cuti" value="<?php echo $n_cuti; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="kode">Jatah Cuti</label>
                    <div class="col-sm-9">
                        <input type="text" size="5" name="jatah_cuti" value="<?php echo $j_cuti; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="kode"></label>
                    <div class="col-sm-9">
                        <input type="submit" class="btn btn-primary" name="tb_act" value="<?php echo $view; ?>">
                    </div>
                </div>

            </table>
    </div>
</div>