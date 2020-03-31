<?php
// memanggil berkas koneksi.php


error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$nip			= isset($_SESSION['nip']) ? $_SESSION['nip'] : NULL;


if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5'  )

{






?>

    <?php
    if ($_SESSION['leveluser']=='5') {

        $q_cek = mysqli_query($mysqli, "SELECT current_date() as tgl_skrng,datediff(tgl_kontrak,current_date()) as sisa,tgl_kontrak from pegawai where id='$id_daf' ");
        $j_cek = mysqli_fetch_array($q_cek);

        if ($j_cek[2]=="0000-00-00")
        {
            echo "";
        }
        elseif ($j_cek[1] <=30 ) {
            echo "<div class='alert alert-block alert-danger'>
            ".$j_cek[1]." Hari lagi masa kontrak anda akan habis, masa kontrak anda sampai dengan tanggal ".tgl_indo($j_cek['2'])."
            </div> ";
        }


    }
    ?>



		<div class="alert alert-block alert-success">
		<marquee><i class="icon-ok green"></i>

		Selamat Datang <strong class="green">
		<?php echo $_SESSION['namauser']; ?>
								
								
		</strong>
		<?php
		$view2=mysqli_query($mysqli,"select * from master");
		$row2=mysqli_fetch_array($view2);
		
		echo "di<strong class='green'> ASKA<small> (".$row2['version'].")</small></strong> ".$row2['nm_pt']." </strong> &nbsp ".$row2['alamat_pt']."</marquee> ";
		echo "</div>";

		
		?>

<div class="col-sm-6 widget-container-col">
        <div class="widget-box widget-color-dark collapsed">
            <div class="widget-header widget-hea1der-small">
                <h5 class="widget-title">Pegawai yang Berulang Tahun di minggu ini dan 3 minggu kedepan</h5>

                <div class="widget-toolbar">
                    Klik disini
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>

                    <a href="#" data-action="close">
                        <i class="ace-icon fa fa-times"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main padding-4">
                    <div class="scrollable" data-height="125">
                        <div class="content">
                            <?php
                            $data = mysqli_query($mysqli,"SELECT pegawai.id,(year(curdate()) - year(tgl_lahir)) AS t_lahir,tgl_lahir,foto,nama,tgl_lahir,tbl_user.username FROM pegawai
                            left join tbl_user on pegawai.id=tbl_user.id 
                            WHERE DATE_FORMAT(tgl_lahir,'%m %d') BETWEEN DATE_FORMAT((CURDATE()),'%m %d') 
                            AND DATE_FORMAT((INTERVAL 28 DAY + CURDATE()),'%m %d') ORDER BY DATE_FORMAT(tgl_lahir,'%m %d')");
                            while($b = mysqli_fetch_array($data)) {
                                ?>
                                <div class="itemdiv dialogdiv" >
                                <div class="user" >
                                    <img alt = "Bob's Avatar" src = "<?php echo $b['foto']; ?>" />
                                </div >

                                <div class="body" >

                                    <div class="name" >
                                        <a href = "?id=vwprofil&id_n=<?php echo $b['id']; ?>" title="Klik Untuk View Profile"><?php echo $b['nama']; ?></a >
                                    </div >
                                    <div class="text" >Ultah Ke-<?php echo tgl_indo($b['t_lahir']);?></div >
                                    <div class="text" >Lahir pada Tanggal <?php echo tgl_indo($b['tgl_lahir']);?></div >

                                    <div class="tools" >
                                        <a data-toggle="modal" data-target="#<?php echo $b['id']; ?>" href="#" class="btn btn-minier btn-info" title="Kirim Pesan Ucapan Ultah">
                                            <i class="icon-only ace-icon fa fa-envelope-o" ></i >
                                        </a >
                                    </div >
                                </div >
                            </div >

                            <div id="<?php echo $b['id']; ?>" class="modal fade" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header no-padding">
                                            <div class="table-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                    <span class="white">&times;</span>
                                                </button>
                                                <i id="myModalLabel3">Kirim Pesan Ucapan Ulang Tahun </i>
                                            </div>
                                        </div>

                                        <div class="modal-body">


                                                <form action="?id=msg" id="form-inbox" method="POST">

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label" >Kepada:</label>
                                                        <input type="text" class="form-control col-sm-1" placeholder="Username" name="username" value="<?php echo $b['username'] ?>" id="username"  required>
                                                        <div id="status"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Subject:</label>
                                                        <input type="text" class="form-control" name="subject" placeholder="subject" value="Ucapan Selamat Ulang Tahun" id="subject" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="control-label">Pesan:</label>
                                                        <textarea class="form-control" name="pesan" placeholder="Isi Pesan" id="pesan"  required></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" name="kirim" class="btn btn-primary" VALUE="KIRIM">
                                                    </div>
                                                </form>


                                        </div>

                                    </div>
                                </div>
                            </div>

                                <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	
	
<?php 
 if ($_SESSION['leveluser'] < '5') {
	 
 	 
?>	
	
<div class="col-sm-6 widget-container-col">
        <div class="widget-box widget-color-dark collapsed">
            <div class="widget-header widget-hea1der-small">
                <h5 class="widget-title">Pegawai yang akan habis kontrak</h5> 
				<a href="cetak/lap_habiskontrak.php" target="_blank" class="btn btn-sm btn-danger"><i class="ace-icon fa fa-pdf "> Cetak PDF</i></a>
                <div class="widget-toolbar">
                    Klik disini
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>

                    <a href="#" data-action="close">
                        <i class="ace-icon fa fa-times"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main padding-4">
                    <div class="scrollable" data-height="125">
                        <div class="content">
                            <?php
                            $data = mysqli_query($mysqli,"SELECT a.id,a.nip,a.nama,a.foto,datediff(a.tgl_kontrak,current_date()) as sisa,a.tgl_kontrak,b.username from pegawai a 
                                left join tbl_user b on a.id=b.id 
                                where datediff(a.tgl_kontrak,current_date()) BETWEEN 1 and 30");
                            while($b = mysqli_fetch_array($data)) {
                                ?>
                                <div class="itemdiv dialogdiv" >
                                <div class="user" >
                                    <img alt = "Bob's Avatar" src = "<?php echo $b['foto']; ?>" />
                                </div >

                                <div class="body" >

                                    <div class="name" >
                                        <a href = "?id=vwprofil&id_n=<?php echo $b['id']; ?>" title="Klik Untuk View Profile"><?php echo $b['nama']; ?></a >
                                    </div >
                                    <div class="text" >Sisa -<?php echo tgl_indo($b['sisa']);?> hari</div >
                                    <div class="text" >Habis Kontrak pada Tanggal <?php echo tgl_indo($b['tgl_kontrak']);?></div >

                                    
                                </div >
                            </div >

                          

                                <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
<?php
 }

?>




    <div class="col-xs-12 col-sm-12 widget-container-col">
        <div class="widget-box widget-color-orange">
            <div class="widget-header">
                <h5 class="widget-title">Perusahaan</h5>

                <div class="widget-toolbar">

                    <a href="#" data-action="fullscreen" class="orange2">
                        <i class="ace-icon fa fa-expand"></i>
                    </a>

                    <a href="#"  data-action="reload">
                        <i class="ace-icon fa fa-refresh"></i>
                    </a>

                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>

                    <a href="#" data-action="close">
                        <i class="ace-icon fa fa-times"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="col-sm-pull-8 center">
					
                        <?php
                        $view3=mysqli_query($mysqli,"select logo from master");
                        $row3=mysqli_fetch_array($view3);
						$logo=$row3['logo'];
						$logor=str_replace("../"," ",$logo);
						
						
                            echo "<img class='img-responsive center-block' src='$logor' >";

                        
                        ?>
						
                    </div>
                </div>
            </div>
        </div>
    </div>





<?php
}else{
    echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>