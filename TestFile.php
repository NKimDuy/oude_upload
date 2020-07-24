<?php
	//phpinfo();
	
	
	/*
	if (!$fp) 
	{
		echo 'Mở file không thành công';
	}
	else
	{
		echo 'Mở file thành công';
	}
	*/
	$myfile = @fopen('D:\text.txt','a')or die("can't open file");;
	if(is_resource($myfile)) 
	{
		$content = "\nhai ";
		fwrite($myfile, $content);
		fclose($myfile);
	}
	
	else
	{
		echo "khong the ghi file";
	}
	
	
	
?>