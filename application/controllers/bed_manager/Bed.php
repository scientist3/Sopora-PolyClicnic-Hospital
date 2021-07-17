<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bed extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array(
            'bed_manager/bed_model'
        ));
        
        if ($this->session->userdata('isLogIn') == false 
            || $this->session->userdata('user_role') != 1
        ) 
        redirect('login'); 


    }
 
    public function index()
    {
        $data['title'] = display('bed_list');
        #-------------------------------#
        $data['beds'] = $this->bed_model->read();
        $data['content'] = $this->load->view('bed_manager/bed_view',$data,true);
        $this->load->view('layout/main_wrapper',$data);
    } 

    public function form($id = null)
    { 
        /*----------FORM VALIDATION RULES----------*/
        $this->form_validation->set_rules('type', display('bed_type') ,'required|max_length[100]');
        $this->form_validation->set_rules('description', display('description'),'trim');
        $this->form_validation->set_rules('limit', display('bed_limit') ,'required|max_length[100]');
        $this->form_validation->set_rules('charge', display('charge') ,'required|max_length[100]');
        $this->form_validation->set_rules('status', display('status') ,'required');

        /*-------------STORE DATA------------*/
        $data['bed'] = (object)$postData = array( 
            'id'          => $this->input->post('id',true),
            'type'        => $this->input->post('type',true),
            'description' => $this->input->post('description',true),
            'limit'       => $this->input->post('limit',true),
            'charge'      => $this->input->post('charge',true),
            'status'      => $this->input->post('status',true)
        );  

        /*-----------CHECK ID -----------*/
        if (empty($id)) {
            /*-----------CREATE A NEW RECORD-----------*/
            if ($this->form_validation->run() === true) { 
                if ($this->bed_model->create($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('bed_manager/bed/form');
            } else {
                $data['title'] = display('add_bed');
                $data['content'] = $this->load->view('bed_manager/bed_form',$data,true);
                $this->load->view('layout/main_wrapper',$data);
            } 

        } else {
            /*-----------UPDATE A RECORD-----------*/
            if ($this->form_validation->run() === true) { 
                if ($this->bed_model->update($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('bed_manager/bed/form/'.$postData['id']);
            } else {
                $data['title'] = display('bed_edit');
                $data['bed'] = $this->bed_model->read_by_id($id);
                $data['content'] = $this->load->view('bed_manager/bed_form',$data,true);
                $this->load->view('layout/main_wrapper',$data);
            } 
        } 
        /*---------------------------------*/
    }
 

    public function delete($id = null) 
    {
        if ($this->bed_model->delete($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('bed_manager/bed');
    }
  
}
