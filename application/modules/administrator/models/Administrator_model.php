<?php

	if (!defined('BASEPATH')) {exit('No direct script access allowed');

}



class Administrator_model extends CI_Model {

	public function __construct() {

		parent::__construct();

	}

    /* Function for verifying admin user's login data */
    public function login($data = array()){
        if (!empty($data)) {
            $this->db->select('password');
            $this->db->where('email', $data['useremail']);
            $getpassword = $this->db->get('admin')->row();
            if ($getpassword != NULL) {
                if (password_verify($data['password'], $getpassword->password)) {
                    return true;
                }
            } 
            else {
                return false;
            }
        } else {
            return false;
        }
    }

	/* Function for storing admin user's data */

	public function register($data = array()){  
		if (!empty($data)) {
                $this->db->insert('admin', $data);
                if ($this->db->affected_rows() != 1) {
                    return 0;
                } else {
                    return 1;
                }
        } else {
            return 0;
        }
	}

}