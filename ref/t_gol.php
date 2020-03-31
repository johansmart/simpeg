<?php
$idgol 	= isset($_GET['idgol']) ? $_GET['idgol'] : NULL;
$mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;	

		if ($mod == "del") {
			$q_delete_gol = mysqli_query($mysqli,"DELETE FROM tbl_gol WHERE id_gol= '$idgol'");
			if ($q_delete_gol) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data golongan Berhasil di hapus<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		}
		
	
		$display 		= "style='display: none'"; 	
		$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;				
		$p_id_gol  	    = isset($_POST['id_gol']) ? $_POST['id_gol'] : NULL;
		$p_gol          = isset($_POST['gol']) ? $_POST['gol'] : NULL;
        $p_uraian       = isset($_POST['uraian']) ? $_POST['uraian'] : NULL;
		
		
		if ($tb_act == "Tambah") {
			$display = "style='display: none'";
			$q_tambah_gol	= mysqli_query($mysqli,"INSERT INTO tbl_gol VALUES ('','$p_gol','$p_uraian')");
			if ($q_tambah_gol) {
			
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data golongan Berhasil di simpan<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else if ($tb_act == "Edit") {
			$display = "style='display: none'";
			$q_edit_gol	= mysqli_query($mysqli,"UPDATE tbl_gol SET gol='$p_gol',uraian='$p_uraian' WHERE id_gol = '$p_id_gol'");
			if ($q_edit_gol) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Golongan Berhasil di update<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else {	
			$display = "style='display: none'";
		}
?>

		<h3 class="header smaller lighter blue">Referensi Golongan</h3>
		<div class="module_content">
		<h5><a href="?id=gol&mod=add" class="btn btn-primary" >Tambah Data</a></h5>

		<?php		
		// ================ TAMPILKAN DATANYA =====================//
		echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>ID</th><th>Golongan</th><th>Uraian</th><th>Control</th></tr>";
		$q_gol 	= mysqli_query($mysqli,"SELECT * FROM tbl_gol ORDER BY id_gol ASC") or die (mysqli_error($mysqli));
		$j_data 	= mysqli_num_rows($q_gol);

		if ($j_data == 0) {
			echo "<tr><td colspan='3'>-- Tidak Ada Data --</td></tr>";
		} else {

			while ($a_gol = mysqli_fetch_array($q_gol)) {
				echo "<tr>
				<td >$a_gol[0]</td>
				<td>$a_gol[1]</td>
				<td>$a_gol[2]</td>
				<td><a href='?id=gol&mod=edit&idgol=$a_gol[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=gol&mod=del&idgol=$a_gol[0]' onclick=\"return confirm('Menghapus data $a_gol[1]')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
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
			$q_edit_gol	= mysqli_query($mysqli,"SELECT * FROM tbl_gol WHERE id_gol = '$idgol'");
			$a_edit_gol	= mysqli_fetch_array($q_edit_gol);
            $id_gol =$a_edit_gol[0];
			$n_gol = $a_edit_gol[1];
            $uraian = $a_edit_gol[2];
			$view = "Edit";
			
		} else if ($mod == "add") {
			$display = "";
            $id_gol ="";
            $n_gol = "";
            $uraian = "";
			$view = "Tambah";
		} else {
			$display = "style='display: none'";
		}

		?>

<div  <?php echo $display;?>>
	<header><h3 class="header smaller lighter blue"><?php echo $view;?> Data Golongan</h3></header>
		<div class="form-group">
		<form action="?id=gol" class="form-horizontal" method="post" id="ft_gol">
		<table class="tbl_form">

            <div class="form-group" style='display: none'>
                <label class="col-sm-3 control-label no-padding-right" for="kode">ID</label>
                <div class="col-sm-9">
                    <input type="text" size="3" name="id_gol" readonly value="<?php echo $id_gol; ?>">
                </div>
            </div>

            <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="kode">Golongan</label>
                    <div class="col-sm-9">
                        <input type="text" size="30" name="gol" value="<?php echo $n_gol; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="kode">Uraian</label>
                <div class="col-sm-9">
                    <input type="text" size="30" name="uraian" value="<?php echo $uraian; ?>" required>
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
