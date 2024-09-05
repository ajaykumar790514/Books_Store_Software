<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[\AllowDynamicProperties]
class orders_model extends CI_Model
{
	function index(){
		echo 'This is model index function';
	}
	function __construct(){
		$this->tbl1 = 'orders';
		$this->tbl2 = 'cancellations_exchange';
		$this->load->database();
	}
    
    function update_courier($data=array(),$id=0)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->tbl1,$data);
    }
    
	// function getRows($data = array()){
	// 	$this->db->select("*,(SELECT shop_name FROM shops where id=orders.shop_id) as \"shop_name\",
	// 	(SELECT contact FROM shops where id=orders.shop_id) as \"shop_mobile\",
	// 	(SELECT CONCAT(fname,' ',lname) FROM customers where id=orders.user_id) as \"customer_name\",
	// 	(SELECT mobile FROM customers where id=orders.user_id) as \"alternate_mobile\",
	// 	(SELECT mobile FROM customers where id=orders.user_id) as \"alternate_mobile\"
	// 	 ");
	// 	$this->db->from($this->tbl1);
	// 	if (array_key_exists("conditions", $data)) {
	// 		foreach ($data['conditions'] as $key => $value) {
	// 			$this->db->where($key,$value);
	// 		}
	// 	}
	// 	$query = $this->db->get();
	// 	$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
	// 	return $result;
	// }

	

	function insertRow($data = array()){
		$result = $this->db->insert($this->tbl1,$data);
		return $result;
	}
	function updateRow($id,$data = array()){
		$this->db->where($this->tbl1.'.'.'id',$id);
		$result = $this->db->update($this->tbl1,$data);
		return $result;
	}
	function updatestatusexchange($id,$data = array()){
		$this->db->where($this->tbl2.'.'.'id',$id);
		$result = $this->db->update($this->tbl2,$data);
		return  $result;
	}
	
	function deleteRow($id){
		$this->db->where($this->tbl1.'.'.'id',$id);
		$result = $this->db->delete($this->tbl1);
		return $result;
	}
	function getOrdersData($data = array(),$mobile='',$payment_mode=''){
		// echo('<pre>');
		// print_r($payment_mode[0]);
		// die();
		$this->db->select("
							orders.id,
							orders.orderid,
							orders.invoice_no,
							(SELECT shop_name FROM shops where id=orders.shop_id) as \"shop_name\",
							(SELECT CONCAT(fname,' ',lname,' (',mobile,')') FROM customers where id=orders.user_id) as \"customer_name\",
							orders.datetime,
							CONCAT(datetime,' (',TIME_FORMAT(timeslot_starttime, \"%h:%i %p\"),' - ',TIME_FORMAT(timeslot_endtime, \"%h:%i %p\"),')') as \"delivery_slot\",
							orders.address_id,
							orders.random_address,
							orders.total_value,
							orders.total_savings,
							orders.payment_method,
							orders.status,
							orders.added,
							customers.mobile,
							order_status_master.name as status_name,
							CONCAT(db.full_name,' (',db.contact_number,')') as delivery_boy,
							db.id as delivery_boy_id
						");
		$this->db->from($this->tbl1);
        $this->db->join('customers', 'customers.id = orders.user_id');
        $this->db->join('order_status_master', 'order_status_master.id = orders.status');
        $this->db->join('order_assign_deliver oad', 'oad.order_id = orders.id','left');
        $this->db->join('delivery_boys db', 'db.id = oad.delivery_boy_id','left');
		if (array_key_exists("conditions", $data)) 
		{
			foreach ($data['conditions'] as $key => $value) {
				$this->db->where($this->tbl1.".".$key,$value);
			}
		}
		if ($mobile != 'null') {
				$this->db->where('customers.mobile',$mobile);
		}
		if ($payment_mode != 'null') {
			if ($payment_mode == 'cod') {
                $this->db->where('orders.payment_method' , 'cod');
            }
			else if($payment_mode == 'online')
            {
                $this->db->where('orders.payment_method!=' , 'cod');
            }
		}
		if(isset($_SESSION['order_table_filters']['from_date']) && $_SESSION['order_table_filters']['from_date']!==''){
			if (array_key_exists("order_date", $data)) {
				$from_date = DATE($data['order_date']['start_date']);
				$to_date = DATE($data['order_date']['end_date']);
				// print_r($from_date);
				$this->db->where(['DATE('.$this->tbl1.'.added) >='=>$from_date , 'DATE('.$this->tbl1.'.added) <='=>$to_date]);
				// $this->db->where(['DATE('.$this->tbl1.'.added) >='=>'2021-07-01' , 'DATE('.$this->tbl1.'.added) <='=>'2021-10-30']);
				// $this->db->last_query();
			}
		}
		if(isset($_SESSION['order_table_filters']['delivery_boy']) && $_SESSION['order_table_filters']['delivery_boy']!==''){
			$this->db->where('db.id',$_SESSION['order_table_filters']['delivery_boy']);
		}
		if (array_key_exists("conditions_join", $data)) {
			foreach ($data['conditions_join'] as $key => $value) {
				$this->db->where('customers'.".".$key,$value);
			}
		}
		if (array_key_exists("conditions_like", $data)) {
			foreach ($data['conditions_like'] as $key => $value) {
				$this->db->like($this->tbl1.".".$key,$value);
			}
		}
		if (array_key_exists("conditions_in", $data)) {
			foreach ($data['conditions_in'] as $key => $value) {
				$this->db->where_in($this->tbl1.".".$key,$value);
			}
		}
		if(isset($data['order_field']) && isset($data['order'])){
			$this->db->order_by($data['order_field'],strtoupper($data['order']));
		}else{
			$this->db->order_by('orders.added','DESC');
		}

		if(isset($data['limit']) && isset($data['offset'])){
			$this->db->limit($data['limit'],$data['offset']);
		}
		
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		
		return $result;
	}
	function getNewOrdersRows($data = array()){
		$this->db->select("*,(SELECT shop_name FROM shops where id=orders.shop_id) as \"shop_name\",
		(SELECT contact FROM shops where id=orders.shop_id) as \"shop_mobile\",
		(SELECT CONCAT(fname,' ',lname) FROM customers where id=orders.user_id) as \"customer_name\",
		(SELECT mobile FROM customers where id=orders.user_id) as \"customer_mobile\"");
		$this->db->from($this->tbl1);
		if (array_key_exists("conditions", $data)) {
			foreach ($data['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$this->db->order_by('added','DESC');
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		return $result;
	}
	public function invoice_details($oid)
    {
        $query = $this->db
        ->select('t1.id as oid,t1.house_no as houseNo,t1.address as order_address,t1.floor as order_flor,t1.apartment_name as order_apartment_name,t1.state as order_state , t1.city as order_city ,t1.email as order_email,t1.pincode as order_pincode,t1.*,t1.added as order_date,t1.tax as order_tax,t2.purchase_rate,t2.mrp,t2.qty,t2.price_per_unit,t2.total_price,t2.tax_value,t3.name as status_name,t4.id as product_id,t4.sku as product_sku,t4.name as product_name,t4.unit_value,t4.unit_type,t6.fname,t6.lname,t6.mobile,t6.email as cust_email,t6.mobile as cus_mobile,t8.logo,t8.pin_code,t8.gstin,t8.address,t8.state as primary_state,t10.name as  state_name,t9.name as city_name,t8.shop_name,t5.discount,t2.is_cancel,t11.qty as cancel_qty,t11.amount as cancel_amount')
        ->from('orders t1')
        ->join('order_items t2', 't2.order_id = t1.id','left')        
        ->join('order_status_master t3', 't3.id = t1.status','left')        
        ->join('products_subcategory t4', 't4.id = t2.product_id','left')        
		->join('dpco t5', 't5.id = t2.discount_type','left')  
		->join('customers t6', 't6.id = t1.user_id','left')  
		->join('cancellations_exchange t7', 't7.order_id = t1.id','left')  
		->join('shops t8', 't8.id = t1.shop_id','left')  
		->join('cities t9', 't9.id = t8.city','left')  
		->join('states t10', 't10.id = t8.state','left') 
		->join('cancellations_exchange_items t11', 't1.id = t11.ref_id','left')  
        ->where(['t4.is_deleted' => 'NOT_DELETED','t1.id'=>$oid])  
		->get();   
		//echo $this->db->last_query();die();
		return $query->result_array();
    }

	public function cancel_exchange_order($limit=null,$start=null)
    {
        if ($limit!=null) {
            $this->db->limit($limit, $start);
        }
        $this->db
        ->select('t1.*,t4.orderid,t4.booking_name,t4.booking_contact,t3.name as status_name,t5.name as order_status,t6.name as payment_status')
        ->from('cancellations_exchange t1')       
        ->join('order_items t2', 't2.order_id = t1.order_id','left')      
		->join('cancellations_exchange_status_master t3', 't1.status = t3.id','left')   
		->join('orders t4', 't1.order_id = t4.id','left')  
		->join('order_status_master t5', 't4.status = t5.id','left') 
		->join('payment_status_master t6', 't1.payment_status = t6.id','left')  
        ->where(['t1.is_deleted' => 'NOT_DELETED','t2.is_cancel' => '1'])
		->order_by('t1.added','desc');

        if (@$_POST['search']) {
            $this->db->group_start();
			$this->db->like('t4.booking_contact', $_POST['search']);
			$this->db->or_like('t4.booking_name', $_POST['search']);
            $this->db->group_end();
		}
		if (@$_POST['status']) {
			$this->db->where('t1.status',$_POST['status']);
		}
		if (@$_POST['payment_status']) {
			$this->db->where('t1.payment_status',$_POST['payment_status']);
		}
		if (@$_POST['start_date']) {
			$start_date = $_POST['start_date'] .' 00:00:00';    
			$this->db->where('t1.added >=',$start_date);
		}

		if (@$_POST['end_date']) {
			$end_date = $_POST['end_date'] . ' 23:59:59';
			$this->db->where('t1.added <=',$end_date);
		}
        if($limit!=null)
            return $this->db->get()->result();
        else
            return $this->db->get()->num_rows();
    }
	function getRows($oid){
		$this->db
		 ->select('t1.*,t2.shop_name,t2.contact as shop_mobile,t3.mobile as alternate_mobile,t4.total as total_cancel')
		 ->from('orders t1')
		 ->join('shops t2', 't2.id = t1.shop_id','left')        
		 ->join('customers t3', 't3.id = t1.user_id','left') 
		 ->join('cancellations_exchange t4', 't4.order_id = t1.id','left') 

		 ->where(['t1.id'=>$oid])  ;
	 
		 $query = $this->db->get();
		 $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		 return $result;
	 }
	 function get_row_order($oid){
		$this->db
		 ->select('t1.*,t2.shop_name,t2.contact as shop_mobile,t3.mobile as alternate_mobile,t4.total as total_cancel')
		 ->from('orders t1')
		 ->join('shops t2', 't2.id = t1.shop_id','left')        
		 ->join('customers t3', 't3.id = t1.user_id','left') 
		 ->join('cancellations_exchange t4', 't4.order_id = t1.id','left') 

		 ->where(['t1.id'=>$oid])  ;
	 
		 $query = $this->db->get()->row();
		 return $query;
	 }
	 
	function getRowscancel($id){
		$this->db
		->select('t2.total,t2.remark,t1.booking_name,t1.booking_contact,t1.state as order_state,t1.city as order_city,t1.pincode as order_pincode,t1.house_no,t1.apartment_name,t1.floor,t1.courier_company,t1.courier_code,t1.address as order_address , t1.email as order_email,t3.mobile as alternate_mobile,t3.email,t4.shop_name,t1.id,t1.orderid,t2.added,t1.direction,t1.payment_method,t1.razorpay_payment_id,t1.bank_name,t2.status,t5.name as order_statuss,t2.type,t2.id as cancel_id')
        ->from('orders t1')       
        ->join('cancellations_exchange t2', 't2.order_id = t1.id','left')  
        ->join('customers t3', 't3.id = t1.user_id','left')  
		->join('shops t4', 't3.id = t1.shop_id','left')  
		->join('order_status_master t5', 't1.status = t5.id','left') 
		->where(['t2.id'=>$id,'t2.is_deleted'=>'NOT_DELETED']);
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		return $result;
	}

    /*
     * Insert Multiple Records
     */
    public function Insert($tb, $data)
    {
        $query = $this->db->insert($tb, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

}
?>