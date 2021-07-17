<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicine extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
            'dashboard_pharmacist/hospital_activities/medicine_model',
			'dashboard_pharmacist/hospital_activities/category_model'
		));
        
        if ($this->session->userdata('isLogIn') == false 
            || $this->session->userdata('user_role') != 6
        ) 
        redirect('login'); 

	}
 
	public function index()
	{ 
		$data['title'] = display('medicine_list');  ;
		$data['medicines'] = $this->medicine_model->read();
		$data['content'] = $this->load->view('dashboard_pharmacist/hospital_activities/medicine_view',$data,true);
		$this->load->view('dashboard_pharmacist/main_wrapper',$data);
	} 
 

	public function details($id = null)
	{   
		$data['title'] = display('medicine_list');
		#-------------------------------#
        $medicine = $this->medicine_model->read_by_id($id);

        $description = "<ul class=\"list-unstyled\">
                    <li>".display('medicine_name')."   : $medicine->name</li>
                    <li>".display('category_name')."   : $medicine->category</li>
                    <li>".display('mrp')."             : ₹$medicine->mrp</li>
                    <li>".display('manufactured_by')." : $medicine->manufactured_by</li> 
                </ul>"
                /* $medicine->description */; 

        $data['details'] = (object) array(
            'title'       => $medicine->name,
            'description' => $description,
            'patient_id'  => null,
            'doctor_name' => null,
            'date'        => null,
        );

		$data['content'] = $this->load->view('dashboard_pharmacist/hospital_activities/details',$data,true);
		$this->load->view('dashboard_pharmacist/main_wrapper',$data);
	} 

    public function form($id = null)
    { 
        /*----------FORM VALIDATION RULES----------*/
        $this->form_validation->set_rules('name', display('medicine_name') ,'required|max_length[255]');
        $this->form_validation->set_rules('category_id', display('category_name') ,'required|max_length[11]');
        $this->form_validation->set_rules('manufactured_by', display('manufactured_by'),'required');
        $this->form_validation->set_rules('batchNo', display('batchNo'),'required');
        $this->form_validation->set_rules('expiry_date', display('expiry_date'),'required');
        $this->form_validation->set_rules('manufac_date', display('manufac_date'),'required');
        $this->form_validation->set_rules('quantity', display('quantity'),'required');
        $this->form_validation->set_rules('mrp', display('mrp'),'required');
        $this->form_validation->set_rules('purchaseValue', display('purchaseValue'),'required');
        
        $this->form_validation->set_rules('status', display('status') ,'required');

        /*-------------STORE DATA------------*/
        $start_date = $this->input->post('start_date');
        $end_date   = $this->input->post('end_date');
        
        // For Bottle And Strip Logic
        $tPstrip=$this->input->post('tabletsPerStrip');
        if($this->input->post('unit')==1){
            $tPstrip=1;
        }

        if($this->input->post('unit')==1)// Bottle
        {
            $total_quantity=$this->input->post('quantity');
        }
        else{                           // Strips
            $tPstrip=$this->input->post('tabletsPerStrip');
            $total_quantity=$this->input->post('quantity')*$this->input->post('tabletsPerStrip');
        }

        $data['medicine'] = (object)$postData = array( 
            'id'          => $this->input->post('id'),
            'name'        => $this->input->post('name'),
            'manufactured_by'       => $this->input->post('manufactured_by'),
            'category_id' => $this->input->post('category_id'),
            'batchNo'     => $this->input->post('batchNo'),
            'expiry_date' => date('Y-m-d',strtotime($this->input->post('expiry_date',true))),
            'manufac_date'=> date('Y-m-d',strtotime($this->input->post('manufac_date',true))),
            'unit'        => $this->input->post('unit'),
            'tabletsPerStrip'        => $tPstrip,

            'quantity'        => $this->input->post('quantity'),
            'total_quantity'  => $total_quantity,
            
            //'description' => $this->input->post('description', false),
            'mrp'       => $this->input->post('mrp'),
            'purchaseValue'       => $this->input->post('purchaseValue'),
            
            'taxPercentage'       => $this->input->post('taxPercentage'),
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
                redirect('dashboard_pharmacist/hospital_activities/medicine/form');
            } else {
                $data['title'] = display('add_medicine');
                $data['category_list'] = $this->category_model->category_list();
                $data['content'] = $this->load->view('dashboard_pharmacist/hospital_activities/medicine_form',$data,true);
                $this->load->view('dashboard_pharmacist/main_wrapper',$data);
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
                redirect('dashboard_pharmacist/hospital_activities/medicine/form/'.$postData['id']);
            } else {
                $data['title'] = display('medicine_edit');
                $data['category_list'] = $this->category_model->category_list();
                $data['medicine'] = $this->medicine_model->read_by_id($id);
                $data['content'] = $this->load->view('dashboard_pharmacist/hospital_activities/medicine_form',$data,true);
                $this->load->view('dashboard_pharmacist/main_wrapper',$data);
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
        redirect('dashboard_pharmacist/hospital_activities/medicine');
    }
  
	
}
