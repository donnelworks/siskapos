<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_status_tagihan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		cek_tidak_login();
		$this->load->model('laporan/lap_status_tagihan_m', 'mod');
	}

  public function index()
	{
		$data['judul'] = 'Laporan Status Tagihan';
		$this->load->view('laporan/lap_status_tagihan', $data);
	}

	public function filter_laporan()
	{
    $status = $this->input->get('status');
    // var_dump($status);
    // die;
    $data['judul'] = 'Laporan Status Tagihan';
    $data['list'] = $this->mod->get_data($status)->result();

		$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
		$html_pdf = $this->load->view('laporan/pdf/lap_status_tagihan_pdf', $data, TRUE);

    // Write PDF
    $mpdf->SetTitle($data['judul']);
    $mpdf->SetHTMLHeader('
		<table class="tbl-header" width="100%">
			<tr>
				<td rowspan="2">
					<img src="'. base_url() .'assets/dist/img/logo/logo-full-color.svg" style="width: 150px;">
				</td>
				<td rowspan="2">
					<p style="font-size: 18pt;">'.$data['judul'].'</p>
				</td>
				<td style="text-align: right;">
					<p>Tanggal: '.tgl_indo(date('Y-m-d')).'</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: right;">
					<p>Status: '.($status == 0 ? 'Belum Bayar' : ($status == 1 ? 'Bayar' : 'Semua')).'</p>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<hr style="height: 2px; border: none; background-color: #000;" />
				</td>
			</tr>
		</table>
    ');

		$mpdf->AddPage('L',
        '', '', '', '',
        20, // margin_left
        20, // margin right
       30, // margin top
       20, // margin bottom
        6, // margin header
        6); // margin footer
		$mpdf->WriteHTML($html_pdf);
		$mpdf->Output('Laporan Status Tagihan'.'.pdf', 'I');
	}

}
