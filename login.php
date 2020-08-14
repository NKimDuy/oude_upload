<?php
	session_start();
	require_once("db/Config.php");
	if (isset($_SESSION['user']) and isset($_SESSION['success']) and isset($_SESSION['permission']))
	{
		header("Location:" . $conf["root"]);
	}
	else
	{
		require_once("db/connectDB.php");
		require_once ("db/Config.php");
		require_once ('./lib/htmlpurifier-4.12.0/htmlpurifier-4.12.0/library/HTMLPurifier.auto.php');
		$correct = true; // kiểm tra nếu thông tin tài khoản không đúng
		if (isset($_POST['login']))
		{
			$con = Connect();
			
			$username = isset($_POST['User']) ? $_POST['User'] : "";
			$password = isset($_POST['Password']) ? $_POST['Password'] : "";
			
			//********************************************************\\
			$patterm = '/select|from|where|join|SELECT|FROM|WHERE|JOIN|=|\'/';
			$replacement = "";
			$username = preg_replace($patterm, $replacement, $username);
			$password = preg_replace($patterm, $replacement, $password);
			
			$config = HTMLPurifier_Config::createDefault();
			$purifier = new HTMLPurifier($config);
			$username = $purifier->purify(trim(preg_replace('/\s+/mu', ' ', $username)));
			$password = $purifier->purify(trim(preg_replace('/\s+/mu', ' ', $password)));
			//********************************************************\\
			
			$sql = "SELECT user, password, password_backup, permission FROM tb_user WHERE user = '" . $username . "'";
			$query = mysqli_query($con, $sql);
			if ($query)
			{
				$number = mysqli_num_rows($query);
				if ($number > 0)
				{
					$row = mysqli_fetch_assoc($query);
					if (hash_equals($row['password'], crypt($password, $row['password'])) or hash_equals($row['password_backup'], crypt($password, $row['password_backup'])))
					{
						$_SESSION['user'] = $row['user'];
						$_SESSION["success"] = "success " . $row['user'];
						$_SESSION['permission'] = $row['permission'] . " " . $row['user']; // để phân biệt các người dùng với nhau
						header("Location:" . $conf["root"]);
					}
					else
					{
						$correct = false;
					}
				}
				else
				{
					$correct = false;
				}
				
			}
		}
	
?>
<html lang="en">
<head>

	<title>login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<style>
		.row {
			height: 810px;
		}
	</style>

	
	
	<link rel="stylesheet" href="css/login.css" />
	
	
</head>
<body>
	<div class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">ĐĂNG NHẬP</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
			<div class="login-form">
				<form method="post">
					<div class="sign-in-htm">
						<div class="group">
							<label for="user" class="label">Username</label>
							<input id="User" name = "User" type="text" class="input">
						</div>
						<div class="group">
							<label for="pass" class="label">Password</label>
							<input id="Password" name = "Password" type="password" class="input" data-type="password">
						</div>
						<!--
						<div class="group">
							<input id="check" type="checkbox" class="check" checked>
							<label for="check"><span class="icon"></span> Keep me Signed in</label>
						</div>
						-->
						<div class="group">
							<input type="submit" class="button" value="ĐĂNG NHẬP" id = "login" name = "login">
							
						</div>
						<div class="hr"></div>
						<!--
						<div class="foot-lnk">
							<a href="#forgot">Forgot Password?</a>
						</div>
						-->
					</div>
				</form>
				<!--
				<div class="sign-up-htm">
					<div class="group">
						<label for="user" class="label">Username</label>
						<input id="user" type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input id="pass" type="password" class="input" data-type="password">
					</div>
					<div class="group">
						<label for="pass" class="label">Repeat Password</label>
						<input id="pass" type="password" class="input" data-type="password">
					</div>
					<div class="group">
						<label for="pass" class="label">Email Address</label>
						<input id="pass" type="text" class="input">
					</div>
					<div class="group">
						<input type="submit" class="button" value="Sign Up">
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<label for="tab-1">Already Member?</a>
					</div>
				</div>
				-->
			</div>
		</div>
	</div>
	
	
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script language = "javascript">
		$(document).ready(function() {
			
			$("#validate-form").submit(function() {
				if ($("#User").val() == "" || $("#Password").val() == "" ) {
					alert("Bạn chưa nhập tài khoản hay mật khẩu");
					return false;
				}
			});
			var correct = "<?php echo $correct; ?>";
			if (correct == false) {
				alert("Tài khoản hoặc mật khẩu không đúng!!");
			}
			
			
		});
	</script>
</body>
</html>
<?php } ?>