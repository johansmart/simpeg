<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1'){
    header('location:index.php');

} 
   if(isset($_POST['submit'])){
            $idpt           = $_POST['idpt'];
			$nm_pt          = $_POST['nm_pt'];
			$alamat         = $_POST['alamat'];
			$npwp_pt        = $_POST['npwp_pt'];
			$email_pt       = $_POST['email_pt'];
			$web        	= $_POST['web'];
			$skin        	= $_POST['skin'];
			$absensi        = $_POST['absensi'];
            $maxsize        = 2097152;
            $nama_file      = $_FILES['file']['name'];
            $size_file      = $_FILES['file']['size'];
            $type_file      = $_FILES['file']['type'];

                if(($_FILES['file']['size'] >= $maxsize))
                {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong> upload eroors<br/></div>";
                }	else {
                    if (($_FILES['file']['size'] == 0) ){

                        $q_edit1 = mysqli_query($mysqli,"UPDATE master set nm_pt ='$nm_pt',alamat_pt='$alamat',npwp ='$npwp_pt',email_pt='$email_pt',web='$web',absensi='$absensi',skin='$skin' where id ='$idpt'");
                        if ($q_edit1 > 0) {
                                echo "<script>alert('Berhasil');</script>";
								echo "<script>document.location.href='javascript:history.back(0)';</script>";
                        } else {
                            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                        }
                    }else {
                        $uploaddir = 'logo/';
                        $alamatfile = $uploaddir . $nama_file;
                        move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile);

                        $q_edit2 = mysqli_query($mysqli,"UPDATE master set nm_pt ='$nm_pt',alamat_pt='$alamat',npwp ='$npwp_pt',logo='$alamatfile',email_pt='$email_pt',web='$web',absensi='$absensi',skin='$skin' where id ='$idpt'");
                        if ($q_edit2 > 0) {
                                echo "<script>alert('Berhasil');</script>";
								echo "<script>document.location.href='javascript:history.back(0)';</script>";
                        } else {
                            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                        }
                    }

                }

            }      
        ?>



							<!--PAGE CONTENT BEGINS-->
	
							<div class="row">
								<div class="widget-container-col">
									<div class="widget-box">
										<div class="widget-header">
											<h5 class="widget-title">PERUSAHAAN</h5>

                                            <div class="widget-toolbar">
                                                <div class="widget-menu">
                                                    <a href="#" data-action="settings" data-toggle="dropdown">
                                                        <i class="ace-icon fa fa-bars"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
                                                        <li>
                                                            <a data-toggle="tab" href="#dropdown1">Option#1</a>
                                                        </li>

                                                        <li>
                                                            <a data-toggle="tab" href="#dropdown2">Option#2</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <a href="#" data-action="fullscreen" class="orange2">
                                                    <i class="ace-icon fa fa-expand"></i>
                                                </a>

                                                <a href="#" data-action="reload">
                                                    <i class="ace-icon fa fa-refresh"></i>
                                                </a>

                                                <a href="#" data-action="collapse">
                                                    <i class="ace-icon fa fa-chevron-up"></i>
                                                </a>

                                                <a href="#" data-action="close">
                                                    <i class="ace-icon fa fa-times"></i>
                                                </a>
                                            </div>
                                        </div>


										<div class="widget-body">
											<div class="widget-main">
											<div class="btn-group">

											</div>
		<?php
		$view2=mysqli_query($mysqli,"select * from master");
		$row2=mysqli_fetch_array($view2);
		$logo=$row2['logo'];
		$logor=str_replace("../"," ",$logo);
			
		?>	
																	
							<form class="form-horizontal" action="" method="post" id="uploadAjaxImage" enctype="multipart/form-data">
							<input type="hidden" name="idpt" value="<?php echo $row2['id'];?>">

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Logo :</label>
                                    <div class="col-sm-5">
                                        <div id="image_preview">
                                            <img id="previewing" src="<?php echo $logor; ?>" width="250" height="230"/></div>
                                        <span id='loading'></span>
                                        <div id="message"></div>
                                    </div>
                                </div>

                                <div class="form-group" id="selectImage">
                                    <label class="col-sm-2 col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <input type="file" name="file" id="file"/>

                                    </div>
                                </div>

                                <div class="form-group" id="selectImage">
                                    <label class="col-sm-2 col-sm-2 control-label">Nama Perusahaan :</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="nm_pt" class="col-xs-10 col-sm-10" value="<?php echo $row2['nm_pt'];?>">
                                    </div>
                                </div>


                                <div class="form-group" id="selectImage">
                                    <label class="col-sm-2 col-sm-2 control-label">Alamat :</label>
                                    <div class="col-sm-5">
                                        <textarea name='alamat' id='alamat' class="col-xs-10 col-sm-10"><?php echo $row2['alamat_pt'];?></textarea>
                                    </div>
                                </div>

                                <div class="form-group" id="selectImage">
                                    <label class="col-sm-2 col-sm-2 control-label">NPWP :</label>
                                    <div class="col-sm-5">
                                        <input value="<?php echo $row2['npwp'];?>" class="col-xs-10 col-sm-5" type="text" name="npwp_pt" id="npwp_pt">
                                    </div>
                                </div>
								
								<div class="form-group" id="selectImage">
                                    <label class="col-sm-2 col-sm-2 control-label">Email :</label>
                                    <div class="col-sm-5">
                                        <input value="<?php echo $row2['email_pt'];?>" class="col-xs-10 col-sm-5" type="email" name="email_pt" id="email_pt">
                                    </div>
                                </div>
								
								<div class="form-group" id="selectImage">
                                    <label class="col-sm-2 col-sm-2 control-label">Web :</label>
                                    <div class="col-sm-5">
                                        <input value="<?php echo $row2['web'];?>" class="col-xs-10 col-sm-5" type="text" name="web" id="web">
                                    </div>
                                </div>
								
					<div class="form-group">
                        <label class="col-sm-2 control-label col-sm-2" >Absensi User :</label>
                        <div >
						<div class="col-sm-5">
						  <label class="blue">
							<input name="absensi"  id="ijin" value="1" <?=$row2['absensi'] =='Y' ? ' checked="checked"' : '';?> type="radio" />
							<span class="lbl"> Ya</span>
						</label>

						<label class="blue">
						<input name="absensi"  id="ijin" value="2" <?=$row2['absensi'] =='N' ? ' checked="checked"' : '';?> type="radio" />
						<span class="lbl"> Tidak</span>
						</label>
						</div>
						</div>
                           
                    </div>
					
					
					  <div class="form-group">
                              <label class="col-sm-2 control-label col-sm-2" >Skin :</label>

                            <div class="col-sm-5">
											
											<select name="skin">
                                                <option>-- Pilih Skin--</option>
                                                <?php
                                            
                                                    if ($row2['skin'] =='skin-1') {
                                                        echo "<option value='skin-1' selected>Skin1</option>
														<option value='skin-2'>Skin2</option>
														<option value='skin-3'>Skin3</option>
														<option value='skin-4'>Skin4</option>
														";
                                                    } else if($row2['skin'] =='skin-2') {
                                                         echo "<option value='skin-1' >Skin1</option>
														<option value='skin-2' selected>Skin2</option>
														<option value='skin-3'>Skin3</option>
														<option value='skin-4'>Skin4</option>
														";
                                                    }else if($row2['skin'] =='skin-3') {
                                                         echo "<option value='skin-1' >Skin1</option>
														<option value='skin-2'>Skin2</option>
														<option value='skin-3' selected>Skin3</option>
														<option value='skin-4'>Skin4</option>
														";
                                                    }else if($row2['skin'] =='skin-4') {
                                                         echo "<option value='skin-1'>Skin1</option>
														<option value='skin-2'>Skin2</option>
														<option value='skin-3'>Skin3</option>
														<option value='skin-4' selected>Skin4</option>
														";
                                                    }
                                                
                                                ?>
                                            </select>
											
                            </div>
                        </div>

						
							<div class="widget-toolbox padding-8 clearfix">
												<button class="btn btn-mini btn-danger pull-left">
													<i class="icon-home"></i>
													HOME
												</button>

												<button name="submit" type="submit" class="btn btn-mini btn-success pull-right">
													SIMPAN
													<i class="icon-arrow-right icon-on-right"></i>
												</button>
									</div>	
							</form>
							
											</div>
											
										</div>
									
									</div>
									
									
								</div>


								<div class="span6 widget-container-span">
									<div class="widget-box">
										<div class="widget-header header-color-blue">
											<h5 class="bigger lighter">
												<i class="icon-table"></i>
												Tabel User Admin ASKA
											</h5>

											<div class="widget-toolbar widget-toolbar-light no-border">
												<select id="simple-colorpicker-1" class="hide">
													<option selected="" data-class="blue" value="#307ECC" />#307ECC
													<option data-class="blue2" value="#5090C1" />#5090C1
													<option data-class="blue3" value="#6379AA" />#6379AA
													<option data-class="green" value="#82AF6F" />#82AF6F
													<option data-class="green2" value="#2E8965" />#2E8965
													<option data-class="green3" value="#5FBC47" />#5FBC47
													<option data-class="red" value="#E2755F" />#E2755F
													<option data-class="red2" value="#E04141" />#E04141
													<option data-class="red3" value="#D15B47" />#D15B47
													<option data-class="orange" value="#FFC657" />#FFC657
													<option data-class="purple" value="#7E6EB0" />#7E6EB0
													<option data-class="pink" value="#CE6F9E" />#CE6F9E
													<option data-class="dark" value="#404040" />#404040
													<option data-class="grey" value="#848484" />#848484
													<option data-class="default" value="#EEE" />#EEE
												</select>
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main no-padding">
												<table class="table table-striped table-bordered table-hover">
													<thead>
		
														<tr>
															<th>
																<i class="icon-user"></i>
																User
															</th>

															<th>
																<i>@</i>
																Email
															</th>
															<th class="hidden-480">Status</th>
														</tr>
													</thead>
<?php
		$view3=mysqli_query($mysqli,"select id_user,username,w_login,email,photo,user.n_lv, status_app.approve from tbl_user,user,status_app where tbl_user.level_user=user.level_user and tbl_user.kd_approve=status_app.kd_approve and tbl_user.level_user < 5");
		while($row3=mysqli_fetch_array($view3)){
		?>
													<tbody>
														<tr>
															<td class=""><a href="#"><?php echo $row3['username'];?></a></td>

															<td>
																<?php echo $row3['email'];?>
															</td>

															<td class="hidden-480">
																<span class="label label-warning"><?php echo $row3['n_lv'];?></span>
																
															</td>
														</tr>

<?php
		}
		?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div><!--/span-->


							
