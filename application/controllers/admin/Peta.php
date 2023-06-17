<?php defined('BASEPATH') or exit('No direct script access allowed');

class Peta extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['model_user', 'model_peta']);
        check_not_login();
    }

    public function index()
    {
        $data['title']      = 'Data Peta';
        $data['row']        = $this->model_peta->get();
        $data['act_peta']   = 'active';

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/sidebar', $data);
        $this->load->view('admin/peta/data_peta', $data);
        $this->load->view('templates/backend/footer', $data);
    }

    public function tambah()
    {
        $peta = new stdClass;
        $peta->peta_id      = null;
        $peta->peta_nama    = null;
        $peta->kawasan      = null;
        $peta->image        = null;
        $peta->tahun        = null;
        $peta->bulan        = null;

        $data = array(
            'title'     => 'Data Peta',
            'page'      => 'tambah',
            'row'       => $peta,
            'act_peta' => 'active',
        );

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/sidebar', $data);
        $this->load->view('admin/peta/peta_form', $data);
        $this->load->view('templates/backend/footer', $data);
    }

    public function proses_tambah()
    {
        $config['upload_path']        = './uploads/peta/';
        $config['allowed_types']    = 'png|jpg|jpeg';
        $config['max_size']            = 2048;
        $config['file_name']        = 'peta-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null);

        if (isset($_POST['tambah'])) {
            $this->form_validation->set_rules('peta_nama', 'Nama Peta', 'trim|required', array('required' => 'Bagian ini wajib diisi.'));
            $this->form_validation->set_rules('kawasan', 'Kawasan', 'trim|required', array('required' => 'Bagian ini wajib diisi.'));
            $this->form_validation->set_rules('tahun', 'Tahun', 'trim|required', array('required' => 'Bagian ini wajib diisi.'));
            $this->form_validation->set_rules('bulan', 'Bulan', 'trim|required', array('required' => 'Bagian ini wajib diisi.'));

            $this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

            if ($this->form_validation->run() == FALSE) {
                $this->tambah();
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->model_peta->add($post);

                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('sukses', 'Peta berhasil ditambah');
                        }
                        redirect('tambah-peta.html');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('tambah-peta.html');
                    }
                } else {
                    $post['image'] = null;
                    $this->model_peta->add($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', 'Peta berhasil ditambah');
                    }
                    redirect('tambah-peta.html');
                }
            }
        } else if (isset($_POST['edit'])) {
            $this->form_validation->set_rules('peta_nama', 'Nama Peta', 'trim|required', array('required' => 'Bagian ini wajib diisi.'));
            $this->form_validation->set_rules('kawasan', 'Kawasan', 'trim|required', array('required' => 'Bagian ini wajib diisi.'));
            $this->form_validation->set_rules('tahun', 'Tahun', 'trim|required', array('required' => 'Bagian ini wajib diisi.'));
            $this->form_validation->set_rules('bulan', 'Bulan', 'trim|required', array('required' => 'Bagian ini wajib diisi.'));

            $this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('peta_id');
                $query = $this->model_peta->get($id);

                if ($query->num_rows() > 0) {
                    $this->edit($id);
                } else {
                    echo "<script> alert('Data tidak ditemukan.');";
                    echo "window.location='" . site_url('data-peta.html') . "';</script>";
                }
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {

                        $peta = $this->model_peta->get($post['peta_id'])->row();
                        if ($peta->image != null) {
                            $target_file = './uploads/peta/' . $peta->image;
                            unlink($target_file);
                        }

                        $post['image'] = $this->upload->data('file_name');
                        $this->model_peta->edit($post);

                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('sukses', 'Peta berhasil diperbaharui');
                        }
                        redirect('data-peta.html');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('ubah-peta/' . $post['peta_id']);
                    }
                } else {
                    $post['image'] = null;
                    $this->model_peta->edit($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', 'Peta berhasil diperbaharui');
                    }
                    redirect('data-peta.html');
                }
            }
        }
    }

    public function edit($id)
    {
        $query = $this->model_peta->get($id);

        if ($query->num_rows() > 0) {
            $peta = $query->row();
            $data = array(
                'title' => 'Data Peta',
                'page'     => 'edit',
                'row'    => $peta,
                'act_peta'        => 'active'
            );

            $this->load->view('templates/backend/header', $data);
            $this->load->view('templates/backend/sidebar', $data);
            $this->load->view('admin/peta/peta_form', $data);
            $this->load->view('templates/backend/footer', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan.');</script>";
            echo "<script>window.location='" . site_url('data-peta.html') . "'</script>";
        }
    }

    public function delete($id)
    {
        $peta = $this->model_peta->get($id)->row();
        if ($peta->image != null) {
            $target_file = './uploads/peta/' . $peta->image;
            unlink($target_file);
        }
        $this->model_peta->delete_by_id($id);

        $data['status'] = TRUE;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
