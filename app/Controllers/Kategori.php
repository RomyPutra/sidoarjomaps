<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use App\Models\Tkategori_model;

class Kategori extends BaseController
{
    protected $validation;
    protected $main_model;

    public function __construct()
    {
        $this->validation =  Services::validation();
        $this->main_model = new Tkategori_model();
    }
    
    public function index()
    {
        $data['subview'] = 'kategori/index';
        $data['jscript'] = 'kategori/js';
        return view('main_layout', $data);
    }

    public function ajaxkategori()
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
                    $record->kategori,
                    $record->images ? '<img src="'.base_url('public/pin/').$record->images.'"/>' : '-',
                    '<a href="'.base_url('kategori/input/'.$record->kode).'" id="edit" class="btn custom-button btn-sm" title="Edit"><i class="fa fa-pen"></i></a>',
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
            $datakategori = $this->main_model->getData($id);
            $data['kategori'] = array(
                'kode'        => $datakategori[0]->kode,
                'kategori'    => $datakategori[0]->kategori,
            );
        }
        else
        {
            $data['kategori'] = NULL;
        }

        $data['subview'] = 'kategori/input';
        $data['jscript'] = 'kategori/js';
        return view('main_layout', $data);
    }

    public function store()
    {
        $validation = $this->validate([
            'kategori' => [
                'rules' => 'max_length[25]',
                'errors' => [
                    'max_length' => 'Kategori maksimal 25 karakter.',
                ],
            ],
        ]);

        $mode = 'menambahkan';

        if (!$validation)
        {
            $data['kategori'] = $this->request->getPost();

            $data['validation'] = $this->validation;
            $data['subview'] = 'kategori/input';
            $data['jscript'] = 'kategori/js';
            return view('main_layout', $data);
        }

        $this->db->transStart(); //Begin Transaction

        // log_message('info', 'store: '.print_r(trim($this->request->getPost('kode')), TRUE));
        $fileform = $this->request->getFile('images');
        $fileikon = '';
        if ($fileform->isValid() && !$fileform->hasMoved()) {
            $fileikon = $fileform->getRandomName();
        }
        // log_message('info', 'fileikon: '.print_r($fileikon, TRUE));
        if (trim($this->request->getPost('kode')) === "")
        {
            $idkategori = $this->main_model->increment();
            $datakategori = array(
                'kode'          => $idkategori,
                'kategori'      => $this->request->getPost('kategori'),
                'images'        => $fileikon == '' ? NULL : $fileikon,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
                'created_by'    => session('email'),
                'updated_by'    => session('email'),
            );
            $this->main_model->insertData($datakategori);
        }
        else
        {
            $mode = 'mengubah';
            if ($fileikon == '') {
                $datakategori = array(
                    'kategori'      => $this->request->getPost('kategori'),
                    'updated_at'    => date("Y-m-d H:i:s"),
                    'updated_by'    => session('email'),
                );
                $this->main_model->updateData($datakategori, $this->request->getPost('kode'));
            } 
            else 
            {
                $datakategori = array(
                    'kategori'      => $this->request->getPost('kategori'),
                    'images'        => $fileikon,
                    'updated_at'    => date("Y-m-d H:i:s"),
                    'updated_by'    => session('email'),
                );
                $this->main_model->updateData($datakategori, $this->request->getPost('kode'));
            }
        }
        if ($fileform->isValid() && !$fileform->hasMoved()) {
            $fileform->move(ROOTPATH.'public/pin', $fileikon);
        }

        $this->db->transComplete(); //End Transaction

        if($this->db->transStatus() === TRUE)
        {
            return redirect()->to(base_url('kategori'))->with('success', 'Berhasil '.$mode.' kategori.');
        }
        else 
        {
            return redirect()->to(base_url('kategori'))->with('error', 'Gagal '.$mode.' kategori.');
        }
    }

}