<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='5' )

{

?>
    <!-- PAGE CONTENT BEGINS -->
    <div class="clearfix">
        <?php
        $mode_form = isset($_GET['mod']) ? $_GET['mod'] : "";
        $p_idcuti = isset($_POST['id_cuti']) ? $_POST['id_cuti'] : "";
        $p_tombol = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
        $p_id_d = isset($_POST['id_d']) ? $_POST['id_d'] : "";
        $p_tglawal = isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : "";
        $p_tglakhir = isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : "";
        $p_lama = isset($_POST['lama']) ? $_POST['lama'] : "";
        $p_alasan = isset($_POST['alasan']) ? $_POST['alasan'] : "";
		$p_nip = isset($_POST['nip']) ? $_POST['nip'] : "";


        $p_submit = "KIRIM";


        if ($p_tombol == "KIRIM") {
            if ($p_idcuti == "" || $p_tglawal == "" || $p_tglakhir == "" || $p_lama == ""
                || $p_alasan == ""
            ) {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Form Isian Masih Belum lengkap mohon di lengkapi<br/></div>";

            } else {

                $q_cek_ganda = mysqli_query($mysqli, "SELECT * FROM ajuancuti WHERE tgl_mulai='$p_tglawal' and id='$p_id_d' ");
                $j_cek_ganda = mysqli_fetch_array($q_cek_ganda);

                if ($j_cek_ganda > 0) {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Tanggal $p_tglawal anda sudah mengacukan cuti <br/></div>";
                } else {
					
					
                    if ($p_idcuti==1) {
                        $q_sisa_cuti = mysqli_query($mysqli, "select * from tbl_jatahcuti where nip='$p_nip'");
                        $j_sisa_cuti = mysqli_fetch_array($q_sisa_cuti);

                        $q_tgl_masuk = mysqli_query($mysqli, "select tgl_masuk from pegawai where nip='$nip'");
                        $j_tgl_masuk = mysqli_fetch_array($q_tgl_masuk);
                        $tahunkerja = MasaKerjaTahun($j_tgl_masuk[0],$tahunM,$bulanM,$tanggalM);

                        $q_cek_atasan = mysqli_query($mysqli, "select id_jab_a from tbl_struktur where id_jab_b='$sesi_id_jab' ");
                        $j_cek_atasan = mysqli_fetch_array($q_cek_atasan);
                        $jab_atasan=$j_cek_atasan['id_jab_a'];

                        if ($tahunkerja == 0) {
                            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Masa Kerja anda belum 1 tahun anda tidak bisa mengajukan cuti tahunan !!!<br/></div>";
                        } else {
						$queryjatahcuti=mysqli_query($mysqli,"select jatah_cuti from tbl_cuti where id_cuti='1' ");
						$rowjatah=mysqli_fetch_array($queryjatahcuti);
						
                        if ($p_lama < $rowjatah[0]) {
                            if ($j_sisa_cuti['sisacuti'] ==0) {
                                $q_daftar = mysqli_query($mysqli, "INSERT INTO ajuancuti (kdcuti,id,id_cuti,tgl_pengajuan,tgl_mulai,tgl_akhir,lama_cuti,alasan,kd_approve,nip,jab_atasan) VALUES ('','$p_id_d','$p_idcuti',NOW(),'$p_tglawal','$p_tglakhir','$p_lama','$p_alasan','3','$p_nip','$jab_atasan')");

                                if ($q_daftar > 0) {
                                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Pengajuan Cuti Anda Berhasil di simpan<br/></div>";
                                } else {
                                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                                }
                            } else {

                                if ($j_sisa_cuti['sisacuti'] < $p_lama) {
                                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Lama cuti yang anda ajukan melebihi sisa cuti / sisa cuti anda habis <br/></div>";
                                } else {
                                    $q_daftar = mysqli_query($mysqli, "INSERT INTO ajuancuti (kdcuti,id,id_cuti,tgl_pengajuan,tgl_mulai,tgl_akhir,lama_cuti,alasan,kd_approve,nip,jab_atasan) VALUES ('','$p_id_d','$p_idcuti',NOW(),'$p_tglawal','$p_tglakhir','$p_lama','$p_alasan','3','$p_nip','$jab_atasan')");

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

                        $q_daftar = mysqli_query($mysqli, "INSERT INTO ajuancuti (kdcuti,id,id_cuti,tgl_pengajuan,tgl_mulai,tgl_akhir,lama_cuti,alasan,kd_approve,nip,jab_atasan) VALUES ('','$p_id_d','$p_idcuti',NOW(),'$p_tglawal','$p_tglakhir','$p_lama','$p_alasan','3','$p_nip','$jab_atasan')");

                        if ($q_daftar > 0) {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Pengajuan Cuti Anda Berhasil di simpan<br/></div>";
                        } else {
                            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                        }

                    }


                }
            }

        }

		If ($mode_form=="konf"){
					$q_konf = mysqli_query($mysqli, "update ajuancuti set kdnotif='0' where id='$id_daf'");
				
					
								
		}


        ?>


    </div>

    <div class="hr dotted"></div>


<div id="user-profile-1" class="user-profile row">
<div class="col-sm-offset-1 col-sm-10">
    <?php
    $query = mysqli_query($mysqli, "select * from tbl_jatahcuti where tahun=NOW() AND nip='$nip' ");
    $j = mysqli_fetch_array($query);
    echo "<div class='infobox infobox-green infobox-small infobox-dark'>
        <div class='infobox-icon'>
            <i class='ace-icon fa fa-download'></i>
        </div>

        <div class='infobox-data'>
            <div class='infobox-content'>JatahCuti</div>
            <div class='infobox-content'>$j[jatahcuti] Hari</div>
        </div>
        </div>
        <div class='infobox infobox-blue infobox-small infobox-dark'>
        <div class='infobox-icon'>
            <i class='ace-icon fa fa-download'></i>
        </div>

        <div class='infobox-data'>
            <div class='infobox-content'>CutiDiambil</div>
            <div class='infobox-content'>$j[cutiambil] Hari</div>
        </div>
    </div>


    <div class='infobox infobox-grey infobox-small infobox-dark'>
        <div class='infobox-icon'>
            <i class='ace-icon fa fa-download'></i>
        </div>

        <div class='infobox-data'>
            <div class='infobox-content'>Sisa Cuti</div>
            <div class='infobox-content'>$j[sisacuti] Hari</div>
        </div>
    </div>
    * Cuti Tahunan

        ";

    
    ?>



    <div class="space"></div>

    <?php
    $data2 = mysqli_query($mysqli,"SELECT * FROM pegawai,tbl_user,jabatan
    WHERE tbl_user.nip=pegawai.nip and pegawai.id_jab=jabatan.kode and pegawai.id=$id_daf");
    $c = mysqli_fetch_array($data2);

        ?>

        <form class="form-horizontal" name="form" id="valid-ajuancuti" method="post" action="">
        <div class="tabbable">
        <ul class="nav nav-tabs padding-16">
            <li class="active">
                <a data-toggle="tab" href="#edit-basic">
                    <i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
                    Basic Info
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#approved">
                    <i class="purple ace-icon fa fa-check-square-o bigger-125"></i>
                    Riwayat Cuti
                </a>
            </li>

           
        </ul>

        <div class="tab-content profile-edit-tab-content">
        <div id="edit-basic" class="tab-pane in active">
            <h4 class="header blue bolder smaller">Data Pribadi</h4>

            <div class="row">

                <div class="vspace-12-sm"></div>

                <div class="col-xs-12 col-sm-8">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-username">NIP</label>

                        <div class="col-sm-8">
                            <input class="col-xs-12 col-sm-10"  type="text" readonly="readonly" id="nip" placeholder="nip" name="nip" value="<?php echo $c['nip'];?>" />
                            <input class="col-xs-12 col-sm-10"  type="text"  id="id_d" name="id_d" value="<?php echo $id_daf;?>" hidden/>
                        </div>
                    </div>

                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-first">Nama</label>

                        <div class="col-sm-8">
                            <input class="col-xs-12 col-sm-10" disabled="disabled" type="text" id="form-field-first" placeholder="First Name" name="nama" value="<?php echo $c['nama'];?>" />
                        </div>
                    </div>
                </div>
            </div>

            <hr />


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-first">Tempat Lahir</label>

                <div class="col-sm-9">
                    <input class="col-xs-7 col-sm-5" type="text" id="ttl" placeholder="ttl" disabled="disabled" name="ttl" value="<?php echo $c['tmpt_lahir'];?>" />
                </div>
            </div>


            <div class="space-4"></div>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right"  for="form-field-date">Tanggal Lahir </label>

                <div class="col-sm-9">
                    <div class="input-medium">
                        <div class="input-group">
                            <input class="input-medium date-picker" disabled="disabled" id="tgl_lahir" type="text" data-date-format="yyyy-mm-dd" name="tgl_lahir" placeholder="yyyy-mm-dd" value="<?php echo $c['tgl_lahir'];?>" />
																			<span class="input-group-addon">
																				<i class="ace-icon fa fa-calendar"></i>
																			</span>
                        </div>
                    </div>
                </div>
            </div>





            <h4 class="header blue bolder smaller">Pengajuan Cuti</h4>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="cuti">Jenis Cuti</label>
                <div class="col-sm-9">
                    <select name="id_cuti" id="id_cuti">
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
                <label class="col-sm-3 control-label no-padding-right" for="form-field-date">Tanggal Awal Cuti</label>

                <div class="col-sm-9">
                    <div class="input-medium">
                        <div class="input-group">
                            <input class="input-medium date-picker" id="tgl_awal" type="text" data-date-format="yyyy-mm-dd" name="tgl_awal" placeholder="yyyy-mm-dd" value="<?php echo $p_tglawal;?>" />
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
                            <input class="input-medium date-picker" id="tgl_akhir" type="text" data-date-format="yyyy-mm-dd"  name="tgl_akhir" placeholder="yyyy-mm-dd" value="<?php echo $p_tglakhir;?>" />
																			<span class="input-group-addon">
																				<i class="ace-icon fa fa-calendar"></i>
																			</span>
                        </div>
                    </div>
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-first">Lama</label>

                <div class="col-sm-3">
                    <input class="input-medium" type="text" name="lama" id="lama" placeholder="Jumlah hari" value="<?php echo $p_lama;?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-comment">Alasan</label>

                <div class="col-xs-20 col-sm-9">
                    <textarea type="text" id="alasan" maxlength="200" name="alasan"><?php echo $p_alasan;?></textarea>
                </div>
            </div>



            <div class="space"></div>

            <div class="clearfix form-actions">

                <tr><td></td><td><input class="width-35 pull-right btn btn-sm btn-primary" type="submit" name="kirim_daftar" value="<?php echo $p_submit; ?>"></td></tr>

            </div>
        </form>


        </div>




        <div id="approved" class="tab-pane">
            <div class="space-10"></div>
            <h4 class="header blue bolder smaller">Riwayat cuti</h4>
            <?php
            // ================ TAMPILKAN DATANYA =====================//
            echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><tr><th width='5%'>ID</th><th width='10%'>Nip</th><th width='10%'>Nama</th><th width='10%'>Jenis Cuti</th><th width='10%'>Mulai</th><th width='10%'>akhir</th><th width='5%'>Lama Cuti</th><th width='5%'>Status</th><th width='10%'>Tgl Approve</th><th width='10%'>PESAN</th><th></th></tr>";
            
            $q_cuti 	= mysqli_query($mysqli,"SELECT pegawai.nip,pegawai.nama,tbl_cuti.n_cuti,ajuancuti.tgl_mulai,ajuancuti.id_cuti,ajuancuti.kdcuti,ajuancuti.tgl_akhir,ajuancuti.lama_cuti,ajuancuti.pesan_approve,ajuancuti.tgl_approve,status_app.approve
            FROM ajuancuti,pegawai,tbl_cuti,status_app where ajuancuti.id=pegawai.id and ajuancuti.id_cuti=tbl_cuti.id_cuti and ajuancuti.kd_approve=status_app.kd_approve and ajuancuti.id=$id_daf  ORDER BY ajuancuti.tgl_pengajuan ASC") or die (mysql_error());
            $j_data 	= mysqli_num_rows($q_cuti);

            if ($j_data == 0) {
                echo "<tr ><td colspan='10'>-- Tidak Ada Data --</td></tr>";
            } else {
                $no = 1;
                while ($a_cuti = mysqli_fetch_array($q_cuti)) {
                    echo "<tr>
				<td>$no</td>
				<td>$a_cuti[nip]</td>
				<td>$a_cuti[nama]</td>
				<td>$a_cuti[n_cuti]</td>
				<td>$a_cuti[tgl_mulai]</td>
				<td>$a_cuti[tgl_akhir]</td>
				<td>$a_cuti[lama_cuti]</td>
                <td>$a_cuti[approve]</td>
                <td>$a_cuti[tgl_approve]</td>
                <td>$a_cuti[pesan_approve]</td>";
                echo "<td>";
                if($a_cuti['approve']=='Approved'){
                if($a_cuti['id_cuti']=='1'){
                    echo '<a class="red" href="cetak/cetak_cuti_tahunan.php?kdcuti='.$a_cuti['kdcuti'].'&nip='.$a_cuti['nip'].' "> 
                    <i class="ace-icon fa fa-print bigger-130"></i>
                </a>';
                }
                if($a_cuti['id_cuti']=='2'){
                    echo '<a class="red" href="cetak/cetak_cuti_alsnpenting.php?kdcuti='.$a_cuti['kdcuti'].'&nip='.$a_cuti['nip'].' "> 
                    <i class="ace-icon fa fa-print bigger-130"></i>
                </a>';
                }
                if($a_cuti['id_cuti']=='3'){
                    echo '<a class="red" href="cetak/cetak_cuti_sakit.php?kdcuti='.$a_cuti['kdcuti'].'&nip='.$a_cuti['nip'].' "> 
                    <i class="ace-icon fa fa-print bigger-130"></i>
                </a>';
                }
                if($a_cuti['id_cuti']=='4'){
                    echo' <a class="red" href="cetak/cetak_cuti_melahirkan.php?kdcuti='.$a_cuti['kdcuti'].'&nip='.$a_cuti['nip'].' "> 
                    <i class="ace-icon fa fa-print bigger-130"></i>
                </a>';
                }
                if($a_cuti['id_cuti']=='8'){
                    echo' <a class="red" href="cetak/cetak_cuti_besar.php?kdcuti='.$a_cuti['kdcuti'].'&nip='.$a_cuti['nip'].' "> 
                    <i class="ace-icon fa fa-print bigger-130"></i>
                </a>';
                }
                }
                echo "</td>";
				echo "</tr>";
                    $no++;
                }
            }
            echo "</table>";
            ?>
        </div>




        </div>
        </div>
        </div>



    </div><!-- /.span -->
    </div><!-- /.user-profile -->
    </div>

<?php
}else{
    header('Location:../index.php?status=Silahkan Login');
}
?>	
