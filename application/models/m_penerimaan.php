<?php
class m_penerimaan extends CI_Model {

    //deklarasi atribut dan access method-nya
    private $_table = "penerimaan";
    private $_table_detail = "detail_beli";
    private $_table_pembelian = "pembelian";

    public $id_penerimaan;
    public $id_pembelian;
    public $tanggal;
    public $no_penerimaan;
    public $id_supplier;
    public $kode_bb;
    public $harga_satuan;
    public $satuan_bb;
    public $qty;
    public $ket;
    public $total;

    // buat id_penerimaan
    public function getId()
	{
		$sql = "SELECT (substring(IFNULL(MAX(id_penerimaan),0),6)+0) as hsl FROM ".$this->_table;
      $query = $this->db->query($sql);
      $hasil = $query->result_array();
      foreach($hasil as $cacah):
      $jml_data = $cacah['hsl'];
      endforeach;
      $id = 'RCV-';
      $nomor = str_pad(($jml_data+1),5,"0",STR_PAD_LEFT); //ID-001
      $id = $id.$nomor;
		return $id;
    }

    public function getIdPenerimaan($id_penerimaan)
    {
        return $this->db->get_where('penerimaan',['id_penerimaan' => $id_penerimaan])->row_array();
    }

    public function getIdPembelian()
    {
      return $this->db->get('pembelian', array())->result_array(); 
    }
  
    		//untuk membuat jurnal umum
		// public function generate_jurnal_umum($no_transaksi,$id_supplier){
			
		// 	//dapatkan total harga pembelian
		// 	$sql = "SELECT a.no_transaksi,DATE_FORMAT(a.tanggal,'%Y-%m-%d') as tanggal,";
		// 	$sql = $sql." sum(b.harga*b.jumlah) as total_pembelian ";
		// 	$sql = $sql." FROM ".$this->_table." a ";
		// 	$sql = $sql." JOIN ".$this->_table_detail." b ";
		// 	$sql = $sql." ON (a.no_faktur=b.no_faktur AND a.id_supplier=b.id_supplier) ";
		// 	$sql = $sql." WHERE a.no_faktur = ".$this->db->escape($no_faktur)." and a.id_supplier = ".$this->db->escape($idsupplier);
		// 	$sql = $sql." group by a.no_transaksi,DATE_FORMAT(a.tanggal,'%d-%m-%Y');";
			
		// 	$query = $this->db->query($sql);
		// 	$hasil = $query->result_array();
			
		// 	foreach($hasil as $cacah):
		// 		$total = $cacah['total_pembelian'];
		// 		$tanggal = $cacah['tanggal'];
		// 		$idtransaksi = $cacah['no_transaksi'];
		// 	endforeach;
			
		// 	//dapatkan kode akun yang terkait dengan transaksi pembelian_bb untuk jurnal
		// 	$sql2 = "SELECT * FROM view_coa WHERE transaksi = 'pembelian_bb' ORDER BY posisi DESC" ;
			
		// 	$query2 = $this->db->query($sql2);
		// 	$hasil2 = $query2->result_array();
			
		// 	foreach($hasil2 as $cacah):
		// 		//masukkan ke tabel jurnal
		// 		$sql2 = "INSERT INTO jurnal_umum ";
		// 		$sql2 = $sql2." SET no_transaksi = ".$idtransaksi.", ";
		// 		$sql2 = $sql2." no_akun = ".$cacah['no_akun'].", ";
		// 		$sql2 = $sql2." tgl_jurnal = '".$tanggal."', ";
		// 		$sql2 = $sql2." posisi_dr_cr = '".$cacah['posisi']."', ";
		// 		$sql2 = $sql2." nominal = ".$total." , ";
		// 	  //$sql2 = $sql2." kelompok = ".$cacah['kelompok'].", ";
		// 		//$sql2 = $sql2." transaksi = '".$cacah['transaksi']."' ";
		// 		$query2 = $this->db->query($sql2);
		// 	endforeach;
			
    // }
    
    public function getDataDetail($id_penerimaan,$id_pembelian)
    {
      $this->db->select('*');
      $this->db->from('penerimaan');
      $this->db->join('detail_penerimaan', 'penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan');
      $this->db->join('pembelian', 'pembelian.id_pembelian = penerimaan.id_pembelian');
      $this->db->join('bahan_baku', 'bahan_baku.kode_bb = detail_penerimaan.kode_bb');
      $this->db->where('detail_penerimaan.id_penerimaan', $id_penerimaan);
      $this->db->where('detail_penerimaan.id_pembelian', $id_pembelian);
      // $this->db->join('supplier', 'supplier.id_supplier = detail_penerimaan.id_supplier');
      $query = $this->db->get();      
      return $query->result_array();
    }

    public function input_data(){
      $post = $this->input->post();
      $data['penerimaan'] = [
        'id_penerimaan' => $this->getId(), 
        'id_pembelian'  => $this->input->post('id_pembelian'),
        'tanggal'       => $this->input->post('tanggal'),
        'kode_bb'       => $this->input->post('nama_bb'),
      ];
        
      //cek dulu apakah sudah ada
      $sql = "SELECT COUNT(*) as jml FROM penerimaan WHERE id_penerimaan = ".$this->db->escape($this->input->post('id_penerimaan'));
      $sql = $sql." AND id_pembelian = ".$this->db->escape($this->input->post('id_pembelian'));
      $query = $this->db->query($sql);
      $hasil = $query->result_array();
      foreach($hasil as $cacah):
        $jml_data = $cacah['jml'];
      endforeach;
      //jumlah data 0 berarti belum ada datanya, maka dimasukkan ke tabel
      if($jml_data<1)
      {
        //lakukan fungsi upload data ke temporary server dulu
        //$this->Dokumen = $this->_uploadDokumen();
      
        //insert ke tabel penerimaan dulu
        $data=[
          'id_penerimaan' => $this->input->post('id_penerimaan'), 
          'id_pembelian'  => $this->input->post('id_pembelian'),
          'tanggal'       => $this->input->post('tanggal'),
          'nm_penerima'   => $this->input->post('nm_penerima'),
        ];
        $this->db->insert('penerimaan', $data);
        // $sql = "INSERT INTO pembelian_bb(no_faktur,id_supplier,tanggal) ";
        // $sql = $sql." VALUES(".$this->db->escape($post["no_faktur"]).",".$this->db->escape($post["id_supplier"]);
        // $sql = $sql.",STR_TO_DATE(".$this->db->escape($post["datetimepicker"]).",'%Y-%m-%d'))";
        // $query = $this->db->query($sql);
    
        //insert ke tabel detail penerimaan
        $detail=[
          'id_penerimaan' =>  $this->input->post('id_penerimaan'),
          'id_pembelian'  =>  $this->input->post('id_pembelian'),
          // 'id_supplier'   =>  $this->input->post('id_supplier'),
          'kode_bb'       =>  $this->input->post('nama_bb'),
          'harga_satuan'  =>  str_replace(".","",$this->input->post('harga_satuan')),
          'satuan_bb'        =>  $this->input->post('satuan'),
          'qty'           =>  $this->input->post('qty'),
          'ket'    =>  $this->input->post('keterangan'),

        ];
        $this->db->insert('detail_penerimaan', $detail);

        //update stok barang
				$sql = "UPDATE bahan_baku SET stok_awal = stok_awal + ".$this->db->escape($post["qty"]);
				$sql = $sql." WHERE kode_bb = ".$this->db->escape($post["nama_bb"]);
				$query = $this->db->query($sql);
				
        return $this->db->affected_rows();
        
      }else{
        //insert ke tabel detail pembelian_bb
        $detail=[
          'id_penerimaan' =>  $this->input->post('id_penerimaan'),
          'id_pembelian'  =>  $this->input->post('id_pembelian'),
          // 'id_supplier'   =>  $this->input->post('id_supplier'),
          'kode_bb'       =>  $this->input->post('nama_bb'),
          'harga_satuan'  =>  str_replace(".","",$this->input->post('harga_satuan')),
          'satuan_bb'        =>  $this->input->post('satuan'),
          'qty'           =>  $this->input->post('qty'),
          'ket'    =>  $this->input->post('keterangan'),

        ];
        $this->db->insert('detail_penerimaan', $detail);

        //update stok barang
				$sql = "UPDATE bahan_baku SET stok_awal = stok_awal + ".$this->db->escape($post["qty"]);
				$sql = $sql." WHERE kode_bb = ".$this->db->escape($post["nama_bb"]);
				$query = $this->db->query($sql);
				
				return $this->db->affected_rows();
      }
      
    }

    public function getData(){
      $this->db->select('*');
      $this->db->from('penerimaan');
      $this->db->join('pembelian', 'penerimaan.id_pembelian = pembelian.id_pembelian');
      $this->db->order_by('id_penerimaan', 'asc');
      $query = $this->db->get();             
      return $query->result_array();
    }
    
    // public function getDataByNoFakturid_supplier($no_faktur,$id_supplier){
    //   $sql = "SELECT a.*,b.nama as NamaSupplier FROM ".$this->_table." a ";
    //   $sql = $sql." JOIN supplier b ON (a.id_supplier=b.id_supplier) ";
    //   $sql = $sql." WHERE a.no_faktur =  ".$this->db->escape($no_faktur)." AND a.id_supplier = ".$this->db->escape($id_supplier);
    //   $query = $this->db->query($sql);
      
    //   return $query->result_array();
    // }
    
    public function getPembelianId(){
      $sql = "SELECT (substring(IFNULL(MAX(id_transaksi_pembelian),0),5)+0) as hsl FROM ".$this->_table;
      $query = $this->db->query($sql);
      $hasil = $query->result_array();
      foreach($hasil as $cacah):
        $jml_data = $cacah['hsl'];
      endforeach;
      $id = 'PMB-';
      $nomor = str_pad(($jml_data+1),6,"0",STR_PAD_LEFT); //PMB-000001
      $id = $id.$nomor;
      return $id;
    }

    public function deleteFormInput($id_penerimaan,$id_pembelian)
    {
      //delete dokumen dan qrcode
      //$this->_deleteDokumenDanQrCode($id_penerimaan,$id_pembelian);
      
      //hapus data tabel anaknya
      $this->db->delete('detail_penerimaan', array("id_penerimaan" => $id_penerimaan, "id_pembelian" => $id_pembelian));
      //baru hapus tabel induknya
      return $this->db->delete('pembelian_bb', array("id_penerimaan" => $id_penerimaan, "id_pembelian" => $id_pembelian));
      
    }

    public function deleteFormInputDetailPenerimaan($no_penerimaan)
    {
      return $this->db->delete('detail_penerimaan', array("no_penerimaan" => $no_penerimaan));
    }








    
    public function getDataEdit($no_faktur,$id_supplier){
      $sql = "SELECT a.*,b.nama as NamaSupplier ";
      $sql = $sql." FROM ".$this->_table." a ";
      $sql = $sql." JOIN supplier b ON (a.id_supplier=b.id_supplier) ";
      $sql = $sql." WHERE a.no_faktur= ".$this->db->escape($no_faktur);
      $sql = $sql." AND a.id_supplier= ".$this->db->escape($id_supplier);
      $query = $this->db->query($sql);
      return $query->result_array();
    }
    
    
    public function getDataEditDetailPembelian($id){
      $sql = "SELECT a.*,b.nama as NamaSupplier,c.nama_bahan ";
      $sql = $sql." FROM ".$this->_table_detail." a ";
      $sql = $sql." JOIN supplier b ON (a.id_supplier=b.id_supplier) ";
      $sql = $sql." JOIN bahanbaku c ON (a.kode_bb=c.kode_bb) ";
      $sql = $sql." WHERE a.id_transaksi_pembelian= ".$this->db->escape($id);
      $query = $this->db->query($sql);
      return $query->result_array();
    }
    
    //membuat qrcode yg berisi data link dokumen nota yang diupload
    /*public function generate_qrcode($namafile){
      $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
      $config['cacheable']    = true; //boolean, the default is true
      $config['cachedir']     = ''; //string, the default is application/cache/
      $config['errorlog']     = ''; //string, the default is application/logs/
      $config['imagedir']     = './upload/pembelian/qrcode/'; //direktori penyimpanan qr code
      $config['quality']      = true; //boolean, the default is true
      $config['size']         = '1024'; //interger, the default is 1024
      $config['black']        = array(224,255,255); // array, default is array(255,255,255)
      $config['white']        = array(70,130,180); // array, default is array(0,0,0)
      $this->ciqrcode->initialize($config);
   
      $image_name=uniqid().'.png'; //buat name dari qr code dari fungsi uniqid()
   
      //data yang akan di jadikan QR CODE adalah lokasi file nota yang diupload
      $params['data'] = base_url('upload/pembelian/'.$namafile); 
      $params['level'] = 'H'; //H=High
      $params['size'] = 10;
      $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
      $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
      return $image_name;
    }
    */
    public function updateFormInput($no_faktur,$id_supplier)
    {
      $post = $this->input->post();
      $no_faktur_baru = $post["no_faktur"];
      $id_supplier_baru = $post["id_supplier"];
      $datetimepicker = $post["datetimepicker"];    
      
      //jika ada file yang diupload saat mengedit data maka upload filenya
      // if(!empty($_FILES["dokumen"]["name"])){
      //   $this->doc = $this->_uploadDokumen();
      // }
      /*else{
        $this->doc = $post["old_document"];
      }*/
      //nama dokumen menjadi parameter untuk generate qrcode
      //$namafileqrcode = $this->generate_qrcode($this->doc);
      
      $sql = "UPDATE ".$this->_table;
      $sql = $sql." SET no_faktur = ".$this->db->escape($no_faktur_baru).", id_supplier= ".$this->db->escape($id_supplier_baru);
      $sql = $sql." ,no_faktur = ".$this->db->escape($no_faktur_baru).", id_supplier= ".$this->db->escape($id_supplier_baru);
      $sql = $sql." ,tanggal = ".$this->db->escape($datetimepicker);
      //$sql = $sql." ,dokumen=".$this->db->escape($this->doc);
      //$sql = $sql." ,qrcode = ".$this->db->escape($namafileqrcode);
      $sql = $sql." WHERE no_faktur = ".$this->db->escape($no_faktur)." AND id_supplier = ".$this->db->escape($id_supplier);
      $query = $this->db->query($sql);
      return $this->db->affected_rows();
    }

    public function updateFormInputDetail($idtransaksipembelian)
    {
      $post = $this->input->post();
      $jumlah = str_replace(".","",$post["jumlah"]);
      $harga = str_replace(".","",$post["harga"]);
      
      $sql = "UPDATE ".$this->_table_detail;
      $sql = $sql." SET jumlah = ".$this->db->escape($jumlah).", harga_satuan= ".$this->db->escape($harga);
      $sql = $sql." WHERE id_transaksi_pembelian = ".$this->db->escape($idtransaksipembelian);
      $query = $this->db->query($sql); 
      return $this->db->affected_rows();
    }
    
    
    
    
    
    /*private function _uploadImage()
    {
      $config['upload_path']          = './upload/bahanbaku/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['file_name']      = uniqid();
      $config['overwrite']      = true;
      $config['max_size']             = 1024; // 1MB

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('gambar')) {
        return $this->upload->data("file_name");
      }
      
      return "default.jpg";
    }
    
    private function _uploadDokumen()
    {
      $config['upload_path']          = './upload/pembelian/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
      $config['file_name']      = uniqid();
      $config['overwrite']      = true;
      $config['max_size']             = 1024; // 2MB

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('dokumen')) {
        return $this->upload->data("file_name");
      }
      
      return "default.jpg";
    }
    
    private function _deleteImage($id)
    {
      $bahanbaku = $this->getDataEdit($id);
      foreach($bahanbaku as $cacah):
        $gambar = $cacah['Gambar'];
      endforeach;
      if ($gambar != "default.jpg") {
        $filename = explode(".", $gambar);
        return array_map('unlink', glob(FCPATH."upload/bahanbaku/".$filename[0].".*"));
      }
    } 
    
    private function _deleteDokumenDanQrCode($no_faktur,$id_supplier)
    {
      $pembelian = $this->getDataEdit($no_faktur,$id_supplier);
      foreach($pembelian as $cacah_pembelian):
        $pembeliandokumen = $cacah_pembelian['dokumen'];
        $pembelianqrcode = $cacah_pembelian['qrcode'];
      endforeach;
      
      $filename = explode(".", $pembeliandokumen);
      $filename2 = explode(".", $pembelianqrcode);
      
      array_map('unlink', glob(FCPATH."upload/pembelian/".$filename[0].".*"));
      array_map('unlink', glob(FCPATH."upload/pembelian/qrcode/".$filename2[0].".*"));
      
    }*/
}
?>