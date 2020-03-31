<?php
 session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL && !empty($sesi_username) && $_SESSION['leveluser']=='1')

{
// panggil file koneksi.php
include "config/koneksi.php";


$id_user = $_POST['id'];
	
	$qdata = mysqli_query($mysqli,"SELECT a.*,b.no_lv,b.n_lv from tbl_user a
	LEFT JOIN user b on a.level_user=b.level_user 
	WHERE a.id_user='$id_user'");
	$data=mysqli_fetch_array($qdata);


if($id_user> 0) { 
	$id_user = $data['id_user'];
	$username= $data['username'];
	$email = $data['email'];
	$nip= $data['nip'];
	$level_user = $data['level_user'];
	$no_lv= $data['no_lv'];
	$idp= $data['id'];
    $password="";
} else  {
	$id_user    ="";
	$username   ="";
	$email      ="";
	$nip        ="";
	$level_user ="";
}

?>
<form class="form-horizontal" id="form-lu">

	<div class="form-group" hidden>
		<label  class="col-sm-3 control-label no-padding-right"  for="id">ID</label>
    <div class="col-sm-9">
			<input type="text"   id="id_user" class="col-xs-10 col-sm-5" name="id_user" value="<?php echo $id_user ?>">
		</div>
	</div>

    <div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="username">Username</label>
        <div class="col-sm-9">
			<input type="text" id="username" class="col-xs-10 col-sm-5" name="username" value="<?php echo $username ?>" >
		</div>
	</div>

    <div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="email">Email</label>
		<div class="col-sm-9">
			<input type="text" id="email" class="input-medium" name="email" value="<?php echo $email ?>" >
		</div>
	</div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" >Password</label>
        <div class="col-sm-9">
            <input type="password" id="password" class="input-medium" name="password" value="" >* Kosongkan bila tidak dirubah
        </div>
    </div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="nip">Pilih Pegawai</label>
        <div class="col-sm-9">
			<select name="idp" value="" id="idp" >
				<option>-- Pilih Pegawai --</option>
					<?php
						$q = mysqli_query($mysqli,"select id,nama from pegawai ");

							while ($a = mysqli_fetch_array($q)){
								if ($a['0'] ==$idp) {
									echo "<option value='$a[0]' selected>$a[1]</option>";
								} else {
									echo "<option value='$a[0]'>$a[1]</option>";
								}
							}
					?>
		</select>
		</div>
	</div>

    <div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="level_user">Level User</label>
        <div class="col-sm-9">
		<select name="no_lv" value="" id="no_lv" >
				<option>-- Level User--</option>
					<?php
						$q = mysqli_query($mysqli,"select * from user");

							while ($a = mysqli_fetch_array($q)){
								if ($a['0'] ==$no_lv) {
									echo "<option value='$a[0]' selected>$a[1]</option>";
								} else {
									echo "<option value='$a[0]'>$a[1]</option>";
								}
							}
					?>
		</select>
		</div>
	</div>
	
	
	
	
</form>

<?php

?>
<?php
}else{
	session_destroy();
	header('Location:index.php?status=Silahkan Login');
}
?>