<?php
// memanggil berkas koneksi.php


error_reporting(0);

$nip			= isset($_SESSION['nip']) ? $_SESSION['nip'] : NULL;
$nm_user		= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL && !empty($sesi_username) && $_SESSION['leveluser']<='7')
{






?>
<!-- PAGE CONTENT BEGINS -->


    <div class="row">
        <div class="col-sm-12">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#inbox">
                            <i class="green ace-icon fa fa-envelope-o bigger-120"></i>
                            Inbox
                            <?php

                            $count=mysqli_query($mysqli,"select count(kepada)as jum from tabel_pesan where kepada='$nm_user' and sudahbaca='N'");
                            while($row4=mysqli_fetch_array($count)) {
                                echo "<span class='badge badge-info'> " . $row4['jum'] . "</span>";
                            }
                            ?>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#sent">
                            <i class="green ace-icon fa fa-location-arrow bigger-120"></i>
                            Sent

                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#draft">
                            <i class="green ace-icon fa fa-pencil bigger-120"></i>
                            Draf

                        </a>
                    </li>


                </ul>

                <?php
                $nomor  	= isset($_POST['nomor']) ? $_POST['nomor'] : NULL;
                $username  	= isset($_POST['username']) ? $_POST['username'] : NULL;
                $subject	= isset($_POST['subject']) ? $_POST['subject'] : NULL;
                $pesan 	    = isset($_POST['pesan']) ? $_POST['pesan'] : NULL;
                $blspesan	= isset($_POST['blspesan']) ? $_POST['blspesan'] : NULL;
                $kirim      = isset($_POST['kirim']) ? $_POST['kirim'] : NULL;
                $simpan     = isset($_POST['simpan']) ? $_POST['simpan'] : NULL;
                $balas      = isset($_POST['balas']) ? $_POST['balas'] : NULL;
                $nomor2	    = isset($_GET['nomor']) ? $_GET['nomor'] : NULL;
                $mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;




                if($kirim) {
                    $cek_username=mysqli_num_rows(mysqli_query($mysqli,"SELECT username FROM tbl_user WHERE username='$username'"));
                    if ($cek_username == 0) {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Username atas nama $username belum melakukan REGISTRASI / anda belum memasukan username <br/></div>";
                    } else {
                        $q_pesankirim = mysqli_query($mysqli, "INSERT INTO tabel_pesan VALUES ('',NOW(),'$nm_user','$username','$subject','$pesan','N','1','')");
                        if ($q_pesankirim) {
                            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Pesan Berhasil Terkirim<br/></div>";
                        } else {
                            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                        }
                    }
                } elseif ($simpan) {
                    $q_pesansimpan	= mysqli_query($mysqli,"INSERT INTO tabel_pesan VALUES ('',NOW(),'$nm_user','$username','$subject','$pesan','N','0','1')");
                    if ($q_pesansimpan) {
                        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Pesan Berhasil disimpan<br/></div>";
                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
                    }
                } elseif ($balas) {
					 $cek_username=mysqli_num_rows(mysqli_query($mysqli,"SELECT username FROM tbl_user WHERE username='$username'"));
                    if ($cek_username == 0) {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Username atas nama $username belum melakukan REGISTRASI / anda belum memasukan username <br/></div>";
                    } else {
						  $q_pesanbalas	= mysqli_query($mysqli,"INSERT INTO tabel_pesan VALUES ('',NOW(),'$nm_user','$username','$subject','$blspesan','N','1','')");
                    if ($q_pesanbalas) {
                        mysqli_query($mysqli,"Update tabel_pesan set sudahbaca='Y' where nomor=$nomor");
                        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Pesan Berhasil Terkirim<br/></div>";
                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
                    }
					}
                  
                } elseif ($mod == "del") {
                    $q_delete_pesan = mysqli_query($mysqli,"DELETE FROM tabel_pesan WHERE nomor = '$nomor2'");
                    if ($q_delete_pesan) {
                        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong>  Menghapus Pesan<br/></div>";
                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
                    }
                }


                ?>

                <div class="tab-content profile-edit-tab-content">
                    <div id="inbox" class="tab-pane fade in active">
                        <div class="input-prepend pull-center">
                            <span class="add-on"><i class="icon-search"></i></span>
                            <input class="span8" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian..">

                            <thead>
                            <a  href="#dialog-inbox" id="0" class="pesanbaru btn btn-app btn-purple btn-xs" data-toggle="modal" >
                                <i class="ace-icon fa fa-pencil-square-o bigger-100"></i>
                                Tulis
                                <span class="badge badge-warning badge-right"></span>
                            </a>

                            <a href="#" class="btn btn-app btn-light btn-xs">
                                <i class="ace-icon fa fa-print bigger-100"></i>
                                Print
                            </a>

                            <a href="?id=msg" class="btn btn-app btn-success btn-xs">
                                <i class="ace-icon fa fa-refresh bigger-100"></i>
                                Refresh
                            </a>
                        </div>
                        <div id="data-inbox"></div>
                    </div>

                    <div id="sent" class="tab-pane fade">
                       <span class="input-icon"></span>
								<input type="text" placeholder="Pencarian..." class="nav-search-input" name="carisent" id="nav-search-input" autocomplete="off" />

						<thead>
                        <a href="?id=msg" class="btn btn-app btn-success btn-xs">
                            <i class="ace-icon fa fa-refresh bigger-100"></i>
                            Refresh
                        </a>
						</thead>
                        <div id="sent-inbox"></div>
                    </div>

                    <div id="draft" class="tab-pane fade">
                        <span class="add-on"><i class="icon-search"></i></span>
                        <input class="span8" id="prependedInput" type="text" name="caridraft" placeholder="Pencarian..">
                        <thead>
                        <a href="?id=msg" class="btn btn-app btn-success btn-xs">
                            <i class="ace-icon fa fa-refresh bigger-100"></i>
                            Refresh
                        </a>
                        </thead>
                        <div id="draft-inbox"></div>
                    </div>

                </div>
            </div>
        </div><!-- /.col -->

        <div id="dialog-inbox" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header no-padding">
                        <div class="table-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <span class="white">&times;</span>
                            </button>
                            <i id="myModalLabel">Pesan Baru </i>
                        </div>
                    </div>


                    <div class="modal-body">
                        <div class="modal-content">
                        </div>
                    </div>


                </div>
            </div>
        </div>



    </div><!-- /.row -->
<!-- PAGE CONTENT ENDS -->
<?php
}else{
    echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>