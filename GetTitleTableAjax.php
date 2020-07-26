<?php
	require_once("./connectDB.php");
	$con = Connect();
	$tableName = $_GET['table_name'];
	$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $tableName . "' AND TABLE_SCHEMA = 'duy'";
	$data = [];
	$row = null;
	$query = mysqli_query($con, $sql);
	$number = mysqli_num_rows($query);
	if ($number > 0)
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$data[] = $row;
		}
		
		echo json_encode( $data ); 
	}
	else
	{
		echo json_encode("fail");
	}
	
	
?> 