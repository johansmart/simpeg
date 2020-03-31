<?php
$id_berkas	= isset($_GET['id_berkas']) ? $_GET['id_berkas'] : NULL;
$mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;	

		if ($mod == "del") {
			$q_delete_agama = mysqli_query($mysqli,"DELETE FROM tbl_berkas WHERE id_berkas = '$id_berkas'");
			if ($q_delete_agama) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Berkas Berhasil di hapus<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
			}
		}
		
		// ================ DATA FORM ( POST ) =====================//
		$display 		= "style='display: none'";
		$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;
		$p_id_berkas  	= isset($_POST['id_berkas']) ? $_POST['id_berkas'] : NULL;
		$p_nm_berkas	= isset($_POST['nm_berkas']) ? $_POST['nm_berkas'] : NULL;
		
		
		if ($tb_act == "Tambah") {
			$display = "style='display: none'";
			$q_tambah	= mysqli_query($mysqli,"INSERT INTO tbl_berkas VALUES ('', '$p_nm_berkas')");
			if ($q_tambah) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Berkas Berhasil di simpan<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
			}
		} else if ($tb_act == "Edit") {
			$display = "style='display: none'";
			$q_edit	= mysqli_query($mysqli,"UPDATE tbl_berkas SET nama_berkas = '$p_nm_berkas' WHERE id_berkas = '$p_id_berkas'");
			if ($q_edit) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Berkas Berhasil di update<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else {	
			$display = "style='display: none'";
		}
?>

		<h3 class="header smaller lighter blue">Referensi Berkas</h3>
		<div class="module_content">
		<h5><a href="?id=berkas&mod=add" class="btn btn-primary" >Tambah Data</a></h5>
	
		
			
		<?php		
		// ================ TAMPILKAN DATANYA =====================//
		echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th width='10%'>No</th><th width='60%'>Nama Berkas</th><th width='30%'>Control</th></tr>";
		$q_berkas 	= mysqli_query($mysqli,"SELECT * FROM tbl_berkas ORDER BY id_berkas ASC") or die (mysqli_error($mysqli));
		$j_data 	= mysqli_num_rows($q_berkas);

		if ($j_data == 0) {
			echo "<tr><td id='tengah' colspan='3'>-- Tidak Ada Data --</td></tr>";
		} else {

			while ($a_berkas = mysqli_fetch_array($q_berkas)) {
				echo "<tr>
				<td id='tengah'>$a_berkas[0]</td>
				<td>$a_berkas[1]</td>
				<td id='tengah'>
					<a href='?id=berkas&mod=edit&id_berkas=$a_berkas[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
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
			$q_edit	= mysqli_query($mysqli,"SELECT * FROM tbl_berkas WHERE id_berkas = '$id_berkas'");
			$a_edit	= mysqli_fetch_array($q_edit);
			
			$nm_berkas = $a_edit[1];
			$view = "Edit";
			
		} else if ($mod == "add") {
			$display = "";
			$id_berkas = "";
			$nm_berkas = "";
			$view = "Tambah";
		} else {
			$display = "style='display: none'";
		}

		?>


<div  <?php echo $display;?>>
    <header><h3 class="header smaller lighter blue"><?php echo $view;?> Data Berkas</h3></header>
    <div class="form-group">
        <form action="?id=berkas" class="form-horizontal" method="post">
            <table class="tbl_form">

                <div class="form-group">
                    
                    <div class="col-sm-9">
                        <input type="text" size="3" name="id_berkas" hidden value="<?php echo $id_berkas; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="kode">Nama Berkas</label>
                    <div class="col-sm-9">
                        <input type="text" size="30" name="nm_berkas" value="<?php echo $nm_berkas; ?>" required>
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
