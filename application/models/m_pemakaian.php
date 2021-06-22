<?php
class m_pemakaian extends CI_Model
{
  public $nilai;
  public $qty_diterima;
  public $qty_bom;
  public $harga;
  public $satuan_bom;
  public $satuan_diterima;
  public $berat_diterima;
  public $harga_akhir;

  function getIdPemakaian()
  {
    $sql = "SELECT (substring(IFNULL(MAX(no_pemakaian),0),7)+0) as hsl FROM pemakaian";
    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $jml_data = $cacah['hsl'];
    endforeach;
    $id = 'PMK';
    $nomor = str_pad(($jml_data + 1), 6, "0", STR_PAD_LEFT);
    $id = $id . $nomor;
    return $id;
  }

  function getDetailPemakaian($no_pemakaian, $id_bom)
  {
    $this->db->select('*');
    $this->db->from('pemakaian');
    $this->db->join('detail_pemakaian', 'pemakaian.no_pemakaian = detail_pemakaian.no_pemakaian');
    $this->db->join('bahan_baku', 'detail_pemakaian.kode_bb = bahan_baku.kode_bb');
    // $this->db->join('bom', 'bom.id_bom = pemakaian.id_bom');
    $this->db->where('detail_pemakaian.no_pemakaian', $no_pemakaian);
    $this->db->where('detail_pemakaian.id_bom', $id_bom);
    $query = $this->db->get();
    return $query->result_array();
  }

  function detailBOM($id_bom)
  {
    $this->db->select('*');
    $this->db->from('detail_bom');
    $this->db->join('bom', 'bom.id_bom = detail_bom.id_bom');
    $this->db->join('bahan_baku', 'detail_bom.kode_bb = bahan_baku.kode_bb');
    $this->db->where('detail_bom.id_bom', $id_bom);
    $query = $this->db->get();
    return $query->result_array();
  }

  function bb_bom($id_bom)
  {
    // $id_bom = $this->input->post('id_bom');
    // $nama_bb = $this->input->post('nama_bb');
    $sql = " SELECT detail_bom.kode_bb, nama_bb, detail_penerimaan.qty as qty_diterima, harga, detail_bom.qty as qty_bom, detail_bom.satuan_bb as satuan_bom
    from detail_bom JOIN detail_penerimaan
    ON detail_penerimaan.kode_bb = detail_bom.kode_bb  join bahan_baku on bahan_baku.kode_bb = detail_bom.kode_bb
    ";
    $sql = $sql . " WHERE detail_bom.id_bom  = " . $this->db->escape($id_bom);

    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $row) :
      $kode_bb = $row['kode_bb'];
      $qty_diterima = $row['qty_diterima'];
      $qty_bom = $row['qty_bom'];
      $harga = $row['harga'];
      $satuan_bom = $row['satuan_bom'];
    endforeach;

    return $hasil;
  }

  function konversi($id_bom, $nama_bb)
  {
    $id_bom = $this->input->post('id_bom');
    $nama_bb = $this->input->post('nama_bb');
    $sql = " SELECT nama_bb, detail_penerimaan.qty as qty_diterima, detail_penerimaan.satuan_bb as satuan_diterima, harga, detail_bom.qty as qty_bom, detail_bom.satuan_bb as satuan_bom
    from detail_bom JOIN detail_penerimaan
    ON detail_penerimaan.kode_bb = detail_bom.kode_bb  join bahan_baku on bahan_baku.kode_bb = detail_bom.kode_bb
    ";
    $sql = $sql . " WHERE detail_bom.id_bom  = " . $this->db->escape($id_bom) . "and detail_bom.kode_bb = " . $this->db->escape($nama_bb);
    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $qty_diterima = $cacah['qty_diterima'];
      $qty_bom = $cacah['qty_bom'];
      $harga = $cacah['harga'];
      $satuan_bom = $cacah['satuan_bom'];
      $satuan_diterima = $cacah['satuan_diterima'];

      if ($satuan_diterima == 'kilogram (kg)' or 'liter(L)' and $satuan_bom == 'gram (gr)' or 'ml') {
        $berat_diterima = $qty_diterima * 1000;
        $harga_akhir = $harga / $berat_diterima;
        $nilai = $harga_akhir * $qty_bom;
      } else {
        $nilai = 1000;
      }
      return $nilai;
    endforeach;
  }

  public function getDataSatuanBOM($nama_bb)
  {
    $sql = "
        SELECT satuan_bb
        FROM detail_bom 
        WHERE kode_bb = " . $this->db->escape($nama_bb) . "
        ";

    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $satuan = $cacah['satuan_bb'];
    endforeach;

    return $satuan;
  }

  public function input_data()
  {
    $post = $this->input->post();
    $nama_bb = $this->input->post('nama_bb');
    $id_bom = $this->input->post('id_bom');
    $data['pemakaian'] = [
      'no_pemakaian' => $this->getIdPemakaian(),
      'id_bom'      => $this->input->post('id_bom'),
      'tanggal'       => $this->input->post('tanggal'),
      'kode_bb'       => $this->input->post('nama_bb'),
    ];

    //cek dulu apakah sudah ada
    $sql = "SELECT COUNT(*) as jml FROM pemakaian WHERE no_pemakaian = " . $this->db->escape($this->input->post('no_pemakaian'));
    $sql = $sql . " AND id_bom = " . $this->db->escape($this->input->post('id_bom'));
    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $jml_data = $cacah['jml'];
    endforeach;
    //jumlah data 0 berarti belum ada datanya, maka dimasukkan ke tabel
    if ($jml_data < 1) {
      //lakukan fungsi upload data ke temporary server dulu

      //insert ke tabel pemakaian dulu
      $data = [
        'no_pemakaian' => $this->m_pemakaian->getIdPemakaian(),
        'id_bom'  => $this->input->post('id_bom'),
        'tanggal'       => $this->input->post('tanggal'),
      ];
      $this->db->insert('pemakaian', $data);

      $konversi = $this->konversi($id_bom, $nama_bb);
      $satuan = $this->getDataSatuanBOM($nama_bb);
      $detail = [
        'no_pemakaian' =>  $this->input->post('no_pemakaian'),
        'id_bom'  =>  $this->input->post('id_bom'),
        'kode_bb'            =>  $this->input->post('nama_bb'),
        'jumlah_pemakaian'           =>  $this->input->post('qty'),
        'satuan_bahan'        =>  $satuan,
        'harga_bahan'  =>  $konversi,

      ];
      $this->db->insert('detail_pemakaian', $detail);

      return $this->db->affected_rows();
    } else {

      $konversi = $this->konversi($id_bom, $nama_bb);
      $satuan = $this->getDataSatuanBOM($nama_bb);
      $detail = [
        'no_pemakaian' =>  $this->input->post('no_pemakaian'),
        'id_bom'  =>  $this->input->post('id_bom'),
        'kode_bb'            =>  $this->input->post('nama_bb'),
        'jumlah_pemakaian'           =>  $this->input->post('qty'),
        'satuan_bahan'        =>  $satuan,
        'harga_bahan'  =>  $konversi,

      ];
      $this->db->insert('detail_pemakaian', $detail);

      return $this->db->affected_rows();
    }
  }

  public function deleteFormInputDetailPemakaian($id)
  {
    return $this->db->delete('detail_pemakaian', array("id" => $id));
  }

  public function input_btkl()
  {
    $detail = [
      'id_btkl' => $this->getIdBTKL(),
      'no_pemakaian' =>  $this->input->post('no_pemakaian'),
      'id_bom'  =>  $this->input->post('id_bom'),
      'gaji_harian'            =>  str_replace(".", "", $this->input->post('gaji')),
      'jml_hari'           =>  $this->input->post('day'),
      'jml_kry'        =>  $this->input->post('person'),
      'rata_jual' => $this->input->post('sales'),
      'btkl' => ((str_replace(".", "", $this->input->post('gaji')) * $this->input->post('day')) * $this->input->post('person')) / $this->input->post('sales'),

    ];
    $this->db->insert('detail_btkl', $detail);
    return $this->db->affected_rows();
  }

  public function getbtkl($no_pemakaian)
  {
    return $this->db->get_where('detail_btkl', ['no_pemakaian' => $no_pemakaian])->result_array();
  }

  public function getbop($no_pemakaian)
  {
    return $this->db->get_where('detail_bop', ['no_pemakaian' => $no_pemakaian])->result_array();
  }

  public function input_bop()
  {
    $detail = [
      'id_bop' => $this->getIdBOP(),
      'no_pemakaian' =>  $this->input->post('no_pemakaian'),
      'id_bom'  =>  $this->input->post('id_bom'),
      'tarif_dasar'            =>  str_replace(".", "", $this->input->post('tarif')),
      'jenis_bop'           =>  $this->input->post('type'),
      'waktu_menit'        =>  $this->input->post('lama'),
      'watt' => '2',
      // 'bop' => ((str_replace(".","",$this->input->post('gaji'))*$this->input->post('day'))*$this->input->post('person'))/$this->input->post('sales'),

    ];
    $this->db->insert('detail_bop', $detail);

    $detail = [
      
      'no_pemakaian' =>  $this->input->post('no_pemakaian'),
      'id_btkl' => $this->getIdBTKL(),
      'id_bop' => $this->getIdBOP(),

    ];
    $this->db->insert('biaya_produksi', $detail);
    return $this->db->affected_rows();
  }

  public function getIdBTKL()
  {
    $sql = "SELECT (substring(IFNULL(MAX(id_btkl),0),7)+0) as hsl FROM detail_btkl";
    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $jml_data = $cacah['hsl'];
    endforeach;
    $id = 'BTKL';
    $nomor = str_pad(($jml_data + 1), 6, "0", STR_PAD_LEFT);
    $id = $id . $nomor;
    return $id;
  }

  public function getIdBOP()
  {
    $sql = "SELECT (substring(IFNULL(MAX(id_bop),0),7)+0) as hsl FROM detail_bop";
    $query = $this->db->query($sql);
    $hasil = $query->result_array();
    foreach ($hasil as $cacah) :
      $jml_data = $cacah['hsl'];
    endforeach;
    $id = 'BOP';
    $nomor = str_pad(($jml_data + 1), 6, "0", STR_PAD_LEFT);
    $id = $id . $nomor;
    return $id;
  }

  public function getDataProduksi()
  {
    $this->db->select('*');
    $this->db->from('pemakaian');
    $this->db->join('bom', 'pemakaian.id_bom = bom.id_bom');
    $this->db->join('produk', 'produk.id_produk = bom.id_produk');
    // $this->db->join('bom', 'bom.id_bom = pemakaian.id_bom');
    // $this->db->where('detail_pemakaian.no_pemakaian', $no_pemakaian);
    $query = $this->db->get();
    return $query->result_array();
  }

}
