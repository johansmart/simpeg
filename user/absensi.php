<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='5' )

{

$date         	= date("Y-m-d");
$day          	= date("D");
$date_sekarang 	= tgl_indo($date); 
$day_date      	= "$day/$date_sekarang";
$waktu      	= gmdate('H:i' ,gmdate('U')+25200);


$Q_absen = mysqli_query($mysqli,"select * from absensi where nip='$nip' and tanggal_absen='$date'");
$d_absen = mysqli_fetch_array($Q_absen);
$id_abs	=$d_absen['id_abs'];
$jam_in	=$d_absen['jam_in'];
$jam_out=$d_absen['jam_out'];


$querysetabsen = mysqli_query($mysqli,"SELECT * FROM master");
$datasetabsensi = mysqli_fetch_array($querysetabsen);

if($datasetabsensi['absensi']=='Y'){
	


?>

<div class="col-xs-6 col-sm-4 pricing-box">
	<div class="widget-box widget-color-orange">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><?php echo "$day_date";?></h5>
		</div>
		<?php
		$p_nip = isset($_POST['nip']) ? $_POST['nip'] : "";
		$p_shift = isset($_POST['shift']) ? $_POST['shift'] : "";
		 
		$Q_shift = mysqli_query($mysqli,"select * from tbl_absen where id_abs='$p_shift'");
		$d_shift = mysqli_fetch_array($Q_shift);
		$jam_masuk  = $d_shift['jam_masuk'];
		$jam_keluar = $d_shift['jam_pulang'];
		
		if($waktu > $jam_masuk){
			$terlambat="Y";
		}else{
			$terlambat="N";
		}
		
		 
		if (isset($_POST['absen_masuk'])) { 
			if ($p_shift==0){
				echo "<div class='alert alert-danger'>Shift Belum di isi !!!</div>";
				
			}else{
				$Q_cek = mysqli_query($mysqli,"select * from absensi where nip='$nip' and tanggal_absen='$date'");
				$d_cek = mysqli_fetch_array($Q_cek);
				if ($d_cek > 0 ){
				echo "<div class='alert alert-danger'>Anda Sudah Absen Pada Tanggal $date !!!</div>";
				} else {
					$query_in = mysqli_query($mysqli,"INSERT into absensi values ('','$p_shift','','$date','$waktu','','Y','','','$terlambat','','$p_nip',NOW())");
					if($query_in > 0) {
					echo "<div class='alert alert-info'>Berhasil !!!</div>";	
						
					} else {
						echo "<div class='alert alert-danger'>".mysqli_error($mysqli)."</div>";
					}
					
					
				}
			
			} 
			 
		}
		 
		 
		?>
		<div class="widget-body">
		<form action="" class="form-horizontal" method="POST" > 
			<div class="widget-main">
				<ul class="list-unstyled spaced2">
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">NIP</label>
                        <div class="col-sm-5">
                            <input class="col-xs-12 col-sm-10"  type="text" readonly="readonly" id="nip"  name="nip" value="<?php echo "$nip";?>" />
                        </div>
                    </div>
					
					
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">JAM MASUK</label>
                        <div class="col-sm-5">
                            <input class="col-xs-12 col-sm-10"  type="text" readonly="readonly" id="jam_in" name="jam_in" value="<?php echo "$jam_in" ?>" />
							
							
                        </div>
					</div>
					
					
			 <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="cuti">SHIFT</label>
                <div class="col-sm-9">
                    <select name="shift" value="0" id="shift">
                        <option value="" selected>-- Pilih Shift--</option>
                        <?php
                        $q = mysqli_query($mysqli,"select * from tbl_absen");
                        while ($a = mysqli_fetch_array($q)){
                                echo "<option value='$a[0]' >$a[1]</option>";
                           
                        }
                        ?>
                    </select>
                </div>
            </div>
				
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">CURRENT TIME</label>
                        <div class="col-sm-5">
                            <span id="the-time2">00:00:00</span>
                        </div>
                    </div>	
					
				</ul>

				
				
			</div>

			<div>
			
			<input type="submit" name="absen_masuk" class="btn btn-block btn-warning" value="Absen Masuk" onclick="return confirm('Apakah Anda Yakin ?')" title="Silahkan Klik Disini Untuk Absen Masuk"/>
			
			</div>
		</form>	
		</div>
	</div>
</div>



<div class="col-xs-6 col-sm-4 pricing-box">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><?php echo "$day_date";?></h5>
		</div>
		<?php
		$p_nip2 = isset($_POST['nip2']) ? $_POST['nip2'] : "";
		
		if($waktu > $jam_keluar){
			$pulang_cepat="Y";
		}else{
			$pulang_cepat="N";
		}
		
		if (isset($_POST['absen_keluar'])) { 
		
				$Q_cek2 = mysqli_query($mysqli,"select * from absensi where nip='$nip' and tanggal_absen='$date'");
				$d_cek2 = mysqli_fetch_array($Q_cek2);
				
				if ($d_cek2==0){
					echo "<div class='alert alert-danger'>Jam Masuk Anda Masih Kosong !!!</div>";
				} else {
					if($d_cek2['jam_out']=='00:00:00') {
						$query_out = mysqli_query($mysqli,"update absensi set jam_out='$waktu',pulangcepat='$pulang_cepat',status_keluar='Y',time_update=now() where tanggal_absen='$date' and nip='$nip' ");
						if($query_out > 0) {
						echo "<div class='alert alert-info'>Berhasil !!!</div>";	
						
						} else {
						echo "<div class='alert alert-danger'>".mysqli_error($mysqli)."</div>";
						}
					} else {
						echo "<div class='alert alert-danger'>Anda sudah absen keluar!!!</div>";
					}
					
					
						
				}
		}
		
		
		
		?>
		
		<div class="widget-body">
		<form action=""  class="form-horizontal" method="POST" > 
			<div class="widget-main">
				<ul class="list-unstyled spaced2">
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">NIP</label>
                        <div class="col-sm-5">
                            <input class="col-xs-12 col-sm-10"  type="text" readonly="readonly" id="nip2"  name="nip2" value="<?php echo "$nip"?>" />
                        </div>
                    </div>
					
					
				<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">JAM KELUAR</label>
                        <div class="col-sm-5">
                            <input class="col-xs-12 col-sm-10"  type="text" readonly="readonly" id="jam_in" name="jam_in" value="<?php echo "$jam_out" ?>" />
							
							
                        </div>
                </div>	
				
				<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">SHIFT</label>
                        <div class="col-sm-5">
                            <select name="shift" value="" id="shift" disabled>
								<?php
												$q2 = mysqli_query($mysqli,"select * from tbl_absen");

													while ($a2 = mysqli_fetch_array($q2)){
													if ($a2['0'] ==$id_abs) {
														echo "<option value='$a2[0]' selected>$a2[1]</option>";
													} else {
													echo "<option value='$a2[0]'>$a2[1]</option>";
													}
														}
													?>
							</select>
                        </div>
                </div>	
					
				<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">CURRENT TIME</label>
                        <div class="col-sm-5">
                            <span id="the-time3">00:00:00</span>
                        </div>
                </div>	
				
					
				</ul>

				
			</div>

			<div>
			
			<input type="submit" name="absen_keluar" class="btn btn-block btn-primary" onclick="return confirm('Apakah Anda Yakin ?')" value="Absen Keluar" Title="Silahkan Klik Disini Untuk Absen Keluar" />
			
			</div>
		</form>	
		</div>
		
	</div>
</div>





<?php
} else {
	echo "<div class='alert alert-danger'>Maaf Halaman Disabled Admin</div>";
  }
}else {
    header('Location:../index.php?status=Silahkan Login');
}
?>	
