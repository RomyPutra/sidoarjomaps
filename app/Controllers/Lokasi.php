<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use App\Models\Tlokasi_model;
use App\Models\Tkategori_model;
use App\Models\Tvillages_model;
use App\Models\Tlokasidtl_model;

class Lokasi extends BaseController
{
    protected $validation;
    protected $main_model;
    protected $detail_model;
    protected $kategori_model;
    protected $desa_model;

    public function __construct()
    {
        $this->validation =  Services::validation();
        $this->main_model = new Tlokasi_model();
        $this->detail_model = new Tlokasidtl_model();
        $this->kategori_model = new Tkategori_model();
        $this->desa_model = new Tvillages_model();
    }
    
    public function index()
    {
        $data['subview'] = 'lokasi/index';
        $data['jscript'] = 'lokasi/js';
        return view('main_layout', $data);
    }

    public function ajaxlokasi()
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
                    $record->nama,
                    $record->kategori,
                    $record->alt_name,
                    $record->gambar ? '<img src="'.base_url('public/imgmain/').$record->gambar.'"/>' : '-',
                    $record->profile,
                    $record->latitude,
                    $record->longitude,
                    '<a href="'.base_url('obyek/input/'.$record->kode).'" id="edit" class="btn custom-button btn-sm" title="Edit"><i class="fa fa-pen"></i></a>&nbsp;<a href="'.base_url('obyek/detail/'.$record->kode).'" id="view" class="btn custom-button btn-sm" title="Detail"><i class="fa fa-eye"></i></a>',
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
            $datalokasi = $this->main_model->getData($id);
            $data['lokasi'] = array(
                'kode'          => $datalokasi[0]->kode,
                'kd_kat'        => $datalokasi[0]->kd_kat,
                'kd_desa'       => $datalokasi[0]->kd_desa,
                'nama'          => $datalokasi[0]->nama,
                'images'        => '',
                'profile'       => $datalokasi[0]->profile,
                'latitude'      => $datalokasi[0]->latitude,
                'longitude'     => $datalokasi[0]->longitude,
                'namacp'        => $datalokasi[0]->namacp,
                'nomorcp'       => $datalokasi[0]->nomorcp,
                'alamat'        => $datalokasi[0]->alamat,
                'template'      => $datalokasi[0]->template,
            );
        }
        else
        {
            $data['lokasi'] = NULL;
        }

        $data['kategori'] = $this->kategori_model->getData();
        $data['desa'] = $this->desa_model->getData();

        $data['subview'] = 'lokasi/input';
        $data['jscript'] = 'lokasi/js';
        return view('main_layout', $data);
    }

    public function store()
    {
        $validation = $this->validate([
            'nama' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required'   => 'Nama wajib diisi.',
                    'max_length' => 'Nama maksimal 50 karakter.',
                ],
            ],
            'profile' => [
                'rules' => 'required',
                'errors' => [
                    'required'   => 'Profil wajib diisi.',
                ],
            ],
            'latitude' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required'   => 'Latitude wajib diisi.',
                    'max_length' => 'Latitude maksimal 50 karakter.',
                ],
            ],
            'longitude' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required'   => 'Longitude wajib diisi.',
                    'max_length' => 'Longitude maksimal 50 karakter.',
                ],
            ],
        ]);

        $mode = 'menambahkan';

        if (!$validation)
        {
            $data['validation'] = $this->validation;
            $data['lokasi'] = $this->request->getPost();

            $data['kategori'] = $this->kategori_model->getData();
            $data['desa'] = $this->desa_model->getData();

            $data['subview'] = 'lokasi/input';
            $data['jscript'] = 'lokasi/js';
            return view('main_layout', $data);
        }

        $this->db->transStart(); //Begin Transaction

        $fileform = $this->request->getFile('images');
        $filegambar = '';
        if ($fileform->isValid() && !$fileform->hasMoved()) {
            $filegambar = $fileform->getRandomName();
        }
        // log_message('info', 'store: '.print_r(trim($this->request->getPost('kode')), TRUE));
        if (trim($this->request->getPost('kode')) === "")
        {
            $idlokasi = $this->main_model->increment();
            $datalokasi = array(
                'kode'          => $idlokasi,
                'kd_kat'        => $this->request->getPost('kd_kat'),
                'kd_desa'       => $this->request->getPost('kd_desa'),
                'nama'          => $this->request->getPost('nama'),
                'images'        => $filegambar,
                'profile'       => $this->request->getPost('profile'),
                'latitude'      => $this->request->getPost('latitude'),
                'longitude'     => $this->request->getPost('longitude'),
                'namacp'        => $this->request->getPost('namacp'),
                'nomorcp'       => $this->request->getPost('nomorcp'),
                'alamat'        => $this->request->getPost('alamat'),
                'template'      => $this->request->getPost('template'),
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
                'created_by'    => session('email'),
                'updated_by'    => session('email'),
            );
            $this->main_model->insertData($datalokasi);
        }
        else
        {
            $mode = 'mengubah';
            if ($filegambar == '') {
                $datalokasi = array(
                    'kd_kat'        => $this->request->getPost('kd_kat'),
                    'kd_desa'       => $this->request->getPost('kd_desa'),
                    'nama'          => $this->request->getPost('nama'),
                    'profile'       => $this->request->getPost('profile'),
                    'latitude'      => $this->request->getPost('latitude'),
                    'longitude'     => $this->request->getPost('longitude'),
                    'namacp'        => $this->request->getPost('namacp'),
                    'nomorcp'       => $this->request->getPost('nomorcp'),
                    'alamat'        => $this->request->getPost('alamat'),
                    'template'      => $this->request->getPost('template'),
                    'updated_at'    => date("Y-m-d H:i:s"),
                    'updated_by'    => session('email'),
                );
                $this->main_model->updateData($datalokasi, $this->request->getPost('kode'));
            } 
            else 
            {
                $datalokasi = array(
                    'kd_kat'        => $this->request->getPost('kd_kat'),
                    'kd_desa'       => $this->request->getPost('kd_desa'),
                    'nama'          => $this->request->getPost('nama'),
                    'images'        => $filegambar,
                    'profile'       => $this->request->getPost('profile'),
                    'latitude'      => $this->request->getPost('latitude'),
                    'longitude'     => $this->request->getPost('longitude'),
                    'namacp'        => $this->request->getPost('namacp'),
                    'nomorcp'       => $this->request->getPost('nomorcp'),
                    'alamat'        => $this->request->getPost('alamat'),
                    'template'      => $this->request->getPost('template'),
                    'updated_at'    => date("Y-m-d H:i:s"),
                    'updated_by'    => session('email'),
                );
                $this->main_model->updateData($datalokasi, $this->request->getPost('kode'));
            }
        }
        if ($fileform->isValid() && !$fileform->hasMoved()) {
            $fileform->move(ROOTPATH.'public/imgmain', $filegambar);
        }

        $this->db->transComplete(); //End Transaction

        if($this->db->transStatus() === TRUE)
        {
            return redirect()->to(base_url('obyek'))->with('success', 'Berhasil '.$mode.' obyek.');
        }
        else 
        {
            return redirect()->to(base_url('obyek'))->with('error', 'Gagal '.$mode.' obyek.');
        }
    }

    public function detail($id)
    {
        $data['idlokasi'] = $id;

        $data['validation'] = $this->validation;
        $data['lokasi'] = $this->main_model->getPointbyid($id)[0];
        $data['images'] = $this->detail_model->countAll($id);
        $data['subview'] = 'lokasi/detail';
        $data['jscript'] = 'lokasi/js';
        return view('main_layout', $data);
    }

    public function ajaxlokasidtl($id)
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $records = $this->detail_model->getDatatables($request, $id);
            $data = [];
            $no = $request->getPost('start');
            log_message('info', 'ajaxdtl: '.$this->db->getLastQuery());
            // log_message('info', 'ajax: '.print_r($records, TRUE));

            foreach($records as $record){
                $no++;
                $data[] = array( 
                    $no,
                    $record->nama.' '.$record->alt_name,
                    $record->dtlimages ? '<img src="'.base_url('public/imgdtl/').$record->dtlimages.'"/>' : '-',
                    '<a href="'.base_url('obyek/inputdtl/'.$id.'/'.$record->kode).'" id="edit" class="btn custom-button btn-sm" title="Edit"><i class="fa fa-pen"></i></a>&nbsp;<a onclick="return confirm(\'Apakah Anda Yakin?\')" href="'.base_url('obyek/delete/'.$record->kode).'" id="delete" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></a>',
                ); 
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->detail_model->countAll($id),
                'recordsFiltered' => $this->detail_model->countFiltered($request, $id),
                'data' => $data
            ];

            $output[$csrfName] = $csrfHash; 
            echo json_encode($output);
        }
    }

    public function inputdtl($idlokasi, $id = NULL)
    {
        $data['idlokasi'] = $idlokasi;
        $data['validation'] = $this->validation;

        if ($id)
        {
            $datalokasi = $this->detail_model->getData($id);
            $data['lokasidtl'] = array(
                'kode'          => $datalokasi[0]->kode,
                'images'        => '',
            );
        }
        else
        {
            $data['lokasidtl'] = NULL;
        }

        $data['subview'] = 'lokasi/inputdtl';
        $data['jscript'] = 'lokasi/js';
        return view('main_layout', $data);
    }

    public function additem()
    {
        $validation = $this->validate([
            'fileimages' => [
                // 'rules' => 'uploaded[fileimages]|max_size[fileimages,5000]', 
                'rules' => 'uploaded[fileimages]', 
                'errors' => [
                    'uploaded'  => 'Pilih file gambar terlebih dahulu',
                    // 'max_size'  => 'Ukuran file terlalu besar',
                ], 
            ],
        ]);

        $mode = 'menambahkan';

        if (!$validation)
        {
            $data['idlokasi'] = $this->request->getPost('idlokasi');
            $data['validation'] = $this->validation;
            $data['lokasidtl'] = $this->request->getPost();

            $data['subview'] = 'lokasi/inputdtl';
            $data['jscript'] = 'lokasi/js';
            return view('main_layout', $data);
        }

        $this->db->transStart(); //Begin Transaction
        $idgambar = $this->detail_model->increment();
        $fileform = $this->request->getFile('fileimages');
        $filegambar = $fileform->getRandomName();
        // log_message('info', 'store: '.print_r(trim($this->request->getPost('kode')), TRUE));
        if (trim($this->request->getPost('kode')) === "")
        {
            $datafile = array(
                'kode'              => $idgambar,
                'kodetempat'        => $this->request->getPost('idlokasi'),
                'dtlimages'         => $filegambar,
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
                'created_by'        => session('email'),
                'updated_by'        => session('email'),
            );

            $this->detail_model->insertData($datafile);
        } else {
            $mode = 'mengubah';
            $datafile = array(
                'kodetempat'        => $this->request->getPost('idlokasi'),
                'dtlimages'         => $filegambar,
                'updated_at'        => date("Y-m-d H:i:s"),
                'updated_by'        => session('email'),
            );

            $this->detail_model->updateData($datafile, $this->request->getPost('kode'));
        }
        $fileform->move(ROOTPATH.'public/imgdtl', $filegambar);

        $this->db->transComplete(); //End Transaction

        if($this->db->transStatus() === TRUE)
        {
            return redirect()->to(base_url('obyek/detail/'.$this->request->getPost('idlokasi')))->with('success', 'Berhasil '.$mode.' obyek.');
        }
        else 
        {
            return redirect()->to(base_url('obyek/detail/'.$this->request->getPost('idlokasi')))->with('error', 'Gagal '.$mode.' obyek.');
        }
    }

    public function delitem($id)
    {
        $this->detail_model->deleteData($id);
        return redirect()->back()->with('success', 'Berhasil menghapus data.');
    }

}