<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_komisi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		cek_tidak_login();
		$this->load->model([
      'laporan/lap_komisi_m' => 'mod',
      'utilitas/user_m' => 'mod_usr',
    ]);
	}

  public function index()
	{
		$data['judul'] = 'Laporan Komisi';
		$this->load->view('laporan/lap_komisi', $data);
	}

  public function get_user()
	{
		$level = $this->input->get('level');
		$data = $this->mod->get_user($level)->result();
		echo json_encode($data);
	}

	public function filter_laporan()
	{
    $get = $this->input->get();
    $data['judul'] = 'Laporan Komisi';
    $user = $this->mod_usr->detail_data($get['user'])->row();
    $data['level'] = $get['level'];
    $data['list'] = $this->mod->get_data($get)->result();
    $data['total'] = $this->mod->total($get)->row();

		$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
		$html_pdf = $this->load->view('laporan/pdf/lap_komisi_pdf', $data, TRUE);

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
					<p>User: '.$user->nama_user.'</p>
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
		$mpdf->Output('Laporan Komisi'.'.pdf', 'I');
	}

}
