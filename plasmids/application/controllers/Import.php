<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Import extends CI_Controller {
 public $tmptable, $table;
	function __construct()
		{
				parent::__construct();
				$this->load->helper(array('form', 'url'));
				$this->load->database();
				$this->load->model('csv_model');
		}
		
		
	public function index() {
		 
		
		if (!$this->ion_auth->is_admin()) {
			
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			
		$this->table = htmlspecialchars($_GET["table"]);
		$this->tmptable = 'tmp_' . $this->table;
		
		if ($this->table == 'plasmids' || $this->table == 'oligos') {
			

		$data['ia_user'] = $this->ion_auth->user()->row()->username;
		$data['table'] = $this->table;
		
		$this->load->view('import_view.php', $data);
		
		} else {
			$this->session->set_flashdata('message', 'Not allowed.');
			redirect('main');
		}
			
	}	
		


	public function check_csv() {
		
		
		if (!$this->ion_auth->is_admin()) {
			
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			
			$this->table = htmlspecialchars($_GET["table"]);
			$this->tmptable = 'tmp_' . $this->table;
			
		if ($this->table == 'plasmids' || $this->table == 'oligos') {			
		
			$this->csv_model->flush_tmp($this->tmptable);
			
			// get input file from POST
			
			$input_file = $_FILES['fileToUpload']['tmp_name'];
			
			
			// import csv to array
			
			$this->load->library('csvimport');
			
			$csvdata = $this->csvimport->get_array($input_file);
			
			
			// write csv data to temporary table
			
			$this->csv_model->insert_tmp($this->tmptable, $csvdata);
			
			
			// load view and display contents of tmp table
			
			
			$udata = [
						'result' => $this->csv_model->get_tmp($this->tmptable),
						'fields' => $this->csv_model->get_fields($this->tmptable),
						'table' => $this->table,
						'ia_user' => $this->ion_auth->user()->row()->username,
						];
						
			$this->load->view('import_check.php', $udata);
			
			
		} else {
			$this->session->set_flashdata('message', 'Not allowed.');
			redirect('main');
		}
			
		}		
		
		
		
	function insert_csv() {
			
		$this->table = htmlspecialchars($_GET["table"]);
		$this->tmptable = 'tmp_' . $this->table;
		
		if ($this->table == 'plasmids' || $this->table == 'oligos') {		
		
			// insert into database
			$this->csv_model->insert_csv($this->table, $this->tmptable);
					
			// load view
			
			$udata = array(
									'fields' => $this->csv_model->get_fields($this->table),
									'result' => $this->csv_model->get_written_rows($this->table),
									'table' => $this->table,
									'ia_user' => $this->ion_auth->user()->row()->username,
									);
			
			$this->load->view('import_success', $udata);
		
		} else {
			$this->session->set_flashdata('message', 'Not allowed.');
			redirect('main');
		}
	}
	

}