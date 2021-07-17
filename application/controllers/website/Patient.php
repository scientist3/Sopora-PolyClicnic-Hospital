<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'website/home_model',
			'website/patient_model'
		));
		
	}
 
	public function create()
	{
		$data['title'] = display('add_patient');
		#-------------------------------#
		$this->form_validation->set_rules('firstname', display('first_name'),'required|max_length[50]');
		$this->form_validation->set_rules('lastname', display('last_name'),'required|max_length[50]');
		$this->form_validation->set_rules('phone', display('phone'),'max_length[20]');
		$this->form_validation->set_rules('mobile', display('mobile'),'required|max_length[20]');
		$this->form_validation->set_rules('blood_group', display('blood_group'),'max_length[10]');
		$this->form_validation->set_rules('sex',  display('sex'),'required|max_length[10]');
		$this->form_validation->set_rules('date_of_birth', display('date_of_birth'),'required|max_length[10]');
		$this->form_validation->set_rules('address', display('address'),'required|max_length[255]');
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
			$data['image_exception'] = display('invalid_picture'); 
		}
		#-------------------------------#
		$postData = [
			'id'   		   => $this->input->post('id'),
			'patient_id'   => "P".$this->tokenGenerator(2,7),
			'firstname'    => $this->input->post('firstname'),
			'lastname' 	   => $this->input->post('lastname'),
			'phone'   	   => $this->input->post('phone'),
			'mobile'       => $this->input->post('mobile'),
			'blood_group'  => $this->input->post('blood_group'),
			'sex' 		   => $this->input->post('sex'),
			'date_of_birth' => date('Y-m-d', strtotime($this->input->post('date_of_birth'))),
			'address' 	   => $this->input->post('address'),
			'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
			'affliate'     => null,
			'create_date'  => date('Y-m-d'),
			'created_by'   => $this->session->userdata('user_id'),
			'status'       => 1,
		]; 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if ($this->patient_model->create($postData)) {
				#set success message 
				$data['message'] = display('registration_successfully');
			} else {
				#set exception message
				$data['exception'] = display('please_try_again'); 
			} 

			redirect('patient_info/' . $postData['patient_id']);

		} else {
			$data['exception'] = validation_errors();
		} 
		$data['p_status'] = 2;
        $this->session->set_flashdata($data);
        redirect($_SERVER['HTTP_REFERER']."#appointment");
	}


	public function profile($patient_id = null)
	{ 
		$data['title'] = display('patient_information');
		#-------------------------------#
        $data['setting'] = $this->home_model->setting();
		$data['profile'] = $this->patient_model->read($patient_id);
        if(empty($data['profile'])) show_404();
		$this->load->view('website/patient_wrapper',$data);
	}


    /*
    |----------------------------------------------
    |        id genaretor
    |----------------------------------------------     
    */
    public function tokenGenerator($mode = null, $len = null){
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
