<?php
	require_once("./connectDB.php");
	$con = Connect();
	$tableName = $_POST['table_name'];
	$mssv = $_POST['mssv'];
	$sql = "DELETE FROM " . $tableName . " WHERE mssv = '" . $mssv . "'";
	
	try
	{
		$query = mysqli_query($con, $sql);
		//echo json_encode("success");
	}
	catch(Exception $e)
	{
		echo json_encode($e->getMessage());
	}
	
?>  