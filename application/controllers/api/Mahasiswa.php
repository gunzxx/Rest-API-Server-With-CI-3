<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."libraries/RestController.php";
require_once APPPATH."libraries/Format.php";

use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Mahasiswa_model", "mhs");
        $this->methods['index_get']['limit'] = 1000;
        $this->methods['index_delete']['limit'] = 1000;
        $this->methods['index_put']['limit'] = 1000;
        $this->methods['index_post']['limit'] = 1000;
    }
    public function index_get()
    {
        $mahasiswa = $this->mhs->getAll();

        $id = $this->get('id');
        if(isset($id)){
            $mahasiswa = $this->mhs->getSingle($id);
        }

        if($mahasiswa)
        {
            $this->response([
                'status' => true,
                'data' => $mahasiswa,
                // 'message' => "Success",
            ],RestController::HTTP_OK);
        }
        else{
            $this->response([
                'status' => false,
                'error' => "Not Found"
            ],RestController::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        if($id){
            if ($this->mhs->hapusMahasiswa($id) > 0){
                $this->response([
                    'status' => true,
                    // 'message' => "Delete Success",
                    'id' => $id
                ],RestController::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'id' => $id,
                    'error' => "Not Found",
                ],RestController::HTTP_NOT_FOUND);
            }
        }
        else{
            $this->response([
                'status' => false,
                'error' => "Provid an id!"
            ],RestController::HTTP_BAD_REQUEST);
        }
    }

    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'nim' => $this->post('nim'),
            'email' => $this->post('email'),
            'prodi_id' => $this->post('prodi_id'),
        ];

        if($this->mhs->tambahMahasiswa($data) > 0){
            $this->response([
                'status' => true,
                'data' => $data,
                // 'message' => "Create Success",
            ],RestController::HTTP_CREATED);
        }else{
            $this->response([
                'status' => false,
                'error' => "Failed to Create"
            ],RestController::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama' => $this->put('nama'),
            'nim' => $this->put('nim'),
            'email' => $this->put('email'),
            'prodi_id' => $this->put('prodi_id'),
        ];

        if($this->mhs->editMahasiswa($data,$id) > 0){
            $this->response([
                'status' => true,
                'data' => $data,
                // 'message' => "Edit Success",
            ],RestController::HTTP_CREATED);
        }
        else if($this->mhs->editMahasiswa($data,$id) == 0){
            $this->response([
                'status' => false,
                'data' => $data,
                'error' => "No Data Edited",
            ],RestController::HTTP_BAD_REQUEST);
        }
        else if($this->mhs->editMahasiswa($data,$id) == -1){
            $this->response([
                'status' => false,
                'id' => $id,
                'error' => "Not Found",
            ],RestController::HTTP_NOT_FOUND);
        }
        else{
            $this->response([
                'status' => false,
                'error' => "Failed to Edit"
            ],RestController::HTTP_BAD_REQUEST);
        }
    }
}