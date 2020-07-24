<?php
	function Connect()
	{
		$con = mysqli_connect("localhost", "root", "nkDuy1998", "duy");
		if ($con)
		{
			mysqli_set_charset($con, "utf8");
		}
		return $con;
	}
	
	function DisConnect()
	{
		if (Connect())
		{
			mysqli_close(Connect());
		}
	}
?>