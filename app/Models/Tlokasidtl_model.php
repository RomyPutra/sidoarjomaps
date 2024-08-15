<?php namespace App\Models;
use CodeIgniter\Model;
 
class Tlokasidtl_model extends Model
{
    protected $table = 'tbdtltempat';
    protected $primaryKey = 'kode';

    protected $dt; // Declare the property
    public function __construct()
    {
        parent::__construct();
        $this->dt = $this->db->table($this->table);
    }

    public function increment()
    {
        $query = $this->selectMax($this->primaryKey)->get()->getResult();
        return $query[0]->kode + 1;
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

    private function getDatatablesQuery($postData=null,$idlokasi=null)
    {
        $scol = array('tbdtltempat.kode','tbkategori.kategori','districts.alt_name','tbtempat.nama','tbtempat.profile','tbdtltempat.dtlimages','tbtempat.created_at','tbtempat.updated_at');
        $order = ['tbtempat.kode' => 'DESC'];

        $this->dt->select($scol);
        $this->dt->join('tbtempat', 'tbtempat.kode = tbdtltempat.kodetempat', 'left');;
        $this->dt->join('tbkategori', 'tbkategori.kode = tbtempat.kd_kat', 'left');;
        $this->dt->join('villages', 'villages.id = tbtempat.kd_desa', 'left');;
        $this->dt->join('districts', 'districts.id = villages.district_id', 'left');;
        $this->dt->where('tbdtltempat.kodetempat', $idlokasi);

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

    public function getDatatables($postData=null,$idlokasi=null)
    {
        $this->getDatatablesQuery($postData, $idlokasi);
        if ($postData->getPost('length') != -1)
            $this->dt->limit($postData->getPost('length'), $postData->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered($postData=null,$idlokasi=null)
    {
        $this->getDatatablesQuery($postData, $idlokasi);
        return $this->dt->countAllResults();
    }

    public function countAll($idlokasi=null)
    {
        $scol = array('tbdtltempat.kode','tbkategori.kategori','districts.alt_name','tbtempat.nama','tbtempat.profile','tbdtltempat.dtlimages','tbtempat.created_at','tbtempat.updated_at');
        $this->dt->select($scol);
        $this->dt->join('tbtempat', 'tbtempat.kode = tbdtltempat.kodetempat', 'left');;
        $this->dt->join('tbkategori', 'tbkategori.kode = tbtempat.kd_kat', 'left');;
        $this->dt->join('villages', 'villages.id = tbtempat.kd_desa', 'left');;
        $this->dt->join('districts', 'districts.id = villages.district_id', 'left');;
        $this->dt->where('tbdtltempat.kodetempat', $idlokasi);
        return $this->dt->countAllResults();
    }
}
