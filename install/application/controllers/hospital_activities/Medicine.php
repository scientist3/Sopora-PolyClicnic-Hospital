<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicine extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
            'hospital_activities/medicine_model',
			'hospital_activities/category_model'
		));
        
        if ($this->session->userdata('isLogIn') == false 
            || $this->session->userdata('user_role') != 1
        ) 
        redirect('login'); 

	}
 
	public function index()
	{ 
		$data['title'] = display('medicine_list');  ;
		$data['medicines'] = $this->medicine_model->read();
		$data['content'] = $this->load->view('hospital_activities/medicine_view',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 
 

	public function details($id = null)
	{   
		$data['title'] = display('medicine_list');
		#-------------------------------#
        $medicine = $this->medicine_model->read_by_id($id);

        $description = "<ul class=\"list-unstyled\">
                    <li>".display('medicine_name')." : $medicine->name</li>
                    <li>".display('category_name')." : $medicine->category</li>
                    <li>".display('price')." : $medicine->price</li>
                    <li>".display('manufactured_by')." : $medicine->manufactured_by</li> 
                </ul>
                $medicine->description"; 

        $data['details'] = (object) array(
            'title'       => $medicine->name,
            'description' => $description,
            'patient_id'  => null,
            'doctor_name' => null,
            'date'        => null,
        );

		$data['content'] = $this->load->view('hospital_activities/details',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

    public function form($id = null)
    { 
        /*----------FORM VALIDATION RULES----------*/
        $this->form_validation->set_rules('name', display('medicine_name') ,'required|max_length[255]');
        $this->form_validation->set_rules('category_id', display('category_name') ,'required|max_length[11]');
        $this->form_validation->set_rules('description', display('description'),'trim');
        $this->form_validation->set_rules('status', display('status') ,'required');

        /*-------------STORE DATA------------*/
        $start_date = $this->input->post('start_date');
        $end_date   = $this->input->post('end_date');

        $data['medicine'] = (object)$postData = array( 
            'id'          => $this->input->post('id'),
            'name'        => $this->input->post('name'),
            'description' => $this->input->post('description', false),
            'category_id' => $this->input->post('category_id'),
            'price'       => $this->input->post('price'),
            'manufactured_by'       => $this->input->post('manufactured_by'),
            'create_date' => date('Y-m-d'),
            'status'      => $this->input->post('status')
        );  

        /*-----------CHECK ID -----------*/
        if (empty($id)) {
            /*-----------CREATE A NEW RECORD-----------*/
            if ($this->form_validation->run() === true) { 
                if ($this->medicine_model->create($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('hospital_activities/medicine/form');
            } else {
                $data['title'] = display('add_medicine');
                $data['category_list'] = $this->category_model->category_list();
                $data['content'] = $this->load->view('hospital_activities/medicine_form',$data,true);
                $this->load->view('layout/main_wrapper',$data);
            } 

        } else {
            /*-----------UPDATE A RECORD-----------*/
            if ($this->form_validation->run() === true) { 
                if ($this->medicine_model->update($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('hospital_activities/medicine/form/'.$postData['id']);
            } else {
                $data['title'] = display('medicine_edit');
                $data['category_list'] = $this->category_model->category_list();
                $data['medicine'] = $this->medicine_model->read_by_id($id);
                $data['content'] = $this->load->view('hospital_activities/medicine_form',$data,true);
                $this->load->view('layout/main_wrapper',$data);
            } 
        } 
        /*---------------------------------*/
    }
 

    public function delete($id = null) 
    {
        if ($this->medicine_model->delete($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('hospital_activities/medicine');
    }
  
	
}
