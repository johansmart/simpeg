<?php
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='3'  )

{

$id_cuti	= isset($_GET['kdcuti']) ? $_GET['kdcuti'] : NULL;


$data2 = mysqli_query($mysqli,"SELECT ajuancuti.kdcuti,
									pegawai.nip,pegawai.nama,
									ajuancuti.tgl_pengajuan,
									tbl_cuti.n_cuti,
									ajuancuti.tgl_mulai,
									ajuancuti.tgl_akhir,
									ajuancuti.lama_cuti,
									status_app.approve,
									ajuancuti.alasan,
									ajuancuti.kd_approve,
									ajuancuti.pesan_approve,
									ajuancuti.id_cuti FROM ajuancuti,pegawai,tbl_cuti,status_app where ajuancuti.id=pegawai.id and ajuancuti.id_cuti=tbl_cuti.id_cuti and ajuancuti.kd_approve=status_app.kd_approve and ajuancuti.kdcuti='$id_cuti' ORDER BY ajuancuti.tgl_approve DESC");

    $c = mysqli_fetch_array($data2);

?>

 <div class="col-sm-12">
    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#pl">
                    <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
                    Form Approve Cuti

                </a>
            </li>
        </ul>


        
        <div class="tab-content profile-edit-tab-content">
            <div id="pl" class="tab-pane fade in active">
               
            <form action="?id=datacuti" method="post" id="ft_datacuti" class="form-horizontal">

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="cuti">Kode</label>
                    <div class="col-sm-9">
                <input type="text" size="3" name="kdcuti" readonly value="<?php echo $c['0'];?>">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="cuti">NIP</label>
                    <div class="col-sm-9">
                        <input class="input-medium" type="text" name="nip" readonly id="nip" value="<?php echo $c['1'];?>"/>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="cuti">Nama Pegawai</label>
                    <div class="col-sm-9">
                        <input class="input-medium" type="text" name="nm" readonly id="nm" value="<?php echo $c['2'];?>"/>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="cuti">Jenis Cuti</label>
                    <div class="col-sm-9">
                      <select name="id_cuti" value="" id="id_cuti" >
                            <option>-- Pilih Cuti--</option>
                            <?php
                            $q = mysqli_query($mysqli,"select * from tbl_cuti");
                            while ($a = mysqli_fetch_array($q)){
                                if ($a['id_cuti'] == $c['id_cuti']) {
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
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-date">Tanggal Awal Cuti</label>

                    <div class="col-sm-9">
                        <div class="input-medium">
                            <div class="input-group">
                                <input class="input-medium date-picker" id="tgl_awal" type="text" data-date-format="yyyy-mm-dd" name="tgl_awal" readonly placeholder="yyyy-mm-dd" value="<?php echo $c['5'];?>" />
																			<span class="input-group-addon">
																				<i class="ace-icon fa fa-calendar"></i>
																			</span>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-date">Tanggal Akhir Cuti</label>

                    <div class="col-sm-9">
                        <div class="input-medium">
                            <div class="input-group">
                                <input class="input-medium date-picker" id="tgl_akhir" type="text" data-date-format="yyyy-mm-dd" name="tgl_akhir" readonly placeholder="yyyy-mm-dd" value="<?php echo $c['6'];?>" />
																			<span class="input-group-addon">
																				<i class="ace-icon fa fa-calendar"></i>
																			</span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-first">Lama</label>

                    <div class="col-sm-9">
                        <input class="input-medium" type="text" name="lama" id="lama" readonly placeholder="Jumlah hari" value="<?php echo $c['7'];?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-comment">Alasan</label>

                    <div class="col-xs-20 col-sm-9">
                        <textarea type="text" id="alasan" maxlength="200" readonly  name="alasan"><?php echo $c['9'];?></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="cuti">Konfirmasi</label>
                    <div class="col-sm-9">
                        <select name="kd_approve" value="" id="kd_approve">
                            <option>-- Pilih Cuti--</option>
                            <?php

                            if($_SESSION['leveluser']=='6'){
                                $q = mysqli_query($mysqli,"select * from status_app where kd_approve in (4,2)");
                            }elseif($_SESSION['leveluser']=='7'){
                                $q = mysqli_query($mysqli,"select * from status_app where kd_approve in (5,2)");
                            }else {
                                $q = mysqli_query($mysqli,"select * from status_app where kd_approve not in (4,5) ");
                            }

                            while ($a = mysqli_fetch_array($q)){
                                if ($a['0'] == $c['10']) {
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
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-comment">PESAN</label>

                    <div class="col-xs-20 col-sm-9">
                        <textarea type="text" id="pesan" maxlength="200"  name="pesan"><?php echo $c['11'];?></textarea>
                    </div>
                </div>


             <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" ></label>
                        <div >
                            <input type="submit" class="btn btn-info" name="tb_act" id="simpan" value="Konfirmasi" />
                            <a href="?id=datacuti" class="btn btn-danger"/>Kembali</a>
                        </div>

                    </div>
    </div>
		</form>
            </div>
        </div>
    </div>

<?php
}else{
	  echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>	