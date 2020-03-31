<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='5' )

{



?>

<div class="col-xs-3 col-sm-12 pricing-box">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">Form Laporan Absensi</h5>
		</div>
		
		
		<div class="widget-body">
		<form action="cetak/lap_absensi_user.php"  target="_blank" class="form-horizontal" method="POST" > 
			<div class="widget-main">
				<ul class="list-unstyled spaced2">
				<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">NIP</label>
                      
						<div class="col-xs-8 col-sm-2">
							<div class="input-group">
								<input class="form-control" type="text" name="nip" value="<?php echo "$nip"?>" readonly />
																
							</div>
						</div>
					
                    </div>
				
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">Tanggal Awal</label>
                      
						<div class="col-xs-8 col-sm-2">
							<div class="input-group">
								<input class="form-control date-picker" id="id-date-picker-1" type="text" name="awal" data-date-format="yyyy-mm-dd" />
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
							</div>
						</div>
					
                    </div>
					
					
				<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">Tanggal Akhir</label>
                       
						<div class="col-xs-8 col-sm-2">
							<div class="input-group">
								<input class="form-control date-picker" id="id-date-picker-1" type="text" name="akhir" data-date-format="yyyy-mm-dd" />
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
							</div>
						</div>
					

                </div>	
				
				<div class="form-group">
				 <label class="col-sm-3 control-label no-padding-right"></label>
				<div class="col-xs-2 col-sm-3">
				<input class="btn btn-danger" type="submit" value="Print To PDF"/>
				
				</div>
				</div>
				
			
				
			
				
					
				</ul>

				
			</div>

			<div>
			

			
			</div>
		</form>	
		</div>
		
	</div>
</div>





<?php
}else{
    header('Location:../index.php?status=Silahkan Login');
}
?>	
