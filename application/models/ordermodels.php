<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ordermodels extends Models{
    private $_table = 'transaksi';
    
    public function saveorder($id_reservasi, $id_user, $jml,$harga,$tgl){
        $tanggal = date('Y-m-d');
        $bayar   = $jml * $harga;
        
        $data = array(':id_reservasi'   => $id_reservasi,
                      ':id_user'        =>$id_user,
                      ':jml_reservasi'  => $jml,
                      ':total_harga'    => number_format($bayar),
                      ':tgl_pemesanan'  => $paket,
                      ':status'         => $gambar,
                      );

        $sql  = "INSERT INTO {$this->table}";
        $sql .= " (tgl_reservasi , tujuan,durasi, harga, include_paket, image)";
        $sql .= " VALUES ( :tgl, :tujuan, :durasi, :harga, :include_paket, :image )";
        $query = $this->db->prepare($sql);
      
        $query->execute($data);      
       
    }
}