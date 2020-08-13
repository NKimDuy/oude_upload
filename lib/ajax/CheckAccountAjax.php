<?php
	require_once ("../../db/connectDB.php");
	require_once ("../../db/Config.php");
	
	require_once ('../htmlpurifier-4.12.0/htmlpurifier-4.12.0/library/HTMLPurifier.auto.php');
	
	$con = Connect();
	
	$user = $_GET["user"];
	/*
	$password = $_POST["password"];
	$passwor2 = $_POST["password2"];
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$permission = $_POST["permission"];
	*/
	
	/*
	$patterm = '/select|from|where|join|SELECT|FROM|WHERE|JOIN|=|\'/';
	$replacement = "";
	$firstname = preg_replace($patterm, $replacement, $firstname);
	$lastname = preg_replace($patterm, $replacement, $lastname);
	$user = preg_replace($patterm, $replacement, $user);
	$password = preg_replace($patterm, $replacement, $password);
	
	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);
	$firstname = $purifier->purify(trim(preg_replace('/\s+/mu', '', $firstname)));
	$lastname = $purifier->purify(trim(preg_replace('/\s+/mu', '', $lastname)));
	$user = $purifier->purify(trim(preg_replace('/\s+/mu', '', $user)));
	$password = $purifier->purify(trim(preg_replace('/\s+/mu', '', $password)));
	*/
	
	$sql = "SELECT * FROM tb_user where user = '" . $user . "'";
	$query = mysqli_query($con, $sql);
	if($query)
	{
		$number = mysqli_num_rows($query);
		if ($number > 0)
		{
			echo json_encode(true);
		}
		else
		{
			echo json_encode(false);
		}
	}
	
?>