<?php
class bom extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_bom');
	    $this->load->model('m_bb'); //digunakan untuk melihat id bahanbaku dan nama bahanbaku
        // if(!$this->session->userdata('is_logged')){
		// 	redirect('auth');
        // }
    }

    // public function index()
    // {
    //     $data=[
    //         'id_penerimaan' =>  $this->m_bom->getId(),
	// 		'pembelian' => $this->m_bom->getIdPembelian(), 
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

    //untuk mengecek produk
		function check_produk() {
            // $no_faktur = $this->input->post('no_faktur');// get no_faktur
            $id_produk = $this->input->post('id_produk');// get idsupplier
            $this->db->select('id_produk');
            $this->db->from('bom');
            $this->db->where('id_produk', $id_produk);
            $query = $this->db->get();
            $num = $query->num_rows();
            if ($num > 0) {
                $this->form_validation->set_message('check_produk','BOM untuk produk tersebut sudah ada');
                return FALSE;
            } else {
                return TRUE;
            }
    }

    public function add()
    {
            $data['id_bom'] = $this->m_bom->getId(); // ambil id penerimaan
			$data['minuman'] = $this->m_bom->getIdMinuman(); // ambil id pembelian
			$data['bahanbaku'] = $this->m_bb->getdata2(); //untuk mengambil data bahanbaku
			$data['heading'] = 'Bill of Material';
			$data['title'] = 'Kini Cheese Tea | Bill of Material';
			$data['satuan'] = ['kilogram (kg)','liter (L)','gram (gr)','ml','piece (pc)','pack','roll'];

			// $this->form_validation->set_rules('nama_bb', 'nama bahan baku', 'required',
			// array('required' => 'Anda harus memasukkan %s.')
			// );

			// $this->form_validation->set_rules('qty', 'jumlah', 'required',
			// array('required' => 'Anda harus memasukkan %s.')
			// );

			// $this->form_validation->set_rules('satuan', 'satuan', 'required',
			// array('required' => 'Anda harus memasukkan %s.')
			// );

			$this->form_validation->set_rules('id_produk', 'nama produk', 'required',
			array('required' => 'Anda harus memasukkan %s.')
			);

			$this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('bom/input_bom', $data);
				$this->load->view('templates/footer');
			}
			else
			{ 
                $post = $this->input->post();
				$data['data_bom'] = array(
					'id_bom' => $this->m_bom->getId(),
                    'id_produk' 	=> $this->input->post('id_produk'),
                );
                // $this->m_bom->input_data();
                
                $_SESSION['id_bom'] = $this->input->post('id_bom');
                $_SESSION['id_produk'] = $post["id_produk"];
                
                $data['data_bom'] = $this->m_bom->getDataDetail($_SESSION['id_bom'], $_SESSION['id_produk']);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('bom/input_detail', $data);
                $this->load->view('bom/view_detail', $data);
                $this->load->view('templates/footer');

			}

    }
    
    //untuk input detail
    public function input_form_detail()
    {
            // $data['IdPenerimaan'] = $this->m_bom->getIdPenerimaan(); // ambil id penerimaan
			$data['minuman'] = $this->m_bom->getIdMinuman(); // ambil id pembelian
			$data['bahanbaku'] = $this->m_bb->getdata2(); //untuk mengambil data bahanbaku
			$data['heading'] = 'Bill of Material';
			$data['title'] = 'Kini Cheese Tea | Bill of Material';
            $data['satuan'] = ['kilogram (kg)','liter (L)','gram (gr)','ml','piece (pc)','pack','roll'];
            
            $this->form_validation->set_rules('nama_bb', 'nama bahan baku', 'required',
			array('required' => 'Anda harus memasukkan %s.')
			);

			$this->form_validation->set_rules('qty', 'jumlah', 'required',
			array('required' => 'Anda harus memasukkan %s.')
			);

			$this->form_validation->set_rules('satuan', 'satuan', 'required',
			array('required' => 'Anda harus memasukkan %s.')
			);

            $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
            if ($this->form_validation->run() == FALSE)
			{
                $data['data_bom'] = $this->m_bom->getDataDetail($_SESSION['id_bom'],$_SESSION['id_produk']);

				$this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('bom/input_detail', $data);
                $this->load->view('bom/view_detail',$data);
                $this->load->view('templates/footer');
			}else{
                //simpan ke database
                $this->m_bom->input_data();
                $data['bahanbaku'] = $this->m_bb->getdata2();
                //dapatkan data hasil penyimpanan
                $data['bom'] = $this->m_bom->getDataDetail($_SESSION['id_bom'],$_SESSION['id_produk']);

                $data['data_bom'] = $this->m_bom->getDataDetail($_SESSION['id_bom'],$_SESSION['id_produk']);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('bom/input_detail', $data);
                $this->load->view('bom/view_detail',$data);
                $this->load->view('templates/footer');
            }
            

    }

    //input form 2
		public function input_form_detail2(){

			$data['data_bom'] = $this->m_bom->getDataDetail($_SESSION['id_bom'],$_SESSION['id_produk']);

			// $data['isi_data'] = $this->m_bom->getDataDetail($_SESSION['id_bom'],$_SESSION['id_produk']);
			$data['bahanbaku'] = $this->m_bb->getData($_SESSION['id_bom']); //untuk mengpembelianta bahanbaku
			$data['title'] = 'Kini Cheese Tea | Bill of Material';
            $data['heading'] = 'Bill of Material';
            $data['satuan'] = ['kilogram (kg)','liter (L)','gram (gr)','ml','piece (pc)','pack','roll'];

            $this->load->view('templates/header', $data);
            // $this->load->view('templates/sidebar', $data);
			$this->load->view('bom/input_detail', $data);
			$this->load->view('bom/view_detail',$data);
            $this->load->view('templates/footer');
        }


    
    //ketika sudah selesai menambahkan detail penerimaan
    public function selesai()
    {
        //unset sesi yang digunakan untuk transaksi penerimaan
        unset($_SESSION['id_bom']);
        unset($_SESSION['id_produk']);
        $this->session->set_flashdata('flash','tersimpan');
        redirect('bom/view_data');
    }

    public function view_data()
    {
		$data['data_bom'] = $this->m_bom->getData();
		$data['heading'] = 'Bill of Material';
		$data['title'] = 'Bill of Material | Data';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
		$this->load->view('bom/view_data',$data);
		$this->load->view('templates/footer');
    }
    
    //fungsi untuk edit data
        public function edit_data($id_bom,$id_produk)
        {
			
            if ((!isset($id_bom)) and (!isset($id_produk))) redirect('bom/view_data');
            
            $data['heading'] = 'Bill of Material';
		    $data['title'] = 'Bill of Material | Data';
            $data['data_bom'] = $this->m_bom->getDataDetail($id_bom,$id_produk);
            $data['id_produk'] = $this->m_bom->getIdMinuman($id_produk);
					
			$this->form_validation->set_rules('nama_bb', 'nama bahan baku', 'required',
			array('required' => 'Anda harus memasukkan %s.')
			);

			$this->form_validation->set_rules('qty', 'jumlah', 'required',
			array('required' => 'Anda harus memasukkan %s.')
			);

			$this->form_validation->set_rules('satuan', 'satuan', 'required',
			array('required' => 'Anda harus memasukkan %s.')
			);
			
            $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
			
			if ($this->form_validation->run() == FALSE)
			{
                $data['heading'] = 'Bill of Material';
		        $data['title'] = 'Bill of Material | Edit Data';
                $data['data_bom'] = $this->m_bom->getDataDetail($id_bom,$id_produk);

				$this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('bom/edit_detail_bom',$data);
                $this->load->view('bom/view_detail_bom', $data);
                $this->load->view('templates/footer');
			}else{
                //simpan ke database
                $this->m_bom->update_edit($id_bom,$id_produk);
                
                //dapatkan data hasil penyimpanan
                $data['bom'] = $this->m_bom->getDataDetail($id_bom,$id_produk);
                redirect('bom/view_data');
			
        }
    }
        
    //fungsi untuk melihat data
    public function view_data_detail($id_bom,$id_produk)
    {
        $data['data_bom'] = $this->m_bom->getDataDetail($id_bom,$id_produk);
        //print_r($data['isi_data']);
        $data['heading'] = 'Detail BOM';
        $data['title'] = 'Bill of Material | Data';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bom/view_detail_bb',$data);
        $this->load->view('templates/footer');
    }

    
    
    //fungsi untuk menghapus data
    public function delete_data($id_bom,$id_produk)
    {
        // if ((!isset($id_bom)) or (!isset($id_produk))) show_404();
               
        if ($this->m_bom->delete_bom($id_bom,$id_produk)) {
            $this->session->set_flashdata('flash','dihapus');
        redirect(site_url('bom/view_data'));
        }

    }

    //fungsi untuk menghapus data ketika input data detail
    public function delete_form_detail($no_bom,$id_bom,$id_produk)
    {    
        if ($this->m_bom->deleteFormInputDetailBOM($no_bom)) {
            $this->session->set_flashdata('flash','dihapus');
        redirect(site_url('bom/edit_detail_bom'.'/'.$id_bom.'/'.$id_produk));
        }
    }
    
    public function delete_detail($no_bom,$id_bom,$id_produk){

        if($this->m_bom->deleteFormInputDetailBOM($no_bom)){
        redirect(site_url('bom/edit_data'.$id_bom.'/'.$id_produk));
        }

        }
    
        public function edit_detail_bom($id_bom,$id_produk){

			$data['data_bom'] = $this->m_bom->getDataDetail($id_bom,$id_produk);

			// $data['isi_data'] = $this->m_bom->getDataDetail($_SESSION['id_bom'],$_SESSION['id_produk']);
			$data['bahanbaku'] = $this->m_bb->getData($id_bom); //untuk mengpembelianta bahanbaku
			$data['title'] = 'Kini Cheese Tea | Bill of Material';
            $data['heading'] = 'Bill of Material';
            $data['satuan'] = ['kilogram (kg)','liter (L)','gram (gr)','ml','piece (pc)','pack','roll'];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
			$this->load->view('bom/input_detail', $data);
			$this->load->view('bom/view_detail',$data);
            $this->load->view('templates/footer');
        }
}
?>