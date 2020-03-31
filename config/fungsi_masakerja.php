<?php
function MasaKerja($tgl_masuk,$tahun_sekarang,$bulan_sekarang,$tanggal_sekarang){
if($tgl_masuk=='0000-00-00'){
	return 0;
}else{
	$date1 = $tgl_masuk;
	$date2 = $tahun_sekarang.'-'.$bulan_sekarang.'-'.$tanggal_sekarang;

	$ts1 = strtotime($date1);
	$ts2 = strtotime($date2);

	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);

	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);

	$day1 = date('d', $ts1);
	$day2 = date('d', $ts2);

	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

	$tahun=round($diff/12);
	if(!is_integer($diff/12)){
		$tahun=$tahun-1;
	}
	if($tahun < 10){
		$tahun='0'.$tahun;
	}
	$sisabulan=$diff % 12;

	if($sisabulan < 10){
		$sisabulan=$sisabulan. ' Bulan ';
	}
	$data['jumlah_bulan']=$diff;
	

	$d1 = new DateTime($date1);
	$d2 = new DateTime($date2);

	$diff = $d2->diff($d1);

	$data['masa_kerja']=$diff->y.' Tahun '.$sisabulan;
	return $data;
	}
}


function MasaKerjaBulan($tgl_masuk,$tahun_sekarang,$bulan_sekarang,$tanggal_sekarang){
if($tgl_masuk=='0000-00-00'){
	return 0;
}else{
	$date1 = $tgl_masuk;
	$date2 = $tahun_sekarang.'-'.$bulan_sekarang.'-'.$tanggal_sekarang;

	$ts1 = strtotime($date1);
	$ts2 = strtotime($date2);

	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);

	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);

	$day1 = date('d', $ts1);
	$day2 = date('d', $ts2);

	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);


	$sisabulan=$diff % 12;


	
	return $sisabulan;
	}
}


function MasaKerjaTahun($tgl_masuk,$tahun_sekarang,$bulan_sekarang,$tanggal_sekarang){
if($tgl_masuk=='0000-00-00'){
	return 0;
}else{
	$date1 = $tgl_masuk;
	$date2 = $tahun_sekarang.'-'.$bulan_sekarang.'-'.$tanggal_sekarang;

	$ts1 = strtotime($date1);
	$ts2 = strtotime($date2);

	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);

	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);

	$day1 = date('d', $ts1);
	$day2 = date('d', $ts2);

	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

	$tahun=round($diff/12);
	if(!is_integer($diff/12)){
		$tahun=$tahun-1;
	}
	if($tahun < 10){
		$tahun='0'.$tahun;
	}
	
	$d1 = new DateTime($date1);
	$d2 = new DateTime($date2);

	$diff = $d2->diff($d1);
	
	return $diff->y;
	}
}


$tahunM=date("Y");
$bulanM=date("m");
$tanggalM=date("d");

//cara menggunakannya:
// $masakerja=MasaKerja('2017-04-05',$tahun,$bulan,$tanggal);

// $masakerjabulan=MasaKerjaBulan('2017-04-05',$tahun,$bulan,$tanggal);

// $masakertahun=MasaKerjaTahun('2016-04-05',$tahunM,$bulanM,$tanggalM);
// //$row['tgl_masuk'] adalah tanggal masuk atau TMT pegawai

// // //untuk menampilkannya gunakan ini:
// // echo $masakerja['masa_kerja'];
// // echo"<br>";
// // echo $masakerjabulan;
// // echo"<br>";
// echo $masakertahun;
?>