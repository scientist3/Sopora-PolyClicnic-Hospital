<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'dashboard_receptionist/account/account_model',
            'dashboard_receptionist/appointment/department_model'
        ));
 
        if ($this->session->userdata('isLogIn') == false
            || $this->session->userdata('user_role') != 7) 
            redirect('login'); 
    }

	public function index(){
		$data['title'] = display('account');
        /* ------------------------------- */
        $data['accounts'] = $this->account_model->read();
        
        $data['content'] =/*"Account Section Of Receptionist"; / /*/ $this->load->view('dashboard_receptionist/account/account',$data,true);
        $this->load->view('dashboard_receptionist/main_wrapper',$data);
	}
	public function create(){
		$data['title'] = display('add_transaction');
		$data['content'] ="Add Transaction"; 
     	$this->load->view('dashboard_receptionist/main_wrapper',$data);   
	}
}