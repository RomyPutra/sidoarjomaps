<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use App\Models\Tlokasi_model;
use App\Models\Tvillages_model;
use App\Models\Tdistricts_model;
use App\Models\Tkategori_model;

class Mapskatkec extends BaseController
{
    protected $helper = [];
    protected $validation;
    protected $main_model;
    protected $villages_model;
    protected $districts_model;
    protected $kategori_model;

    public function __construct()
    {
        $this->validation = Services::validation();
        $this->main_model = new Tlokasi_model();
        $this->villages_model = new Tvillages_model();
        $this->districts_model = new Tdistricts_model();
        $this->kategori_model = new Tkategori_model();
	}
    
    public function index()
    {
        $data['kategori'] = $this->kategori_model->getJoin();
        $data['villages'] = $this->districts_model->getData();

        $data['subview'] = 'mapskatkec/index';
        $data['jscript'] = 'mapskatkec/js';
        return view('main_layout', $data);
    }
 
    public function ajaxkatkec()
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

    public function dropchanges($idkat, $idkec)
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();

            $records = $idkat == 0 && $idkec == 0 ? $this->main_model->getPointMaps() : 
            ($idkat == 0 && $idkec != 0 ? $this->main_model->getMapsbyvillages($idkec) : 
            ($idkat != 0 && $idkec == 0 ? $this->main_model->getMapsbykategori($idkat) : $this->main_model->getMapsbykatkec($idkat,$idkec)));
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
            $output['deslat'] = $idkec == 0 || count($records) < 1 ? '-7.4547306' : $records[0]->deslat;
            $output['deslng'] = $idkec == 0 || count($records) < 1 ? '112.6059371' : $records[0]->deslng;
            $output['totall'] = $idkec == 0 || count($records) < 1 ? '-' : (empty($records[0]->totall) ? '-' : $records[0]->totall);
            $output['totalp'] = $idkec == 0 || count($records) < 1 ? '-' : (empty($records[0]->totalp) ? '-' : $records[0]->totalp);
            $output['totala'] = $idkec == 0 || count($records) < 1 ? '-' : (empty($records[0]->totala) ? '-' : $records[0]->totala);
            $output['luaswil'] = $idkec == 0 || count($records) < 1 ? '-' : (empty($records[0]->luaswil) ? '-' : $records[0]->luaswil);
            $output['btsutara'] = $idkec == 0 || count($records) < 1 ? '-' : (empty($records[0]->btsutara) ? '-' : $records[0]->btsutara);
            $output['btsbarat'] = $idkec == 0 || count($records) < 1 ? '-' : (empty($records[0]->btsbarat) ? '-' : $records[0]->btsbarat);
            $output['btsselatan'] = $idkec == 0 || count($records) < 1 ? '-' : (empty($records[0]->btsselatan) ? '-' : $records[0]->btsselatan);
            $output['btstimur'] = $idkec == 0 || count($records) < 1 ? '-' : (empty($records[0]->btstimur) ? '-' : $records[0]->btstimur);
            $output['thndata'] = $idkec == 0 || count($records) < 1 ? '-' : (empty($records[0]->thndata) ? '-' : $records[0]->thndata);
            $output['kecamatan'] = $idkec == 0 || count($records) < 1 ? '-' : (empty($records[0]->name) ? '-' : $records[0]->name);
            $output['counter'] = $this->main_model->getMapskatvillages($idkec);
            // log_message('info', 'kecchangescounter: '.$this->db->getLastQuery());
            // log_message('info', 'kecchangescounter: '.print_r($counter, TRUE));

            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }

}
