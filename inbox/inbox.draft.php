<?php
 session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL && !empty($sesi_username) && $_SESSION['leveluser']<='7')
{
// panggil berkas koneksi.php
include "../config/koneksi.php";
$nm_user=isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
include "../config/fungsi_ago.php";

?>






 <div class="span8">
    <div class="table-responsive">
<table class="table">
<thead>
    <tr>
        <th>Pengirim</th>
        <th>Kepada</th>
        <th>Subject</th>
		<th>Pesan</th>
        <th>Waktu</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    <?php

    $i = 1;
    $jml_per_halaman = 12; // jumlah data yg ditampilkan perhalaman
    $query = mysqli_query($mysqli,"select * from tabel_pesan where dari='$nm_user' and draft='1' order by waktu");
    $jml_data= mysqli_num_rows($query);
    $jml_halaman = ceil($jml_data / $jml_per_halaman);



    if(isset($_POST['cari'])) {
        $kunci = $_POST['cari'];
        $query = mysqli_query($mysqli,"select * from tabel_pesan
                where subject LIKE '%$kunci%' and  pesan LIKE '%$kunci%'
                and dari='$nm_user'
                and draft='1'
				order by waktu
            ");

    } elseif(isset($_POST['halaman'])) {
        $halaman = $_POST['halaman'];
        $i = ($halaman - 1) * $jml_per_halaman  + 1;
        $query = mysqli_query($mysqli,"select * from tabel_pesan where dari='$nm_user' and draft='1' order by waktu desc LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");

    } else {
        $query = mysqli_query($mysqli,"select * from tabel_pesan where dari='$nm_user' and draft='1' order by waktu desc LIMIT 0, $jml_per_halaman");
        $halaman = 1; //tambahan
    }
    while($data = mysqli_fetch_array($query)) {



    ?>
    <tr>

        <td><?php echo $data['dari'] ?></td>
        <td><?php echo $data['kepada'] ?></td>
		<td><?php echo $data['subject'] ?></td>
        <td><a href="#dialog-inbox" id="<?php echo $data['nomor'] ?>" class="balas" data-toggle="modal"><?php echo $data['pesan'] ?></a></td>
        <td><?php echo relative_format($data['waktu'])?></td>
        <td>
           <?php
            if ($data['sent']==1) {
                echo "Terkirim";
            } else {
                echo "Pending";
            }

            ?>
        </td>

        <td>
            <a href="?id=msg&mod=del&nomor=<?php echo $data['nomor'] ?>" onclick="return confirm('Menghapus Pesan dari <?php echo $data['kepada'] ?>')" name="hapus">
                <i class="ace-icon glyphicon glyphicon-trash"></i>
            </a>
        </td>
    </tr>
    <?php
        $i++;
        }
    ?>
</tbody>
</table>
 </div>
    <div class="clearfix form-actions">
<?php if(!isset($_POST['cari'])) { ?>
<!-- untuk menampilkan menu halaman -->
<div class="pagination">
  <ul>

    <?php

    // tambahan
    // panjang pagig yang akan ditampilkan
    $no_hal_tampil = 5; // lebih besar dari 3

    if ($jml_halaman <= $no_hal_tampil) {
        $no_hal_awal = 1;
        $no_hal_akhir = $jml_halaman;
    } else {
        $val = $no_hal_tampil - 2; //3
        $mod = $halaman % $val; //
        $kelipatan = ceil($halaman/$val);
        $kelipatan2 = floor($halaman/$val);

        if($halaman < $no_hal_tampil) {
            $no_hal_awal = 1;
            $no_hal_akhir = $no_hal_tampil;
        } elseif ($mod == 2) {
            $no_hal_awal = $halaman - 1;
            $no_hal_akhir = $kelipatan * $val + 2;
        } else {
            $no_hal_awal = ($kelipatan2 - 1) * $val + 1;
            $no_hal_akhir = $kelipatan2 * $val + 2;
        }

        if($jml_halaman <= $no_hal_akhir) {
            $no_hal_akhir = $jml_halaman;
        }
    }

    for($i = $no_hal_awal; $i <= $no_hal_akhir; $i++) {
        // tambahan
        // menambahkan class active pada tag li
        $aktif = $i == $halaman ? ' active' : '';
    ?>
	<ul class="pagination">

    <li class="halaman<?php echo $aktif ?>" id="<?php echo $i ?>"><a href="#"><?php echo $i ?></a></li>

    </ul>

    <?php } ?>

  </ul>
</div>
</div>
</div>
<?php } ?>

<?php

?>
<?php
}else{
	session_destroy();
	header('Location:../index.php?status=Silahkan Login');
}
?>