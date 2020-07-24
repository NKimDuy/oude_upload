<?php
	require_once("./connectDB.php");
	$con = Connect();
	$sql = " SELECT * FROM INFORMATION_SCHEMA.TABLES 
	WHERE TABLE_SCHEMA = 'duy' AND TABLE_NAME = 'test1' ";
	try 
	{
		$query = mysqli_query($con, $sql);
		$number = mysqli_num_rows($query);
		echo $number;
	}
	
	catch(Exception $e)
	{
		echo $e -> getMessage();
	}
	
?>