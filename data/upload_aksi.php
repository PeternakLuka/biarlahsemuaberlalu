<?php 
	include '../include/koneksi.php';
	include "../include/excel_reader2.php";
	
	$target = basename($_FILES['filee']['name']) ;
	move_uploaded_file($_FILES['filee']['tmp_name'], $target);

	chmod($_FILES['filee']['name'],0777);

	$data = new Spreadsheet_Excel_Reader($_FILES['filee']['name'],false);

	$jumlah_baris = $data->rowcount($sheet_index=0);

	$kd_data = 1;
	for ($i=2; $i<=$jumlah_baris; $i++){

		$ktkb     		= $data->val($i, 1);
		$konfirmasi     = $data->val($i, 2);
		$sembuh   		= $data->val($i, 3);
		$suspek1  		= $data->val($i, 4);
		$suspek2  		= $data->val($i, 5);
		$suspek3  		= $data->val($i, 6);
		$meninggal   	= $data->val($i, 7);
		$suspek			= $suspek1+$suspek2+$suspek3;

		if($ktkb != ""){
			mysqli_query($conn, "UPDATE tb_data SET ktkb='$ktkb', konfirmasi='$konfirmasi', sembuh='$sembuh', suspek='$suspek', meninggal='$meninggal' WHERE kd_data=$kd_data");
			$kd_data++;
		}
	}
	header("location:../index.php");
?>