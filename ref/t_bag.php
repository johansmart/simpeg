<?php
$id_bag		= isset($_GET['idbag']) ? $_GET['idbag'] : NULL;
$mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;	

		if ($mod == "del") {
			$q_delete_agama = mysqli_query($mysqli,"DELETE FROM bagian WHERE id_bag = '$id_bag'");
			if ($q_delete_agama) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data bagian Berhasil di hapus<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
			}
		}
		
	
		$display 		= "style='display: none'"; 	
		$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;				
		$p_id_bag  	= isset($_POST['id_bag']) ? $_POST['id_bag'] : NULL;			
		$p_kode_bag 	= isset($_POST['kd_bag']) ? $_POST['kd_bag'] : NULL;	
		$p_nama_bag 	= isset($_POST['n_bag']) ? $_POST['n_bag'] : NULL;		
		
		
		if ($tb_act == "Tambah") {
			$display = "style='display: none'";
			$q_tambah_agama	= mysqli_query($mysqli,"INSERT INTO bagian VALUES ('','$p_kode_bag','$p_nama_bag')");
			if ($q_tambah_agama) {
			
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Bagian Berhasil di simpan<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
			}
		} else if ($tb_act == "Edit") {
			$display = "style='display: none'";
			$q_edit_agama	= mysqli_query($mysqli,"UPDATE bagian SET kd_bag = '$p_kode_bag', n_bag='$p_nama_bag' WHERE id_bag = '$p_id_bag'");
			if ($q_edit_agama) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Bagian Berhasil di update<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
			}
		} else {	
			$display = "style='display: none'";
		}
?>

		<h3 class="header smaller lighter blue">Referensi Bagian</h3>
		<div class="module_content">
		<h5><a href="?id=bagian&mod=add" class="btn btn-primary" >Tambah Data</a></h5>
	
		
			
		<?php		
		// ================ TAMPILKAN DATANYA =====================//
		echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th width='10%'>ID</th><th width='20%'>Kode</th><th width='60%'>Bagian</th><th width='30%'>Control</th></tr>";
		$q_bagian 	= mysqli_query($mysqli,"SELECT * FROM bagian ORDER BY id_bag ASC") or die (mysql_error($mysqli));
		$j_data 	= mysqli_num_rows($q_bagian);

		if ($j_data == 0) {
			echo "<tr><td id='tengah' colspan='3'>-- Tidak Ada Data --</td></tr>";
		} else {
			$no = 1;
			while ($a_bag = mysqli_fetch_array($q_bagian)) {
				echo "<tr>
				<td>$a_bag[0]</td>
				<td>$a_bag[1]</td>
				<td>$a_bag[2]</td>
				<td><a href='?id=bagian&mod=edit&idbag=$a_bag[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=bagian&mod=del&idbag=$a_bag[0]' onclick=\"return confirm('Menghapus data $a_bag[1]')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
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
			$q_edit_bag	= mysqli_query($mysqli,"SELECT * FROM bagian WHERE id_bag = '$id_bag'");
			$a_edit_bag	= mysqli_fetch_array($q_edit_bag);
			
			$kd_bag = $a_edit_bag[1];
			$n_bag = $a_edit_bag[2];
			$view = "Edit";
			
		} else if ($mod == "add") {
			$display = "";
			$id_bag = "";
			$kd_bag = "";
			$n_bag = "";
			$view = "Tambah";
		} else {
			$display = "style='display: none'";
		}

		?>

<div <?php echo $display;?>>
	<header><h3 class="header smaller lighter blue"><?php echo $view;?> Data Bagian</h3></header>
		<form action="?id=bagian" class="form-horizontal" method="post" id="ft_bag">

            <div class="form-group" style='display: none'>
                <label class="col-sm-3 control-label no-padding-right" for="kode">ID</label>
                <div class="col-sm-9">
                    <input type="text" size="3" name="id_bag" readonly value="<?php echo $id_bag; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="kode">Kode Bagian</label>
                <div class="col-sm-9">
                    <input type="text" size="30" name="kd_bag" value="<?php echo $kd_bag; ?>" required>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="kode">Nama Bagian</label>
                <div class="col-sm-9">
                    <input type="text" size="30" name="n_bag" value="<?php echo $n_bag; ?>" required>
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



