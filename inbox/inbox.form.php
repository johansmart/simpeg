<?php
 session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL && !empty($sesi_username) && $_SESSION['leveluser']<='7')
{

include "../config/koneksi.php";





$nomor = $_POST['id'];


$data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tabel_pesan WHERE nomor=".$nomor));


if($nomor> 0) {
	$nomor= $data['nomor'];
	$subject= $data['subject'];
	$pesan = $data['pesan'];
    $username= $data['dari'];
    $display = "";
    $readonly="readonly";
    $ket="balas";

} else  {
	$nomor ="";
	$subject="";
	$pesan="";
    $username="";
    $readonly="";
    $display ="hidden";
    $ket="kirim";

}

?>
<link rel="stylesheet" href="assets/css/chosen.css" />


<script src="assets/js/chosen.jquery.min.js"></script>

<script>
    $(document).ready(function (e) {

  $('.chosen-select').chosen({allow_single_deselect:true});
	$(window)
			.off('resize.chosen')
			.on('resize.chosen', function() {
				$('.chosen-select').each(function() {
					var $this = $(this);
					$this.next().css({'width': 200});
				})
			}).trigger('resize.chosen');
			
			

	});

</script>




    <form action="?id=msg" id="form-inbox" method="POST">
        <input type="text" hidden id="nomor" name="nomor" value="<?php echo $nomor ?>"  >


		
											<div class="form-group">
											<label for="recipient-name" class="control-label" >Kepada</label>
											<div class="">
											 <select name="username" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Silahkan Pilih Username..." required="">
											<option value=" ">  </option>
											<?php
											$q = mysqli_query($mysqli,"select username from tbl_user ");

											while ($a = mysqli_fetch_array($q)){
											if ($a['0']==$username) {
											echo "<option value='$a[0]' selected>$a[0]</option>";
											} else {
											echo "<option value='$a[0]'>$a[0]</option>";
											}
											}
											?>
		
											</select>
											
											</div>		
											</div>
		
        <div class="form-group">
            <label for="recipient-name" class="control-label">Subject:</label>
            <input type="text" class="form-control" name="subject" placeholder="subject" value="<?php echo $subject ?>" id="subject" <?php echo $readonly?> required="">
        </div>
        <div class="form-group">
            <label for="message-text" class="control-label">Pesan:</label>
            <textarea class="form-control" name="pesan" placeholder="Isi Pesan" id="pesan" <?php echo $readonly?> required><?php echo $pesan ?></textarea>
        </div>
        <div class="form-group" <?php echo $display?>>
            <label for="message-text" class="control-label">Balas Pesan:</label>
            <textarea class="form-control" name="blspesan" id="blspesan" ></textarea>
        </div>
        <div class="modal-footer">
            <input type="submit" name="simpan" class="btn btn-success" value="SIMPAN">
            <input type="submit" name="<?php echo $ket?>" class="btn btn-primary" VALUE="KIRIM">
        </div>
    </form>


<?php


}else{
	session_destroy();
	header('Location:../index.php?status=Silahkan Login');
}
?>