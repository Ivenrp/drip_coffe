<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QueueModel extends CI_Model
{
    public function getCurrentQueue()
    {
        $this->db->select('MAX(CAST(SUBSTRING(queue_number, 3) AS UNSIGNED)) as last_queue');
        $this->db->where('DATE(created_at) = CURDATE()', null, false);
        $query = $this->db->get('orders');
        $result = $query->row_array();
        $nextNum = ($result['last_queue'] ?? 9) + 1;
        return "A-" . $nextNum;
    }

    public function updateOrderStatus($orderId, $status)
    {
        $this->db->where('id', $orderId);
        return $this->db->update('orders', ['status' => $status]);
    }
}
?>