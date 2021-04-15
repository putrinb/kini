<?php
class pemakaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pemakaian');
	    $this->load->model('m_bom');
        $this->load->model('m_produk');
        // if(!$this->session->userdata('is_logged')){
		// 	redirect('auth');
        // }
    }

    public function add()
    {
        $data=[
            'no_pemakaian' => $this->m_pemakaian->getIdPemakaian(),
            'bom' => $this->m_bom->getdata(),
            'title' =>  'Kini Cheese Tea | Produksi',
            'heading'   =>  'Produksi',
        ];

            $this->form_validation->set_rules('no_pemakaian', 'No', 'required',
			array('required' => 'Anda harus memasukkan %s.')
            );
            
			$this->form_validation->set_rules('tanggal', 'tanggal pemakaian', 'required',
			array('required' => 'Anda harus memasukkan %s.')
            );

            $this->form_validation->set_rules('id_bom', 'ID BOM', 'required',
			array('required' => 'Anda harus memasukkan %s.')
            );

            // $this->form_validation->set_rules('gaji', 'gaji', 'required',
            // array('required' => 'Anda harus memasukkan %s.')
            // );
            
			// $this->form_validation->set_rules('day', 'jumlah hari', 'required',
			// array('required' => 'Anda harus memasukkan %s.')
            // );

            // $this->form_validation->set_rules('person', 'jumlah karyawan', 'required',
			// array('required' => 'Anda harus memasukkan %s.')
            // );   
            
            // $this->form_validation->set_rules('sales', 'rata-rata penjualan', 'required',
			// array('required' => 'Anda harus memasukkan %s.')
            // );      

			$this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('pemakaian/input_pemakaian', $data);
				$this->load->view('templates/footer');
			}
			else
			{ 
				$data['pemakaian'] = array(
					'no_pemakaian' => $this->m_pemakaian->getIdPemakaian(),
                    'id_bom' 	=> $this->input->post('id_bom'),
                    'tanggal'   => $this->input->post('tanggal'),
                );
                $_SESSION['no_pemakaian'] = $this->m_pemakaian->getIdPemakaian();
                $_SESSION['id_bom'] = $this->input->post('id_bom');
                $_SESSION['tanggal'] = $this->input->post('tanggal');
                
                $data['bom'] = $this->m_pemakaian->detailBOM($_SESSION["id_bom"]);
                $data['data_pemakaian'] = $this->m_pemakaian->getDetailPemakaian($_SESSION['no_pemakaian'], $_SESSION['id_bom']);
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $this->load->view('pemakaian/detail_pemakaian',$data);
                $this->load->view('pemakaian/view_pemakaian2',$data);
                $this->load->view('templates/footer',$data);
            }
        
    }

    public function input_form_detail()
    {
        // $this->m_pemakaian->input_data();

            $data['no_pemakaian'] = $this->m_pemakaian->getIdPemakaian(); // ambil id pemakaian
			$data['bom'] = $this->m_pemakaian->detailBOM($_SESSION['id_bom']);
			$data['heading'] = 'Produksi';
			$data['title'] = 'Kini Cheese Tea | Produksi';
            
            $this->form_validation->set_rules('harga', 'harga', 'required',
			array('required' => 'Anda belum memasukkan %s.')
            );
            
            $this->form_validation->set_rules('nama_bb', 'bahan baku', 'required',
			array('required' => 'Anda belum memasukkan %s.')
			);

            $this->form_validation->set_rules('qty', 'jumlah', 'required',
			array('required' => 'Anda belum memasukkan %s.')
			);

            $this->form_validation->set_rules('gaji', 'gaji', 'required',
            array('required' => 'Anda harus memasukkan %s.')
            );
            
			$this->form_validation->set_rules('day', 'jumlah hari', 'required',
			array('required' => 'Anda harus memasukkan %s.')
            );

            $this->form_validation->set_rules('person', 'jumlah karyawan', 'required',
			array('required' => 'Anda harus memasukkan %s.')
            );   
            
            $this->form_validation->set_rules('sales', 'rata-rata penjualan', 'required',
			array('required' => 'Anda harus memasukkan %s.')
            );    

            $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
            if ($this->form_validation->run() == FALSE)
			{
                
                $data['pemakaian'] = $this->m_pemakaian->getDetailPemakaian($_SESSION['no_pemakaian'], $_SESSION['id_bom']);

				$this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $this->load->view('pemakaian/detail_pemakaian',$data);
                $this->load->view('pemakaian/view_pemakaian2',$data);
                $this->load->view('templates/footer',$data);
			}else{
                //simpan ke database
                $this->m_pemakaian->input_data();
                
                //dapatkan data hasil penyimpanan
                $data['pemakaian'] = $this->m_pemakaian->getDetailPemakaian($_SESSION['no_pemakaian'],$_SESSION['id_bom']);
                $data['data_pemakaian'] = $this->m_pemakaian->getDetailPemakaian($_SESSION['no_pemakaian'], $_SESSION['id_bom']);

                // $data['data_bom'] = $this->m_bom->getDataDetail($_SESSION['id_bom'],$_SESSION['id_produk']);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                // $this->load->view('bom/input_detail', $data);
                // $this->load->view('pemakaian/view_pemakaian',$data);
                $this->load->view('templates/footer');
            }
            

    }
}
?>