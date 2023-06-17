<?php defined('BASEPATH') or exit('No direct script access allowed');

class Ikan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['model_user', 'model_ikan']);
        check_not_login();
    }

    public function index()
    {
        $data['title']      = 'Data Ikan';
        $data['act_ikan']   = 'active';

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/sidebar', $data);
        $this->load->view('admin/ikan/data_ikan', $data);
        $this->load->view('templates/backend/footer', $data);
    }

    // start datatables server side
    function get_ajax()
    {
        $list = $this->model_ikan->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $ikan) {

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $ikan->ikan_nama;
            $row[] = $ikan->produksi . " <small>Ton</small>";
            $row[] = $ikan->produksi_tahun;
            $row[] = $ikan->nama_kabupaten;
            // add html for action
            $row[] = '<a href="javascript:void(0)" onclick="delete_ikan(' . $ikan->ikan_id . ')" class="btn btn-kecil btn-bulat btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
            <a href="' . site_url('ubah-ikan/' . $ikan->ikan_id) . '" class="btn btn-bulat btn-kecil btn-primary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->model_ikan->count_all(),
            "recordsFiltered" => $this->model_ikan->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    // end datatables server side

    public function tambah()
    {
        $ikan = new stdClass;
        $ikan->ikan_id          = null;
        $ikan->ikan_nama        = null;
        $ikan->produksi         = null;
        $ikan->produksi_tahun   = null;
        $ikan->kabupaten        = null;

        $data = array(
            'title'     => 'Data Ikan',
            'page'      => 'tambah',
            'row'       => $ikan,
            'kab'       => $this->db->query("select * from regencies"),
            'act_ikan'  => 'active',
        );

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/sidebar', $data);
        $this->load->view('admin/ikan/ikan_form', $data);
        $this->load->view('templates/backend/footer', $data);
    }

    public function proses_tambah()
    {
        $this->validation_for = 'add';
        $data = array();
        $data['status'] = TRUE;

        $this->_validate();

        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'ikan_nama'      => form_error('ikan_nama'),
                'produksi'    => form_error('produksi'),
                'produksi_tahun'    => form_error('produksi_tahun'),
                'kabupaten'     => form_error('kabupaten'),
            );
            $data = array(
                'status'    => FALSE,
                'errors'    => $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $insert = array(
                'ikan_id'        => $this->input->post('ikan_id'),
                'ikan_nama'      => $this->input->post('ikan_nama'),
                'produksi'    => $this->input->post('produksi'),
                'produksi_tahun'    => $this->input->post('produksi_tahun'),
                'kabupaten'     => $this->input->post('kabupaten'),
            );

            $insert = $this->model_ikan->save($insert);

            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function edit($id)
    {
        $query = $this->model_ikan->get($id);

        if ($query->num_rows() > 0) {

            $ikan = $query->row();

            $data = array(
                'title'         => 'Data Ikan',
                'page'          => 'edit',
                'row'           => $ikan,
                'kab'           => $this->db->query("select * from regencies"),
                'kabselected'   => $this->db->query("select * from regencies where id='$ikan->kabupaten'")->row(),
                'act_ikan'       => 'active',
            );

            $this->load->view('templates/backend/header', $data);
            $this->load->view('templates/backend/sidebar', $data);
            $this->load->view('admin/ikan/ikan_form', $data);
            $this->load->view('templates/backend/footer', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan.');</script>";
            echo "<script>window.location='" . site_url('data-ikan.html') . "'</script>";
        }
    }

    public function update()
    {
        $this->validation_for = 'update';
        $data = array();
        $data['status'] = TRUE;

        $this->_validate();

        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'ikan_nama'      => form_error('ikan_nama'),
                'produksi'    => form_error('produksi'),
                'produksi_tahun'    => form_error('produksi_tahun'),
                'kabupaten'     => form_error('kabupaten'),
            );
            $data = array(
                'status'         => FALSE,
                'errors'         => $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $update = array(
                'ikan_id'        => $this->input->post('ikan_id'),
                'ikan_nama'      => $this->input->post('ikan_nama'),
                'produksi'    => $this->input->post('produksi'),
                'produksi_tahun'    => $this->input->post('produksi_tahun'),
                'kabupaten'     => $this->input->post('kabupaten'),
            );

            $this->model_ikan->update(array('ikan_id' => $this->input->post('ikan_id')), $update);

            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('produksi', 'Produksi', 'trim|required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('produksi_tahun', 'Tahun Produksi', 'trim|required', array('required' => '%s belum dipilih'));
        $this->form_validation->set_rules('kabupaten', 'Kabupaten/Kota', 'trim|required', array('required' => '%s belum dipilih'));

        $name_unique = '';
        $getData = $this->model_ikan->get($this->input->post('ikan_id'))->row();

        if ($this->validation_for == 'add') {
            $name_unique = '|is_unique[ikan_tb.ikan_nama]';
        } else if ($this->validation_for == 'update') {
            if ($this->input->post('ikan_nama') != $getData->ikan_nama) {
                $name_unique = '|is_unique[ikan_tb.ikan_nama]';
            }
        }

        $this->form_validation->set_rules('ikan_nama', 'Nama Ikan', 'trim|required' . $name_unique, array('required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah terdaftar di sistem.'));
    }

    public function delete($id)
    {
        $this->model_ikan->delete_by_id($id);

        $data['status'] = TRUE;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
