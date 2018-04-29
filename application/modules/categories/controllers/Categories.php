<?php

if (!defined('BASEPATH')) {exit('No direct script access allowed');

}



class Categories extends MX_Controller {

	private $usersessiondata;

	public function __construct() {

		parent::__construct();
		$uemail = $this->session->userdata('useremail');
		if(trim($uemail) == ''){
			redirect('admin');
		}
		$this->load->model('categories/categories_model');
	}

	/*Function for showing list of all categories */
	public function index() {
		$data = array();
		$uemail = $this->session->userdata('useremail');
		$data['categories'] = $this->categories_model->listcategories();
		$this->load->admintemplate('categories/listcategories', $data); 
		 
	}

	/* Function for adding/editing category*/
	public function addcategory(){
		$postdata = array();
        $result = array();
        	if ($this->input->is_ajax_request()) {
	        	$postdata = $this->input->post();

	        	$isprocess = $this->categories_model->addcategory($postdata);
	        	if($isprocess){
	        		$result['success'] = 1;
	        		$result['error'] = 0;
	        		if($postdata['isedit'] == 0){
	        			$this->session->set_flashdata('success', 'Category Added Successfully.');
		        	}
		        	else{
		        		$this->session->set_flashdata('success', 'Category Edited Successfully.');
		        	}
	        		$result['redirecturl'] = base_url() . 'categories';
	        	}
	        	else{
	        		$result['success'] = 0;
	        		$result['error'] = 1;
	        	}
	        	echo json_encode($result);
				exit(0);
        	}

	}

	/* Function for showing a specific category details*/
	public function categorydetails(){
		$cat_details = array();
		$result = array();
    	if($this->input->is_ajax_request()){
			$categoryId = $this->input->post('categoryid');
			$cat_details = $this->categories_model->categorydetails($categoryId);
			if(!empty($cat_details)){
				$result['success'] = 1;
				$result['error'] = 0;
				$result['details'] = $cat_details;
			}  
			else{
				$result['success'] = 0;
				$result['error'] = 1;
			}

			echo json_encode($result);exit(0);
		}

	}

	/* Function for deleting a specific category */
	public function categorydelete(){
		if($this->input->is_ajax_request()){

			$catId = $this->input->post('categoryid');
			$status = $this->categories_model->categorydelete($catId);
			if($status){
				$result['success'] = 1;
				$result['error'] = 0;
				$this->session->set_flashdata('success', 'Category Deleted Successfully.');
				$result['redirecturl'] = base_url() . 'categories';
			}
			else{
				$result['success'] = 0;
				$result['error'] = 1;
			}
			echo json_encode($result);exit(0);
		}
	}


}