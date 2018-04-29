//var baseURL = window.location.origin+'/';
var baseURL = 'http://localhost/smartbazaar/';
$(document).ready(function(){

	// Global array for holding quantities in the cart page
	var qtycollection = [];

 	$('#signuperr').css('display','none');

	/* Codes for registration of users */
	jQuery(document).on('click', '#signupBtn', function(e){
		e.preventDefault();
		var errors = '';
	    var status = '';
    	var signUpData = new FormData();

	    var usrname = $('#username').val();
	    usrname = $.trim(usrname);
	    var usrnameRegexp = /^[A-Za-z\s]+$/;

	    var usrnamelength = usrname.length;

	    var email = $('#email').val();
	    email = $.trim(email);
	    var emailRegexp = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	    var password = $('#pass').val();
	    password = $.trim(password);
	    var passwordlength = password.length;

	    var mobileno = $('#mobilenum').val();
	    mobileno = $.trim(mobileno);

	    signUpData.append("uname",usrname);
	    signUpData.append("uemail",email);
	    signUpData.append("upass",password);
	    signUpData.append("umobile",mobileno);

	    if(usrname == ""){
	      errors += "User name can't be left empty!<br/>";
	      $('#signuperr').html(errors);
	      status = false;
	     
	    }    
	    else{
	      if(usrnamelength <=3){
	        errors += "User name must have more than 3 characters!<br/>";
	        $('#signuperr').html(errors);
	        $('#signuperr').css('display','block');
	        status = false;
	      }
	      if(!usrnameRegexp.test(usrname)){
	          errors += "User name can contain only alphabets!<br/>";
	          
	          $('#signuperr').css('display','block');
	          $('#signuperr').html(errors);
	          status = false;
	      }
	    }
	    

	    if(email == ""){
	      errors += "Email can't be left empty!<br/>";
	      $('#signuperr').css('display','block');
	      $('#signuperr').html(errors);
	      status = false;
	    }
	    else{
	      if(!emailRegexp.test(email)){
	          errors += "Invalid Email address!<br/>";
	          $('#signuperr').css('display','block');
	          $('#signuperr').html(errors);
	          status = false;
	      }
	    }
	    if(password == ""){
	      errors += "Password can't be left empty!<br/>"; 
	      $('#signuperr').css('display','block');
	      $('#signuperr').html(errors);
	      status = false;
	    }
	    else{
	    	if(passwordlength <=4){
	    		errors += "Password must have more than 4 characters!<br/>";
	    		$('#signuperr').css('display','block');
	    		$('#signuperr').html(errors);
	    		status = false;
	    	}
	    }

	    if(mobileno == ""){
	    	errors += "Mobile number can't be left empty!<br/>";
	    	$('#signuperr').css('display','block');
	    	$('#signuperr').html(errors);
	    	status = false;
	    }
	    else{
	    	var mobileRegexp = /^(\+\d{1,3}[789]\d{9})|([789]\d{9})|([0]\d{9})$/;
	    	if(!mobileRegexp.test(mobileno)){
	    		errors += "Invalid Mobile number(enter number e.g, +91 8087339090, 0808733909, 8087339090, +91-8087339090)<br/>";
	    		$('#signuperr').css('display','block');
	    		$('#signuperr').html(errors);
	    		status = false;
	    	}
	    }
	    
	    if(errors == ""){
	      status = true;
	      //errors = "";
	      
	      $('#signuperr').css('display','none');
	    }

      	if(status != false){
	      $.ajax({
	        url: baseURL+'registeruser',
	        method:'post',
	        processData: false,
	        contentType: false,
	        dataType:"json",
	        data: signUpData,
	        beforeSend: function() {
		        $('#loader').css('display','block');
		    },
	        success:function(response){
	            if(response.success == '1'){	
	            	$(this).prop('disabled', true);
	              	window.location.href = baseURL+'register';
	            }
	            if(response.error == '1'){
	            	console.log('error');
	            	errors += response.msg;
	            	$('#signuperr').css('display','block');
	                $('#signuperr').html(errors);
	            }
	        },
	        complete: function() {
		        $('#loader').css('display','none');
		    }

	      });
    	}
	});

	/* Codes for login of users */
	jQuery(document).on('submit', '#userloginfrm', function(e){
		e.preventDefault();
		var errors = '';
	    var status = '';

	    var email = $('#loginmail').val();
	    email = $.trim(email);
	    var emailRegexp = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	    var password = $('#loginpassword').val();
	    password = $.trim(password);
	    var passwordlength = password.length;

	    if(email == ""){
	      errors += "Email can't be left empty!<br/>";
	      $('#loginErr').css('display','block');
	      $('#loginErr').html(errors);
	      status = false;
	    }
	    else{
	      if(!emailRegexp.test(email)){
	          errors += "Invalid Email address!<br/>";
	          $('#loginErr').css('display','block');
	          $('#loginErr').html(errors);
	          status = false;
	      }
	    }
	    if(password == ""){
	      errors += "Password can't be left empty!<br/>"; 
	      $('#loginErr').css('display','block');
	      $('#loginErr').html(errors);
	      status = false;
	    }
	    else{
	    	if(passwordlength <=4){
	    		errors += "Password must have more than 4 characters!<br/>";
	    		$('#loginErr').css('display','block');
	    		$('#loginErr').html(errors);
	    		status = false;
	    	}
	    }

	    if(errors == ""){
	      status = true;
	      errors = "";
	      
	      $('#loginErr').css('display','none');
	    }

      	if(status != false){
	      $.ajax({
	        url: baseURL+ 'loginuser',
	        method:'post',
	        processData: false,
	        contentType: false,
	        dataType:"json",
	        data: new FormData(this),
	        success:function(response){
	            if(response.success == 1){
	              window.location.href = baseURL;
	            }
	            else{
	              errors += "Invalid Email/Password given, please try again!<br/>";
	              $('#loginErr').css('display','block');
	              $('#loginErr').html(errors);
	            }
	        }
	      });
	    }
			

	});

	/* Codes for forgot password request */
	jQuery(document).on('click', '#forgotPassBtn', function(e){
		e.preventDefault();
		var status = true;
		var errors = '';
		var email = $('#forgotpassemail').val();
		email = $.trim(email);
	    var emailRegexp = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	    if(email == ""){
	      errors += "Email can't be left empty!<br/>";
	      $('#forgotPassErr').css('display','block');
	      $('#forgotPassErr').html(errors);
	      status = false;
	    }
		else if(!emailRegexp.test(email)){
	          errors += "Invalid Email address!<br/>";
	          $('#forgotPassErr').css('display','block');
	          $('#forgotPassErr').html(errors);
	          status = false;
	      }

	    if(status){
	    	$(this).prop('disabled', true);
	    	jQuery.ajax({
				url: baseURL+'resetpassword',
				data:{forgotEmail: email},
				type:"POST",
				dataType:"json",
				beforeSend: function() {
		        	$('#loader').css('display','block');
		    	},
				success: function(response){
   					if(response.success == 1){
   						$('#forgotPassModal').modal('hide');
   						$('#infoMsg').show();
   						$('#infoMsg').html('Password reset successful, please check your email to get the new password');
   					}
   					else{
   						$('#forgotPassErr').show();
   						$('#forgotPassErr').html(response.errmsg);
   					}
				},
				complete: function() {
		        	$('#loader').css('display','none');
		    	}
			
		});


	    }  

	});

	/* Codes for profile edit */
	jQuery(document).on('click', '#editProfileBtn', function(e){
		e.preventDefault();
		var status = true;
		var errors = '';
	    var status = '';
    	var profileData = new FormData();

	    var usrname = $('#username').val();
	    usrname = $.trim(usrname);
	    var usrnameRegexp = /^[A-Za-z\s]+$/;

	    var usrnamelength = usrname.length;

	    var email = $('#email').val();
	    email = $.trim(email);
	    var emailRegexp = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	    var password = $('#pass').val();
	    password = $.trim(password);
	    var passwordlength = password.length;

	    var mobileno = $('#mobilenum').val();
	    mobileno = $.trim(mobileno);

	    profileData.append("uname",usrname);
	    profileData.append("uemail",email);
	    profileData.append("upass",password);
	    profileData.append("umobile",mobileno);

	    if(usrname == ""){
	      errors += "User name can't be left empty!<br/>";
	      $('#profileErr').html(errors);
	      status = false;
	     
	    }    
	    else{
	      if(usrnamelength <=3){
	        errors += "User name must have more than 3 characters!<br/>";
	        $('#profileErr').html(errors);
	        $('#profileErr').css('display','block');
	        status = false;
	      }
	      if(!usrnameRegexp.test(usrname)){
	          errors += "User name can contain only alphabets!<br/>";
	          
	          $('#profileErr').css('display','block');
	          $('#profileErr').html(errors);
	          status = false;
	      }
	    }
	    

	    if(email == ""){
	      errors += "Email can't be left empty!<br/>";
	      $('#profileErr').css('display','block');
	      $('#profileErr').html(errors);
	      status = false;
	    }
	    else{
	      if(!emailRegexp.test(email)){
	          errors += "Invalid Email address!<br/>";
	          $('#profileErr').css('display','block');
	          $('#profileErr').html(errors);
	          status = false;
	      }
	    }
	    if(password == ""){
	      errors += "Password can't be left empty!<br/>"; 
	      $('#profileErr').css('display','block');
	      $('#profileErr').html(errors);
	      status = false;
	    }
	    else{
	    	if(passwordlength <=4){
	    		errors += "Password must have more than 4 characters!<br/>";
	    		$('#profileErr').css('display','block');
	    		$('#profileErr').html(errors);
	    		status = false;
	    	}
	    }

	    if(mobileno == ""){
	    	errors += "Mobile number can't be left empty!<br/>";
	    	$('#profileErr').css('display','block');
	    	$('#profileErr').html(errors);
	    	status = false;
	    }
	    else{
	    	var mobileRegexp = /^(\+\d{1,3}[789]\d{9})|([789]\d{9})|([0]\d{9})$/;
	    	if(!mobileRegexp.test(mobileno)){
	    		errors += "Invalid Mobile number(enter number e.g, +91 8087339090, 0808733909, 8087339090, +91-8087339090)<br/>";
	    		$('#profileErr').css('display','block');
	    		$('#profileErr').html(errors);
	    		status = false;
	    	}
	    }
	    
	    if(errors == ""){
	      status = true;
	      $('#profileErr').css('display','none');
	    }
		if(status != false){
	      $.ajax({
	        url: baseURL+'edituserprofile',
	        method:'post',
	        processData: false,
	        contentType: false,
	        dataType:"json",
	        data: profileData,
	        beforeSend: function() {
		        $('#loader').css('display','block');
		    },
	        success:function(response){
	            if(response.success == '1'){	
	            	$(this).prop('disabled', true);
	              	//window.location.href = baseURL+'userprofile';
	              	$('#profileInfo').show();
	              	$('#profileInfo').html(response.profilemsg);
	            }
	        },
	        complete: function() {
		        $('#loader').css('display','none');
		    }

	      });
    	}

	});

	/* Codes for clearing forgot password modal */
	$('#forgotPassModal').on('hidden.bs.modal', function (e) {
  		 $('#forgotPassErr').html('');
  		 $('#forgotPassErr').hide();
  		 $('#forgotpassemail').val('');
  		 $('#forgotPassBtn').prop('disabled', false);
	});

	/*Codes for handling login of administrators */
	jQuery(document).on('click', '#signinbtn', function(){
		//alert(baseURL+'login');
		var formData = new FormData(jQuery('#adminsignin')[0]);
		jQuery.ajax({
			url: baseURL+'adminlogin',
			data:formData,
			type:"POST",
			cache:false,
			dataType:"json",
			contentType: false,
			processData: false, 
			success: function(response){
				if(response.status == false && response.type == "verror2"){
					jQuery("#verror2").html(response.message);
					jQuery("#verror2").show();
				}else{ 
   					if(response.success == 1){
   						window.location.href = baseURL + 'dashboard';	
   					}
   					else if (response.error == 1) {
   						jQuery("#verror2").html(response.errormsg);
						jQuery("#verror2").show();
   					}
				}
			},
			error: function(){
				console.log("Error");
			}
		});
	});

	/*Codes for handling registration of administrators */
	jQuery(document).on('click', '#submitbtn', function(){
		var formData = new FormData(jQuery('#adminsignup')[0]);
		jQuery.ajax({
			url: baseURL+'adminregister',
			data:formData,
			type:"POST",
			cache:false,
			dataType:"json",
			contentType: false,
			processData: false,
			success: function(response){
				if(response.status == false && response.type == "verror"){
					jQuery("#verror").html(response.message);
					jQuery("#verror").show();
				}else{ 
   					if(response.status == true){
   						window.location.href = baseURL + 'dashboard';	
   					}
				}
			},
			error: function(){
				console.log("Error");
			}
		});
	});
	

	/* Codes for hiding registration form and showing login form */
	jQuery(document).on('click', '#loginfrm', function(){
		jQuery("#signupform").css("display","none");
		jQuery("#signinform").css("display","block");

	});


	/* Codes for hiding login form and showing registration form */	
	jQuery(document).on('click', '#registerfrm', function(){
		jQuery("#signinform").css("display","none");
		jQuery("#signupform").css("display","block");
	});

	/* Code for resetting add/edit category modal */
	$('#categoryModal').on('hidden.bs.modal', function (e) {
		 $('#categoryModal').find('.modal-title').text('Add Category');
		 $('#savecatbtn').text('Add');
  		 $('#catform').find('input:text').val('');
  		 $("#catid").val('');
		 $("#isedit").val(0);
  		 $('#catform').find('#catstatus').prop('selectedIndex',0);
  		 $('#catadderror').html('');
  		 $('#catadderror').hide();
  		 $('#catname').css('border','');
	});

	/* Codes for resetting add/edit product modal */
	$('#productModal').on('hidden.bs.modal', function(e){
		jQuery('#productModal').find('.modal-title').text('Add Product');
		jQuery('#saveproductbtn').text('Add');
		$('#productadderror').html('');
		$('#productadderror').hide();
		$("#isedit").val(0);
		$('#productid').val('');
		$('#productform').find('input:text').val('');
		$('#productdesc').val('');
		$('#productimage').text('');  // ????!!!!

		$('#productcategory').get(0).selectedIndex = 0;
		$('#productstatus').get(0).selectedIndex = 0;
	});


	/* Code for adding new category */
	jQuery(document).on('click', '#savecatbtn', function(){
		var html = '';
	    var catname = jQuery("#catname").val();
	    var catstatus = jQuery("#catstatus").val();
	    var isedit = jQuery("#isedit").val();
	    var catid = jQuery("#catid").val();
	    //var nameReg = /^[A-Za-z]+$/;
	    var nameReg = /^\w+( +\w+)*$/;

	    if (catname == '' || catname == null || catname.trim().length == 0) {
                html += 'Category name is empty<br/>';
        } else {
	        if (catname.length < 3) {
	            html += "Category name must have at least 3 characters.<br/>";
	        }  
	        if (!nameReg.test(catname)) {
	            html += "Not allowed characters in category name.<br/>";
	        }
        }

         if (html != '') {
                $("#catadderror").show();
                jQuery("#catadderror").html(html);
                jQuery("#catname").css("border","1px solid red");
                jQuery("#catname").focus();
        } else {
        	$("#catadderror").hide();
        	jQuery("#catname").css("border","");
        	jQuery.ajax({
                url: baseURL + 'addcategory',
                data: {'catName': catname, 'catStatus': catstatus, 'isedit': isedit, 'catid': catid},
                type: "POST",
                dataType: "json",
                success: function (response) {
                    if (response.success == 1) {
                        window.location.href = response.redirecturl;
                    } else{
                        $("#catadderror").show();
                    }

                }
            });
        }

	});

	/* Code for getting product detail after clicking over a product */
	jQuery(document).on('click', '.prodImgDetail', function(){
		var prod_img_dir = 'uploads/products/300_300/';
		var prod_id = $(this).attr("prod-id");
		var prod_description;
		//alert(prod_id);
		jQuery.ajax({
			url: baseURL+'single-product-details',
			data:{'productId':prod_id},
			type:"POST",
			dataType:"json",
			success: function(response){
				if(response.success == 1){
					prod_img_dir += response.details[0].image;
					prod_description = response.details[0].description.length;
					if(prod_description > 80){
						response.details[0].description = response.details[0].description.substring(0,80)+'...';
					}
					jQuery('#productDetailModal').find('img').attr('src',prod_img_dir);
					jQuery('.span-1').find('h3').text(response.details[0].name);
					jQuery('span.reducedfrom').text(response.details[0].price);
					jQuery('p.quick_desc').text(response.details[0].description);
					jQuery('#addToCartBtn').attr("data-id",response.details[0].id);
					jQuery('#addToCartBtn').attr("data-name",response.details[0].name);
					jQuery('#addToCartBtn').attr("data-price",response.details[0].price);
				}else if(response.error == 1){
					console.log('response error');
				}
			},
			error: function(){
				console.log("Unknown Error");
			}
		});


	});

	/* Code for getting product detail after clicking over a product in categorywise products page */
	jQuery(document).on('click', '.singleProdImgDetail', function(){
		var prod_img_dir = '.././uploads/products/300_300/';
		var prod_id = $(this).attr("prod-id");
		var prod_description;
		//alert(prod_id);
		jQuery.ajax({
			url: baseURL+'single-product-details',
			data:{'productId':prod_id},
			type:"POST",
			dataType:"json",
			success: function(response){
				if(response.success == 1){
					prod_img_dir += response.details[0].image;
					prod_description = response.details[0].description.length;
					if(prod_description > 80){
						response.details[0].description = response.details[0].description.substring(0,80)+'...';
					}
					jQuery('#productDetailModal').find('img').attr('src',prod_img_dir);
					jQuery('.span-1').find('h3').text(response.details[0].name);
					jQuery('span.reducedfrom').text(response.details[0].price);
					jQuery('p.quick_desc').text(response.details[0].description);

				}else if(response.error == 1){
					console.log('response error');
				}
			},
			error: function(){
				console.log("Unknown Error");
			}
		});


	});


	/* Code for editing existing category */
	jQuery(document).on('click', '.editcatbtn', function(){
		var cat_id = $(this).attr("cat-id");
		var cstatus = '';
		jQuery.ajax({
			url: baseURL+'category-details',
			data:{'categoryid':cat_id},
			type:"POST",
			dataType:"json",
			success: function(response){
				if(response.success == 1){
					$('#savecatbtn').text('Edit');
					jQuery('#categoryModal').find('.modal-title').text('Edit Category');
					jQuery('input[name="catname"]').val(response.details[0].cat_name);
					jQuery("#catstatus").val(response.details[0].status);
					jQuery("#catid").val(cat_id);
					jQuery("#isedit").val(1);
				}else if(response.error == 1){
					console.log('response error');
				}
			},
			error: function(){
				console.log("Unknown Error");
			}
		});
	});

	/* Code for deleting a category */
	jQuery(document).on('click', '.deletecatbtn', function(){
		var cat_id = $(this).attr("cat-id");
		var result = confirm("Want to delete this category?");
		if (result) {
			jQuery.ajax({
				url: baseURL+'category-delete',
				data:{'categoryid':cat_id},
				type:"POST",
				dataType:"json",
				success: function(response){
					if(response.success == 1){
						window.location.href = response.redirecturl;
					}else if(response.error == 1){
						console.log('error');
					}
				},
				error: function(){
					console.log("Unknown Error");
				}
			});
		}

		
	});

	/* Code for adding a product */
	jQuery(document).on('click', '#saveproductbtn', function(){

		var formData = new FormData(jQuery('#productform')[0]);
		
		jQuery.ajax({
			url: baseURL+'addproduct',
			data:formData,
			type:"POST",
			cache:false,
			dataType:"json",
			contentType: false,
			processData: false,
			success: function(response){
				if(response.status == false && response.type == "verror"){
					jQuery("#productadderror").html(response.message);
					jQuery("#productadderror").show();
				}else{ 
					$('#saveproductbtn').prop('disabled', true);
					window.location.reload();
				}
			},
			error: function(){
				console.log("Error");
			}
		});

	});

	/* Code for editing existing product */
	jQuery(document).on('click', '.editproductbtn', function(){
		var prod_id = $(this).attr('prod-id');
		var prod_status = '';
		jQuery.ajax({
			url: baseURL+'product-details',
			data:{'productid':prod_id},
			type:"POST",
			dataType:"json",
			success: function(response){
				if(response.success == 1){
					
					jQuery('#productModal').find('.modal-title').text('Edit Product');
					jQuery('#saveproductbtn').text('Edit');
					jQuery('#productname').val(response.details[0].name);
					jQuery('#productcategory').val(response.details[0].cid); 
					jQuery('#productprice').val(response.details[0].price);
					jQuery('#productdesc').val(response.details[0].description);
					jQuery('#productstock').val(response.details[0].stock);
					jQuery('#productstatus').val(response.details[0].status);
					jQuery("#productid").val(prod_id);
					jQuery("#isedit").val(1);

				}else if(response.error == 1){
					console.log('response error');
				}
			},
			error: function(){
				console.log("Unknown Error");
			}
		});
	});

	/* Code for deleting existing product */
	jQuery(document).on('click', '.deleteproductbtn', function(){
		var prod_id = $(this).attr("prod-id");
		var result = confirm("Want to delete this product?");
		if (result) {
			jQuery.ajax({
				url: baseURL+'product-delete',
				data:{'productid':prod_id},
				type:"POST",
				dataType:"json",
				success: function(response){
					if(response.success == 1){
						window.location.href = response.redirecturl;
					}else if(response.error == 1){
						console.log('error');
					}
				},
				error: function(){
					console.log("Unknown Error");
				}
			});
		}
	});

	/* Function for handling add to cart process */
	$('#addToCartBtn').on('click', function(e){
		e.preventDefault();

		var prodId = $(this).data('id');
		var prodName = $(this).data('name');
		var prodPrice = $(this).data('price');
		var prodQty = 1;

		
		jQuery.ajax({
				url: baseURL+'addtocart',
				data:{'id':prodId,'name':prodName,'price':prodPrice},
				type:"POST",
				dataType:"json",
				beforeSend: function() {
		        	$(this).prop('value', 'Adding...');
		        	$(this).prop('disabled', true);
		    	},
				success: function(response){
					if(response.success == 1){
						
						window.location.href = baseURL;
					}else if(response.error == 1){
						console.log('error');
					}
				},
				complete: function() {
					$(this).prop('value', 'Add to Cart');
		        	$(this).prop('disabled', false);
		        	swal({
					  title: "Item has been added to the cart!",
					  icon: "success",
					  title: "Item has been added to the cart!",
					  button: "OK"
					});
		    	},
				error: function(){
					console.log("Unknown Error");
				}
			});

	});

	function preventSpecialCharacterInput(e){
	    var keyCode = (e.keyCode ? e.keyCode : e.which);
	    if (keyCode >= 33 && keyCode <= 47 || keyCode == 158 || keyCode == 159 || keyCode >=59 && keyCode <=64 || keyCode >=91 && keyCode <=96 || keyCode>=123 && keyCode <=126 ) {
	      toastr.warning('Special characters are not allowed in quantity field!');
	      e.preventDefault();
	    }  
  	}

  	function preventAlphabetInput(e){
  		var keyCode = (e.keyCode ? e.keyCode : e.which);
	    if (keyCode >= 65 && keyCode <= 90 || keyCode >= 97 && keyCode <= 122) {

	    	toastr.warning('Alphabets are not allowed in quantity field!');
	    	e.preventDefault();
	    }
  	}

  	function preventZeroEntry(e){
  		var keyCode = (e.keyCode ? e.keyCode : e.which);
	    if (keyCode == 48) {

	    	toastr.warning('Entering 0 is not allowed in quantity field!');
	    	e.preventDefault();
	    }	
  	}

	/* Function for preventing user to enter invalid data in quantity field of cart page */
	$('#cartTbl').find("input:text").on('keypress', function(e){
		preventSpecialCharacterInput(e);
		preventAlphabetInput(e);
		preventZeroEntry(e);
	});	

	/* Function for processing checkout process of cart page */
	$('.checkoutBtn').on('click', function(){
		
		var productIds = [];
		var productNames = [];
		var productPrices = [];
		var productSubTotalPrices = [];
		var productQtys = [];
		var productTotalPrice = 0;

    	$("input[id^='productId']").each(function(){
    		productIds.push($(this).val()) 
    	});

    	$("input[id^='productName']").each(function(){
    		productNames.push($(this).val()) 
    	});

    	$("input[id^='productPrice']").each(function(){
    		productPrices.push($(this).val()) 
    	});

    	$("input[id^='productSubtotalPrice']").each(function(){
    		productSubTotalPrices.push($(this).val()) 
    	});

    	$("input[id^='productQty']").each(function(){
    		productQtys.push($(this).val()) 
    	});

    	productTotalPrice = $('#productTotalPrice').val();

		jQuery.ajax({
				url: baseURL+'checkout',
				data:{'product_id':productIds,'product_name':productNames,'product_price':productPrices,'subtotal_amount':productSubTotalPrices,'quantity':productQtys,'total_amount':productTotalPrice},
				type:"POST",
				dataType:"json",
				beforeSend: function() {
		        	$('.checkoutBtn').text('Placing order,please wait...');
		        	$('.checkoutBtn').attr("disabled", "disabled");
		        	$('#loader').css('display','inline');
		    	},
				success: function(response){
					if(response.success == 1){
						swal({
						  title: "Order has been placed successfully!",
						  icon: "success",
						  button: "OK"
						}).then(function(isConfirm) {
							if (isConfirm) {
								window.location.href = baseURL;
							}
						});
					}else if(response.error == 1){
						swal("Error occurred while placing order", "Please try again later");
					}
				},
				complete: function() {
					$('.checkoutBtn').text('Checkout');
		        	$('.checkoutBtn').removeAttr("disabled");
		        	$('#loader').css('display','none');
		    	},
				error: function(){
					console.log("Unknown Error");
				}
		});

	});

	/* Function to remove item from cart */
	$('.cancel').on('click', function(){
		var id = $(this).attr('id');
		var rowid = $('.rowid_'+id).val();

		swal({
		  title: "Are you sure?",
		  text: "Once removed, you will not be able to recover this cart item!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		  	jQuery.ajax({
				url: baseURL+'removeitem',
				data:{'id':rowid},
				type:"POST",
				dataType:"json",
				success: function(response){
					if(response.success == 1){
						window.location.href = baseURL+'showcart';	
					}
					
				},
				error: function(){
					console.log("Unknown Error");
				}
			});
		    swal("Cart item has been removed!", {
		      icon: "success",
		    });
		  } else {
		    swal("You chose to cancel this operation!");
		  }
		});
	});	

});

