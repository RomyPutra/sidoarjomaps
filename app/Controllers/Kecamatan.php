<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use App\Models\Tdistricts_model;
use App\Models\Tregencies_model;
use App\Models\Tprovinces_model;
use App\Models\Tdistrictsedu_model;
use App\Models\Tdistrictsjobs_model;

class Kecamatan extends BaseController
{
    protected $validation;
    protected $main_model;
    protected $regencies_model;
    protected $provinces_model;
    protected $mainedu_model;
    protected $mainjob_model;

    public function __construct()
    {
        $this->validation =  Services::validation();
        $this->main_model = new Tdistricts_model();
        $this->regencies_model = new Tregencies_model();
        $this->provinces_model = new Tprovinces_model();
        $this->mainedu_model = new Tdistrictsedu_model();
        $this->mainjob_model = new Tdistrictsjobs_model();
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
                'bumdes'        => $datakecamatan[0]->bumdes,
                'tbsekolah'     => $datakecamatan[0]->tbsekolah,
                'btsd'          => $datakecamatan[0]->btsd,
                'sd'            => $datakecamatan[0]->sd,
                'smp'           => $datakecamatan[0]->smp,
                'sma'           => $datakecamatan[0]->sma,
                'profesi'       => $datakecamatan[0]->profesi,
                'diploma'       => $datakecamatan[0]->diploma,
                'sarjana'       => $datakecamatan[0]->sarjana,
                'magister'      => $datakecamatan[0]->magister,
                'doctoral'      => $datakecamatan[0]->doctoral,
                'btkerja'       => $datakecamatan[0]->btkerja,
                'asn'           => $datakecamatan[0]->asn,
                'pengajar'      => $datakecamatan[0]->pengajar,
                'wiraswasta'    => $datakecamatan[0]->wiraswasta,
                'petani'        => $datakecamatan[0]->petani,
                'nelayan'       => $datakecamatan[0]->nelayan,
                'pemukaagama'   => $datakecamatan[0]->pemukaagama,
                'pelajar'       => $datakecamatan[0]->pelajar,
                'nakes'         => $datakecamatan[0]->nakes,
                'pensiun'       => $datakecamatan[0]->pensiun,
                'lainnya'       => $datakecamatan[0]->lainnya,
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
                'bumdes'        => $this->request->getPost('bumdes'),
                'tbsekolah'     => $this->request->getPost('tbsekolah'),
                'btsd'          => $this->request->getPost('btsd'),
                'sd'            => $this->request->getPost('sd'),
                'smp'           => $this->request->getPost('smp'),
                'sma'           => $this->request->getPost('sma'),
                'profesi'       => $this->request->getPost('profesi'),
                'diploma'       => $this->request->getPost('diploma'),
                'sarjana'       => $this->request->getPost('sarjana'),
                'magister'      => $this->request->getPost('magister'),
                'doctoral'      => $this->request->getPost('doctoral'),
                'btkerja'       => $this->request->getPost('btkerja'),
                'asn'           => $this->request->getPost('asn'),
                'pengajar'      => $this->request->getPost('pengajar'),
                'wiraswasta'    => $this->request->getPost('wiraswasta'),
                'petani'        => $this->request->getPost('petani'),
                'nelayan'       => $this->request->getPost('nelayan'),
                'pemukaagama'   => $this->request->getPost('pemukaagama'),
                'pelajar'       => $this->request->getPost('pelajar'),
                'nakes'         => $this->request->getPost('nakes'),
                'pensiun'       => $this->request->getPost('pensiun'),
                'lainnya'       => $this->request->getPost('lainnya'),
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
                'bumdes'        => $this->request->getPost('bumdes'),
                'tbsekolah'     => $this->request->getPost('tbsekolah'),
                'btsd'          => $this->request->getPost('btsd'),
                'sd'            => $this->request->getPost('sd'),
                'smp'           => $this->request->getPost('smp'),
                'sma'           => $this->request->getPost('sma'),
                'profesi'       => $this->request->getPost('profesi'),
                'diploma'       => $this->request->getPost('diploma'),
                'sarjana'       => $this->request->getPost('sarjana'),
                'magister'      => $this->request->getPost('magister'),
                'doctoral'      => $this->request->getPost('doctoral'),
                'btkerja'       => $this->request->getPost('btkerja'),
                'asn'           => $this->request->getPost('asn'),
                'pengajar'      => $this->request->getPost('pengajar'),
                'wiraswasta'    => $this->request->getPost('wiraswasta'),
                'petani'        => $this->request->getPost('petani'),
                'nelayan'       => $this->request->getPost('nelayan'),
                'pemukaagama'   => $this->request->getPost('pemukaagama'),
                'pelajar'       => $this->request->getPost('pelajar'),
                'nakes'         => $this->request->getPost('nakes'),
                'pensiun'       => $this->request->getPost('pensiun'),
                'lainnya'       => $this->request->getPost('lainnya'),
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

    //Pendidikan
    public function indexedu()
    {
        $data['subview'] = 'kecamatan/indexedu';
        $data['jscript'] = 'kecamatan/jsedu';
        return view('main_layout', $data);
    }

    public function ajaxkecamatanedu()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $records = $this->mainedu_model->getDatatables($request);
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
                    $record->pendidikan,
                    $record->jumlah,
                    '<a href="'.base_url('kecamatanedu/input/'.$record->id).'" id="edit" class="btn custom-button btn-sm" title="Edit"><i class="fa fa-pen"></i></a>',
                ); 
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->mainedu_model->countAll(),
                'recordsFiltered' => $this->mainedu_model->countFiltered($request),
                'data' => $data
            ];

            $output[$csrfName] = $csrfHash; 
            echo json_encode($output);
        }
    }

    public function inputedu($id = NULL)
    {
        $data['validation'] = $this->validation;
        $data['kecamatan'] = $this->main_model->getData();
        $data['kecamatandtl'] = NULL;

        if ($id)
        {
            $datakecamatan = $this->mainedu_model->getDatabyid($id);
            // log_message('info', 'input: '.$this->db->getLastQuery());
            $data['kecamatandtl'] = array(
                'id'            => $datakecamatan[0]->id,
                'district_id'   => $datakecamatan[0]->district_id,
                'pendidikan'    => $datakecamatan[0]->pendidikan,
                'thndata'       => $datakecamatan[0]->thndata,
                'jumlah'        => $datakecamatan[0]->jumlah,
            );
        }
        else
        {
            $data['kecamatandtl'] = NULL;
        }

        $data['subview'] = 'kecamatan/inputedu';
        $data['jscript'] = 'kecamatan/jsedu';
        return view('main_layout', $data);
    }

    public function storeedu()
    {
        $validation = $this->validate([
            'pendidikan' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required'   => 'Pendidikan wajib diisi.',
                    'max_length' => 'Pendidikan maksimal 255 karakter.',
                ],
            ],
        ]);

        $mode = 'menambahkan';

        if (!$validation)
        {
            $data['kecamatandtl'] = $this->request->getPost();

            $data['kecamatan'] = $this->main_model->getData();

            $data['subview'] = 'kecamatan/inputedu';
            $data['jscript'] = 'kecamatan/jsedu';
            return view('main_layout', $data);
        }

        $this->db->transStart(); //Begin Transaction

        // log_message('info', 'store: '.print_r(trim($this->request->getPost('id')), TRUE));
        if (trim($this->request->getPost('id')) === "")
        {
            $idkecamatan = $this->mainedu_model->increment();
            $datakecamatan = array(
                'id'            => $idkecamatan,
                'district_id'   => $this->request->getPost('district_id'),
                'pendidikan'    => $this->request->getPost('pendidikan'),
                'thndata'       => $this->request->getPost('thndata'),
                'jumlah'        => $this->request->getPost('jumlah'),
            );
            $this->mainedu_model->insertData($datakecamatan);
        }
        else
        {
            $mode = 'mengubah';
            $datakecamatan = array(
                'pendidikan'    => $this->request->getPost('pendidikan'),
                'thndata'       => $this->request->getPost('thndata'),
                'jumlah'        => $this->request->getPost('jumlah'),
            );
            $this->mainedu_model->updateData($datakecamatan, $this->request->getPost('id'));
        }

        $this->db->transComplete(); //End Transaction

        if($this->db->transStatus() === TRUE)
        {
            return redirect()->to(base_url('kecamatandtl'))->with('success', 'Berhasil '.$mode.' data pendidikan kecamatan.');
        }
        else 
        {
            return redirect()->to(base_url('kecamatandtl'))->with('error', 'Gagal '.$mode.' data pendidikan kecamatan.');
        }
    }

    //Pekerjaan
    public function indexjob()
    {
        $data['subview'] = 'kecamatan/indexjob';
        $data['jscript'] = 'kecamatan/jsjob';
        return view('main_layout', $data);
    }

    public function ajaxkecamatanjob()
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
                    '<a href="'.base_url('kecamatanjob/input/'.$record->id).'" id="edit" class="btn custom-button btn-sm" title="Edit"><i class="fa fa-pen"></i></a>',
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
        $data['kecamatan'] = $this->main_model->getData();
        $data['kecamatandtl'] = NULL;

        if ($id)
        {
            $datakecamatan = $this->mainjob_model->getDatabyid($id);
            // log_message('info', 'input: '.$this->db->getLastQuery());
            $data['kecamatandtl'] = array(
                'id'            => $datakecamatan[0]->id,
                'district_id'   => $datakecamatan[0]->district_id,
                'pekerjaan'     => $datakecamatan[0]->pekerjaan,
                'thndata'       => $datakecamatan[0]->thndata,
                'jumlah'        => $datakecamatan[0]->jumlah,
            );
        }
        else
        {
            $data['kecamatandtl'] = NULL;
        }

        $data['subview'] = 'kecamatan/inputjob';
        $data['jscript'] = 'kecamatan/jsjob';
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
            $data['kecamatandtl'] = $this->request->getPost();

            $data['kecamatan'] = $this->main_model->getData();

            $data['subview'] = 'kecamatan/inputjob';
            $data['jscript'] = 'kecamatan/jsjob';
            return view('main_layout', $data);
        }

        $this->db->transStart(); //Begin Transaction

        // log_message('info', 'store: '.print_r(trim($this->request->getPost('id')), TRUE));
        if (trim($this->request->getPost('id')) === "")
        {
            $idkecamatan = $this->mainjob_model->increment();
            $datakecamatan = array(
                'id'            => $idkecamatan,
                'district_id'   => $this->request->getPost('district_id'),
                'pekerjaan'     => $this->request->getPost('pekerjaan'),
                'thndata'       => $this->request->getPost('thndata'),
                'jumlah'        => $this->request->getPost('jumlah'),
            );
            $this->mainjob_model->insertData($datakecamatan);
        }
        else
        {
            $mode = 'mengubah';
            $datakecamatan = array(
                'pekerjaan'     => $this->request->getPost('pekerjaan'),
                'thndata'       => $this->request->getPost('thndata'),
                'jumlah'        => $this->request->getPost('jumlah'),
            );
            $this->mainjob_model->updateData($datakecamatan, $this->request->getPost('id'));
        }

        $this->db->transComplete(); //End Transaction

        if($this->db->transStatus() === TRUE)
        {
            return redirect()->to(base_url('kecamatandtl'))->with('success', 'Berhasil '.$mode.' data pekerjaan kecamatan.');
        }
        else 
        {
            return redirect()->to(base_url('kecamatandtl'))->with('error', 'Gagal '.$mode.' data pekerjaan kecamatan.');
        }
    }

}