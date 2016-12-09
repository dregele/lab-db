<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Admin extends CI_Controller {
 
function __construct()
	{
	        parent::__construct();
	 
	        $this->load->library('grocery_CRUD'); 
	}
	 

	public function index() {

			if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('message', 'You must be an admin to view this page');
			redirect('auth/login');
		}

		$crud = new grocery_CRUD();
		
		$crud->set_table('users');

		$crud->columns('id', 'username', 'first_name', 'last_name', 'email', 'last_login', 'active');

		$crud->change_field_type('password_field','password');

		$crud->set_theme('flexigrid');

		$crud->unset_add();

		$output = $crud->render();

		$this->_example_output($output);


	}


public function groups() {

			if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('message', 'You must be an admin to view this page');
			redirect('auth/login');
		}

		$crud = new grocery_CRUD();
		
		$crud->set_table('users_groups');

		$crud->set_theme('flexigrid');

		$output = $crud->render();

		$this->_example_output($output);


	}


public function _example_output($output = null)
	{
		$this->load->view('admin.php',$output);
	}


}



/* End of file Main.php */
/* Location: ./application/controllers/Main.php */