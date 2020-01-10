<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Konfirmasi extends CI_Controller
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
        $konfirmasi = $this->konfirmasi_model->get_all($config['per_page'], $start, $q);
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'konfirmasi_data' => $konfirmasi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'konfirmasi',
            'judul' => 'Konfirmasi Gajih',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->konfirmasi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_konfirmasi' => $row->id_konfirmasi,
		'konfirmasi' => $row->konfirmasi,
		'gapok' => $row->gapok,
		'tukes' => $row->tukes,
		'tutra' => $row->tutra,
		'tupen' => $row->tupen,
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
	    'id_konfirmasi' => set_value('id_konfirmasi'),
	    'konfirmasi' => set_value('konfirmasi'),
	    'gapok' => set_value('gapok'),
	    'tukes' => set_value('tukes'),
	    'tutra' => set_value('tutra'),
        'tupen' => set_value('tupen'),
	    'tukel' => set_value('tukel'),
            'judul' => 'Data konfirmasi',
            'konten' => 'konfirmasi/konfirmasi_form',
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
		'konfirmasi' => $this->input->post('konfirmasi',TRUE),
		'gapok' => $this->input->post('gapok',TRUE),
		'tukes' => $this->input->post('tukes',TRUE),
		'tutra' => $this->input->post('tutra',TRUE),
        'tupen' => $this->input->post('tupen',TRUE),
		'tukel' => $this->input->post('tukel',TRUE),
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
		'id_konfirmasi' => set_value('id_konfirmasi', $row->id_konfirmasi),
		'konfirmasi' => set_value('konfirmasi', $row->konfirmasi),
		'gapok' => set_value('gapok', $row->gapok),
		'tukes' => set_value('tukes', $row->tukes),
		'tutra' => set_value('tutra', $row->tutra),
        'tupen' => set_value('tupen', $row->tupen),
		'tukel' => set_value('tukel', $row->tukel),
        'konten' => 'konfirmasi/konfirmasi_form',
            'judul' => 'Data konfirmasi',
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
            $this->update($this->input->post('id_konfirmasi', TRUE));
        } else {
            $data = array(
		'konfirmasi' => $this->input->post('konfirmasi',TRUE),
		'gapok' => $this->input->post('gapok',TRUE),
		'tukes' => $this->input->post('tukes',TRUE),
		'tutra' => $this->input->post('tutra',TRUE),
        'tupen' => $this->input->post('tupen',TRUE),
		'tukel' => $this->input->post('tukel',TRUE),
	    );

            $this->konfirmasi_model->update($this->input->post('id_konfirmasi', TRUE), $data);
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
	$this->form_validation->set_rules('konfirmasi', 'konfirmasi', 'trim|required');
	$this->form_validation->set_rules('gapok', 'gapok', 'trim|required');
	$this->form_validation->set_rules('tukes', 'tukes', 'trim|required');
	$this->form_validation->set_rules('tutra', 'tutra', 'trim|required');
	$this->form_validation->set_rules('tupen', 'tupen', 'trim|required');

	$this->form_validation->set_rules('id_konfirmasi', 'id_konfirmasi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file konfirmasi.php */
/* Location: ./application/controllers/konfirmasi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-02 11:43:24 */
/* http://harviacode.com */