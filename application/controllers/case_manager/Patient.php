<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'case_manager/patient_model',
			'case_manager/status_model'
		));

		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 1) 
			redirect('login');
	}
 
	public function index()
	{ 
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read();
		$data['content'] = $this->load->view('case_manager/patient',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

	public function form($id = null)
	{
		$data['title'] = display('add_patient');
		#-------------------------------#
		$this->form_validation->set_rules('patient_id', display('patient_id'),'required|max_length[30]');
		$this->form_validation->set_rules('case_manager_id', display('case_manager'),'required|max_length[11]');
		$this->form_validation->set_rules('ref_doctor_id', display('ref_doctor_name'),'max_length[11]');
		$this->form_validation->set_rules('hospital_name', display('hospital_name'),'max_length[255]');
		$this->form_validation->set_rules('doctor_name', display('doctor_name'),'max_length[255]');
		$this->form_validation->set_rules('hospital_address', display('hospital_address'),'max_length[1000]');
		$this->form_validation->set_rules('status', display('status'),'required'); 
		#-------------------------------#
		$data['patient'] = (object)$postData = array(
			'id'   		      => $this->input->post('id'),
			'patient_id'      => (($this->input->get('pid')!=null)?$this->input->get('pid'):$this->input->post('patient_id')),
			'case_manager_id' => $this->input->post('case_manager_id'),
			'ref_doctor_id'   => $this->input->post('ref_doctor_id'),
			'hospital_name'   => $this->input->post('hospital_name'),
			'doctor_name' 	  => $this->input->post('doctor_name'),
			'hospital_address' => $this->input->post('hospital_address'),
			'created_by'      => $this->session->userdata('user_id'),
			'date'            => date("Y-m-d"),
			'status'          => $this->input->post('status'),
		); 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {
				if ($this->patient_model->create($postData)) {
					$patient_id = $this->db->insert_id();
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			} else {
				if ($this->patient_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			}
			redirect('case_manager/patient/form/'.$postData['id']);

		} else {
			$data['case_manager_list'] = $this->patient_model->case_manager_list();
			$data['doctor_list'] = $this->patient_model->doctor_list();
			if ($id != null)
			$data['patient'] = $this->patient_model->read_by_id($id);
			$data['content'] = $this->load->view('case_manager/patient_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}


	public function profile($cm_patient_id = null, $getid = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
        $this->form_validation->set_rules('cm_patient_id', null ,'required|max_length[11]');
        $this->form_validation->set_rules('critical_status', display('status') ,'required');
        $this->form_validation->set_rules('description', display('description'),'required|trim');
        /*-------------STORE DATA------------*/
        $datetime = $this->input->post('datetime');

        $data['status'] = (object)$postData = array( 
            'id'              => $this->input->post('id'),
            'cm_patient_id'   => $this->input->post('cm_patient_id'),
            'description'     => $this->input->post('description'),
            'critical_status' => $this->input->post('critical_status'),
        );
        if ($this->input->post('id') == null) {
        	$postData['datetime'] = date('Y-m-d H:i:s');
        }  

		#-------------------------------#
        if ($this->form_validation->run()) { 

            /*-----------CREATE A NEW RECORD-----------*/
        	if (($this->input->post('id')==null)) {

                if ($this->status_model->create($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
            } else {
                if ($this->status_model->update($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
            }

            redirect("case_manager/patient/profile/$cm_patient_id"); 

        } else { 
			$data['profile'] = $this->patient_model->read_by_id($cm_patient_id);

			if ($getid!=null) {
				$data['status']    = $this->status_model->read_by_id($getid);
			}

			$data['documents'] = $this->patient_model->document($cm_patient_id);
	        $data['statuss'] = $this->status_model->read($cm_patient_id);
			$data['content'] = $this->load->view('case_manager/patient_profile',$data,true);
			$this->load->view('layout/main_wrapper',$data);
        } 
 

	}


	public function delete($id = null) 
	{ 
		if ($this->patient_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('case_manager/patient');
	}


    public function delete_status($id = null) 
    {
        if ($this->status_model->delete($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }


}
