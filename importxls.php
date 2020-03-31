<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2' )
{

?>
<div class="col-xs-12 col-sm-12 widget-container-col">
    <div class="widget-box widget-color-dark light-border">
        <div class="widget-header">
            <h5 class="widget-title smaller">Import data pegawai</h5>

            <div class="widget-toolbar">
                <span class="badge badge-danger">Alert</span>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main padding-6">

                <form name="myForm" id="myForm"  class="form-horizontal" onSubmit="return validateForm()" action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-sm-9">
                            <div class="col-xs-5">
                            <input type="file" id="filepegawaiall" name="filepegawaiall" />
                                </div>
                            <input type="submit" class="btn btn-info btn-big btn-next" name="submit" value="Import" />
                            <a href="config/contohformatexcel.xls" class="btn btn-success btn-big btn-next">Download</a>  Contoh format Excel
                        </div>
                    </div>
                </form>

                <?php
                if (isset($_POST['submit'])) {
                    ?>
                    <div id="progress">

                    </div>
                    <div id="info"></div>
                <?php
                }
                ?>

                <script type="text/javascript">
                    //    validasi form (hanya file .xls yang diijinkan)
                    function validateForm()
                    {
                        function hasExtension(inputID, exts) {
                            var fileName = document.getElementById(inputID).value;
                            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
                        }

                        if(!hasExtension('filepegawaiall', ['.xls'])){
                            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
                            return false;
                        }
                    }
                </script>

<?php
require "config/excel_reader.php";


if(isset($_POST['submit'])){

    $target = basename($_FILES['filepegawaiall']['name']) ;
    move_uploaded_file($_FILES['filepegawaiall']['tmp_name'], $target);

    $data = new Spreadsheet_Excel_Reader($_FILES['filepegawaiall']['name'],false);


    $baris = $data->rowcount($sheet_index=0);

    for ($i=2; $i<=$baris; $i++)
    {

        $barisreal = $baris-1;
        $k = $i-1;

        $percent = intval($k/$barisreal * 100)."%";


        $nip            = $data->val($i, 1);
        $nama           = $data->val($i, 2);
        $tempat_lahir   = $data->val($i, 3);
        $tanggal_lahir  = $data->val($i, 4);
        $jenisk         = $data->val($i, 5);
        $alamat         = $data->val($i, 6);
        $tgl_masuk      = $data->val($i, 7);
        $id_bag         = $data->val($i, 8);
        $id_jab         = $data->val($i, 9);
        $tlpn           = $data->val($i, 10);
        $nohp           = $data->val($i, 11);
        $npwp           = $data->val($i, 12);
        $id_agm         = $data->val($i, 13);
        $kdpndidik      = $data->val($i, 14);
        $noktp          = $data->val($i, 15);
        $norek          = $data->val($i, 16);
        $id_bank        = $data->val($i, 17);
        $kdstatusk      = $data->val($i, 18);
        $kdstatusp      = $data->val($i, 19);
        $tgl_jab        = $data->val($i, 20);
        $id_jns         = $data->val($i, 21);
        $kdkpkrn        = $data->val($i, 22);
        $kd_sub         = $data->val($i, 23);
        $id_gol         = $data->val($i, 24);
        $nidn           = $data->val($i, 25);
		$idstatusk      = $data->val($i, 26);
        $tgl_kontrak    = $data->val($i, 26);



        $query = "INSERT into pegawai (nip,nama,tmpt_lahir,tgl_lahir,jenis_kelamin,alamat,tgl_masuk,
        id_bag,id_jab,tlpn,nohp,npwp,id_agm,kdpndidik,noktp,norek,id_bank,kdstatusk,kdstatusp,tgl_jab,
        idjns,nmkepakaran,kd_sub,id_gol,nidn,id_stsk,tgl_kontrak)
        values('$nip','$nama','$tempat_lahir','$tanggal_lahir','$jenisk','$alamat','$tgl_masuk','$id_bag','$id_jab','$tlpn','$nohp','$npwp',
        '$id_agm','$kdpndidik','$noktp','$norek','$id_bank','$kdstatusk','$kdstatusp','$tgl_jab','$id_jns','$kdkpkrn','$kd_sub','$id_gol','$nidn','$idstatusk','$tgl_kontrak')";
        $hasil = mysqli_query($mysqli,$query);
		
		if ($hasil > 0) {
			 echo '<script language="javascript">
        document.getElementById("progress").innerHTML="<div class=\'progress progress-mini progress-striped active\'><div class=\'progress-bar progress-bar-success\' style=\'width:'.$percent.'; \'>&nbsp;</div></div>";
        document.getElementById("info").innerHTML="<div class=\'alert alert-info\'>'.$k.' data berhasil diinsert ('.$percent.' selesai).</div>";
        </script>';

		} else {
		echo '<script language="javascript">
        document.getElementById("info").innerHTML="<div class=\'alert alert-warning\'>'.$k.' data gagal di import('.$percent.' selesai).</div>";
        </script>';
		}

        flush();



    }

    unlink($_FILES['filepegawaiall']['name']);
}
?>
</div>
        </div>
    </div>
</div>


<?php
}else{
    header('Location:index.php?status=Silahkan Login');
}
?>