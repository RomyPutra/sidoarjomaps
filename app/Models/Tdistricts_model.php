<?php namespace App\Models;
use CodeIgniter\Model;
 
class Tdistricts_model extends Model
{
    protected $table = 'districts';
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
        $scol = array('districts.id','regencies.province_id','provinces.name AS province','districts.regency_id','regencies.name AS regency','districts.name','districts.alt_name','districts.latitude','districts.longitude','districts.totall','districts.totalp','districts.totala','districts.luaswil','districts.btsutara','districts.btsbarat','districts.btsselatan','districts.btstimur','districts.thndata');
        $this->dt->select($scol);
        $this->dt->join('regencies', 'regencies.id = districts.regency_id', 'left');;
        $this->dt->join('provinces', 'provinces.id = regencies.province_id', 'left');;
        $this->dt->where('districts.id', $id);
        $this->dt->orderBy('provinces.name', 'ASC');
        $this->dt->orderBy('regencies.name', 'ASC');
        $this->dt->orderBy('districts.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function getPointMaps()
    {
        $scol = array('districts.id','districts.regency_id','districts.name','districts.alt_name','districts.name','districts.latitude','districts.longitude');
        $this->dt->select($scol);

        $query = $this->dt->get();
        return $query->getResult();
    }

    private function getDatatablesQuery($postData=null)
    {
        $scol = array('districts.id','regencies.province_id','provinces.name AS province','districts.regency_id','regencies.name AS regency','districts.name','districts.alt_name','districts.latitude','districts.longitude','districts.totall','districts.totalp','districts.totala','districts.luaswil','districts.btsutara','districts.btsbarat','districts.btsselatan','districts.btstimur','districts.thndata');
        // $order = [];

        $this->dt->select($scol);
        $this->dt->join('regencies', 'regencies.id = districts.regency_id', 'left');;
        $this->dt->join('provinces', 'provinces.id = regencies.province_id', 'left');;

        $search_value = $postData->getPost('search')['value'];

        $i = 0;
        foreach ($scol as $item) {
            $alias = strpos($item, ' AS ') ? explode(' AS ', $item)[0] : $item;
            if ($postData->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($alias, $postData->getPost('search')['value']);
                } else {
                    $this->dt->orLike($alias, $postData->getPost('search')['value']);
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
        } else {
            $this->dt->orderBy('provinces.name', 'ASC');
            $this->dt->orderBy('regencies.name', 'ASC');
            $this->dt->orderBy('districts.name', 'ASC');
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
        $scol = array('districts.id','regencies.province_id','provinces.name AS province','districts.regency_id','regencies.name AS regency','districts.name','districts.alt_name','districts.latitude','districts.longitude','districts.totall','districts.totalp','districts.totala','districts.luaswil','districts.btsutara','districts.btsbarat','districts.btsselatan','districts.btstimur','districts.thndata');
        $this->dt->select($scol);
        $this->dt->join('regencies', 'regencies.id = districts.regency_id', 'left');;
        $this->dt->join('provinces', 'provinces.id = regencies.province_id', 'left');;
        return $this->dt->countAllResults();
    }

}
