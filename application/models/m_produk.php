<?php

class m_produk extends CI_Model
{
    public function getIdProduk(){
        $sql = "SELECT (substring(IFNULL(MAX(id_produk),0),3)+0) as hsl FROM produk";
        $query = $this->db->query($sql);
        $hasil = $query->result_array();
        foreach($hasil as $cacah):
          $jml_data = $cacah['hsl'];
        endforeach;
        $id = 'P-';
        $nomor = str_pad(($jml_data+1),4,"0",STR_PAD_LEFT); //PMB-000001
        $id = $id.$nomor;
        return $id;
      }

    private function _uploadImage()
      {
          $config['upload_path']          = './upload/produk/';
          $config['allowed_types']        = 'gif|jpg|png|jpeg';
          $config['file_name']			= uniqid();
          $config['overwrite']			= true;
          $config['max_size']             = 1024; // 1MB

          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('image')) {
              echo "Upload Gagal"; die;
              
          }return $this->upload->data('file_name');
      }

      public function insert_data()
      {
          $data=[
              'id_produk' => $this->getIdProduk(),
              'nama_produk' =>  $this->input->post('nama_produk'),
              'gambar'  => $this->_uploadImage(),
          ];

          $this->db->insert('produk',$data);
      }

      public function getdata()
      {
        return $this->db->get('produk')->result_array();
      }

      public function getdataIdBOM()
      {
        $this->db->select('*');
        $this->db->from('produk');
        // $this->db->join('detail_bom', 'bom.id_bom = detail_bom.id_bom');
        $this->db->join('bom', 'produk.id_produk = bom.id_produk');
        // $this->db->join('bahan_baku', 'bahan_baku.kode_bb = detail_bom.kode_bb');
        
        $query = $this->db->get();      
        return $query->result_array();
      }

      public function delete($id_produk)
      {
        return $this->db->delete('produk', array("id_produk" => $id_produk));
      }
		
		// private function _deleteImage($id)
		// {
		// 	$buah = $this->getDataEdit($id);
		// 	foreach($buah as $cacah):
		// 		$gambar = $cacah['Gambar'];
		// 	endforeach;
		// 	if ($gambar != "default.jpg") {
		// 		$filename = explode(".", $gambar);
		// 		return array_map('unlink', glob(FCPATH."upload/buah/".$filename[0].".*"));
		// 	}
		// }
}
?>