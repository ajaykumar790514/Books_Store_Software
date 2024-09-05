<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[\AllowDynamicProperties]
class order_status_master_model extends CI_Model
{
	function index(){
		echo 'This is model index function';
	}
	function __construct(){
		$this->tbl1 = 'order_status_master';
		$this->tbl2 = 'cancellations_exchange_status_master';
		$this->tbl3 = 'orders_status_log';
		$this->load->database();
	}
	function getRows($data = array()){
		$this->db->select("*");
		$this->db->from($this->tbl1);
		if (array_key_exists("conditions", $data)) {
			foreach ($data['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$this->db->where('active','1');
		$this->db->order_by('order','ASC');
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		return $result;
	}
	function getRowsNew($order){
		$this->db->select("*");
		$this->db->from($this->tbl1);
		$this->db->where('active','1');
		$this->db->where('order >=',$order);
		$this->db->order_by('order','ASC');
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->result():FALSE;
		return $result;
	}
	function getCancelRowsNew($order){
		$this->db->select("*");
		$this->db->from($this->tbl2);
		$this->db->where('active','1');
		$this->db->where('order >=',$order);
		$this->db->order_by('order','ASC');
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->result():FALSE;
		return $result;
	}
	
	function getCurrentStatus($id){
		$this->db->select("t2.order");
		$this->db->from('orders t1');
		$this->db->join('order_status_master t2 ', 't2.id=t1.status');
		$this->db->where('t1.id',$id);
		$query = $this->db->get()->row();
		return $query;
	}
	function getCancelCurrentStatus($id){
		$this->db->select("t2.order");
		$this->db->from('cancellations_exchange t1');
		$this->db->join('cancellations_exchange_status_master t2 ', 't2.id=t1.status');
		$this->db->where('t1.id',$id);
		$query = $this->db->get()->row();
		return $query;
	}
	
	function getcancelRows($id){
		$this->db->select("t1.name as status_name");
		$this->db->from('cancellations_exchange_status_master t1');
		$this->db->join('cancellations_exchange t2 ', 't1.id=t2.status');
		$this->db->where('t2.order_id',$id);
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		return $result;
	}
	function getRowscancel($id,$data = array()){
		$this->db->select('t1.*');
		$this->db->from('cancellations_exchange_status_master t1');
		$this->db->join('cancellations_exchange t2','t2.status=t1.id','left');
		$this->db->where(['t2.id='=>$id]);
		$query = $this->db->get(); 
		return $query->row();
	}
	function getRowscancelpayment($id,$data = array()){
		$this->db->select('t1.*');
		$this->db->from('payment_status_master t1');
		$this->db->join('cancellations_exchange t2','t2.payment_status=t1.id','left');
		$this->db->where(['t2.id='=>$id]);
		$query = $this->db->get(); 
		//echo $this->db->last_query();die();
		return $query->row();
	}
	function insertRow($data = array()){
		$result = $this->db->insert($this->tbl1,$data);
		return $result;
	}
	function SaveLog($data = array()){
		$result = $this->db->insert($this->tbl3,$data);
		return $result;
	}
	function updateRow($id,$data = array()){
		$this->db->where($this->tbl1.'.'.'id',$id);
		$result = $this->db->update($this->tbl1,$data);
		return $result;
	}
	function deleteRow($id){
		$this->db->where($this->tbl1.'.'.'id',$id);
		$result = $this->db->delete($this->tbl1);
		return $result;
	}
	

public function exchage_status()
{
    $this->db->select('t1.*');
    $this->db->from('cancellations_exchange_status_master t1');
    $this->db->where(['t1.is_deleted'=>'NOT_DELETED']);
    $query = $this->db->get(); 
    return $query->result();
}
public function exchage_payment_status()
{
    $this->db->select('t1.*');
    $this->db->from('payment_status_master t1');
    $this->db->where(['t1.is_deleted'=>'NOT_DELETED']);
    $query = $this->db->get(); 
    return $query->result();
}


}
?>