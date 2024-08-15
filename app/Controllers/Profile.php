<?php namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use App\Models\Auth_model;

class Profile extends BaseController
{
    protected $helper = [];

    public function __construct()
    {
        $this->auth_model = new Auth_model();
	}
    
    public function index()
    {
    	$profile = $this->auth_model->getData(session('id'));
        $data['profil'] = $profile[0];
        // log_message('info', 'profile: '.print_r($data, TRUE));
        $data['subview'] = 'profile/index';
        $data['jscript'] = 'profile/js';
        return view('main_layout', $data);
    }

    public function changename()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $validation = $this->validate([
            'user_name' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Password wajib diisi.', 
                ], 
            ],
            'nama_profil' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Password wajib diisi.', 
                ], 
            ],
        ]);

        if (!$validation) {
            $data['validation'] =  Services::validation();

            $profile = $this->auth_model->getData(session('id'));
            $data['profil'] = $profile[0];
            $data['profil']->user_name = $this->request->getPost('user_name');
            $data['profil']->nama_profil = $this->request->getPost('nama_profil');
            // log_message('info', 'profile: '.print_r($data, TRUE));
            $data['subview'] = 'profile/index';
            $data['jscript'] = 'profile/js';
            return view('main_layout', $data);
        }

		$data = array (
			'username' => $this->request->getPost('user_name'),
			'name' => $this->request->getPost('nama_profil')
		);
		$this->auth_model->updateData($data, session('id'));
        // log_message('info', 'updateName: '.$this->db->getLastQuery());

    	$profile = $this->auth_model->getData(session('id'));
        $data['profil'] = $profile[0];
        $data['subview'] = 'profile/index';
        $data['jscript'] = 'profile/js';
        return view('main_layout', $data);
    }

    public function changepass()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();
        
		$data = array (
			'password' => password_hash($this->request->getPost('pass'), PASSWORD_DEFAULT),
		);
		$this->auth_model->updateData($data, session('id'));
        // log_message('info', 'updatePass: '.$this->db->getLastQuery());

        session()->setFlashdata('change_password', 'Pembaharuan password berhasil.');
        return redirect()->to(base_url('auth/login'));
    }

    public function changepic()
    {
        $validation = $this->validate([
            'filefoto' => [
                'rules' => 'uploaded[filefoto]|max_size[filefoto,5000]', 
                'errors' => [
                    'uploaded'  => 'Pilih file profile terlebih dahulu.',
                    'max_size'  => 'Ukuran file maksimal 5Mb.',
                ], 
            ],
        ]);

        if (!$validation)
        {
            $profile = $this->auth_model->getData(session('id'));
            $data['profil'] = $profile[0];
            $data['validation'] =  Services::validation();
            $data['subview'] = 'profile/index';
            $data['jscript'] = 'profile/js';
            return view('main_layout', $data);
        }

        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

    	$profile = $this->auth_model->getData(session('id'));
        $basepath = ROOTPATH.'public/uploads/profile/'; 
        $oldpic = $basepath.$profile[0]->picture;
        // log_message('info', 'oldPic: '.$oldpic);
    	if (file_exists($oldpic))
    	{
    		unlink($oldpic);
    	}

        $filefoto = $this->request->getFile('filefoto');
        $profilepic = $filefoto->getRandomName();
		$data = array (
			'picture' => $profilepic,
		);
        $filefoto->move(ROOTPATH.'public/uploads/profile', $profilepic);
		$this->auth_model->updateData($data, session('id'));
        // log_message('info', 'updatePic: '.$this->db->getLastQuery());

    	$profile = $this->auth_model->getData(session('id'));
        $data['profil'] = $profile[0];
        $data['subview'] = 'profile/index';
        $data['jscript'] = 'profile/js';
        return view('main_layout', $data);
    }

    public function changesign()
    {
        $validation = $this->validate([
            'filesign' => [
                'rules' => 'uploaded[filesign]|max_size[filesign,5000]', 
                'errors' => [
                    'uploaded'  => 'Pilih file tanda tangan terlebih dahulu.',
                    'max_size'  => 'Ukuran file maksimal 5Mb.',
                ], 
            ],
        ]);

        if (!$validation)
        {
            $profile = $this->auth_model->getData(session('id'));
            $data['profil'] = $profile[0];
            $data['validation'] =  Services::validation();
            $data['subview'] = 'profile/index';
            $data['jscript'] = 'profile/js';
            return view('main_layout', $data);
        }

        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $profile = $this->auth_model->getData(session('id'));
        $basepath = ROOTPATH.'public/uploads/signature/'; 
        $oldpic = $basepath.$profile[0]->signature;
        // log_message('info', 'oldPic: '.$oldpic);
        if ($oldpic != $basepath && file_exists($oldpic))
        {
            unlink($oldpic);
        }

        $filesign = $this->request->getFile('filesign');
        $profilesign = $filesign->getRandomName();
        $data = array (
            'signature' => $profilesign,
        );
        $filesign->move(ROOTPATH.'public/uploads/signature', $profilesign);
        $this->auth_model->updateData($data, session('id'));
        // log_message('info', 'updatePic: '.$this->db->getLastQuery());

        $profile = $this->auth_model->getData(session('id'));
        $data['profil'] = $profile[0];
        $data['subview'] = 'profile/index';
        $data['jscript'] = 'profile/js';
        return view('main_layout', $data);
    }

}
