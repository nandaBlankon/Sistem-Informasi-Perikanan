<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ikan extends CI_Model
{
    var $table = 'ikan_tb';

    public function __construct()
    {
        parent::__construct();
    }

    // start datatables
    var $column_order = array(null, 'ikan_nama', 'produksi', 'produksi_tahun', 'nama_kabupaten'); //set column field database for datatable orderable
    var $column_search = array('ikan_nama', 'produksi_tahun', 'regencies.name'); //set column field database for datatable searchable
    var $order = array('ikan_tb.produksi_tahun' => 'desc');

    private function _get_datatables_query()
    {
        $this->db->select("ikan_tb.ikan_id, ikan_tb.ikan_nama, ikan_tb.produksi, ikan_tb.produksi_tahun, regencies.name as nama_kabupaten");
        $this->db->from('ikan_tb');
        $this->db->join('regencies', 'ikan_tb.kabupaten = regencies.id', 'left');

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
        $this->db->select('ikan_tb.*, regencies.*');
        $this->db->from($this->table);
        $this->db->join('regencies', 'ikan_tb.kabupaten = regencies.id');

        if ($id != null) {
            $this->db->where('ikan_id', $id);
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
        $this->db->where('ikan_id', $id);
        $this->db->delete($this->table);
    }
}
