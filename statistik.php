<?php
// memanggil berkas koneksi.php


error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$nip			= isset($_SESSION['nip']) ? $_SESSION['nip'] : NULL;


if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5'  )

{






?>

    <div class="col-xs-12 col-sm-12 widget-container-col">
        <div class="widget-box widget-color-orange">
            <div class="widget-header">
                <h5 class="widget-title">Statistik Pegawai</h5>

                <div class="widget-toolbar">

                    <a  href="#dialog" id="0" class="btn btn-purple" data-toggle="modal" >
                        View Tabel
                        <span class="badge badge-warning badge-right"></span>
                    </a>

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
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>


    <div id="dialog" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header no-padding">
                    <div class="table-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <span class="white">&times;</span>
                        </button>
                        <i id="myModalLabel3">Statistik Pegawai Berdasarkan Jabatan </i>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="modal-content">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
                            <?php
                            echo "<tr><th>NO</th><th>JABATAN</th><th>L</th><th>P</th><th>JUMLAH PEGAWAI</th>";

                            $no = 1;
                            $totalPegawai = 0;

                            $hasil = mysqli_query($mysqli,"SELECT * FROM jabatan");
                            while ($data = mysqli_fetch_row($hasil))
                            {

                                $kode= $data[1];

                                $jabatan= $data[2];

                                $hasil2 = mysqli_query($mysqli,"SELECT count(*) as jum FROM pegawai WHERE id_jab = '$kode'");
                                $data2 = mysqli_fetch_row($hasil2);
                                $jumlah = $data2[0];

                                $hasillaki = mysqli_query($mysqli,"SELECT count(*) as laki FROM pegawai WHERE jenis_kelamin='L' and id_jab = '$kode'");
                                $datalaki = mysqli_fetch_row($hasillaki);
                                $jumlahlaki = $datalaki[0];

                                $hasilP = mysqli_query($mysqli,"SELECT count(*) as P FROM pegawai WHERE jenis_kelamin='P' and id_jab = '$kode'");
                                $dataP = mysqli_fetch_row($hasilP);
                                $jumlahP = $dataP[0];

                                $totalpegawai += $jumlah;
                                $totallaki+= $jumlahlaki;
                                $totalP+= $jumlahP;


                                echo "<tr><td>".$no."</td><td>".$jabatan."</td><td>".$jumlahlaki."</td><td>".$jumlahP."</td><td>".$jumlah."&nbsp Pegawai</td>";


                                $no++;
                            }

                            echo "<tr><td colspan='2'>JUMLAH</td><td>".$totallaki."</td><td>".$totalP."</td><td>".$totalpegawai."&nbsp Pegawai</td>";



                            ?>
                        </table>
                      </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Keluar</button>
                </div>
            </div>
        </div>
    </div>


    



<?php
}else{
    echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>