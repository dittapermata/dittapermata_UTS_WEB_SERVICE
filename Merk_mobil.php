<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\Rest_Controller;

class Merk_mobil extends REST_Controller {
    function __construct($config = 'rest') {
        parent :: __construct($config);
    }
    //Menampilkan data 
    public function index_get() {
        $id = $this->get('id_merk') ;
        if ($id == '') {
            $data = $this->db->get('tbmerkmobil')->result() ;
        } else {
            $this->db->where('Merkmobil', $id) ;
            $data = $this->db->get('tbmerkmobil')->result() ;
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
            'id_merk'    => $this->post('id_merk'),
            'merk_mobil'   => $this->post('merk_mobil'));
			
        $insert = $this->db->insert('Merk_mobil', $data) ;
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
            'id_merk'    => $this->post('id_merk'),
            'merk_mobil'   => $this->post('merk_mobil'));
			
        $this->db->where('Merk_mobil', $id);
        $update = $this->db->update('Merk_mobil', $data) ;
        if ($update) {
            $this->response($data, 200) ;
        } else {
            $this->response(array('status' => 'fail', 502)) ;
        }   
    }
    //Menghapus data Merk_mobil
    public function index_delete () {
        $id = $this->delete('id_merk') ;
        $this->db->where('Merk_mobil', $id) ;
        $delete = $this->db->delete('Merk_mobil') ;
        if ($delete)  {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502)) ;
         }   
    }
}