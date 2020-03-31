<?php


if(isset($_POST['submit'])){ 


            $tanggalalfa 	= isset($_POST['tanggalalfa']) ? $_POST['tanggalalfa'] : NULL;
			$tanggal	 	= isset($_POST['tanggal']) ? $_POST['tanggal'] : NULL;
            $nipalfa 		= isset($_POST['nipalfa']) ? $_POST['nipalfa'] : NULL;
			$namaalfa 		= isset($_POST['namaalfa']) ? $_POST['namaalfa'] : NULL;
       
 
			$cekQuery = mysqli_query($mysqli,"SELECT nip,nama FROM pegawai WHERE nip NOT IN (SELECT nip FROM absensi where tanggal_absen='$tanggal') and kdstatusp >0"); //Cek Jumlah data
			$jumlahData = mysqli_num_rows($cekQuery);
		
            for($i = 0; $i < $jumlahData; $i++){
					
				$query = "INSERT INTO absensi (tanggal_absen,nip,id_ijin,time_update,ket) values ('".$tanggalalfa[$i]."','".$nipalfa[$i]."','4',NOW(),'Tidak Masuk')";
				$sql = mysqli_query ($mysqli,$query); 
				$sqlf = mysqli_fetch_array($sql);
				
              
            }
			
           
                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pegawai alfa berhasil di prosess</div>";
               

        
            }      

?>


 <div class="col-sm-12">
    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#pl">
                    <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
                    Form Cek Alfa

                </a>
            </li>
        </ul>


        
        <div class="tab-content profile-edit-tab-content">
            <div id="pl" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
               


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal:</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tanggal" value="" id="tanggal" type="text" data-date-format="yyyy-mm-dd" required/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>

                    </div>
					
					

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" ></label>
                        <div >
                            <input type="submit" class="btn btn-info" name="tb_act" id="tampilkan" value="Tampilkan" />
                            <a href="?id=data_absen" class="btn btn-danger"/>Kembali</a>
                        </div>

                    </div>

                </form>
            </div>
			<?php
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1' && $sesi_level !='2'){
    header('location:../index.php');

} 

	$tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;			
    $p_tanggal  	= isset($_POST['tanggal']) ? $_POST['tanggal'] : NULL;


	if ($tb_act=="Tampilkan")
		{
			 echo "<form action='' method='POST'><table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th>NO</th><th>Tanggal</th><th>NIP</th><th>NAMA</th>";
                $q_cek 	    = mysqli_query($mysqli,"SELECT nip,nama FROM pegawai WHERE nip NOT IN (SELECT nip FROM absensi where tanggal_absen='$p_tanggal') and kdstatusp >0 ") or die (mysqli_error($mysqli));
                $j_data 	= mysqli_num_rows($q_cek);
			
                if ($j_data == 0) {
                    echo "<tr><td colspan='4'>-- Tidak Ada Data --</td></tr>";
                } else {
					
                    $no=1;
                    while ($a_cek = mysqli_fetch_array($q_cek)) {
								
							 echo "<tr><td>$no</td>
							 <td><input type='text' name='tanggalalfa[]' readonly='true' value='$p_tanggal'/></td>
							<td><input type='text' name='nipalfa[]' readonly='true' value='$a_cek[nip]'/></td>
							<td><input type='text' name='namaalfa[]' readonly='true' value='$a_cek[nama]'/></td>
          
							</tr>";
							$no++;
					}
					
			
			}
                echo "</table>
				<input type='text' name='tanggal' value='$p_tanggal' hidden/>
				<input type='submit' name='submit' class='btn btn-danger form-control' value='PROSES' onclick=\"return confirm('Apakah Anda Yakin?')\"/>
				</form>";
			
			
		}
	
?>	
        </div>
    </div>
	

	
