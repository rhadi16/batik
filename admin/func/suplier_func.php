<?php 

	include '../config/connect.php';

	$action  = $_GET['action'];

	if ($action == "insert") {
		
		$nama_suplier	= $_POST['nama_suplier'];
		$no_suplier		= $_POST['no_suplier'];
		$alamat_suplier	= $_POST['alamat_suplier'];

		$result = mysqli_query($mysqli, "INSERT INTO suplier (id_suplier, nama_suplier, no_suplier, alamat_suplier) 
										 VALUES(null, '$nama_suplier', '$no_suplier', '$alamat_suplier')") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-in-sup" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-in-sup" </script>';
		}
		
	} elseif($action == "update") {

		$id_suplier 	= $_POST['id_suplier'];
		$nama_suplier	= $_POST['nama_suplier'];
		$no_suplier		= $_POST['no_suplier'];
		$alamat_suplier	= $_POST['alamat_suplier'];

		$result = mysqli_query($mysqli, "UPDATE suplier
			  									SET 
			  									   nama_suplier 	= '$nama_suplier',
			  									   no_suplier 		= '$no_suplier',
			  									   alamat_suplier	= '$alamat_suplier'
			  									   WHERE id_suplier = '$id_suplier'
			  									") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-ed-sup" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-ed-sup" </script>';
		}

	} elseif($action == "delete") {

		$id_suplier = $_GET['id_suplier'];

		$result = mysqli_query($mysqli, "DELETE FROM suplier WHERE id_suplier = '$id_suplier'") or die(mysqli_error($mysqli));

		if ($result) {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=suc-del-sup" </script>';
		} else {
			echo '<script language="javascript"> window.location.href = "../index.php?desc=fal-del-sup" </script>';
		}

	}

?>