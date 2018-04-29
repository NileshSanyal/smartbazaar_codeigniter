<?php 
	$CI =& get_instance(); 
	$frontend_assets = $CI->config->item('frontend_assets'); 
	$usersessiondata = $CI->session->userdata('user_email'); 
?>
<!DOCTYPE html>
<html>
<head>
<title>Smart Bazaar your online shopping portal for all needs</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="og:title" content="Vide" />
<meta name="keywords" content="Smart Bazaar Bootstrap Web Templates, 
Smartphone Compatible web template" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="<?php echo $frontend_assets; ?>css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="<?php echo $frontend_assets; ?>css/style.css" rel='stylesheet' type='text/css' />
<link href="<?php echo $frontend_assets; ?>css/toastr.min.css" rel='stylesheet' type='text/css' />

<!-- js -->
   <script src="<?php echo $frontend_assets; ?>js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="<?php echo $frontend_assets; ?>js/move-top.js"></script>
<script type="text/javascript" src="<?php echo $frontend_assets; ?>js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	}); 
</script>
<!-- start-smoth-scrolling -->
<link href="<?php echo $frontend_assets; ?>css/font-awesome.css" rel="stylesheet"> 
<!-- <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'> -->
<!--- start-rate---->
<script src="<?php echo $frontend_assets; ?>js/jstarbox.js"></script>
<script src="<?php echo $frontend_assets; ?>js/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" href="<?php echo $frontend_assets; ?>css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
		<script type="text/javascript">
			jQuery(function() {
			jQuery('.starbox').each(function() {
				var starbox = jQuery(this);
					starbox.starbox({
					average: starbox.attr('data-start-value'),
					changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
					ghosting: starbox.hasClass('ghosting'),
					autoUpdateAverage: starbox.hasClass('autoupdate'),
					buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
					stars: starbox.attr('data-star-count') || 5
					}).bind('starbox-value-changed', function(event, value) {
					if(starbox.hasClass('random')) {
					var val = Math.random();
					starbox.next().text(' '+val);
					return val;
					} 
				})
			});
		});
		</script>
<!---//End-rate---->

</head>
<body>
<a href="offer.html"><img src="<?php echo $frontend_assets; ?>images/download.png" class="img-head" alt=""></a>
<div class="header">

		<div class="container">
			
			<div class="logo">
				<h1 ><a href="<?php echo base_url(); ?>"><b>T<br>H<br>E</b>Big Store<span>The Best Supermarket</span></a></h1>
			</div>
			<div class="head-t">
				<ul class="card">
					

					<?php
						if(isset($usersessiondata) && $usersessiondata !=''){
					?>

					<li><a href="<?php echo base_url('logout'); ?>" ><i class="fa fa-user" aria-hidden="true"></i>Log out</a></li>
					<li><a href="<?php echo base_url('userprofile'); ?>" ><i class="fa fa-user" aria-hidden="true"></i>My Profile</a></li>
					<li><a href="about.html" ><i class="fa fa-file-text-o" aria-hidden="true"></i>Order History</a></li>
					<li><a href="shipping.html" ><i class="fa fa-ship" aria-hidden="true"></i>Shipping</a></li>
					<li><a href="wishlist.html" ><i class="fa fa-heart" aria-hidden="true"></i>Wishlist</a></li>
					<?php
						} else{
					?>

					<li><a href="<?php echo base_url('login'); ?>" ><i class="fa fa-user" aria-hidden="true"></i>Login</a></li>
					<li><a href="<?php echo base_url('register'); ?>" ><i class="fa fa-arrow-right" aria-hidden="true"></i>Register</a></li>

					<?php
						}
					?>


					
					
				</ul>	
			</div>
			
			<div class="header-ri">
				<ul class="social-top">
					<li><a href="#" class="icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i><span></span></a></li>
					<li><a href="#" class="icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i><span></span></a></li>
					<li><a href="#" class="icon pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i><span></span></a></li>
					<li><a href="#" class="icon dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i><span></span></a></li>
				</ul>	
			</div>
		

				<div class="nav-top">
					<nav class="navbar navbar-default">
					
					<div class="navbar-header nav_2">
						<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						

					</div> 
					<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
						<ul class="nav navbar-nav ">
							<li class=" active"><a href="<?php echo base_url(); ?>" class="hyper "><span>Home</span></a></li>	
							
							<li class="dropdown ">
								<a href="#" class="dropdown-toggle  hyper" data-toggle="dropdown" ><span>Browse All Categories<b class="caret"></b></span></a>
								<ul class="dropdown-menu multi">
									<div class="row">
										<div class="col-sm-3">
											<ul class="multi-column-dropdown">
												<?php
													if(isset($categories) && !empty($categories)){
														foreach($categories as $cat){
												?>
												<li><a href="<?php echo base_url() ?>products/<?php echo $cat->id; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i><?php echo $cat->cat_name; ?></a></li>
												<?php 
														}
													}

												?>
											</ul>
										
										</div>
										<div class="col-sm-3 w3l">
											<a href="javascript:void(0);"><img src="<?php echo $frontend_assets; ?>images/me.png" class="img-responsive" alt=""></a>
										</div>
										<div class="clearfix"></div>
									</div>	
								</ul>
							</li>
						</ul>
					</div>
					</nav>
					 <div class="cart" >
					
						<a class="fa fa-shopping-cart my-cart-icon" href="<?php echo base_url('showcart'); ?>">
							
						</a>
					</div>
					<div class="clearfix"></div>
				</div>
					
				</div>			
</div>

    <script>window.jQuery || document.write('<script src="<?php echo $frontend_assets; ?>js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
    <script src="<?php echo $frontend_assets; ?>js/jquery.vide.min.js"></script>