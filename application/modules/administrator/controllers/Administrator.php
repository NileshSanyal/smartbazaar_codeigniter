<?php

if (!defined('BASEPATH')) {exit('No direct script access allowed');

}

class Administrator extends MX_Controller {

	private $usersessiondata;

	public function __construct() {
		parent::__construct();
		$this->load->model('administrator/administrator_model');
	}

	/*Function for showing sign up page */

	public function index() {

		$this->load->view('administrator/signup'); 

	}

	/* Function for registration */
	public function register(){
		$postdata = array();
		$data = array();
		$uploadeddata = array();
		if($this->input->is_ajax_request())
		{
			$postdata = $this->input->post();
			$this->form_validation->set_rules('fname', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('uemail', 'Email', 'trim|required|valid_email|is_unique[admin.email]');
			$this->form_validation->set_rules('upassword', 'Password', 'trim|required|min_length[5]');
			if($this->form_validation->run() == FALSE)
			{
				$result = array("status" =>false, "type"=>"verror", "message" =>validation_errors());
			}

			else{
				$data['fullname'] = $postdata['fname'];
				$data['email'] = $postdata['uemail'];
				$data['password'] = password_hash($postdata['upassword'], PASSWORD_BCRYPT);
				$isprocess = $this->administrator_model->register($data);
				if($isprocess > 0)
				{
					$this->session->set_userdata('useremail', $data['email']);
					$result = array("status" =>true, "type"=>"", "message" =>"");
				}
			}
			echo json_encode($result);
			exit(0);
		}
	}

	/* Function for login */
	public function login(){
		$postdata = array();
        $result = array();
        if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('useremail', 'Email', 'trim|required|valid_email');
			if($this->form_validation->run() == FALSE)
			{
				$result = array("status" =>false, "type"=>"verror2", "message" =>validation_errors());
			}
			else{
				$postdata = $this->input->post();
				$status = $this->administrator_model->login($postdata);
	            if ($status) {  
	            	$this->session->set_userdata('useremail', $postdata['useremail']);
	                $result['success'] = 1; 
	                $result['error'] = 0;
	            }  
	            else{  
	            	$result['success'] = 0;
		            $result['error'] = 1;
		            $result['errormsg'] = 'Invalid email/password';
	            }
			}
			echo json_encode($result);
			exit(0);
        }
	}

	/* Function for logout */
	public function logout(){
		$this->session->sess_destroy();
        redirect('admin');
	}

   
	/* Function for showing the administrator dashboard page after successful login/registration */
	public function dashboard(){
		$uemail = $this->session->userdata('useremail');
		if(trim($uemail !='')){
			$this->load->admintemplate('administrator/dashboard');
		}
		else{
			redirect('admin');
		}
	}


}