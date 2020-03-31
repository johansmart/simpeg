<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='3' )

{
?>

<div class="col-xs-12 col-sm-6 widget-container-col">
    <div class="widget-box widget-color-red">
        <div class="widget-header widget-header-small">
            <h6 class="widget-title">
                <i class="ace-icon fa fa-sort"></i>
                Rekapitulasi Berdasarkan Tanggal Absensi
            </h6>

            <div class="widget-toolbar">
                Klik disini

                <a href="#" data-action="collapse">
                    <i class="ace-icon fa fa-plus" data-icon-show="fa-plus" data-icon-hide="fa-minus"></i>
                </a>

                <a href="#" data-action="close">
                    <i class="ace-icon fa fa-times"></i>
                </a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">

        <form action="cetak/lap_absensirekapharian.php" target="_blank" class="form-horizontal" method="POST" > 
			<div class="widget-main">
				<ul class="list-unstyled spaced2">
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">Tanggal</label>
                        <div class="col-sm-3">
          
							<input class="col-xs-12 date-picker" id="id-date-picker-1" name ="awal" type="text" data-date-format="yyyy-mm-dd" />
								
                        </div>
						<label class="col-sm-1 control-label no-padding-right" for="form-field-username">s/d</label>
                        <div class="col-sm-3">
                           <input class="col-xs-12 date-picker" id="id-date-picker-1" name ="akhir" type="text" data-date-format="yyyy-mm-dd" />
								
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">Tanda Tangan</label>
                        <div class="col-sm-5">
                           <input class="col-xs-12 " id="ttd" name ="ttd" type="text" placeholder="Isikan nama " />
							
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username"></label>
                        <div class="col-sm-5">
          
							<input type="submit" name="hari" class="btn btn-info" value="Cetak" />
                        </div>
                    </div>
					
				</ul>
			</div>
		</form>	

            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-sm-6 widget-container-col">
    <div class="widget-box widget-color-red">
        <div class="widget-header widget-header-small">
            <h6 class="widget-title">
                <i class="ace-icon fa fa-sort"></i>
                Rekapitulasi Berdasarkan Bulan Absensi
            </h6>

            <div class="widget-toolbar">
                Klik disini

                <a href="#" data-action="collapse">
                    <i class="ace-icon fa fa-plus" data-icon-show="fa-plus" data-icon-hide="fa-minus"></i>
                </a>

                <a href="#" data-action="close">
                    <i class="ace-icon fa fa-times"></i>
                </a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">

        <form action="cetak/lap_absensirekapbulan.php" target="_blank" class="form-horizontal" method="POST" > 
			<div class="widget-main">
				<ul class="list-unstyled spaced2">
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">Bulan</label>
                        <div class="col-sm-5">
                            <select name="bulan" value="" id="bulan" >
												<option value=''>-- Pilih Bulan--</option>
												<option value='01'>Januari</option>
												<option value='02'>Februari</option>
												<option value='03'>Maret</option>
												<option value='04'>April</option>
												<option value='05'>Mei</option>
												<option value='06'>Juni</option>
												<option value='07'>Juli</option>
												<option value='08'>Agustus</option>
												<option value='09'>September</option>
												<option value='10'>Oktober</option>
												<option value='11'>Nopember</option>
												<option value='12'>Desember</option>
											
												
											</select>
											
								
                        </div>
					  <label class="col-sm-1 control-label no-padding-right" for="form-field-username">Tahun</label>
						<div class="col-sm-2">
					
                            <select name="tahun" value="" id="tahun" >
												<option value=''>-- Pilih Tahun--</option>
                                                <option value='2015'>2015</option>
                                                <option value='2016'>2016</option>
                                                <option value='2017'>2017</option>
                                                <option value='2018'>2018</option>
                                                <option value='2019'>2019</option>
                                                <option value='2020'>2020</option>
                                                <option value='2021'>2021</option>
											
												
											</select>
											
								
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username">Tanda Tangan</label>
                        <div class="col-sm-5">
                            <input class="col-xs-12 " id="ttd" name ="ttd" type="text" placeholder="Isikan nama " />
							
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-username"></label>
                        <div class="col-sm-5">
          
							<input type="submit" name="hari" class="btn btn-info" value="Cetak" />
                        </div>
                    </div>
					
					
				</ul>
			</div>
		</form>	

            </div>
        </div>
    </div>
</div>


<?php
}else{
    header('Location:../index.php?status=Silahkan Login');
}
?>