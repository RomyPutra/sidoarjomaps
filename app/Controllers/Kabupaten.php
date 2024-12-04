<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use App\Models\Tregencies_model;
use App\Models\Tprovinces_model;
use App\Models\Tregenciesdtl_model;
use App\Models\Tregenciesjobs_model;

class Kabupaten extends BaseController
{
    protected $validation;
    protected $main_model;
    protected $provinces_model;
    protected $maindtl_model;
    protected $mainjob_model;

    public function __construct()
    {
        $this->validation =  Services::validation();
        $this->main_model = new Tregencies_model();
        $this->provinces_model = new Tprovinces_model();
        $this->maindtl_model = new Tregenciesdtl_model();
        $this->mainjob_model = new Tregenciesjobs_model();
    }
    
    public function index()
    {
        $data['subview'] = 'kabupaten/index';
        $data['jscript'] = 'kabupaten/js';
        return view('main_layout', $data);
    }

    public function ajaxkabupaten()
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
                    $record->name,
                    $record->luaswil,
                    $record->btsutara,
                    $record->btsbarat,
                    $record->btsselatan,
                    $record->btstimur,
                    '<a href="'.base_url('kabupaten/input/'.$record->id).'" id="edit" class="btn custom-button btn-sm" title="Edit"><i class="fa fa-pen"></i></a>',
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
            $datakabupaten = $this->main_model->getDatabyid($id);
            // log_message('info', 'input: '.$this->db->getLastQuery());
            $data['kabupaten'] = array(
                'id'            => $datakabupaten[0]->id,
                'province_id'   => $datakabupaten[0]->province_id,
                'name'          => $datakabupaten[0]->name,
                'alt_name'      => $datakabupaten[0]->alt_name,
                'latitude'      => $datakabupaten[0]->latitude,
                'longitude'     => $datakabupaten[0]->longitude,
                'luaswil'       => $datakabupaten[0]->luaswil,
                'btsutara'      => $datakabupaten[0]->btsutara,
                'btstimur'      => $datakabupaten[0]->btstimur,
                'btsselatan'    => $datakabupaten[0]->btsselatan,
                'btsbarat'      => $datakabupaten[0]->btsbarat,
            );
        }
        else
        {
            $data['kabupaten'] = NULL;
        }

        $data['subview'] = 'kabupaten/input';
        $data['jscript'] = 'kabupaten/js';
        return view('main_layout', $data);
    }

    public function store()
    {
        $validation = $this->validate([
            'name' => [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Kabupaten maksimal 255 karakter.',
                ],
            ],
            'alt_name' => [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Nama Alternatif maksimal 255 karakter.',
                ],
            ],
        ]);

        $mode = 'menambahkan';

        if (!$validation)
        {
            $data['kabupaten'] = $this->request->getPost();
            $data['provinsi'] = $this->provinces_model->getData();

            $data['subview'] = 'kabupaten/input';
            $data['jscript'] = 'kabupaten/js';
            return view('main_layout', $data);
        }

        $this->db->transStart(); //Begin Transaction

        // log_message('info', 'store: '.print_r(trim($this->request->getPost('id')), TRUE));
        if (trim($this->request->getPost('id')) === "")
        {
            $idkabupaten = $this->main_model->increment();
            $datakabupaten = array(
                'id'            => $idkabupaten,
                'name'          => $this->request->getPost('name'),
                'alt_name'      => $this->request->getPost('alt_name'),
                'latitude'      => $this->request->getPost('latitude'),
                'longitude'     => $this->request->getPost('longitude'),
                'luaswil'       => $this->request->getPost('luaswil'),
                'btsutara'      => $this->request->getPost('btsutara'),
                'btstimur'      => $this->request->getPost('btstimur'),
                'btsselatan'    => $this->request->getPost('btsselatan'),
                'btsbarat'      => $this->request->getPost('btsbarat'),
            );
            $this->main_model->insertData($datakabupaten);
        }
        else
        {
            $mode = 'mengubah';
            $datakabupaten = array(
                'name'          => $this->request->getPost('name'),
                'alt_name'      => $this->request->getPost('alt_name'),
                'latitude'      => $this->request->getPost('latitude'),
                'longitude'     => $this->request->getPost('longitude'),
                'luaswil'       => $this->request->getPost('luaswil'),
                'btsutara'      => $this->request->getPost('btsutara'),
                'btstimur'      => $this->request->getPost('btstimur'),
                'btsselatan'    => $this->request->getPost('btsselatan'),
                'btsbarat'      => $this->request->getPost('btsbarat'),
            );
            $this->main_model->updateData($datakabupaten, $this->request->getPost('id'));
        }

        $this->db->transComplete(); //End Transaction

        if($this->db->transStatus() === TRUE)
        {
            return redirect()->to(base_url('kabupaten'))->with('success', 'Berhasil '.$mode.' kabupaten.');
        }
        else 
        {
            return redirect()->to(base_url('kabupaten'))->with('error', 'Gagal '.$mode.' kabupaten.');
        }
    }

    //Detail
    public function indexdtl()
    {
        $data['subview'] = 'kabupaten/indexdtl';
        $data['jscript'] = 'kabupaten/jsdtl';
        return view('main_layout', $data);
    }

    public function ajaxkabupatendtl()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $records = $this->maindtl_model->getDatatables($request);
            $data = [];
            $no = $request->getPost('start');
            // log_message('info', 'ajax: '.$this->db->getLastQuery());
            // log_message('info', 'ajax: '.print_r($records, TRUE));

            foreach($records as $record){
                $no++;
                $data[] = array( 
                    $no,
                    $record->name,
                    $record->thndata,
                    $record->usia,
                    $record->totall,
                    $record->totalp,
                    '<a href="'.base_url('kabupatendtl/input/'.$record->id).'" id="edit" class="btn custom-button btn-sm" title="Edit"><i class="fa fa-pen"></i></a>',
                ); 
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->maindtl_model->countAll(),
                'recordsFiltered' => $this->maindtl_model->countFiltered($request),
                'data' => $data
            ];

            $output[$csrfName] = $csrfHash; 
            echo json_encode($output);
        }
    }

    public function inputdtl($id = NULL)
    {
        $data['validation'] = $this->validation;
        $data['kabupaten'] = $this->main_model->getData();
        $data['kabupatendtl'] = NULL;

        if ($id)
        {
            $datakabupaten = $this->maindtl_model->getDatabyid($id);
            // log_message('info', 'input: '.$this->db->getLastQuery());
            $data['kabupatendtl'] = array(
                'id'            => $datakabupaten[0]->id,
                'regency_id'    => $datakabupaten[0]->regency_id,
                'usia'          => $datakabupaten[0]->usia,
                'thndata'       => $datakabupaten[0]->thndata,
                'totall'        => $datakabupaten[0]->totall,
                'totalp'        => $datakabupaten[0]->totalp,
            );
        }
        else
        {
            $data['kabupatendtl'] = NULL;
        }

        $data['subview'] = 'kabupaten/inputdtl';
        $data['jscript'] = 'kabupaten/jsdtl';
        return view('main_layout', $data);
    }

    public function storedtl()
    {
        $validation = $this->validate([
            'usia' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required'   => 'Usia wajib diisi.',
                    'max_length' => 'Usia maksimal 255 karakter.',
                ],
            ],
        ]);

        $mode = 'menambahkan';

        if (!$validation)
        {
            $data['kabupatendtl'] = $this->request->getPost();
            $data['kabupaten'] = $this->main_model->getData();

            $data['subview'] = 'kabupaten/inputdtl';
            $data['jscript'] = 'kabupaten/jsdtl';
            return view('main_layout', $data);
        }

        $this->db->transStart(); //Begin Transaction

        // log_message('info', 'store: '.print_r(trim($this->request->getPost('id')), TRUE));
        if (trim($this->request->getPost('id')) === "")
        {
            $iddtl = $this->maindtl_model->increment();
            $datakabupaten = array(
                'id'            => $iddtl,
                'regency_id'    => $this->request->getPost('regency_id'),
                'usia'          => $this->request->getPost('usia'),
                'thndata'       => $this->request->getPost('thndata'),
                'totall'        => $this->request->getPost('totall'),
                'totalp'        => $this->request->getPost('totalp'),
            );
            $this->maindtl_model->insertData($datakabupaten);
        }
        else
        {
            $mode = 'mengubah';
            $datakabupaten = array(
                'usia'          => $this->request->getPost('usia'),
                'thndata'       => $this->request->getPost('thndata'),
                'totall'        => $this->request->getPost('totall'),
                'totalp'        => $this->request->getPost('totalp'),
            );
            $this->maindtl_model->updateData($datakabupaten, $this->request->getPost('id'));
        }

        $this->db->transComplete(); //End Transaction

        if($this->db->transStatus() === TRUE)
        {
            return redirect()->to(base_url('kabupatendtl'))->with('success', 'Berhasil '.$mode.' rincian kabupaten.');
        }
        else 
        {
            return redirect()->to(base_url('kabupatendtl'))->with('error', 'Gagal '.$mode.' rincian kabupaten.');
        }
    }

    //Jobs
    public function indexjob()
    {
        $data['subview'] = 'kabupaten/indexjob';
        $data['jscript'] = 'kabupaten/jsjob';
        return view('main_layout', $data);
    }

    public function ajaxkabupatenjob()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $records = $this->mainjob_model->getDatatables($request);
            $data = [];
            $no = $request->getPost('start');
            // log_message('info', 'ajax: '.$this->db->getLastQuery());
            // log_message('info', 'ajax: '.print_r($records, TRUE));

            foreach($records as $record){
                $no++;
                $data[] = array( 
                    $no,
                    $record->name,
                    $record->thndata,
                    $record->pekerjaan,
                    $record->jumlah,
                    '<a href="'.base_url('kabupatenjob/input/'.$record->id).'" id="edit" class="btn custom-button btn-sm" title="Edit"><i class="fa fa-pen"></i></a>',
                ); 
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->mainjob_model->countAll(),
                'recordsFiltered' => $this->mainjob_model->countFiltered($request),
                'data' => $data
            ];

            $output[$csrfName] = $csrfHash; 
            echo json_encode($output);
        }
    }

    public function inputjob($id = NULL)
    {
        $data['validation'] = $this->validation;
        $data['kabupaten'] = $this->main_model->getData();
        $data['kabupatendtl'] = NULL;

        if ($id)
        {
            $datakabupaten = $this->mainjob_model->getDatabyid($id);
            // log_message('info', 'input: '.$this->db->getLastQuery());
            $data['kabupatendtl'] = array(
                'id'            => $datakabupaten[0]->id,
                'regency_id'    => $datakabupaten[0]->regency_id,
                'pekerjaan'     => $datakabupaten[0]->pekerjaan,
                'thndata'       => $datakabupaten[0]->thndata,
                'jumlah'        => $datakabupaten[0]->jumlah,
            );
        }
        else
        {
            $data['kabupatendtl'] = NULL;
        }

        $data['subview'] = 'kabupaten/inputjob';
        $data['jscript'] = 'kabupaten/jsjob';
        return view('main_layout', $data);
    }

    public function storejob()
    {
        $validation = $this->validate([
            'pekerjaan' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required'   => 'Pekerjaan wajib diisi.',
                    'max_length' => 'Pekerjaan maksimal 255 karakter.',
                ],
            ],
        ]);

        $mode = 'menambahkan';

        if (!$validation)
        {
            $data['kabupatendtl'] = $this->request->getPost();
            $data['kabupaten'] = $this->main_model->getData();

            $data['subview'] = 'kabupaten/inputjob';
            $data['jscript'] = 'kabupaten/jsjob';
            return view('main_layout', $data);
        }

        $this->db->transStart(); //Begin Transaction

        // log_message('info', 'store: '.print_r(trim($this->request->getPost('id')), TRUE));
        if (trim($this->request->getPost('id')) === "")
        {
            $idjob = $this->mainjob_model->increment();
            $datakabupaten = array(
                'id'            => $idjob,
                'regency_id'    => $this->request->getPost('regency_id'),
                'pekerjaan'     => $this->request->getPost('pekerjaan'),
                'thndata'       => $this->request->getPost('thndata'),
                'jumlah'        => $this->request->getPost('jumlah'),
            );
            $this->mainjob_model->insertData($datakabupaten);
        }
        else
        {
            $mode = 'mengubah';
            $datakabupaten = array(
                'pekerjaan'     => $this->request->getPost('pekerjaan'),
                'thndata'       => $this->request->getPost('thndata'),
                'jumlah'        => $this->request->getPost('jumlah'),
            );
            $this->mainjob_model->updateData($datakabupaten, $this->request->getPost('id'));
        }

        $this->db->transComplete(); //End Transaction

        if($this->db->transStatus() === TRUE)
        {
            return redirect()->to(base_url('kabupatenjob'))->with('success', 'Berhasil '.$mode.' data pekerjaan kabupaten.');
        }
        else 
        {
            return redirect()->to(base_url('kabupatenjob'))->with('error', 'Gagal '.$mode.' data pekerjaan kabupaten.');
        }
    }

}