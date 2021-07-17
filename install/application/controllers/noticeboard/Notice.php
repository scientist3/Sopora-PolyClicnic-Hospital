<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'noticeboard/notice_model'
		));

        if ($this->session->userdata('isLogIn') == false 
            || $this->session->userdata('user_role') != 1
        ) 
        redirect('login'); 

	}
 
	public function index()
	{  
		$data['title'] = display('notice_list');  ;
		$data['notices'] = $this->notice_model->read();
		$data['content'] = $this->load->view('noticeboard/view',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 
 

	public function details($notice_id = null)
	{   
		$data['title'] = display('noticeboard');
		#-------------------------------#
		$data['notice'] = $this->notice_model->read_by_id($notice_id);
		$data['content'] = $this->load->view('noticeboard/details',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

    public function form($id = null)
    { 
        /*----------FORM VALIDATION RULES----------*/
        $this->form_validation->set_rules('title', display('title') ,'required|max_length[255]');
        $this->form_validation->set_rules('description', display('description'),'required|trim');
        $this->form_validation->set_rules('start_date', display('start_date') ,'required|max_length[10]');
        $this->form_validation->set_rules('end_date', display('end_date') ,'required|max_length[10]');
        $this->form_validation->set_rules('status', display('status') ,'required');

        /*-------------STORE DATA------------*/
        $start_date = $this->input->post('start_date');
        $end_date   = $this->input->post('end_date');

        $data['notice'] = (object)$postData = array( 
            'id'          => $this->input->post('id'),
            'title'       => $this->input->post('title'),
            'description' => $this->input->post('description', true),
            'start_date'  => date('Y-m-d',strtotime((!empty($start_date) ? $start_date : date("Y-m-d")))),
            'end_date'   => date('Y-m-d',strtotime((!empty($end_date) ? $end_date : date("Y-m-d")))),
            'assign_by'   => $this->session->userdata('user_id'),
            'status'      => $this->input->post('status')
        );  

        /*-----------CHECK ID -----------*/
        if (empty($id)) {
            /*-----------CREATE A NEW RECORD-----------*/
            if ($this->form_validation->run() === true) { 
                if ($this->notice_model->create($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('noticeboard/notice/form');
            } else {
                $data['title'] = display('add_notice');
                $data['content'] = $this->load->view('noticeboard/form',$data,true);
                $this->load->view('layout/main_wrapper',$data);
            } 

        } else {
            /*-----------UPDATE A RECORD-----------*/
            if ($this->form_validation->run() === true) { 
                if ($this->notice_model->update($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('noticeboard/notice/form/'.$postData['id']);
            } else {
                $data['title'] = display('notice_edit');
                $data['notice'] = $this->notice_model->read_by_id($id);
                $data['content'] = $this->load->view('noticeboard/form',$data,true);
                $this->load->view('layout/main_wrapper',$data);
            } 
        } 
        /*---------------------------------*/
    }
 

    public function delete($id = null) 
    {
        if ($this->notice_model->delete($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('noticeboard/notice');
    }
  
	
}
