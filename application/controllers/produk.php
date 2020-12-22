<?php

class produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_produk');
        if(!$this->session->userdata('is_logged')){
                redirect('auth');
            }
    }

    // public function index()
    // {
    //     $data=[
    //         // 'bahan_baku' =>  $this->m_produk->getdata(),
    //         'title' =>  'Kini Cheese Tea | Produk',
    //         'heading'   =>  'Produk',
    //     ];
    //     $this->load->view('templates/header',$data);
    //     $this->load->view('templates/sidebar',$data);
    //     $this->load->view('produk/view_data',$data);
    //     $this->load->view('templates/footer');
    // }

    public function add()
    {
        $data=[
            'id_produk' => $this->m_produk->getIdProduk(),
            'title' =>  'Kini Cheese Tea | Produk',
            'heading'   =>  'Produk',
        ];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('produk/input',$data);
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|alpha_numeric_spaces',
                array('required' => '%s harus diisi!',
                        'alpha_numeric_spaces' => '%s hanya boleh diisi dengan angka, huruf, atau spasi.')
                );
        
        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
        $data=[
            'id_produk' => $this->m_produk->getIdProduk(),
            'title'=>'Kini Cheese Tea | Produk',
            'heading' => 'Tambah Data Produk'
        ];
        
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $this->load->view('produk/input',$data);
                $this->load->view('templates/footer');
        }
        else
        {
                 $data['data_produk'] = array('id_produk'=> $this->m_produk->getIdProduk(),
                                'nama_produk'   =>  $this->input->post('nama_produk'), 
                                'gambar'        =>  $this->input->post('image'),
                          );
                 
                $this->m_produk->insert_data();   
                $this->session->set_flashdata('flash','ditambahkan');
                redirect('produk/view_data');
        }
        
        
    }
        public function edit_data($kode_bb){
                if(!isset($kode_bb)) redirect('bahan_baku/view_data');

                $data['bahanbaku']= $this->m_bb->get_kode_bb($kode_bb);
                $data['title']          = 'Kini Cheese Tea | Bahan Baku';
                $data['heading']        = 'Edit Bahan Baku';
                $data['satuan']         = ['Kilogram (Kg)','Liter (L)','Gram (Gr)','Kaleng','Pieces (Pcs)','Pack','Balok'];

                $this->form_validation->set_rules('nama_bb', 'Nama Bahan Baku', 'required|alpha_numeric_spaces',
                        array('required' => '%s harus diisi!',
                                'alpha_numeric_spaces' => '%s hanya boleh diisi dengan angka, huruf, atau spasi.')
                        );
                $this->form_validation->set_rules('satuan', 'Satuan Bahan Baku', 'required',
                        array('required' => '%s harus diisi!')
                );		

                $this->form_validation->set_rules('merk', 'Merk', 'required',
                array('required' => '%s harus diisi!',
                )
                );
                
                $this->form_validation->set_rules('stok_awal', 'Stok Awal', 'required|numeric',
                        array('required' => '%s harus diisi!',
                        'numeric' =>  '%s hanya diisi oleh angka!',
                        )
                );              
                $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('templates/header',$data);
                        $this->load->view('templates/sidebar',$data);
                        $this->load->view('bahan_baku/edit_bb',$data);
                        $this->load->view('templates/footer');
                }
                else
                {
                        $this->m_bb->update_edit();
                        $this->session->set_flashdata('flash','diubah');
                        redirect('bahan_baku/view_data'); 
                }
        
        }

    public function view_data()
    {
        $data=array('data_produk' =>  $this->m_produk->getdata(),
        'title'=>'Kini Cheese Tea | Produk',
        'heading' => 'Produk'
        );
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('produk/view_data',$data);
        $this->load->view('templates/footer');
    }

    public function delete_data($id_produk)
    {
            if (!isset($id_produk)) show_404();

            if ($this->m_produk->delete($id_produk)) {
                $this->session->set_flashdata('flash', 'dihapus');
                redirect(site_url('produk/view_data'));
            }
    }
}
?>