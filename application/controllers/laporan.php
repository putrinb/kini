<?php

class laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('is_logged')){
            redirect('auth');
        }
        $this->load->model('m_laporan');
	}

	// public function index()
	// {
	// 	$data=[
	// 		'title'		=> 'Kini Cheese Tea | Laporan',
    //         'pembelian'	=>	$this->m_laporan->get_pembelian(),
    //         'heading'   =>  'Laporan',
			

	// 	];
    //     $this->load->view('templates/header',$data);
    //     $this->load->view('templates/sidebar',$data);
	// 	$this->load->view('laporan/view_laporan_pembelian',$data);
	// 	$this->load->view('templates/footer');
	// }

	public function index()
	{
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filter yang dipilih user
            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                
                $ket = 'Laporan Penerimaan Bahan Baku'."<br>".'Kini Cheese Tea'."<br>".'Per Tanggal '.date('d-m-y', strtotime($tgl));
                // $url_cetak = 'transaksi/cetak?filter=1&tanggal='.$tgl;
                $transaksi = $this->m_laporan->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di m_laporan
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Laporan Penerimaan Bahan Baku'."<br>".'Kini Cheese Tea'."<br>".'Periode '.$nama_bulan[$bulan].' '.$tahun;
                // $url_cetak = 'transaksi/cetak?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaksi = $this->m_laporan->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_laporan
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Laporan Penerimaan Bahan Baku'."<br>".'Kini Cheese Tea'."<br>".'Tahun '.$tahun;
                // $url_cetak = 'transaksi/cetak?filter=3&tahun='.$tahun;
                $transaksi = $this->m_laporan->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_laporan
            }
		}else{ // Jika user tidak mengklik tombol tampilkan
			$nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

            $ket = 'Data Transaksi Penerimaan'."<br>".'Kini Cheese Tea'."<br>".'Per Tanggal '." ".date('d - m - y');
            // $url_cetak = 'transaksi/cetak';
            $transaksi = $this->m_laporan->view_all(); // Panggil fungsi view_all yang ada di m_laporan
        }
        
		// $data['url_cetak'] = base_url('index.php/'.$url_cetak);
		$data=[
			'ket'	=> $ket,
			'transaksi'	=> $transaksi,
			'option_tahun' => $this->m_laporan->option_tahun(),
			'title'		=> 'Kini Cheese Tea | Laporan',
            'heading'   => 'Laporan'
		];
		$this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
		$this->load->view('laporan/laporan_penerimaan', $data);
		$this->load->view('templates/footer');
	}

	public function pjl()
	{
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filter yang dipilih user
            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                
                $ket = 'Laporan Penjualan Produk'."<br>".'Kini Cheese Tea'."<br>".'Per Tanggal '.date('d-m-y', strtotime($tgl));
                // $url_cetak = 'transaksi/cetak?filter=1&tanggal='.$tgl;
                $transaksi = $this->m_laporan->view_by_date2($tgl); // Panggil fungsi view_by_date yang ada di m_laporan
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Laporan Penjualan Produk'."<br>".'Kini Cheese Tea'."<br>".'Periode '.$nama_bulan[$bulan].' '.$tahun;
                // $url_cetak = 'transaksi/cetak?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaksi = $this->m_laporan->view_by_month2($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_laporan
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Laporan Penjualan Produk'."<br>".'Kini Cheese Tea'."<br>".'Tahun '.$tahun;
                // $url_cetak = 'transaksi/cetak?filter=3&tahun='.$tahun;
                $transaksi = $this->m_laporan->view_by_year2($tahun); // Panggil fungsi view_by_year yang ada di m_laporan
            }
		}else{ // Jika user tidak mengklik tombol tampilkan
			$nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

            $ket = 'Data Transaksi Penjualan'."<br>".'Kini Cheese Tea'."<br>".'Per Tanggal '." ".date('d - m - y');
            // $url_cetak = 'transaksi/cetak';
            $transaksi = $this->m_laporan->view_all2(); // Panggil fungsi view_all yang ada di m_laporan
        }
        
		// $data['url_cetak'] = base_url('index.php/'.$url_cetak);
		$data=[
			'ket'	=> $ket,
			'transaksi'	=> $transaksi,
			'option_tahun' => $this->m_laporan->option_tahun2(),
			'title'		=> 'Kini Cheese Tea | Laporan',
            'heading'   => 'Laporan'
		];
		$this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
		$this->load->view('laporan/penjualan', $data);
		$this->load->view('templates/footer');
	}

	function pembelian_perbulan()
	{
		$data=[
			'title'		=> 'Kini Cheese Tea | Laporan',
            'pembelian'	=>	$this->m_laporan->get_pembelian_perbulan(),
            'heading'   => 'Laporan'
		];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
		$this->load->view('laporan/laporan_perbulan',$data);
		$this->load->view('templates/footer');
	}

	function pembelian_bulan($waktu)
	{
		$data=[
			'title'		=> 'Kini Cheese Tea | Laporan',
            'pembelian'	=>	$this->m_laporan->get_lap_pembelian($waktu),
            'heading'   => 'Laporan'
		];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
		$this->load->view('laporan/laporan_bulan',$data);
		$this->load->view('templates/footer');
	}

	function pembelian_pdf()
	{
		$this->load->library('pdf'); 
		$pdf= new FPDF('p','mm','A4');
		$pdf->AddPage();

		//header

		$pdf->SetAutoPageBreak(true,60);
		$pdf->SetFont('Arial','B',14);

		$pdf->Cell(200,7,'Laporan Pembelian Bahan Baku',0,1,'C');
		$pdf->Cell(200,7,'Kini Cheese Tea',0,1,'C');
		$pdf->Cell(200,7,'Per '.date('d F Y'),0,1	,'C');

		//body

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'No',1,0,'C');
		$pdf->Cell(60,6,'No. Faktur',1,0,'C');
		$pdf->Cell(50,6,'Tanggal',1,0,'C');
		$pdf->Cell(70,6,'Jumlah',1,1,'C');

		$data=$this->m_laporan->get_pembelian();
		$no=0;
		$total_p=0;

		foreach($data as $row) {
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(10,6,$no=$no+1,1,0,'C');
			$pdf->Cell(60,6,$row->no_faktur,1,0,'C');
			$pdf->Cell(50,6,$row->Tanggal,1,0,'C');
			$pdf->Cell(70,6,nominal($row->total),1,1,'L');
			$total_p=$total_p+$row->total;
		}
		$pdf->Cell(120,6,'Total',1,0,'R');
		$pdf->Cell(70,6,nominal($total_p),1,1,'L');

		$pdf->Output();
	}
	
	function pembelian_pdf_perbulan()
	{
		$this->load->library('pdf'); 
		$pdf= new FPDF('p','mm','A4');
		$pdf->AddPage();

		//header

		$pdf->SetAutoPageBreak(true,60);
		$pdf->SetFont('Arial','B',14);

		$pdf->Cell(200,7,'Laporan Pembelian Bahan Baku',0,1,'C');
		$pdf->Cell(200,7,'Kini Cheese Tea',0,1,'C');
		$pdf->Cell(200,7,'Per '.date('F Y'),0,1	,'C');

		//body

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'No',1,0,'C');
		$pdf->Cell(80,6,'Tanggal',1,0,'C');
		$pdf->Cell(100,6,'Jumlah',1,1,'C');

		$data=$this->m_laporan->get_pembelian_perbulan();
		$no=0;
		$total_p=0;

		foreach($data as $row) {
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(10,6,$no=$no+1,1,0,'C');
			$pdf->Cell(80,6,$row->Tanggal,1,0,'C');
			$pdf->Cell(100,6,nominal($row->total),1,1,'C');
			$total_p=$total_p+$row->total;
		}
		$pdf->Cell(90,6,'Total',1,0,'R');
		$pdf->Cell(100,6,nominal($total_p),1,1,'L');

		$pdf->Output();
	}

	function pembelian_excel()
	{
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition:attachment; filename=pembelian.xls");
		$data=[
			'pembelian'	=> $this->m_laporan->get_pembelian()
		];
		$this->load->view('laporan/laporan_excel',$data);
	}

	function pembelian_excel_perbulan()
	{
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition:attachment; filename=pembelian_bulanan.xls");
		$data=[
			'pembelian'	=> $this->m_laporan->get_pembelian_perbulan(),
		];
		$this->load->view('laporan/laporan_excel_perbulan',$data);
	}

	function KartuStok()
	{
		$data=[
			'title'		=> 'Kini Cheese Tea | Laporan',
			'tahun'		=> $this->m_laporan->getTahun(),
			'bb'		=> $this->m_laporan->getBahanBaku(),
            // 'pembelian'	=>	$this->m_laporan->get_lap_pembelian($waktu),
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
            'bahan_baku',
            'bahan baku',
            'required',
            array('required' => 'Anda harus memasukkan %s.')
        );

        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
        if ($this->form_validation->run() == FALSE) {

        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
		$this->load->view('laporan/form_input_ks',$data);
		$this->load->view('templates/footer');
		}else{
			$this->load->view('templates/header',$data);
        	$this->load->view('templates/sidebar',$data);
			$this->load->view('laporan/kartu_stok',$data);
			$this->load->view('templates/footer');
		}
	}

	
  
//   public function cetak(){
//         if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
//             $filter = $_GET['filter']; // Ambil data filder yang dipilih user
//             if($filter == '1'){ // Jika filter nya 1 (per tanggal)
//                 $tgl = $_GET['tanggal'];
                
//                 $ket = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($tgl));
//                 $transaksi = $this->TransaksiModel->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
//             }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
//                 $bulan = $_GET['bulan'];
//                 $tahun = $_GET['tahun'];
//                 $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
//                 $ket = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
//                 $transaksi = $this->TransaksiModel->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
//             }else{ // Jika filter nya 3 (per tahun)
//                 $tahun = $_GET['tahun'];
                
//                 $ket = 'Data Transaksi Tahun '.$tahun;
//                 $transaksi = $this->TransaksiModel->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
//             }
//         }else{ // Jika user tidak mengklik tombol tampilkan
//             $ket = 'Semua Data Transaksi';
//             $transaksi = $this->TransaksiModel->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
//         }
        
//         $data['ket'] = $ket;
//         $data['transaksi'] = $transaksi;
        
//     ob_start();
//     $this->load->view('print', $data);
//     $html = ob_get_contents();
//         ob_end_clean();
        
//     require './assets/html2pdf/autoload.php'; // Load plugin html2pdfnya
//     $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');  // Settingan PDFnya
//     $pdf->WriteHTML($html);
//     $pdf->Output('Data Transaksi.pdf', 'D');
//   }
}
