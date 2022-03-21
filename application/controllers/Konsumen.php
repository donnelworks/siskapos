<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class Konsumen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		cek_tidak_login();
		$this->load->model([
			'konsumen_m' => 'mod',
			'transaksi/proses_tagihan_m' => 'mod_tgh'
		]);
	}

	public function index()
	{
		$data['judul'] = 'Konsumen';
		$data['produk'] = $this->mod->load_produk()->result();
		$data['sales'] = $this->mod->load_sales()->result();
		$data['db'] = $this->mod->load_db()->result();
		$data['kurir'] = $this->mod->load_kurir()->result();
		$this->load->view('konsumen', $data);
	}

	public function load_data()
  {
		$post = $this->input->post();
    header('Content-Type: application/json');
    echo $this->mod->load_data($post);
  }

	public function detail_data()
  {
		$id = $this->input->get('id');
		$data = $this->mod->detail_data($id)->row();
    echo json_encode($data);
  }

	public function tambah()
  {
    $post = $this->input->post();
		$data = ['sukses' => false, 'error' => []];

		$this->form_validation->set_rules('kode', 'Kode', 'trim|required|callback_kode');
		$this->form_validation->set_rules('pin', 'PIN', 'trim|required|numeric|max_length[4]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No. Hp.', 'trim|required');
		$this->form_validation->set_rules('no_pesanan', 'No. Pesanan', 'trim|required');
		$this->form_validation->set_rules('produk', 'Produk', 'trim|required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'trim|required|numeric');
		$this->form_validation->set_rules('sales', 'Sales', 'trim|required');
		$this->form_validation->set_rules('komisi_sales', 'Komisi Sales', 'trim|required|numeric');
		$this->form_validation->set_rules('db', 'DB', 'trim|required');
		$this->form_validation->set_rules('komisi_db', 'Komisi DB', 'trim|required|numeric');
		$this->form_validation->set_rules('kurir', 'Kurir', 'trim|required');
		$this->form_validation->set_rules('komisi_kurir', 'Komisi Kurir', 'trim|required|numeric');
		$this->form_validation->set_error_delimiters('<span class="text-danger invalid-message">', '</span>');

		$this->form_validation->set_message('required', 'Kolom {field} wajib diisi!');
		$this->form_validation->set_message('numeric', 'Kolom {field} diisi dengan angka!');
		$this->form_validation->set_message('max_length', 'Kolom {field} maksimal 4 digit!');

		if ($this->form_validation->run()) {
      $this->mod->tambah($post);
      $data['sukses'] = true;
		} else {
			foreach ($post as $key => $value) {
			 	$data['error'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
  }

	public function ubah()
  {
    $post = $this->input->post();
		$data = ['sukses' => false, 'error' => []];

		$this->form_validation->set_rules('kode', 'Kode', 'trim|required|callback_ubah_kode');
		$this->form_validation->set_rules('pin', 'PIN', 'trim|required|numeric|max_length[4]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No. Hp.', 'trim|required');
		$this->form_validation->set_rules('no_pesanan', 'No. Pesanan', 'trim|required');
		$this->form_validation->set_rules('produk', 'Produk', 'trim|required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'trim|required|numeric');
		$this->form_validation->set_rules('sales', 'Sales', 'trim|required');
		$this->form_validation->set_rules('komisi_sales', 'Komisi Sales', 'trim|required|numeric');
		$this->form_validation->set_rules('db', 'DB', 'trim|required');
		$this->form_validation->set_rules('komisi_db', 'Komisi DB', 'trim|required|numeric');
		$this->form_validation->set_rules('kurir', 'Kurir', 'trim|required');
		$this->form_validation->set_rules('komisi_kurir', 'Komisi Kurir', 'trim|required|numeric');
		$this->form_validation->set_error_delimiters('<span class="text-danger invalid-message">', '</span>');

		$this->form_validation->set_message('required', 'Kolom {field} wajib diisi!');
		$this->form_validation->set_message('numeric', 'Kolom {field} diisi dengan angka!');

		if ($this->form_validation->run()) {
      $this->mod->ubah($post);
      $data['sukses'] = true;
		} else {
			foreach ($post as $key => $value) {
			 	$data['error'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
  }

	public function hapus()
  {
    $id = $this->input->post('id');
		$data['sukses'] = true;
		if ($this->mod_tgh->cek_rows_tgh_list(array('id_konsumen' => $id))->num_rows() == 0) {
			$this->mod->hapus($id);
		} else {
			$data['sukses'] = false;
		}
		echo json_encode($data);
  }

	public function ubah_status()
	{
		$post = $this->input->post();
		$this->mod->ubah_status($post);
	}

	public function kode($kode)
	{
		$where = array('kode' => $kode);
		$cek = $this->mod->cek_data($where, 1);
	  if ($cek){
		  $this->form_validation->set_message('kode', '{field} sudah terdaftar!');
		  return FALSE;
	  }else{
		  return TRUE;
	  }
  }

	public function ubah_kode($kode)
	{
		$id = $this->input->post('id');
		$where = array('kode' => $kode, 'id !=' => $id);
		$cek = $this->mod->cek_data($where, 1);
	  if ($cek){
		  $this->form_validation->set_message('ubah_kode', '{field} sudah terdaftar!');
		  return FALSE;
	  }else{
		  return TRUE;
	  }
  }

	public function export()
	{
		// $data = $this->mod->load_data();
		$produk = $this->mod->load_produk();
		$sales = $this->mod->load_sales();
		$db = $this->mod->load_db();
		$kurir = $this->mod->load_kurir();

		$spreadsheet = new Spreadsheet();

		// SHEET KONSUMEN
		$sheet_1 = $spreadsheet->getActiveSheet()->setTitle("KONSUMEN");
		$sheet_1->setCellValue('A1', 'KODE');
		$sheet_1->setCellValue('B1', 'NAMA');
		$sheet_1->setCellValue('C1', 'PIN');
		$sheet_1->setCellValue('D1', 'NO. HP.');
		$sheet_1->setCellValue('E1', 'NO. PESANAN');
		$sheet_1->setCellValue('F1', 'KOTA');
		$sheet_1->setCellValue('G1', 'ALAMAT');
		$sheet_1->setCellValue('H1', 'DETAIL ANGSURAN');
		$sheet_1->setCellValue('I1', 'CATATAN');
		$sheet_1->setCellValue('J1', 'PRODUK');
		$sheet_1->setCellValue('K1', 'NOMINAL');
		$sheet_1->setCellValue('L1', 'SALES');
		$sheet_1->setCellValue('M1', 'KOMISI SALES');
		$sheet_1->setCellValue('N1', 'DB');
		$sheet_1->setCellValue('O1', 'KOMISI DB');
		$sheet_1->setCellValue('P1', 'KURIR');
		$sheet_1->setCellValue('Q1', 'KOMISI KURIR');

		$sheet_1->getComment('A1')->setHeight('80px')->getText()->createTextRun('Wajib Diisi & Kode Tidak Boleh Sama');
		$sheet_1->getComment('B1')->setHeight('80px')->getText()->createTextRun('Wajib Diisi');
		$sheet_1->getComment('C1')->setHeight('80px')->getText()->createTextRun('Wajib Diisi');
		$sheet_1->getComment('D1')->setHeight('80px')->getText()->createTextRun('Wajib Diisi');
		$sheet_1->getComment('E1')->setHeight('80px')->getText()->createTextRun('Wajib Diisi');
		$sheet_1->getComment('F1')->setHeight('80px')->getText()->createTextRun('Wajib Diisi');
		$sheet_1->getComment('G1')->setHeight('80px')->getText()->createTextRun('Wajib Diisi');
		$sheet_1->getComment('J1')->setHeight('150px')->getText()->createTextRun('Wajib Diisi & Isi Dengan Format "kode-nama" (lihat pada sheet PRODUK)');
		$sheet_1->getComment('K1')->setHeight('80px')->getText()->createTextRun('Wajib Diisi');
		$sheet_1->getComment('L1')->setHeight('150px')->getText()->createTextRun('Wajib Diisi & Isi Dengan Format "id-nama" (lihat pada sheet SALES)');
		$sheet_1->getComment('M1')->setHeight('80px')->getText()->createTextRun('Wajib Diisi');
		$sheet_1->getComment('N1')->setHeight('150px')->getText()->createTextRun('Wajib Diisi & Isi Dengan Format "id-nama" (lihat pada sheet DB)');
		$sheet_1->getComment('O1')->setHeight('80px')->getText()->createTextRun('Wajib Diisi');
		$sheet_1->getComment('P1')->setHeight('150px')->getText()->createTextRun('Wajib Diisi & Isi Dengan Format "id-nama" (lihat pada sheet KURIR)');
		$sheet_1->getComment('Q1')->setHeight('80px')->getText()->createTextRun('Wajib Diisi');

		foreach(range('A','Q') as $col_id) {
			$sheet_1->getColumnDimension($col_id)->setAutoSize(true);
		}
		// .SHEET KONSUMEN

		// SHEET PRODUK
		$sheet_2 = $spreadsheet->createSheet()->setTitle("PRODUK");
		$sheet_2->setCellValue('A1', 'KODE-NAMA');
		$r = 2;
		foreach ($produk->result() as $row) {
			$sheet_2->setCellValue('A'.$r, "$row->kode-$row->nama");
			$r++;
		}
		$sheet_2->getColumnDimension('A')->setAutoSize(true);
		// .SHEET PRODUK

		// SHEET SALES
		$sheet_3 = $spreadsheet->createSheet()->setTitle("SALES");
		$sheet_3->setCellValue('A1', 'ID-NAMA');
		$r = 2;
		foreach ($sales->result() as $row) {
			$sheet_3->setCellValue('A'.$r, "$row->id_user-$row->nama_user");
			$r++;
		}
		$sheet_3->getColumnDimension('A')->setAutoSize(true);
		// .SHEET SALES

		// SHEET DB
		$sheet_4 = $spreadsheet->createSheet()->setTitle("DB");
		$sheet_4->setCellValue('A1', 'ID-NAMA');
		$r = 2;
		foreach ($db->result() as $row) {
			$sheet_4->setCellValue('A'.$r, "$row->id_user-$row->nama_user");
			$r++;
		}
		$sheet_4->getColumnDimension('A')->setAutoSize(true);
		// .SHEET DB

		// SHEET KURIR
		$sheet_5 = $spreadsheet->createSheet()->setTitle("KURIR");
		$sheet_5->setCellValue('A1', 'ID-NAMA');
		$r = 2;
		foreach ($kurir->result() as $row) {
			$sheet_5->setCellValue('A'.$r, "$row->id_user-$row->nama_user");
			$r++;
		}
		$sheet_5->getColumnDimension('A')->setAutoSize(true);
		// .SHEET KURIR

		// WRITE
		$writer = new Xlsx($spreadsheet);
		$filename = "Template_Import_Konsumen";
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	public function import()
	{
		$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		$compid = $this->session->userdata('companyid');
    $username = $this->session->userdata('username');

		$data['sukses'] = true;
		$numeric = 0;

		if(isset($_FILES['file_xls']['name']) && in_array($_FILES['file_xls']['type'], $file_mimes)) {
			$arrfile = explode('.', $_FILES['file_xls']['name']);
			$extension = end($arrfile);
			if('csv' == $extension) {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet = $reader->load($_FILES['file_xls']['tmp_name']);
			$sheetdata = $spreadsheet->getActiveSheet('KONSUMEN')->toArray();

			for($r = 1; $r < count($sheetdata); $r++)
			{
				$kode = $sheetdata[$r]['0'];
				$nama = $sheetdata[$r]['1'];
				$pin = $sheetdata[$r]['2'];
				$no_hp = $sheetdata[$r]['3'];
				$no_pesanan = $sheetdata[$r]['4'];
				$kota = $sheetdata[$r]['5'];
				$alamat = $sheetdata[$r]['6'];
				$detail_angsuran = $sheetdata[$r]['7'];
				$ctt = $sheetdata[$r]['8'];
				$produk = $sheetdata[$r]['9'];
				$nominal = $sheetdata[$r]['10'];
				$sales = $sheetdata[$r]['11'];
				$komisi_sales = $sheetdata[$r]['12'];
				$db = $sheetdata[$r]['13'];
				$komisi_db = $sheetdata[$r]['14'];
				$kurir = $sheetdata[$r]['15'];
				$komisi_kurir = $sheetdata[$r]['16'];
				$col[] = array (
					'kode' => $kode,
		      'pin' => $pin,
		      'nama' => $nama,
		      'kota' => $kota,
		      'alamat' => $alamat,
		      'no_hp' => $no_hp,
		      'no_pesanan' => $no_pesanan,
		      'detail_angsuran' => empty($detail_angsuran) ? null : $detail_angsuran,
		      'ctt' => empty($ctt) ? null : $ctt,
		      'id_produk' => $this->mod->get_id_produk($produk),
		      'nominal' => $nominal,
		      'id_sales' => $sales,
		      'komisi_sales' => $komisi_sales,
		      'id_db' => $db,
		      'komisi_db' => $komisi_db,
		      'id_kurir' => $kurir,
		      'komisi_kurir' => $komisi_kurir,
				);
				if (!is_numeric($pin) ||
				!is_numeric($no_hp) ||
				!is_numeric($nominal) ||
				!is_numeric($komisi_sales) ||
				!is_numeric($komisi_db) ||
				!is_numeric($komisi_kurir)) {
					$numeric += 1;
				}
			}
			if ($numeric > 0) {
				$data['sukses'] = false;
			} else {
				$this->db->insert_batch('konsumen', $col);
			}
		}
		echo json_encode($data);
	}


}
