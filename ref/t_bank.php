<?php
$id_bank	= isset($_GET['idb']) ? $_GET['idb'] : NULL;
$mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;	

		if ($mod == "del") {
			$q_delete_agama = mysqli_query($mysqli,"DELETE FROM tbl_bank WHERE id_bank = '$id_bank'");
			if ($q_delete_agama) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Bank Berhasil di hapus<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
			}
		}
		
		// ================ DATA FORM ( POST ) =====================//
		$display 		= "style='display: none'";
		$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;
		$p_id_bank  	= isset($_POST['id_bank']) ? $_POST['id_bank'] : NULL;
		$p_nm_bank	 	= isset($_POST['nm_bank']) ? $_POST['nm_bank'] : NULL;
		
		
		if ($tb_act == "Tambah") {
			$display = "style='display: none'";
			$q_tambah_bank	= mysqli_query($mysqli,"INSERT INTO tbl_bank VALUES ('', '$p_nm_bank')");
			if ($q_tambah_bank) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Bank Berhasil di simpan<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
			}
		} else if ($tb_act == "Edit") {
			$display = "style='display: none'";
			$q_edit_statusp	= mysqli_query($mysqli,"UPDATE tbl_bank SET nm_bank = '$p_nm_bank' WHERE id_bank = '$p_id_bank'");
			if ($q_edit_statusp) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Bank Berhasil di update<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
			}
		} else {	
			$display = "style='display: none'";
		}
?>

		<h3 class="header smaller lighter blue">Referensi Bank Transfer</h3>
		<div class="module_content">
		<h5><a href="?id=bank&mod=add" class="btn btn-primary" >Tambah Data</a></h5>
	
		
			
		<?php		
		// ================ TAMPILKAN DATANYA =====================//
		echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th width='10%'>ID</th><th width='60%'>Bank Transfer</th><th width='30%'>Control</th></tr>";
		$q_bank 	= mysqli_query($mysqli,"SELECT * FROM tbl_bank ORDER BY id_bank ASC") or die (mysqli_error($mysqli));
		$j_data 	= mysqli_num_rows($q_bank);

		if ($j_data == 0) {
			echo "<tr><td id='tengah' colspan='3'>-- Tidak Ada Data --</td></tr>";
		} else {

			while ($a_bank = mysqli_fetch_array($q_bank)) {
				echo "<tr><td id='tengah'>$a_bank[0]</td><td>$a_bank[1]</td>
				<td id='tengah'><a href='?id=bank&mod=edit&idb=$a_bank[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=bank&mod=del&idb=$a_bank[0]' onclick=\"return confirm('Menghapus data $a_bank[1]')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
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
			$q_edit_bank	= mysqli_query($mysqli,"SELECT * FROM tbl_bank WHERE id_bank = '$id_bank'");
			$a_edit_bank	= mysqli_fetch_array($q_edit_bank);
			
			$nm_bank = $a_edit_bank[1];
			$view = "Edit";
			
		} else if ($mod == "add") {
			$display = "";
			$id_bank = "";
			$nm_bank = "";
			$view = "Tambah";
		} else {
			$display = "style='display: none'";
		}

		?>


<div  <?php echo $display;?>>
    <header><h3 class="header smaller lighter blue"><?php echo $view;?> Data Bank Transfer</h3></header>
    <div class="form-group">
        <form action="?id=bank" class="form-horizontal" method="post">
            <table class="tbl_form">

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="kode">ID</label>
                    <div class="col-sm-9">
                        <input type="text" size="3" name="id_bank" readonly value="<?php echo $id_bank; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="kode">Bank Transfer</label>
                    <div class="col-sm-9">
                        <input type="text" size="30" name="nm_bank" value="<?php echo $nm_bank; ?>" required>
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
