<?php
// panggil file koneksi.php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  ) 

{

include "../config/koneksi.php";
error_reporting(0);




$idst = $_GET['idst'];
$mod=$_GET['mod'];


if ($mod=="edit"){
	

$data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_struktur WHERE idst=".$idst));

	$id_st = $data['idst'];
	$id_jab_a= $data['id_jab_a'];
	$id_jab_b = $data['id_jab_b'];
	$view="EDIT";
	
  
	
}else{
	$id_st = "";
	$id_jab_a= "";
	$id_jab_b = "";
	$view="SAVE";
}


?>


    <h3 class="header smaller lighter blue">Form Sturktur</h3>

<form class="form-horizontal" id="form-libur" action="?id=struktur" method="post">

<div class="form-group" hidden="hidden">
		<label class="col-sm-3 control-label no-padding-right" for="id">ID</label>
		<div class="col-sm-9">
			<input type="text"  id="idst" class="input-medium" name="idst" value="<?php echo $id_st ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="shift">Atasan</label>
		<div class="col-sm-9">
			 <select name="id_jab_a" id="id_jab_a" >
	            <option>-- Pilih Jabatan --</option>
	            <?php
	            $q = mysqli_query($mysqli,"select * from jabatan order by n_jab");

	            while ($a = mysqli_fetch_array($q)){
	            	if($a[kode]==$id_jab_a){
	            		echo "<option value='$a[kode]' selected>$a[n_jab]</option>";
	            	}else {
	            		echo "<option value='$a[kode]'>$a[n_jab]</option>";
	            	}
	                
	            }
	            ?>
	        </select>
		</div>
	</div>
	

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="shift">Bawahan</label>
		<div class="col-sm-9">
			 <select name="id_jab_b" id="id_jab_b" >
	            <option>-- Pilih Jabatan --</option>
	            <?php
	            $q = mysqli_query($mysqli,"select * from jabatan order by n_jab");

	            while ($a = mysqli_fetch_array($q)){
	            	if($a['kode']==$id_jab_b){
	            		echo "<option value='$a[kode]' selected>$a[n_jab]</option>";
	            	}else {
	            		echo "<option value='$a[kode]'>$a[n_jab]</option>";
	            	}
	                
	            }
	            ?>
	        </select>
		</div>
	</div>



			<div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="kode"></label>
                <div class="col-sm-9">
                    <input type="submit" class="btn btn-primary" name="tb_act" value="<?php echo $view; ?>">
                    <a href="?id=struktur" class="btn btn-danger">Kembali</a>
                </div>
            </div>

</form>

	

<?php

?>
<?php
}else{
	session_destroy();
	header('Location:../index.php?status=Silahkan Login');
}
?>	