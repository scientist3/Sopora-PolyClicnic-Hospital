<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investigation extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array(
            'dashboard_laboratorist/hospital_activities/investigation_model' 
        ));
        
        if ($this->session->userdata('isLogIn') == false 
            || $this->session->userdata('user_role') != 4 
        ) 
        redirect('login'); 

    }
 
    public function index()
    {
        $data['title'] = display('investigation_report');
        #-------------------------------#
        $data['investigations'] = $this->investigation_model->read();
        $data['content'] = $this->load->view('dashboard_laboratorist/hospital_activities/investigation_view',$data,true);
        $this->load->view('dashboard_laboratorist/main_wrapper',$data);
    } 

    public function form($id = null)
    { 
        /*----------FORM VALIDATION RULES----------*/
        $this->form_validation->set_rules('patient_id', display('patient_id') ,'required|max_length[20]');
        $this->form_validation->set_rules('date', display('date') ,'required|max_length[10]');
        $this->form_validation->set_rules('title', display('title') ,'required|max_length[255]');
        $this->form_validation->set_rules('description', display('description'),'trim');
        $this->form_validation->set_rules('doctor_id', display('doctor_name') ,'max_length[100]');
        $this->form_validation->set_rules('status', display('status') ,'required');
        #-------------------------------#
        //picture upload
        $picture = $this->fileupload->do_upload(
            'assets/images/investigation/',
            'picture'
        ); 
        //if picture is not uploaded
        if ($picture === false) {
            $this->session->set_flashdata('exception', display('invalid_picture'));
        } 
        /*-------------STORE DATA------------*/
        $date = $this->input->post('date');

        $data['investigation'] = (object)$postData = array( 
            'id'          => $this->input->post('id'),
            'patient_id'  => $this->input->post('patient_id'),
            'date'        => date('Y-m-d', strtotime((!empty($date) ? $date : date('Y-m-d')))),
            'title'       => $this->input->post('title'),
            'description' => $this->input->post('description',false),
            'doctor_id'   => $this->input->post('doctor_id'),
            'picture'     => (!empty($picture)?$picture:$this->input->post('old_picture')),
            'status'      => $this->input->post('status')
        );  

        /*-----------CHECK ID -----------*/
        if (empty($id)) {
            /*-----------CREATE A NEW RECORD-----------*/
            if ($this->form_validation->run() === true) { 
                if ($this->investigation_model->create($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('dashboard_laboratorist/hospital_activities/investigation/form');
            } else {
                $data['title'] = display('add_investigation_report');
                $data['doctor_list'] = $this->investigation_model->doctor_list();
                $data['content'] = $this->load->view('dashboard_laboratorist/hospital_activities/investigation_form',$data,true);
                $this->load->view('dashboard_laboratorist/main_wrapper',$data);
            } 

        } else { 
            /*-----------UPDATE A RECORD-----------*/
            if ($this->form_validation->run() === true) { 
                if ($this->investigation_model->update($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('dashboard_laboratorist/hospital_activities/investigation/form/'.$postData['id']);
            } else {
                $data['title'] = display('investigation_report_edit');
                $data['investigation'] = $this->investigation_model->read_by_id($id);
                $data['doctor_list'] = $this->investigation_model->doctor_list();
                $data['content'] = $this->load->view('dashboard_laboratorist/hospital_activities/investigation_form',$data,true);
                $this->load->view('dashboard_laboratorist/main_wrapper',$data);
            } 
        } 
        /*---------------------------------*/
    }
 
    public function details($id = null)
    {
        $data['title'] = display('investigation_report');
        #-------------------------------#
        $data['details'] = $this->investigation_model->read_by_id($id);
        $data['content'] = $this->load->view('dashboard_laboratorist/hospital_activities/details', $data, true);
        $this->load->view('dashboard_laboratorist/main_wrapper',$data);
    } 


    public function delete($id = null) 
    {
        if ($this->investigation_model->delete($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('dashboard_laboratorist/hospital_activities/investigation');
    }
  
}
