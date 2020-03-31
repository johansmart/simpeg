<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2' )

{
?>

<div class="col-xs-12 col-sm-6 widget-container-col">
    <div class="widget-box widget-color-orange">
        <div class="widget-header widget-header-small">
            <h6 class="widget-title">
                <i class="ace-icon fa fa-sort"></i>
                Rekapitulasi Berdasarkan Jabatan
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

        <div class="widget-body">
            <div class="widget-main">

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
    </div>
</div>

<div class="col-xs-12 col-sm-6 widget-container-col">
    <div class="widget-box widget-color-orange">
        <div class="widget-header widget-header-small">
            <h6 class="widget-title">
                <i class="ace-icon fa fa-sort"></i>
                Rekapitulasi Berdasarkan Agama
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

        <div class="widget-body">
            <div class="widget-main">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
                    <?php
					
                    echo "<tr><th>NO</th><th>AGAMA</th><th>L</th><th>P</th><th>JUMLAH PEGAWAI</th>";

                    $no = 1;
                    $totalPegawaiagm = 0;

                    $hasil = mysqli_query($mysqli,"SELECT * FROM tbl_agama");
                    while ($data = mysqli_fetch_row($hasil))
                    {

                        $id_agm= $data[0];

                        $agama= $data[1];

                        $hasilagm = mysqli_query($mysqli,"SELECT count(*) as jum FROM pegawai WHERE id_agm = '$id_agm'");
                        $dataagm = mysqli_fetch_row($hasilagm);
                        $jumlahagm = $dataagm[0];

                        $hasillakiagm = mysqli_query($mysqli,"SELECT count(*) as laki FROM pegawai WHERE jenis_kelamin='L' and id_agm = '$id_agm'");
                        $datalakiagm = mysqli_fetch_row($hasillakiagm);
                        $jumlahlakiagm = $datalakiagm[0];

                        $hasilPagm = mysqli_query($mysqli,"SELECT count(*) as P FROM pegawai WHERE jenis_kelamin='P' and id_agm = '$id_agm'");
                        $dataPagm = mysqli_fetch_row($hasilPagm);
                        $jumlahPagm = $dataPagm[0];

                        $totalpegawaiagm += $jumlahagm;
                        $totallakiagm+= $jumlahlakiagm;
                        $totalPagm+= $jumlahPagm;


                        echo "<tr><td>".$no."</td><td>".$agama."</td><td>".$jumlahlakiagm."</td><td>".$jumlahPagm."</td><td>".$jumlahagm."&nbsp Pegawai</td>";


                        $no++;
                    }

                    echo "<tr><td colspan='2'>JUMLAH</td><td>".$totallakiagm."</td><td>".$totalPagm."</td><td>".$totalpegawaiagm."&nbsp Pegawai</td>";



                    ?>
                </table>

            </div>
        </div>
    </div>
</div>

<div class="space-24"></div>

<div class="col-xs-12 col-sm-6 widget-container-col">
    <div class="widget-box widget-color-orange collapsed">
        <div class="widget-header widget-header-small">
            <h6 class="widget-title">
                <i class="ace-icon fa fa-sort"></i>
                Rekapitulasi Berdasarkan Bagian
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

        <div class="widget-body">
            <div class="widget-main">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
                    <?php
                    echo "<tr><th>NO</th><th>BAGIAN</th><th>L</th><th>P</th><th>JUMLAH PEGAWAI</th>";

                    $nobg = 1;
                    $totalPegawaibg = 0;

                    $hasil = mysqli_query($mysqli,"SELECT * FROM bagian");
                    while ($data = mysqli_fetch_row($hasil))
                    {

                        $kodebg= $data[1];

                        $bagian= $data[2];

                        $hasilbg = mysqli_query($mysqli,"SELECT count(*) as jum FROM pegawai WHERE id_bag = '$kodebg'");
                        $databg = mysqli_fetch_row($hasilbg);
                        $jumlahbg = $databg[0];

                        $hasillakibg = mysqli_query($mysqli,"SELECT count(*) as laki FROM pegawai WHERE jenis_kelamin='L' and id_bag = '$kodebg'");
                        $datalakibg = mysqli_fetch_row($hasillakibg);
                        $jumlahlakibg = $datalakibg[0];

                        $hasilPbg = mysqli_query($mysqli,"SELECT count(*) as P FROM pegawai WHERE jenis_kelamin='P' and id_bag = '$kodebg'");
                        $dataPbg = mysqli_fetch_row($hasilPbg);
                        $jumlahPbg = $dataPbg[0];

                        $totalpegawaibg += $jumlahbg;
                        $totallakibg+= $jumlahlakibg;
                        $totalPbg+= $jumlahPbg;


                        echo "<tr><td>".$nobg."</td><td>".$bagian."</td><td>".$jumlahlakibg."</td><td>".$jumlahPbg."</td><td>".$jumlahbg."&nbsp Pegawai</td>";


                        $nobg++;
                    }

                    echo "<tr><td colspan='2'>JUMLAH</td><td>".$totallakibg."</td><td>".$totalPbg."</td><td>".$totalpegawaibg."&nbsp Pegawai</td>";



                    ?>
                </table>

            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-sm-6 widget-container-col">
    <div class="widget-box widget-color-orange collapsed">
        <div class="widget-header widget-header-small">
            <h6 class="widget-title">
                <i class="ace-icon fa fa-sort"></i>
                Rekapitulasi Berdasarkan Pendidikan Terakhir
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

        <div class="widget-body">
            <div class="widget-main">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
                    <?php
                    echo "<tr><th>NO</th><th>PENDIDIKAN</th><th>L</th><th>P</th><th>JUMLAH PEGAWAI</th>";

                    $no = 1;
                    $totalPegawaipndk = 0;

                    $hasil = mysqli_query($mysqli,"SELECT * FROM tbl_pendidikan");
                    while ($data = mysqli_fetch_row($hasil))
                    {

                        $kdpndidik= $data[0];

                        $nmpndidik= $data[1];

                        $hasilpndk = mysqli_query($mysqli,"SELECT count(*) as jum FROM pegawai WHERE kdpndidik = '$kdpndidik'");
                        $datapndk = mysqli_fetch_row($hasilpndk);
                        $jumlahpndk = $datapndk[0];

                        $hasillakipndk = mysqli_query($mysqli,"SELECT count(*) as laki FROM pegawai WHERE jenis_kelamin='L' and kdpndidik = '$kdpndidik'");
                        $datalakipndk = mysqli_fetch_row($hasillakipndk);
                        $jumlahlakipndk = $datalakipndk[0];

                        $hasilPpndk = mysqli_query($mysqli,"SELECT count(*) as P FROM pegawai WHERE jenis_kelamin='P' and kdpndidik = '$kdpndidik'");
                        $dataPpndk = mysqli_fetch_row($hasilPpndk);
                        $jumlahPpndk = $dataPpndk[0];

                        $totalpegawaipndk += $jumlahpndk;
                        $totallakipndk+= $jumlahlakipndk;
                        $totalPpndk+= $jumlahPpndk;


                        echo "<tr><td>".$no."</td><td>".$nmpndidik."</td><td>".$jumlahlakipndk."</td><td>".$jumlahPpndk."</td><td>".$jumlahpndk."&nbsp Pegawai</td>";


                        $no++;
                    }

                    echo "<tr><td colspan='2'>JUMLAH</td><td>".$totallakipndk."</td><td>".$totalPpndk."</td><td>".$totalpegawaipndk."&nbsp Pegawai</td>";



                    ?>
                </table>

            </div>
        </div>
    </div>
</div>

<div class="space-24"></div>
<div class="space-24"></div>

<div class="col-xs-12 col-sm-6 widget-container-col">
    <div class="widget-box widget-color-orange collapsed">
        <div class="widget-header widget-header-small">
            <h6 class="widget-title">
                <i class="ace-icon fa fa-sort"></i>
                Rekapitulasi Berdasarkan Status Pegawai
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

        <div class="widget-body">
            <div class="widget-main">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
                    <?php
                    echo "<tr><th>NO</th><th>Status</th><th>L</th><th>P</th><th>JUMLAH PEGAWAI</th>";

                    $no = 1;
                    $totalPegawaists = 0;

                    $hasil = mysqli_query($mysqli,"SELECT * FROM tbl_statusp");
                    while ($data = mysqli_fetch_row($hasil))
                    {

                        $kdstatusp= $data[0];

                        $nmstatusp= $data[1];

                        $hasilstsp = mysqli_query($mysqli,"SELECT count(*) as jum FROM pegawai WHERE kdstatusp = '$kdstatusp'");
                        $datastsp = mysqli_fetch_row($hasilstsp);
                        $jumlahstsp = $datastsp[0];

                        $hasillakistsp = mysqli_query($mysqli,"SELECT count(*) as laki FROM pegawai WHERE jenis_kelamin='L' and kdstatusp = '$kdstatusp'");
                        $datalakistsp = mysqli_fetch_row($hasillakistsp);
                        $jumlahlakistsp = $datalakistsp[0];

                        $hasilPstsp = mysqli_query($mysqli,"SELECT count(*) as P FROM pegawai WHERE jenis_kelamin='P' and kdstatusp = '$kdstatusp'");
                        $dataPstsp = mysqli_fetch_row($hasilPstsp);
                        $jumlahPstsp = $dataPstsp[0];

                        $totalpegawaistsp += $jumlahstsp;
                        $totallakistsp+= $jumlahlakistsp;
                        $totalPstsp+= $jumlahPstsp;


                        echo "<tr><td>".$no."</td><td>".$nmstatusp."</td><td>".$jumlahlakistsp."</td><td>".$jumlahPstsp."</td><td>".$jumlahstsp."&nbsp Pegawai</td>";


                        $no++;
                    }

                    echo "<tr><td colspan='2'>JUMLAH</td><td>".$totallakistsp."</td><td>".$totalPstsp."</td><td>".$totalpegawaistsp."&nbsp Pegawai</td>";



                    ?>
                </table>

            </div>
        </div>
    </div>
</div>
<?php
}else{
    header('Location:../index.php?status=Silahkan Login');
}
?>