<?php
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1' && $sesi_level !='3'){
    header('location:../index.php');

} 

	$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;			
    $p_awali  	    = isset($_POST['awali']) ? $_POST['awali'] : NULL;
	$p_akhiri  	    = isset($_POST['akhiri']) ? $_POST['akhiri'] : NULL;
	$p_id_nip  	    = isset($_POST['nip']) ? $_POST['nip'] : NULL;
	$p_ijin  	    = isset($_POST['ijin']) ? $_POST['ijin'] : NULL;
	$p_ket  	    = isset($_POST['keterangan']) ? $_POST['keterangan'] : NULL;

    if ($tb_act == "SIMPAN") {
		if ($p_akhiri < $p_awali ) {
			          echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Tanggal akhir tidak boleh lebih besar dari pada tanggal awal<br/></div>";
		} else { 
		
		$cek_absen= mysqli_query($mysqli,"select * from absensi where tanggal_absen between '$p_awali' and '$p_akhiri' and nip='$p_id_nip' ");
		$resultcek=mysqli_num_rows($cek_absen);
		
					if ($resultcek > 0) {
						echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Pegawai tersebut sudah melakukan absensi pada tanggal ".$p_awali." s/d ".$p_akhiri."<br/></div>";
						} else {
						$q_tambah_ijin	= mysqli_query($mysqli,"INSERT INTO history_ijin VALUES ('','$p_id_nip','$p_awali','$p_akhiri','$p_ijin','$p_ket')");
						
							if ($q_tambah_ijin > 0) {
								while (strtotime($p_awali)<=strtotime($p_akhiri)){
								$sql="INSERT INTO absensi (nip,tanggal_absen,ket,id_ijin) VALUES ('$nip','$p_awali\n','$p_ket','$p_ijin')";
								$hasil=mysqli_query($mysqli,$sql);
								$p_awali=date("Y-m-d",strtotime("+1 day",strtotime($p_awali)));
								} 		
								echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data ijin pegawai berhasil di simpan <a href='?id=data_absen'>KEMBALI</a><br/></div>";
									} else {
										echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
									}
		
						}		
		
				
				}  
				
    } 


    ?>

    <div class="col-sm-12">
    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#pl">
                    <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
                    Form Input Ijin

                </a>
            </li>
        </ul>


        
        <div class="tab-content profile-edit-tab-content">
            <div id="pl" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
               


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Awal Ijin:</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="awali" value="" id="awali" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>

                    </div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Akhir Ijin:</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="akhiri" value="" id="akhiri" type="text" data-date-format="yyyy-mm-dd"/>
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
                      <input type="text" class="form-control search_keyword" name="nip" id="search_keyword_id" placeholder="Ketikan nip pegawai..." required>
					   <input type="text" class="form-control" name="nama" id="search_keyword_name" placeholder="" readonly>
                       <span id="result"></span>
					   </div>
						</div>
                    </div>
					
					
					 <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" ></label>
                        <div >
						<div class="col-xs-3 col-sm-4">
						  <label class="blue">
							<input name="ijin"  id="ijin" value="1" <?=$ijin =='1' ? ' checked="checked"' : '';?> type="radio" />
							<span class="lbl"> Ijin</span>
						</label>

						<label class="blue">
						<input name="ijin"  id="ijin" value="2" <?=$ijin =='2' ? ' checked="checked"' : '';?> type="radio" />
						<span class="lbl"> Sakit</span>
						</label>
						</div>
						</div>
                           
                    </div>

                    
					
					 <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" >Keterangan</label>
                        <div >
						<div class="col-xs-3 col-sm-3">
                           <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Isikan Keterangan" ></textarea>
						   </div>
                        </div>

                    </div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" ></label>
                        <div >
                            <input type="submit" class="btn btn-info" name="tb_act" id="simpan" value="SIMPAN" />
                            <a href="?id=data_absen" class="btn btn-danger"/>Kembali</a>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

