<?php
	if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Products_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/* Function for showing products */
	public function listproducts(){
		$allproducts = array();
         $this->db->select('*');
            $this->db->from('products');
            $products_data = $this->db->get();
            if($products_data->num_rows() > 0 ){
                $allproducts = $products_data->result();  
             }

        else{
            $allproducts = array();
         }
         return $allproducts;
	}

    /* Function for adding/editing product */
    public function addproduct($data = array()){
        
        $flag = $data['isedit'];    
        unset($data['isedit']);

        if(!empty($data['productid'])){
            $pid = $data['productid'];
            unset($data['productid']);    
        }
        
        if($flag == 0){
            $this->db->insert('products', $data); 
            if($this->db->insert_id() > 0){
                return TRUE;
            }else{
                return FALSE;
            }   
        }
        else{
            $this->db->where('id', $pid);
            $this->db->update('products', $data);
            if($this->db->affected_rows() >= 0){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        
    }

    /* Function for showing specific product details */
    public function productdetails($productId = ''){
        $productdetails = array();
        $query = $this->db->get_where('products', array('id' => $productId));
        if($query->num_rows() > 0){
            $productdetails = $query->result();    
        }
        return $productdetails;
    }

    /* Function for deleting a product */
    public function productdelete($prodId = ''){
        $this->db->where('id', $prodId);
        $this->db->delete('products'); 
        if($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /* Function for getting previous product imagename */
    public function productpreviousimage($prodId = ''){
        $prodImageName = '';
        $this->db->select('image');
        $this->db->from('products');
        $this->db->where('id',$prodId);
        $product_data = $this->db->get();
        if($product_data->num_rows() > 0 ){
            $prodImageName = $product_data->result();  
         }
         return $prodImageName;
    }



}