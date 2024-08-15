<?php namespace App\Models;
// use App\Models\My_model;
// class Auth_model extends My_model

use CodeIgniter\Model;
class Auth_model extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    // protected $orderby = 'id';
    // protected $primaryKey = 'id';
    // protected $_primary_filter = 'intval';
    // protected $_timestamps = FALSE;
    // public $rules = array(
    //       'no_transaksi' => array(
    //       'field' => 'nota',
    //       'label' => 'Harus Diisi ',
    //       'rules' => 'trim|required'
    //     )
    // );

    // function __construct ()
    // {
    //     parent::__construct();
    // }
    protected $dt; // Declare the property
    public function __construct()
    {
        parent::__construct();
        $this->dt = $this->db->table($this->table);
    }

    public function increment()
    {
        $query = $this->selectMax($this->primaryKey)->get()->getResult();
        return $query[0]->id + 1;
    }

    public function getData($id = false, $column = false)
    {
        if($id === false) {
            $data = $this->findAll();
        } elseif($column !== false) {
            $data = $this->getWhere([$column => $id])->getResult();
        } else {
            $data = $this->getWhere([$this->primaryKey => $id])->getResult();
        }  
        return $data;
    }
 
    public function insertData($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateData($data, $id)
    {
        $result = $this->db->Table($this->table)->update($data, [$this->primaryKey => $id]);
        return $result;
    }
 
    public function deleteData($id)
    {
        return $this->db->Table($this->table)->delete([$this->primaryKey => $id]);
    } 

    public function cek_login($email)
    {
        // $query = $this->table($this->table)->where('email', $email)->countAll();
        // log_message('info', 'Auth: '.$this->db->getLastQuery());
        $query = $this->table('users')
                ->where('email', $email)
                ->countAll();

        if($query >  0){
            // $hasil = $this->table($this->table)->where('email', $email)->limit(1)->get(NULL, TRUE);
            // log_message('info', 'Auth: '.$this->db->getLastQuery());
            $hasil = $this->table('users')
                    ->where('email', $email)
                    ->limit(1)
                    ->get()
                    ->getRowArray();
        } else {
            $hasil = array(); 
        }
        return $hasil;
    }

    public function register($data)
    {
        return $this->db->table($this->table)->insert($data);
    }


    private function getDatatablesQuery($postData=null)
    {
        $scol = array('users.id','users.username','users.name','users.email','users.password','users.picture','users.signature','users.status','users.level','users.referenceid');
        $order = ['users.id' => 'DESC'];

        // log_message('info', 'getDatatablesQuery: '.print_r($postData->getPost(), TRUE));
        $this->dt = $this->db->table($this->table);
        $this->dt->select($scol);
        $this->dt->where('users.id != 0');

        $i = 0;
        foreach ($scol as $item) {
            if ($postData->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $postData->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $postData->getPost('search')['value']);
                }
                if (count($scol) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($postData->getPost('order')) {
            $this->dt->orderBy($scol[$postData->getPost('order')['0']['column']], $postData->getPost('order')['0']['dir']);
        } else if (isset($order)) {
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    public function getDatatables($postData=null)
    {
        $this->getDatatablesQuery($postData);
        if ($postData->getPost('length') != -1)
            $this->dt->limit($postData->getPost('length'), $postData->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered($postData=null)
    {
        $this->getDatatablesQuery($postData);
        return $this->dt->countAllResults();
    }

    public function countAll()
    {
        $scol = array('users.id','users.username','users.name','users.email','users.password','users.picture','users.signature','users.status','users.level','users.referenceid');
        $this->dt = $this->db->table($this->table);
        $this->dt->select($scol);
        $this->dt->where('users.id != 0');
        return $this->dt->countAllResults();
    }

}?>