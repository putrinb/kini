<?php

class bahan_baku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_bb');
        check_not_login();
    }

    public function index()
    {
        $data=[
            'bahan_baku' =>  $this->m_bb->getdata(),
            'title' =>  'Kini Cheese Tea | Bahan Baku',
            'heading'   =>  'Bahan Baku',
        ];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('bahan_baku/view_data',$data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data=[
                'kode_bb' =>  $this->m_bb->getkodebb(),
                'title' =>  'Kini Cheese Tea | Bahan Baku',
                'heading'   =>  'Bahan Baku',
        ];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('bahan_baku/form_bb');
        $this->load->view('templates/footer');
    }

    function check_data() {
        $nama_bb = $this->input->post('nama_bb');
        $merk = $this->input->post('merk');
        $jml = $this->input->post('jml');
        $satuan = $this->input->post('satuan');

        $this->db->select('kode_bb');
        $this->db->from('bahanbaku_utama');
        $this->db->where('nama_bb', $nama_bb);
        $this->db->where('merk', $merk);
        $this->db->where('jumlah', $jml);
        $this->db->where('satuan', $satuan);

        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num > 0) {
                $this->form_validation->set_message('check_data','Spesifikasi bahan baku sudah ada');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function insert()
    {
        $this->form_validation->set_rules('nama_bb', 'Nama Bahan Baku', 'required|alpha_numeric_spaces|callback_check_data',
        // is_unique[bahanbaku_utama.nama_bb
                array('required' => '%s harus diisi!',
                        'alpha_numeric_spaces' => '%s hanya boleh diisi dengan angka, huruf, atau spasi.')
                );
        $this->form_validation->set_rules('satuan', 'Satuan Bahan Baku', 'required|callback_check_data',
                array('required' => '%s harus diisi!')
        );

        $this->form_validation->set_rules('jml', 'Berat', 'required|callback_check_data',
                array('required' => '%s harus diisi!',
                )
        );

        $this->form_validation->set_rules('merk', 'Merk', 'required|callback_check_data',
                array('required' => '%s harus diisi!',
                )
        );
        $this->form_validation->set_rules('stok_awal', 'Stok Awal', 'required|numeric',
                array('required' => '%s harus diisi!',
                      'numeric' =>  '%s hanya diisi oleh angka!',
                )
        );
        
        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
        $data=[
                'kode_bb' =>  $this->m_bb->getkodebb(),
                'title'=>'Bahan Baku | Input Bahan Baku',
                'heading' => 'Form Data Bahan Baku',
                'satuan'  => array('kilogram (kg)','liter (L)','gram (gr)','ml','pieces (pcs)','pack','balok')];
        
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $this->load->view('bahan_baku/form_bb',$data);
                $this->load->view('templates/footer');
        }
        else
        {
                 $post = $this->input->post();
                 $data['kirim'] = array('id'=> $this->m_bb->getkodebb(),
                                'nama_bb'=>$post["nama_bb"],
                                'satuan'=>$post["satuan"],
                                'merk'  =>      $post["merk"],
                                'stok_awal' => $post["stok_awal"],
                                'jumlah' => $post["jml"]
                          );
                 
                $hasil = $this->m_bb->insert_data();   
                if($hasil>0){
                        $this->session->set_flashdata('flash','ditambahkan');
                        redirect('bahan_baku/view_data');
                }else{
                    $data['pesan_error'] = 'Input data tidak berhasil';
                    $this->load->view('templates/header');
                    $this->load->view('templates/sidebar',$data);
                    $this->load->view('bahan_baku/form_bb', $data);
                    $this->load->view('templates/footer');
                }
                
        }
                
    }
        public function edit_data($kode_bb){
                if(!isset($kode_bb)) redirect('bahan_baku/view_data');

                $data['bahanbaku']= $this->m_bb->get_kode_bb($kode_bb);
                $data['title']          = 'Kini Cheese Tea | Bahan Baku';
                $data['heading']        = 'Edit Bahan Baku';
                $data['satuan']         = ['gram (gr)','ml'];

                $this->form_validation->set_rules('nama_bb', 'Nama Bahan Baku', 'required|alpha_numeric_spaces',
                        array('required' => '%s harus diisi!',
                                'alpha_numeric_spaces' => '%s hanya boleh diisi dengan angka, huruf, atau spasi.')
                        );
                $this->form_validation->set_rules('satuan', 'Satuan Bahan Baku', 'required',
                        array('required' => '%s harus diisi!')
                );		

                $this->form_validation->set_rules('jml', 'Berat Bahan Baku', 'required',
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
                
                // $this->form_validation->set_rules('stok_min', 'Batas Stok Minimal', 'required|numeric',
                //         array('required' => '%s harus diisi!',
                //         'numeric' =>  '%s hanya diisi oleh angka!',
                //         )
                // );   
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
        $data=array(
                'bahan_baku' =>  $this->m_bb->getdata(),
                'title'=>'Kini Cheese Tea | Bahan Baku',
                'heading' => 'Bahan Baku'
        );
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('bahan_baku/view_data',$data);
        $this->load->view('templates/footer');
    }

    public function delete_data($kode_bb)
    {
            if (!isset($kode_bb)) show_404();

            if ($this->m_bb->delete($kode_bb)) {
                $this->session->set_flashdata('flash', 'dihapus');
                redirect(site_url('bahan_baku/view_data'));
            }
    }
}
?>