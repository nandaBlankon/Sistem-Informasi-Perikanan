<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{
    // start datatables
    var $column_order = array(null, 'nama_depan', 'nomor_telepon', 'email', 'level'); //set column field database for datatable orderable
    var $column_search = array('nama_depan', 'nomor_telepon', 'email', 'level',); //set column field database for datatable searchable
    var $order = array('user_id' => 'asc'); // default order 

    private function _get_datatables_query()
    {
        $this->db->from('tb_user');

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
        $this->db->from('tb_user');
        return $this->db->count_all_results();
    }
    // end datatables

    public function check_login($post)
    {
        $query = $this->db->query("SELECT * FROM tb_user WHERE username = ? ", array($post['username']));
        $result = $query->result();
        if (!empty($result)) {
            $user = $result[0];
            if (password_verify($post['password'], $user->password)) {
                return $user;
            }
        }
        return false;
    }

    public function get_user_by_email($email)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('username', $email);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get($id = null)
    {
        $this->db->from('tb_user');
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($data)
    {
        $this->db->insert('tb_user', $data);
        return $this->db->insert_id();
    }

    public function profil_update($where, $data)
    {
        $this->db->update('tb_user', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('tb_user');
    }
}
