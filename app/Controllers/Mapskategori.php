<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use App\Models\Tlokasi_model;
use App\Models\Tkategori_model;

class Mapskategori extends BaseController
{
    protected $helper = [];
    protected $validation;
    protected $main_model;
    protected $kategori_model;

    public function __construct()
    {
        $this->validation = Services::validation();
        $this->main_model = new Tlokasi_model();
        $this->kategori_model = new Tkategori_model();
	}
    
    public function index()
    {
        $data['kategori'] = $this->kategori_model->getJoin();

        $data['subview'] = 'mapskategori/index';
        $data['jscript'] = 'mapskategori/js';
        return view('main_layout', $data);
    }
 
    public function ajaxmapskat()
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

    public function katchanges($id)
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();

            $records = $id == 0 ? $this->main_model->getPointMaps() : $this->main_model->getMapsbykategori($id);
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

}
