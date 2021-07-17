<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'human_resources/employee_model'
		));
		
		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1
		) 
		redirect('login');  
	}
 
	public function index($user_role = 'Representative')
	{ 	 
		$data['title'] = display($user_role."_list");
		$role_id     = $this->user_roles($user_role);
		#-------------------------------#
		$data['employees'] = $this->employee_model->read($role_id);
        $data['userRoles'] = $this->user_roles();
		$data['content'] = $this->load->view('human_resources/view', $data, true);
		$this->load->view('layout/main_wrapper',$data);
	} 


    public function email_check($email, $user_id)
    { 
    	$emailExists = $this->db->select('email')
    		->where('email',$email) 
    		->where_not_in('user_id',$user_id) 
    		->get('user')
    		->num_rows();

        if ($emailExists > 0) {
            $this->form_validation->set_message('email_check', 'The {field} field must contain a unique value.');
            return false;
        } else {
            return true;
        }
    }


	public function form($user_id = null)
	{  
		$this->form_validation->set_rules('firstname', display('first_name'),'required|max_length[50]');
		$this->form_validation->set_rules('lastname',display('last_name'),'required|max_length[50]');

		if (!empty($user_id)) {
			$this->form_validation->set_rules('email',display('email'), "required|max_length[50]|valid_email|callback_email_check[$user_id]");
		} else {
			$this->form_validation->set_rules('email',display('email'),'required|max_length[50]|valid_email|callback_email_check');
		}

		$this->form_validation->set_rules('password',display('password'),'required|max_length[32]|md5');
		$this->form_validation->set_rules('mobile',display('mobile'),'required|max_length[20]');
		$this->form_validation->set_rules('sex',display('sex'),'required|max_length[10]');
		$this->form_validation->set_rules('address',display('address'),'required|max_length[255]');
		$this->form_validation->set_rules('status',display('status'),'required');
		#-------------------------------#
		//picture upload
		$picture = $this->fileupload->do_upload(
			'assets/images/human_resources/',
			'picture'
		);
		// if picture is uploaded then resize the picture
		if ($picture !== false && $picture != null) {
			$this->fileupload->do_resize(
				$picture, 
				150,
				150
			);
		}
		//if picture is not uploaded
		if ($picture === false) {
			$this->session->set_flashdata('exception', display('invalid_picture'));
		}
		#-------------------------------#
		//when create a user
		$data['employee'] = (object)$postData = array(
			'user_id'      => $this->input->post('user_id'),
			'firstname'    => $this->input->post('firstname'),
			'lastname' 	   => $this->input->post('lastname'),
			'email' 	   => $this->input->post('email'),
			'password' 	   => md5($this->input->post('password')),
			'mobile'       => $this->input->post('mobile'),
			'sex' 		   => $this->input->post('sex'),
			'address' 	   => $this->input->post('address'),
			'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
			'user_role'    => $this->input->post('user_role'),
			'create_date'  => date('Y-m-d'),
			'created_by'   => $this->session->userdata('user_id'),
			'status'       => $this->input->post('status'),
		); 

        /*-----------CHECK ID -----------*/
        if (empty($user_id)) {

            /*-----------CREATE A NEW RECORD-----------*/
            if ($this->form_validation->run() === true) { 
                if ($this->employee_model->create($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('human_resources/employee/form');
            } else {
            	//view section
				$data['title'] = display('add_employee');
                $data['userRoles'] = $this->user_roles();
                $data['content'] = $this->load->view('human_resources/form',$data,true);
                $this->load->view('layout/main_wrapper',$data);
            } 

        } else {

            /*-----------UPDATE A RECORD-----------*/
            if ($this->form_validation->run() === true) { 
                if ($this->employee_model->update($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('human_resources/employee/form/'.$postData['user_id']);
            } else {
            	//view section
                $data['title'] = display('employee_edit');
                $data['employee'] = $this->employee_model->read_by_id($user_id);
                $data['userRoles'] = $this->user_roles(); 
                $data['content'] = $this->load->view('human_resources/form',$data,true);
                $this->load->view('layout/main_wrapper',$data);
            } 
        } 
        /*---------------------------------*/
	}
 
	public function profile($user_id = null)
	{  
		$data['title'] =  display('employee_information');
		#-------------------------------#
        $data['userRoles'] = $this->user_roles(); 
		$data['profile'] = $this->employee_model->read_by_id($user_id);
		$data['content'] = $this->load->view('human_resources/profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	public function delete($user_id = null, $user_role = null) 
	{		 
		if ($this->employee_model->delete($user_id, $user_role)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function user_roles($user_role = null)
	{
		$user_list = array(
			'Accountant'     => 3,
			'Laboratorist'   => 4,
			'Nurse'          => 5,
			'Pharmacist'     => 6,
			'Receptionist'   => 7,
			'Representative' => 8,
			'Case_manager'   => 9,
		);

		if (!empty($user_role)) {
			$user_role = ucfirst($user_role);
			if (array_key_exists($user_role, $user_list)) {
				return $user_list[$user_role];
			} else {
				return null;
			}			
		} else {
			return array_flip($user_list);
		}

	}	

	//change by user
	public function profile_edit()
	{   
		$user_id       = $this->session->userdata('user_id');
		#-------------------------------#
		$this->form_validation->set_rules('firstname', display('first_name'),'required|max_length[50]');
		$this->form_validation->set_rules('lastname',display('last_name'),'required|max_length[50]');
		$this->form_validation->set_rules('email',display('email'), "required|max_length[50]|valid_email|callback_email_check[$user_id]");
		$this->form_validation->set_rules('password',display('password'),'required|max_length[32]|md5');
		$this->form_validation->set_rules('mobile',display('mobile'),'required|max_length[20]');
		$this->form_validation->set_rules('sex',display('sex'),'required|max_length[10]');
		$this->form_validation->set_rules('address',display('address'),'required|max_length[255]');
		$this->form_validation->set_rules('status',display('status'),'required');
		#-------------------------------#
		//picture upload
		$picture = $this->fileupload->do_upload(
			'assets/images/human_resources/',
			'picture'
		);
		// if picture is uploaded then resize the picture
		if ($picture !== false && $picture != null) {
			$this->fileupload->do_resize(
				$picture, 
				200,
				200
			);
		}
		//if picture is not uploaded
		if ($picture === false) {
			$this->session->set_flashdata('exception', display('invalid_picture'));
		}
		#-------------------------------#
		$data['employee'] = (object)$postData = array(
			'user_id'      => $user_id,
			'firstname'    => $this->input->post('firstname'),
			'lastname' 	   => $this->input->post('lastname'),
			'email' 	   => $this->input->post('email'),
			'password' 	   => md5($this->input->post('password')),
			'mobile'       => $this->input->post('mobile'),
			'sex' 		   => $this->input->post('sex'),
			'address' 	   => $this->input->post('address'),
			'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
		); 
		#-------------------------------#
        if ($this->form_validation->run() === true) { 
            if ($this->employee_model->update($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception',display('please_try_again'));
            }
            redirect('dashboard/profile');
        } else {
        	//view section
            $data['title'] = display('edit_profile');
            $data['employee'] = $this->employee_model->read_by_id($user_id);
            $data['userRoles'] = $this->user_roles(); 
            $data['content'] = $this->load->view('human_resources/profile_edit',$data,true);
            $this->load->view('layout/main_wrapper',$data);
        } 
	}
}

