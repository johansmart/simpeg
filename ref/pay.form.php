<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  ) 

{

include "../config/koneksi.php";



$idpay = $_POST['id'];


$data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_payroll WHERE idpay=".$idpay));


if($idpay> 0) {
	$idpay = $data['idpay'];
	$kode= $data['kode'];
	$nm_pay = $data['nm_pay'];
	$penambah = $data['penambah'];
	$pengurang = $data['pengurang'];
	$ket = $data['keterangan'];
	

} else  {
	$idpay ="";
	$kode ="";
	$nm_pay ="";
	$penambah ="";
	$pengurang ="";
	$ket ="";
	
}

?>
					
<form class="form-horizontal" id="form-pay">



<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="id">ID</label>
		<div class="col-sm-9">
			<input type="text"  disabled="disabled" id="idpay" class="input-medium" name="idpay" value="<?php echo $idpay ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="kode">Kode</label>
		<div class="col-sm-9">
			<input type="text" id="kode" class="input-medium" name="kode" value="<?php echo $kode ?>">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="nm_pay">Nama Payroll</label>
		<div class="col-sm-9">
			<input type="text" id="nm_pay" class="input-medium" name="nm_pay" value="<?php echo $nm_pay ?>">
		</div>
	</div>
	
	<div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Penambah </label>

        <div class="col-sm-9">
            <label class="blue">
                <input name="penambah"  id="penambah" value="1" <?=$penambah =='1' ? ' checked="checked"' : '';?> type="radio" />
                <span class="lbl"> Ya</span>
            </label>

            <label class="blue">
                <input name="penambah"  id="penambah" value="0" <?=$penambah =='0' ? ' checked="checked"' : '';?> type="radio" />
                <span class="lbl"> Tidak</span>
            </label>
            </div>
	</div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Pengurang </label>

        <div class="col-sm-9">
            <label class="blue">
                <input name="pengurang"  id="penngurang" value="1" <?=$pengurang =='1' ? ' checked="checked"' : '';?> type="radio" />
                <span class="lbl"> Ya</span>
            </label>

            <label class="blue">
                <input name="pengurang"  id="penngurang" value="0" <?=$pengurang =='0' ? ' checked="checked"' : '';?> type="radio" />
                <span class="lbl"> Tidak</span>
            </label>
        </div>
    </div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="ket">Keterangan</label>
		<div class="col-sm-9">
			<input type="text" id="ket" class="input-medium" name="ket" value="<?php echo $ket ?>">
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