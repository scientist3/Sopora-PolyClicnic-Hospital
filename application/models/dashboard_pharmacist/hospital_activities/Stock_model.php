<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {
	//private $table = 'stock';
	private $table = 'ha_medicine';
	private $purchaseTable='purchase';
	private $supplierTable='supplier';
	private $transactionTable='transaction';
	
	public function read(){

	}

	// Insert Data Into Purchase Table, Update Quantity, Update Supplier Balance
	public function insertPurchase($data=[]){
		// Update Quantity In Medicine Table  have id 
		$newQuantity=$data['quantity']+$data['existing_quantity_input'];
		$quantityUpdate= array(
			'quantity' => $newQuantity
		);
		$this->db->where('id',$data['item_id']);
		$this->db->update($this->table,$quantityUpdate);
		// End Of Quanity Update

		// Update Supplier Balance or Account according To Credit Or Cash
		// Cash =1 and Credit =2
		//
		$trans=array(
			'user_id'		=>$data['user_id'],
			'supplier_id'	=>$data['supplier_id'],
			'cash_credit'	=>$data['cash_credit'],
			'amount'		=>$data['netValue'],
			'created_date'	=>$data['create_date']
		);
		$this->db->insert($this->transactionTable,$trans);
		// End Of Supplier Balance Update

		return $this->db->insert($this->purchaseTable,$data);
	}

	public function readPurchases($user_id=null)
	{
		return $this->db->select("*")
			->from($this->purchaseTable)
			->where('user_id',$user_id)
			//->join('ha_category', 'ha_category.id = ha_medicine.category_id', 'left')
			->order_by('billno','asc')
			->get()
			->result();
	}

	public function createSupplier($data)
	{
		return $this->db->insert('supplier',$data);
		//sjgaskjas
	}
	// For DropDown List
	public function supplier_list()
	{
		$result = $this->db->select("*")
			->from($this->supplierTable)
			->where('status',1)
			->get()
			->result();

		$list[''] = display('select_supplier');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->id] = $value->name; 
			}
			return $list;
		} else {
			return false;
		}
	}
	public function readSupplier()
	{
		return $this->db->select("*")
			->from($this->supplierTable)
			->get()
			->result();
	} 

	public function read_by_id_supplier($id=null)
	{
		return $this->db->select("*")
			->from($this->supplierTable)
			->where('id',$id)
			->get()
			->row();
	}
	public function updateSupplier($data=[])
	{
		return $this->db->where('id',$data['id'])
			->update($this->supplierTable,$data); 
	}

	public function medicine_list()
	{
		$result = $this->db->select("*")
			->from($this->table)
			->where('status',1)
			->get()
			->result();

		$list[''] = display('select_category');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->id] = $value->name." | batchNo :".$value->batchNo; 
			}
			return $list;
		} else {
			return false;
		}
	}
	
	public function patientDetail()
	{
		return $this->db->select('patient_id, firstname, lastname, address')
			->from('patient')
			->where('patient_id', $this->input->post('patient_id'))
			->get();
	}

	public function website()
	{
		return $this->db->select('title, description')
			->from('setting')
			->get()
			->row();
	}
}