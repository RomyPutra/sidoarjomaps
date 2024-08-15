<?php namespace App\Controllers;
 
use App\Models\Auth_model;
 
class Auth extends BaseController
{
    protected $auth_model;

    public function __construct()
    {
        helper(['form']);
        $this->cek_login();
        $this->auth_model = new Auth_model();
    }
    
    public function index()
    {
        if($this->cek_login() == TRUE){
            return redirect()->to(base_url('/home'));
        }
        echo view('auth/login');
    }

    public function login()
    {
        if($this->cek_login() == TRUE){
            return redirect()->to(base_url('/home'));
        }
        echo view('auth/login');
    }

    public function proses_login()
    {
        $validation =  \Config\Services::validation();

        $email  = $this->request->getPost('email');
        $pass   = $this->request->getPost('password');

        $data = [
            'email' => $email,
            'password' => $pass
        ]; 

        if($validation->run($data, 'authlogin') == FALSE){
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('/auth/login'))->withInput();
        } else {

            $cek_login = $this->auth_model->cek_login($email);
            // $cek_enum = $this->auth_model->get_enum_values('users','level');

            // log_message('info', 'Enum: '.print_r($cek_enum, TRUE));
            // log_message('info', 'Login: '.print_r($cek_login, TRUE));
            // log_message('info', 'Login: '.$cek_login->password);
            // email didapatkan
            if($cek_login == TRUE){

                // log_message('info', 'Login: '.print_r($cek_login, TRUE));
                // jika email dan password cocok
                if(password_verify($pass, $cek_login['password']))
                {
                    $cisession = $this->db->table('ci_sessions')->where('userid', $cek_login['id'])->get()->getResult();
                    log_message('info', 'cisession: '.print_r($cisession, TRUE));
                    if ($cisession && $cisession[0]->status == 1)
                    {
                        session()->setFlashdata('errors', ['' => 'User '.$cek_login['email'].' sedang login pada device lain.']);
                        return redirect()->to(base_url('/auth/login'))->withInput();
                    }
                    else
                    {
                        session()->set('id', $cek_login['id']);
                        session()->set('email', $cek_login['email']);
                        session()->set('name', $cek_login['name']);
                        session()->set('level', $cek_login['level']);
                        session()->set('status', $cek_login['status']);
                        session()->set('pic', $cek_login['picture']);
                        if ($cek_login['referenceid'] !== null && trim($cek_login['referenceid']) !== '')
                        {
                            session()->set('refid', $cek_login['referenceid']);
                        }
                        // $datalogin = [
                        //     'login' => 1
                        // ]; 
                        // $this->auth_model->updateData($datalogin, $cek_login['id']);
                        // session()->set('login', '1');
                        
                        return redirect()->to(base_url('home'));          
                        // return redirect()->to(base_url('/uploads'));
                    }
                // email cocok, tapi password salah
                } else {
                    session()->setFlashdata('errors', ['' => 'Password yang Anda masukan salah']);
                    return redirect()->to(base_url('/auth/login'))->withInput();
                }
            } else {
                // email tidak cocok / tidak terdaftar
                session()->setFlashdata('errors', ['' => 'Email yang Anda masukan tidak terdaftar']);
                return redirect()->to(base_url('auth/login'))->withInput();
            }
        }
    }

    public function register()
    {
        if($this->cek_login() == TRUE){
            return redirect()->to(base_url('home'));
        }
        return view('auth/register');
    }

    public function proses_register()
    {
        $validation =  \Config\Services::validation();

        $data = [
            'id'                => $this->auth_model->increment(),
            'email'             => $this->request->getPost('email'),
            'name'              => $this->request->getPost('name'),
            'username'          => $this->request->getPost('username'),
            'password'          => $this->request->getPost('password'),
            'confirm_password'  => $this->request->getPost('confirm_password')
        ];

        if($validation->run($data, 'authregister') == FALSE){
            session()->setFlashdata('errors', $validation->getErrors());
            session()->setFlashdata('inputs', $this->request->getPost());
            return redirect()->to(base_url('auth/register'));
        } else {

            $datalagi = [
                'email'         => $this->request->getPost('email'),
                'name'          => $this->request->getPost('name'),
                'username'      => $this->request->getPost('username'),
                'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'status'        => "Active",
                'level'         => "Admin"
            ];

            // $simpan = $this->auth_model->register($datalagi);
            $simpan = $this->auth_model->save($datalagi, NULL);

            if($simpan){
                session()->setFlashdata('success_register', 'Register Successfully');
                return redirect()->to(base_url('auth/login'));
            }

        }

    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('home'));
        // return redirect()->to(base_url('auth/login'));
    }
}