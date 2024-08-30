<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use App\Models\Tvillages_model;
use App\Models\Tdistricts_model;
use App\Models\Tregencies_model;
use App\Models\Tprovinces_model;

class Kecamatan extends BaseController
{
    protected $validation;
    protected $main_model;
    protected $districts_model;
    protected $regencies_model;
    protected $provinces_model;

    public function __construct()
    {
        $this->validation =  Services::validation();
        $this->main_model = new Tdistricts_model();
        $this->regencies_model = new Tregencies_model();
        $this->provinces_model = new Tprovinces_model();
    }
    
    public function index()
    {
        $data['subview'] = 'kecamatan/index';
        $data['jscript'] = 'kecamatan/js';
        return view('main_layout', $data);
    }

    public function ajaxkecamatan()
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
                    $record->name,
                    $record->totala,
                    $record->totall,
                    $record->totalp,
                    $record->luaswil,
                    $record->thndata,
                    '<a href="'.base_url('kecamatan/input/'.$record->id).'" id="edit" class="btn custom-button btn-sm" title="Edit"><i class="fa fa-pen"></i></a>',
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
        $data['provinces'] = $this->provinces_model->getData();
        $data['kabupaten'] = NULL;

        if ($id)
        {
            $datakecamatan = $this->main_model->getDatabyid($id);
            // log_message('info', 'input: '.$this->db->getLastQuery());
            $data['kecamatan'] = array(
                'id'            => $datakecamatan[0]->id,
                'regency_id'    => $datakecamatan[0]->regency_id,
                'province_id'   => $datakecamatan[0]->province_id,
                'name'          => $datakecamatan[0]->name,
                'latitude'      => $datakecamatan[0]->latitude,
                'longitude'     => $datakecamatan[0]->longitude,
                'totala'        => $datakecamatan[0]->totala,
                'totall'        => $datakecamatan[0]->totall,
                'totalp'        => $datakecamatan[0]->totalp,
                'luaswil'       => $datakecamatan[0]->luaswil,
                'thndata'       => $datakecamatan[0]->thndata,
                'btsutara'      => $datakecamatan[0]->btsutara,
                'btstimur'      => $datakecamatan[0]->btstimur,
                'btsselatan'    => $datakecamatan[0]->btsselatan,
                'btsbarat'      => $datakecamatan[0]->btsbarat,
            );
            $data['kabupaten'] = $this->regencies_model->getData();
        }
        else
        {
            $data['kecamatan'] = NULL;
        }

        $data['subview'] = 'kecamatan/input';
        $data['jscript'] = 'kecamatan/js';
        return view('main_layout', $data);
    }

    public function store()
    {
        $validation = $this->validate([
            'name' => [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Kecamatan maksimal 255 karakter.',
                ],
            ],
        ]);

        $mode = 'menambahkan';

        if (!$validation)
        {
            $data['kecamatan'] = $this->request->getPost();

            $data['kabupaten'] = NULL;
            $data['provinsi'] = $this->provinces_model->getData();

            $data['subview'] = 'kecamatan/input';
            $data['jscript'] = 'kecamatan/js';
            return view('main_layout', $data);
        }

        $this->db->transStart(); //Begin Transaction

        // log_message('info', 'store: '.print_r(trim($this->request->getPost('id')), TRUE));
        if (trim($this->request->getPost('id')) === "")
        {
            $idkecamatan = $this->main_model->increment();
            $datakecamatan = array(
                'id'            => $idkecamatan,
                'name'          => $this->request->getPost('name'),
                'latitude'      => $this->request->getPost('latitude'),
                'longitude'     => $this->request->getPost('longitude'),
                'totala'        => $this->request->getPost('totala'),
                'totall'        => $this->request->getPost('totall'),
                'totalp'        => $this->request->getPost('totalp'),
                'luaswil'       => $this->request->getPost('luaswil'),
                'thndata'       => $this->request->getPost('thndata'),
                'btsutara'      => $this->request->getPost('btsutara'),
                'btstimur'      => $this->request->getPost('btstimur'),
                'btsselatan'    => $this->request->getPost('btsselatan'),
                'btsbarat'      => $this->request->getPost('btsbarat'),
            );
            $this->main_model->insertData($datakecamatan);
        }
        else
        {
            $mode = 'mengubah';
            $datakecamatan = array(
                'name'          => $this->request->getPost('name'),
                'latitude'      => $this->request->getPost('latitude'),
                'longitude'     => $this->request->getPost('longitude'),
                'totala'        => $this->request->getPost('totala'),
                'totall'        => $this->request->getPost('totall'),
                'totalp'        => $this->request->getPost('totalp'),
                'luaswil'       => $this->request->getPost('luaswil'),
                'thndata'       => $this->request->getPost('thndata'),
                'btsutara'      => $this->request->getPost('btsutara'),
                'btstimur'      => $this->request->getPost('btstimur'),
                'btsselatan'    => $this->request->getPost('btsselatan'),
                'btsbarat'      => $this->request->getPost('btsbarat'),
            );
            $this->main_model->updateData($datakecamatan, $this->request->getPost('id'));
        }

        $this->db->transComplete(); //End Transaction

        if($this->db->transStatus() === TRUE)
        {
            return redirect()->to(base_url('kecamatan'))->with('success', 'Berhasil '.$mode.' kecamatan.');
        }
        else 
        {
            return redirect()->to(base_url('kecamatan'))->with('error', 'Gagal '.$mode.' kecamatan.');
        }
    }

    public function getregency($id)
    {
        $output = [
            'kabupaten' => $this->regencies_model->getData($id, 'province_id')
        ];
        echo json_encode($output);
    }

}