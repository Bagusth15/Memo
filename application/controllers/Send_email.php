<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Send_email extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function send(){
		
		 $subject = 'Memo Internal Approved - ' . $this->input->post("p_user_name"); //subjek di pesan email

		 $config = [
		 	'protocol'  => 'smtp',
		 	'smtp_host' => 'ssl://smtp.googlemail.com',
		 	'smtp_user' => 'memo.in.aja@gmail.com',
		 	'smtp_pass' => 'Memo050798',
		 	'smtp_port' => 465,
		 	'mailtype'  => 'html',
		 	'charset'   => 'utf-8',
		 	'newline'   => "\r\n"
		 ];

		 $message = '
		 <table border="1" cellpadding="5" width="100%" style="border: solid black;">
		 <tr>
		 <td colspan="3" align="center">Memo Internal</td>
		 </tr>
		 <tr>
		 <td colspan="3">
		 <table width="100%">
		 <tr>
		 <td width="10%">No</td>
		 <td width="1%">:</td>
		 <td width="89%">'.$this->input->post("p_mm_id").' / MI / PTHG</td>
		 </tr>
		 <tr>
		 <td>Tanggal</td>
		 <td>:</td>
		 <td>'.$this->input->post("p_mm_tgl_buat").'</td>
		 </tr>
		 <tr>
		 <td>Kepada</td>
		 <td>:</td>
		 <td>'.$this->input->post("p_user_name").'</td>
		 </tr>
		 <tr>
		 <td>Hal</td>
		 <td>:</td>
		 <td>'.$this->input->post("p_mm_perihal").'</td>
		 </tr>
		 </table>
		 </td>
		 </tr>
		 <tr>
		 <td colspan="3">
		 <table width="100%">
		 <tr>
		 <td width="10%">Rincian</td>
		 <td width="1%" >:</td>
		 <td width="89%" align="justify">'.$this->input->post("p_mm_isi").'</td>
		 </tr>
		 </table>
		 </td>
		 </tr>
		 <tr>
		 <td colspan="3">
		 <table width="100%">
		 <tr>
		 <td width="10%">Note</td>
		 <td width="1%">:</td>
		 <td width="89%" align="justify">'.$this->input->post("p_mm_note").'</td>
		 </tr>
		 </table>
		 </td>
		 </tr>
		 <tr>
		 <tr>
		 <td align="center" width="33%"><h1><b>✔</b></h1><br>(Prepared)</td>
		 <td align="center" width="34%"><h1><b>✔</b></h1><br>(Review)</td>
		 <td align="center" width="33%"><h1><b>✔</b></h1><br>(Approved)</td>
		 </tr>
		 </tr>
		 <tr>
		 <td colspan="3">
		 <table width="100%">
		 <tr>
		 <td style="color: red;">* You can download this file in application</td>
		 </tr>
		 </table>
		 </td>

		 </tr>
		 </table>
		 ';

		 $this->email->initialize($config);

		 $this->email->from('memo.in.aja@gmail.com', 'Web Memo');
		 $this->email->to($this->input->post('p_pengirim'));
		 $this->email->subject($subject);
		 $this->email->message($message);
		 if ($this->email->send()) {
		 	$data = [
		 		"ma_mm_id" => $this->input->post('p_mm_id', true),
		 		"ma_by" => $this->input->post('p_by', true),
		 		"ma_date" => time(),
		 		"ma_status" => 2
		 	];
		 	$this->db->insert('tbl_memo_activity', $data);

		 	$data2 = [
		 		"mm_status" => 2,
		 	];

		 	$this->db->where('mm_id', $this->input->post('p_mm_id', true));
		 	$this->db->update('tbl_memo', $data2);


		 	$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Memo success to publish!</div>');
		 	redirect('memo/detail/'.$this->input->post("p_mm_id"));
		 	return true;
		 } else {
		 	echo $this->email->print_debugger();
		 	die;
		 }


		}
	}