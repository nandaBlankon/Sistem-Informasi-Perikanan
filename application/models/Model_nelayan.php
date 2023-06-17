<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_nelayan extends CI_Model
{
    var $table = 'nelayan_tb';

    public function __construct()
    {
        parent::__construct();
    }

    // start datatables
    var $column_order = array(null, 'nik', 'nelayan_nama', 'nelayan_alamat', 'nama_kapal'); //set column field database for datatable orderable
    var $column_search = array('nik', 'nelayan_nama', 'nelayan_alamat'); //set column field database for datatable searchable
    var $order = array('nelayan_tb.nelayan_id' => 'asc');

    private function _get_datatables_query()
    {
        $this->db->select("nelayan_tb.nelayan_id, nelayan_tb.nik, nelayan_tb.nelayan_nama, nelayan_tb.nelayan_alamat, kapal_tb.kapal_nama as nama_kapal");
        $this->db->from('nelayan_tb');
        $this->db->join('kapal_tb', 'nelayan_tb.kapal_id = kapal_tb.kapal_id', 'left');

        $i = 0;
        foreach ($this->column_search as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    function get_datatables()
    {
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // end datatables

    public function get($id = null)
    {
        $this->db->select('nelayan_tb.*, kapal_tb.*');
        $this->db->from($this->table);
        $this->db->join('kapal_tb', 'nelayan_tb.kapal_id = kapal_tb.kapal_id');

        if ($id != null) {
            $this->db->where('nelayan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('nelayan_id', $id);
        $this->db->delete($this->table);
    }
}
