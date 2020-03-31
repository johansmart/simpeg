<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  ) 

{

include "../config/koneksi.php";

$id_pes = $_POST['id'];


$data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_peng WHERE id_pes=".$id_pes));


if($id_pes> 0) {
	$id_pes = $data['id_pes'];
	$header= $data['header'];
	$body = $data['body'];
	$footer = $data['footer'];
} else  {
	$id_pes = "";
	$header="";
	$body = "";
	$footer = "";

}

?>
					
<form class="form-horizontal" id="form-peng">

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="id">ID</label>
		<div class="col-sm-9">
			<input type="text"  disabled="disabled" id="id_pes" class="input-medium" name="id_pes" value="<?php echo $id_pes ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="header">Header</label>
		<div class="col-sm-9">
			<input type="text" id="header" class="input-medium" name="header" value="<?php echo $header ?>">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="body">Body</label>
		<div class="col-sm-9">
			<textarea cols="50" rows="5" type="text" id="body" name="body"><?php echo $body ?></textarea> 
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="gapok">Footer</label>
		<div class="col-sm-9">
			<input type="text" id="footer" class="input-medium" name="footer" value="<?php echo $footer ?>">
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