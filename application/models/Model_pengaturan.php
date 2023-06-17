<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_pengaturan extends CI_Model
{
    public function web_setting($id = null)
    {
        $this->db->from('web_settings');
        $query = $this->db->get();
        return $query;
    }

    public function web_setting_edit($post)
    {
        $params = array(
            'site_name'   => $post['site_name'] != "" ? $post['site_name'] : null,
            'site_logo'  => $post['site_logo'] != "" ? $post['site_logo'] : null,
            'site_favicon'  => $post['site_favicon'] != "" ? $post['site_favicon'] : null,
            'site_footer_text'      => $post['site_footer_text'] != "" ? $post['site_footer_text'] : null,
            'site_meta_keywords'     => $post['site_meta_keywords'] != "" ? $post['site_meta_keywords'] : null,
            'site_meta_desc'     => $post['site_meta_desc'] != "" ? $post['site_meta_desc'] : null,
            'site_status'     => $post['site_status'] != "" ? $post['site_status'] : null,
            'site_maintenance_msg'     => $post['site_maintenance_msg'] != "" ? $post['site_maintenance_msg'] : null,
        );

        if (empty($post['id'])) { // jika tabel nya masih kosong
            $this->db->insert('web_settings', $params); // maka insert data baru
        } else { // jika tabel nya sudah ada data
            $this->db->where('id', $post['id']); // maka update data nya berdasarkan id yang sudah ada
            $this->db->update('web_settings', $params);
        }
    }
}
