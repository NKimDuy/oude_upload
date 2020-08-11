<?php
	require_once ("../../db/connectDB.php");
	require_once ("../../db/Config.php");
	$con = Connect();
	$user = $_POST["user"];
	$sql = "SELECT user FROM tb_user where user = '" . $user . "'";
	$query = mysqli_query($con, $sql);
	if($query)
	{
		
		$number = mysqli_num_rows($query);
		if ($number > 0)
		{
			echo json_encode(true);
		}
		else
			echo json_encode(false);
		
	}
?>