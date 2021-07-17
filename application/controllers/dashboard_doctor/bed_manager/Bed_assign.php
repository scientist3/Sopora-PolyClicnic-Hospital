<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bed_assign extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array(
            'dashboard_doctor/bed_manager/bed_model',
            'dashboard_doctor/bed_manager/bed_assign_model'
        ));
        
 
        if ($this->session->userdata('isLogIn') == false
            || $this->session->userdata('user_role') != 2) 
            redirect('login'); 

    }
 
    public function index()
    {
        $data['title'] = display('bed_assign_list');
        #-------------------------------#
        $data['beds'] = $this->bed_assign_model->read();
        $data['content'] = $this->load->view('dashboard_doctor/bed_manager/bedAssign_view',$data,true);
        $this->load->view('dashboard_doctor/main_wrapper',$data);
    } 

    public function create()
    {
        $data['title'] = display('bed_assign');
        #-------------------------------#
        $this->form_validation->set_rules('patient_id', display('patient_id') ,'required|max_length[11]');
        $this->form_validation->set_rules('bed_id', display('bed_type') ,'required|max_length[11]');
        $this->form_validation->set_rules('description', display('description'),'trim'); 
        $this->form_validation->set_rules('assign_date', display('assign_date') ,'required|max_length[100]');
        $this->form_validation->set_rules('discharge_date', display('discharge_date') ,'required');
        $this->form_validation->set_rules('status', display('status') ,'required');
        #-------------------------------#
        $data['bed'] = (object)$postData = array( 
            'patient_id'  => $this->input->post('patient_id',true),
            'serial'      => $this->randStrGen(2,6),
            'bed_id'      => $this->input->post('bed_id',true),
            'description' => $this->input->post('description',true),
            'assign_date' => date('Y-m-d', strtotime(($this->input->post('assign_date',true) != null)? $this->input->post('assign_date',true): date('Y-m-d'))),
            'discharge_date' => date('Y-m-d', strtotime(($this->input->post('discharge_date',true) != null)? $this->input->post('discharge_date',true): date('Y-m-d'))),
            'assign_by'   => $this->session->userdata('user_id'),
            'status'      => $this->input->post('status',true)
        );  
        #-------------------------------#
        if ($this->check_bed(true) === false) {
            $this->session->set_flashdata('exception',display('bed_not_available')." / ".display('select_only_avaiable_days'));
        }
        #-------------------------------#
        if ($this->form_validation->run() === true && $this->check_bed(true) === true) { 

            $assign_date = strtotime($this->input->post('assign_date',true));
            $discharge_date = strtotime($this->input->post('discharge_date',true));
            $timeDiff = abs($discharge_date - $assign_date);
            $numberDays = $timeDiff/86400;  
            $numberDays = intval($numberDays);
            for ($i = 0; $i <= $numberDays; $i++) {
                $date = date('Y-m-d', strtotime("$i day", $assign_date));

                $postData['assign_date'] = $date;
                // $postData['discharge_date'] = $date; 
                $this->bed_assign_model->create($postData);
                $this->session->set_flashdata('message', display('save_successfully')); 
            } 

            redirect('dashboard_doctor/bed_manager/bed_assign/create');

        } else {
            $data['bed_list'] = $this->bed_model->bed_list();
            $data['content'] = $this->load->view('dashboard_doctor/bed_manager/bedAssign_form',$data,true);
            $this->load->view('dashboard_doctor/main_wrapper',$data);
        } 
    }


    public function edit($serial = null) 
    {
        $data['title'] = display('bed_assign_edit');
        #-------------------------------# 
        $this->form_validation->set_rules('patient_id', display('patient_id') ,'required|max_length[11]');
        $this->form_validation->set_rules('bed_id', display('bed_type') ,'required|max_length[11]');
        $this->form_validation->set_rules('description', display('description'),'trim'); 
        $this->form_validation->set_rules('assign_date', display('assign_date') ,'required|max_length[100]');
        $this->form_validation->set_rules('discharge_date', display('discharge_date') ,'required');
        $this->form_validation->set_rules('status', display('status') ,'required');
        #-------------------------------#
        $newSerial        = $this->input->post('serial',true);
        $data['bed'] = (object)$postData = array( 
            'patient_id'  => $this->input->post('patient_id',true),
            'serial'      => $newSerial,
            'bed_id'      => $this->input->post('bed_id',true),
            'description' => $this->input->post('description',true),
            'assign_date' => date('Y-m-d', strtotime($this->input->post('assign_date',true))),
            'discharge_date' => date('Y-m-d', strtotime($this->input->post('discharge_date',true))),
            'assign_by'   => $this->session->userdata('user_id'),
            'status'      => $this->input->post('status',true)
        ); 
 
        #-------------------------------#
        if($this->check_bed(true) === false) {
            #set exception message
            $this->session->set_flashdata('exception',display('bed_not_available'));
        }
        #-------------------------------#
        if ($this->form_validation->run() === true && $this->check_bed(true) === true) { 
            //delete old data
            $this->bed_assign_model->delete($serial);

            //add new data
            $assign_date = strtotime($this->input->post('assign_date',true));
            $discharge_date = strtotime($this->input->post('discharge_date',true));
            $timeDiff = abs($discharge_date - $assign_date);
            $numberDays = $timeDiff/86400;  
            $numberDays = intval($numberDays);
            for ($i = 0; $i <= $numberDays; $i++) {
                $date = date('Y-m-d', strtotime("$i day", $assign_date));

                $postData['assign_date'] = $date; 
                $this->bed_assign_model->create($postData);
                $this->session->set_flashdata('message', display('update_successfully')); 
            } 

            redirect('dashboard_doctor/bed_manager/bed_assign/edit/'.$newSerial);

        } else {
            $data['bed']      = $this->bed_assign_model->read_by_serial($serial);
            $data['bed_list'] = $this->bed_model->bed_list();
            $data['content']  = $this->load->view('dashboard_doctor/bed_manager/bedAssign_edit',$data,true);
            $this->load->view('dashboard_doctor/main_wrapper',$data);
        }
    }
 

    public function delete($serial = null) 
    {
        if ($this->bed_assign_model->delete($serial)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('dashboard_doctor/bed_manager/bed_assign');
    }
  

    public function check_patient($mode = null)
    {
        $patient_id = $this->input->post('patient_id');

        if (!empty($patient_id)) {
            $query = $this->db->select('firstname,lastname')
                ->from('patient')
                ->where('patient_id',$patient_id)
                ->where('status',1)
                ->get();

            if ($query->num_rows() > 0) {
                $result = $query->row();
                $data['message'] = $result->firstname . ' ' . $result->lastname;
                $data['status'] = true;

                if($mode == true) {
                    return true;
                }

            } else {
                $data['message'] = display('invalid_patient_id');
                $data['status'] = false;

                if($mode == true) {
                    return false;
                }

            }
        } else {
            $data['message'] = display('invlid_input');
            $data['status'] = null;
        }
 
        echo json_encode($data);
    }

    public function check_bed($mode = null)
    { 
        $serial      = $this->input->post('serial');
        $bed_id      = $this->input->post('bed_id');
        $assign_date = strtotime($this->input->post('assign_date',true));
        $discharge_date = strtotime($this->input->post('discharge_date',true));
        #----------------------------------------------------#
        if (!empty($bed_id) && !empty($assign_date) && $assign_date <= $discharge_date) {

            $timeDiff = abs($discharge_date - $assign_date);
            $numberDays = $timeDiff/86400;  
            $numberDays = intval($numberDays);

            $result  = "";
            $result .= "<div class=\"alert alert-info\">"; 
            $successCount = 0;
            $errorCount   = 0;
            for ($i = 0; $i <= $numberDays; $i++) {
                $date = date('Y-m-d', strtotime("$i day", $assign_date));

                $query = $this->db->select('bed_id, assign_date, COUNT(assign_date) as allocated')
                    ->from('bm_bed_assign')
                    ->where('assign_date',$date)
                    ->where('bed_id',$bed_id)
                    ->where('status',1)
                    ->where_not_in('serial',$serial)
                    ->group_by('assign_date')
                    ->get()
                    ->row(); 

                $total_bed = $this->db->select("limit")
                    ->from('bm_bed')
                    ->where('id', $bed_id)
                    ->where('status', 1)
                    ->get()
                    ->row()
                    ->limit;

                if (!empty($query)) {
                    $free_bed = $total_bed - $query->allocated; 
                } else {
                    $free_bed = $total_bed;
                }

                if ($free_bed > 0) {
                    $result .= "<p class=\"text-success\">$date [$free_bed ".display('bed_available')."]</p>";  
                    $successCount++; 
                } else {
                    $result .= "<p class=\"text-danger\">$date [".display('bed_not_available')."]</p>"; 
                    $errorCount++;
                }   
            }
            $result .= "</div>";  

            if ($mode == true && $errorCount > 0) {
                return false; 
            } else if ($mode == true && $successCount > 0) {
                return true;
            } 

            $data['status']  = true;
            $data['message'] = $result;
        } else {
            $data['message']     = display('invlid_input');
            $data['status']      = null;

            if ($mode == true) {
                return null;
            }
        }

        if($mode == null) {
            echo json_encode($data);
        } 

    }



    /*
    |----------------------------------------------
    |        id genaretor
    |----------------------------------------------     
    */
    public function randStrGen($mode = null, $len = null){
        $result = "";
        if($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 4):
            $chars = "0123456789";
        endif;

        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++) {
                $randItem = array_rand($charArray);
                $result .="".$charArray[$randItem];
        }
        return $result;
    }
    /*
    |----------------------------------------------
    |         Ends of id genaretor
    |----------------------------------------------
    */


}
