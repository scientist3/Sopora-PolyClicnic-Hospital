<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
            'dashboard_doctor/mail/setting_model' 
		));
        $this->load->library(array('email'));
         
        if ($this->session->userdata('isLogIn') == false
            || $this->session->userdata('user_role') != 2) 
            redirect('login'); 
	}


    public function index()
    {  
        $data['title'] = display('send_mail'); 
        /*----------VALIDATION RULES----------*/
        $this->form_validation->set_rules('to', display('receiver_name') ,'required|max_length[255]');
        $this->form_validation->set_rules('subject', display('subject'),'required|max_length[255]');
        $this->form_validation->set_rules('message', display('message'),'required|trim');
        /*-------------STORE DATA------------*/
        $data['email'] = (object)$postData = array( 
            'from'        => $this->session->userdata('email'),
            'to'          => $this->input->post('to'),
            'subject'     => $this->input->post('subject'),
            'message'     => $this->input->post('message'),
            'hidden_attach_file' => $this->input->post('hidden_attach_file'),
        );  
        /*-----------CREATE A NEW RECORD-----------*/
        if ($this->form_validation->run() === true) { 

            $setting = $this->setting_model->read();
            /* --------INITIAL CONFIG---------*/
            $this->email->initialize(array(
                'protocol' => (!empty($setting->protocol) ? $setting->protocol : 'sendmail '),
                'mailpath' => (!empty($setting->mailpath) ? $setting->mailpath : '/usr/sbin/sendmail'),
                'mailtype' => (!empty($setting->mailtype) ? $setting->mailtype : 'html'),
                'validate_email' => (!empty($setting->validate_email) ? $setting->validate_email : false),
                'wordwrap' => (!empty($setting->wordwrap) ? $setting->wordwrap : true),
            )); 

            $this->email->to($postData['to']);
            $this->email->from($postData['from']);
            $this->email->subject($postData['subject']);
            $this->email->message($postData['message']);
            if (!empty($postData['hidden_attach_file'])) {
                $this->email->attach(base_url($postData['hidden_attach_file']));
            }  

            if ($this->email->send()) {
                #set success message
                $this->session->set_flashdata('message', display('message_sent'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception',display('please_try_again'));
            }
            redirect('dashboard_doctor/mail/email');
        } else {
            $data['content'] = $this->load->view('dashboard_doctor/mail/email',$data,true);
            $this->load->view('dashboard_doctor/main_wrapper',$data);
        }  
    } 


    public function do_upload()
    {
        ini_set('memory_limit', '200M');
        ini_set('upload_max_filesize', '200M');  
        ini_set('post_max_size', '200M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        if (($_SERVER['REQUEST_METHOD']) == "POST") { 
            $filename = $_FILES['attach_file']['name'];
            $filename = strstr($filename, '.', true);
            $email    = $this->session->userdata('email');
            $filename = strstr($email, '@', true)."_".$filename;
            $filename = strtolower($filename);
            /*-----------------------------*/

            $config['upload_path']   = FCPATH .'./assets/attachments/';
            $config['allowed_types'] = 'jpg|jpe|jpeg|bmp|gif|png|pdf|zip|rar|doc|docx|txt|text|csv|xls|xlsx|ppt|pptx|gz|gzip|tar|';
            $config['max_size']      = 0;
            $config['max_width']     = 0;
            $config['max_height']    = 0;
            $config['file_ext_tolower'] = true; 
            $config['file_name']     =  $filename;
            $config['overwrite']     = false;

            $this->load->library('upload', $config);

            $name = 'attach_file';
            if ( ! $this->upload->do_upload($name) ) {
                $data['exception'] = $this->upload->display_errors();
                $data['status'] = false;
                echo json_encode($data);
            } else {
                $upload =  $this->upload->data();
                $data['message'] = display('upload_successfully');
                $data['filepath'] = './assets/attachments/'.$upload['file_name'];
                $data['status'] = true;
                echo json_encode($data);
            }
        }  

    } 
}
