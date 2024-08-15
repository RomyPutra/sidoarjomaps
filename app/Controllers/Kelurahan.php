<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use App\Models\Tvillages_model;
use App\Models\Tdistricts_model;
use App\Models\Tregencies_model;
use App\Models\Tprovinces_model;

class Kelurahan extends BaseController
{
    protected $validation;
    protected $main_model;
    protected $districts_model;
    protected $regencies_model;
    protected $provinces_model;

    public function __construct()
    {
        $this->validation =  Services::validation();
        $this->main_model = new Tvillages_model();
        $this->districts_model = new Tdistricts_model();
        $this->regencies_model = new Tregencies_model();
        $this->provinces_model = new Tprovinces_model();
    }
    
    public function index()
    {
        $data['subview'] = 'kelurahan/index';
        $data['jscript'] = 'kelurahan/js';
        return view('main_layout', $data);
    }

    public function ajaxkelurahan()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $records = $this->main_model->getDatatables($request);
            $data = [];
            $no = $request->getPost('start');
            // log_message('info', 'ajax: '.$this->db->getLastQuery());
            // log_message('info', 'ajax: '.print_r($records, TRUE));

            foreach($records as $record){
                $no++;
                $data[] = array( 
                    $no,
                    $record->province,
                    $record->regency,
                    $record->district,
                    $record->name,
                    // '<a href="'.base_url('kelurahan/input/'.$record->id).'" id="edit" class="btn custom-button btn-sm" title="Edit"><i class="fa fa-pen"></i></a>',
                ); 
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->main_model->countAll(),
                'recordsFiltered' => $this->main_model->countFiltered($request),
                'data' => $data
            ];

            $output[$csrfName] = $csrfHash; 
            echo json_encode($output);
        }
    }

    public function input($id = NULL)
    {
        $data['validation'] = $this->validation;

        if ($id)
        {
            $datakelurahan = $this->main_model->getData($id);
            $data['kelurahan'] = array(
                'id'            => $datakelurahan[0]->id,
                'district_id'   => $datakelurahan[0]->district_id,
                'regency_id'    => $datakelurahan[0]->regency_id,
                'province_id'   => $datakelurahan[0]->province_id,
                'name'          => $datakelurahan[0]->name,
                'latitude'      => $datakelurahan[0]->latitude,
                'longitude'     => $datakelurahan[0]->longitude,
            );
        }
        else
        {
            $data['kelurahan'] = NULL;
        }

        $data['kota'] = NULL;
        $data['kabupaten'] = NULL;
        $data['provinces'] = $this->provinces_model->getData();

        $data['subview'] = 'kelurahan/input';
        $data['jscript'] = 'kelurahan/js';
        return view('main_layout', $data);
    }

    public function store()
    {
        $validation = $this->validate([
            'name' => [
                'rules' => 'max_length[25]',
                'errors' => [
                    'max_length' => 'Kelurahan maksimal 25 karakter.',
                ],
            ],
        ]);

        $mode = 'menambahkan';

        if (!$validation)
        {
            $data['kelurahan'] = $this->request->getPost();

            $data['kota'] = NULL;
            $data['kabupaten'] = NULL;
            $data['provinsi'] = $this->provinces_model->getData();

            $data['subview'] = 'kelurahan/input';
            $data['jscript'] = 'kelurahan/js';
            return view('main_layout', $data);
        }

        $this->db->transStart(); //Begin Transaction

        log_message('info', 'store: '.print_r(trim($this->request->getPost('id')), TRUE));
        if (trim($this->request->getPost('id')) === "")
        {
            $idkelurahan = $this->main_model->increment();
            $datakelurahan = array(
                'id'            => $idkelurahan,
                'district_id'   => $this->request->getPost('district_id'),
                'name'          => $this->request->getPost('name'),
                'latitude'      => $this->request->getPost('latitude'),
                'longitude'     => $this->request->getPost('longitude'),
            );
            $this->main_model->insertData($datakelurahan);
        }
        else
        {
            $mode = 'mengubah';
            $datakelurahan = array(
                'district_id'   => $this->request->getPost('district_id'),
                'name'          => $this->request->getPost('name'),
                'latitude'      => $this->request->getPost('latitude'),
                'longitude'     => $this->request->getPost('longitude'),
            );
            $this->main_model->updateData($datakelurahan, $this->request->getPost('id'));
        }

        $this->db->transComplete(); //End Transaction

        if($this->db->transStatus() === TRUE)
        {
            return redirect()->to(base_url('kelurahan'))->with('success', 'Berhasil '.$mode.' kelurahan.');
        }
        else 
        {
            return redirect()->to(base_url('kelurahan'))->with('error', 'Gagal '.$mode.' kelurahan.');
        }
    }

    public function getregency($id)
    {
        $output = [
            'kabupaten' => $this->regencies_model->getData($id, 'province_id')
        ];
        echo json_encode($output);
    }

    public function getdistrict($id)
    {
        $output = [
            'kota' => $this->districts_model->getData($id, 'regency_id')
        ];
        echo json_encode($output);
    }

}