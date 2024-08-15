<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use App\Models\Tlokasi_model;
use App\Models\Tvillages_model;
use App\Models\Tdistricts_model;

class Mapsvillages extends BaseController
{
    protected $helper = [];
    protected $validation;
    protected $main_model;
    protected $villages_model;
    protected $districts_model;

    public function __construct()
    {
        $this->validation = Services::validation();
        $this->main_model = new Tlokasi_model();
        $this->villages_model = new Tvillages_model();
        $this->districts_model = new Tdistricts_model();
	}
    
    public function index()
    {
        $data['villages'] = $this->districts_model->getData();
        // $data['villages'] = $this->villages_model->getData();

        $data['subview'] = 'mapskecamatan/index';
        $data['jscript'] = 'mapskecamatan/js';
        return view('main_layout', $data);
    }
 
    public function ajaxmapskec()
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

    public function kecchanges($id)
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();

            $records = $id == 0 ? $this->main_model->getPointMaps() : $this->main_model->getMapsbyvillages($id);
            // log_message('info', 'kecchanges: '.$this->db->getLastQuery());
            // log_message('info', 'kecchanges: '.print_r($records, TRUE));
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
            $output['deslat'] = $id == 0 || count($records) < 1 ? '-3.5058155' : $records[0]->deslat;
            $output['deslng'] = $id == 0 || count($records) < 1 ? '122.6757871' : $records[0]->deslng;
            $output['totall'] = $id == 0 || count($records) < 1 ? '-' : (empty($records[0]->totall) ? '-' : $records[0]->totall);
            $output['totalp'] = $id == 0 || count($records) < 1 ? '-' : (empty($records[0]->totalp) ? '-' : $records[0]->totalp);
            $output['totala'] = $id == 0 || count($records) < 1 ? '-' : (empty($records[0]->totala) ? '-' : $records[0]->totala);
            $output['luaswil'] = $id == 0 || count($records) < 1 ? '-' : (empty($records[0]->luaswil) ? '-' : $records[0]->luaswil);
            $output['btsutara'] = $id == 0 || count($records) < 1 ? '-' : (empty($records[0]->btsutara) ? '-' : $records[0]->btsutara);
            $output['btsbarat'] = $id == 0 || count($records) < 1 ? '-' : (empty($records[0]->btsbarat) ? '-' : $records[0]->btsbarat);
            $output['btsselatan'] = $id == 0 || count($records) < 1 ? '-' : (empty($records[0]->btsselatan) ? '-' : $records[0]->btsselatan);
            $output['btstimur'] = $id == 0 || count($records) < 1 ? '-' : (empty($records[0]->btstimur) ? '-' : $records[0]->btstimur);
            $output['thndata'] = $id == 0 || count($records) < 1 ? '-' : (empty($records[0]->thndata) ? '-' : $records[0]->thndata);
            $output['kecamatan'] = $id == 0 || count($records) < 1 ? '-' : (empty($records[0]->name) ? '-' : $records[0]->name);
            $output['counter'] = $this->main_model->getMapskatvillages($id);
            // log_message('info', 'kecchangescounter: '.$this->db->getLastQuery());
            // log_message('info', 'kecchangescounter: '.print_r($counter, TRUE));

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

            $data['subview'] = 'mapskecamatan/detail';
            $data['jscript'] = 'mapskecamatan/js';
        }
        else
        {
            $data['subview'] = 'mapskecamatan/index';
            $data['jscript'] = 'mapskecamatan/js';
        }
        return view('main_layout', $data);
    }

}
