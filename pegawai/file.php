<?
$id_kel	        = isset($_GET['idkel']) ? $_GET['idkel'] : NULL;
$mod        = isset($_GET['mod']) ? $_GET['mod'] : NULL;
if ($mod =="del") {
$q_delete_kel = mysqli_query($mysqli,"DELETE FROM keluarga WHERE id_k='$id_kel'");
if ($q_delete_kel) {
echo "<script>window.location ='media.php?id=tambahpeg&mod=edit&id_n='$id_daftar''</script>";
} else {
echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
}
}
