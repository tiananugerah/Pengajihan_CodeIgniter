<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller
{	
	public function index()
	{
        
    }
		
    public function email($subject,$isi,$emailtujuan)
    {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'tiananugerah14@gmail.com';
        $config['smtp_pass'] = 'tianganteng'; //ini pake akun pass google email
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = 'TRUE';
        $config['newline'] = "\r\n";
  
        $this->load->library('email', $config);
        $this->email->initialize($config);
  
        $this->email->from(tiananugerah14@gmail.com);
        $this->email->to($emailtujuan);
        $this->email->subject($subject);
        $this->email->message($isi);
        $this->email->set_mailtype('html');
        $this->email->send();	
    }

    function emailgaji($nik, $tgl){

		$data = array(
			'nik' => $nik,
			'tgl' => $tgl,
		);
		$this->load->view('emailgaji', $data);
	}
	
}
