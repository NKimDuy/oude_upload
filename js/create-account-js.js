$(document).ready(function() {
	
	$("#create-account").click(function() {
	//$("#validate-form").submit(function() {
		var user = $("#user").val(),
			password = $("#password").val(),
			password2 = $("#password2").val(),
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
		else if(password2 == "") {
			var interval_obj = setTimeout(function(){
			$("#password2").css('border', '3px solid red');
			}, 20);
			$('#password2').fadeOut(1000,function(){
				$(this).css('border', '1px solid #ced4da');
			});
			$('#password2').fadeIn();
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
		else if(password != password2) {
			//alert("Mật khẩu nhập lại không đúng!!!");
			$("#check-account").append("<span id = 'incorrect' style = 'color:red;'>Mật khẩu không trùng khớp !!!</span>");
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
					alert('abc');
				},
				success: function(result) {
					alert(result);
				}
			});
			
			
		}
	});
});