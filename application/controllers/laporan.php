<?php

class laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('m_laporan');
		$this->load->model('m_bb');
	}

	public function index()
	{
		if (isset($_GET['filter']) && !empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
			$filter = $_GET['filter']; // Ambil data filter yang dipilih user
			if ($filter == '1') { // Jika filter nya 1 (per tanggal)
				$tgl = $_GET['tanggal'];

				$ket = 'Laporan Penerimaan Bahan Baku' . "<br>" . 'Kini Cheese Tea' . "<br>" . 'Per Tanggal ' . date('d-m-Y', strtotime($tgl));
				// $url_cetak = 'transaksi/cetak?filter=1&tanggal='.$tgl;
				$transaksi = $this->m_laporan->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di m_laporan
			} else if ($filter == '2') { // Jika filter nya 2 (per bulan)
				$bulan = $_GET['bulan'];
				$tahun = $_GET['tahun'];
				$nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

				$ket = 'Laporan Penerimaan Bahan Baku' . "<br>" . 'Kini Cheese Tea' . "<br>" . 'Periode ' . $nama_bulan[$bulan] . ' ' . $tahun;
				// $url_cetak = 'transaksi/cetak?filter=2&bulan='.$bulan.'&tahun='.$tahun;
				$transaksi = $this->m_laporan->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_laporan
			} else { // Jika filter nya 3 (per tahun)
				$tahun = $_GET['tahun'];

				$ket = 'Laporan Penerimaan Bahan Baku' . "<br>" . 'Kini Cheese Tea' . "<br>" . 'Tahun ' . $tahun;
				// $url_cetak = 'transaksi/cetak?filter=3&tahun='.$tahun;
				$transaksi = $this->m_laporan->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_laporan
			}
		} else { // Jika user tidak mengklik tombol tampilkan
			$nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

			$ket = 'Data Transaksi Penerimaan' . "<br>" . 'Kini Cheese Tea' . "<br>" . 'Per Tanggal ' . " " . date('d - m - y');
			// $url_cetak = 'transaksi/cetak';
			$transaksi = $this->m_laporan->view_all(); // Panggil fungsi view_all yang ada di m_laporan
		}

		// $data['url_cetak'] = base_url('index.php/'.$url_cetak);
		$data = [
			'ket'	=> $ket,
			'transaksi'	=> $transaksi,
			'option_tahun' => $this->m_laporan->option_tahun(),
			'title'		=> 'Kini Cheese Tea | Laporan',
			'heading'   => 'Laporan'
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/laporan_penerimaan', $data);
		$this->load->view('templates/footer');
	}

	function pembelian_perbulan()
	{
		$data = [
			'title'		=> 'Kini Cheese Tea | Laporan',
			'pembelian'	=>	$this->m_laporan->get_pembelian_perbulan(),
			'heading'   => 'Laporan'
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/laporan_perbulan', $data);
		$this->load->view('templates/footer');
	}

	function pembelian_bulan($waktu)
	{
		$data = [
			'title'		=> 'Kini Cheese Tea | Laporan',
			'pembelian'	=>	$this->m_laporan->get_lap_pembelian($waktu),
			'heading'   => 'Laporan'
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('laporan/laporan_bulan', $data);
		$this->load->view('templates/footer');
	}

	function KartuStok()
	{
		$data = [
			'title'		=> 'Kini Cheese Tea | Laporan',
			'tahun'		=> $this->m_laporan->getTahun(),
			'bb'		=> $this->m_laporan->getBahanBaku(),
			'heading'   => 'Laporan'
		];
		$this->form_validation->set_rules(
			'bulan',
			'bulan laporan',
			'required',
			array('required' => 'Anda harus memasukkan %s.')
		);

		$this->form_validation->set_rules(
			'tahun',
			'tahun laporan',
			'required',
			array('required' => 'Anda harus memasukkan %s.')
		);

		$this->form_validation->set_rules(
			'kode_bb',
			'bahan baku',
			'required',
			array('required' => 'Anda harus memasukkan %s.')
		);

		$this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
		if ($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('laporan/form_input_ks', $data);
			$this->load->view('templates/footer');
		} else {
			$data['heading'] = 'Laporan';
			$data['title'] = 'Kini Cheese Tea | Laporan';
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$waktu = $tahun . "-" . str_pad($bulan, 2, "0", STR_PAD_LEFT); //YYYY-mm
			$kode_bb = $this->input->post('kode_bb');
			$data_bb = $this->m_bb->getdata_edit($kode_bb); //mendapatkan data bahan baku
			$data['stok'] = $this->m_laporan->getStok($kode_bb, $waktu); //mendapatkan jumlah persediaan bln sebelumnya
			$data['harga'] = $this->m_laporan->getHarga($kode_bb, $waktu); //mendapatkan harga beli
			$data['dataKartuStok'] = $this->m_laporan->getKartuStok($kode_bb, $waktu); //mendapatkan kartu stok
			$data['bulan'] = str_pad($bulan, 2, "0", STR_PAD_LEFT);
			$data['tahun'] = $tahun;
			$data['bahan_baku'] = $data_bb;

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('laporan/kartu_stok', $data);
			$this->load->view('templates/footer', $data);
		}
	}

	public function hpp()
	{
		$data = [
			'title'		=> 'Kini Cheese Tea | Laporan',
			'tahun'		=> $this->m_laporan->getTahun(),
			'bulan'		=> $this->m_laporan->getBulan(),
			'bb'		=> $this->m_laporan->getBahanBaku(),
			'heading'   => 'Laporan',
			'tahun'		=> $this->m_laporan->getTahun(),
			$bulan = $this->input->post('bulan'),
			$tahun = $this->input->post('tahun'),
			$waktu = $tahun . "-" . str_pad($bulan, 2, "0", STR_PAD_LEFT), //YYYY-mm

		];
		$this->form_validation->set_rules(
			'bulan',
			'bulan laporan',
			'required',
			array('required' => 'Anda harus memasukkan %s.')
		);

		$this->form_validation->set_rules(
			'tahun',
			'tahun laporan',
			'required',
			array('required' => 'Anda harus memasukkan %s.')
		);

		// $this->form_validation->set_rules(
		// 	'kode_bb',
		// 	'bahan baku',
		// 	'required',
		// 	array('required' => 'Anda harus memasukkan %s.')
		// );

		$this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
		if ($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('laporan/form_input_hpp', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$data = [
				'bulan' => $this->input->post('bulan'),
				'tahun' => $this->input->post('tahun'),
				'waktu' => $tahun . "-" . str_pad($bulan, 2, "0", STR_PAD_LEFT), //YYYY-mm
				'title'		=> 'Kini Cheese Tea | Laporan',
				'hpp'		=> $this->m_laporan->get_hpp($waktu),
				'heading'   => 'Laporan',

			];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('laporan/view_hpp_produk', $data);
			$this->load->view('templates/footer', $data);
		}
	}
}
