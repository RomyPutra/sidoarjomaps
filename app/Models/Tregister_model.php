<?php namespace App\Models;
use CodeIgniter\Model;
 
class Tregister_model extends Model
{
    protected $table = 'tregister';
    protected $primaryKey = 'internalid';

    protected $dt; // Declare the property
    public function __construct()
    {
        parent::__construct();
        $this->dt = $this->db->table($this->table);
    }

    public function increment()
    {
        $query = $this->selectMax($this->primaryKey)->get()->getResult();
        return $query[0]->internalid + 1;
    }

    public function getFormnumber($gelombang)
    {
        $query = $this->selectMax('formnumber')->get()->getResult();
        // log_message('info', 'getFormnumber: '.$this->db->getLastQuery());
        $thn = date("y");
        $tahun = substr($query[0]->formnumber, 0, 2);
        $tmp = substr($query[0]->formnumber, 3, 5);
        if ($tahun == $thn) {
            $urut = $tmp + 1;
        } else {
            $urut = 1;
        }
        $nomor = $thn."".$gelombang."".sprintf("%05s", $urut);
        // log_message('info', 'nomor: '.$nomor);
        return $nomor;
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
        return $this->db->Table($this->table)->insert($data);
    }

    public function updateData($data, $id)
    {
        return $this->db->Table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteData($id)
    {
        return $this->db->Table($this->table)->delete([$this->primaryKey => $id]);
    } 

    private function getDtQueryGroup($postData=null)
    {
        $scol = array('tregister.joinyear', 'COUNT(tregister.internalid) as members');
        $order = ['tregister.joinyear' => 'DESC'];

        // log_message('info', 'getDatatablesQuery: '.print_r($postData->getPost(), TRUE));
        $this->dt->select($scol);
        $this->dt->groupBy('tregister.joinyear');
        $this->dt->like('tregister.joinyear', $postData->getPost('search')['value']);
        $this->dt->orderBy(key($order), $order[key($order)]);
    }

    public function getDtGroup($postData=null)
    {
        $this->getDtQueryGroup($postData);
        if ($postData->getPost('length') != -1)
            $this->dt->limit($postData->getPost('length'), $postData->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFilteredGroup($postData=null)
    {
        $this->getDtQueryGroup($postData);
        $result = $this->dt->get();
        return $result->resultID->num_rows;
    }

    public function countAllGroup()
    {
        $scol = array('tregister.joinyear', 'COUNT(tregister.internalid) as members');
        $order = ['tregister.joinyear' => 'DESC'];

        $this->dt = $this->db->table($this->table);
        $this->dt->select($scol);
        $this->dt->groupBy('tregister.joinyear');
        $result = $this->dt->get();
        return $result->resultID->num_rows;
    }

    private function getDatatablesQuery($postData=null, $tahun=null)
    {
        $scol = array('tregister.internalid','tregister.formnumber','tregister.nisn','tregister.joinyear','tregister.fullname','tregistertest.score_total','tregistertest.test_status');
        $order = ['tregister.internalid' => 'DESC'];

        $this->dt->select($scol);
        $this->dt->join('tregistertest', 'tregistertest.formnumber = tregister.formnumber', 'left');;
        if ($tahun)
        {
            $this->dt->where('tregister.joinyear', $tahun);
        }

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

    public function getDatatables($postData=null, $tahun=null)
    {
        $this->getDatatablesQuery($postData, $tahun);
        if ($postData->getPost('length') != -1)
            $this->dt->limit($postData->getPost('length'), $postData->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered($postData=null, $tahun=null)
    {
        $this->getDatatablesQuery($postData, $tahun);
        return $this->dt->countAllResults();
    }

    public function countAll($tahun=null)
    {
        $scol = array('tregister.internalid','tregister.formnumber','tregister.nisn','tregister.joinyear','tregister.fullname','tregistertest.score_total','tregistertest.test_status');
        $tbl_storage = $this->db->table($this->table)->select($scol)->join('tregistertest', 'tregistertest.formnumber = tregister.formnumber', 'left')->where('tregister.joinyear', $tahun);
        return $tbl_storage->countAllResults();
    }
}
