<?php

class beritamodels extends Models{
    private $table = 'berita';
    
    public function getallberita(){
        $data = $this->select('*', $this->table);
        return $data; 
    }
    public function insertberitaall($tgl, $judul,$isi,$gambar){
        $iduser = '1';
        $data = array(':id_user'        => $iduser,
                      ':tgl'            => $tgl,
                      ':judul'          => $judul,
                      ':isi'            => $isi,
                      ':image'          => $gambar
                      );

        $sql  = "INSERT INTO {$this->table}";
        $sql .= " (id_user , tgl_berita, judul_berita, isi_berita, gambar)";
        $sql .= " VALUES ( :id_user, :tgl, :judul, :isi, :image )";
        $query = $this->db->prepare($sql);
      
        $query->execute($data);      
        
    }
	
}