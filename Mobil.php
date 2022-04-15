<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\Rest_Controller;

class Mobil extends REST_Controller {
    function __construct($config = 'rest') {
        parent :: __construct($config);
    }
    //Menampilkan data 
    public function index_get() {
        $id = $this->get('id') ;
        if ($id == '') {
            $data = $this->db->get('tbmobil')->result() ;
        } else {
            $this->db->where('Mobil', $id) ;
            $data = $this->db->get('tbmobil')->result() ;
        }
        $result =   ["took"=>$_SERVER ["REQUEST_TIME_FLOAT"],
                    "code"=>200,
                    "message"=>"Response succesfully",
                    "data"=>$data] ;
        $this->response($result, 200) ;
    }
    //Menambah data
    public function index_post() {
        $data = array (
            'id'    => $this->post('id'),
            'nama_mobil'  => $this->post('nama_mobil'),
            'harga_mobil' => $this->post('harga_mobil'),
            'warna_mobil' => $this->post('warna_mobil'), 
            'stok'        => $this->post('stok'));
            
        $insert = $this->db->insert('Mobil', $data) ;
        if ($insert) {
            //$this->response($data, 200);
            $result = ["took"=>$_SERVER ["REQUEST_TIME_FLOAT"],
                        "code"=>201,
                        "message"=>"Data has succesfully added",
                        "data"=>$data] ;
        $this->response ($result, 201) ;
        } else {
            $result = ["took"=>$_SERVER ["REQUEST_TIME_FLOAT"],
                      "code"=>502,
                      "message"=>"Failed adding data",
                      "data"=>null] ;
        $this->response($result, 502) ; 
        }
    }
    //Memperbarui data yang telah ada
    public function index_put() {
        $data = array (
            'id'    => $this->post('id'),
            'nama_mobil'  => $this->post('nama_mobil'),
            'harga_mobil' => $this->post('harga_mobil'),
            'warna_mobil' => $this->post('warna_mobil'), 
            'stok'        => $this->post('stok'));
            
        $this->db->where('Mobil', $id);
        $update = $this->db->update('Mobil', $data) ;
        if ($update) {
            $this->response($data, 200) ;
        } else {
            $this->response(array('status' => 'fail', 502)) ;
        }   
    }
    //Menghapus data Mobil
    public function index_delete () {
        $id = $this->delete('id') ;
        $this->db->where('Mobil', $id) ;
        $delete = $this->db->delete('Mobil') ;
        if ($delete)  {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502)) ;
         }   
    }
}