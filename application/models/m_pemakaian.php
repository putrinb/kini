<?php
class m_pemakaian extends CI_Model
{
  public $nilai;
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

  //untuk memberi nilai qty berdasarkan id_bom
  // public function getNilai($kode_bb)
  // {
  //   $sql = "
  //         SELECT harga
  //         FROM detail_penerimaan
  //         WHERE kode_bb = " . $this->db->escape($kode_bb) . "
  //         ";

  //   $query = $this->db->query($sql);
  //   $hasil = $query->result_array();
  //   foreach ($hasil as $cacah) :
  //     $nilai = $cacah['qty'];
  //   endforeach;

  //   return $nilai;
  // }

  //untuk memberi satuan berdasarkan id_bom
  // public function getSatuan($kode_bb)
  // {
  //   $sql = "
  //         SELECT qty, satuan_bb
  //         FROM detail_bom
  //         WHERE kode_bb = " . $this->db->escape($kode_bb) . "
  //         ";

  //   $query = $this->db->query($sql);
  //   $hasil = $query->result_array();
  //   foreach ($hasil as $cacah) :
  //     $satuan = $cacah['satuan_bb'];
  //   endforeach;

  //   return $satuan;
  // }

  public function input_data()
  {
    $post = $this->input->post();
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
      //$this->Dokumen = $this->_uploadDokumen();

      //insert ke tabel pemakaian dulu
      $data = [
        'no_pemakaian' => $this->m_pemakaian->getIdPemakaian(),
        'id_bom'  => $this->input->post('id_bom'),
        'tanggal'       => $this->input->post('tanggal'),
      ];
      $this->db->insert('pemakaian', $data);

      //insert ke tabel detail penerimaan
      // $sql = "declare id_bom varchar";
      // $sql = "set id_bom = ".$this->db->escape($this->input->post('id_bom'));
      // $sql = "while (id_bom = ".$this->db->escape($this->input->post('id_bom'));
      // $sql = "begin "
      // $nilai = $this->getNilai($post['id_bom']);
      // $satuan = $this->getSatuan($post['id_bom']);
      $detail = [
        'no_pemakaian' =>  $this->input->post('no_pemakaian'),
        'id_bom'  =>  $this->input->post('id_bom'),
        'kode_bb'            =>  $this->input->post('nama_bb'),
        // 'jumlah_pemakaian'           =>  $nilai,
        'satuan_bahan'        =>  $this->input->post('qty'),
        // 'harga_bahan'  =>  $this->input->post('harga'),

      ];
      $this->db->insert('detail_pemakaian', $detail);

      // //update stok barang
      // $sql = "UPDATE bahan_baku SET stok_awal = stok_awal + ".$this->db->escape($post["qty"]);
      // $sql = $sql." WHERE kode_bb = ".$this->db->escape($post["nama_bb"]);
      // $query = $this->db->query($sql);

      return $this->db->affected_rows();
    } else {
      //insert ke tabel detail pemakaian
      // $nilai = $this->getNilai($post['id_bom']);
      // $satuan = $this->getSatuan($post['id_bom']);
      $detail = [
        'no_pemakaian' =>  $this->input->post('no_pemakaian'),
        'id_bom'  =>  $this->input->post('id_bom'),
        'kode_bb'            =>  $this->input->post('nama_bb'),
        'jumlah_pemakaian'           =>  $this->input->post('qty')." ".$this->input->post('satuan_bb'),
        'satuan_bahan'        =>  $this->input->post('qty'),
        // 'harga_bahan'  =>  $this->input->post('harga'),

      ];
      $this->db->insert('detail_pemakaian', $detail);

      // //update stok barang
      // $sql = "UPDATE bahan_baku SET stok_awal = stok_awal + ".$this->db->escape($post["qty"]);
      // $sql = $sql." WHERE kode_bb = ".$this->db->escape($post["nama_bb"]);
      // $query = $this->db->query($sql);

      return $this->db->affected_rows();
    }
  }

  public function deleteFormInputDetailPemakaian($id)
    {
      return $this->db->delete('detail_pemakaian', array("id" => $id));
    }

  // public function delete_penerimaan($id_penerimaan,$id_pembelian)
  // {
  //   //delete dokumen dan qrcode
  //   //$this->_deleteDokumenDanQrCode($id_bom,$id_produk);

  //   //hapus data tabel anaknya
  //   $this->db->delete('detail_penerimaan', array("id_penerimaan" => $id_penerimaan, "id_pembelian" => $id_pembelian));
  //   //baru hapus tabel induknya
  //   return $this->db->delete('penerimaan', array("id_penerimaan" => $id_penerimaan, "id_pembelian" => $id_pembelian));

  // }
}
