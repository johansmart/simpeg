<?php
$data2 = mysqli_query($mysqli,"SELECT * FROM pegawai,tbl_user,umur_p,jabatan
WHERE tbl_user.nip=pegawai.nip and tbl_user.nip=umur_p.nip and pegawai.id_jab=jabatan.kode and tbl_user.nip=$nip");
while($c = mysqli_fetch_array($data2)){

    ?>

    <form class="form-horizontal" name="form" id="valid-profil" method="post" action="">
    <div class="tabbable">
    <ul class="nav nav-tabs padding-16">
        <li class="active">
            <a data-toggle="tab" href="#edit-basic">
                <i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
                Pengajuan Cuti
            </a>
        </li>

        <li>
            <a data-toggle="tab" href="#edit-settings">
                <i class="purple ace-icon fa fa-check-square bigger-125"></i>
                Cuti Aproved
            </a>
        </li>

        <li>
            <a data-toggle="tab" href="#edit-password">
                <i class="blue ace-icon fa fa-ban bigger-125"></i>
                Cuti Pending
            </a>
        </li>
    </ul>

    <div class="tab-content profile-edit-tab-content">
    <div id="edit-basic" class="tab-pane in active">
        <h4 class="header blue bolder smaller">Data Pribadi</h4>
        <div class="form-group">
        <a href="" class="btn btn-app btn-success btn-xs left">
            <i class="glyphicon glyphicon-home bigger-220"></i>

        </a>
        <a href="" class="btn btn-app btn-success btn-xs left">
            <i class="ace-icon fa 	fa-pencil-square-o  bigger-220"></i>
            Ajukan
        </a>
        <a href="?id=ajuan_cuti" class="btn btn-app btn-success btn-xs">
            <i class="ace-icon fa fa-refresh bigger-160"></i>
            Refresh
        </a>
        </div>


        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-first">NIP</label>

            <div class="col-sm-9">
                <input class="col-xs-7 col-sm-1" disabled="disabled" type="text" id="nip" placeholder="nip" name="nip" value="<?php echo $c['nip'];?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-first">Nama</label>

            <div class="col-sm-9">
                <input class="col-xs-7 col-sm-5" disabled="disabled" type="text" id="nama" placeholder="nama" name="nama" value="<?php echo $c['nama'];?>" />
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-first">Tempat Lahir</label>

            <div class="col-sm-9">
                <input class="col-xs-7 col-sm-5" type="text" id="ttl" disabled="disabled" placeholder="ttl" name="ttl" value="<?php echo $c['tmpt_lahir'];?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-date">Tanggal Lahir</label>

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

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right">Jenis Kelamin</label>

            <div class="col-sm-9">
                <label class="inline">
                    <input name="jk" type="radio" disabled="disabled" value="L" id="jk" class="ace" <?php echo $c['jenis_kelamin'] =='L' ? ' checked="checked"' : '';?> />
                    <span class="lbl middle"> Laki-laki</span>
                </label>

                &nbsp; &nbsp; &nbsp;
                <label class="inline">
                    <input name="jk" type="radio" disabled="disabled" value="P" id="jk" class="ace" <?php echo $c['jenis_kelamin'] =='P' ? ' checked="checked"' : '';?> />
                    <span class="lbl middle"> Perempuan</span>
                </label>
            </div>
        </div>





        <div class="space-4"></div>

        <div class="space"></div>
        <h4 class="header blue bolder smaller">Pengajuan Cuti</h4>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right">Jenis Cuti </label>
            <div class="col-sm-7">

                <select name="n_cuti" id="n_cuti" class="form-control">
                    <option>-- Pilih Cuti --</option>
                    <?php
                    $q = mysqli_query($mysqli,"select * from tbl_cuti order by id_cuti");

                    while ($a = mysqli_fetch_array($q)){
                        if ($a[1] ==$c['id_cuti']) {
                            echo "<option value='$a[0]' selected>$a[1]</option>";
                        } else {
                            echo "<option value='$a[0]'>$a[1]</option>";
                        }
                    }
                    ?>
                </select>

            </div>

        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-date">Tanggal Mulai</label>

            <div class="col-sm-9">
                <div class="input-medium">
                    <div class="input-group">
                        <input class="input-medium date-picker"  id="tgl_mulai" type="text" data-date-format="yyyy-mm-dd" name="tgl_mulai" placeholder="yyyy-mm-dd"  />
																			<span class="input-group-addon">
																				<i class="ace-icon fa fa-calendar"></i>
																			</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-date">Tanggal Selesai</label>

            <div class="col-sm-9">
                <div class="input-medium">
                    <div class="input-group">
                        <input class="input-medium date-picker"  id="tgl_selesai" type="text" data-date-format="yyyy-mm-dd" name="tgl_selesai" placeholder="yyyy-mm-dd"  />
																			<span class="input-group-addon">
																				<i class="ace-icon fa fa-calendar"></i>
																			</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-first">Lama Cuti</label>

            <div class="col-sm-9">
                <input class="col-xs-7 col-sm-1" type="text" id="lama" placeholder="hari" name="lama" value="" />
            </div>
        </div>



    </div>

    <div id="edit-settings" class="tab-pane">
        <div class="space-10"></div>

        <div>
            <label class="inline">
                <input type="checkbox" name="form-field-checkbox" class="ace" />
                <span class="lbl"> Make my profile public</span>
            </label>
        </div>

        <div class="space-8"></div>

        <div>
            <label class="inline">
                <input type="checkbox" name="form-field-checkbox" class="ace" />
                <span class="lbl"> Email me new updates</span>
            </label>
        </div>

        <div class="space-8"></div>

        <div>
            <label class="inline">
                <input type="checkbox" name="form-field-checkbox" class="ace" />
                <span class="lbl"> Keep a history of my conversations</span>
            </label>

            <label class="inline">
                <span class="space-2 block"></span>

                for
                <input type="text" class="input-mini" maxlength="3" />
                days
            </label>
        </div>
    </div>

    <div id="edit-password" class="tab-pane">
        <div class="space-10"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">New Password</label>

            <div class="col-sm-9">
                <input type="password" name="pass1" id="pass1" />
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-pass2">Confirm Password</label>

            <div class="col-sm-9">
                <input type="password" name="pass2" id="pass2" />
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="clearfix form-actions">



    </div>
    </form>
<?php
}
?>
