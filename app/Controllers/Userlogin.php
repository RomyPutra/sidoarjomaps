<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use Config\Services;
use App\Models\Auth_model;
use App\Models\Tdropdown_model;

class Userlogin extends BaseController
{
    public function __construct()
    {
        $this->validation =  Services::validation();
        $this->userlogin_model = new Auth_model();
        $this->drop_model = new Tdropdown_model();
    }
    
    public function index()
    {
        $data['subview'] = 'userlogin/index';
        $data['jscript'] = 'userlogin/js';
        return view('main_layout', $data);
    }

    public function ajaxuserlogin()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $records = $this->userlogin_model->getDatatables($request);
            $data = [];
            $no = $request->getPost('start');
            // log_message('info', 'ajax: '.$this->db->getLastQuery());
            // log_message('info', 'ajax: '.print_r($records, TRUE));

            foreach($records as $record){
                $no++;
                $data[] = array( 
                    $no,
                    $record->username,
                    $record->name,
                    $record->email,
                    $record->level,
                    $record->referenceid,
                    '<a href="'.base_url('userlogin/input/'.$record->id).'" id="edit" class="btn custom-button btn-sm" title="Edit"><i class="fa fa-pen"></i></a>&nbsp;<a href="'.base_url('userlogin/default/'.$record->id).'" class="btn custom-button btn-sm" title="Default Password"><i class="fa fa-key"></i></a>&nbsp;<a onclick="return confirm(\'Apakah Anda Yakin?\')" class="btn btn-danger btn-sm" href="'.base_url('userlogin/delete/'.$record->id).'" title="Hapus"><i class="fa fa-times"></i></a>',
                ); 
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->userlogin_model->countAll(),
                'recordsFiltered' => $this->userlogin_model->countFiltered($request),
                'data' => $data
            ];

            $output[$csrfName] = $csrfHash; 
            echo json_encode($output);
        }
    }

    public function input($id = NULL)
    {
        $data['levellogin'] = $this->drop_model->getDataby('category', 'levellogin');
        $data['validation'] = $this->validation;

        if ($id)
        {
            $datauserlogin = $this->userlogin_model->getData($id);
            $data['userlogin'] = array(
                'id'          => $datauserlogin[0]->id,
                'username'    => $datauserlogin[0]->username,
                'name'        => $datauserlogin[0]->name,
                'email'       => $datauserlogin[0]->email,
                'password'    => '',
                'picture'     => $datauserlogin[0]->picture,
                'status'      => $datauserlogin[0]->status,
                'level'       => $datauserlogin[0]->level,
                'referenceid' => $datauserlogin[0]->referenceid,
                'confirm_password'    => '',
            );
        }
        else
        {
            $data['userlogin'] = NULL;
        }

        $data['subview'] = 'userlogin/input';
        $data['jscript'] = 'userlogin/js';
        return view('main_layout', $data);
    }

    public function store()
    {
        $mode = 'menambahkan';

        if (trim($this->request->getPost('id')) === "")
        {
            $idlogin = $this->userlogin_model->increment();
        } else {
            $idlogin = trim($this->request->getPost('id'));
        }

        $data = [
            'id'                => $idlogin,
            'email'             => $this->request->getPost('email'),
            'name'              => $this->request->getPost('name'),
            'username'          => $this->request->getPost('username'),
            'password'          => $this->request->getPost('password'),
            'confirm_password'  => $this->request->getPost('confirm_password')
        ];

        if($this->validation->run($data, 'authregister') == FALSE)
        {
            $data['levellogin'] = $this->drop_model->getDataby('category', 'levellogin');
            $data['userlogin'] = $this->request->getPost();
            $data['validation'] = $this->validation;

            $data['subview'] = 'userlogin/input';
            $data['jscript'] = 'userlogin/js';
            return view('main_layout', $data);
        }

        $this->db->transStart(); //Begin Transaction

        // log_message('info', 'store: '.print_r(trim($this->request->getPost('id')), TRUE));
        if (trim($this->request->getPost('id')) === "")
        {
            $datauserlogin = array(
                'username'    => $this->request->getPost('username'),
                'name'        => $this->request->getPost('name'),
                'email'       => $this->request->getPost('email'),
                'password'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'picture'     => $this->request->getPost('picture'),
                'status'      => 'Active',
                'level'       => $this->request->getPost('level'),
            );
            $this->userlogin_model->insertData($datauserlogin);
        }
        else
        {
            $mode = 'mengubah';
            $datauserlogin = array(
                'username'    => $this->request->getPost('username'),
                'name'        => $this->request->getPost('name'),
                'email'       => $this->request->getPost('email'),
                'password'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'picture'     => $this->request->getPost('picture'),
                'status'      => 'Active',
                'level'       => $this->request->getPost('level'),
            );
            $this->userlogin_model->updateData($datauserlogin, $this->request->getPost('id'));
        }

        $this->db->transComplete(); //End Transaction

        if($this->db->transStatus() === TRUE)
        {
            return redirect()->to(base_url('userlogin'))->with('success', 'Berhasil '.$mode.' userlogin.');
        }
        else 
        {
            return redirect()->to(base_url('userlogin'))->with('error', 'Gagal '.$mode.' userlogin.');
        }
    }

    public function defaultpassword($id)
    {
        $data = array (
            'password' => password_hash('1234qwer', PASSWORD_DEFAULT),
        );

        $this->userlogin_model->updateData($data, $id);
        // log_message('info', 'defPass: '.$this->db->getLastQuery());
        return redirect()->to(base_url('userlogin'))->with('success', 'Berhasil reset password.');
    }

    public function delete($id)
    {
        $this->db->transStart(); //Begin Transaction
        $this->userlogin_model->deleteData($id);
        $this->db->transComplete(); //End Transaction

        if($this->db->transStatus() === TRUE)
        {
            return redirect()->to(base_url('userlogin'))->with('success', 'Penghapusan data berhasil.'); 
        }
    }

}