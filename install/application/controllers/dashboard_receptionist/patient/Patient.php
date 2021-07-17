<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_receptionist/patient/patient_model'
		));
 
		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 7) 
			redirect('login'); 
		
	}
 
	public function index()
	{  
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read();
		$data['content'] = $this->load->view('dashboard_receptionist/patient/patient',$data,true);
		$this->load->view('dashboard_receptionist/main_wrapper',$data);
	}

	public function create()
	{
		$data['title'] = display('add_patient');
        $id = $this->input->post('id');
		#-------------------------------#
		$this->form_validation->set_rules('firstname', display('first_name'),'required|max_length[50]');
		$this->form_validation->set_rules('lastname', display('last_name'),'required|max_length[50]');
		$this->form_validation->set_rules('email', display('email'),'required|max_length[100]|is_unique[patient.email]|valid_email');
		$this->form_validation->set_rules('password', display('password'),'required|max_length[32]');
		$this->form_validation->set_rules('phone', display('phone'),'max_length[20]');
		$this->form_validation->set_rules('mobile', display('mobile'),'required|max_length[20]');
		$this->form_validation->set_rules('blood_group', display('blood_group'),'max_length[10]');
		$this->form_validation->set_rules('sex', display('sex'),'required|max_length[10]');
		$this->form_validation->set_rules('date_of_birth', display('date_of_birth'),'required|max_length[10]');
		$this->form_validation->set_rules('address', display('address'),'required|max_length[255]');
		$this->form_validation->set_rules('status', display('status'),'required');
		#-------------------------------#
		//picture upload
		$picture = $this->fileupload->do_upload(
			'assets/images/patient/',
			'picture'
		);
		// if picture is uploaded then resize the picture
		if ($picture !== false && $picture != null) {
			$this->fileupload->do_resize(
				$picture, 
				200,
				150
			);
		}
		//if picture is not uploaded
		if ($picture === false) {
			$this->session->set_flashdata('exception', display('invalid_picture'));
		}  
		#-------------------------------#
		$data['patient'] = (object)$postData = [
			'id'   		   => $this->input->post('id'),
			'patient_id'   => "P".$this->randStrGen(2,7),
			'firstname'    => $this->input->post('firstname'),
			'lastname' 	   => $this->input->post('lastname'),
			'email' 	   => $this->input->post('email'),
			'password' 	   => md5($this->input->post('password')),
			'phone'   	   => $this->input->post('phone'),
			'mobile'       => $this->input->post('mobile'),
			'blood_group'  => $this->input->post('blood_group'),
			'sex' 		   => $this->input->post('sex'), 
			'date_of_birth' => date('Y-m-d', strtotime(($this->input->post('date_of_birth') != null)? $this->input->post('date_of_birth'): date('Y-m-d'))),
			'address' 	   => $this->input->post('address'),
			'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
			'affliate'     => null,
			'create_date'  => date('Y-m-d'),
			'created_by'   => $this->session->userdata('user_id'),
			'status'       => $this->input->post('status'),
		]; 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if ($this->patient_model->create($postData)) {
				$patient_id = $this->db->insert_id();
				#set success message
				$this->session->set_flashdata('message', display('save_successfully'));
			} else {
				#set exception message
				$this->session->set_flashdata('exception', display('please_try_again'));
			}

			redirect('dashboard_receptionist/patient/patient/profile/' . $patient_id);
		

		} else {
			$data['content'] = $this->load->view('dashboard_receptionist/patient/patient_form',$data,true);
			$this->load->view('dashboard_receptionist/main_wrapper',$data);
		} 



	}


	public function profile($patient_id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['content'] = $this->load->view('dashboard_receptionist/patient/patient_profile',$data,true);
		$this->load->view('dashboard_receptionist/main_wrapper',$data);
	}


    /*
    |----------------------------------------------
    |        id genaretor
    |----------------------------------------------     
    */
    public function randStrGen($mode = null, $len = null){
        $result = "";
        if($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 4):
            $chars = "0123456789";
        endif;

        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++) {
                $randItem = array_rand($charArray);
                $result .="".$charArray[$randItem];
        }
        return $result;
    }
    /*
    |----------------------------------------------
    |         Ends of id genaretor
    |----------------------------------------------
    */
}
