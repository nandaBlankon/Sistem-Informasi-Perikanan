<?php defined('BASEPATH') or exit('No direct script access allowed');

class Survei extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['model_user', 'model_survei']);
        check_not_login();
    }

    public function index()
    {
        $pertanyaan = new stdClass;
        $pertanyaan->pertanyaan_id      = null;
        $pertanyaan->pertanyaan_text    = null;

        $data['pertanyaan'] = $this->db->get('pertanyaan_tb')->result();

        // Mengambil data statistik jawaban berdasarkan pertanyaan
        $jawaban_statistik = array();
        foreach ($data['pertanyaan'] as $row) {
            $query = $this->db->select('jawaban_isi, COUNT(*) as jumlah')
                ->where('pertanyaan_id', $row->pertanyaan_id)
                ->group_by('jawaban_isi')
                ->get('jawaban_tb');

            $statistik = array();
            foreach ($query->result() as $result) {
                $statistik[$result->jawaban_isi] = array(
                    'jumlah' => $result->jumlah,
                    'persentase' => round(($result->jumlah / $query->num_rows()) * 100, 2)
                );
            }
            $jawaban_statistik[$row->pertanyaan_id] = $statistik;
        }

        $data['jawaban_statistik'] = $jawaban_statistik;

        $data['title']      = 'Data Survei';
        $data['data']        = $this->model_survei->getPertanyaan();
        $data['row']        = $pertanyaan;
        $data['act_survei']   = 'active';

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/sidebar', $data);
        $this->load->view('admin/survei/data_survei', $data);
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
                'pertanyaan_text'    => form_error('pertanyaan_text'),
            );
            $data = array(
                'status'         => FALSE,
                'errors'         => $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $insert = array(
                'pertanyaan_id'      => $this->input->post('pertanyaan_id'),
                'pertanyaan_text'   => $this->input->post('pertanyaan_text'),
            );

            $insert = $this->model_survei->save($insert);

            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('pertanyaan_text', 'Isi Pertanyaan', 'trim|required', array('required' => '%s wajib diisi'));
    }

    public function edit($id)
    {
        $query = $this->model_survei->get_by_id($id);

        echo json_encode($query);
    }

    public function update()
    {
        $this->_validate();
        $data = array(
            'pertanyaan_id'      => $this->input->post('pertanyaan_id'),
            'pertanyaan_text'   => $this->input->post('pertanyaan_text'),
        );

        $update = $this->model_survei->update(array('pertanyaan_id' => $this->input->post('pertanyaan_id')), $data);

        if ($update) {
            $data = array('status' => "success");
        } else {
            $data = array('status' => "error");
        }
        echo json_encode(array("status" => TRUE));
    }

    public function delete($id)
    {
        $this->model_survei->delete_by_id($id);

        $data['status'] = TRUE;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
