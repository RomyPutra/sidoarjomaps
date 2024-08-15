<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use App\Models\Tlokasi_model;

class Mapsobject extends BaseController
{
    protected $helper = [];
    protected $validation;
    protected $main_model;

    public function __construct()
    {
        $this->validation = Services::validation();
        $this->main_model = new Tlokasi_model();
	}
    
    public function index()
    {
        $data['subview'] = 'mapsobject/index';
        $data['jscript'] = 'mapsobject/js';
        return view('main_layout', $data);
    }
 
    public function ajaxmapsobj()
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();

            $records = $this->main_model->getPointMaps();
            $data = [];

            foreach($records as $record){
                $data[] = [
                    'kode'      => $record->kode,
                    'lat'       => $record->latitude,
                    'lng'       => $record->longitude,
                    'name'      => $record->nama,
                    'lokasi'    => $record->alt_name,
                    'kategori'  => $record->kategori,
                    'images'    => $record->images,
                    'gambar'    => $record->gambar,
                    'namacp'    => $record->namacp,
                    'nomorcp'   => $record->nomorcp,
                    'alamat'    => $record->alamat,
                    'profile'   => $record->profile
                ];
            }

            $output['data'] = $data;
            $output[$csrfName] = $csrfHash;
            // Return a valid JSON response
            return $this->response->setJSON($output);
        }
    }

    public function searchobj($obj)
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();

            $records = $obj == '-' ? $this->main_model->getPointMaps() : $this->main_model->getMapsbyobject($obj);
            // log_message('info', 'kecchanges: '.$this->db->getLastQuery());
            $data = [];

            foreach($records as $record){
                $data[] = [
                    'kode'      => $record->kode,
                    'lat'       => $record->latitude,
                    'lng'       => $record->longitude,
                    'name'      => $record->nama,
                    'lokasi'    => $record->alt_name,
                    'kategori'  => $record->kategori,
                    'images'    => $record->images,
                    'gambar'    => $record->gambar,
                    'namacp'    => $record->namacp,
                    'nomorcp'   => $record->nomorcp,
                    'alamat'    => $record->alamat,
                    'profile'   => $record->profile
                ];
            }

            $output = [
                'data' => $data
            ];

            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }

    public function detail($id)
    {
        if ($id)
        {
            $data['tempat'] = $this->main_model->getPointbyid($id);
            $data['dtltempat'] = $this->main_model->getPointDetails($id);

            $data['subview'] = 'mapsobject/detail';
            $data['jscript'] = 'mapsobject/js';
        }
        else
        {
            $data['subview'] = 'mapsobject/index';
            $data['jscript'] = 'mapsobject/js';
        }
        return view('main_layout', $data);
    }

}
