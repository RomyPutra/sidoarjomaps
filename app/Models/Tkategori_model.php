<?php namespace App\Models;
use CodeIgniter\Model;
 
class Tkategori_model extends Model
{
    protected $table = 'tbkategori';
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

    public function getJoin()
    {
        $scol = array('MAX(tbkategori.kode) AS kode', 'MAX(tbkategori.kategori) AS kategori', 'COUNT(tbtempat.kd_kat) AS jumlah');
        $this->dt->select($scol);
        $this->dt->join('tbtempat', 'tbtempat.kd_kat = tbkategori.kode', 'left');;
        $this->dt->groupby('tbtempat.kd_kat');
        $query = $this->dt->get();
        return $query->getResult();
    }

    private function getDatatablesQuery($postData=null)
    {
        $scol = array('tbkategori.kode','tbkategori.kategori','tbkategori.images','tbkategori.created_at','tbkategori.updated_at');
        $order = ['tbkategori.kode' => 'DESC'];
        $this->dt->select($scol);
        // $this->dt->join('kategoritest', 'kategoritest.formnumber = tbkategori.formnumber', 'left');;

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
        $scol = array('tbkategori.kode','tbkategori.kategori','tbkategori.images','tbkategori.created_at','tbkategori.updated_at');
        $tbl_storage = $this->db->table($this->table)->select($scol);
        return $tbl_storage->countAllResults();
    }
}
