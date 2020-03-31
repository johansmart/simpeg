<?php
$sesi_username          = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1') {

//$p_nip          = isset($_POST['nip']) ? $_POST['nip'] : "";
//$p_nama         = isset($_POST['nama']) ? strtoupper($_POST['nama']) : "";
//$p_tmptlahir    = isset($_POST['tmptlahir']) ? strtoupper($_POST['tmptlahir']) : "";
//$p_tgl_lahir    = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : "";

?>

<!-- <div class="space-24"></div> -->
    
<div>
    <div class="widget-box widget-color-blue">

        

        <div class="widget-header widget-header-small">
            <h6 class="widget-title">
                <i class="ace-icon fa fa-sort"></i>
                DAFTAR URUT KEPANGKATAN
            </h6>

            <div class="widget-toolbar">
                Klik disini

                <a href="#" data-action="collapse">
                    <i class="ace-icon fa fa-plus" data-icon-show="fa-plus" data-icon-hide="fa-minus"></i>
                </a>

                <a href="#" data-action="close">
                    <i class="ace-icon fa fa-times"></i>
                </a>
            </div>
        </div>

                        <div class='widget-body' >
                        <div class='widget-main'>
						
						
                        <div class="table-responsive">        
                        <?php
						include "config/class_paging.php"; 

							$page	= new Paging;
							$batas 	= 5;
							$posisi	= $page->cariPosisi($batas);
                            $no = $posisi+1;	
							if($sesi_level==1){
								echo" <a href='cetak/cetakduk.php' target='_blank' class='btn btn-danger'><i class='ace-icon fa fa-print  align-top bigger-125 icon-on-right'></i> CETAK</a>" ;	
							}
                        echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover h6 small' <tbody> ";
                                echo "
                                
                                <tr >
                                    <td rowspan='2' align='center'><b>No Urut</b> </td>
                                    <td rowspan='2' align='center'><b>NAMA</b></td>
                                    <td rowspan='2' align='center'><b>NIP</b></td>
                                    <td colspan='4' align='center'><b>Pangkat/Jabatan</b></td>
                                    <td colspan='2' align='center'><b>Masa Kerja</b></td>
                                    <td colspan='4' align='center'><b>Latihan Jabatan</b></td>
                                    <td colspan='3' align='center'><b>Pendidikan</b></td>
                                    <td rowspan='2' align='center'><b>U<br>S<br>I<br>A</b></td>
                                    <td rowspan='2' align='center'><b>Catatan <br>Mutasi </br>Kepegawaian</b></td>
                                    <td rowspan='2' align='center'><b>Ket</b></td>
                                </tr>

                                <tr>
                                    <td align='center'>Gol.<br>Ruang</td>
                                    <td align='center'>T.M.T</td>
                                    <td align='center'>Nama</td>
                                    <td align='center'>T.M.T</td>  
                                    <td align='center'>THN</td>
                                    <td align='center'>BLN</td> 
                                    <td align='center'>Nama</td>
                                    <td align='center'>BLN</td>  
                                    <td align='center'>THN</td>
                                    <td align='center'>JML<br>JAM</td>  
                                    <td align='center'>Nama</td>
                                    <td align='center'>Lulus<br>THN</td>  
                                    <td align='center'>TKT<br>IJZ</td>
                                </tr>
                                ";

                            $query = "SELECT *,(year(curdate()) - year(tgl_lahir)) AS umur FROM pegawai order by id_jab DESC LIMIT $posisi,$batas ";
                            $result = mysqli_query($mysqli,$query);
                            while ($data = mysqli_fetch_array($result))
                            {
                                echo "
                                <tr>
                                    <td>".$no++."</td>
                                    <td>".$data['nama']."</td>
                                    <td>".$data['nip']."</td>";
                                $querygol=mysqli_query($mysqli,"SELECT b.gol,a.tmt_tgl from golongan a
                                    left join tbl_gol b on a.id_gol=b.id_gol 
                                    where a.id_gol='".$data['id_gol']."' and id='".$data['id']."'");
                                $rowgol=mysqli_fetch_array($querygol);
                                    echo"<td>".$rowgol['gol']."</td>";
                                    echo"<td>".$rowgol['tmt_tgl']."</td>";

                                $queryjab=mysqli_query($mysqli,"SELECT b.n_jab,a.tgl_jab from h_jabatan a
                                    left join jabatan b on a.kode=b.kode 
                                    where a.kode='".$data['id_jab']."' and id='".$data['id']."'");
                                $rowjab=mysqli_fetch_array($queryjab);
                                    echo"<td>".$rowjab['n_jab']."</td>";
                                    echo"<td>".$rowjab['tgl_jab']."</td>";
                                    echo"<td>".MasaKerjaTahun($data['tgl_masuk'],$tahunM,$bulanM,$tanggalM)."</td>";
                                    echo"<td>".MasaKerjaBulan($data['tgl_masuk'],$tahunM,$bulanM,$tanggalM)."</td>";
                                $querypelatihan=mysqli_query($mysqli,"select * from pelatihan where id='".$data['id']."'");
                                    echo"<td>";
                                    while ($rowpel=mysqli_fetch_array($querypelatihan)){
                                         echo"".$rowpel['topik_pelatihan']."";
                                         echo "<br>";
                                    }
                                    echo "</td>";
                                    echo"<td></td>";
                                    echo"<td></td>";
                                    echo"<td>";
                                $querypelatihan2=mysqli_query($mysqli,"select * from pelatihan where id='".$data['id']."'");    
                                    while ($rowpel2=mysqli_fetch_array($querypelatihan2)){
                                         echo"".$rowpel2['jam']."";
                                         echo "<br>";
                                    }
                                    echo "</td>";

                               
                                $querypendidikan=mysqli_query($mysqli,"select a.*,b.nmpndidik from pendidikan a left join tbl_pendidikan b on a.kdpndidik=b.kdpndidik
                                    where a.id='".$data['id']."' and a.kdpndidik='".$data['kdpndidik']."' ");    
                                    $rowpen=mysqli_fetch_array($querypendidikan);
                                         echo"<td>".$rowpen['jurusan']."</td>";
                                         echo"<td>".$rowpen['t_pdk']."</td>";
                                         echo"<td>".$rowpen['nmpndidik']."</td>";
                                         echo"<td>".$data['umur']."</td>";
                                         echo"<td></td>";
                                         echo"<td></td>";
                                         

                                echo"</tr>
                                ";
                            }        


                            echo "</tbody></table> ";
								$jmldata = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM pegawai"));
								$jmlhalaman = $page->jumlahHalaman($jmldata,$batas);
								$linkhalaman = $page->navHalaman($_GET['halaman'],$jmlhalaman);
								 echo "$linkhalaman";
						
                        ?>
						</div>
                        </div>
                        </div>
                        
                    </div>
    </div> 




<?php
//} //penutup : if (isset($_POST['print'])) {
}else{
      echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}

?>