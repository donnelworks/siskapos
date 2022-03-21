<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_penjualan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		cek_tidak_login();
		$this->load->model([
      'laporan/Lap_penjualan_m' => 'mod',
      'konsumen_m' => 'mod_ksm',
    ]);
	}

  public function index()
	{
		$data['judul'] = 'Laporan Penjualan';
		$data['konsumen'] = $this->mod_ksm->detail_data()->result();
		$this->load->view('laporan/lap_penjualan', $data);
	}

	public function filter_laporan()
	{
    $get = $this->input->get();
    $data['judul'] = 'Laporan Penjualan';
    $data['periode_awal'] = $get['awal'];
    $data['periode_akhir'] = $get['akhir'];
    $data['konsumen'] = $this->mod_ksm->detail_data($get['konsumen'])->row();
    $data['list'] = $this->mod->get_data($get)->result();
    $data['total'] = $this->mod->total($get)->row();

		$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
		$html_pdf = $this->load->view('laporan/pdf/lap_penjualan_pdf', $data, TRUE);

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
					<p>Periode: '.$get['awal'].' s/d '.$get['akhir'].'</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: right;">
					<p>Konsumen: '.($get['konsumen'] == null ? 'Semua' : $data['konsumen']->nama).'</p>
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
		$mpdf->Output('Laporan Penjualan'.'.pdf', 'I');
	}

}
