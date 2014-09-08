<?php

class beritamodels extends Models{
    private $table = 'berita';
    
    public function getallberita(){

         $query   = "SELECT * From {$this->table}";
         $sql     = $this->db->prepare($query);
         $sql->execute();
         return $sql->fetchAll();
       
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
    
    public function deleteberita($id){
        $sql     = "DELETE FROM {$this->table} ";
        $sql    .= " WHERE id_berita = {$id}";
        $query   = $this->db->prepare($sql);
        $query->execute(array(":id_berita" => $id));
    }
    
    public function searchberita($id){
        $sql    = "SELECT * from {$this->table} WHERE id_berita= {$id}";
        $query  = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();  
    }
    
	
}