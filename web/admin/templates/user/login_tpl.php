<div class="login-view-website text-sm"><a href="../" target="_blank" title="Xem website"><i class="fas fa-reply mr-2"></i>Xem website</a></div>
<div class="login-box">
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Đăng nhập hệ thống</p>
			<form enctype="multipart/form-data">
				<div class="input-group mb-3">
					<div class="input-group-append login-input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
					<input type="text" class="form-control text-sm" name="username" id="username" placeholder="Tài khoản *" autocomplete="off">
				</div>
				<div class="input-group mb-3">
					<div class="input-group-append login-input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
					<input type="password" class="form-control text-sm" name="password" id="password" placeholder="Mật khẩu *" autocomplete="off">
					<div class="input-group-append">
						<div class="input-group-text show-password">
							<span class="fas fa-eye"></span>
						</div>
					</div>
				</div>
				<button type="button" class="btn btn-sm bg-gradient-danger btn-block btn-login text-sm p-2">
					<div class="sk-chase d-none">
						<div class="sk-chase-dot"></div>
						<div class="sk-chase-dot"></div>
						<div class="sk-chase-dot"></div>
						<div class="sk-chase-dot"></div>
						<div class="sk-chase-dot"></div>
						<div class="sk-chase-dot"></div>
					</div>
					<span>Đăng nhập</span>
				</button>
				<div class="alert my-alert alert-login d-none text-center text-sm p-2 mb-0 mt-2" role="alert"></div>
			</form>
		</div>
	</div>
</div>
<div class="login-copyright text-sm">Powered by <a href="//nina.vn" target="_blank" title="Thiết Kế Website Nina">Thiết Kế Website Nina</a></div>

<!-- Login js -->
<script type="text/javascript">
	function login()
	{
		var username = $("#username").val();
		var password = $("#password").val();

		if($(".alert-login").hasClass("alert-danger") || $(".alert-login").hasClass("alert-success"))
		{
			$(".alert-login").removeClass("alert-danger alert-success");
			$(".alert-login").addClass("d-none");
			$(".alert-login").html("");
		}
		if($(".show-password").hasClass("active"))
		{
			$(".show-password").removeClass("active");
			$("#password").attr("type","password");
			$(".show-password").find("span").toggleClass("fas fa-eye fas fa-eye-slash");
		}
		$(".show-password").addClass("disabled");
		$(".btn-login .sk-chase").removeClass("d-none");
		$(".btn-login span").addClass("d-none");
		$(".btn-login").attr("disabled",true);
		$("#username").attr("disabled",true);
		$("#password").attr("disabled",true);

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'ajax/ajax_login.php',
			async: false,
			data: {username:username,password:password},
			success: function(result)
			{
				if(result.success)
				{
					window.location = "index.php";
				}
				else if(result.error)
				{
					$(".alert-login").removeClass("d-none");
					$(".show-password").removeClass("disabled");
					$(".btn-login .sk-chase").addClass("d-none");
					$(".btn-login span").removeClass("d-none");
					$(".btn-login").attr("disabled",false);
					$("#username").attr("disabled",false);
					$("#password").attr("disabled",false);
					$(".alert-login").removeClass("alert-success");
					$(".alert-login").addClass("alert-danger");
					$(".alert-login").html(result.error);
				}
			}
		});
	}
	$(document).ready(function(){
		$("#username, #password").keypress(function(event){
			if(event.keyCode == 13 || event.which == 13) login();
		})
		$(".btn-login").click(function(){
			login();
		})
		$(".show-password").click(function(){
			if($("#password").val())
			{
				if($(this).hasClass("active"))
				{
					$(this).removeClass("active");
					$("#password").attr("type","password");
				}
				else
				{
					$(this).addClass("active");
					$("#password").attr("type","text");
				}
				$(this).find("span").toggleClass("fas fa-eye fas fa-eye-slash");
			}
		})
	})
</script>