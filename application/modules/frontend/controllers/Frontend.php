<?php
if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Frontend extends MX_Controller {
	//private $usersessiondata;
	public function __construct() {
		/*parent::__construct();
		$this->usersessiondata = $this->session->userdata('user_email');
		if(empty($this->usersessiondata)){
			redirect(base_url());
		}*/
		//$this->load->library('paypal');
		$this->load->model('frontend/frontend_model');
		

	}

	/*Function for showing homepage */
	public function index() {
		$data = array();
		$data['categories'] = $this->frontend_model->categories();
		$data['specialproducts'] = $this->frontend_model->specialproducts();
		$this->load->frontendtemplate('frontend/home', $data);
	}

	/* Function for showing products by category */
	public function productsbycategory($catId = ''){
		$data = array();
		$data['categories'] = $this->frontend_model->categories();
		$data['productsbycategory'] = $this->frontend_model->productsbycategory($catId);
		$this->load->frontendtemplate('frontend/products', $data);

	}


	/* Function for showing registration page */
	public function register(){
		$data = array();
		$data['categories'] = $this->frontend_model->categories();
		$this->load->view('frontend/register', $data);	
	}

	/* Function for showing login page */
	public function login(){
		$data = array();
		$data['categories'] = $this->frontend_model->categories();
		$this->load->view('frontend/login', $data);	
	}

	/* Function for processing login of users */
	public function loginuser(){
		$res = array();
		$postdata = array();
		$check_status = array();
		$checked_pass = '';
		if ($this->input->is_ajax_request()) {
			$postdata = $this->input->post();
			$check_status = $this->frontend_model->prevuserdata($postdata['loginmail']);
			if($check_status){
				$checked_pass = password_verify($postdata['loginpassword'],$check_status[0]->password);
				if($checked_pass){
					$this->session->set_userdata('user_email', $postdata['loginmail']);
					$res['success']='1';
					$res['error']='0';
				}
				else{
					$res['success']='0';
					$res['error']='1';
				}
			}	
			else{
				$res['success']='0';
				$res['error']='1';
			}
			echo json_encode($res);
			exit(0);
		}
	}

	/* Function for log out */
	public function logout(){
		$this->session->sess_destroy();
        redirect(base_url());
	}

	/* Function for processing registration of users */
	public function registeruser(){
		$user_password = '';
		$status = '';
		$postdata = array();
		$result = array();
		if ($this->input->is_ajax_request()) {
	        	$postdata = $this->input->post();
	        	$data = array();
	        	//print_r($postdata);die('controller');
	        	$reg_email = $postdata['uemail'];
	        	$prevemailstatus = $this->frontend_model->prevemails($reg_email);
	        	if($prevemailstatus == 1){
	        		$result['success']='0';
					$result['error']='1';
					$result['msg'] = 'Email address is already in use!!';
	        	}
	        	else{
	        		$user_password = password_hash($postdata['upass'],PASSWORD_DEFAULT); 
	        		$data = array(
			            'username' => $postdata['uname'],
			            'email' => $postdata['uemail'],
			            'password' => $user_password,
			            'mobile_no' => $postdata['umobile']
			        );
	        		$status = $this->frontend_model->registeruser($data);
	        		if($status){
	        			$result['success']='1';
						$result['error']='0';
						$this->session->set_flashdata('success', 'User registered successfully');
	        		}
	        		else{
	        			$result['success']='0';
						$result['error']='1';
						$result['msg'] = 'Some error occurred, please try again later!!';
	        		}
	        	}
	        	echo json_encode($result);
				exit(0);
        	}
	}

	/* Function for getting details for a specific product */
	public function singleproductdetails(){
		$prod_details = array();
		$result = array();
    	if($this->input->is_ajax_request()){
			$productId = $this->input->post('productId');
			$prod_details = $this->frontend_model->singleproductdetails($productId);
			if(!empty($prod_details)){
				$result['success'] = 1;
				$result['error'] = 0;
				$result['details'] = $prod_details;
			}  
			else{
				$result['success'] = 0;
				$result['error'] = 1;
			}

			echo json_encode($result);exit(0);
		}
	}

	/* Function for resetting password of the user for clicking on forgot password */
	public function resetpassword(){
		$previousEmail = '';
		$emailContent = '';
		$password = '';
		$hashedpassword = '';
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
   	 	$password = substr( str_shuffle( $chars ), 0, 10 );

   	 	$hashedpassword = password_hash($password,PASSWORD_DEFAULT); 

		$result = array();
		if($this->input->is_ajax_request()){
			$previousEmail = $this->input->post('forgotEmail');
			 
			$emailStatus = $this->frontend_model->prevuserdata($previousEmail);
			if(!empty($emailStatus)){

				// update password wrt to the email
				$updatestat = $this->frontend_model->updatepassword($previousEmail,$hashedpassword);
				// end

				$emailContent = '<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
  <!-- NAME: 1 COLUMN -->
  <!--[if gte mso 15]>
      <xml>
        <o:OfficeDocumentSettings>
          <o:AllowPNG/>
          <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
      </xml>
    <![endif]-->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reset Your Smartbazaar Password</title>
  <!--[if !mso]>
      <!-- -->
  <link href="https://fonts.googleapis.com/css?family=Asap:400,400italic,700,700italic" rel="stylesheet" type="text/css">
  <!--<![endif]-->
  <style type="text/css">
    
  </style>
</head>

<body style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 background-color: #fed149; height: 100%; margin: 0; padding: 0; width: 100%">
  <center>
    <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" id="bodyTable" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; background-color: #fed149; height: 100%; margin: 0; padding: 0; width:
 100%" width="100%">
      <tr>
        <td align="center" id="bodyCell" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-top: 0;
 height: 100%; margin: 0; padding: 0; width: 100%" valign="top">
          <!-- BEGIN TEMPLATE // -->
          <!--[if gte mso 9]>
              <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                <tr>
                  <td align="center" valign="top" width="600" style="width:600px;">
                  <![endif]-->
          <table border="0" cellpadding="0" cellspacing="0" class="templateContainer" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; max-width:
 600px; border: 0" width="100%">
            <tr>
              <td id="templatePreheader" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #fed149;
 border-top: 0; border-bottom: 0; padding-top: 16px; padding-bottom: 8px" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" class="mcnTextBlock" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 min-width:100%;" width="100%">
                  <tbody class="mcnTextBlockOuter">
                    <tr>
                      <td class="mcnTextBlockInner" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%" valign="top">
                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnTextContentContainer" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; min-width:100%;" width="100%">
                          <tbody>
                            <tr>
                              <td class="mcnTextContent" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; word-break: break-word;
 color: #2a2a2a; font-family: "Asap", Helvetica, sans-serif; font-size: 12px;
 line-height: 150%; text-align: left; padding-top:9px; padding-right: 18px;
 padding-bottom: 9px; padding-left: 18px;" valign="top">
                                <a href="#" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #2a2a2a;
 font-weight: normal; text-decoration: none" target="_blank" title="Lingo is the
 best way to organize, share and use all your visual assets in one place -
 all on your desktop."></a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <td id="templateHeader" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f7f7ff;
 border-top: 0; border-bottom: 0; padding-top: 16px; padding-bottom: 0" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" class="mcnImageBlock" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 min-width:100%;" width="100%">
                  <tbody class="mcnImageBlockOuter">
                    <tr>
                      <td class="mcnImageBlockInner" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding:0px" valign="top">
                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; min-width:100%;" width="100%">
                          <tbody>
                            <tr>
                              <td class="mcnImageContent" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-right: 0px;
 padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;" valign="top">
                                <a class="" href="https://www.lingoapp.com" style="mso-line-height-rule:
 exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color:
 #f57153; font-weight: normal; text-decoration: none" target="_blank" title="">
                                  <a class="" href="#" style="mso-line-height-rule:
 exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color:
 #f57153; font-weight: normal; text-decoration: none" target="_blank" title="">
                                    <img align="center" alt="Forgot your password?" class="mcnImage" src="https://static.lingoapp.com/assets/images/email/il-password-reset@2x.png" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none;
 text-decoration: none; vertical-align: bottom; max-width:1200px; padding-bottom:
 0; display: inline !important; vertical-align: bottom;" width="600"></img>
                                  </a>
                                </a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <td id="templateBody" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f7f7ff;
 border-top: 0; border-bottom: 0; padding-top: 0; padding-bottom: 0" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" class="mcnTextBlock" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width:100%;" width="100%">
                  <tbody class="mcnTextBlockOuter">
                    <tr>
                      <td class="mcnTextBlockInner" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%" valign="top">
                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnTextContentContainer" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; min-width:100%;" width="100%">
                          <tbody>
                            <tr>
                              <td class="mcnTextContent" align="center" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; word-break: break-word;
 color: #2a2a2a; font-family: "Asap", Helvetica, sans-serif; font-size: 16px;
 line-height: 150%; text-align: center; padding-top:9px; padding-right: 18px;
 padding-bottom: 9px; padding-left: 18px;" valign="top">

                                <h1 class="null" style="color: #2a2a2a; font-family: "Asap", Helvetica,
 sans-serif; font-size: 32px; font-style: normal; font-weight: bold; line-height:
 125%; letter-spacing: 2px; text-align: center; display: block; margin: 0;
 padding: 0"><span style="text-transform:uppercase">Forgot</span></h1>


                                <h2 class="null" style="color: #2a2a2a; font-family: "Asap", Helvetica,
 sans-serif; font-size: 24px; font-style: normal; font-weight: bold; line-height:
 125%; letter-spacing: 1px; text-align: center; display: block; margin: 0;
 padding: 0"><span style="text-transform:uppercase">your password?</span></h2>

                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table border="0" cellpadding="0" cellspacing="0" class="mcnTextBlock" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace:
 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 min-width:100%;" width="100%">
                  <tbody class="mcnTextBlockOuter">
                    <tr>
                      <td class="mcnTextBlockInner" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%" valign="top">
                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnTextContentContainer" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; min-width:100%;" width="100%">
                          <tbody>
                            <tr>
                              <td class="mcnTextContent" align="center" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; word-break: break-word;
 color: #2a2a2a; font-family: "Asap", Helvetica, sans-serif; font-size: 16px;
 line-height: 150%; text-align: center; padding-top:9px; padding-right: 18px;
 padding-bottom: 9px; padding-left: 18px;" valign="top">Not to worry, we got you! Let’s get you a new password.
                                <br></br>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table border="0" cellpadding="0" cellspacing="0" class="mcnButtonBlock" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 min-width:100%;" width="100%">
                  <tbody class="mcnButtonBlockOuter">
                    <tr>
                      <td align="center" class="mcnButtonBlockInner" style="mso-line-height-rule:
 exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 padding-top:18px; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" class="mcnButtonBlock" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width:100%;" width="100%">
                          <tbody class="mcnButtonBlockOuter">
                            <tr>
                              <td align="center" class="mcnButtonBlockInner" style="mso-line-height-rule:
 exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top">
                                <table border="0" cellpadding="0" cellspacing="0" class="mcnButtonContentContainer" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 border-collapse: separate !important;border-radius: 48px;">
                                  <tbody>
                                    <tr>
                                      <td align="center" class="mcnButtonContent" style="mso-line-height-rule:
 exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;
 font-family: "Asap", Helvetica, sans-serif; font-size: 16px; padding-top:24px;
 padding-right:48px; padding-bottom:24px; padding-left:48px;" valign="middle">
                                        <div class="text-center">Your New Password is <b><span style="color:red;">'.$password.'</span><b/></div>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table border="0" cellpadding="0" cellspacing="0" class="mcnImageBlock" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width:100%;" width="100%">
                  <tbody class="mcnImageBlockOuter">
                    <tr>
                      <td class="mcnImageBlockInner" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding:0px" valign="top">
                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="border-collapse: collapse; mso-table-lspace: 0;
 mso-table-rspace: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust:
 100%; min-width:100%;" width="100%">
                          <tbody>
                            <tr>
                              <td class="mcnImageContent" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-right: 0px;
 padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;" valign="top"></td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <td id="templateFooter" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #fed149;
 border-top: 0; border-bottom: 0; padding-top: 8px; padding-bottom: 80px" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" class="mcnTextBlock" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width:100%;" width="100%">
                  <tbody class="mcnTextBlockOuter">
                    <tr>
                      <td class="mcnTextBlockInner" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%" valign="top">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width:100%;" width="100%">
                          <tbody>
                            <tr>
                              <td style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%; padding-top: 24px; padding-right: 18px;
 padding-bottom: 24px; padding-left: 18px; color: #7F6925; font-family: "Asap",
 Helvetica, sans-serif; font-size: 12px;" valign="top">
                                <div style="text-align: center;">Made with
                                  <a href="#" style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%; color: #f57153; font-weight: normal; text-decoration:
 none" target="_blank">
                                    <img align="none" alt="Heart icon" height="10" src="https://static.lingoapp.com/assets/images/email/made-with-heart.png" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none;
 text-decoration: none; width: 10px; height: 10px; margin: 0px;" width="10" />
                                  </a>by
                                  <a href="#" style="mso-line-height-rule: exactly;
 -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #f57153;
 font-weight: normal; text-decoration: none; color:#7F6925;" target="_blank" title="Smartbazaar - Your Everyday needs">Smartbazaar</a> in Howrah</div>
                              </td>
                            </tr>
                            <tbody></tbody>
                          </tbody>
                        </table>
                        <table align="center" border="0" cellpadding="12" style="border-collapse:
 collapse; mso-table-lspace: 0; mso-table-rspace: 0; -ms-text-size-adjust:
 100%; -webkit-text-size-adjust: 100%; ">
                          <tbody>
                            <tr>
                              <td style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%">
                                <a href="https://twitter.com/smartbazaar" style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%; color: #f57153; font-weight: normal; text-decoration: none" target="_blank">
                                  <img alt="twitter" height="32" src="https://static.lingoapp.com/assets/images/email/twitter-ic-32x32-email@2x.png" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none; text-decoration:
 none" width="32" />
                                </a>
                              </td>
                              <td style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%">
                                <a href="https://www.instagram.com/smartbazaar/" style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%; color: #f57153; font-weight: normal; text-decoration:
 none" target="_blank">
                                  <img alt="Instagram" height="32" src="https://static.lingoapp.com/assets/images/email/instagram-ic-32x32-email@2x.png" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none;
 text-decoration: none" width="32" />
                                </a>
                              </td>
                              <td style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%">
                                <a href="https://medium.com/smartbazaar" style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%; color: #f57153; font-weight: normal; text-decoration: none" target="_blank">
                                  <img alt="medium" height="32" src="https://static.lingoapp.com/assets/images/email/medium-ic-32x32-email@2x.png" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none; text-decoration: none" width="32" />
                                </a>
                              </td>
                              <td style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%">
                                <a href="https://www.facebook.com/smartbazaar/" style="mso-line-height-rule: exactly; -ms-text-size-adjust: 100%;
 -webkit-text-size-adjust: 100%; color: #f57153; font-weight: normal; text-decoration: none" target="_blank">
                                  <img alt="facebook" height="32" src="https://static.lingoapp.com/assets/images/email/facebook-ic-32x32-email@2x.png" style="-ms-interpolation-mode: bicubic; border: 0; height: auto; outline: none;
 text-decoration: none" width="32" />
                                </a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </table>
          <!--[if gte mso 9]>
                  </td>
                </tr>
              </table>
            <![endif]-->
          <!-- // END TEMPLATE -->
        </td>
      </tr>
    </table>
  </center>
</body>

</html>';  
				$this->email->from('nil2take1@gmail.com', 'Smartbazaar Admin');
				$this->email->to($previousEmail);
				
				$this->email->subject('Request for Resetting Password');
				$this->email->message($emailContent);
				$this->email->send();
				$result['success'] = 1;
				$result['error'] = 0;
			}
			else{
				$result['success'] = 0;
				$result['error'] = 1;
				$result['errmsg'] = 'This email is not registered with us,please try again';
			}
			echo json_encode($result);exit(0);
		}
	}

	/* Function for showing user profile page */
	public function userprofile(){
		$data = array();
		$useremail = $this->session->userdata('user_email');
		if(isset($useremail) && !empty($useremail)){
			$data['profiledata'] = $this->frontend_model->prevuserdata($useremail);
			$this->load->frontendtemplate('frontend/userprofile', $data);
		}
		else{
			redirect(base_url());
		}
		
	}

	/* Function for temporarily blocking user profile */
	public function blockprofile(){
		$useremail = $this->session->userdata('user_email');
		if(isset($useremail) && !empty($useremail)){
			$blockstatus = $this->frontend_model->blockprofile($useremail);	
			if($blockstatus == 1){
				$this->session->unset_userdata('user_email');
				$this->load->frontendtemplate('frontend/profileblocked');
			}
		}
	}

	/* Function for editing user profile */
	public function edituserprofile(){
		$data = array();
		$profileData = array();
		$result = array();
		$emailContent = '';
		$passLength = 0;
		$useremail = $this->session->userdata('user_email');
		if($this->input->is_ajax_request()){
			$data = $this->input->post();
			$passLength = strlen($data['upass']);
			if($passLength < 60){
				$profileData = array(
					'username' => $data['uname'],
					'email' => $data['uemail'],
					'password' => password_hash($data['upass'],PASSWORD_DEFAULT),
					'mobile_no' => $data['umobile']
				);
			}
			else{
				$profileData = array(
					'username' => $data['uname'],
					'email' => $data['uemail'],
					'password' => $data['upass'],
					'mobile_no' => $data['umobile']
				);
			}

			$updateStatus = $this->frontend_model->updateuserprofile($useremail, $profileData);
			
			if($updateStatus == '1'){
				// email notifying user about profile update
				$emailContent = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0;">
 	<meta name="format-detection" content="telephone=no"/>

	<!-- Responsive Mobile-First Email Template by Konstantin Savchenko, 2015.
	https://github.com/konsav/email-templates/  -->

	<style>
/* Reset styles */ 
body { margin: 0; padding: 0; min-width: 100%; width: 100% !important; height: 100% !important;}
body, table, td, div, p, a { -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; }
table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse !important; border-spacing: 0; }
img { border: 0; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
#outlook a { padding: 0; }
.ReadMsgBody { width: 100%; } .ExternalClass { width: 100%; }
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }

/* Rounded corners for advanced mail clients only */ 
@media all and (min-width: 560px) {
	.container { border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; -khtml-border-radius: 8px;}
}

/* Set color for auto links (addresses, dates, etc.) */ 
a, a:hover {
	color: #127DB3;
}
.footer a, .footer a:hover {
	color: #999999;
}

 	</style>

	<!-- MESSAGE SUBJECT -->
	<title>Get this responsive email template</title>

</head>

<!-- BODY -->
<!-- Set message background color (twice) and text color (twice) -->
<body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
	background-color: #F0F0F0;
	color: #000000;"
	bgcolor="#F0F0F0"
	text="#000000">

<!-- SECTION / BACKGROUND -->
<!-- Set message background color one again -->
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background"><tr><td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
	bgcolor="#F0F0F0">

<!-- WRAPPER -->
<!-- Set wrapper width (twice) -->
<table border="0" cellpadding="0" cellspacing="0" align="center"
	width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
	max-width: 560px;" class="wrapper">

	<tr>
		<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 20px;
			padding-bottom: 20px;">

			<!-- PREHEADER -->
			<!-- Set text color to background color -->
			<div style="display: none; visibility: hidden; overflow: hidden; opacity: 0; font-size: 1px; line-height: 1px; height: 0; max-height: 0; max-width: 0;
			color: #F0F0F0;" class="preheader">
				Available on&nbsp;GitHub and&nbsp;CodePen. Highly compatible. Designer friendly. More than 50%&nbsp;of&nbsp;total email opens occurred on&nbsp;a&nbsp;mobile device&nbsp;— a&nbsp;mobile-friendly design is&nbsp;a&nbsp;must for&nbsp;email campaigns.</div>

			<!-- LOGO -->
			<!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2. URL format: http://domain.com/?utm_source={{Campaign-Source}}&utm_medium=email&utm_content=logo&utm_campaign={{Campaign-Name}} -->
			<a target="_blank" style="text-decoration: none;"
				href="https://github.com/konsav/email-templates/"><img border="0" vspace="0" hspace="0"
				src="https://raw.githubusercontent.com/konsav/email-templates/master/images/logo-black.png"
				width="100" height="30"
				alt="Logo" title="Logo" style="
				color: #000000;
				font-size: 10px; margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;" /></a>

		</td>
	</tr>

<!-- End of WRAPPER -->
</table>

<!-- WRAPPER / CONTEINER -->
<!-- Set conteiner background color -->
<table border="0" cellpadding="0" cellspacing="0" align="center"
	bgcolor="#FFFFFF"
	width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
	max-width: 560px;" class="container">

	<!-- HEADER -->
	<!-- Set text color and font family ("sans-serif" or "Georgia, serif") -->
	<tr>
		<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 24px; font-weight: bold; line-height: 130%;
			padding-top: 25px;
			color: #000000;
			font-family: sans-serif;" class="header">
				Profile Details
		</td>
	</tr>
	
	<!-- SUBHEADER -->
	<!-- Set text color and font family ("sans-serif" or "Georgia, serif") -->
	<tr>
		<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-bottom: 3px; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 18px; font-weight: 300; line-height: 150%;
			padding-top: 5px;
			color: #000000;
			font-family: sans-serif;" class="subheader">
				Updated&nbsp;Successfully!!
		</td>
	</tr>

	<!-- HERO IMAGE -->
	<!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2 (wrapper x2). Do not set height for flexible images (including "auto"). URL format: http://domain.com/?utm_source={{Campaign-Source}}&utm_medium=email&utm_content={{Ìmage-Name}}&utm_campaign={{Campaign-Name}} -->
	<tr>
		<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;
			padding-top: 20px;" class="hero"><a target="javascript:void(0);" style="text-decoration: none;"
			href="javascript:void(0);"><img border="0" vspace="0" hspace="0"
			src="https://raw.githubusercontent.com/konsav/email-templates/master/images/hero-wide.png"
			alt="Please enable images to view this content" title="Image"
			width="560" style="
			width: 100%;
			max-width: 560px;
			color: #000000; font-size: 13px; margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;"/></a></td>
	</tr>

	<!-- PARAGRAPH -->
	<!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
	<tr>
		<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
			padding-top: 25px; 
			color: #000000;
			font-family: sans-serif;" class="paragraph">
				If you changed your profile it is ok, but if not then protect your account by clicking the button below to temporarily block your account.
		</td>
	</tr>

	<!-- BUTTON -->
	<!-- Set button background color at TD, link/text color at A and TD, font family ("sans-serif" or "Georgia, serif") at TD. For verification codes add "letter-spacing: 5px;". Link format: http://domain.com/?utm_source={{Campaign-Source}}&utm_medium=email&utm_content={{Button-Name}}&utm_campaign={{Campaign-Name}} -->
	<tr>
		<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 25px;
			padding-bottom: 5px;" class="button"><a
			href="https://github.com/konsav/email-templates/" target="_blank" style="text-decoration: underline;">
				<table border="0" cellpadding="0" cellspacing="0" align="center" style="max-width: 240px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;"><tr><td align="center" valign="middle" style="padding: 12px 24px; margin: 0; text-decoration: underline; border-collapse: collapse; border-spacing: 0; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; -khtml-border-radius: 4px;"
					bgcolor="#E9703E"><a target="_blank" style="text-decoration: underline;
					color: #FFFFFF; font-family: sans-serif; font-size: 17px; font-weight: 400; line-height: 120%;"
					href="http://localhost/smartbazaar/blockprofile">
						Block My Account
					</a>
			</td></tr></table></a>
		</td>
	</tr>

	<!-- LINE -->
	<!-- Set line color -->
	<tr>	
		<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 25px;" class="line"><hr
			color="#E0E0E0" align="center" width="100%" size="1" noshade style="margin: 0; padding: 0;" />
		</td>
	</tr>

	<!-- LIST -->
	<tr>
		<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%;" class="list-item"><table align="center" border="0" cellspacing="0" cellpadding="0" style="width: inherit; margin: 0; padding: 0; border-collapse: collapse; border-spacing: 0;">
		</table></td>
	</tr>

	<!-- LINE -->
	<!-- Set line color -->

	<!-- PARAGRAPH -->
	<!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
	<tr>
		<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
			padding-top: 20px;
			padding-bottom: 25px;
			color: #000000;
			font-family: sans-serif;" class="paragraph">
				Have a&nbsp;question? <a href="mailto:support@ourteam.com" target="_blank" style="color: #127DB3; font-family: sans-serif; font-size: 17px; font-weight: 400; line-height: 160%;">support@smartbazaar.com</a>
		</td>
	</tr>

<!-- End of WRAPPER -->
</table>

<!-- WRAPPER -->
<!-- Set wrapper width (twice) -->
<table border="0" cellpadding="0" cellspacing="0" align="center"
	width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
	max-width: 560px;" class="wrapper">

	<!-- SOCIAL NETWORKS -->
	<!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2 -->
	<tr>
		<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 25px;" class="social-icons"><table
			width="256" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse: collapse; border-spacing: 0; padding: 0;">
			<tr>

				<!-- ICON 1 -->
				<td align="center" valign="middle" style="margin: 0; padding: 0; padding-left: 10px; padding-right: 10px; border-collapse: collapse; border-spacing: 0;"><a target="_blank"
					href="http://www.facebook.com/smartbazaar"
				style="text-decoration: none;"><img border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;
					color: #000000;"
					alt="F" title="Facebook"
					width="44" height="44"
					src="https://raw.githubusercontent.com/konsav/email-templates/master/images/social-icons/facebook.png"></a></td>

				<!-- ICON 2 -->
				<td align="center" valign="middle" style="margin: 0; padding: 0; padding-left: 10px; padding-right: 10px; border-collapse: collapse; border-spacing: 0;"><a target="_blank"
					href="http://www.twitter.com/smartbazaar"
				style="text-decoration: none;"><img border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;
					color: #000000;"
					alt="T" title="Twitter"
					width="44" height="44"
					src="https://raw.githubusercontent.com/konsav/email-templates/master/images/social-icons/twitter.png"></a></td>				

				<!-- ICON 3 -->
				<td align="center" valign="middle" style="margin: 0; padding: 0; padding-left: 10px; padding-right: 10px; border-collapse: collapse; border-spacing: 0;"><a target="_blank"
					href="https://plus.google.com/smartbazaar"
				style="text-decoration: none;"><img border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;
					color: #000000;"
					alt="G" title="Google Plus"
					width="44" height="44"
					src="https://raw.githubusercontent.com/konsav/email-templates/master/images/social-icons/googleplus.png"></a></td>		

				<!-- ICON 4 -->
				<td align="center" valign="middle" style="margin: 0; padding: 0; padding-left: 10px; padding-right: 10px; border-collapse: collapse; border-spacing: 0;"><a target="_blank"
					href="http://www.instagram.com/smartbazaar"
				style="text-decoration: none;"><img border="0" vspace="0" hspace="0" style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;
					color: #000000;"
					alt="I" title="Instagram"
					width="44" height="44"
					src="https://raw.githubusercontent.com/konsav/email-templates/master/images/social-icons/instagram.png"></a></td>

			</tr>
			</table>
		</td>
	</tr>
<!-- End of WRAPPER -->
</table>

<!-- End of SECTION / BACKGROUND -->
</td></tr></table>

</body>
</html>';
				$this->email->from('nil2take1@gmail.com', 'Smartbazaar Admin');
				$this->email->to($useremail);
				
				$this->email->subject('Smartbazaar Profile Updated Successfully');
				$this->email->message($emailContent);
				$this->email->send();
				// end notification
				$result['success'] = 1;
				$result['error'] = 0;
				$result['profilemsg'] = 'Profile updated successfully';
			}
			else{
				$result['success'] = 1;
				$result['error'] = 0;
				$result['profilemsg'] = 'No changes made to profile';
			}
			echo json_encode($result);exit(0);
		}

	}

	/* Function for showing the cart page */
	public function showcart(){
		$postdata = array();
		$postdata['categories'] = $this->frontend_model->categories();
		$this->load->frontendtemplate('frontend/cart', $postdata);
	}

	/* Function for adding items to the cart */
	public function addtocart(){
		//echo "Add To cart";die;
		$postdata = array();
		$data = array();
		$res = array();
		$loggedInUserData = '';
		if($this->input->is_ajax_request()){

			$loggedInUserData = $this->session->userdata('user_email');
			if(isset($loggedInUserData) && !empty($loggedInUserData)){

				$id = $this->input->post('id');
				$name = $this->input->post('name');
				$price = $this->input->post('price');
				$data = array(
	               'id'      => $id,
	               'qty'     => 1,
	               'price'   => $price,
	               'name'    => $name
	            );
				if($this->cart->insert($data)){
					$res['success'] = 1;
					$postdata['categories'] = $this->frontend_model->categories();
					$this->load->frontendtemplate('frontend/cart', $postdata);	
				}
				else{
					$res['error'] = 0;
				}
			}
			else{
				redirect(base_url('login'));
			}
			echo json_encode($res);exit(0);
		}
		
	}

	/* Function for removing specific item from cart */
	public function removeitem(){	
		$res = array();
		$data = array();
		$postdata = array();
		if($this->input->is_ajax_request()){
			$id = $this->input->post('id');
			$postdata['categories'] = $this->frontend_model->categories();
			$data = array(
	            'rowid' => $id,
	            'qty'   => 0
	        );
			if($this->cart->update($data)){
				$res['success'] = 1;
				$res['error'] = 0;
			}
			else{
				$res['success'] = 0;
				$res['error'] = 1;	
			}
			echo json_encode($res);exit(0);
		}
		 
	}

	/* Function for updating cart items */
	public function updatecart(){
		$data = array();
		$quantity = $this->input->post('quantity');
		$rowId = $this->input->post('rowid');
		$i = 0;
		foreach ($rowId as $key => $value) {
			$data = array(
               'rowid' => $value,
               'qty'   => $quantity[$i]
            );

			$this->cart->update($data);
			$i++; 	
		}
		$this->load->frontendtemplate('frontend/cart');
	}

	/* Function for handling checkout process */
	public function checkout(){
		$data = array();
		$postdata = array();
		$useremail = '';
		$loggedInUserdata = array();
		$res = array();
		if($this->input->is_ajax_request()){
			$ids = $this->input->post('product_id');
			$productnames = $this->input->post('product_name');
			$productprices = $this->input->post('product_price');
			$productsubtotals = $this->input->post('subtotal_amount');
			$quantities = $this->input->post('quantity');
			$totalamount = $this->input->post('total_amount');

			$useremail = $this->session->userdata('user_email');
			$loggedInUserdata = $this->frontend_model->prevuserdata($useremail);
			$loggedInUsername = $loggedInUserdata[0]->username;
			$loggedInUserid = $loggedInUserdata[0]->id;

			$data['product_id'] = implode(',', $ids);
			$data['product_name'] = implode(',', $productnames);
			$data['product_price'] = implode(',', $productprices);
			$data['subtotal_amount'] = implode(',', $productsubtotals);
			$data['quantity'] = implode(',', $quantities);
			$data['total_amount'] = $totalamount;
			$data['user_id'] = $loggedInUserid;
			$data['user_name'] = $loggedInUsername;
			$checkoutStatus = $this->frontend_model->place_order($data);

			if($checkoutStatus){
				$this->cart->destroy();
				$res['success'] = 1;
				$res['error'] = 0;
			}
			else{
				$res['success'] = 0;
				$res['error'] = 1;
			}

			echo json_encode($res);exit(0);
		}


	}

	public function buysuccess(){
		$this->load->frontendtemplate('frontend/buysuccess');
	}

	public function buyitem($id){
		//echo 'BUYING product with id'.$id;die;
		//$CI =& get_instance();
		//$businessEmail = $this->CI->config->item('business');

		


	}	


}