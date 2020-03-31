<?php
include 'config/koneksi.php';

//membuat nama file
$file	  =	$database.'_'.date("DdMY").'_'.time().'.sql';

?>


<script>
    function pastikan(text){
        confirm('Apakah Anda yakin akan '+text+'?')
    }
</script>

<div class="container">

    <form action="" method="post" name="postform" enctype="multipart/form-data" >
        <p>
            <em>Aplikasi ini digunakan untuk <strong>backup</strong> dan <strong>restore</strong> semua data yang ada didalam database &quot;<strong><?= $database ?></strong>&quot;.</em>
        </p>
        <div class="asd">
            <label for="backup">Backup database</label>
            <input type="submit" name="backup"  onClick="return pastikan('Backup database')" value="Proses Backup" />
        </div>
        <div class="asd">
            <label for="backup">File Backup Database (*.sql)</label>
            <input type="file" name="datafile" size="30" id="gambar" />
            <input type="submit" onclick="return pastikan('Restore database')" name="restore" value="Restore Database" />
        </div>
    </form>

    <?php

    //Download file backup ============================================
    if(isset($_GET['nama_file']))
    {
        $file = $back_dir.$_GET['nama_file'];

        if (file_exists($file))
        {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: private');
            header('Pragma: private');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;

        }
        else
        {
            echo "file {$_GET['nama_file']} sudah tidak ada.";
        }

    }

    //Backup database =================================================
    if(isset($_POST['backup']))
    {
        backup($file);
        echo 'Backup database telah selesai <a style="cursor:pointer" href="?nama_file='.$file.'" title="Download">Download file database</a>';

        echo "<pre>";
        print_r($return);
        echo "</pre>";
    }
    else
    {
        unset($_POST['backup']);
    }

    //Restore database ================================================
    if(isset($_POST['restore']))
    {
        restore($_FILES['datafile']);

        echo "<pre>";
        print_r($lines);
        echo "</pre>";
    }
    else
    {
        unset($_POST['restore']);
    }

    ?>
</div>

<?php

function restore($file) {
    global $rest_dir;

    $nama_file	= $file['name'];
    $ukrn_file	= $file['size'];
    $tmp_file	= $file['tmp_name'];

    if ($nama_file == "")
    {
        echo "Fatal Error";
    }
    else
    {
        $alamatfile	= $rest_dir.$nama_file;
        $templine	= array();

        if (move_uploaded_file($tmp_file , $alamatfile))
        {

            $templine	= '';
            $lines		= file($alamatfile);

            foreach ($lines as $line)
            {
                if (substr($line, 0, 2) == '--' || $line == '')
                    continue;

                $templine .= $line;

                if (substr(trim($line), -1, 1) == ';')
                {
                    mysql_query($templine) or print('Query gagal \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');

                    $templine = '';
                }
            }
            echo "<center>Berhasil Restore Database, silahkan di cek.</center>";

        }else{
            echo "Proses upload gagal, kode error = " . $file['error'];
        }
    }

}

function backup($nama_file,$tables = '')
{
    global $return, $tables, $back_dir, $database ;

    if($tables == '')
    {
        $tables = array();
        $result = @mysql_list_tables($database);
        while($row = @mysql_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }else{
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }

    $return	= '';

    foreach($tables as $table)
    {
        $result	 = @mysql_query('SELECT * FROM '.$table);
        $num_fields = @mysql_num_fields($result);

        //menyisipkan query drop table untuk nanti hapus table yang lama
        $return	.= "DROP TABLE IF EXISTS ".$table.";";
        $row2	 = @mysql_fetch_row(mysql_query('SHOW CREATE TABLE  '.$table));
        $return	.= "\n\n".$row2[1].";\n\n";

        for ($i = 0; $i < $num_fields; $i++)
        {
            while($row = @mysql_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';

                for($j=0; $j<$num_fields; $j++)
                {
                    $row[$j] = @addslashes($row[$j]);
                    $row[$j] = @ereg_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }

    $nama_file;

    $handle = fopen($back_dir.$nama_file,'w+');
    fwrite($handle, $return);
    fclose($handle);
}
?>
