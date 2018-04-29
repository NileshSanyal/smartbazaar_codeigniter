<?php $CI =& get_instance(); $admin_assets = $CI->config->item('admin_assets');
?>
<!DOCTYPE html>
<html lang="zxx">
	<head>
		<title>Smartbazaar Admin Panel | Sign Up</title>
		<!-- custom-theme -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Esteem Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- //custom-theme -->
		<link href="<?php echo $admin_assets; ?>css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<!-- <link href="<?php echo $admin_assets; ?>css/snow.css" rel="stylesheet" type="text/css" media="all" />
		--><link href="<?php echo $admin_assets; ?>css/component.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?php echo $admin_assets; ?>css/style_grid.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?php echo $admin_assets; ?>css/style.css" rel="stylesheet" type="text/css" media="all" />
		<!-- font-awesome-icons -->
		<link href="<?php echo $admin_assets; ?>css/font-awesome.css" rel="stylesheet">
		<!-- //font-awesome-icons -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
	</head>
	<body>
		<!-- /pages_agile_info_w3l -->
		<div class="pages_agile_info_w3l">
			<!-- /login -->
			<div class="over_lay_agile_pages_w3ls two">
				<div class="registration">
					
					<!-- registration form -->
					<div class="signin-form profile" id="signupform">
						<h2>Sign up Form</h2>
						<div class="alert alert-danger" id="verror" style="display:none;">
							Errors will be here
						</div>
						<div class="login-form">
							<form action="" method="post" name="adminsignup" id="adminsignup">
								<input type="text" name="fname" id="fname" placeholder="Full Name">
								<input type="text" name="uemail" id="uemail" placeholder="E-mail">
								<input type="password" name="upassword" id="upassword" placeholder="Password">
								
								<div class="tp">
									<!-- <input type="submit" name="submitbtn" id="submitbtn" value="SIGN Up"> -->
									<button type="button" name="submitbtn" id="submitbtn">SIGN Up</button>
								</div>
							</form>
						</div>
						
						<p><a href="#"> By clicking Sign Up, I agree to your terms</a></p>
						
						<h6><a id="loginfrm" href="javascript:void(0);">Login Here</a><h6>
					</div>
					<!-- end registration form -->
					<!-- login form -->
					<div class="signin-form profile" id="signinform" style="display: none;">
						<h2>Sign in Form</h2>
						<div class="alert alert-danger" id="verror2" style="display:none;"></div>
						<div class="login-form">
							<form action="" method="post" name="adminsignin" id="adminsignin">
								<input type="text" name="useremail" id="useremail" placeholder="E-mail">
								<input type="password" name="password" id="password" placeholder="Password">
								<div class="tp">
									
									<button type="button" name="signinbtn" id="signinbtn">SIGN IN</button>
								</div>
							</form>
						</div>
						<div class="login-social-grids">
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin-square"></i>
								</a></li>
								<li><a href="#"><i class="fa fa-github"></i>
								</a></li>
							</ul>
						</div>
						<p><a href="javascript:void(0);"> Don't have an account?</a></p>
						
						<h6><a id="registerfrm" href="javascript:void(0);">Register Here</a><h6>
					</div>
					<!-- end login form -->
				</div>
				<!--copy rights start here-->
				<div class="copyrights_agile two">
					<p>© 2017 Smartbazaar. All Rights Reserved</p>
				</div>
				<!--copy rights end here-->
			</div>
		</div>
		<!-- /login -->
		<!-- //pages_agile_info_w3l -->
		<!-- js -->
		<script type="text/javascript" src="<?php echo $admin_assets; ?>js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?php echo $admin_assets; ?>js/custom.js"></script>
		<script src="<?php echo $admin_assets; ?>js/modernizr.custom.js"></script>
		
		<script src="<?php echo $admin_assets; ?>js/classie.js"></script>
		<script src="<?php echo $admin_assets; ?>js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
		
		<!-- //js -->
		<script src="<?php echo $admin_assets; ?>js/screenfull.js"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);
			if (!screenfull.enabled) {
				return false;
			}
			
			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
				});
		});
		</script>
		<script src="<?php echo $admin_assets; ?>js/jquery.nicescroll.js"></script>
		<script src="<?php echo $admin_assets; ?>js/scripts.js"></script>
		<!-- <script src="<?php echo $admin_assets; ?>js/snow.js"></script> -->
		<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-36251023-1']);
		_gaq.push(['_setDomainName', 'jqueryscript.net']);
		_gaq.push(['_trackPageview']);
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		</script>
		<script type="text/javascript" src="<?php echo $admin_assets; ?>js/bootstrap-3.1.1.min.js"></script>
	</body>
</html>