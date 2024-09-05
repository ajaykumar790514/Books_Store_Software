<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class shops_delivery_boy_model extends CI_Model
{
    public function delivery_boys($limit=null,$start=null)
    {
        $shop_id     = $_SESSION['user_data']['id'];
        if ($limit!=null) {
            $this->db->limit($limit, $start);
        }
        $this->db
        ->select('t1.*')
        ->from('delivery_boys t1')      
        ->where('t1.is_deleted','NOT_DELETED')
        ->where('t1.shop_id',$shop_id)
        ->order_by('t1.added','desc');
        if (@$_POST['search']) {
			$data['search'] = $_POST['search'];
			$this->db->like('t1.name', $_POST['search']);
			$this->db->or_like('t1.contact_number', $_POST['search']);
		}
        if($limit!=null)
            return $this->db->get()->result();
        else
            return $this->db->get()->num_rows();
		return $this->db->get()->result();
    }
    public function delivery_boy($id)
    {
        $query = $this->db
        ->select('t1.*')
        ->from('delivery_boys t1')       
		->where(['t1.is_deleted' => 'NOT_DELETED','t1.id'=>$id])    
        ->get();
		return $query->row();
    }
}
?>