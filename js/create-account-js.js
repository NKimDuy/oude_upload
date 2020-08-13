$(document).ready(function() {
	
	$("#create-account").click(function(e) {
		// e.target.id : lấy id của dom element đang được thao tác
		e.preventDefault(); // ngăn chặn sự kiện mặc định 
		
		var regularExpression = /select|from|where|join|SELECT|FROM|WHERE|JOIN/;
		
		var user = $("#user").val(),
			password = $("#password").val(),
			passwordConfirm = $("#passwordConfirm").val(),
			firstname = $("#firstname").val(),
			lastname = $("#lastname").val(),
			permission = $("input[name='permission']:checked").val();
	
		if (firstname == "") {
			var interval_obj = setTimeout(function(){
			$("#firstname").css('border', '3px solid red');
			}, 20);
			$('#firstname').fadeOut(1000,function(){
				$(this).css('border', '1px solid #ced4da');
			});
			$('#firstname').fadeIn();
			//alert("chưa nhập họ!!!");
			return false;
		}
		else if(lastname == "") {
			var interval_obj = setTimeout(function(){
			$("#lastname").css('border', '3px solid red');
			}, 20);
			$('#lastname').fadeOut(1000,function(){
				$(this).css('border', '1px solid #ced4da');
			});
			$('#lastname').fadeIn();
			//alert("chưa nhập tên!!!");
			return false;
		}
		else if(user == "") {
			var interval_obj = setTimeout(function(){
			$("#user").css('border', '3px solid red');
			}, 20);
			$('#user').fadeOut(1000,function(){
				$(this).css('border', '1px solid #ced4da');
			});
			$('#user').fadeIn();
			//alert("chưa nhập tài khoản!!!");
			return false;
		}
		else if(password == "") {
			var interval_obj = setTimeout(function(){
			$("#password").css('border', '3px solid red');
			}, 20);
			$('#password').fadeOut(1000,function(){
				$(this).css('border', '1px solid #ced4da');
			});
			$('#password').fadeIn();
			//alert("chưa nhập mật khẩu!!!");
			return false;
		}
		else if(passwordConfirm == "") {
			var interval_obj = setTimeout(function(){
			$("#passwordConfirm").css('border', '3px solid red');
			}, 20);
			$('#passwordConfirm').fadeOut(1000,function(){
				$(this).css('border', '1px solid #ced4da');
			});
			$('#passwordConfirm').fadeIn();
			//alert("chưa nhập mật khẩu!!!");
			return false;
		}
		else if(permission == null) {
			$("#check-permission").append("<span id = 'incorrect' style = 'color:red;'>Chưa cấp quyền !!!</span>");
			var interval_obj = setTimeout(function(){
				$("#incorrect").remove();
			}, 1000);
			//alert("chưa cấp quyền!!!");
			return false;
		}
		else if(password != passwordConfirm) {
			//alert("Mật khẩu nhập lại không đúng!!!");
			$("#check-account").append("<span id = 'incorrect' style = 'color:red;'>Mật khẩu không trùng khớp !!!</span>");
			var interval_obj = setTimeout(function(){
				$("#incorrect").remove();
			}, 1000);
			return false;
		}
		else if ((regularExpression.test(user))) {
			$("#reg").append("<span id = 'incorrect' style = 'color:red;'>không được chứa các key word !!!</span>");
			var interval_obj = setTimeout(function(){
				$("#incorrect").remove();
			}, 1000);
			return false;
		}
		else {
			
			$.get({
				url: "lib/ajax/CheckAccountAjax.php",
				data: {
					'user': user,
				},
				dataType: "json",
				error: function(result){
					alert('có lỗi xảy ra khi xử lý với ajax');
				},
				success: function(result) {
					if (result == true)
						alert("Đã tồn tại tài khoản");
					else {
						$.get({
							url: "lib/ajax/CreateAccountAjax.php",
							data: {
								'user': user,
								'password': password,
								'passwordConfirm': passwordConfirm,
								'firstname': firstname,
								'lastname': lastname,
								'permission': permission
							},
							dataType: "json",
							success: function(result) {
								if (result == true)
									alert("Đã tạo tài khoản thành công");
								else
									alert("Có lỗi xảy ra khi tạo tài khoản");
							}
						});
					}
				}
			});
		}
		
	});
});