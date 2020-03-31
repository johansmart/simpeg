<?php
// panggil file koneksi.php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  ) 

{

include "../config/koneksi.php";
error_reporting(0);




$id_libur = $_GET['idl'];
$mod=$_GET['mod'];


if ($mod=="edit"){
	

$data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_libur WHERE idlibur=".$id_libur));

	$id_libur = $data['idlibur'];
	$nmlibur= $data['nmlibur'];
	$tgllibur = $data['tgllibur'];
	$view="EDIT";
	
  
	
}else{
	  $id_libur = "";
    $nmlibur= "";
    $tgllibur = "";
	$view="SAVE";
}


?>


    <h3 class="header smaller lighter blue">Form libur</h3>

<form class="form-horizontal" id="form-libur" action="?id=libur" method="post">

<div class="form-group" hidden="hidden">
		<label class="col-sm-3 control-label no-padding-right" for="id">ID</label>
		<div class="col-sm-9">
			<input type="text"  id="id_libur" class="input-medium" name="id_libur" value="<?php echo $id_libur ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="shift">Nama Libur</label>
		<div class="col-sm-9">
			<input type="text" id="nmlibur" class="input-medium" name="nmlibur" value="<?php echo $nmlibur ?>">
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="jam_masuk">Tgl_libur</label>
        <div class="col-xs-8 col-sm-3">
            <div class="input-group">
                <input class="form-control date-picker" name="tgllibur" required value="<?php echo $tgllibur;?>" id="tgllibur" type="text" data-date-format="yyyy-mm-dd" />
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
            </div>
        </div>
	</div>




			<div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="kode"></label>
                <div class="col-sm-9">
                    <input type="submit" class="btn btn-primary" name="tb_act" value="<?php echo $view; ?>">
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