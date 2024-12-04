<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use setasign\Fpdi\Fpdi;
use App\Models\Tdistricts_model;
use App\Models\Tlokasi_model;
use App\Models\Tregencies_model;
use App\Models\Tregenciesdtl_model;
use App\Models\Tregenciesjobs_model;

class Home extends BaseController
{
    protected $helper = [];
    protected $validation;
    protected $main_model;
    protected $districts_model;
    protected $regencies_model;
    protected $regenciesdtl_model;
    protected $regenciesjobs_model;

    public function __construct()
    {
        $this->validation = Services::validation();
        $this->main_model = new Tlokasi_model();
        $this->districts_model = new Tdistricts_model();
        $this->regencies_model = new Tregencies_model();
        $this->regenciesdtl_model = new Tregenciesdtl_model();
        $this->regenciesjobs_model = new Tregenciesjobs_model();
	}
    
    public function index()
    {
        $data['kabupaten'] = $this->regencies_model->getData('3515');
        $data['kabupatendtl'] = $this->regenciesdtl_model->getData('3515','regency_id');
        $data['kabupatenjob'] = $this->regenciesjobs_model->getData('3515','regency_id');

        $data['subview'] = 'home/index';
        $data['jscript'] = 'home/js';
        return view('main_layout', $data);
    }

    public function ajaxmaps()
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
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

            // Return a valid JSON response
            return $this->response->setJSON($data);
            // $output = [
            //     'data' => $data
            // ];
            // log_message('info', 'ajax: '.print_r($output, TRUE));

            // echo json_encode($output);
        }
    }

    public function detail($id)
    {
        if ($id)
        {
            $lokasi = $this->main_model->getPointbyid($id);
            $data['tempat'] = $lokasi;
            $data['dtltempat'] = $this->main_model->getPointDetails($id);

            log_message('info', 'detail: '.print_r($lokasi, TRUE));
            if ($lokasi[0]->template == 4) {
                $data['subview'] = 'home/detailmcenter';
            } 
            else if ($lokasi[0]->template == 3) 
            {
                $data['subview'] = 'home/detailtcenter';
            } 
            else if ($lokasi[0]->template == 2) 
            {
                $data['subview'] = 'home/detailright';
            } 
            else 
            {
                $data['subview'] = 'home/detailleft';
            }
            $data['jscript'] = 'home/js';
        }
        else
        {
            $data['subview'] = 'home/index';
            $data['jscript'] = 'home/js';
        }
        return view('main_layout', $data);
    }

}
