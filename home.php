<?php
	/*
	session_start();
	$flag = "";
	$flag_create_user = "";
	$flag_delete_user = "";
	$flag_create_table = "";
	$information_user ="";
	if (isset($_SESSION['user_account']) and isset($_SESSION['password_account']) and isset($_SESSION['group_user']))
	{
		$flag = $_SESSION['group_user'];
		if ($flag == "watch")
		{
			$flag_create_user = "none";
			$flag_delete_user = "none";
			$flag_create_table = "none";
		}
		if ($flag == "create")
		{
			$flag_create_user = "none";
			$flag_delete_user = "none";
		}
		$information_user = $_SESSION['user_account'];
		if (isset($_POST['tao-user']))
		{
			if ($_SESSION['group_user'] == "admin")
			{
				header('Location: create_account.php');
			}
		}
		if (isset($_POST['xoa-user']))
		{
			if ($_SESSION['group_user'] == "admin")
			{
				header('Location: delete_account.php');
			}
		}
		if (isset($_POST['sua']))
		{
			if ($_SESSION['group_user'] == "admin" or $_SESSION['group_user'] == "create")
			{
				header('Location: d.php');
			}
		}
		if (isset($_POST['xem']))
		{
			header('Location: seeTable.php');
		}
		if (isset($_POST['logout']))
		{
			unset($_SESSION['user_account']);
			unset($_SESSION['password_account']);
			unset($_SESSION['group_user']);
			unset($_SESSION['data']);
			unset($_SESSION['data_title']);
			header('Location: login.php');
		}
				
	}
	else
	{
		header('Location: login.php');
	}
	*/
?>
<html lang="en">
<head>

	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- khi vừa gắn bootstrap và vừa dùng jquery tab , thì thẻ script này gắn vô sẽ bị xung đột
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	-->
	
	
</head>
<body>
	<div class="container-fluid">
		<div id="dialog" style="display:none;">
			<ul id="tableList"></ul>
		</div>
		<div class="row">
			<button id="btnCreateUser">Tạo tài khoản mới</button>
			<button id="btnTableList">Các bảng hiện có</button>
			<button id="btnAddTable">Thêm một bảng mới từ excel</button>
			<button id="btnTableList">Thêm, sửa, xóa các dòng của bảng</button>
		</div>
	</div>
</body>
<script>
	function deleteTable(table) {
		$.post({
			url: "lib/ajax/DeleteTableAjax.php",
			data: {
				'table_name': table
			},
			dataType: "json",
			success: function(res) {
				alert("Đã xóa thành công " + res);
				$("#" + res).remove();
			}
		});
	}
	
	$(document).ready(function() {
		$("#btnTableList").click(() => {
			$.get({
				url: "lib/ajax/GetAllTableAjax.php",
				dataType: "json",
				success: function(result){
					var li = "";
					result.forEach(item => {
						li += "<li id=" + item.TABLE_NAME + ">" + item.TABLE_NAME + "  <a class='btn btn-primary' href=javascript:deleteTable('" + item.TABLE_NAME + "');>Delete</a>" +"</li>";						
					});
					$("#tableList").html(li);
					$("#dialog").dialog({
						width: 'auto',
						maxWidth: 1000,
						fluid: true,
						my: "center",
						at: "center",
						of: window,
						modal: true, // không cho phép thao tác các vị trí khác khi dialog xuất hiện
						buttons: {
							OK: function() { // hủy thông tin hiển thị của sinh viên cũ
								$( this ).dialog( "destroy" );
							}
						},
						close: function() { // hủy thông tin hiển thị của sinh viên cũ
							$( this ).dialog( "destroy" );
						} 
					});
				}
			});
		});
	});
</script>
</html>