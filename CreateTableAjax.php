<?php
	require_once("./connectDB.php");
	$con = Connect();
	$tableName = $_POST["table_name"];
	$data_title = $_POST["title"];
	$data = $_POST["data"];
	
	
	
	
	$notification = "";
	
	/*-------------kiểm tra table đã tồn tại vs tạo table ------------------*/
	
	$checkTable = " SELECT * FROM INFORMATION_SCHEMA.TABLES 
	WHERE TABLE_SCHEMA = 'duy' AND TABLE_NAME = '" . $tableName . "'";
	$query = mysqli_query($con, $checkTable);
	$number = mysqli_num_rows($query);
	
	if ($number <= 0)
	{
		//NVARCHAR(500)
		$sql = " CREATE TABLE " . $tableName . "(";
		for ($i = 0 ; $i < count($data_title) ; $i++)
		{
			$sql .= $data_title[$i] . " TEXT, ";
		}
		$sql = rtrim($sql, ", ");
		$sql.= ") ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_unicode_ci;";
		if (mysqli_query($con, $sql))
		{
			$notification = "tạo bảng thành công";
		}
		else
		{
			
			$notification = "tạo bảng thất bại";
		}
	}
	
	/*--------------------------------------------*/
	
	/*----------- thêm các dòng vào bảng ------------*/
	
	$sql_insert = "INSERT INTO " . $tableName . "(";
	for ($i = 0 ; $i < count($data_title) ; $i++)
	{
		$sql_insert .= $data_title[$i]. ", ";
	}
	$sql_insert = rtrim($sql_insert, ", ");
	$sql_insert.= ") VALUES(";
	for ($i = 0 ; $i < count($data) ; $i++)
	{
		$sql_insert.= "'" . $data[$i] . "', ";
	}
	$sql_insert = rtrim($sql_insert, ", ");
	$sql_insert.= ")";
	
	try
	{
		$query = mysqli_query($con, $sql_insert);
	}
	catch(Exception $e)
	{
		echo json_encode($e->getMessage());
	}
	
	/*-----------------------------------------------*/
	
	
	
	
	
?>