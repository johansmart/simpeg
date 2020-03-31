<?php
session_start();
$sesi_username          = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL && !empty($sesi_username) && $_SESSION['leveluser']=='1')

{
    include "config/koneksi.php";
    $id_user	= isset($_POST['id_user']) ? $_POST['id_user'] : NULL;
    $username	= isset($_POST['username']) ? $_POST['username'] : NULL;
    $email	    = isset($_POST['email']) ? $_POST['email'] : NULL;
    $level_user = isset($_POST['no_lv']) ? $_POST['no_lv'] : NULL;
    $idp        = isset($_POST['idp']) ? $_POST['idp'] : NULL;
    $password   = isset($_POST['password']) ? $_POST['password'] : NULL;
    $passhash   = password_hash($password , PASSWORD_DEFAULT);

    if(isset($_POST['bloked'])) {
        mysqli_query($mysqli,"update tbl_user set kd_approve='2' where id_user=".$_POST['bloked']);
    }

    if(isset($_POST['appro'])) {
       mysqli_query($mysqli, "update tbl_user set kd_approve='1' where id_user=" . $_POST['appro']);
      }

     if(isset($_POST['hapus2'])) {
         mysqli_query($mysqli, "DELETE FROM tbl_user WHERE id_user=" . $_POST['hapus2']);

     }


    $ceknip=mysqli_query($mysqli,"SELECT nip,id_jab from pegawai where id='$idp'");
    $rowceknip=mysqli_fetch_array($ceknip);
    $nippegawai=$rowceknip['nip'];
    $id_jab=$rowceknip['id_jab'];

     if($id_user == 0) {
         mysqli_query($mysqli,"INSERT INTO tbl_user (username,pass,level_user,email,id,nip,id_jab,status,kd_approve,photo) VALUES('$username','$passhash','$level_user','$email','$idp','$nippegawai','$id_jab','1','1','examples/logo.jpg')");

        } else {
      
   
         if ($password !=="") {
             mysqli_query($mysqli, "UPDATE tbl_user SET
			            username = '$username',
			            level_user = '$level_user',
			            email = '$email',
			            pass  = '$passhash',
			            nip   = '$nippegawai',
                        id    = '$idp',
                        id_jab= '$id_jab'
			            WHERE id_user= '$id_user'
			            ");
             mysqli_query($mysqli, "UPDATE pegawai SET level_user = '$level_user'");

         } else {
             mysqli_query($mysqli, "UPDATE tbl_user SET
			            username = '$username',
			            level_user = '$level_user',
			            email = '$email',
			            nip   = '$nippegawai',
                        id    = '$idp',
                        id_jab= '$id_jab'
			            WHERE id_user= '$id_user'
			            ");
             mysqli_query($mysqli, "UPDATE pegawai SET level_user = '$level_user'");
         }

     }
    ?>
<?php
}else{
    session_destroy();
    header('Location:index.php?status=Silahkan Login');
}
?>