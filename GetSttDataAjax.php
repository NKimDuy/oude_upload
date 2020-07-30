<?php
	require_once("./connectDB.php");
	$con = Connect();
	//$tableName = $_POST['table_name'];
	$sql = "SELECT MAX(stt) FROM test1";
	
	$query = mysqli_query($con, $sql);
	$number = mysqli_num_rows($query);
	$row = null;
	if ($number > 0)
	{
		$row = mysqli_fetch_assoc($query);
	}
	echo json_encode($row);
?>  