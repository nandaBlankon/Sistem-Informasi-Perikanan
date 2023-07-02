<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_survei extends CI_Model
{
    var $table = 'survei_tb';

    public function __construct()
    {
        parent::__construct();
    }

    public function get($id = null)
    {
        $this->db->from($this->table);
        if ($id != null) {
            $this->db->where('survei_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getPertanyaan($id = null)
    {
        $this->db->from('pertanyaan_tb');
        if ($id != null) {
            $this->db->where('pertanyaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_by_id($id)
    {
        $this->db->from('pertanyaan_tb');
        $this->db->where('pertanyaan_id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert('pertanyaan_tb', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('pertanyaan_tb', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('pertanyaan_id', $id);
        $this->db->delete('pertanyaan_tb');
    }
}
