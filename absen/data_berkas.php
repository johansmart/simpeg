<?php
 session_start();
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'  ) 

{


?>



<h3 class="header smaller lighter blue">Data Berkas</h3>

			<!-- textbox untuk pencarian -->
			<div class="input-prepend pull-center">
				
						
			
			
			<thead>
			

			
									
			<a href="?id=databerkas" class="btn btn-app btn-success btn-xs">
			<i class="ace-icon fa fa-refresh bigger-160"></i>
			Refresh
			</a>
			</div>


    
		<form method="GET" action='<?php echo $_SERVER['PHP_SELF'];?>'>
             	      		<input type="hidden" name="id" value="databerkas"/>
							<div >
                           
					        <input type="text" name="berkas" class="berkas" id="berkas" placeholder="cari nama berkas..." required>
					            <button type="submit" id="cari" class="btn btn-primary">&nbsp;<i class="small fa fa-search"></i>&nbsp;</button>
                            
							</div>
                        </form>

	
		
		</thead>
	

<table class="table table-bordered table-hover">
			<thead>
			<tr>
				<th>#</th>
				<th>NamaBerkas</th>
				<th>Tanggal Upload</th>
				
				<th>Aksi</th>
			</tr>
			</thead>
			
			<tbody>		
				
				<?php
	include "config/class_paging.php"; 
 	if (empty($_GET['berkas'])){
	 $page		= new Paging;
	 $batas 	= 5;
	 $posisi	= $page->cariPosisi($batas);
	 $res = mysqli_query($mysqli,"SELECT * from tbl_upload_berkas a
	 left join tbl_berkas b on a.id_berkas=b.id_berkas 
	 where a.id='".$_SESSION['id_daftar']."'
						order by a.idub DESC LIMIT $posisi,$batas");
	 $no = $posisi+1;
	 while($items=mysqli_fetch_array($res)){
		
		echo "<tr>
				<td>$no</td>
				<td>".$items['nama_berkas']."</td>
				<td>".$items['tgl_upload']."</td>
				
				
				<td class='tengah'>
				
					<a class='btn btn-primary btn-xs' href='".$items['file']."' title='download data'> <i class='fa fa-download'> </i></a>
					
				</td>
			 </tr>";
		$no++;
	 } 

	$jmldata = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM tbl_upload_berkas where a.id='".$_SESSION['id_daftar']."'"));
	$jmlhalaman = $page->jumlahHalaman($jmldata,$batas);
	$linkhalaman = $page->navHalaman($_GET['halaman'],$jmlhalaman);
	?>
	<?php
	}
	else{
	$page		= new Paging9;
	 $batas 	= 5;
	 $posisi	= $page->cariPosisi($batas);
	 $res = mysqli_query($mysqli,"SELECT * from tbl_upload_berkas a
	 left join tbl_berkas b on a.id_berkas=b.id_berkas 
						where b.nama_berkas LIKE '%$_GET[berkas]%' and
						a.id='".$_SESSION['id_daftar']."'
						order by a.idub DESC LIMIT $posisi,$batas");
	 $no = $posisi+1;
	 while($items=mysqli_fetch_array($res)){
		
		echo "<tr>
				<td>$no</td>
				<td>".$items['nama_berkas']."</td>
				<td>".$items['tgl_upload']."</td>
				
				
				<td class='tengah'>
				
					<a class='btn btn-primary btn-xs' href='".$items['file']."' title='download data'> <i class='fa fa-download'> </i></a>
					
				</td>
			 </tr>";
		$no++;
	 } 

	 $jmldata = mysqli_num_rows(mysqli_query($mysqli,"SELECT * from tbl_upload_berkas a
	 left join tbl_berkas b on a.id_berkas=b.id_berkas and a.id='".$_SESSION['id_daftar']."'
						and b.nama_berkas LIKE '%$_GET[berkas]%'"));
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