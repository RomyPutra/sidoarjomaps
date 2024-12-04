<?php namespace App\Models;
use CodeIgniter\Model;
 
class Tdistrictsjobs_model extends Model
{
    protected $table = 'districtsjobs';
    protected $primaryKey = 'id';

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
        return $this->db->Table($this->table)->insert($data);
    }

    public function updateData($data, $id)
    {
        return $this->db->Table($this->table)->update($data, [$this->primaryKey => $id]);
    }

    public function deleteData($id, $column = false)
    {
        if ($column !== false) {
            return $this->db->Table($this->table)->delete([$column => $id]);
        } else {
            return $this->db->Table($this->table)->delete([$this->primaryKey => $id]);
        }
    } 
    
    public function getDatabyid($id)
    {
        $scol = array('districtsjobs.id','districtsjobs.district_id','districts.name','districts.alt_name','districtsjobs.thndata','districtsjobs.pekerjaan','districtsjobs.jumlah');
        $this->dt->select($scol);
        $this->dt->join('districts', 'districts.id = districtsjobs.district_id', 'left');
        $this->dt->where('districtsjobs.id', $id);
        $this->dt->orderBy('districts.name', 'ASC');
        $this->dt->orderBy('districts.pekerjaan', 'ASC');
        $query = $this->dt->get();
        return $query->getResult();
    }

    private function getDatatablesQuery($postData=null)
    {
        $scol = array('districtsjobs.id','districtsjobs.district_id','districts.name','districts.alt_name','districtsjobs.thndata','districtsjobs.pekerjaan','districtsjobs.jumlah');
        $order = ['districtsjobs.id' => 'DESC'];
        $this->dt->select($scol);
        $this->dt->join('districts', 'districts.id = districtsjobs.district_id', 'left');

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

    public function countAll($tahun=null)
    {
        $scol = array('districtsjobs.id','districtsjobs.district_id','districts.name','districts.alt_name','districtsjobs.thndata','districtsjobs.pekerjaan','districtsjobs.jumlah');
        $tbl_storage = $this->db->table($this->table)->select($scol)->join('districts', 'districts.id = districtsjobs.district_id', 'left');
        return $tbl_storage->countAllResults();
    }
}
