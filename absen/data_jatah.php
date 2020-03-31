
<?php 
error_reporting(0);

$mod 			= isset($_GET['mod']) ? $_GET['mod'] : NULL;

if ($mod == "del") {
	$q_del = mysqli_query($mysqli,"DELETE FROM tbl_jatahcuti");

	if ($q_del > 0) {
		echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='icon-ok'></i>BERHASIL</strong> Data Jatah Cuti Pegawai Berhasil di hapus<br/></div>";
	} else {
		echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='icon-remove'></i>MAAF!</strong>".mysqli_error($mysqli)."<br/></div>";
	}
}else if(isset($_POST[tahun])){
    $tahun=$_POST[tahun];
    $cektbl_jatah=mysqli_query($mysqli,"select tahun from tbl_jatahcuti where tahun=$tahun");
    $rowcektbl_jatah=mysqli_num_rows($cektbl_jatah);

    if($rowcektbl_jatah > 0){

        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='icon-remove'></i>MAAF!</strong> Jatah Cuti Tahun ini sudah dibuat </div>";
    } else {

        $cekjatah = mysqli_query($mysqli, "select jatah_cuti from tbl_cuti where id_cuti='1'"); //cek lama hari untuk cuti tahunan
        $rowjatah = mysqli_fetch_array($cekjatah);
        $lamacuti = $rowjatah[0];

        $querypeg = mysqli_query($mysqli, "select nip from pegawai where kdstatusp not in('0','4')"); // query untuk mendapatkan nip pegawai
        while ($rowquerypeg = mysqli_fetch_array($querypeg)) {
            $nippeg = $rowquerypeg['nip'];
            $sql = mysqli_query($mysqli, "INSERT INTO tbl_jatahcuti VALUES ('','$nippeg','$lamacuti','','','$tahun')"); // insert ke tabel jatah cuti

        }
        if ($sql > 0) {

            echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='icon-ok'></i>BERHASIL</strong> Membuat Jatah cuti di tahun ini<br/></div>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='icon-remove'></i>MAAF!</strong>" . mysqli_error($mysqli) . "<br/></div>";
        }

    }
}


$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='3'  ) 

{



?>

<div class="row">
<div class="col-xs-12">
<h3 class="header smaller lighter blue">Data Jatah Cuti</h3>

<div class="col-xs-12">
<a href="cetak/lap_jatahcuti.php" class="btn btn-danger" target="_blank">Cetak PDF</a>
<a href="?id=datajatah&mod=del" class="btn btn-danger"  onclick="return confirm('Apakah anda yakin Menghapus Semua Jatah Cuti ?')">Hapus Semua</a>

<button class="btn btn-info" data-toggle="modal" data-target="#modalCreateJatah">Buat Jatah</button>


</div>

<div class="table-header">
	Jatah Cuti
</div>

<!-- <div class="table-responsive"> -->

<!-- <div class="dataTables_borderWrap"> -->
<div class="table-responsive">
<table id="sample-table-2" class="table table-striped table-bordered table-hover">
<thead>
<tr>
	
	<th>Nip</th>
	<th>Nama</th>
    <th>Jatah Cuti</th>
    <th>Cuti Diambil</th>
	<th>Sisa Cuti</th>
    <th class="hidden-480">Tahun</th>


</tr>
</thead>

<tbody>

</tbody>
</table>
</div>
</div>



<div class="modal fade" id="modalCreateJatah">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title">Masukan Tahun</h5>
              </div>
              
                <form action="?id=datajatah" method="post" class="form-horizontal" id="ft_agama">
                <div class="modal-body">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="kode">Tahun</label>
                <div class="col-sm-5">
                    <input type="text" name="tahun" required>
                </div>
            </div>

            
       
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Buat Jatah</button
              </div>
            </div><!-- /.modal-content -->

        </form>    
          </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  
<?php
}else{
	  echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>	