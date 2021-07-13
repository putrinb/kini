<?php
class m_penerimaan extends CI_Model
{

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
  public $amount;

  // buat id_penerimaan
  public function getId()
  {
    $sql = "SELECT (substring(IFNULL(MAX(id_penerimaan),0),6)+0) as hsl FROM " . $this->_table;
    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $jml_data = $cacah['hsl'];
    endforeach;
    $id = 'RCV-';
    $nomor = str_pad(($jml_data + 1), 5, "0", STR_PAD_LEFT); //ID-001
    $id = $id . $nomor;
    return $id;
  }

  public function getIdPenerimaan($id_penerimaan)
  {
    return $this->db->get_where('penerimaan', ['id_penerimaan' => $id_penerimaan])->row_array();
  }

  public function getIdPembelian()
  {
    return $this->db->get_where('pembelian', array('status_pembelian =' => 'dibeli'))->result_array();
  }

  public function getHargaPembelian()
  {
    return $this->db->get_where('pembelian', array('status_pembelian =' => 'dibeli'))->row_array();
  }

  public function getDataSatuanPembelian($nama_bb)
  {
    $sql = "
          SELECT bahanbaku_utama.satuan as satuan
          FROM bahanbaku_utama JOIN pembelian_detail on bahanbaku_utama.kode_bb = pembelian_detail.kode_bhn_baku_pembelian
          WHERE kode_bhn_baku_pembelian = " . $this->db->escape($nama_bb) . "
          ";

    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $satuan = $cacah['satuan'];
    endforeach;

    return $satuan;
  }

  public function getDataJumlahPembelian($nama_bb)
  {
    $sql = "
            SELECT qty_pembelian
            FROM pembelian_detail
            WHERE kode_bhn_baku_pembelian = " . $this->db->escape($nama_bb) . "
            ";

    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $qty = $cacah['qty_pembelian'];
    endforeach;

    return $qty;
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

  public function getDataDetail($id_penerimaan)
  {
    $this->db->select('*');
    $this->db->from('penerimaan');
    $this->db->join('detail_penerimaan', 'penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan');
    // $this->db->join('pembelian', 'pembelian.id_pembelian = penerimaan.id_pembelian');
    $this->db->join('bahanbaku_utama', 'bahanbaku_utama.kode_bb = detail_penerimaan.kode_bb');
    $this->db->where('detail_penerimaan.id_penerimaan', $id_penerimaan);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getHarga($nama_bb)
  {
    $sql = "
          SELECT pembelian_detail.id_pembelian as id, harga_bhn_baku_pembelian as total_harga
          FROM pembelian_detail JOIN pembelian ON pembelian.id_pembelian = pembelian_detail.id_pembelian
          WHERE kode_bhn_baku_pembelian = " . $this->db->escape($nama_bb) . "
          ORDER BY tgl_pembelian ASC";

    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $harga = $cacah['total_harga'];
    endforeach;

    return $harga;
  }

  public function getIDBeli($nama_bb)
  {
    $sql = "
          SELECT pembelian_detail.id_pembelian as id, harga_bhn_baku_pembelian as total_harga
          FROM pembelian_detail JOIN pembelian ON pembelian.id_pembelian = pembelian_detail.id_pembelian
          WHERE kode_bhn_baku_pembelian = " . $this->db->escape($nama_bb) . "
          GROUP BY kode_bhn_baku_pembelian";

    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $id = $cacah['id'];
    endforeach;

    return $id;
  }

  public function getsatuanBB($nama_bb)
  {
    $sql = "
          SELECT satuan FROM bahanbaku_utama
          WHERE kode_bb = " . $this->db->escape($nama_bb) . "
          ";

    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $satuanBB = $cacah['satuan'];
    endforeach;

    return $satuanBB;
  }

  public function getjmlBB($nama_bb)
  {
    $sql = "
          SELECT jumlah FROM bahanbaku_utama
          WHERE kode_bb = " . $this->db->escape($nama_bb) . "
          ";

    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $jmlBB = $cacah['jumlah'];
    endforeach;

    return $jmlBB;
  }

  public function input_data()
  {
    $post = $this->input->post();
    $data['penerimaan'] = [
      'id_penerimaan' => $this->getId(),
      'tanggal'       => $this->input->post('tanggal'),
      'kode_bb'       => $this->input->post('nama_bb'),
    ];

    //cek dulu apakah sudah ada
    $sql = "SELECT COUNT(*) as jml FROM penerimaan WHERE id_penerimaan = " . $this->db->escape($this->input->post('id_penerimaan'));
    // $sql = $sql." AND id_pembelian = ".$this->db->escape($this->input->post('id_pembelian'));
    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $jml_data = $cacah['jml'];
    endforeach;
    //jumlah data 0 berarti belum ada datanya, maka dimasukkan ke tabel
    if ($jml_data < 1) {

      //insert ke tabel penerimaan dulu
      $tanggal = $this->input->post('tanggal');
      $data = [
        'id_penerimaan' => $this->input->post('id_penerimaan'),
        'tanggal'       => $tanggal,
        'nm_penerima'   => $this->input->post('nm_penerima'),
      ];
      $this->db->insert('penerimaan', $data);

      //insert ke tabel detail penerimaan
      $nama_bb = $this->input->post('nama_bb');
      $id = $this->getIDBeli($nama_bb);
      $harga = $this->getHarga($nama_bb);
      $satuan = $this->getDataSatuanPembelian($nama_bb);
      $qty = $this->getDataJumlahPembelian($nama_bb);
      $satuanBB = $this->getsatuanBB($nama_bb);
      $jmlBB = $this->getjmlBB($nama_bb);

      $detail = [
        'id_penerimaan' =>  $this->input->post('id_penerimaan'),
        'id_pembelian'  => $id,
        'kode_bb'       =>  $this->input->post('nama_bb'),
        'harga'  =>  $harga,
        'satuan_bb'        =>  $satuan,
        'qty'           =>  $qty,
        'total'         =>  $qty * $harga,
        'ket'    =>  $this->input->post('keterangan'),

      ];
      $this->db->insert('detail_penerimaan', $detail);

      //update stok barang
      $this->qty = $this->getDataJumlahPembelian($nama_bb);
      $sql = "UPDATE bahanbaku_utama SET stok_awal = stok_awal + " . $this->db->escape($this->qty);
      $sql = $sql . " WHERE kode_bb = " . $this->db->escape($post["nama_bb"]);
      $query = $this->db->query($sql);

      //update harga bahan baku
      $this->harga = $this->getHarga($nama_bb);
      $sql = "UPDATE bahanbaku_utama SET harga_bb = " . $this->db->escape($this->harga);
      $sql = $sql . " WHERE kode_bb = " . $this->db->escape($post["nama_bb"]);
      $query = $this->db->query($sql);

      return $this->db->affected_rows();
    } else {
      //insert ke tabel detail pembelian_bb
      $nama_bb = $this->input->post('nama_bb');
      $id = $this->getIDBeli($nama_bb);
      $harga = $this->getHarga($nama_bb);
      $satuan = $this->getDataSatuanPembelian($nama_bb);
      $qty = $this->getDataJumlahPembelian($nama_bb);
      $detail = [
        'id_penerimaan' =>  $this->input->post('id_penerimaan'),
        'id_pembelian'  => $id,
        'kode_bb'       =>  $this->input->post('nama_bb'),
        'harga'  =>  $harga,
        // str_replace(".","",$this->input->post('harga_satuan')),
        'satuan_bb'        =>  $satuan,
        'qty'           =>  $qty,
        'total'         =>  $qty * $harga,
        'ket'    =>  $this->input->post('keterangan'),

      ];
      $this->db->insert('detail_penerimaan', $detail);

      //update stok barang
      $this->qty = $this->getDataJumlahPembelian($nama_bb);
      $sql = "UPDATE bahanbaku_utama SET stok_awal = stok_awal + " . $this->db->escape($this->qty);
      $sql = $sql . " WHERE kode_bb = " . $this->db->escape($post["nama_bb"]);
      $query = $this->db->query($sql);

      //update harga bahan baku
      $this->harga = $this->getHarga($nama_bb);
      $sql = "UPDATE bahanbaku_utama SET harga_bb = " . $this->db->escape($this->harga);
      $sql = $sql . " WHERE kode_bb = " . $this->db->escape($post["nama_bb"]);
      $query = $this->db->query($sql);

      return $this->db->affected_rows();
    }
  }

  public function getDataBB()
  {
    if (isset($_SESSION['id_penerimaan'])) {
      $sql = "SELECT * FROM pembelian_detail JOIN bahanbaku_utama on pembelian_detail.kode_bhn_baku_pembelian = bahanbaku_utama.kode_bb
      JOIN pembelian on pembelian.id_pembelian = pembelian_detail.id_pembelian
    WHERE kode_bb NOT IN 
    (SELECT kode_bb FROM detail_penerimaan WHERE id_penerimaan = " . $this->db->escape($_SESSION['id_penerimaan']) . ")
    GROUP BY pembelian_detail.kode_bhn_baku_pembelian ";
    } else {
      //query tanpa where
      $sql = "SELECT * FROM bahanbaku_utama 
    ";
    }

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function getData()
  {
    $this->db->select('penerimaan.id_penerimaan, date_format(tanggal, "%d-%m-%Y") as time, nm_penerima');
    $this->db->from('penerimaan');
    $this->db->join('detail_penerimaan', 'penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan');
    $this->db->group_by('penerimaan.id_penerimaan');
    $this->db->order_by('penerimaan.id_penerimaan', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function deleteFormInputDetailPenerimaan($no_penerimaan)
  {
    //query data jumlah pembelian yang akan di hapus
    $sql = "SELECT kode_bb,qty FROM detail_penerimaan ";
    $sql = $sql . " WHERE no_penerimaan = " . $no_penerimaan;
    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $row) :
      //update stoknya ke semula sebelum dihapus
      $sql2 = "UPDATE bahanbaku_utama SET stok_awal = stok_awal - " . $row['qty'];
      $sql2 = $sql2 . " WHERE kode_bb = '" . $row['kode_bb']."'";
      $query2 = $this->db->query($sql2);
    endforeach;

    return $this->db->delete('detail_penerimaan', array("no_penerimaan" => $no_penerimaan));
  }

  
}
