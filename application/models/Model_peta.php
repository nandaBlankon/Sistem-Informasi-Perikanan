<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_peta extends CI_Model
{
    var $table = 'peta_tb';

    public function __construct()
    {
        parent::__construct();
    }

    public function get($id = null)
    {
        $this->db->from($this->table);
        if ($id != null) {
            $this->db->where('peta_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'peta_id' => $post['peta_id'],
            'peta_nama' => $post['peta_nama'],
            'kawasan' => $post['kawasan'],
            'image' => $post['image'],
        ];
        $this->db->insert('peta_tb', $params);
    }

    public function edit($post)
    {
        $params = [
            'peta_id' => $post['peta_id'],
            'peta_nama' => $post['peta_nama'],
            'kawasan' => $post['kawasan'],
        ];

        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }

        $this->db->where('peta_id', $post['peta_id']);
        $this->db->update('peta_tb', $params);
    }

    public function delete_by_id($id)
    {
        $this->db->where('peta_id', $id);
        $this->db->delete($this->table);
    }
}
