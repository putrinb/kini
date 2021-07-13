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
          if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
          }
          
          return "default.jpg";
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
        $this->db->select('*');
        $this->db->from('minuman');
        $this->db->join('kategori', 'minuman.id_kategori = kategori.id_kategori');
        // $this->db->join('produk', 'produk.id_produk = bom.id_produk');
        // $this->db->join('bom', 'bom.id_bom = pemakaian.id_bom');
        // $this->db->where('detail_pemakaian.no_pemakaian', $no_pemakaian);
        $query = $this->db->get();
        return $query->result_array();
      }

      public function getEdit($id_produk)
      {
        return $this->db->get_where('produk', array("id_produk" => $id_produk))->row_array();
      }

      public function delete($id_produk)
      {
        $this->_deleteImage($id_produk);
			  return $this->db->delete('produk', array("id_produk" => $id_produk));
      }

      public function update_data($id_produk)
      {
        $post = $this->input->post();
        $this->id_produk = $this->input->post('id_produk');
        $this->nama_produk = $this->input->post('nama_produk');
        
        //jika ada file yang diupload saat mengedit data maka upload filenya
        if(!empty($_FILES["image"]["name"])){
          $this->image = $this->_uploadImage();
        }else{
          $this->image = $this->input->post('old_image');
        }
        
        $sql = "UPDATE produk";
        $sql = $sql." SET nama_produk = ".$this->db->escape($this->nama_produk).", gambar= ".$this->db->escape($this->image);
        $sql = $sql." WHERE id_produk = ".$this->db->escape($this->input->post('id_produk'));
        $query = $this->db->query($sql);
        return $this->db->affected_rows();
      }
		
		private function _deleteImage($id_produk)
		{
			$produk = $this->getEdit($id_produk);
			foreach($produk as $cacah):
				$gambar = $cacah['gambar'];
			endforeach;
			if ($gambar != 0) {
				$filename = explode(".", $gambar);
				return array_map('unlink', glob(FCPATH."upload/produk/".$filename[0].".*"));
			}
		}
}
?>