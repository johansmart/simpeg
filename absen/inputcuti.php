<?php
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1' && $sesi_level !='3'){
    header('location:../index.php');

} 
		$mode_form 	= isset($_GET['mod']) ? $_GET['mod'] : "";
        $p_idcuti 	= isset($_POST['id_cuti']) ? $_POST['id_cuti'] : "";
        $p_tombol 	= isset($_POST['tb_act']) ? $_POST['tb_act'] : "";
        $p_tglawal 	= isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : "";
        $p_tglakhir = isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : "";
        $p_lama 	= isset($_POST['lama']) ? $_POST['lama'] : "";
        $p_alasan 	= isset($_POST['alasan']) ? $_POST['alasan'] : "";
		$p_nip 		= isset($_POST['nipp']) ? $_POST['nipp'] : "";
		$p_kd_approve 	= isset($_POST['kd_approve']) ? $_POST['kd_approve'] : "";
		

        if ($p_tombol == "SIMPAN") {
            if ($p_idcuti == "" || $p_tglawal == "" || $p_tglakhir == "" || $p_lama == ""|| $p_alasan == ""
			
            ) {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Form Isian Masih Belum lengkap mohon di lengkapi<br/></div>";

            } else {
				
				$q_cari_id 		= mysqli_query($mysqli, "select id from pegawai where nip='$p_nip'");
                $j_cari_id 		= mysqli_fetch_array($q_cari_id);
				$c_id_pegawai	=$j_cari_id[0];
				
			
                $q_cek_ganda = mysqli_query($mysqli, "SELECT * FROM ajuancuti WHERE tgl_mulai='$p_tglawal' and id='$c_id_pegawai'");
                $j_cek_ganda = mysqli_fetch_array($q_cek_ganda);

                if ($j_cek_ganda > 0) {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Tanggal $p_tglawal anda sudah mengacukan cuti <br/></div>";
                } else {

                    if ($p_idcuti==1) {
                        $q_sisa_cuti = mysqli_query($mysqli, "select * from tbl_jatahcuti where nip='$p_nip'");
                        $j_sisa_cuti = mysqli_fetch_array($q_sisa_cuti);

                         $q_tgl_masuk = mysqli_query($mysqli, "select tgl_masuk from pegawai where nip='$p_nip'");
                        $j_tgl_masuk = mysqli_fetch_array($q_tgl_masuk);
                        $tahunkerja = MasaKerjaTahun($j_tgl_masuk[0],$tahunM,$bulanM,$tanggalM);

                        if ($tahunkerja == 0) {
                            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Masa Kerja anda belum 1 tahun anda tidak bisa mengajukan cuti tahunan !!!<br/></div>";
                        } else {

                        if ($p_lama < 12) {
                            if ($j_sisa_cuti['sisa_cuti'] ==0) {
                                $q_daftar = mysqli_query($mysqli, "INSERT INTO ajuancuti (kdcuti,id,id_cuti,tgl_pengajuan,tgl_mulai,tgl_akhir,lama_cuti,alasan,kd_approve,nip) VALUES ('','$c_id_pegawai','$p_idcuti',NOW(),'$p_tglawal','$p_tglakhir','$p_lama','$p_alasan','3','$p_nip')");

                                if ($q_daftar > 0) {
                                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Pengajuan Cuti Anda Berhasil di simpan<br/></div>";
                                } else {
                                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                                }
                            } else {

                                if ($j_sisa_cuti['sisa_cuti'] < $p_lama) {
                                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Lama cuti yang anda ajukan melebihi sisa cuti / sisa cuti anda habis <br/></div>";
                                } else {
                                    $q_daftar = mysqli_query($mysqli, "INSERT INTO ajuancuti (kdcuti,id,id_cuti,tgl_pengajuan,tgl_mulai,tgl_akhir,lama_cuti,alasan,kd_approve,nip) VALUES ('','$c_id_pegawai','$p_idcuti',NOW(),'$p_tglawal','$p_tglakhir','$p_lama','$p_alasan','$p_kd_approve','$p_nip')");

                                    if ($q_daftar > 0) {
                                        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Pengajuan Cuti Anda Berhasil di simpan<br/></div>";
                                    } else {
                                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                                    }
                                }
                            }

                        } else {
                            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Lama Cuti Tahunan tidak boleh lebih dari 12 hari <br/></div>";
                        }
                    }
                    } else {

                        $q_daftar = mysqli_query($mysqli, "INSERT INTO ajuancuti (kdcuti,id,id_cuti,tgl_pengajuan,tgl_mulai,tgl_akhir,lama_cuti,alasan,kd_approve,nip) VALUES ('','$c_id_pegawai','$p_idcuti',NOW(),'$p_tglawal','$p_tglakhir','$p_lama','$p_alasan','$p_kd_approve','$p_nip')");

                        if ($q_daftar > 0) {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Pengajuan Cuti Anda Berhasil di simpan<br/></div>";
                        } else {
                            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                        }

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
                    Form Input Cuti

                </a>
            </li>
        </ul>


        
        <div class="tab-content profile-edit-tab-content">
            <div id="pl" class="tab-pane fade in active">
                <form class="form-horizontal" action="" method="post"  role="form" >
               


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Awal Cuti:</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tgl_awal" value="" id="tgl_awal" type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>

                    </div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="">Tanggal Akhir Cuti:</label>

                        <div class="col-xs-8 col-sm-3">
                            <div class="input-group">
                                <input class="form-control date-picker" name="tgl_akhir" value="" id="tgl_akhir"  type="text" data-date-format="yyyy-mm-dd"/>
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                            </div>
                        </div>

                    </div>
					
					 <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-first">Lama Cuti</label>

                    <div class="col-sm-9">
                        <input class="input-medium" type="text" name="lama" id="lama" readonly placeholder="Jumlah hari" value=""/>
                    </div>
					</div>
					
					<div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="cuti">Jenis Cuti</label>
                <div class="col-sm-9">
                    <select name="id_cuti" value="" id="id_cuti">
                        <option value="">-- Pilih Cuti--</option>
                        <?php
                        $q = mysqli_query($mysqli,"select * from tbl_cuti");

                        while ($a = mysqli_fetch_array($q)){
                            if ($a['0'] ==$p_idcuti) {
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
                        <label class="col-sm-3 control-label no-padding-right" >Nip :</label>
						<div class="col-xs-3 col-sm-2">
						 <div class="input-group">
                      <input type="text" class="form-control search_keyword" name="nipp" id="search_keyword_id" placeholder="Ketikan nip pegawai..." required>
					   <input type="text" class="form-control" name="nama" id="search_keyword_name" placeholder="" readonly>
                       <span id="result"></span>
					   </div>
						</div>
                    </div>
					
					
					

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-comment">Alasan</label>

                    <div class="col-xs-20 col-sm-9">
                        <textarea type="text" id="alasan" maxlength="200" name="alasan"></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="cuti">Konfirmasi</label>
                    <div class="col-sm-9">
                        <select name="kd_approve" value="" id="kd_approve">
                            <option>-- Pilih --</option>
                            <?php
                            $q = mysqli_query($mysqli,"select * from status_app");

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
                        <label class="col-sm-3 control-label no-padding-right" ></label>
                        <div >
                            <input type="submit" class="btn btn-info" name="tb_act" id="simpan" value="SIMPAN" />
                            <a href="?id=datacuti" class="btn btn-danger"/>Kembali</a>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

