<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class konfirmasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('konfirmasi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'konfirmasi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'konfirmasi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'konfirmasi/index.html';
            $config['first_url'] = base_url() . 'konfirmasi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->konfirmasi_model->total_rows($q);
        $konfirmasi = $this->konfirmasi_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'konfirmasi_data' => $konfirmasi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'konfirmasi/konfirmasi_list',
            'judul' => 'Data konfirmasi Gaji',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->konfirmasi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_gaji' => $row->id_gaji,
		'tgl' => $row->tgl,
		'nik' => $row->nik,
		'konfirmasi' => $row->konfirmasi,
		'kirim' => $row->kirim,
	    );
            $this->load->view('konfirmasi/konfirmasi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('konfirmasi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('konfirmasi/create_action'),
	    'id_gaji' => set_value('id_gaji'),
	    'tgl' => set_value('tgl'),
	    'nik' => set_value('nik'),
	    'konfirmasi' => set_value('konfirmasi'),
	    'kirim' => set_value('kirim'),
        'konten' => 'konfirmasi/konfirmasi_form',
            'judul' => 'Data konfirmasi Karyawan',
    );
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tgl' => $this->input->post('tgl',TRUE),
		'nik' => $this->input->post('nik',TRUE),
		'konfirmasi' => $this->input->post('konfirmasi',TRUE),
		'kirim' => $this->input->post('kirim',TRUE),
	    );

            $this->konfirmasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('konfirmasi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->konfirmasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('konfirmasi/update_action'),
		'id_gaji' => set_value('id_gaji', $row->id_gaji),
		'tgl' => set_value('tgl', $row->tgl),
		'nik' => set_value('nik', $row->nik),
		'konfirmasi' => set_value('konfirmasi', $row->konfirmasi),
		'kirim' => set_value('kirim', $row->kirim),
        'konten' => 'konfirmasi/konfirmasi_form',
            'judul' => 'Data konfirmasi Karyawan',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('konfirmasi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_gaji', TRUE));
        } else {
            $data = array(
		'tgl' => $this->input->post('tgl',TRUE),
		'nik' => $this->input->post('nik',TRUE),
		'konfirmasi' => $this->input->post('konfirmasi',TRUE),
		'kirim' => $this->input->post('kirim',TRUE),
	    );

            $this->konfirmasi_model->update($this->input->post('id_gaji', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('konfirmasi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->konfirmasi_model->get_by_id($id);

        if ($row) {
            $this->konfirmasi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('konfirmasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('konfirmasi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');
	$this->form_validation->set_rules('konfirmasi', 'konfirmasi', 'trim|required');
	$this->form_validation->set_rules('kirim', 'kirim', 'trim|required');
	$this->form_validation->set_rules('id_gaji', 'id_gaji', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file konfirmasi.php */
/* Location: ./application/controllers/konfirmasi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-03 07:54:31 */
/* http://harviacode.com */