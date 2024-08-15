<?php namespace App\Models;
use CodeIgniter\Model;
 
class Tregencies_model extends Model
{
    protected $table = 'regencies';
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

    public function getPointMaps()
    {
        $scol = array('regencies.id','regencies.province_id','regencies.name','regencies.alt_name','regencies.name','regencies.latitude','regencies.longitude');
        $this->dt->select($scol);

        $query = $this->dt->get();
        return $query->getResult();
    }
}
