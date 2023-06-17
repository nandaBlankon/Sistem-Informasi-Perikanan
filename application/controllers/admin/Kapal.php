<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kapal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['model_user', 'model_kapal']);
        check_not_login();
    }

    public function index()
    {
        $data['title']      = 'Data Kapal';
        $data['act_kapal']  = 'active';

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/sidebar', $data);
        $this->load->view('admin/kapal/data_kapal', $data);
        $this->load->view('templates/backend/footer', $data);
    }

    // start datatables server side
    function get_ajax()
    {
        $list = $this->model_kapal->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $kapal) {
            $datanelayan = $this->db->query("SELECT COUNT(nelayan_tb.nelayan_id) as jml_abk FROM nelayan_tb WHERE kapal_id = '$kapal->kapal_id'");
            $jml_abk = $datanelayan->row()->jml_abk;

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $kapal->kapal_jenis;
            $row[] = $kapal->kapal_nama;
            $row[] = $kapal->kapasitas . " <small>GT</small>";
            $row[] = $kapal->jumlah_abk == null ? '0 <small>Org</small>' : $kapal->jumlah_abk . ' <small>Org</small>';
            // $row[] = $jml_abk . " <small>Orang</small>";
            // add html for action
            $row[] = '<a href="javascript:void(0)" onclick="delete_kapal(' . $kapal->kapal_id . ')" class="btn btn-kecil btn-bulat btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
            <a href="' . site_url('ubah-kapal/' . $kapal->kapal_id) . '" class="btn btn-bulat btn-kecil btn-primary" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->model_kapal->count_all(),
            "recordsFiltered" => $this->model_kapal->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    // end datatables server side

    public function tambah()
    {
        $kapal = new stdClass;
        $kapal->kapal_id      = null;
        $kapal->kapal_jenis   = null;
        $kapal->kapal_nama    = null;
        $kapal->kapasitas     = null;
        $kapal->jumlah_abk    = null;

        $data = array(
            'title'     => 'Data Kapal',
            'page'      => 'tambah',
            'row'       => $kapal,
            'kab'       => $this->db->query("select * from regencies where province_id=11"),
            'act_kapal' => 'active',
        );

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/sidebar', $data);
        $this->load->view('admin/kapal/kapal_form', $data);
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
                'kapal_jenis'   => form_error('kapal_jenis'),
                'kapal_nama'    => form_error('kapal_nama'),
                'kapasitas'     => form_error('kapasitas'),
                'jumlah_abk'    => form_error('jumlah_abk'),
            );
            $data = array(
                'status'         => FALSE,
                'errors'         => $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $insert = array(
                'kapal_id'      => $this->input->post('kapal_id'),
                'kapal_jenis'   => $this->input->post('kapal_jenis'),
                'kapal_nama'    => $this->input->post('kapal_nama'),
                'kapasitas'     => $this->input->post('kapasitas'),
                'kapasitas'     => $this->input->post('jumlah_abk'),
            );

            $insert = $this->model_kapal->save($insert);

            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function edit($id)
    {
        $query = $this->model_kapal->get($id);

        if ($query->num_rows() > 0) {

            $kapal = $query->row();

            $data = array(
                'title'         => 'Data Kapal',
                'page'          => 'edit',
                'row'           => $kapal,
                'act_kapal'     => 'active',
            );

            $this->load->view('templates/backend/header', $data);
            $this->load->view('templates/backend/sidebar', $data);
            $this->load->view('admin/kapal/kapal_form', $data);
            $this->load->view('templates/backend/footer', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan.');</script>";
            echo "<script>window.location='" . site_url('data-kapal.html') . "'</script>";
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
                'kapal_jenis'   => form_error('kapal_jenis'),
                'kapal_nama'    => form_error('kapal_nama'),
                'kapasitas'     => form_error('kapasitas'),
                'jumlah_abk'    => form_error('jumlah_abk'),
            );
            $data = array(
                'status'         => FALSE,
                'errors'         => $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $update = array(
                'kapal_id'      => $this->input->post('kapal_id'),
                'kapal_jenis'   => $this->input->post('kapal_jenis'),
                'kapal_nama'    => $this->input->post('kapal_nama'),
                'kapasitas'     => $this->input->post('kapasitas'),
                'jumlah_abk'    => $this->input->post('jumlah_abk'),
            );

            $this->model_kapal->update(array('kapal_id' => $this->input->post('kapal_id')), $update);

            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('kapal_jenis', 'Jenis kapal', 'trim|required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('kapal_nama', 'Nama kapal', 'trim|required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'trim|required', array('required' => '%s tidak boleh kosong'));
        $this->form_validation->set_rules('jumlah_abk', 'Jumlah ABK', 'trim|required', array('required' => '%s tidak boleh kosong'));
    }

    public function delete($id)
    {
        $this->model_kapal->delete_by_id($id);

        $data['status'] = TRUE;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
