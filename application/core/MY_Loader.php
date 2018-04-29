<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {
	public function frontendtemplate($view_name = false , $data = false)
	{
	  if($data != false)
	  {
		 //$this->load->view("templates/frontend-header");
	  	 $this->load->view("templates/frontend-header", $data);
		 $this->load->view($view_name, $data);
		 $this->load->view("templates/frontend-footer");
	  }
	  else
	  {
	  	 $this->load->view("templates/frontend-header");
		 $this->load->view($view_name);
		 $this->load->view("templates/frontend-footer");
	  }
   }

	public function admintemplate($view_name = false , $data = false)
	{
	  if($data != false)
	  {
		 $this->load->view("templates/admin-header");
		 $this->load->view($view_name, $data);
		 $this->load->view("templates/admin-footer");
	  }
	  else
	  {
	  	
		  $this->load->view("templates/admin-header");
		 $this->load->view($view_name);
		 $this->load->view("templates/admin-footer");
	  }
   }

} 