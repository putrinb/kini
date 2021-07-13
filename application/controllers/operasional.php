<?php
class operasional extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('m_bop');
    }

    function check_data() {
        $penggunaan = $this->input->post('penggunaan');
        $daya = $this->input->post('daya');

        $this->db->select('id');
        $this->db->from('daftar_bop');
        $this->db->where('penggunaan', $penggunaan);
        $this->db->where('daya_watt', $daya);

        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num > 0) {
                $this->form_validation->set_message('check_data','Spesifikasi operasional sudah ada');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function add()
    {
        $data['heading'] = 'Daftar Operasional';
        $data['title'] = 'Kini Cheese Tea | Daftar Operasional';

        $this->form_validation->set_rules(
            'penggunaan',
            'nama penggunaan',
            'required|alpha_numeric_spaces|callback_check_data',
            array('required' => 'Anda harus memasukkan %s.')
        );

        $this->form_validation->set_rules(
            'daya',
            'daya penggunaan',
            'required|callback_check_data',
            array('required' => 'Anda harus memasukkan %s.')
        );
        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bop/input_bop', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->m_bop->input_op();
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('operasional/view_data');
            }
    }

    public function view_data()
    {
        $data['heading'] = 'Daftar Operasional';
        $data['title'] = 'Kini Cheese Tea | Operasional';
        $data['list'] = $this->m_bop->getDaftarBOP();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bop/view_bop', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit_data($id){
        if(!isset($id)) redirect('operasional/view_data');

        $data['heading'] = 'Daftar Operasional';
        $data['title'] = 'Kini Cheese Tea | Operasional';
        $data['bop'] = $this->m_bop->getIdDaftarBOP($id);

        $this->form_validation->set_rules('penggunaan', 'nama penggunaan', 'required|alpha_numeric_spaces',
                array('required' => 'Anda harus memasukkan %s.')
                );
        $this->form_validation->set_rules('daya', 'daya penggunaan', 'required',
                array('required' => 'Anda harus memasukkan %s.')
        );		

        
        $this->form_validation->set_error_delimiters('<div class="text-danger" style="font-size:12px">', '</div>');

        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $this->load->view('bop/edit_data',$data);
                $this->load->view('templates/footer');
        }
        else
        {
                $this->m_bop->updateDaftarBOP($id);
                $this->session->set_flashdata('flash','diubah');
                redirect('operasional/view_data'); 
        }
    }

}
