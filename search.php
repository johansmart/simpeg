<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2' )
{

    ?>

<div class="col-xs-12 col-sm-12 widget-container-col">
    <div class="widget-box widget-color-blue">
        <div class="widget-header">
            <h5 class="widget-title">Cari Pegawai Berdasarkan...</h5>

            <div class="widget-toolbar">
                <a href="#" data-action="collapse">
                    <i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
                </a>
            </div>

            <div class="widget-toolbar no-border">

                *Switch ON terlebih dahulu

            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">

                <form class="form-horizontal" method="post" action="hasil.php" >
				
				
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="kode">Nama Pegawai :</label>
                    <div class="col-sm-9">
                        <input type="text" id="name" class="col-xs-10 col-sm-5"  name="name" placeholder="Isikan nama pegawai..." value="">

                        <input id="idnama" name="idnama" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                        <span class="lbl middle"></span>

                    </div>
                </div>
				
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="n_jab">Golongan :</label>
                    <div class="col-sm-9">
                        <select name="idgol" id="idgol" class="" value="">
                            <option value="">-- Pilih Golongan --</option>
                            <?php
                            $q = mysqli_query($mysqli,"select * from tbl_gol order by gol ");

                            while ($a = mysqli_fetch_array($q)){
                                if ($a[0] =="") {
                                    echo "<option value='$a[0]' selected>$a[1]</option>";
                                } else {
                                    echo "<option value='$a[0]' >$a[1]</option>";
                                }
                            }
                            ?>
                        </select>
                        <input id="golongan" name="golongan" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                        <span class="lbl middle"></span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="gapok">Pendidikan :</label>
                    <div class="col-sm-9">
                        <select name="idpndk" id="idpndk" class="" value="">
                            <option value="">-- Pilih Pendidikan --</option>
                            <?php
                            $q = mysqli_query($mysqli,"select * from tbl_pendidikan order by kdpndidik ");
                            while ($a = mysqli_fetch_array($q)){
                                if ($a[0] =="") {
                                    echo "<option value='$a[0]' selected>$a[1]</option>";
                                } else {
                                    echo "<option value='$a[0]' >$a[1]</option>";
                                }
                            }
                            ?>
                        </select>
                        <input id="pndk" name="pndk" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                        <span class="lbl middle"></span>
                    </div>
                </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="gapok">Umur :</label>
                        <div class="col-sm-1">
                            <label></label>
                            <input type="text" id="umur1" class="col-xs-10 col-sm-10"  name="umur1" value="">

                         </div>
                        <div class="col-sm-1">
                            <label>s/d</label>
                            </div>
                        <div class="col-sm-1">
                            <label></label>
                            <input type="text" id="umur2" class="col-xs-13 col-sm-10"  name="umur2" value="">

                        </div>
                        <input id="umur" name="umur" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                        <span class="lbl middle"></span>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" >Masa Kerja :</label>
                        <div class="col-sm-1">
                            <label></label>
                            <input type="text" id="mkerja1" class="col-xs-10 col-sm-10"  name="mkerja1" value="">
                         </div>
                        <div class="col-sm-1">
                            <label>s/d</label>
                            </div>
                        <div class="col-sm-1">
                            <label></label>
                            <input type="text" id="mkerja2" class="col-xs-13 col-sm-10"  name="mkerja2" value="">
                        </div>
                        <input id="mkerja" name="mkerja" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                        <span class="lbl middle"></span>
                    </div>

          
					
					<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="kode">Kepakaran :</label>
                    <div class="col-sm-9">
                        <input type="text" id="nmkdkpkrn" class="col-xs-10 col-sm-5"  name="nmkdkpkrn" placeholder="Isikan kepakaran yang di inginkan" value="">

                        <input id="idkdkpkrn" name="idkdkpkrn" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                        <span class="lbl middle"></span>

                    </div>
					</div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Bagian:</label>
                        <div class="col-sm-9">
                            <select name="id_bag" id="id_bag" class="" value="">
                                <option value="">-- Pilih Bagian --</option>
                                <?php
                                $q = mysqli_query($mysqli,"select * from bagian order by n_bag ");
                                while ($a = mysqli_fetch_array($q)){
                                    if ($a[0] =="") {
                                        echo "<option value='$a[1]' selected>$a[2]</option>";
                                    } else {
                                        echo "<option value='$a[1]' >$a[2]</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input id="idbagian" name="idbagian" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                            <span class="lbl middle"></span>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Status Keaktifan:</label>
                        <div class="col-sm-9">
                            <select name="id_stsk" id="id_stsk" class="" value="">
                                <option value="">-- Pilih Status Keaktifan --</option>
                                <?php
                                $q = mysqli_query($mysqli,"select * from sts_keaktifan order by nm_stsk ");
                                while ($a = mysqli_fetch_array($q)){
                                    if ($a[0] =="") {
                                        echo "<option value='$a[0]' selected>$a[1]</option>";
                                    } else {
                                        echo "<option value='$a[0]' >$a[1]</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input id="idstsk" name="idstsk" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                            <span class="lbl middle"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Jabatan :</label>
                        <div class="col-sm-9">
                            <select name="id_jab" id="id_jab" class="" value="">
                                <option value="">-- Pilih Jabatan --</option>
                                <?php
                                $q = mysqli_query($mysqli,"select * from jabatan order by id_jab ");
                                while ($a = mysqli_fetch_array($q)){
                                    if ($a[0] =="") {
                                        echo "<option value='$a[1]' selected>$a[2]</option>";
                                    } else {
                                        echo "<option value='$a[1]' >$a[2]</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input id="idjabatan" name="idjabatan" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                            <span class="lbl middle"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Jabatan Fungsional :</label>
                        <div class="col-sm-9">
                            <select name="kd_jbfungsi" id="kd_jbfungsi" class="" value="">
                                <option value="">-- Pilih Jabatan Fungsional--</option>
                                <?php
                                $q = mysqli_query($mysqli,"select * from jb_fungsi order by kd_jbfungsi ");
                                while ($a = mysqli_fetch_array($q)){
                                    if ($a[0] =="") {
                                        echo "<option value='$a[0]' selected>$a[1]</option>";
                                    } else {
                                        echo "<option value='$a[0]' >$a[1]</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input id="jbfungsi" name="jbfungsi" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                            <span class="lbl middle"></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Jabatan Struktural :</label>
                        <div class="col-sm-9">
                            <select name="kd_jbstruk" id="kd_jbstruk" class="" value="">
                                <option value="">-- Pilih Jabatan Struktural--</option>
                                <?php
                                $q = mysqli_query($mysqli,"select * from jb_struk order by kd_jbstruk ");
                                while ($a = mysqli_fetch_array($q)){
                                    if ($a[0] =="") {
                                        echo "<option value='$a[0]' selected>$a[1]</option>";
                                    } else {
                                        echo "<option value='$a[0]' >$a[1]</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input id="jbstruk" name="jbstruk" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                            <span class="lbl middle"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">Status Pegawai :</label>
                        <div class="col-sm-9">
                            <select name="kd_statusp" id="kd_statusp" class="" value="">
                                <option value="">-- Pilih Status Pegawai--</option>
                                <?php
                                $q = mysqli_query($mysqli,"select * from tbl_statusp order by kdstatusp ");
                                while ($a = mysqli_fetch_array($q)){
                                    if ($a[0] =="") {
                                        echo "<option value='$a[0]' selected>$a[1]</option>";
                                    } else {
                                        echo "<option value='$a[0]' >$a[1]</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input id="statusp" name="statusp" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                            <span class="lbl middle"></span>
                        </div>
                    </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right">Sub Bagian :</label>
                    <div class="col-sm-9">
                        <select name="kdsubbag" id="kdsubbag" class="" value="">
                            <option value="">-- Pilih Sub Bagian--</option>
                            <?php
                            $q = mysqli_query($mysqli,"select * from sub_bagian order by kd_sub ");
                            while ($a = mysqli_fetch_array($q)){
                                if ($a[0] =="") {
                                    echo "<option value='$a[0]' selected>$a[1]</option>";
                                } else {
                                    echo "<option value='$a[0]' >$a[1]</option>";
                                }
                            }
                            ?>
                        </select>
                        <input id="subbag" name="subbag" checked="" type="checkbox" class="ace ace-switch ace-switch-4" />
                        <span class="lbl middle"></span>
                    </div>
                </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" ></label>
                        <div class="col-sm-9">
                            <input class="btn btn-info btn-big btn-next" type="submit" id=submit name="print" value="Print"/>
                            <input class="btn btn-success btn-big btn-next" type="submit"  name="kirim_excel" value="Export Xls"/>
                            <input type="button" id="btn_loading" name="submit" class="btn btn-info" data-toggle="modal" data-target="#myModal" value="Search"/>
                        </div>
                        </div>
                    </div>

            </form>

            </div>


            <div class="widget-toolbox padding-8 clearfix">


                <div id="myModal" class="modal fade" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header no-padding">
                                <div class="table-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        <span class="white">&times;</span>
                                    </button>
                                    <i id="myModalLabel3">Hasil Pencarian </i>
                                </div>
                            </div>


                            <div class="modal-body">

                                    <div id="hasil"></div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
</div>
</div>



<?php
}else{
    header('Location:index.php?status=Silahkan Login');
}
?>