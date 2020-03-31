<?php 
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL && !empty($sesi_username) && $_SESSION['leveluser']=='1')

{

    $mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;

    if ($mod == "all") {
        $query = mysqli_query($mysqli, "SELECT * FROM pegawai WHERE nip NOT IN (SELECT nip FROM tbl_user)");
        while ($row = mysqli_fetch_array($query, MYSQL_ASSOC)) {
            $pisah=explode('-',$row['tgl_lahir']);
            $tahun=$pisah[0];
            $bulan=$pisah[1];
            $tgl=$pisah[2];
            $user=strtolower($row['nama']);
            $nip=$row['nip'];
            $pass=md5($tgl.$bulan.$tahun);
            $id_jab=$row['id_jab'];

            $query2 = "INSERT INTO tbl_user (id_user,username,pass,level_user,nip,w_daftar,photo,kd_approve,id_jab) VALUES
            ('','$nip','$pass','5','$nip',NOW(),'examples/logo.jpg','1','$id_jab')";
            $hasil = mysqli_query($mysqli,$query2);

        }
        mysqli_query($mysqli, "UPDATE tbl_user a, pegawai b SET a.id= b.id WHERE a.nip=b.nip;");
        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'>
               <i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong> Semua pegawai sudah memiliki UserID <br/></div>";
    }
?>


<!DOCTYPE html>
<html lang="en">
<body>
<h3 class="header smaller lighter blue">Daftar User Pengguna ASKA</h3>


			<div class="input-prepend pull-center">
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span8" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian..">
			
			<thead>
			<a  href="#dialog-lu" id="0" class="new btn btn-app btn-purple btn-xs" data-toggle="modal" >
			<i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
			Tambah
			<span class="badge badge-warning badge-right"></span>
			</a>

			<a href="cetak/lap_userid.php" class="btn btn-app btn-light btn-xs">
			<i class="ace-icon fa fa-print bigger-160"></i>
			Print
			</a>
									
			<a href="?id=list_user" class="btn btn-app btn-success btn-xs">
			<i class="ace-icon fa fa-refresh bigger-160"></i>
			Refresh
			</a>

            <a href="?id=list_user&mod=all" onclick="return confirm ('Apakah anda yakin?')" class="btn btn-danger ">
                <i class="ace-icon fa fa-users"></i>
                Create all User
            </a>

			
			</div>
			
			
			
			
		
		
		<div id="data-lu"></div>
		
		</thead>
	



<div id="dialog-lu" class="modal fade" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header no-padding">
		<div class="table-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<span class="white">&times;</span>
					</button>
					<i id="myModalLabel3">Tambah Data </i> 
				</div>
	</div>

	
	<div class="modal-body">  
	<div class="modal-content">
	</div>
	</div>
	
	<div class="modal-footer">
		<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
		<button id="simpan-lu" class="btn btn-success" data-dismiss="collapse" aria-hidden="true" >Simpan</button>
	</div>
</div>
</div>
</div>







</body>							
</html>	
<?php
}else{
	  echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = 'index.php'</script>";
}
?>	