<?php
 session_start();
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'  ) 

{


?>



<h3 class="header smaller lighter blue">Struktur</h3>

			<!-- textbox untuk pencarian -->
			<div class="input-prepend pull-center">
				
						
			
			
			<thead>
			<a  href="?id=formstruktur" id="0" class="btn btn-app btn-purple btn-xs" data-toggle="modal" >
			<i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
			Tambah
			<span class="badge badge-warning badge-right"></span>
			</a>

			
									
			<a href="?id=struktur" class="btn btn-app btn-success btn-xs">
			<i class="ace-icon fa fa-refresh bigger-160"></i>
			Refresh
			</a>
			</div>


    <?php
    $p_idst      = isset($_POST['idst']) ? $_POST['idst'] : "";
    $p_id_jab_a      = isset($_POST['id_jab_a']) ? $_POST['id_jab_a'] : "";
    $p_id_jab_b      = isset($_POST['id_jab_b']) ? $_POST['id_jab_b'] : "";
    $p_id_get      = isset($_GET['idst']) ? $_GET['idst'] : "";

    if($_POST['tb_act']=="SAVE"){
        $querysave=mysqli_query($mysqli,"insert into tbl_struktur values ('','$p_id_jab_a','$p_id_jab_b')");
        if ($querysave > 0){
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Berhasil di SIMPAN</div>";
        }else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>".mysqli_error($mysqli)."<br/></div>";
        }

    }else if($_POST['tb_act']=="EDIT"){

        $queryupdate=mysqli_query($mysqli,"update tbl_struktur set id_jab_a='$p_id_jab_a',id_jab_b='$p_id_jab_b' where idst='$p_idst'");

        if ($queryupdate > 0){
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Berhasil di UBAH</div>";
        }else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>".mysqli_error($mysqli)."<br/></div>";
        }

    }else if($_GET['mod']=="del"){
        $querydel=mysqli_query($mysqli,"delete from tbl_struktur where idst='$p_id_get'");


        if ($querydel > 0){
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Berhasil di HAPUS</div>";
        }else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>".mysqli_error($mysqli)."<br/></div>";
        }
    }

    ?>
			
		<form method="GET" action='<?php echo $_SERVER['PHP_SELF'];?>'>
             	      		<input type="hidden" name="id" value="struktur"/>
							<div >
                          

					         <select name="jabatan" id="jabatan" >
			                    <option>-- Pilih Jabatan --</option>
			                    <?php
			                    $q = mysqli_query($mysqli,"select * from jabatan order by n_jab");

			                    while ($a = mysqli_fetch_array($q)){
			                        echo "<option value='$a[kode]'>$a[n_jab]</option>";
			                    }
			                    ?>
			                </select>


					            <button type="submit" id="cari" class="btn btn-primary">&nbsp;<i class="small fa fa-search"></i>&nbsp;</button>
                            
							</div>
                        </form>

	
		
		</thead>
	

<table class="table table-bordered table-hover">
			<thead>
			<tr>
				<th>#</th>
				<th>Atasan</th>
				<th>Bawahan</th>
				
				<th>Aksi</th>
			</tr>
			</thead>
			
			<tbody>		
				
				<?php
	include "config/class_paging.php"; 
 	if (empty($_GET['jabatan'])){
	 $page		= new Paging;
	 $batas 	= 10;
	 $posisi	= $page->cariPosisi($batas);
	 $res = mysqli_query($mysqli,"SELECT a.idst,b.n_jab as atasan,c.n_jab as bawahan from tbl_struktur a
	 left join jabatan b on a.id_jab_a=b.kode
	 left join jabatan c on a.id_jab_b=c.kode 
						order by a.idst DESC LIMIT $posisi,$batas");
	 $no = $posisi+1;
	 while($items=mysqli_fetch_array($res)){
		
		echo "<tr>
				<td>$no</td>
				<td>".$items['atasan']."</td>
				<td>".$items['bawahan']."</td>
				
				
				<td class='tengah'>
				
					<a class='btn btn-primary btn-xs' href='?id=formstruktur&mod=edit&idst=".$items['idst']."' title='edit data'> <i class='fa fa-pencil'> </i></a>
					<a class='btn btn-danger btn-xs' href='?id=struktur&mod=del&idst=".$items['idst']."' onclick=\"return confirm('Menghapus data? ')\" title='hapus data'> <i class='fa fa-times'> </i></a>
				</td>
			 </tr>";
		$no++;
	 } 

	$jmldata = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM tbl_struktur"));
	$jmlhalaman = $page->jumlahHalaman($jmldata,$batas);
	$linkhalaman = $page->navHalaman($_GET['halaman'],$jmlhalaman);
	?>
	<?php
	}
	else{
	$page		= new Paging9;
	 $batas 	= 10;
	 $posisi	= $page->cariPosisi($batas);
	 $res = mysqli_query($mysqli,"SELECT a.*,b.n_jab as atasan,c.n_jab as bawahan from tbl_struktur a
	 left join jabatan b on a.id_jab_a=b.kode
	 left join jabatan c on a.id_jab_b=c.kode 
						where a.id_jab_a='$_GET[jabatan]'
						or a.id_jab_b='$_GET[jabatan]'
						order by a.idst DESC LIMIT $posisi,$batas");
	 $no = $posisi+1;
	 while($items=mysqli_fetch_array($res)){
		
		echo "<tr>
				<td>$no</td>
				<td>".$items['atasan']."</td>
				<td>".$items['bawahan']."</td>
				
				
				<td class='tengah'>
				
					<a class='btn btn-primary btn-xs' href='?id=formstruktur&mod=edit&idst=".$items['idst']."' title='edit data'> <i class='fa fa-pencil'> </i></a>
					<a class='btn btn-danger btn-xs' href='?id=struktur&mod=del&idst=".$items['idst']."' onclick=\"return confirm('Menghapus data? ')\" title='hapus data'> <i class='fa fa-times'> </i></a>
				</td>
			 </tr>";
		$no++;
	 } 

	 $jmldata = mysqli_num_rows(mysqli_query($mysqli,"SELECT a.*,b.n_jab as atasan,c.n_jab as bawahan from tbl_struktur a
	 left join jabatan b on a.id_jab_a=b.kode
	 left join jabatan c on a.id_jab_b=c.kode 
						where a.id_jab_a='%$_GET[jabatan]%'
						or a.id_jab_b='%$_GET[jabatan]%'"));
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