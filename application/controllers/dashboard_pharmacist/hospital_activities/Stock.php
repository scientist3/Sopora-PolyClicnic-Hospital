<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
            'dashboard_pharmacist/hospital_activities/medicine_model',
			'dashboard_pharmacist/hospital_activities/category_model',
			'dashboard_pharmacist/hospital_activities/stock_model'
		));
        
        if ($this->session->userdata('isLogIn') == false 
            || $this->session->userdata('user_role') != 6
        ) 
        redirect('login'); 

	}

    public function index()
    {          
        $this->purchase();
        /*$data['title'] = display('stock'); 
        //$data['medicines'] = $this->medicine_model->read();         
        $data['content'] =$this->load->view('dashboard_pharmacist/stock/stock_view',$data,true);
        $this->load->view('dashboard_pharmacist/main_wrapper',$data);
        */     
    } 

    public function purchase($id = null) 
    { 
        /*----------FORM VALIDATION RULES----------*/  
        $this->form_validation->set_rules('date',display('date') ,'required');
        $this->form_validation->set_rules('cashType', display('cashType'),'required'); 
        $this->form_validation->set_rules('supplier',display('supplier'),'required');
        $this->form_validation->set_rules('billNo', display('billNo'),'required');
        $this->form_validation->set_rules('itemName',display('itemName'),'required');
        $this->form_validation->set_rules('quantity',display('quantity'),'required');
        $this->form_validation->set_rules('netValue',display('netValue'),'required');
        $this->form_validation->set_rules('status', display('status'),'required');

        // For Bottle And Strip Logic
        $tPstrip=$this->input->post('tabletsPerStrip');
        if($this->input->post('unit')==1){
            $tPstrip=0;
        }

        $data['purchase'] = (object)$postData = array(      
            'id'            => $this->input->post('id'),
            'user_id'       => $this->session->userdata('user_id'),     
            'item_id'       => $this->input->post('itemName'),     
            'supplier_id'   => $this->input->post('supplier'),
            'cash_credit'   => $this->input->post('cashType'),
            'discount'      => $this->input->post('discount'),
            'netValue'      => $this->input->post('netValue'),
            'date'          => date('Y-m-d',strtotime($this->input->post('date',true))), 
            'billno'        => $this->input->post('billNo'), 
            'quantity'      => $this->input->post('quantity'),     
            'existing_quantity_input' => $this->input->post('existing_quantity_input'),
            'create_date'       => date('Y-m-d'),
            'status'            => $this->input->post('status')
        );  

        /*-----------CHECK ID -----------*/
        if (empty($id)) {
            /*-----------CREATE A NEW RECORD-----------*/
            if ($this->form_validation->run() === true) {
                //echo 'hiihioo : '.$this->input->post('existing_quantity_input');
                //exit(); 
                if ($this->stock_model->insertPurchase($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('dashboard_pharmacist/hospital_activities/stock/purchase');
            } else {
                // Error 
                //echo 'Validation Error';
                $data['title'] = display('purchase'); // First When No Id Is Given
                $data['medicine_list'] = $this->stock_model->medicine_list();
                $data['supplier_list'] = $this->stock_model->supplier_list();
                $data['content'] = $this->load->view('dashboard_pharmacist/stock/purchase_view_form',$data,true);
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
                redirect('dashboard_pharmacist/stock/purchase/'.$postData['id']);
            } else {
                $data['title'] = display('medicine_edit');
                $data['category_list'] = $this->category_model->category_list();
                $data['medicine'] = $this->medicine_model->read_by_id($id);
                $data['content'] = $this->load->view('dashboard_pharmacist/stock/purchase_view_form',$data,true);
                $this->load->view('dashboard_pharmacist/main_wrapper',$data);
            } 
        } 
        /*---------------------------------*/
	}
    // ------------------------------------------------------------------------------------------------------------------
    // ------------------------------------------------- Fetch All  Purchase List ---------------------------------------
    // ----------------------------------------------- Stock_Model-> readPurchase() -------------------------------------
    // ------------------------------------------------------------------------------------------------------------------
	public function purchase_list(){

		$data['title'] = display('purchase_list');
		$data['purchase'] = $this->stock_model->readPurchases($this->session->userdata('user_id'));
        $data['content'] = $this->load->view('dashboard_pharmacist/stock/purchase_view',$data,true);
		$this->load->view('dashboard_pharmacist/main_wrapper',$data);
	}
    
	public function sale()
    { 
        $data['title'] = display('sale');
        //$data['medicines'] = $this->medicine_model->read();
        #-------------------------------#
        $this->form_validation->set_rules('pName', display('patient_name') ,'required|max_length[100]');
        $this->form_validation->set_rules('pAddress', display('patient_address') ,'required|max_length[100]');
        $this->form_validation->set_rules('itemName[]', display('account_name') ,'required|max_length[100]');
        $this->form_validation->set_rules('description[]', display('description'),'trim');
        $this->form_validation->set_rules('quantity[]', display('quantity'),'required|trim');
        $this->form_validation->set_rules('price[]', display('price'),'required|trim');
        $this->form_validation->set_rules('total', display('total'),'required|trim');
        $this->form_validation->set_rules('vat', display('vat'),'required|trim');
        $this->form_validation->set_rules('discount', display('discount'),'required|trim');
        $this->form_validation->set_rules('grand_total', display('grand_total'),'required|trim');
        $this->form_validation->set_rules('paid', display('paid'),'required|trim');
        $this->form_validation->set_rules('due', display('due'),'required|trim');
        $this->form_validation->set_rules('status', display('status'),'required|trim');
        #-------------------------------#
        if ($this->form_validation->run() === true) {
            $invoiceData = array(
                'patient_id' => $this->input->post('patient_id', true),
                'total'      => $this->input->post('total', true),
                'vat'        => $this->input->post('vat', true),
                'discount'   => $this->input->post('discount', true),
                'grand_total'=> $this->input->post('grand_total', true),
                'due'        => $this->input->post('due', true),
                'paid'       => $this->input->post('paid', true),
                'created_id' => $this->session->userdata('user_id'),
                'date'       => date('Y-m-d', strtotime($this->input->post('date', true))),
                'status'     => $this->input->post('status', true),
            );
            if($invoiceData['patient_id']==''){
                $invoiceData['patient_id'] ='1';
                $invoiceData['name'] = $this->input->post('pName', true);
                $invoiceData['address'] = $this->input->post('pAddress', true);
            }
            print_r($invoiceData);exit();
            if ($this->invoice_model->create($invoiceData)) {

                #-------------DETAILS-----------#
                $invoice_id  = $this->db->insert_id();
                $account_id  = $this->input->post('account_id', true);
                $description = $this->input->post('description', true);
                $quantity    = $this->input->post('quantity', true);
                $price       = $this->input->post('price', true);
                $subtotal    = $this->input->post('subtotal', true);

                for($i = 0; $i < sizeof($account_id); $i++) {
                    $detailsData = array(
                        'invoice_id'  => $invoice_id,
                        'account_id'  => $account_id[$i],
                        'description' => $description[$i],
                        'quantity'    => $quantity[$i],
                        'price'       => $price[$i],
                        'subtotal'    => $subtotal[$i] 
                    ); 
                    $this->invoice_model->create_details($detailsData);
                }
                #-------------------------------#

                #set success message
                $this->session->set_flashdata('message', display('save_successfully'));
                redirect('account_manager/invoice/view/'.$invoice_id);

            } else {
                #set exception message
                $this->session->set_flashdata('exception',display('please_try_again'));
            }
            redirect('account_manager/invoice/create');
            
        }


        $data['medicine_list'] = $this->stock_model->medicine_list();
        $data['website'] = $this->stock_model->website();
        $data['content'] = $this->load->view('dashboard_pharmacist/stock/sale_form',$data,true);
        $this->load->view('dashboard_pharmacist/main_wrapper',$data);
    }

    public function listSale()
    { 
        $data['title'] = display('sale');
        //$data['medicines'] = $this->medicine_model->read();
        $data['content'] = $this->load->view('dashboard_pharmacist/stock/sale_view',$data,true);
        $this->load->view('dashboard_pharmacist/main_wrapper',$data);
    }

	public function medicineDetails()
    {
        
        $item_id = $this->input->post('item_id');
        
        $data['medicineDet'] = $item_id;
        $data['status'] = true;
        
        $query=$this->db->select("*")
            ->from("ha_medicine")
            ->where('id',$item_id)
            ->where('status',1)
            ->get();
        if ($query->num_rows() > 0) {
            $med=$query->row();
            $data['medicineDet'] = $med;
            $data['status'] = true;
        }
        echo json_encode($data);  
    }

    public function supplierDetails()
    {
        
        /*$item_id = $this->input->post('item_id');
        
        $data['medicineDet'] = $item_id;
        $data['status'] = true;
        
        $query=$this->db->select("*")
            ->from("ha_medicine")
            ->where('id',$item_id)
            ->where('status',1)
            ->get();
        if ($query->num_rows() > 0) {
            $med=$query->row();
            $data['medicineDet'] = $med;
            $data['status'] = true;
        }
        echo json_encode($data);*/  
      }


    public function addSupplier($id = null)
    {
        /*------------- Validation ----------------*/
         $this->form_validation->set_rules('name', display('name') ,'required');
         $this->form_validation->set_rules('address', display('address') ,'required');
         $this->form_validation->set_rules('phone', display('phone') ,'required|numeric|max_length[10]|min_length[10]');
         $this->form_validation->set_rules('company', display('company') ,'required');
         $this->form_validation->set_rules('status', display('status') ,'required');

        /*------------- Store Data ----------------*/
        $data['supplier'] = (object)$postData = array( 
            'id'          => $this->input->post('id'),
            'name'        => $this->input->post('name'),
            'address'     => $this->input->post('address'),
            'phone'       => $this->input->post('phone'),
            'company'       => $this->input->post('company'),
            'create_date' => date('Y-m-d'),
            'status'      => $this->input->post('status')
        );

        /*-----------CHECK ID -----------*/
        if (empty($id)) {
            /*-----------CREATE A NEW RECORD-----------*/
            if ($this->form_validation->run() === true) { 

                if ($this->stock_model->createSupplier($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('dashboard_pharmacist/hospital_activities/stock/addSupplier');
            } else {
                $data['title'] = display('add_supplier'); // First When No Id Is Given
                //$data['medicine_list'] = $this->stock_model->medicine_list();
                $data['content'] = $this->load->view('dashboard_pharmacist/stock/supplier_form',$data,true);
                $this->load->view('dashboard_pharmacist/main_wrapper',$data);
            } 

        }else
        {
            //echo"failed";
            /*-----------UPDATE A RECORD-----------*/
            if ($this->form_validation->run() === true) { 
                //print_r($postData);
                //exit();
                if ($this->stock_model->updateSupplier($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
                redirect('dashboard_pharmacist/hospital_activities/stock/addSupplier/'.$postData['id']);
            } else {
                $data['title'] = display('update_supplier');
                $data['supplier'] = $this->stock_model->read_by_id_supplier($id);
                $data['content'] = $this->load->view('dashboard_pharmacist/stock/supplier_form',$data,true);
                $this->load->view('dashboard_pharmacist/main_wrapper',$data);
            }
        }

    }

    public function listSupplier()
    {
        $data['title'] = display('list_supplier');
        $data['supplier'] = $this->stock_model->readSupplier();
        $data['content'] = $this->load->view('dashboard_pharmacist/stock/supplier_view',$data,true);
        $this->load->view('dashboard_pharmacist/main_wrapper',$data);
    }

    //patient information
    public function patient()
    {
        /*$data['status'] = true;
        $data['patient_name']='Wasi';
        $data['patient_address']='Salora';
        */
        $patient   = $this->stock_model->patientDetail();
        
        if ($patient->num_rows() > 0) {
            $data['status'] = true;
            $data['patient_name'] = $patient->row()->firstname.' '.$patient->row()->lastname; 
            $data['patient_address'] = $patient->row()->address;
        } else {
            $data['status'] = false;
        }
        echo json_encode($data);
    }
}