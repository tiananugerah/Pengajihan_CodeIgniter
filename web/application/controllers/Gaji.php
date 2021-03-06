<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gaji extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Gaji_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'gaji/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'gaji/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'gaji/index.html';
            $config['first_url'] = base_url() . 'gaji/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Gaji_model->total_rows($q);
        $gaji = $this->Gaji_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'gaji_data' => $gaji,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'gaji/gaji_list',
            'judul' => 'Data Gaji Karyawan',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Gaji_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_gaji' => $row->id_gaji,
		'tgl' => $row->tgl,
		'nik' => $row->nik,
	    );
            $this->load->view('gaji/gaji_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gaji'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('gaji/create_action'),
	    'id_gaji' => set_value('id_gaji'),
	    'tgl' => set_value('tgl'),
	    'nik' => set_value('nik'),
        'konten' => 'gaji/gaji_form',
            'judul' => 'Data Gaji Karyawan',
    );
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $nik = $this->input->post('nik',TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tgl' => $this->input->post('tgl',TRUE),
		'nik' => $this->input->post('nik',TRUE),
        );
            $d = $this->db->query("SELECT * from karyawan where nik='$nik'")->row();
            $isi='<a href=\''.site_url('karyawan').'gajikaryawan/email/emailgaji/'.$nik.'/'.$tgl.'>VERIFIKASI KLIK DISINI</a>';
            $emailtujuan = $d->email;
            $subject = "Konfirmasi Gaji";
            $this->Gaji_model->email($subject,$isi,$emailtujuan);
            $this->Gaji_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('gaji'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Gaji_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('gaji/update_action'),
		'id_gaji' => set_value('id_gaji', $row->id_gaji),
		'tgl' => set_value('tgl', $row->tgl),
		'nik' => set_value('nik', $row->nik),
        'konten' => 'gaji/gaji_form',
            'judul' => 'Data Gaji Karyawan',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gaji'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $nik = $this->input->post('nik',TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_gaji', TRUE));
        } else {
            $data = array(
		'tgl' => $this->input->post('tgl',TRUE),
		'nik' => $this->input->post('nik',TRUE),
        );
        
            $d = $this->db->query("SELECT * from karyawan where nik='$nik'")->row();
            $isi='<a href=\'http://localhost/gajikaryawan/email/emailgaji/'.$nik.'/'.$tgl.'\>VERIFIKASI KLIK DISINI</a>';
            $emailtujuan = $d->email;
            $subject = "Konfirmasi Gaji";
            $this->Gaji_model->email($subject,$isi,$emailtujuan);
            $this->Gaji_model->update($this->input->post('id_gaji', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('gaji'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Gaji_model->get_by_id($id);

        if ($row) {
            $this->Gaji_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('gaji'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gaji'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');

	$this->form_validation->set_rules('id_gaji', 'id_gaji', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Gaji.php */
/* Location: ./application/controllers/Gaji.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-03 07:54:31 */
/* http://harviacode.com */