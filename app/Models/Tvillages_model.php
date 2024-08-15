<?php namespace App\Models;
use CodeIgniter\Model;
 
class Tvillages_model extends Model
{
    protected $table = 'villages';
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

    private function getDatatablesQuery($postData=null)
    {
        $scol = array('villages.id','provinces.name AS province','regencies.name AS regency','districts.name AS district','villages.name','villages.alt_name','villages.latitude','villages.longitude');
        $order = ['villages.id' => 'DESC'];

        $this->dt->select($scol);
        $this->dt->join('districts', 'districts.id = villages.district_id', 'left');;
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
        $scol = array('villages.id','provinces.name','regencies.name','districts.name','villages.name','villages.alt_name','villages.latitude','villages.longitude');
        $this->dt->select($scol);
        $this->dt->join('districts', 'districts.id = villages.district_id', 'left');;
        $this->dt->join('regencies', 'regencies.id = districts.regency_id', 'left');;
        $this->dt->join('provinces', 'provinces.id = regencies.province_id', 'left');;
        return $this->dt->countAllResults();
    }
}
