<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends CI_Model
{
    public function createOrder($orderData)
    {
        $this->db->trans_start();

        // Insert order
        $data = [
            'queue_number' => $orderData['queue'],
            'table_number' => $orderData['table'],
            'subtotal' => $orderData['subtotal'],
            'tax' => $orderData['tax'],
            'total' => $orderData['total'],
            'payment_method' => $orderData['payment'],
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('orders', $data);
        $orderId = $this->db->insert_id();

        // Insert order items
        foreach ($orderData['items'] as $item) {
            $itemData = [
                'order_id' => $orderId,
                'menu_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price']
            ];
            $this->db->insert('order_items', $itemData);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return $orderId;
    }

    public function getOrderHistory()
    {
        $query = "SELECT o.*, GROUP_CONCAT(CONCAT(m.name, ' x', oi.quantity) SEPARATOR ' · ') as items 
                  FROM orders o 
                  LEFT JOIN order_items oi ON o.id = oi.order_id 
                  LEFT JOIN menu_items m ON oi.menu_id = m.id 
                  GROUP BY o.id 
                  ORDER BY o.created_at DESC 
                  LIMIT 50";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getActiveOrder()
    {
        $this->db->where_in('status', ['pending', 'preparing', 'ready']);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('orders');
        return $query->row_array();
    }
}
?>