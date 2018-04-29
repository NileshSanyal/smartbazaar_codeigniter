<?php
	if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Frontend_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/* Function for saving registered users */
	public function registeruser($data = array()){
		$this->db->insert('users', $data); 
        if($this->db->insert_id() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
	}

	public function prevuserdata($pemail = ''){
		$data = array();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $pemail);
		$this->db->where('isblocked',0);
		$email_query = $this->db->get();
		
		if($email_query->num_rows() > 0){
			$data = $email_query->result();
		}

		return $data;
	}

	/* Function for getting registered users email */
	public function prevemails($pemail = ''){
		$status = 0;
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $pemail);
		$email_query = $this->db->get();
		
		if($email_query->num_rows() > 0){
			$status = 1;
		}

		return $status;
	}

	/* Function for showing paginated products */
	public function listproducts($offset = ''){
		$allproducts = array();
        $this->db->where('status', PRODUCT_DISPLAY_STATUS);
        $products_data = $this->db->get('products', 4, $offset);
        if($products_data->num_rows() > 0 ){
            $allproducts = $products_data->result();  
         }
        else{
            $allproducts = array();
         }
         return $allproducts;
	}

	/* Function for counting all products categorywise */
	public function allproductsbycategory($cid = ''){
		$products_data = array();
		$no_record = 0;
        $this->db->where('status', PRODUCT_DISPLAY_STATUS);
        $this->db->where('cid', $cid);
        //$products_data = $this->db->get('products');
        $products_data = $this->db->get('products');
        if($products_data->num_rows() > 0 ){
        	return $products_data->num_rows();
         }
        else{
            return $no_record;
         }
         
	}

	/* Function for showing categorywise products */
	public function productsbycategory($cid = ''){
		$categorywiseproducts = array();
		
		$this->db->where('status', CATEGORY_DISPLAY_STATUS);
		$this->db->where('cid', $cid);
		$query = $this->db->get('products');
		if($query->num_rows() > 0){
			$categorywiseproducts = $query->result();
		}
		return $categorywiseproducts;
	}

	/* Function for showing special 4 products randomly */
	public function specialproducts(){
		$products_data = array();
		$this->db->order_by('rand()');
		$this->db->limit(4);
        $this->db->where('status', PRODUCT_DISPLAY_STATUS);
        $products_data = $this->db->get('products');
        if($products_data->num_rows() > 0 ){
        	$allproducts = $products_data->result(); 
         }
        else{
            return $products_data;
         }
         return $allproducts;
	}

	/* Function for showing categories and subcategories in home page */
	public function categories(){
		$result = array();
		
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('status', CATEGORY_DISPLAY_STATUS);
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			$result = $query->result();
		}
		return $result;
	}

	/* Function for getting specific single product details */
    public function singleproductdetails($productId = ''){
        $productdetails = array();
        $query = $this->db->get_where('products', array('id' => $productId));
        if($query->num_rows() > 0){
            $productdetails = $query->result();    
        }
        return $productdetails;
    }

    /* Function for updating password after forgot password is selected */
    public function updatepassword($email = '',$password = ''){
    	$last_insert_id = 0;
    	$this->db->set('password', $password);
		$this->db->where('email', $email); 
		$this->db->update('users'); 
		if($this->db->affected_rows() > 0)
		{
			$last_insert_id = $this->db->affected_rows();
			return $last_insert_id;
		}
		else
		{
			return $last_insert_id;
		}	
    }

    /* Function for updating profile details */
    public function updateuserprofile($email = '', $data = array()){
    	$last_insert_id = 0;
    	$this->db->set('password', $data['password']);
		$this->db->where('email', $data['email']); 
		$this->db->where('username', $data['username']);
		$this->db->where('mobile_no', $data['mobile_no']);
		$this->db->update('users'); 
		if($this->db->affected_rows() >= 0)
		{
			$last_insert_id = $this->db->affected_rows();
			return $last_insert_id;
		}
		else
		{
			return $last_insert_id;
		}	
    }

    /* Function for blocking user profile temporarily */
    public function blockprofile($uemail = ''){
    	$last_insert_id = 0;
    	$this->db->set('isblocked', 1);
		$this->db->where('email', $uemail); 
		$this->db->update('users'); 
		if($this->db->affected_rows() > 0)
		{
			$last_insert_id = $this->db->affected_rows();
			return $last_insert_id;
		}
		else
		{
			return $last_insert_id;
		}
    }

    /* Function for placing order */
    public function place_order($data = array()){
    	//print_r($data);die;
    	$this->db->insert('orders', $data); 
        if($this->db->insert_id() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

}