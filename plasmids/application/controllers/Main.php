<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller {
 
	function __construct()
	{
	        parent::__construct();
	 
	        $this->load->library('grocery_CRUD'); 
	}
	 

	

	public function index()
	// eventually, put login and then links to tables here

	{

	if (!$this->ion_auth->logged_in())
			{
    			redirect('auth/login');
			}


	redirect('main/plasmids');
	
	}



	public function plasmids()

	{

		if (!$this->ion_auth->logged_in())
			{
    			redirect('auth/login');
			}

		// get info from mysql table to make the CRUD

		// get user info

		$ia_user = $this->ion_auth->user()->row()->username;
		$ia_group = $this->ion_auth->get_users_groups()->row()->name;
		$crud = new grocery_CRUD();

		switch($ia_group)

		{

		case('admin' || 'members'):
		
		break;


		case('students'):

			$crud->unset_edit();
			$crud->unset_delete();

		break;
		
		case('guests'):

			$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_add();

		break;

		default:

			redirect('auth/login');

		break;

		}



		$crud->set_table('plasmids');
		$crud->set_subject('Plasmid');
		$crud->columns('id', 'name', 'box', 'description');

		$crud->required_fields('name', 'box', 'description', 'source', 'bact_sel');
		$crud->add_fields('name', 'box', 'bact_box', 'benchlink', 'description', 'source', 'comment', 'bact_sel', 'use_for', 'mam_prom', 'lin_asrna', 'asrna_prom', 'lin_srna', 'other_prom', 'added_by',  'added_on');
		$crud->edit_fields('name', 'box', 'bact_box', 'benchlink', 'description', 'source', 'comment', 'bact_sel', 'use_for', 'mam_prom', 'lin_asrna', 'asrna_prom', 'lin_srna', 'other_prom', 'seq_file', 'map_file', 'extra_file', 'modified_by', 'modified_on');
		$crud->display_as('id','Number')
			 ->display_as('box','Plasmid Box')
			 ->display_as('benchlink','Benchling Link')
			 ->display_as('source','Source/Reference')
			 ->display_as('bact_sel','Antibiotic')
			 ->display_as('mam_prom','Expression promoter')
			 ->display_as('lin_asrna','for antisense RNA, linearize with')
			 ->display_as('asrna_prom','antisense RNA promoter')			 
			 ->display_as('lin_srna','for sense RNA, linearize with')
			 ->display_as('other_prom','sense RNA promoter')
			 ->display_as('seq_file','Sequence file (GB/FASTA)')
			 ->display_as('map_file','Plasmid map')
			 ->display_as('extra_file','Additional file')
			 ->display_as('box','Plasmid Box');

		$crud->add_action('Details', base_url().'assets/grocery_crud/themes/flexigrid/css/images/magnifier.png', 'details/showplasmid');

		$crud->set_field_upload('seq_file','assets/uploads/files/plasmids/sequences/');
		$crud->set_field_upload('map_file','assets/uploads/files/plasmids/maps/');
		$crud->set_field_upload('extra_file','assets/uploads/files/plasmids/extras/');

		$crud->field_type('added_by', 'hidden', $ia_user);
		$crud->field_type('modified_by', 'hidden', $ia_user);
		$crud->field_type('added_on', 'hidden', date("Y-m-d"));
		$crud->field_type('modified_on', 'hidden', date("Y-m-d"));


		$crud->unset_read();
		$crud->set_theme('flexigrid');

		$output = $crud->render();

		$uinfo = array('ia_user' => $ia_user,
						'ia_group' => $ia_group,
						'whatisthis' => 'Plasmids',
						'whaticon' => base_url().'assets/grocery_crud/themes/flexigrid/css/images/plasmids.svg',
						);

		$output = array_merge( (array)$output, $uinfo);


		$this->_example_output($output);
	}


	public function oligos()

	{

		if (!$this->ion_auth->logged_in())
			{
    			redirect('auth/login');
			}

		// get info from mysql table to make the CRUD

		// get user info

		$ia_user = $this->ion_auth->user()->row()->username;
		$ia_group = $this->ion_auth->get_users_groups()->row()->name;
		$crud = new grocery_CRUD();

		switch($ia_group)

		{

		case('admin' || 'members'):
		
		break;


		case('students'):

			$crud->unset_edit();
			$crud->unset_delete();

		break;
		
		case('guests'):

			$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_add();

		break;

		default:

			redirect('auth/login');

		break;

		}



		$crud->set_table('oligos');
		$crud->set_subject('Oligo');
		$crud->columns('id', 'name', 'box', 'sequence', 'use_for', 'description');

		$crud->required_fields('id', 'name', 'box', 'sequence');
		$crud->add_fields('name', 'box', 'sequence', 'use_for', 'description', 'target', 'pcr_conditions', 'added_by', 'added_on');
		$crud->edit_fields('name', 'box', 'sequence', 'use_for', 'description', 'target', 'pcr_conditions', 'modified_by', 'modified_on');
		$crud->display_as('id','Number');

		$crud->field_type('added_by', 'hidden', $ia_user);
		$crud->field_type('modified_by', 'hidden', $ia_user);
		$crud->field_type('added_on', 'hidden', date("Y-m-d"));
		$crud->field_type('modified_on', 'hidden', date("Y-m-d"));



			$crud->unset_read();
		$crud->add_action('Details', base_url().'assets/grocery_crud/themes/flexigrid/css/images/magnifier.png', 'details/showoligo');

		$crud->set_theme('flexigrid');

		$output = $crud->render();

		$uinfo = array('ia_user' => $ia_user,
						'ia_group' => $ia_group,
						'whatisthis' => 'Oligos',
						'whaticon' => base_url().'assets/grocery_crud/themes/flexigrid/css/images/oligos.svg',
						);



		$output = array_merge( (array)$output, $uinfo);


		$this->_example_output($output);
	}	


public function _example_output($output = null)
	{
		$this->load->view('template.php',$output);
	}


}
 
/* End of file Main.php */
/* Location: ./application/controllers/Main.php */