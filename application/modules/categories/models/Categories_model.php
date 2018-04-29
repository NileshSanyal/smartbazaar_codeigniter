<?php

	if (!defined('BASEPATH')) {exit('No direct script access allowed');

}



class Categories_model extends CI_Model {

	public function __construct() {

		parent::__construct();

	}
 
    /* Function to show all categories */
    public function listcategories(){
         $allcategories = array();
         $this->db->select('*');
            $this->db->from('category');
            $categories_data = $this->db->get();
            if($categories_data->num_rows() > 0 ){
                $allcategories = $categories_data->result();  
             }

        else{
            $allcategories = array();
         }
         return $allcategories;
    }

    /* Function to add/edit category */
    public function addcategory($data = array()){
        $editflag = $data['isedit'];
        $catid = $data['catid'];
        $data = array(
            'cat_name' => $data['catName'],
            'status' => $data['catStatus']
        );
        if($editflag == 0){
            $this->db->insert('category', $data); 
            if($this->db->insert_id() > 0){
                return TRUE;
            }else{
                return FALSE;
            }
        } 
        else{
            $this->db->where('id', $catid);
            $this->db->update('category', $data);
            if($this->db->affected_rows() >= 0){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }

    /* Function for showing specific category details */
    public function categorydetails($catId = ''){
        $catdetails = array();
        $query = $this->db->get_where('category', array('id' => $catId));
        if($query->num_rows() > 0){
            $catdetails = $query->result();    
        }
        return $catdetails;
    }

    /* Function for deleting a category */
    public function categorydelete($catId = ''){
        $this->db->where('id', $catId);
        $this->db->delete('category'); 
        if($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

}