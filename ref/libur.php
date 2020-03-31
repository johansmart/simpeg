<?php
 session_start();
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'  ) 

{


?>



<h3 class="header smaller lighter blue">Referensi Libur Nasional</h3>

			<!-- textbox untuk pencarian -->
			<div class="input-prepend pull-center">
				
						
			
			
			<thead>
			<a  href="?id=formlibur" id="0" class="btn btn-app btn-purple btn-xs" data-toggle="modal" >
			<i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
			Tambah
			<span class="badge badge-warning badge-right"></span>
			</a>

			
									
			<a href="?id=libur" class="btn btn-app btn-success btn-xs">
			<i class="ace-icon fa fa-refresh bigger-160"></i>
			Refresh
			</a>
			</div>


    <?php
    $p_id_libur      = isset($_POST['id_libur']) ? $_POST['id_libur'] : "";
    $p_nmlibur      = isset($_POST['nmlibur']) ? $_POST['nmlibur'] : "";
    $p_tgl_libur      = isset($_POST['tgllibur']) ? $_POST['tgllibur'] : "";
    $p_id_get      = isset($_GET['idl']) ? $_GET['idl'] : "";

    if($_POST['tb_act']=="SAVE"){
        $querysave=mysqli_query($mysqli,"insert into tbl_libur values ('','$p_nmlibur','$p_tgl_libur')");
        if ($querysave > 0){
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Libur Berhasil di SIMPAN</div>";
        }else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>".mysqli_error($mysqli)."<br/></div>";
        }

    }else if($_POST['tb_act']=="EDIT"){

        $queryupdate=mysqli_query($mysqli,"update tbl_libur set nmlibur='$p_nmlibur',tgllibur='$p_tgl_libur' where idlibur='$p_id_libur'");

        if ($queryupdate > 0){
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Libur Berhasil di UBAH</div>";
        }else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>".mysqli_error($mysqli)."<br/></div>";
        }

    }else if($_GET['mod']=="del"){
        $querydel=mysqli_query($mysqli,"delete from tbl_libur where idlibur='$p_id_get'");


        if ($querydel > 0){
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Libur Berhasil di HAPUS</div>";
        }else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>".mysqli_error($mysqli)."<br/></div>";
        }
    }

    ?>
			
		<form method="GET" action='<?php echo $_SERVER['PHP_SELF'];?>'>
             	      		<input type="hidden" name="id" value="libur"/>
							<div >
                           
					        <input type="text" name="libur" class="libur" id="libur" placeholder="cari nama libur..." required>
					            <button type="submit" id="cari" class="btn btn-primary">&nbsp;<i class="small fa fa-search"></i>&nbsp;</button>
                            
							</div>
                        </form>

	
		
		</thead>
	

<table class="table table-bordered table-hover">
			<thead>
			<tr>
				<th>#</th>
				<th>Tanggal Libur</th>
				<th>Nama Libur</th>
				
				<th>Aksi</th>
			</tr>
			</thead>
			
			<tbody>		
				
				<?php
	include "config/class_paging.php"; 
 	if (empty($_GET['libur'])){
	 $page		= new Paging;
	 $batas 	= 5;
	 $posisi	= $page->cariPosisi($batas);
	 $res = mysqli_query($mysqli,"SELECT * from tbl_libur 
						order by idlibur DESC LIMIT $posisi,$batas");
	 $no = $posisi+1;
	 while($items=mysqli_fetch_array($res)){
		
		echo "<tr>
				<td>$no</td>
				<td>".$items['tgllibur']."</td>
				<td>".$items['nmlibur']."</td>
				
				
				<td class='tengah'>
				
					<a class='btn btn-primary btn-xs' href='?id=formlibur&mod=edit&idl=".$items['idlibur']."' title='edit data'> <i class='fa fa-pencil'> </i></a>
					<a class='btn btn-danger btn-xs' href='?id=libur&mod=del&idl=".$items['idlibur']."' onclick=\"return confirm('Menghapus data ".$items['nmlibur']." ')\" title='hapus data'> <i class='fa fa-times'> </i></a>
				</td>
			 </tr>";
		$no++;
	 } 

	$jmldata = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM tbl_libur"));
	$jmlhalaman = $page->jumlahHalaman($jmldata,$batas);
	$linkhalaman = $page->navHalaman($_GET['halaman'],$jmlhalaman);
	?>
	<?php
	}
	else{
	$page		= new Paging9;
	 $batas 	= 5;
	 $posisi	= $page->cariPosisi($batas);
	 $res = mysqli_query($mysqli,"SELECT * from tbl_libur
						where nmlibur LIKE '%$_GET[libur]%'
						order by idlibur DESC LIMIT $posisi,$batas");
	 $no = $posisi+1;
	 while($items=mysqli_fetch_array($res)){
		
		echo "<tr>
				<td>$no</td>
				<td>".$items['tgllibur']."</td>
				<td>".$items['nmlibur']."</td>
				
				
				<td class='tengah'>
				
					<a class='btn btn-primary btn-xs' href='?id=formlibur&mod=edit&idl=".$items['idlibur']."' title='edit data'> <i class='fa fa-pencil'> </i></a>
					<a class='btn btn-danger btn-xs' href='?id=libur&mod=del&idl=".$items['idlibur']."' onclick=\"return confirm('Menghapus data ".$items['nmlibur']." ')\" title='hapus data'> <i class='fa fa-times'> </i></a>
				</td>
			 </tr>";
		$no++;
	 } 

	 $jmldata = mysqli_num_rows(mysqli_query($mysqli,"SELECT*FROM tbl_libur WHERE nmlibur LIKE '%$_GET[libur]%'"));
	 $jmlhalaman = $page->jumlahHalaman($jmldata,$batas);
	 $linkhalaman = $page->navHalaman($_GET['halaman'],$jmlhalaman);
	}
	?>
	
			
			
		
			</tbody>
		</table>		

	<?php echo "$linkhalaman";?>


<?php
}else{
	  echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>