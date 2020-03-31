<?php
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1' && $sesi_level !='3'){
    header('location:../index.php');

} 

	$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;			
    $p_tgl_absen  	= isset($_POST['tgl_absen']) ? $_POST['tgl_absen'] : NULL;
	$p_shift  	    = isset($_POST['shift']) ? $_POST['shift'] : NULL;
	$p_id_nip  	    = isset($_POST['absennip']) ? $_POST['absennip'] : NULL;
	$p_jam_in  	    = isset($_POST['jam_in']) ? $_POST['jam_in'] : NULL;
	$p_jam_out  	= isset($_POST['jam_out']) ? $_POST['jam_out'] : NULL;
	$p_id_absensi  	= isset($_POST['id_absensi']) ? $_POST['id_absensi'] : NULL; 
	
	
	$Q_shift = mysqli_query($mysqli,"select * from tbl_absen where id_abs='$p_shift'");
		$d_shift = mysqli_fetch_array($Q_shift);
		$jam_masuk  = $d_shift['jam_masuk'];
		$jam_keluar = $d_shift['jam_pulang'];
		
		if($p_jam_in > $jam_masuk){   
			$telat="Y";
		}else{
			$telat="N";
		}
		
		if($p_jam_out < $jam_keluar){
			$pulang_cepat="Y";
		}else{
			$pulang_cepat="N";
		}

    if ($tb_act == "SIMPAN") {
		
		$cek_absen= mysqli_query($mysqli,"select * from absensi where tanggal_absen='$p_tgl_absen' and nip='$p_id_nip'");
		$resultcek=mysqli_num_rows($cek_absen);
		
		
		
					if ($resultcek > 0) {
						echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Pegawai tersebut sudah melakukan absensi pada tanggal ".$p_tgl_absen." <br/></div>";
						} else  {
							$cek_nip= mysqli_query($mysqli,"select * from pegawai where nip='$p_id_nip'");
							$resultceknip=mysqli_num_rows($cek_nip);
							
							if ($resultceknip > 0) {
								$q_absensi	= mysqli_query($mysqli,"INSERT INTO absensi (id_absensi,nip,id_abs,tanggal_absen,jam_in,jam_out,status_masuk,status_keluar,terlambat,pulangcepat) 
										VALUES  ('','$p_id_nip','$p_shift','$p_tgl_absen','$p_jam_in','$p_jam_out','Y','Y','$telat','$pulang_cepat')");
						
								if ($q_absensi > 0) {
										echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Absen berhasil di simpan <a href='?id=data_absen'>KEMBALI</a><br/></div>";
									} else {
										echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
									}
		
							} else {
								echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Pegawai dengan NIP ".$p_id_nip." tidak terdaftar <br/></div>";
							}
						} 									
    } 
	
	if ($tb_act == "UBAH") {
		
							$cek_nip= mysqli_query($mysqli,"select * from pegawai where nip='$p_id_nip'");
							$resultceknip=mysqli_num_rows($cek_nip);
							
							if ($resultceknip > 0) {
								$q_absensi	= mysqli_query($mysqli,"UPDATE absensi SET jam_in='$p_jam_in', jam_out='$p_jam_out',terlambat='$telat',pulangcepat='$pulang_cepat', id_abs='$p_shift',tanggal_absen='$p_tgl_absen' where id_absensi='$p_id_absensi' ");
						
								if ($q_absensi > 0) {
										echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Absen berhasil di ubah <a href='?id=data_absen'>KEMBALI</a><br/></div>";
									} else {
										echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
									}
		
							} else {
								echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Pegawai dengan NIP ".$p_id_nip." tidak terdaftar <br/></div>";
							}
															
    } 


    ?>

    <div class="col-sm-12">
    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#pl">
                    <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
                    Form Input Absen

                </a>
            </li>
        </ul>

<?php
$id_absensi 	    = isset($_GET['id_absensi']) ? $_GET['id_absensi'] : NULL;
$data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM absensi WHERE id_absensi=".$id_absensi));


if($id_absensi> 0) { 
	$id_absensi = $data['id_absensi'];
	$id_nip = $data['nip'];
	$id_abs= $data['id_abs'];
	$jam_in = $data['jam_in'];
	$jam_out = $data['jam_out'];
	$tanggal_absen = $data['tanggal_absen'];
	$tombol = "UBAH";
	$readonly="readonly=true";
	

} else  {
	$id_absensi = "";
	$id_nip = "";
	$id_abs= "";
	$jam_in = "00:00:00";
	$jam_out = "00:00:00";
	$tanggal_absen = "";
	$tombol = "SIMPAN";
	$readonly="";
	
}  
?>     
        <div class="tab-content profile-edit-tab-content">
            <div id="pl" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
				
				<input name="id_absensi" value="<?php echo $id_absensi  ?>" id="id_absensi" type="text" hidden="hidden" />

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Absen :</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tgl_absen" value="<?php echo $tanggal_absen ?>" id="tgl_absen" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>

                    </div>
					
				

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" >Nip :</label>
						<div class="col-xs-3 col-sm-2">
						 <div class="input-group">
                      <input type="text" class="form-control search_keyword" <?php echo $readonly?> name="absennip" value="<?php echo $id_nip ?>" id="search_keyword_id" placeholder="Ketikan nip pegawai..." required>
					   <input type="text" class="form-control" name="nama" id="search_keyword_name" placeholder="" readonly>
                       <span id="result"></span>
					   </div>
						</div>
                    </div>
					
                    <div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="jam_masuk">Jam Masuk :</label>
					<div class="col-xs-3 col-sm-2">
					<div class="input-group bootstrap-timepicker">
					<input id="timepicker1" type="text" class="form-control" name="jam_in" value="<?php echo $jam_in ?>" required/>
					<span class="input-group-addon">
					<i class="glyphicon glyphicon-time"></i>
					</span>
					</div>
					</div>
					</div>




					<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="jam_pulang">Jam Pulang :</label>
					<div class="col-xs-3 col-sm-2">
					<div class="input-group bootstrap-timepicker">
					<input id="timepicker2" type="text" class="form-control" name="jam_out" value="<?php echo $jam_out ?>" required/>
					<span class="input-group-addon">
					<i class="glyphicon glyphicon-time"></i>
					</span>
					</div>
					</div>
					</div>
					
					<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right">Shift :</label>
											<div class="col-sm-9">
											
											<select name="shift" value="" required>
												<option>-- Pilih Shift --</option>
													<?php
												$q = mysqli_query($mysqli,"select * from tbl_absen order by id_abs");

													while ($a = mysqli_fetch_array($q)){
													if ($a[0] ==$id_abs) {
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
                        <label class="col-sm-3 control-label no-padding-right" ></label>
                        <div >
                            <input type="submit" class="btn btn-info" name="tb_act" id="simpan" value="<?php echo $tombol ?>" />
                            <a href="?id=data_absen" class="btn btn-danger"/>Kembali</a>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

