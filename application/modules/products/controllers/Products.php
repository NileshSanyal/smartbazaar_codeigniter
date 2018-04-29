<?php
if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Products extends MX_Controller {
	private $usersessiondata;
	public function __construct() {
		parent::__construct();
		$uemail = $this->session->userdata('useremail');
		if(trim($uemail) == ''){
			redirect('admin');
		}
		$this->load->model('products/products_model');
		$this->load->model('categories/categories_model');
	}

	/*Function for showing list of products */
	public function index() {
		$data = array();
		$data['products'] = $this->products_model->listproducts();
		$data['categorynames'] = $this->categories_model->listcategories();
		$this->load->admintemplate('products/listproducts', $data); 
	}

	/* Function for showing a specific product details*/
	public function productdetails(){
		$product_details = array();
		$result = array();
    	if($this->input->is_ajax_request()){
			$productId = $this->input->post('productid');
			$product_details = $this->products_model->productdetails($productId);
			if(!empty($product_details)){
				$result['success'] = 1;
				$result['error'] = 0;
				$result['details'] = $product_details;
			}  
			else{
				$result['success'] = 0;
				$result['error'] = 1;
			}
			echo json_encode($result);exit(0);
		}

	}

	/* Function for adding/editing product */
	public function addproduct(){
		$result = array();
		$data = array();
		$postdata = array();
		$uploadeddata = array();
		if($this->input->is_ajax_request()){

			$postdata = $this->input->post();

			$prodImage = $_FILES['productimage']['name'];

			$data['cid'] = $postdata['productcategory'];
			$data['name'] = $postdata['productname'];
			$data['price'] = $postdata['productprice'];
			$data['description'] = $postdata['productdesc'];
			$data['stock'] = $postdata['productstock'];
			$data['status'] = $postdata['productstatus'];

			$this->form_validation->set_rules('productstock', 'Items In Stock', 'trim|required|integer');

			$this->form_validation->set_rules('productname', 'Product Name', 'trim|required|min_length[5]');

			$this->form_validation->set_rules('productprice', 'Product Price', 'trim|required|numeric');

			$this->form_validation->set_rules('productdesc', 'Product Description', 'trim|required');	

			if($postdata['isedit'] == 0){
				if(!$_FILES['productimage']['name']){
					$this->form_validation->set_rules('productimage', 'Product Image', 'required');
				}

				$data['image'] = $_FILES['productimage']['name'];
			}	

			if($postdata['isedit'] == 1){
				//print_r($postdata);die('---edited data---');

				// no image is selected for upload
				if(empty($_FILES['productimage']['name'])){
					// get previous image name with respecting to product id
					$data['image'] = $this->products_model->productpreviousimage($postdata['productid']);
					
				}
				else{
					// get previous image and then replace that image with new uploaded image
					// also resize image to 300x300 and remove original image after successfully resized
					$data['image'] = $this->products_model->productpreviousimage($postdata['productid']);
					$prevImage = $data['image'][0]->image;
					$data['image'] = $prevImage;
					if(file_exists('./uploads/products/300_300/'. $prevImage)){
						unlink('./uploads/products/300_300/'. $prevImage);
					}

					// start image upload
					$editedimagefilename = $_FILES['productimage']['name']; 
					$editconfig['file_name'] = $editedimagefilename;
					$editconfig['upload_path'] = realpath(FCPATH.'uploads/products/');
					$editconfig['allowed_types'] = 'jpg|jpeg|png';	  
					$editconfig['remove_spaces'] = TRUE;
					$editconfig['encrypt_name'] = TRUE;
					$this->upload->initialize($editconfig);

					if(!$this->upload->do_upload('productimage')){
						$this->session->set_flashdata('error', $this->upload->display_errors());
						$result = array("status"=>false, "message"=>$this->upload->display_errors());
					}
					else{

						$edituploadPath = realpath(FCPATH.'uploads/products/');
						$edituploadeddata = $this->upload->data();
						$data['image'] = $edituploadeddata['file_name'];

						// code for resizing of uploaded image
						$editresize['image_library'] = 'gd2';
						$editresize['source_image'] = './uploads/products/'.$_FILES['productimage']['name'];
						$editresize['new_image'] = $edituploadPath.'/300_300';
						$editresize['maintain_ratio'] = TRUE;
						$editresize['width'] = 300;
						$editresize['height'] = 300;

						$this->image_lib->initialize($editresize);
						$this->image_lib->resize();

						// remove original image and only keep resized image
						if(file_exists('./uploads/products/'. $edituploadeddata['file_name'])){
							unlink('./uploads/products/'. $edituploadeddata['file_name']);
						}

					}
					// end image upload

				}
			}

			if($this->form_validation->run() == FALSE){
				$result = array("status" =>false, "type"=>"verror", "message" =>validation_errors());
				
			}
			else{
			
				if(isset($_FILES['productimage']['name'])){

					// upload start
					$filename = $_FILES['productimage']['name']; 
					$config['file_name'] = $filename;
					$config['upload_path'] = realpath(FCPATH.'uploads/products/');
					$config['allowed_types'] = 'jpg|jpeg|png';	  
					$config['remove_spaces'] = TRUE;
					$config['encrypt_name'] = TRUE;
					$this->upload->initialize($config);

					if(!$this->upload->do_upload('productimage')){
						$this->session->set_flashdata('error', $this->upload->display_errors());
						$result = array("status"=>false, "message"=>$this->upload->display_errors());
					}
					else{
						$uploadPath = realpath(FCPATH.'uploads/products/');
						$uploadeddata = $this->upload->data();
						$data['image'] = $uploadeddata['file_name'];

						// code for resizing of uploaded image
						if(!is_dir($uploadPath.'/300_300'))
						{
							mkdir($uploadPath.'/300_300', 0777, true);
						}
						$resize['image_library'] = 'gd2';
						$resize['source_image'] = './uploads/products/'. $uploadeddata['file_name'];
						$resize['new_image'] = $uploadPath.'/300_300';
						$resize['maintain_ratio'] = TRUE;
						$resize['width'] = 300;
						$resize['height'] = 300;

						$this->image_lib->initialize($resize);
						$this->image_lib->resize();
						// end of resize code

						// remove original image and only keep resized image
						if(file_exists('./uploads/products/'. $uploadeddata['file_name'])){
							unlink('./uploads/products/'. $uploadeddata['file_name']);
						}

					}

				}	
				if($postdata['isedit'] == 0)
				{
					$data['isedit'] = 0;
					$isprocess = $this->products_model->addproduct($data);
					
				}
				else if($postdata['isedit'] == 1)
				{
					$data['isedit'] = 1;
					$data['productid'] = $postdata['productid'];
					// if no image has been chosen for upload
					if(empty($_FILES['productimage']['name'])){
						$data['image'] = $data['image'][0]->image;
					}

					else{
						$data['image'] = $data['image'];
					}

					$isprocess = $this->products_model->addproduct($data);
					
				}

				if($isprocess && $postdata['isedit'] == 0){
					$this->session->set_flashdata('success', 'Product Added Successfully.');
					$result = array("status"=>true, "type"=>"");
				}
				else if($isprocess && $postdata['isedit'] == 1){
					$this->session->set_flashdata('success', 'Product Edited Successfully.');
					$result = array("status"=>true, "type"=>"");
				}
				else{
					$this->session->set_flashdata('error', 'Something is going wrong. Try after some time.');
					$result = array("status"=>false, "type"=>"");
				}
			}

			echo json_encode($result);
			exit(0);
		}
	}

	/* Function for deleting a product */
	public function productdelete(){
		if($this->input->is_ajax_request()){
			$prodImage = '';
			$result = array();
			$prodId = $this->input->post('productid');
			// find product image wrt product id, then delete that image
			$prodImage = $this->products_model->productpreviousimage($prodId);
			$prodImage = $prodImage[0]->image;
			$edituploadPath = realpath(FCPATH.'uploads/products/300_300/');
			if(file_exists('./uploads/products/300_300/'. $prodImage)){
				unlink('./uploads/products/300_300/'. $prodImage);	
			}
			
			$status = $this->products_model->productdelete($prodId);
			if($status){
				$result['success'] = 1;
				$result['error'] = 0;
				$this->session->set_flashdata('success', 'Product Deleted Successfully.');
				$result['redirecturl'] = base_url() . 'products';
			}
			else{
				$result['success'] = 0;
				$result['error'] = 1;
			}
			echo json_encode($result);exit(0);
		}
	}

}