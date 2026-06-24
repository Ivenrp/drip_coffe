<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FeedbackModel extends CI_Model
{
    public function addFeedback($data)
    {
        $insertData = [
            'name' => $data['name'],
            'rating' => $data['rating'],
            'category' => $data['category'],
            'message' => $data['message'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('feedback', $insertData);
    }

    public function getAllFeedback()
    {
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get('feedback');
        return $query->result_array();
    }
}
?>