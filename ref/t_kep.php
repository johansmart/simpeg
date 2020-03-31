<?php
$kdkpkrn	= isset($_GET['kdkpkrn']) ? $_GET['kdkpkrn'] : NULL;
$mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;	

		if ($mod == "del") {
			$q_delete_kep = mysqli_query($mysqli,"DELETE FROM tbl_kepakaran WHERE kdkpkrn= '$kdkpkrn'");
			if ($q_delete_kep) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Kepakaran Berhasil di hapus<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		}
		
	
		$display 		= "style='display: none'"; 	
		$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;				
		$p_id_kdkpkrn  	= isset($_POST['kdkpkrn']) ? $_POST['kdkpkrn'] : NULL;
		$p_nama_kdkpkrn = isset($_POST['nmkepakaran']) ? $_POST['nmkepakaran'] : NULL;
		
		
		if ($tb_act == "Tambah") {
			$display = "style='display: none'";
			$q_tambah_kep	= mysqli_query($mysqli,"INSERT INTO tbl_kepakaran VALUES ('','$p_nama_kdkpkrn')");
			if ($q_tambah_kep) {
			
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Kepakaran Berhasil di simpan<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else if ($tb_act == "Edit") {
			$display = "style='display: none'";
			$q_edit_kep	= mysqli_query($mysqli,"UPDATE tbl_kepakaran SET  nmkepakaran='$p_nama_kdkpkrn' WHERE kdkpkrn = '$p_id_kdkpkrn'");
			if ($q_edit_kep) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Kepakaran Berhasil di update<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else {	
			$display = "style='display: none'";
		}
?>

		<h3 class="header smaller lighter blue">Referensi Kepakaran</h3>
		<div class="module_content">
		<h5><a href="?id=kepakaran&mod=add" class="btn btn-primary" >Tambah Data</a></h5>
	
		
			
		<?php		
		// ================ TAMPILKAN DATANYA =====================//
		echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th width='10%'>ID</th><th width='60%'>Kepakaran</th><th width='30%'>Control</th></tr>";
		$q_kpkrn 	= mysqli_query($mysqli,"SELECT * FROM tbl_kepakaran ORDER BY kdkpkrn ASC") or die (mysqli_error($mysqli));
		$j_data 	= mysqli_num_rows($q_kpkrn);

		if ($j_data == 0) {
			echo "<tr><td id='tengah' colspan='3'>-- Tidak Ada Data --</td></tr>";
		} else {
			$no = 1;
			while ($a_kpkrn = mysqli_fetch_array($q_kpkrn)) {
				echo "<tr>
				<td id='tengah'>$a_kpkrn[0]</td>
				<td>$a_kpkrn[1]</td>
				<td id='tengah'><a href='?id=kepakaran&mod=edit&kdkpkrn=$a_kpkrn[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=kepakaran&mod=del&kdkpkrn=$a_kpkrn[0]' onclick=\"return confirm('Menghapus data $a_kpkrn[1]')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
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
			$q_edit_kpkrn	= mysqli_query($mysqli,"SELECT * FROM tbl_kepakaran WHERE kdkpkrn = '$kdkpkrn'");
			$a_edit_kpkrn	= mysqli_fetch_array($q_edit_kpkrn);
            $id_kpkrn =$a_edit_kpkrn[0];
			$n_kpkrn = $a_edit_kpkrn[1];
			$view = "Edit";
			
		} else if ($mod == "add") {
			$display = "";
			$id_kpkrn = "";
			$n_kpkrn = "";
			$view = "Tambah";
		} else {
			$display = "style='display: none'";
		}

		?>

<div  <?php echo $display;?>>
	<header><h3 class="header smaller lighter blue"><?php echo $view;?> Data Kepakaran</h3></header>
		<div class="form-group">
		<form action="?id=kepakaran" class="form-horizontal" method="post" id="ft_kpkrn">
		<table class="tbl_form">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="kode">ID</label>
                <div class="col-sm-9">
                    <input type="text" size="3" name="kdkpkrn" readonly value="<?php echo $id_kpkrn; ?>">
                </div>
            </div>

            <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="kode">Kepakaran</label>
                    <div class="col-sm-9">
                        <input type="text" size="30" name="nmkepakaran" value="<?php echo $n_kpkrn; ?>" required>
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
