<?php
	require_once("./connectDB.php");
	$con = Connect();
	$tableName = $_POST['table_name'];
	$data = $_POST['row'];
	
	$column = [];
	$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $tableName . "' AND TABLE_SCHEMA = 'duy'";
	$query = mysqli_query($con, $sql);
	$number = mysqli_num_rows($query);
	if ($number > 0)
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$column[] = $row;
		}
		$sql = "UPDATE " . $tableName . " SET ";
		
		
		for ($i = 0 ; $i < count($column) ; $i++)
		{
			//$sql .= $column[$i]['COLUMN_NAME'] . " = '" . $data[$i] . "', ";
			$sql .= $data['id'] ;
		}
		//$sql = rtrim($sql, ", ");
		//$sql.= " WHERE id = '" . $data[0];
	
		echo json_encode($sql);
		try
		{
			//$query = mysqli_query($con, $sql);
			//echo json_encode($sql);
		}
		catch(Exception $e)
		{
			echo json_encode($e->getMessage());
		}
		
	}
	
	
	/*
	$sql = "UPDATE " . $tableName . " SET";
	
	for ($i = 0 ; $i < count($data) ; $i++)
	{
		$sql.= "'" . $data[$i] . "', ";
	}
	$sql = rtrim($sql, ", ");
	$sql.= ")";
	
	
	try
	{
		$query = mysqli_query($con, $sql);
		//echo json_encode("success");
	}
	catch(Exception $e)
	{
		echo json_encode($e->getMessage());
	}
	*/
?>   