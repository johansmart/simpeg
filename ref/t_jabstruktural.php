<?php
$kdjbstruk	= isset($_GET['kdjbstruk']) ? $_GET['kdjbstruk'] : NULL;
$mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;	

		if ($mod == "del") {
			$q_delete_jbstruk = mysqli_query($mysqli,"DELETE FROM jb_struk WHERE kd_jbstruk= '$kdjbstruk'");
			if ($q_delete_jbstruk) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Jabatan Struktural Berhasil di hapus<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		}
		
	
		$display 		= "style='display: none'"; 	
		$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;				
		$p_id_jbstruk  	= isset($_POST['kdjbstruk']) ? $_POST['kdjbstruk'] : NULL;
		$p_nm_jbstruk   = isset($_POST['nmjbstruk']) ? $_POST['nmjbstruk'] : NULL;
        $p_kls_jbstruk  = isset($_POST['klsjbstruk']) ? $_POST['klsjbstruk'] : NULL;
		
		
		if ($tb_act == "Tambah") {
			$display = "style='display: none'";
			$q_tambah_jbstruk	= mysqli_query($mysqli,"INSERT INTO jb_struk VALUES ('','$p_nm_jbstruk','$p_kls_jbstruk')");
			if ($q_tambah_jbstruk >0) {
			
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Jabatan Struktural Berhasil di simpan<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else if ($tb_act == "Edit") {
			$display = "style='display: none'";
			$q_edit_jbstruk	= mysqli_query($mysqli,"UPDATE jb_struk SET  nm_jbstruk='$p_nm_jbstruk',kls_jbstruk='$p_kls_jbstruk' WHERE kd_jbstruk = '$p_id_jbstruk'");
			if ($q_edit_jbstruk >0) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Jabatan Struktural Berhasil di update<br/></div>";
			} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
			}
		} else {	
			$display = "style='display: none'";
		}
?>

		<h3 class="header smaller lighter blue">Referensi Jabatan Struktural</h3>
		<div class="module_content">
		<h5><a href="?id=jbs&mod=add" class="btn btn-primary" >Tambah Data</a></h5>
	
		
			
		<?php		
		// ================ TAMPILKAN DATANYA =====================//
		echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th width='10%'>ID</th><th width='50%'>Jabatan Struktural</th><th width='10%'>Kelas</th><th width='30%'>Control</th></tr>";
		$q_jbstruk 	= mysqli_query($mysqli,"SELECT * FROM jb_struk ORDER BY kd_jbstruk ASC") or die (mysqli_error($mysqli));
		$j_data 	= mysqli_num_rows($q_jbstruk);

		if ($j_data == 0) {
			echo "<tr><td id='tengah' colspan='3'>-- Tidak Ada Data --</td></tr>";
		} else {
			while ($a_jbstruk = mysqli_fetch_array($q_jbstruk)) {
				echo "<tr>
				<td id='tengah'>$a_jbstruk[0]</td>
				<td>$a_jbstruk[1]</td>
				<td>$a_jbstruk[2]</td>
				<td id='tengah'><a href='?id=jbs&mod=edit&kdjbstruk=$a_jbstruk[0]' ><span class='blue'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a> |
					<a href='?id=jbs&mod=del&kdjbstruk=$a_jbstruk[0]' onclick=\"return confirm('Menghapus data $a_jbstruk[1]')\"><span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
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
			$q_edit_jbstruk	= mysqli_query($mysqli,"SELECT * FROM jb_struk WHERE kd_jbstruk = '$kdjbstruk'");
			$a_edit_jbstruk	= mysqli_fetch_array($q_edit_jbstruk);
            $id_jbstruk =$a_edit_jbstruk[0];
			$n_jbstruk = $a_edit_jbstruk[1];
            $k_jbstruk = $a_edit_jbstruk[2];
			$view = "Edit";
			
		} else if ($mod == "add") {
			$display = "";
			$id_jbstruk = "";
			$n_jbstruk = "";
            $k_jbstruk ="";
			$view = "Tambah";
		} else {
			$display = "style='display: none'";
		}

		?>

<div  <?php echo $display;?>>
	<header><h3 class="header smaller lighter blue"><?php echo $view;?> Data Jabatan Strukturan</h3></header>
		<div class="form-group">
		<form action="?id=jbs" class="form-horizontal" method="post" id="ft_kpkrn">
		<table class="tbl_form">

            <div class="form-group" style='display: none'>
                <label class="col-sm-2 control-label no-padding-right" for="kode">ID</label>
                <div class="col-sm-9">
                    <input type="text" size="3" name="kdjbstruk" readonly value="<?php echo $id_jbstruk; ?>">
                </div>
            </div>

            <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="kode">Jabatan Struktural</label>
                    <div class="col-sm-9">
                        <input type="text" size="30" name="nmjbstruk" value="<?php echo $n_jbstruk; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="kode">Kelas</label>
                <div class="col-sm-3">
                    <input type="text" size="30" name="klsjbstruk" value="<?php echo $k_jbstruk; ?>" required>
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
