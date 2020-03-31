<?php
$kdsubbg	= isset($_GET['kdsubbg']) ? $_GET['kdsubbg'] : NULL;
$mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;	

		if ($mod == "del") {
			$q_delete_subbg = mysqli_query($mysqli,"DELETE FROM sub_bagian WHERE kd_sub= '$kdsubbg'");
			if ($q_delete_subbg) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Sub Bagian Berhasil di hapus<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		}
		
	
		$display 		= "style='display: none'"; 	
		$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;				
		$p_id_subbg  	= isset($_POST['kdsubbg']) ? $_POST['kdsubbg'] : NULL;
		$p_urai_subbg   = isset($_POST['uraian']) ? $_POST['uraian'] : NULL;
		
		
		if ($tb_act == "Tambah") {
			$display = "style='display: none'";
			$q_tambah_subbg	= mysqli_query($mysqli,"INSERT INTO sub_bagian VALUES ('','$p_urai_subbg')");
			if ($q_tambah_subbg >0) {
			
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Sub Bagian Berhasil di simpan<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else if ($tb_act == "Edit") {
			$display = "style='display: none'";
			$q_edit_subbg	= mysqli_query($mysqli,"UPDATE sub_bagian SET  urai_sub='$p_urai_subbg' WHERE kd_sub = '$p_id_subbg'");
			if ($q_edit_subbg >0) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Sub Bagian Berhasil di update<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else {	
			$display = "style='display: none'";
		}
?>

		<h3 class="header smaller lighter blue">Referensi Sub Bagian</h3>
		<div class="module_content">
		<h5><a href="?id=subbg&mod=add" class="btn btn-primary" >Tambah Data</a></h5>
	
		
			
		<?php		
		// ================ TAMPILKAN DATANYA =====================//
		echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th width='10%'>ID</th><th width='30%'>Uraian</th><th width='30%'>Control</th></tr>";
		$q_subbg 	= mysqli_query($mysqli,"SELECT * FROM sub_bagian ORDER BY kd_sub ASC") or die (mysqli_error($mysqli));
		$j_data 	= mysqli_num_rows($q_subbg);

		if ($j_data == 0) {
			echo "<tr><td id='tengah' colspan='3'>-- Tidak Ada Data --</td></tr>";
		} else {

			while ($a_subbg = mysqli_fetch_array($q_subbg)) {
				echo "<tr>
				<td id='tengah'>$a_subbg[0]</td>
				<td>$a_subbg[1]</td>
				<td id='tengah'><a href='?id=subbg&mod=edit&kdsubbg=$a_subbg[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=subbg&mod=del&kdsubbg=$a_subbg[0]' onclick=\"return confirm('Menghapus data $a_subbg[1]')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
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
			$q_edit_subbg	= mysqli_query($mysqli,"SELECT * FROM sub_bagian WHERE kd_sub = '$kdsubbg'");
			$a_edit_subbg	= mysqli_fetch_array($q_edit_subbg);
            $id_subbg =$a_edit_subbg[0];
			$n_subbg = $a_edit_subbg[1];
			$view = "Edit";
			
		} else if ($mod == "add") {
			$display = "";
			$id_subbg = "";
			$n_subbg = "";
			$view = "Tambah";
		} else {
			$display = "style='display: none'";
		}

		?>

<div  <?php echo $display;?>>
	<header><h3 class="header smaller lighter blue"><?php echo $view;?> Data Sub Bagian</h3></header>
		<div class="form-group">
		<form action="?id=subbg" class="form-horizontal" method="post" id="ft_kpkrn">
		<table class="tbl_form">

            <div class="form-group" style='display: none'>
                <label class="col-sm-3 control-label no-padding-right" for="kode">ID</label>
                <div class="col-sm-9">
                    <input type="text" size="3" name="kdsubbg" readonly value="<?php echo $id_subbg; ?>">
                </div>
            </div>

            <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="kode">Uraian</label>
                    <div class="col-sm-9">
                        <input type="text" size="30" name="uraian" value="<?php echo $n_subbg; ?>" required>
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
