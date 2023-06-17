<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tpi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['model_user', 'model_tpi']);
        check_not_login();
    }

    public function index()
    {
        $data['title']      = 'Data TPI';
        $data['act_tpi']    = 'active';

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/sidebar', $data);
        $this->load->view('admin/tpi/data_tpi', $data);
        $this->load->view('templates/backend/footer', $data);
    }

    // start datatables server side
    function get_ajax()
    {
        $list = $this->model_tpi->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $tpi) {

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $tpi->tpi_nama;
            $row[] = $tpi->tpi_alamat;
            $row[] = $tpi->nama_kabupaten;
            // add html for action
            $row[] = '<a href="javascript:void(0)" onclick="delete_tpi(' . $tpi->tpi_id . ')" class="btn btn-kecil btn-bulat btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
            <a href="' . site_url('ubah-tpi/' . $tpi->tpi_id) . '" class="btn btn-bulat btn-kecil btn-primary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->model_tpi->count_all(),
            "recordsFiltered" => $this->model_tpi->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    // end datatables server side

    public function tambah()
    {
        $tpi = new stdClass;
        $tpi->tpi_id        = null;
        $tpi->tpi_nama      = null;
        $tpi->tpi_alamat    = null;
        $tpi->kabupaten     = null;

        $data = array(
            'title'     => 'Data TPI',
            'page'      => 'tambah',
            'row'       => $tpi,
            'kab'       => $this->db->query("select * from regencies"),
            'act_tpi'   => 'active',
        );

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/sidebar', $data);
        $this->load->view('admin/tpi/tpi_form', $data);
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
                'tpi_nama'      => form_error('tpi_nama'),
                'tpi_alamat'    => form_error('tpi_alamat'),
                'kabupaten'     => form_error('kabupaten'),
            );
            $data = array(
                'status'    => FALSE,
                'errors'    => $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $insert = array(
                'tpi_id'        => $this->input->post('tpi_id'),
                'tpi_nama'      => $this->input->post('tpi_nama'),
                'tpi_alamat'    => $this->input->post('tpi_alamat'),
                'kabupaten'     => $this->input->post('kabupaten'),
            );

            $insert = $this->model_tpi->save($insert);

            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function edit($id)
    {
        $query = $this->model_tpi->get($id);

        if ($query->num_rows() > 0) {

            $tpi = $query->row();

            $data = array(
                'title'         => 'Data tpi',
                'page'          => 'edit',
                'row'           => $tpi,
                'kab'           => $this->db->query("select * from regencies"),
                'kabselected'   => $this->db->query("select * from regencies where id='$tpi->kabupaten'")->row(),
                'act_tpi'       => 'active',
            );

            $this->load->view('templates/backend/header', $data);
            $this->load->view('templates/backend/sidebar', $data);
            $this->load->view('admin/tpi/tpi_form', $data);
            $this->load->view('templates/backend/footer', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan.');</script>";
            echo "<script>window.location='" . site_url('data-tpi.html') . "'</script>";
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
                'tpi_nama'      => form_error('tpi_nama'),
                'tpi_alamat'    => form_error('tpi_alamat'),
                'kabupaten'     => form_error('kabupaten'),
            );
            $data = array(
                'status'         => FALSE,
                'errors'         => $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $update = array(
                'tpi_id'        => $this->input->post('tpi_id'),
                'tpi_nama'      => $this->input->post('tpi_nama'),
                'tpi_alamat'    => $this->input->post('tpi_alamat'),
                'kabupaten'     => $this->input->post('kabupaten'),
            );

            $this->model_tpi->update(array('tpi_id' => $this->input->post('tpi_id')), $update);

            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('tpi_alamat', 'Alamat TPI', 'trim|required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('kabupaten', 'Kabupaten/Kota', 'trim|required', array('required' => '%s belum dipilih'));

        $name_unique = '';
        $getData = $this->model_tpi->get($this->input->post('tpi_id'))->row();

        if ($this->validation_for == 'add') {
            $name_unique = '|is_unique[tpi_tb.tpi_nama]';
        } else if ($this->validation_for == 'update') {
            if ($this->input->post('name') != $getData->tpi_nama) {
                $name_unique = '|is_unique[tpi_tb.tpi_nama]';
            }
        }

        $this->form_validation->set_rules('tpi_nama', 'Nama TPI', 'trim|required' . $name_unique, array('required' => '%s tidak boleh kosong', 'is_unique' => '%s sudah terdaftar di sistem.'));
    }

    public function delete($id)
    {
        $this->model_tpi->delete_by_id($id);

        $data['status'] = TRUE;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
