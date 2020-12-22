<?php
class penerimaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_penerimaan');
	    $this->load->model('m_bb'); //digunakan untuk melihat id bahanbaku dan nama bahanbaku
		$this->load->model('m_supplier'); //digunakan untuk melihat id supplier dan nama supplier
        // if(!$this->session->userdata('is_logged')){
		// 	redirect('auth');
        // }
    }

    // public function index()
    // {
    //     $data=[
    //         'id_penerimaan' =>  $this->m_penerimaan->getId(),
	// 		'pembelian' => $this->m_penerimaan->getIdPembelian(), 
	// 		'bahanbaku' => $this->m_bb->getdata(),
    //         'datasupplier' => $this->m_supplier->getdata(),
    //         'satuan' => ['Kilogram (Kg)','Liter (L)','Gram (Gr)','Kaleng','Pieces (Pcs)','Pack','Balok'],
    //         'title' =>  'Kini Cheese Tea | Penerimaan Bahan Baku',
    //         'heading'   =>  'Penerimaan',
    //     ];
    //     $this->load->view('templates/header',$data);
    //     $this->load->view('templates/sidebar',$data);
    //     $this->load->view('penerimaan/input',$data);
    //     $this->load->view('templates/footer');
    // }

    public function add()
    {
            $data['id_penerimaan'] = $this->m_penerimaan->getId(); // ambil id penerimaan
			$data['pembelian'] = $this->m_penerimaan->getIdPembelian(); // ambil id pembelian
			$data['bahanbaku'] = $this->m_bb->getdata(); //untuk mengambil data bahanbaku
			$data['datasupplier'] = $this->m_supplier->getdata(); //untuk mengambil data supplier
			$data['heading'] = 'Penerimaan Bahan Baku';
			$data['title'] = 'Kini Cheese Tea | Penerimaan Bahan Baku';
			$data['satuan'] = ['Kilogram (Kg)','Liter (L)','Gram (Gr)','Kaleng','Pieces (Pcs)','Pack','Balok'];

			$this->form_validation->set_rules('id_pembelian', 'no. faktur', 'required',
			array('required' => 'Anda harus memasukkan %s.')
            );
            
            $this->form_validation->set_rules('nm_penerima', 'nama penerima', 'required',
			array('required' => 'Anda harus memasukkan %s.')
			);

			$this->form_validation->set_rules('tanggal', 'tanggal penerimaan', 'required',
			array('required' => 'Anda harus memasukkan %s.')
            );

			$this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('penerimaan/input', $data);
				$this->load->view('templates/footer');
			}
			else
			{ 
                $post = $this->input->post();
				$data['penerimaan'] = array(
                    'id_penerimaan' => $this->m_penerimaan->getId(),
                    'nm_penerima'   => $this->input->post('nm_penerima'),
                    'id_pembelian' 	=> $post["id_pembelian"],
                    'tanggal'		=> $post["tanggal"],
                );
                
                $_SESSION['id_penerimaan'] = $this->m_penerimaan->getId();
			    $_SESSION['id_pembelian'] = $post["id_pembelian"];
                $_SESSION['tanggal'] = $post["tanggal"];
                $_SESSION['nm_penerima'] = $post["nm_penerima"];

                $data['penerimaan'] = $this->m_penerimaan->getDataDetail($_SESSION['id_penerimaan'], $_SESSION["id_pembelian"]);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('penerimaan/input_detail', $data);
                $this->load->view('penerimaan/view_detail',$data);
                $this->load->view('templates/footer');

			}

    }
    
    //untuk input detail
    public function input_form_detail()
    {
            // $data['IdPenerimaan'] = $this->m_penerimaan->getIdPenerimaan(); // ambil id penerimaan
			$data['pembelian'] = $this->m_penerimaan->getIdPembelian(); // ambil id pembelian
			$data['bahanbaku'] = $this->m_bb->getdata(); //untuk mengambil data bahanbaku
			$data['datasupplier'] = $this->m_supplier->getdata(); //untuk mengambil data supplier
			$data['heading'] = 'Penerimaan Bahan Baku';
			$data['title'] = 'Kini Cheese Tea | Penerimaan Bahan Baku';
            $data['satuan'] = ['Kilogram (Kg)','Liter (L)','Gram (Gr)','Kaleng','Pieces (Pcs)','Pack','Balok'];
            
            $this->form_validation->set_rules('nama_bb', 'nama bahan baku', 'required',
			array('required' => 'Anda harus memasukkan %s.')
			);

			$this->form_validation->set_rules('qty', 'jumlah', 'required',
			array('required' => 'Anda harus memasukkan %s.')
            );
            
            $this->form_validation->set_rules('keterangan', 'keterangan produk', 'max_length[20]',
			array('max_length[20]' => 'Jumlah karakter maksimal 20.')
			);

			$this->form_validation->set_rules('satuan', 'satuan', 'required',
			array('required' => 'Anda harus memasukkan %s.')
			);

			$this->form_validation->set_rules('harga_satuan', 'harga satuan', 'required',
			array('required' => 'Anda harus memasukkan %s.')
            );
            $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
            if ($this->form_validation->run() == FALSE)
			{
                $data['penerimaan'] = $this->m_penerimaan->getDataDetail($_SESSION['id_penerimaan'],$_SESSION['id_pembelian']);

				$this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('penerimaan/input_detail', $data);
                $this->load->view('penerimaan/view_detail',$data);
                $this->load->view('templates/footer');
			}else{
                //simpan ke database
                $this->m_penerimaan->input_data();
                
                //dapatkan data hasil penyimpanan
                $post = $this->input->post();
                $data['penerimaan'] = $this->m_penerimaan->getDataDetail($_SESSION['id_penerimaan'],$_SESSION['id_pembelian']);

                $data['data_penerimaan'] = $this->m_penerimaan->getDataDetail($_SESSION['id_penerimaan'],$_SESSION['id_pembelian']);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('penerimaan/input_detail', $data);
                $this->load->view('penerimaan/view_detail',$data);
                $this->load->view('templates/footer');
            }
            

    }

    //input form 2
		public function input_form_detail2(){

			$data['penerimaan'] = $this->m_penerimaan->getDataDetail($_SESSION['id_penerimaan'],$_SESSION['id_pembelian']);

			$data['isi_data'] = $this->m_penerimaan->getDataDetail($_SESSION['id_penerimaan'],$_SESSION['id_pembelian']);
			$data['bahanbaku'] = $this->m_bb->getData($_SESSION['id_penerimaan']); //untuk mengpembelianta bahanbaku
			$data['datasuplier'] = $this->m_supplier->getdata(); //untuk mengambil data supplier
			$data['title'] = 'Kini Cheese Tea | Penerimaan Bahan Baku';
            $data['heading'] = 'Penerimaan Bahan Baku';
            $data['satuan'] = ['Kilogram (Kg)','Liter (L)','Gram (Gr)','Kaleng','Pieces (Pcs)','Pack','Balok'];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
			$this->load->view('penerimaan/input_detail', $data);
			$this->load->view('penerimaan/view_detail',$data);
            $this->load->view('templates/footer');
        }


    
    //ketika sudah selesai menambahkan detail penerimaan
    public function selesai()
    {
        //unset sesi yang digunakan untuk transaksi penerimaan
        unset($_SESSION['id_penerimaan']);
        unset($_SESSION['id_pembelian']);
        unset($_SESSION['tanggal']);
        $this->session->set_flashdata('flash','tersimpan');
        redirect('penerimaan/view_data');
    }

    public function view_data()
    {
		$data['data_penerimaan'] = $this->m_penerimaan->getData();
		$data['heading'] = 'Penerimaan Bahan Baku';
		$data['title'] = 'Penerimaan Bahan Baku | Data';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
		$this->load->view('penerimaan/view_data',$data);
		$this->load->view('templates/footer');
    }
    
    //fungsi untuk melihat data
    public function view_data_detail($id_penerimaan,$id_pembelian)
    {
        $data['data_penerimaan'] = $this->m_penerimaan->getDataDetail($id_penerimaan,$id_pembelian);
        //print_r($data['isi_data']);
        $data['heading'] = 'Detail Penerimaan';
        $data['title'] = 'Penerimaan Bahan Baku | Data';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penerimaan/view_detail_bb',$data);
        $this->load->view('templates/footer');
    }
    
    //fungsi untuk menghapus data
    public function delete_form($id_penerimaan,$id_pembelian)
    {

        if ((!isset($id_penerimaan)) or (!isset($id_pembelian))) show_404();
               
        if ($this->m_penerimaan->deleteFormInput($id_penerimaan,$id_pembelian)) {
        redirect(site_url('penerimaan/view_data'));
        }

    }

    //fungsi untuk menghapus data ketika input data detail pembelian
    public function delete_form_detail($no_penerimaan)
    {    
        if ($this->m_penerimaan->deleteFormInputDetailPenerimaan($no_penerimaan)) {
            $this->session->set_flashdata('flash','dihapus');
        redirect(site_url('penerimaan/input_form_detail2'));
        }
    }
    
    public function delete_detail($id_transaksi_pembelian,$no_faktur,$id_supplier){

        if($this->pembelian_model->deleteFormInputDetailPembelian($id_transaksi_pembelian)){
        redirect(site_url('pembelian/view_data_pembelian_detail2/'.$no_faktur.'/'.$id_supplier));
        }

        }
}
?>