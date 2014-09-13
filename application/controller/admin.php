<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *//**
 * Description of admin
 *
 * @author leomasta
 */

//require 'application/templates/admin/view.php';
//require 'application/libs/session.php';

class admin extends Controller {

    //put your code here
    private $modelreservasi = 'reservasimodels';
    private $modelberita = 'beritamodels';

    public function __construct() {
        parent::__construct();
        Auth::handloginAdmin();
    }

    /*
     * 
     */

    public function index() {

        require 'application/templates/admin/header.html';
        require 'application/templates/admin/content.html';
        require 'application/templates/admin/footer.html';
    }

    public function all() {
        require 'application/templates/admin/header.html';
        require 'application/templates/admin/contentsfull.html';
    }

    public function table() {
        require 'application/templates/admin/tables.html';
    }

    public function reservasi() {
        require 'application/templates/admin/header.html';
        require 'application/views/admin/reservasi/index.html';
        require 'application/templates/admin/footer.html';
    }

    public function insertreservasi() {

        $form = $_POST;
        $tanggal = date('Y-m-d');
        $tujuan = $form['tujuan'];
        $paket = $form['paket'];
        $harga = $form['harga'];
        $images = $_FILES['file_gambar']['name'];
        $random = rand(0000, 9999); //function random 
        $newfile = $random . $images;  // implement change name
        $path = getcwd(); //path on  root directory web
        $dir = $path . '/public/images/';

        if (!empty($form)) {
            if (!file_exists($dir)) {
                mkdir($dir, 0777);
            }

            $extfile = strtolower(substr($_FILES["file_gambar"]["name"], -3));
            $error = array();


            if (!validname($tujuan)) {
                $error[] = 'Format Tujuan Salah, Tidak dizinkan format Alphanumeric,Hanya [A-Z,a-z]';
            }

            if (empty($paket)) {
                $error[] = 'Paket Tidak Boleh Kosong';
            }
            if (empty($harga)) {
                $error[] = 'Harga Tidak Boleh Kosong';
            }


            if (($extfile != "jpg") || ($extfile != "png")) {
                $error[] = 'Format Gambar Salah, Hanya ekstensi *.jpg yang diizinkan';
            }

            if (count($error) > 0) {
                $msg = $error;
                require 'application/templates/admin/header.html';
                require 'application/views/admin/reservasi/index.html';
                require 'application/templates/admin/footer.html';
            } else {
                $move_gambar = $dir . basename($newfile);
                move_uploaded_file($_FILES['file_gambar']['tmp_name'], $move_gambar);

                //simpan ke database
                $model = $this->loadModel($this->modelreservasi);
                $simpan = $model->insertreservasi($tanggal, $tujuan, $harga, $paket, basename($newfile));
                $this->redirect('admin/datareservasi');
            }
        }
    }

    //ambil data ketika edit reservasi
    public function editreservasi($idreservasi) {
        if (isset($idreservasi)) {
            $model = $this->loadModel($this->modelreservasi);
            $getall = $model->searchreservasi($idreservasi);
            require 'application/templates/admin/header.html';
            require view . 'admin/reservasi/editreservasi.html';
        }
    }

    //menyimpan edit reservasi
    public function saveeditreservasi() {
        $form = $_POST;
        $id = $form['id'];
        $tanggal = date('Y-m-d');
        $tujuan = $form['tujuan'];
        $paket = $form['paket'];
        $harga = $form['harga'];
        $images = $_FILES['file_gambar']['name'];
        $random = rand(0000, 9999); //function random 
        $newfile = $random . $images;  // implement change name
        $path = getcwd(); //path on  root directory web
        $dir = $path . '/public/images/';

        if (!empty($form)) {
            //validasi

            $extfile = strtolower(substr($_FILES["file_gambar"]["name"], -3));
            $error = array();
            if (!validname($tujuan)) {
                $error[] = 'Format Tujuan Salah, Tidak dizinkan format Alphanumeric,Hanya [A-Z,a-z]';
            }

            if (empty($paket)) {
                $error[] = 'Paket Tidak Boleh Kosong';
            }
            if (empty($harga)) {
                $error[] = 'Harga Tidak Boleh Kosong';
            }

            if (!empty($images)) {
                if (($extfile != "jpg")) {
                    $error[] = 'Format Gambar Salahs, Hanya ekstensi *.jpg yang diizinkan';
                }
            }
            //mengihitung keadaan error
            if (count($error) > 0) {
                $msg = $error;
                $model = $this->loadModel($this->modelreservasi);
                $gambar = $model->searchreservasi($id);
                require 'application/templates/admin/header.html';
                require 'application/views/admin/reservasi/editreservasi.html';
                require 'application/templates/admin/footer.html';
            }
            //jika tidak ada error.
            else {
                $modelreservasi = $this->loadModel($this->modelreservasi);
                $gambar = $modelreservasi->searchreservasi($id);

                //cek gambar kosong atau tidak
                if (!empty($images)) {
                    if (file_exists($dir . $gambar->image)) {
                        unlink($dir . $gambar->image);
                    }
                    $move_gambar = $dir . basename($newfile);
                    move_uploaded_file($_FILES['file_gambar']['tmp_name'], $move_gambar);
                    $simpan = $modelreservasi->updatereservasiall($tanggal, $tujuan, $paket, $harga, $newfile, $id);
                    $this->redirect('admin/datareservasi');
                } else {

                    $simpan = $modelreservasi->updatereservasi($tanggal, $tujuan, $paket, $harga, $id);
                    $this->redirect('admin/datareservasi');
                }
            }
        }
    }

    //get all reservasi
    public function datareservasi() {
        $modelreservasi = $this->loadModel($this->modelreservasi);
        $getall = $modelreservasi->getall();
        require 'application/templates/admin/header.html';
        require 'application/views/admin/reservasi/datareservasi.html';
        require 'application/templates/admin/footer.html';
    }

    //delete reservasi
    public function deletereservasi($id_reservasi) {
        if (isset($id_reservasi)) {
            $modelreservasi = $this->loadModel($this->modelreservasi);
            $hapus = $modelreservasi->deletereservasi($id_reservasi);
            $this->redirect('admin/datareservasi');
        }
    }

    public function berita() {
        require 'application/templates/admin/header.html';
        require 'application/views/admin/berita/index.html';
        require 'application/templates/admin/footer.html';
    }

    public function beritaall() {
        $modelberita = $this->loadModel($this->modelberita);
        $getberita = $modelberita->getallberita();
        require 'application/templates/admin/header.html';
        require 'application/views/admin/berita/databerita.html';
        require 'application/templates/admin/footer.html';
    }

    public function insertberita() {
        $form = $_POST;
        $tanggal = date('Y-m-d H:i:s');
        $judul = $form['judul'];
        $isi = $form['isiberita'];
        $images = $_FILES['file_gambar']['name'];
        $random = rand(0000, 9999); //function random 
        $newfile = $random . $images;  // implement change name
        $path = getcwd(); //path on  root directory web
        $dir = $path . '/public/images/';
        $lengtjudul = strlen($judul);
        $lengtisi = strlen($isi);


        $error = array();
        $extfile = strtolower(substr($_FILES["file_gambar"]["name"], -3));
        if (!empty($form)) {
            //validasi degan gambar
            if (!empty($images)) {
                if (!empty($judul) && ($lengtjudul < 10)) {
                    $error[] = 'Judul Minimal 10 Karakter';
                }
                if (!empty($isi) && ($lengtisi < 50)) {
                    $error[] = 'Isin Berita Miniman 50 Karakter !';
                }
                if ($extfile != 'jpg') {
                    $error[] = 'Gambar Hanya Ektensi *.JPG yang diizinkan !';
                }

                //hitung jumlah keaadan error
                if (count($error) > 0) {
                    $msg = $error;
                    require 'application/templates/admin/header.html';
                    require 'application/views/admin/berita/index.html';
                    require 'application/templates/admin/footer.html';
                } else {
                    $move_gambar = $dir . basename($newfile);
                    move_uploaded_file($_FILES['file_gambar']['tmp_name'], $move_gambar);
                    
                    $modelberita = $this->loadModel($this->modelberita);
                    $simpanberita = $modelberita->insertberitaall($tanggal, $judul, $isi, $newfile);
                    $this->redirect('admin/berita');
                }
            }
            //validasi tampa gambar
            else {
                if (!empty($judul) && ($lengtjudul < 10)) {
                    $error[] = 'Judul Minimal 10 Karakter';
                }
                if (!empty($isi) && ($lengtisi < 50)) {
                    $error[] = 'Isi Berita Miniman 50 Karakter !';
                }

                //hitung jumlah error;              
                if (count($error) > 0) {
                    $msg = $error;
                    require 'application/templates/admin/header.html';
                    require 'application/views/admin/berita/index.html';
                    require 'application/templates/admin/footer.html';
                } else {
                    $modelberita = $this->loadModel($this->modelberita);
                    $simpanberita = $modelberita->insertberitaall($tanggal, $judul, $isi, 'null');
                    $this->redirect('admin/berita');
                }
            }
        }
    }

    public function deleteberita($id_berita) {
        if (isset($id_berita)) {
            $modelberita = $this->loadModel($this->modelberita);
            $hapus = $modelberita->deleteberita($id_berita);
            $this->redirect('admin/beritaall');
        }
    }

    public function beritaedit($id_berita) {
        if (isset($id_berita)) {
            $modelberita = $this->loadModel($this->modelberita);
            $getall = $modelberita->searchberita($id_berita);
            require 'application/templates/admin/header.html';
            require 'application/views/admin/berita/editberita.html';
            require 'application/templates/admin/footer.html';
//            require view.'admin/berita/editreservasi.lhtml';     
        }
    }
    
    public function updateberitaall(){
        
    }
    public function updateberita(){
        
    }

}
