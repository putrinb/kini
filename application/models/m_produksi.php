<?php
class m_produksi extends CI_Model
{
    public function get_order()
    {
        $sql = "SELECT nota_penjualan.no_nota as no_nota, nama_pegawai, sum(detail_jual.jumlah) as total_jual, DATE(tgl_jual) as waktu
        FROM nota_penjualan 
        JOIN detail_jual ON nota_penjualan.no_nota = detail_jual.no_nota
        JOIN pegawai ON pegawai.id_pegawai = nota_penjualan.id_pegawai
        GROUP BY waktu
        ";
        $query = $this->db->query($sql);

        // $query = $this->db->get();
        return $query->result_array();
    }

    public function get_detail_order($tgl2)
    {
        $sql = "SELECT detail_jual.id_minum as id_minum, nota_penjualan.no_nota as no_nota, tgl_jual as tgl_jual, nama_pegawai, nama_minum, topping.nama as nm_topping, sum(detail_jual.jumlah) as jml_produk FROM detail_jual 
        JOIN nota_penjualan ON nota_penjualan.no_nota = detail_jual.no_nota
        JOIN minuman ON minuman.id_minum = detail_jual.id_minum
        JOIN topping ON topping.id_topping = detail_jual.id_topping
        JOIN pegawai ON nota_penjualan.id_pegawai = pegawai.id_pegawai
        -- JOIN bom ON bom.id_bom = minuman.id_bom
        -- JOIN detail_bom ON detail_bom.id_bom = bom.id_bom
        -- JOIN bahanbaku_utama ON bahanbaku_utama.kode_bb = detail_bom.kode_bb
        WHERE DATE(tgl_jual) = '" . $tgl2 . "'
        GROUP BY detail_jual.id_minum,detail_jual.id_topping";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getIdProduksi()
    {
        $sql = "SELECT (substring(IFNULL(MAX(no_produksi),0),7)+0) as hsl FROM biaya_produksi";
        $query = $this->db->query($sql);
        $hasil = $query->result_array();
        foreach ($hasil as $cacah) :
            $jml_data = $cacah['hsl'];
        endforeach;
        $id = 'ID';
        $nomor = str_pad(($jml_data + 1), 6, "0", STR_PAD_LEFT);
        $id = $id . $nomor;
        return $id;
    }

    public function getListBOM($tgl2)
    {
        $sql = " SELECT * FROM nota_penjualan JOIN detail_jual on nota_penjualan.no_nota = detail_jual.no_nota JOIN topping on topping.id_topping = detail_jual.id_topping JOIN minuman on minuman.id_minum = detail_jual.id_minum JOIN bom on bom.id_bom = minuman.id_bom JOIN detail_bom on detail_bom.id_bom = bom.id_bom JOIN bahanbaku_utama on bahanbaku_utama.kode_bb = detail_bom.kode_bb";
        $sql = $sql . " WHERE DATE(tgl_jual) = '" . $tgl2 . "'";
        $sql = $sql . " GROUP BY detail_bom.no_bom, bom.id_bom";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getHargaTopping($tgl2)
    {
        $sql = "SELECT  topping.nama as nm_topping, sum(detail_jual.jumlah) as jml_tp, topping.harga as harga_tp, topping.penggunaan as jml_pakai FROM detail_jual join nota_penjualan on nota_penjualan.no_nota = detail_jual.no_nota
        JOIN topping on topping.id_topping = detail_jual.id_topping";
        $sql = $sql . " WHERE DATE(tgl_jual) = '" . $tgl2 . "'";
        $sql = $sql . " GROUP BY detail_jual.id_topping";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getHargaBOM($id_minum)
    {
        $sql = " SELECT detail_bom.qty as qty_bom, bahanbaku_utama.jumlah as berat_bb, bahanbaku_utama.harga_bb as harga_bb FROM detail_bom
        JOIN bahanbaku_utama ON bahanbaku_utama.kode_bb = detail_bom.kode_bb";
        $sql = $sql . " WHERE id_minum = '" . $id_minum . "'";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getListHarga($no_nota)
    {
        // $no_nota = $this->input->post('no_nota');
        // $nama_bb = $this->input->post('nama_bb');
        $bahanbaku = $this->getHargaBOM($no_nota);
        $sql = " SELECT * from detail_bom JOIN detail_penerimaan ON detail_penerimaan.kode_bb = detail_bom.kode_bb  join bahanbaku_utama on bahanbaku_utama.kode_bb = detail_bom.kode_bb";
        $sql = $sql . " WHERE detail_bom.kode_bb  = '" . $bahanbaku . "'";
        $query = $this->db->query($sql);
        $hasil = $query->result_array();
        foreach ($hasil as $cacah) :
            $stok_bb = $cacah['stok_awal'];
            $berat_bb = $cacah['jumlah'];
            $harga_beli = $cacah['harga_bhn_baku_pembelian'];
            $qty_bom = $cacah['qty'];
            $satuan_bom = $cacah['satuan_bb'];

            $jumlah = $harga_beli / $berat_bb;
            $dipakai = $jumlah * $qty_bom;
            // $jumlah = $stok_bb * $berat_bb;
            // $ambil = $jumlah - $qty_bom;
            return $dipakai;
        endforeach;
    }

    public function getbtkl()
    {
        $sql = "SELECT * FROM jabatan WHERE id = '3'";
        $query = $this->db->query($sql);
        $nominal = $query->result_array();
        foreach ($nominal as $row) :
            $gaji = $row['gaji_pokok'];
        endforeach;
        $btkl = $gaji * 2;
        return $btkl;
    }

    public function getwatt()
    {
        $sql = " SELECT * FROM daftar_bop 
        WHERE id = " . $this->db->escape($this->input->post('type')) . "
        ";
        $query = $this->db->query($sql);
        $watt = $query->result_array();
        foreach ($watt as $row) :
            $watt2 = $row['daya_watt'];
        endforeach;
        return $watt2;
    }

    public function getOp()
    {
        if (isset($_SESSION['no_produksi'])) {
            $sql = "SELECT * FROM daftar_bop
        WHERE id NOT IN 
        (SELECT kode_bop FROM detail_bop WHERE no_produksi = " . $this->db->escape($_SESSION['no_produksi']) . ")
        ORDER BY penggunaan ASC ";
        } else {
            //query tanpa where
            $sql = "SELECT * FROM daftar_bop 
        ";
        }

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function input_bop()
    {

        //cek dulu apakah sudah ada
        $sql = "SELECT COUNT(*) as jml FROM biaya_produksi WHERE no_produksi = " . $this->db->escape($this->input->post('no_produksi'));
        // $sql = $sql . " AND tgl_transaksi = " . $this->db->escape($this->input->post('tgl'));
        $query = $this->db->query($sql);
        $hasil = $query->result_array();
        foreach ($hasil as $cacah) :
            $jml_data = $cacah['jml'];
        endforeach;
        //jumlah data 0 berarti belum ada datanya, maka dimasukkan ke tabel
        if ($jml_data < 1) {

            $bbb = $this->input->post('nilai_bbb');
            $btkl = $this->getbtkl();
            $total_bp = $bbb + $btkl;
            //insert ke tabel biaya produksi dulu
            $data = [
                'no_produksi' => $this->input->post('no_produksi'),
                'tgl_transaksi' => $this->input->post('tgl'),
                'tgl_catat' => $this->input->post('waktu'),
                'total_bbb' => $this->input->post('nilai_bbb'),
                'total_btkl' => $this->getbtkl(),
                'total' => $total_bp,
            ];
            $this->db->insert('biaya_produksi', $data);

            //insert ke tabel detail bop
            $nama_bb = $this->input->post('nama_bb');
            $watt2 = $this->getwatt();
            $tarif = str_replace(".", "", $this->input->post('tarif'));
            $waktu_menit = str_replace(".", "", $this->input->post('lama'));
            $subtotal = ($watt2 * $waktu_menit) * $tarif / 1000;
            $detail = [
                'no_produksi' =>  $this->input->post('no_produksi'),
                'tarif_dasar'  => $tarif,
                'kode_bop'  => $this->input->post('type'),
                'waktu_menit'  => $waktu_menit,
                'watt'  => $watt2,
                'subtotal' => str_replace(".", "", $subtotal),
            ];
            $this->db->insert('detail_bop', $detail);

            return $this->db->affected_rows();
        } else {
            //insert ke tabel detail bop
            $watt2 = $this->getwatt();
            $tarif = str_replace(".", "", $this->input->post('tarif'));
            $waktu_menit = str_replace(".", "", $this->input->post('lama'));
            $subtotal = ($watt2 * $waktu_menit) * $tarif / 1000;
            $detail = [
                'no_produksi' =>  $this->input->post('no_produksi'),
                'tarif_dasar'  => $tarif,
                'kode_bop'  => $this->input->post('type'),
                'waktu_menit'  => $waktu_menit,
                'watt'  => $watt2,
                'subtotal' => str_replace(".", "", $subtotal),
            ];
            $this->db->insert('detail_bop', $detail);

            return $this->db->affected_rows();
        }
    }

    public function getDataBOP($no_produksi)
    {
        $sql = "SELECT * FROM biaya_produksi JOIN detail_bop ON biaya_produksi.no_produksi = detail_bop.no_produksi
        JOIN daftar_bop ON daftar_bop.id = detail_bop.kode_bop
        WHERE detail_bop.no_produksi = '".$no_produksi."'
        ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function deleteListBOP($id_bop)
    {
        return $this->db->delete('detail_bop', array("id_bop" => $id_bop));
    }

    public function inputnilaiBOP($no_produksi)
    {
        $sql = "SELECT sum(subtotal) as totalbop FROM detail_bop 
        JOIN biaya_produksi 
        ON biaya_produksi.no_produksi = detail_bop.no_produksi
        WHERE detail_bop.no_produksi = '" . $no_produksi . "'";
        $query = $this->db->query($sql);
        $totalbop = $query->result_array();
        foreach ($totalbop as $a) :
            $total2 = $a['totalbop'];
            $sql2 = "UPDATE biaya_produksi SET total_bop = 0 + '" . $total2."', total = total + ".$total2;
            $sql2 = $sql2 . " WHERE no_produksi = " . $this->db->escape($no_produksi);
            $query2 = $this->db->query($sql2);
            
        endforeach;

        return $query2;
    }

    public function getData()
  {
    $sql = "SELECT bom.id_bom as id_bom, bom.id_minum as id_minum, nama_minum, sum(bahanbaku_utama.harga_bb/jumlah*detail_bom.qty) as harga FROM minuman
    JOIN bom on minuman.id_bom = bom.id_bom
    JOIN detail_bom on bom.id_bom = detail_bom.id_bom
    JOIN bahanbaku_utama on detail_bom.kode_bb = bahanbaku_utama.kode_bb
    GROUP BY minuman.id_minum";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

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
}
