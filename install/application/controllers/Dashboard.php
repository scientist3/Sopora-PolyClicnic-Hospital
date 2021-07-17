<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'dashboard_model',
            'setting_model'
        )); 
    }
 
    public function index()
    {
   /// echo("hello");exit;
        // redirect to dashboard home page
        if($this->session->userdata('isLogIn')) 
        $this->redirectTo($this->session->userdata('user_role'));

        $this->form_validation->set_rules('email', display('email'),'required|max_length[50]|valid_email');
        $this->form_validation->set_rules('password', display('password'),'required|max_length[32]|md5');
        $this->form_validation->set_rules('user_role',display('user_role'),'required');
        #-------------------------------#
        $setting = $this->setting_model->read();
        $data['title']   = (!empty($setting->title)?$setting->title:null);
        $data['logo']    = (!empty($setting->logo)?$setting->logo:null); 
        $data['favicon'] = (!empty($setting->favicon)?$setting->favicon:null); 
        $data['footer_text'] = (!empty($setting->footer_text)?$setting->footer_text:null); 

        $data['user'] = (object)$postData = [
            'email'     => $this->input->post('email',true),
            'password'  => md5($this->input->post('password',true)),
            'user_role' => $this->input->post('user_role',true),
        ]; 
        #-------------------------------#
        if ($this->form_validation->run() === true) {
            //check user data
            $check_user = $this->dashboard_model->check_user($postData); 

            if ($postData['user_role'] == 10) {
                $check_user = $this->dashboard_model->check_patient($postData); 
            } else {
                $check_user = $this->dashboard_model->check_user($postData); 
            }

            if ($check_user->num_rows() === 1) {
                //retrive setting data and store to session

                //store data in session
                $this->session->set_userdata([
                    'isLogIn'   => true,
                    'user_id' => (($postData['user_role']==10)?$check_user->row()->id:$check_user->row()->user_id),
                    'patient_id' => (($postData['user_role']==10)?$check_user->row()->patient_id:null),
                    'email'     => $check_user->row()->email,
                    'fullname'  => $check_user->row()->firstname.' '.$check_user->row()->lastname,
                    'user_role' => (($postData['user_role']==10)?10:$check_user->row()->user_role),
                    'picture'   => $check_user->row()->picture, 
                    'title'     => (!empty($setting->title)?$setting->title:null),
                    'address'   => (!empty($setting->description)?$setting->description:null),
                    'logo'      => (!empty($setting->logo)?$setting->logo:null),
                    'favicon'      => (!empty($setting->favicon)?$setting->favicon:null),
                    'footer_text' => (!empty($setting->footer_text)?$setting->footer_text:null),
                ]);

                //redirect to dashboard home page
                $this->redirectTo($postData['user_role']);

            } else {
                #set exception message
                $this->session->set_flashdata('exception',display('incorrect_email_password'));
                //redirect to login form
                redirect('login');
            }

        } else {
            $this->load->view('layout/login_wrapper',$data);
        } 
    }  


    public function redirectTo($user_role = null)
    {
        //redirect to dashboard/home page
        switch ($user_role) {
            case 1:
                    redirect('dashboard/home');
                break; 
            case 2:
                    redirect('dashboard_doctor/home');
                break;  
            case 3:
                    redirect('dashboard_accountant/home');
                break; 
            case 4:
                    redirect('dashboard_laboratorist/home');
                break;  
            case 5:
                    redirect('dashboard_nurse/home');
                break; 
            case 6:
                    redirect('dashboard_pharmacist/home');
                break;  
            case 7:
                    redirect('dashboard_receptionist/home');
                break;  
            case 8:
                    redirect('dashboard_representative/home');
                break;
            case 9:
                    redirect('dashboard_case_manager/home');
                break; 
            case 10:
                    redirect('dashboard_patient/home');
                break; 
            //if $user_role is not set 
            //then redirect to login
            default: 
                    redirect('login');
                break;
        }        
    }


    public function home()
    {    
        if ($this->session->userdata('isLogIn') == false
            || $this->session->userdata('user_role') != 1)
        redirect('login');  

        $data['title'] = display('home');
        #------------------------------#
        $data['notify']   = $this->dashboard_model->notify(); 
        $data['enquires'] = $this->dashboard_model->enquiry();  
        $data['chart']    = $this->dashboard_model->chart();    
        $data['content']  = $this->load->view('home',$data,true);
        $this->load->view('layout/main_wrapper',$data);
    } 

    public function profile()
    {  
        $data['title'] = display('profile');
        #------------------------------# 
        $user_id = $this->session->userdata('user_id');
        $data['user']    = $this->dashboard_model->profile($user_id);
        $data['content'] = $this->load->view('profile', $data, true);
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


    public function form()
    {
        $data['title'] = display('edit_profile');
        $user_id = $this->session->userdata('user_id');
        #-------------------------------#
        $this->form_validation->set_rules('firstname', display('first_name') ,'required|max_length[50]');
        $this->form_validation->set_rules('lastname', display('last_name'),'required|max_length[50]');

        $this->form_validation->set_rules('email',display('email'), "required|max_length[50]|valid_email|callback_email_check[$user_id]");

        $this->form_validation->set_rules('password', display('password'),'required|max_length[32]|md5');

        $this->form_validation->set_rules('phone', display('phone') ,'max_length[20]');
        $this->form_validation->set_rules('mobile', display('mobile'),'required|max_length[20]');
        $this->form_validation->set_rules('blood_group', display('blood_group'),'max_length[10]');
        $this->form_validation->set_rules('sex', display('sex'),'required|max_length[10]');
        $this->form_validation->set_rules('date_of_birth', display('date_of_birth'),'max_length[10]');
        $this->form_validation->set_rules('address',display('address'),'required|max_length[255]');
        $this->form_validation->set_rules('status',display('status'),'required');
        #-------------------------------#
        //picture upload
        $picture = $this->fileupload->do_upload(
            'assets/images/doctor/',
            'picture'
        );
        // if picture is uploaded then resize the picture
        if ($picture !== false && $picture != null) {
            $this->fileupload->do_resize(
                $picture, 
                293,
                350
            );
        }
        //if picture is not uploaded
        if ($picture === false) {
            $this->session->set_flashdata('exception', display('invalid_picture'));
        }
        #-------------------------------# 
        $data['doctor'] = (object)$postData = [
            'user_id'      => $this->input->post('user_id',true),
            'firstname'    => $this->input->post('firstname',true),
            'lastname'     => $this->input->post('lastname',true),
            'designation'  => $this->input->post('designation',true),
            'department_id' => $this->input->post('department_id',true),
            'address'      => $this->input->post('address',true),
            'phone'        => $this->input->post('phone',true),
            'mobile'       => $this->input->post('mobile',true),
            'email'        => $this->input->post('email',true),
            'password'     => md5($this->input->post('password',true)),
            'short_biography' => $this->input->post('short_biography',true),
            'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
            'specialist'   => $this->input->post('specialist',true),
            'date_of_birth' => date('Y-m-d', strtotime($this->input->post('date_of_birth',true))),
            'sex'          => $this->input->post('sex',true),
            'blood_group'  => $this->input->post('blood_group',true),
            'degree'       => $this->input->post('degree',true),
            'created_by'   => $this->session->userdata('user_id'),
            'create_date'  => date('Y-m-d'),
            'status'       => $this->input->post('status',true),
        ]; 
        #-------------------------------#
        if ($this->form_validation->run() === true) {

            if ($this->dashboard_model->update($postData)) {
                #set success message
                $this->session->set_flashdata('message',display('update_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception', display('please_try_again'));
            }

            //update profile picture
            if ($postData['user_id'] == $this->session->userdata('user_id')) {                  
                $this->session->set_userdata([
                    'picture'   => $postData['picture'],
                    'fullname'  => $postData['firstname'].' '.$postData['lastname']
                ]); 
            }
            
            redirect('dashboard/form/');

        } else {
            $user_id = $this->session->userdata('user_id');
            $data['doctor'] = $this->dashboard_model->profile($user_id); 
            $data['content'] = $this->load->view('profile_form',$data,true);
            $this->load->view('layout/main_wrapper',$data);
        } 
    }
 



    public function logout()
    {   
        $this->session->sess_destroy(); 
        redirect('login');
    } 
 
}
