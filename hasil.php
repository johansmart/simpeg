<?php
session_start();
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_level				= isset($_SESSION['leveluser']) ? $_SESSION['leveluser'] : NULL;
if ($sesi_level !='1' && $sesi_level !='2'){
    header('location:index.php');

} 
include "config/koneksi.php";
if (isset($_POST['kirim_excel'])) {
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=hasil.xls");
    $bagianWhere = "";

   if (isset($_POST['idnama'])) {
        $nama = $_POST['name'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.nama LIKE '%$nama%'";
        } else {
            $bagianWhere .= "AND a.nama='%$nama%'";
        }
    }

    if (isset($_POST['statusp'])) {
        $kd_statusp = $_POST['kd_statusp'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kdstatusp='$kd_statusp'";
        } else {
            $bagianWhere .= " AND a.kdstatusp='$kd_statusp'";
        }
    }

    if (isset($_POST['subbag'])) {
        $kdsubbag = $_POST['kdsubbag'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kd_sub='$kdsubbag'";
        } else {
            $bagianWhere .= " AND a.kd_sub='$kdsubbag'";
        }
    }
    if (isset($_POST['jbstruk'])) {
        $jbstruk = $_POST['kd_jbstruk'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kd_jbstruk='$jbstruk'";
        } else {
            $bagianWhere .= " AND a.kd_jbstruk='$jbstruk'";
        }
    }

    if (isset($_POST['jbfungsi'])) {
        $jbfungsi = $_POST['kd_jbfungsi'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kd_jbfungsi='$jbfungsi'";
        } else {
            $bagianWhere .= "AND a.kd_jbfungsi='$jbfungsi'";
        }
    }
    if (isset($_POST['idjabatan'])) {
        $jabatan = $_POST['id_jab'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.id_jab='$jabatan'";
        } else {
            $bagianWhere .= "AND a.id_jab='$jabatan'";
        }
    }
    if (isset($_POST['idbagian'])) {
        $bagian = $_POST['id_bag'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.id_bag='$bagian'";
        } else {
            $bagianWhere .= "AND a.id_bag='$bagian'";
        }
    }
    if (isset($_POST['idkdkpkrn'])) {
        $nmkepakaran = $_POST['nmkdkpkrn'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.nmkepakaran like '%$nmkepakaran%'";
        } else {
            $bagianWhere .= "AND a.nmkepakaran like '%$nmkepakaran%'";
        }
    }
    if (isset($_POST['umur'])) {
        $bagian1 = $_POST['umur1'];
        $bagian2 = $_POST['umur2'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "(year(curdate()) - year(pegawai.tgl_lahir)) BETWEEN '$bagian1' and '$bagian2' ";
        } else {
            $bagianWhere .= "AND (year(curdate()) - year(pegawai.tgl_lahir)) BETWEEN '$bagian1' and '$bagian2'";
        }
    }
	
	if (isset($_POST['mkerja'])) {
        $mkerja1 = $_POST['mkerja1'];
        $mkerja2 = $_POST['mkerja2'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "(year(curdate()) - year(pegawai.tgl_masuk)) BETWEEN '$mkerja1' and '$mkerja2' ";
        } else {
            $bagianWhere .= "AND (year(curdate()) - year(pegawai.tgl_masuk)) BETWEEN '$mkerja1' and '$mkerja2' ";
        }
    }
	
    if (isset($_POST['pndk'])) {
        $bagian = $_POST['idpndk'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kdpndidik='$bagian'";
        } else {
            $bagianWhere .= "AND a.kdpndidik='$bagian'";
        }
    }
	 if (isset($_POST['idstsk'])) {
        $bagian = $_POST['id_stsk'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.id_stsk='$bagian'";
        } else {
            $bagianWhere .= "AND a.id_stsk='$bagian'";
        }
    }
    if (isset($_POST['golongan'])) {
        $bagian = $_POST['idgol'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.id_gol='$bagian'";
        } else {
            $bagianWhere .= "AND a.id_gol='$bagian'";
        }
    }

    $query = "select a.nip,a.nama,a.id_bag,a.id_stsk,a.id_jab,a.nmkepakaran,a.kdstatusp,a.idjns,a.kdpndidik,a.kd_jbfungsi,a.kd_jbstruk,a.kd_sub,a.id_gol,b.nmstatusp, c.urai_sub,d.nm_jbfungsi,e.nm_jbstruk,f.n_jab,g.n_bag,h.nm_stsk,(year(curdate()) - year(a.tgl_lahir)) AS t_lahir,j.nmpndidik,k.gol,(year(curdate()) - year(a.tgl_masuk)) AS t_mk  from pegawai a 
             LEFT join tbl_statusp b ON a.kdstatusp = b.kdstatusp 
             LEFT JOIN sub_bagian c ON a.kd_sub = c.kd_sub 
             LEFT JOIN jb_fungsi d ON a.kd_jbfungsi=d.kd_jbfungsi 
             LEFT JOIN jb_struk e ON a.kd_jbstruk =e.kd_jbstruk 
             LEFT JOIN jabatan f ON a.id_jab = f.kode 
             LEFT JOIN bagian g ON a.id_bag = g.kd_bag 
             LEFT JOIN sts_keaktifan h ON a.id_stsk=h.id_stsk 
             LEFT JOIN tbl_pendidikan j ON a.kdpndidik = j.kdpndidik 
             LEFT JOIN tbl_gol k ON a.id_gol = k.id_gol
			 WHERE " . $bagianWhere;
    $hasil = mysqli_query($mysqli, $query);
    $j_data = mysqli_num_rows($hasil);
    echo "<div style='padding:5px;overflow: auto;height: 400px ;border:1px class='table-responsive'>";

    echo "<table id='sample-table-1' class='table table-striped table-bordered table-hover'>";
    echo "<tr><b><td>No</td><td>Nama</td><td>status</td><td>Sub Bagian</td><td>Jabatan Fungsional</td><td>Jabatan Struktural</td><td>Jabatan</td><td>Bagian</td><td>Kepakaran</td><td>Umur</td><td>Pendidikan</td><td>Golongan</td><td>masa kerja</td></b></tr>";
    if ($hasil == 0) {
        echo "<tr><td id='tengah' colspan='12'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($data = mysqli_fetch_array($hasil)) {
            echo "<div><tr><td>$no</td><td>" . $data['nama'] . "</td><td>" . $data['nmstatusp'] . "</td><td>" . $data['urai_sub'] . "</td><td>" . $data['nm_jbfungsi'] . "</td><td>" . $data['nm_jbstruk'] . "</td><td>" . $data['n_jab'] . "</td><td>" . $data['n_bag'] . "</td><td>" . $data['nmkepakaran'] . "</td><td>" . $data['t_lahir'] . "</td><td>" . $data['nmpndidik'] . "</td><td>" . $data['gol'] . "</td><td>" . $data['t_mk'] . "</td></tr></div>";
            $no++;
        }

    }
    echo "</table></div>Jumlah data yang di cari : $j_data ";
}

if (isset($_POST['submit'])) {

    $bagianWhere = "";

    if (isset($_POST['idnama'])) {
        $nama = $_POST['name'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.nama LIKE '%$nama%'";
        } else {
            $bagianWhere .= "AND a.nama='%$nama%'";
        }
    }

    if (isset($_POST['statusp'])) {
        $kd_statusp = $_POST['kd_statusp'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kdstatusp='$kd_statusp'";
        } else {
            $bagianWhere .= " AND a.kdstatusp='$kd_statusp'";
        }
    }

    if (isset($_POST['subbag'])) {
        $kdsubbag = $_POST['kdsubbag'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kd_sub='$kdsubbag'";
        } else {
            $bagianWhere .= " AND a.kd_sub='$kdsubbag'";
        }
    }
    if (isset($_POST['jbstruk'])) {
        $jbstruk = $_POST['kd_jbstruk'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kd_jbstruk='$jbstruk'";
        } else {
            $bagianWhere .= " AND a.kd_jbstruk='$jbstruk'";
        }
    }

    if (isset($_POST['jbfungsi'])) {
        $jbfungsi = $_POST['kd_jbfungsi'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kd_jbfungsi='$jbfungsi'";
        } else {
            $bagianWhere .= "AND a.kd_jbfungsi='$jbfungsi'";
        }
    }
    if (isset($_POST['idjabatan'])) {
        $jabatan = $_POST['id_jab'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.id_jab='$jabatan'";
        } else {
            $bagianWhere .= "AND a.id_jab='$jabatan'";
        }
    }
    if (isset($_POST['idbagian'])) {
        $bagian = $_POST['id_bag'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.id_bag='$bagian'";
        } else {
            $bagianWhere .= "AND a.id_bag='$bagian'";
        }
    }
    if (isset($_POST['idkdkpkrn'])) {
        $nmkepakaran = $_POST['nmkdkpkrn'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.nmkepakaran like '%$nmkepakaran%'";
        } else {
            $bagianWhere .= "AND a.nmkepakaran like '%$nmkepakaran%'";
        }
    }
    if (isset($_POST['umur'])) {
        $bagian1 = $_POST['umur1'];
        $bagian2 = $_POST['umur2'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "(year(curdate()) - year(a.tgl_lahir)) BETWEEN '$bagian1' and '$bagian2' ";
        } else {
            $bagianWhere .= "(year(curdate()) - year(a.tgl_lahir)) BETWEEN '$bagian1' and '$bagian2'";
        }
    }
    
    if (isset($_POST['mkerja'])) {
        $mkerja1 = $_POST['mkerja1'];
        $mkerja2 = $_POST['mkerja2'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "(year(curdate()) - year(a.tgl_masuk)) BETWEEN '$mkerja1' and '$mkerja2' ";
        } else {
            $bagianWhere .= "AND (year(curdate()) - year(a.tgl_masuk)) BETWEEN '$mkerja1' and '$mkerja2' ";
        }
    }
	
    if (isset($_POST['pndk'])) {
        $bagian = $_POST['idpndk'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kdpndidik='$bagian'";
        } else {
            $bagianWhere .= "AND a.kdpndidik='$bagian'";
        }
    }
	 if (isset($_POST['idstsk'])) {
        $bagian = $_POST['id_stsk'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.id_stsk='$bagian'";
        } else {
            $bagianWhere .= "AND a.id_stsk='$bagian'";
        }
    }
    if (isset($_POST['golongan'])) {
        $bagian = $_POST['idgol'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.id_gol='$bagian'";
        } else {
            $bagianWhere .= "AND a.id_gol='$bagian'";
        }
    }

     $query = "select a.nip,a.nama,a.id_bag,a.id_stsk,a.id_jab,a.nmkepakaran,a.kdstatusp,a.idjns,a.kdpndidik,a.kd_jbfungsi,a.kd_jbstruk,a.kd_sub,a.id_gol,b.nmstatusp, c.urai_sub,d.nm_jbfungsi,e.nm_jbstruk,f.n_jab,g.n_bag,h.nm_stsk,(year(curdate()) - year(a.tgl_lahir)) AS t_lahir,j.nmpndidik,k.gol,(year(curdate()) - year(a.tgl_masuk)) AS t_mk  from pegawai a 
             LEFT join tbl_statusp b ON a.kdstatusp = b.kdstatusp 
             LEFT JOIN sub_bagian c ON a.kd_sub = c.kd_sub 
             LEFT JOIN jb_fungsi d ON a.kd_jbfungsi=d.kd_jbfungsi 
             LEFT JOIN jb_struk e ON a.kd_jbstruk =e.kd_jbstruk 
             LEFT JOIN jabatan f ON a.id_jab = f.kode 
             LEFT JOIN bagian g ON a.id_bag = g.kd_bag 
             LEFT JOIN sts_keaktifan h ON a.id_stsk=h.id_stsk 
             LEFT JOIN tbl_pendidikan j ON a.kdpndidik = j.kdpndidik 
             LEFT JOIN tbl_gol k ON a.id_gol = k.id_gol
             WHERE " . $bagianWhere;
    $hasil = mysqli_query($mysqli, $query);
    $j_data = mysqli_num_rows($hasil);
    echo "<div class='table-responsive'><table id='sample-table-1' class='table table-striped table-bordered table-hover'>";
    echo "<tr><b><td>No</td><td>Nama</td><td>Status</td><td>Sub Bagian</td><td>Fungsi</td><td>Strukt</td><td>Jab</td><td>Bag</td><td>Kepakaran</td><td>Umur</td><td>Pendidikan</td><td>Status</td><td>Gol</td></b></tr>";
    if ($hasil=="") {
        echo "<tr><td id='tengah' colspan='13'>-- Data yang anda cari tidak ada --</td></tr>";
    } else {
        $no = 1;
        while ($data = mysqli_fetch_array($hasil)) {
            echo "<div><tr><td>$no</td><td>" . $data['nama'] . "</td><td>" . $data['nmstatusp'] . "</td><td>" . $data['urai_sub'] . "</td><td>" . $data['nm_jbfungsi'] . "</td><td>" . $data['nm_jbstruk'] . "</td><td>" . $data['n_jab'] . "</td><td>" . $data['n_bag'] . "</td><td>" . $data['nmkepakaran'] . "</td><td>" . $data['t_lahir'] . "</td><td>" . $data['nmpndidik'] . "</td><td>" . $data['nm_stsk'] . "</td><td>" . $data['gol'] . "</td></tr>";
            $no++;
        }
    }
    echo "</table></div>Jumlah data yang di cari : $j_data ";

}
if (isset($_POST['print'])) {

    echo"<!DOCTYPE html>
<html lang='en'>
<head>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
    <meta charset='utf-8' />
    <title>Laporan Data Pegawai</title>

    <meta name='description' content='overview &amp; stats' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    <link rel='shortcut icon' href='favicon.ico' />
    <!-- bootstrap & fontawesome -->
    <link rel='stylesheet' href='assets/css/bootstrap.min.css' />
    <link rel='stylesheet' href='assets/font-awesome/4.1.0/css/font-awesome.min.css' />

    <link rel='stylesheet' href='assets/css/jquery-ui.custom.min.css' />
</head>
<body class='skin-3'>

    ";
    $bagianWhere = "";

        if (isset($_POST['idnama'])) {
        $nama = $_POST['name'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.nama LIKE '%$nama%'";
        } else {
            $bagianWhere .= "AND a.nama='%$nama%'";
        }
    }

    if (isset($_POST['statusp'])) {
        $kd_statusp = $_POST['kd_statusp'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kdstatusp='$kd_statusp'";
        } else {
            $bagianWhere .= " AND a.kdstatusp='$kd_statusp'";
        }
    }

    if (isset($_POST['subbag'])) {
        $kdsubbag = $_POST['kdsubbag'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kd_sub='$kdsubbag'";
        } else {
            $bagianWhere .= " AND a.kd_sub='$kdsubbag'";
        }
    }
    if (isset($_POST['jbstruk'])) {
        $jbstruk = $_POST['kd_jbstruk'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kd_jbstruk='$jbstruk'";
        } else {
            $bagianWhere .= " AND a.kd_jbstruk='$jbstruk'";
        }
    }

    if (isset($_POST['jbfungsi'])) {
        $jbfungsi = $_POST['kd_jbfungsi'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kd_jbfungsi='$jbfungsi'";
        } else {
            $bagianWhere .= "AND a.kd_jbfungsi='$jbfungsi'";
        }
    }
    if (isset($_POST['idjabatan'])) {
        $jabatan = $_POST['id_jab'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.id_jab='$jabatan'";
        } else {
            $bagianWhere .= "AND a.id_jab='$jabatan'";
        }
    }
    if (isset($_POST['idbagian'])) {
        $bagian = $_POST['id_bag'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.id_bag='$bagian'";
        } else {
            $bagianWhere .= "AND a.id_bag='$bagian'";
        }
    }
    if (isset($_POST['idkdkpkrn'])) {
        $nmkepakaran = $_POST['nmkdkpkrn'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.nmkepakaran like '%$nmkepakaran%'";
        } else {
            $bagianWhere .= "AND a.nmkepakaran like '%$nmkepakaran%'";
        }
    }
    if (isset($_POST['umur'])) {
        $bagian1 = $_POST['umur1'];
        $bagian2 = $_POST['umur2'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "(year(curdate()) - year(a.tgl_lahir)) BETWEEN '$bagian1' and '$bagian2' ";
        } else {
            $bagianWhere .= "(year(curdate()) - year(a.tgl_lahir)) BETWEEN '$bagian1' and '$bagian2'";
        }
    }
	
	if (isset($_POST['mkerja'])) {
        $mkerja1 = $_POST['mkerja1'];
        $mkerja2 = $_POST['mkerja2'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "(year(curdate()) - year(a.tgl_masuk)) BETWEEN '$mkerja1' and '$mkerja2' ";
        } else {
            $bagianWhere .= "AND (year(curdate()) - year(a.tgl_masuk)) BETWEEN '$mkerja1' and '$mkerja2' ";
        }
    }
	
    if (isset($_POST['pndk'])) {
        $bagian = $_POST['idpndk'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.kdpndidik='$bagian'";
        } else {
            $bagianWhere .= "AND a.kdpndidik='$bagian'";
        }
    }
	 if (isset($_POST['idstsk'])) {
        $bagian = $_POST['id_stsk'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.id_stsk='$bagian'";
        } else {
            $bagianWhere .= "AND a.id_stsk='$bagian'";
        }
    }
    if (isset($_POST['golongan'])) {
        $bagian = $_POST['idgol'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "a.id_gol='$bagian'";
        } else {
            $bagianWhere .= "AND a.id_gol='$bagian'";
        }
    }

    $query = "select a.nip,a.nama,a.id_bag,a.id_stsk,a.id_jab,a.nmkepakaran,a.kdstatusp,a.idjns,a.kdpndidik,a.kd_jbfungsi,a.kd_jbstruk,a.kd_sub,a.id_gol,b.nmstatusp, c.urai_sub,d.nm_jbfungsi,e.nm_jbstruk,f.n_jab,g.n_bag,h.nm_stsk,(year(curdate()) - year(a.tgl_lahir)) AS t_lahir,j.nmpndidik,k.gol,(year(curdate()) - year(a.tgl_masuk)) AS t_mk  from pegawai a 
             LEFT join tbl_statusp b ON a.kdstatusp = b.kdstatusp 
             LEFT JOIN sub_bagian c ON a.kd_sub = c.kd_sub 
             LEFT JOIN jb_fungsi d ON a.kd_jbfungsi=d.kd_jbfungsi 
             LEFT JOIN jb_struk e ON a.kd_jbstruk =e.kd_jbstruk 
             LEFT JOIN jabatan f ON a.id_jab = f.kode 
             LEFT JOIN bagian g ON a.id_bag = g.kd_bag 
             LEFT JOIN sts_keaktifan h ON a.id_stsk=h.id_stsk 
             LEFT JOIN tbl_pendidikan j ON a.kdpndidik = j.kdpndidik 
             LEFT JOIN tbl_gol k ON a.id_gol = k.id_gol
             WHERE " . $bagianWhere;
    $hasil = mysqli_query($mysqli, $query);
    $j_data = mysqli_num_rows($hasil);
    echo "Hasil Pencarian";
    echo "<div class='table-responsive'><table id='sample-table-1' class='table table-striped table-bordered table-hover'>";
    echo "<tr><b><td>No</td><td>Nama</td><td>status</td><td>Sub Bagian</td><td>Jabatan Fungsional</td><td>Jabatan Struktural</td><td>Jabatan</td><td>Bagian</td><td>Kepakaran</td><td>Umur</td><td>Pendidikan</td><td>Golongan</td><td>masa kerja</td></b></tr>";
    if ($hasil == 0) {
        echo "<tr><td id='tengah' colspan='12'>-- Tidak Ada Data --</td></tr>";
    } else {
        $no = 1;
        while ($data = mysqli_fetch_array($hasil)) {
            echo "<div><tr><td>$no</td><td>" . $data['nama'] . "</td><td>" . $data['nmstatusp'] . "</td><td>" . $data['urai_sub'] . "</td><td>" . $data['nm_jbfungsi'] . "</td><td>" . $data['nm_jbstruk'] . "</td><td>" . $data['n_jab'] . "</td><td>" . $data['n_bag'] . "</td><td>" . $data['nmkepakaran'] . "</td><td>" . $data['t_lahir'] . "</td><td>" . $data['nmpndidik'] . "</td><td>" . $data['gol'] . "</td><td>" . $data['t_mk'] . "</td></tr></div>";
            $no++;
        }

    }
    echo "</table></div>Jumlah data yang di cari : $j_data ";
    echo "<a href='' cls='btn btn-info' onClick='window.print();return false'><i class='icon-print'></i>Cetak </a>";

    echo"</body></html>";
}
?>
