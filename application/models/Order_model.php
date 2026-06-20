<?php
class Order_model extends CI_Model {
    public function get_all_orders() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('orders')->result_array();
    }
    
    public function sum_revenue() {
        $this->db->select_sum('total');
        $this->db->where('status', 'completed');
        $result = $this->db->get('orders')->row();
        return (float)($result->total ?? 0);
    }
    
    public function count_all() {
        return $this->db->count_all('orders');
    }
    
    public function get_all_pending() {
        $this->db->where_in('status', ['pending', 'preparing', 'ready']);
        $this->db->order_by('created_at', 'ASC');
        return $this->db->get('orders')->result_array();
    }
    
    public function get($id) {
        return $this->db->get_where('orders', ['id' => $id])->row_array();
    }
    
    public function get_with_items($id) {
        $order = $this->get($id);
        if ($order) {
            $this->db->select('order_items.*, menu_items.name');
            $this->db->join('menu_items', 'menu_items.id = order_items.menu_id', 'left');
            $this->db->where('order_id', $id);
            $order['items'] = $this->db->get('order_items')->result_array();
        }
        return $order;
    }
    
    public function update_status($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('orders', ['status' => $status]);
    }
}
?>