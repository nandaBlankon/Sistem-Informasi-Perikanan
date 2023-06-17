<?php defined('BASEPATH') or exit('No direct script access allowed');

class nelayan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['model_user', 'model_kapal', 'model_nelayan']);
        check_not_login();
    }

    public function index()
    {
        $data['title']          = 'Data Nelayan';
        $data['act_nelayan']    = 'active';

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/sidebar', $data);
        $this->load->view('admin/nelayan/data_nelayan', $data);
        $this->load->view('templates/backend/footer', $data);
    }

    // start datatables server side
    function get_ajax()
    {
        $list = $this->model_nelayan->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $nelayan) {

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $nelayan->nik;
            $row[] = $nelayan->nelayan_nama;
            $row[] = $nelayan->nelayan_alamat;
            $row[] = $nelayan->nama_kapal;
            // add html for action
            $row[] = '<a href="javascript:void(0)" onclick="delete_nelayan(' . $nelayan->nelayan_id . ')" class="btn btn-kecil btn-bulat btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
            <a href="' . site_url('ubah-nelayan/' . $nelayan->nelayan_id) . '" class="btn btn-bulat btn-kecil btn-primary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->model_nelayan->count_all(),
            "recordsFiltered" => $this->model_nelayan->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    // end datatables server side

    public function tambah()
    {
        $nelayan = new stdClass;
        $nelayan->nelayan_id        = null;
        $nelayan->nik               = null;
        $nelayan->nelayan_nama      = null;
        $nelayan->nelayan_alamat    = null;
        $nelayan->kapal_id          = null;

        $data = array(
            'title'     => 'Data Nelayan',
            'page'      => 'tambah',
            'row'       => $nelayan,
            'kapal'     => $this->db->query("select * from kapal_tb"),
            'act_nelayan' => 'active',
        );

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/sidebar', $data);
        $this->load->view('admin/nelayan/nelayan_form', $data);
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
                'nik'               => form_error('nik'),
                'nelayan_nama'      => form_error('nelayan_nama'),
                'nelayan_alamat'    => form_error('nelayan_alamat'),
                'kapal_id'          => form_error('kapal_id'),
            );
            $data = array(
                'status'    => FALSE,
                'errors'    => $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $insert = array(
                'nik'               => $this->input->post('nik'),
                'nelayan_nama'      => $this->input->post('nelayan_nama'),
                'nelayan_alamat'    => $this->input->post('nelayan_alamat'),
                'kapal_id'          => $this->input->post('kapal_id'),
            );

            $insert = $this->model_nelayan->save($insert);

            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function edit($id)
    {
        $query = $this->model_nelayan->get($id);

        if ($query->num_rows() > 0) {

            $nelayan = $query->row();

            $data = array(
                'title'         => 'Data Nelayan',
                'page'          => 'edit',
                'row'           => $nelayan,
                'kapal'     => $this->db->query("select * from kapal_tb"),
                'kapalselected' => $this->db->query("select * from kapal_tb where kapal_id='$nelayan->kapal_id'")->row(),
                'act_nelayan'   => 'active',
            );

            $this->load->view('templates/backend/header', $data);
            $this->load->view('templates/backend/sidebar', $data);
            $this->load->view('admin/nelayan/nelayan_form', $data);
            $this->load->view('templates/backend/footer', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan.');</script>";
            echo "<script>window.location='" . site_url('data-nelayan.html') . "'</script>";
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
                'nik'               => form_error('nik'),
                'nelayan_nama'      => form_error('nelayan_nama'),
                'nelayan_alamat'    => form_error('nelayan_alamat'),
                'kapal_id'          => form_error('kapal_id'),
            );
            $data = array(
                'status'         => FALSE,
                'errors'         => $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $update = array(
                'nelayan_id'      => $this->input->post('nelayan_id'),
                'nik'               => $this->input->post('nik'),
                'nelayan_nama'      => $this->input->post('nelayan_nama'),
                'nelayan_alamat'    => $this->input->post('nelayan_alamat'),
                'kapal_id'          => $this->input->post('kapal_id'),
            );

            $this->model_nelayan->update(array('nelayan_id' => $this->input->post('nelayan_id')), $update);

            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('nelayan_nama', 'Nama', 'trim|required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('nelayan_alamat', 'Alamat', 'trim|required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('kapal_id', 'Kapal', 'trim|required', array('required' => '%s belum dipilih'));

        $nik_unique = '';
        $getData = $this->model_nelayan->get($this->input->post('nelayan_id'))->row();

        if ($this->validation_for == 'add') {
            $nik_unique = '|is_unique[nelayan_tb.nik]';
        } else if ($this->validation_for == 'update') {
            if ($this->input->post('nik') != $getData->nik) {
                $nik_unique = '|is_unique[nelayan_tb.nik]';
            }
        }

        $this->form_validation->set_rules('nik', 'NIK Nelayan', 'trim|required|min_length[16]|max_length[16]' . $nik_unique, array('required' => '%s tidak boleh kosong', 'min_length' => '%s harus 16 angka.', 'max_length' => '%s harus 16 angka.', 'is_unique' => '%s sudah terdaftar di sistem.'));
    }

    public function delete($id)
    {
        $this->model_nelayan->delete_by_id($id);

        $data['status'] = TRUE;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
