<?php

class m_laporan extends CI_Model
{
    //data tahun
    public function getTahun(){
        $sql = "
                    SELECT year(tanggal) as tahun 
                    FROM penerimaan
                    ORDER BY 1 ASC			
                ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    //data kartu stok
	public function getKartustok($kode_bb,$waktu){
		$sql = "
						SELECT waktu,ifnull(total_penerimaan,0) as total_penerimaan,
						             ifnull(total_penjualan,0) as total_penjualan
						FROM 
						(
							SELECT distinct(date_format(b.tanggal,'%d-%m-%Y')) as waktu 
							FROM detail_penerimaan a
							JOIN penerimaan b ON (a.id_penerimaan = b.id_penerimaan AND a.id_pembelian = b.id_pembelian)
							WHERE a.kode_bb = ".$this->db->escape($kode_bb)." 
									AND date_format(b.tanggal,'%Y-%m') = ".$this->db->escape($waktu)."
							UNION 
							SELECT distinct(date_format(b.waktu,'%d-%m-%Y')) as waktu 
							FROM detail_penjualan a
							JOIN penjualan b ON (a.id_penjualan = b.id_penjualan)
							WHERE a.kode_bb = ".$this->db->escape($kode_bb)." 
							AND date_format(b.waktu,'%Y-%m') = ".$this->db->escape($waktu)."
						) x
						LEFT OUTER JOIN 
							(SELECT DATE_FORMAT(b.tanggal,'%d-%m-%Y') as wkt,
									SUM(a.jumlah_penerimaan) as total_penerimaan
							 FROM detail_penerimaan a
							 JOIN penerimaan b ON (a.no_faktur = b.no_faktur AND a.id_supplier = b.id_supplier)
							 WHERE a.kode_bb = ".$this->db->escape($kode_bb)."
							 AND date_format(b.tanggal,'%Y-%m') = ".$this->db->escape($waktu)."
							 GROUP BY DATE_FORMAT(b.tanggal,'%d-%m-%Y')
							 ) y
						ON (x.waktu = y.wkt)
						LEFT OUTER JOIN 
							(SELECT DATE_FORMAT(b.waktu,'%d-%m-%Y') as wkt,
									SUM(a.jml_buah) as total_penjualan
							 FROM detail_penjualan a
							 JOIN penjualan b ON (a.id_penjualan = b.id_penjualan)
							 WHERE a.kode_bb = ".$this->db->escape($kode_bb)."
							 AND date_format(b.waktu,'%Y-%m') = ".$this->db->escape($waktu)."
							 GROUP BY DATE_FORMAT(b.waktu,'%d-%m-%Y')
							) z
						ON (x.waktu = z.wkt )
						order by 1 asc

					";
			//echo $sql."<br>";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		//mendapatkan stok persediaan pada akhir periode
		public function getJumlahpersediaan($kode_bb,$waktu){
			
			//cari jumlah pembelian s/d bulan - 1 sebelumnya
			$sql = "SELECT * 
					FROM detail_penerimaan a
					JOIN penerimaan b ON (a.id_penerimaan = b.id_penerimaan AND a.id_pembelian = b.id_pembelian)
					WHERE a.kode_bb = ".$this->db->escape($kode_bb)."
					AND DATE_FORMAT(b.tanggal,'%Y-%m') < ".$this->db->escape($waktu)."
					";
			
			$query = $this->db->query($sql);
			$hasil = $query->result_array();
			$jml_penerimaan = 0;
			foreach($hasil as $cacah):
				$jml_penerimaan = $jml_penerimaan + $cacah['qty'];
			endforeach;
			
			// // cari jumlah penjualan s/d bulan -1 sebelumnya
			// $sql = "SELECT * 
			// 		FROM detail_penjualan a
			// 		JOIN penjualan b ON (a.id_penjualan = b.id_penjualan)
			// 		WHERE a.kode_bb = ".$this->db->escape($id_buah)."
			// 		AND DATE_FORMAT(b.waktu,'%Y-%m') < ".$this->db->escape($waktu)."
			// 		";
			
			// $query = $this->db->query($sql);
			// $hasil = $query->result_array();
			$jml_penjualan = 0;
			// foreach($hasil as $cacah):
			// 	$jml_penjualan = $jml_penjualan + $cacah['jml_buah'];
			// endforeach;
			
			//hitung selisih pembelian dengan penjualan
			$selisih = $jml_penerimaan - $jml_penjualan;
			return $selisih;
			
		}
}
?>