<?php $CI =& get_instance(); $frontend_assets = $CI->config->item('frontend_assets'); $usersessiondata = $CI->session->userdata('loginuserdata'); ?>
<div class="login">
		<div class="main-agileits">
				<div class="form-w3agile form1">
					<h3>My Profile</h3>

					<!-- showing flash messages after registration of users -->
					<?php if($this->session->flashdata('success')){ ?>
				    <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;"> 
				    	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <?php echo $this->session->flashdata('success'); ?> 
				    </div>
				    <?php }else if($this->session->flashdata('error')){?>
				    <div class="alert alert-danger fade in alert-dismissable"> 
				    	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <?php echo $this->session->flashdata('error'); ?> 
				    </div>
				    <?php }?>
					<!-- end -->
					<form action="" method="post" name="editProfilefrm" id="editProfilefrm">
						<?php
							if(isset($profiledata) && !empty($profiledata)){
						?>
						<div class="alert alert-danger" id="profileErr" style="display: none;"></div>
						<div class="alert alert-success" id="profileInfo" style="display: none;"></div>
						<img id="loader" src="<?php echo $frontend_assets; ?>images/loader.gif" style="display:none;margin-top: 505px;margin-left: 157px;" height="60" width="60" class="img-head" alt="">
						<div class="form-group">
							<img id="loader" src="<?php echo $frontend_assets; ?>images/loader.gif" style="display:none;margin-top: 396px;margin-left: 157px;" height="60" width="60" class="img-head" alt="">
						</div>
						<label for="username">Username</label>
						<div class="key">
							<i class="fa fa-user" aria-hidden="true"></i>
							<input type="text" value="<?php echo $profiledata[0]->username; ?>" name="username" id="username" readonly placeholder="Username">
							<div class="clearfix"></div>
						</div>
						<label for="email">Email</label>
						<div class="key">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<input  type="text" value="<?php echo $profiledata[0]->email; ?>" name="email" id="email" readonly>
							<div class="clearfix"></div>
						</div>
						<label for="pass">Password</label>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password" value="<?php echo $profiledata[0]->password; ?>" name="pass" id="pass">
							<div class="clearfix"></div>
						</div>
						<label for="mobilenum">Mobile Number</label>
						<div class="key">
							<i class="fa fa-phone" aria-hidden="true"></i>
							<input  type="text" value="<?php echo $profiledata[0]->mobile_no; ?>" name="mobilenum" id="mobilenum">
							<div class="clearfix"></div>
						</div>

						<input type="submit" value="Edit Profile" id="editProfileBtn">
					<?php
						}
					?>
					</form>
				</div>
				
			</div>
		</div>