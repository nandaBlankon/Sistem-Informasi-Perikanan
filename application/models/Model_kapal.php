<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_kapal extends CI_Model
{
    var $table = 'kapal_tb';

    public function __construct()
    {
        parent::__construct();
    }

    // start datatables
    var $column_order = array(null, 'kapal_jenis', 'kapal_nama', 'kapasitas', 'jumlah_abk'); //set column field database for datatable orderable
    var $column_search = array('kapal_jenis', 'kapal_nama'); //set column field database for datatable searchable
    var $order = array('kapal_tb.kapal_id' => 'asc');

    private function _get_datatables_query()
    {
        $this->db->from($this->table);

        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
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
        // $this->db->select('kader.*, villages.*, villages.name as nama_desa, districts.name as nama_kec, regencies.name as nama_kab');
        $this->db->from($this->table);
        if ($id != null) {
            $this->db->where('kapal_id', $id);
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
        $this->db->where('kapal_id', $id);
        $this->db->delete($this->table);
    }
}
