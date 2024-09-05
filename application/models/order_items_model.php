<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[\AllowDynamicProperties]
class order_items_model extends CI_Model
{
	function index(){
		echo 'This is model index function';
	}
	function __construct(){
		$this->tbl1 = 'order_items';
		$this->load->database();
	}
	
	function insertRow($data = array()){
		$result = $this->db->insert($this->tbl1,$data);
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

	function getRows($oid){
		$this->db
		->select("t1.id,t1.is_cancel,t1.order_id,t1.qty,t1.price_per_unit,t1.total_price,t1.tax,t1.tax_value,t1.offer_applied,t1.mrp,t3.product_code,t3.unit_type,t3.unit_value,t3.name as product_name,CONCAT('".IMGS_URL."',(SELECT img FROM products_photo where item_id = t1.product_id and is_cover=1)) as \"img\",t4.amount as cancel_amount,t4.qty as cancel_qty")
        ->from('order_items t1')       
        ->join('products_subcategory t3', 't3.id = t1.product_id','left')  
		->join('cancellations_exchange_items t4', 't4.ref_id = t1.order_id','left')
		->where(['t1.order_id'=>$oid]);
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		return $result;
	}
	function getRowscancel($id){
		$this->db
		->select("t3.name as product_name,t3.unit_value,t3.unit_type,t1.amount as total_price,t3.product_code,t1.qty,CONCAT('".IMGS_URL."',(SELECT img FROM products_photo where item_id = t1.product_id and is_cover=1)) as \"img\",")
        ->from('cancellations_exchange_items t1')       
        ->join('products_subcategory t3', 't3.id = t1.product_id','left')  
		->where(['t1.ref_id'=>$id]);
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		return $result;
	}



}
?>