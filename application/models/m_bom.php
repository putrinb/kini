<?php
class m_bom extends CI_Model
{

  //deklarasi atribut dan access method-nya
  private $_table = "bom";

  public $id_bom;
  public $id_minum;
  public $kode_bb;
  public $satuan_bb;
  public $qty;

  // buat id_bom
  public function getId()
  {
    $sql = "SELECT (substring(IFNULL(MAX(id_bom),0),7)+0) as hsl FROM " . $this->_table;
    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $jml_data = $cacah['hsl'];
    endforeach;
    $id = 'BOMP-';
    $nomor = str_pad(($jml_data + 1), 5, "0", STR_PAD_LEFT); //ID-001
    $id = $id . $nomor;
    return $id;
  }

  public function getIdBOM($id_bom)
  {
    return $this->db->get_where('bom', ['id_bom' => $id_bom])->row_array();
  }

  public function getIdMinuman()
  {
    return $this->db->get_where('minuman', ['id_kategori' => '001'])->result_array();
  }

  public function getBahanPenolong()
  {
    $query = $this->db->get('bahan_baku');
    return $query->result_array();
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

  public function getDataDetail($id_bom, $id_produk)
  {
    $this->db->select('*');
    $this->db->from('bom');
    $this->db->join('detail_bom', 'bom.id_bom = detail_bom.id_bom');
    $this->db->join('minuman', 'minuman.id_minum = bom.id_minum');
    $this->db->join('bahanbaku_utama', 'bahanbaku_utama.kode_bb = detail_bom.kode_bb');
    $this->db->where('detail_bom.id_bom', $id_bom);
    $this->db->where('detail_bom.id_minum', $id_produk);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function getHargaBOM($no_nota)
  {
    $sql = " SELECT detail_bom.kode_bb as bahanbaku FROM nota_penjualan 
        JOIN detail_jual on nota_penjualan.no_nota = detail_jual.no_nota 
        JOIN topping on topping.id_topping = detail_jual.id_topping 
        JOIN minuman on minuman.id_minum = detail_jual.id_minum 
        JOIN bom on bom.id_bom = minuman.id_bom 
        JOIN detail_bom on detail_bom.id_bom = bom.id_bom 
        JOIN detail_penerimaan ON detail_penerimaan.kode_bb = detail_bom.kode_bb  
        JOIN bahanbaku_utama on bahanbaku_utama.kode_bb = detail_bom.kode_bb";
    $sql = $sql . " WHERE detail_jual.no_nota  = " . $this->db->escape($no_nota);

    $query = $this->db->query($sql);
    $bahanbaku = $query->result_array();
    return $bahanbaku;
  }

  function konversi($id_bom, $nama_bb)
  {
    $id_bom = $this->input->post('id_bom');
    $nama_bb = $this->input->post('nama_bb');

    $sql = " SELECT * FROM detail_bom 
    JOIN detail_penerimaan ON detail_penerimaan.kode_bb = detail_bom.kode_bb  
    JOIN pembelian_detail ON pembelian_detail.kode_bhn_baku_pembelian = detail_penerimaan.kode_bb
    JOIN bahanbaku_utama ON bahanbaku_utama.kode_bb = detail_bom.kode_bb";
    $sql = $sql . " WHERE detail_bom.id_bom  = " . $this->db->escape($id_bom) . "and detail_bom.kode_bb = " . $this->db->escape($nama_bb);
    $query = $this->db->query($sql);
    $hasil = $query->result_array();

    foreach ($hasil as $cacah) :
      $stok_bb = $cacah['stok_awal'];
      $berat_bb = $cacah['jumlah']; //berat bb
      $harga_beli = $cacah['harga_bhn_baku_pembelian']; // harga beli
      $qty_bom = $cacah['qty']; // qty bom
      $satuan_bom = $cacah['satuan_bb'];

      if ($harga_beli = 0) {
        $dipakai = 0;
      } else {
        $dipakai = $harga_beli * $qty_bom;
      }
      return $dipakai;
    endforeach;
  }

  public function input_data()
  {
    $nama_bb = $this->input->post('nama_bb');
    $id_bom = $this->getId();
    $data['data_bom'] = [
      'id_bom' => $this->getId(),
      'id_minum'  => $this->input->post('id_produk'),
      'kode_bb'       =>  $this->input->post('nama_bb'),
      'qty'           =>  $this->input->post('qty'),
      'satuan_bb'        =>  $this->input->post('satuan'),

    ];

    //cek dulu apakah sudah ada
    $sql = "SELECT COUNT(*) as jml FROM bom WHERE id_bom = " . $this->db->escape($this->input->post('id_bom'));
    $sql = $sql . " AND id_minum = " . $this->db->escape($this->input->post('id_produk'));
    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $jml_data = $cacah['jml'];
    endforeach;
    //jumlah data 0 berarti belum ada datanya, maka dimasukkan ke tabel
    if ($jml_data < 1) {
      //insert ke tabel bom dulu
      $data = [
        'id_bom' => $this->getId(),
        'id_minum'  => $this->input->post('id_produk'),
      ];
      $this->db->insert('bom', $data);

      //insert ke tabel detail bom
      $detail = [
        'id_bom' =>  $this->input->post('id_bom'),
        'id_minum'  =>  $this->input->post('id_produk'),
        'kode_bb'       =>  $this->input->post('nama_bb'),
        'qty'           =>  $this->input->post('qty'),
        'satuan_bb'        =>  $this->input->post('satuan'),
        // 'harga_bb'  => $dipakai,
      ];
      $this->db->insert('detail_bom', $detail);

      //update id_bom
      $sql = "UPDATE minuman SET id_bom = " . $this->db->escape($this->input->post('id_bom'));
      $sql = $sql . " WHERE id_minum = " . $this->db->escape($this->input->post('id_produk'));
      $query = $this->db->query($sql);


      return $this->db->affected_rows();
    } else {
      //insert ke tabel detail bom
      $dipakai = $this->konversi($id_bom, $nama_bb);
      $detail = [
        'id_bom' =>  $this->input->post('id_bom'),
        'id_minum'  =>  $this->input->post('id_produk'),
        'kode_bb'       =>  $this->input->post('nama_bb'),
        'qty'           =>  $this->input->post('qty'),
        'satuan_bb'        =>  $this->input->post('satuan'),
        // 'harga_bb'  => $dipakai,

      ];
      $this->db->insert('detail_bom', $detail);

      //update id_bom
      $sql = "UPDATE minuman SET id_bom = " . $this->db->escape($this->input->post('id_bom'));
      $sql = $sql . " WHERE id_minum = " . $this->db->escape($this->input->post('id_produk'));
      $query = $this->db->query($sql);

      return $this->db->affected_rows();
    }
  }

  public function getData()
  {
    $this->db->select('*');
    $this->db->from('minuman');
    // $this->db->join('detail_bom', 'detail_bom.id_bom = bom.id_bom');
    $this->db->join('bom', 'minuman.id_minum = bom.id_minum');
    $this->db->order_by('bom.id_bom');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function update_edit()
  {
    $post = $this->input->post();
    $this->id_bom = $post['id_bom'];
    $this->id_minum = $post['id_produk'];
    $this->kode_bb = $post["nama_bb"];
    $this->qty = $post["qty"];
    $this->satuan_bb = $post["satuan"];

    $sql = "UPDATE detail_bom";
    $sql = $sql . " SET id_bom = " . $this->db->escape($this->id_bom) . ", id_minum = " . $this->db->escape($this->id_produk);
    $sql = $sql . " , kode_bb = " . $this->db->escape($this->nama_bb);
    $sql = $sql . " , qty = " . $this->db->escape($this->qty);
    $sql = $sql . " , satuan_bb = " . $this->db->escape($this->satuan);
    $sql = $sql . " WHERE id_bom = " . $this->db->escape($post["id_bom"]) . " AND id_minum = " . $this->db->escape($post["id_produk"]) . "";
    $query = $this->db->query($sql);
    return $this->db->affected_rows();
    // return $this->db->get_where('bahanbaku_utama', array('kode_bb' => $kode_bb))->row_array();
  }

  public function delete_bom($id_bom, $id_produk)
  {
    //delete dokumen dan qrcode
    //$this->_deleteDokumenDanQrCode($id_bom,$id_produk);

    //hapus data tabel anaknya
    $this->db->delete('detail_bom', array("id_bom" => $id_bom, "id_minum" => $id_produk));
    //baru hapus tabel induknya
    $this->db->delete('bom', array("id_bom" => $id_bom, "id_minum" => $id_produk));
    //hapus di tabel produk
    $post = $this->input->post();
    $sql = "UPDATE minuman";
    $sql = $sql . " SET id_bom = NULL";
    $sql = $sql . " WHERE id_bom = '" . $id_bom . "'";
    $query = $this->db->query($sql);
    return $this->db->affected_rows();
  }

  public function deleteFormInputDetailBOM($no_bom)
  {

    //query data jumlah bom yang akan di hapus
    $sql = "SELECT kode_bb,qty FROM detail_bom ";
    $sql = $sql . " WHERE no_bom = " . $no_bom;
    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    // foreach($hasil as $cacah):
    // 	//update stoknya ke semula sebelum dihapus
    // 	// $sql2 = "UPDATE buah SET Stok = Stok - ".$cacah['jumlah_pembelian'];
    // 	// $sql2 = $sql2." WHERE IdBuah = ".$cacah['id_buah'];
    // 	$query2 = $this->db->query($sql2);
    // endforeach;

    return $this->db->delete('detail_bom', array("no_bom" => $no_bom));
  }

  public function CountPenerimaan()
  {
    return $this->db->count_all_results('penerimaan');  // Produces an integer, like 25
  }

  public function CountProduk()
  {
    return $this->db->count_all_results('minuman');  // Produces an integer, like 25
  }

  public function CountBOM()
  {
    return $this->db->count_all_results('bom');  // Produces an integer, like 25
  }

  public function CountBB()
  {
    return $this->db->count_all_results('bahanbaku_utama');  // Produces an integer, like 25
  }
}
