<?php namespace App\Models;
use CodeIgniter\Model;
 
class Tlokasi_model extends Model
{
    protected $table = 'tbtempat';
    protected $primaryKey = 'kode';

    protected $dt; // Declare the property
    protected $dtx; // Declare the property
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

    public function getPointbyid($id)
    {
        $scol = array('tbtempat.kode','tbtempat.kd_kat','tbkategori.kategori','tbkategori.images','tbtempat.kd_desa','districts.alt_name','tbtempat.nama','tbtempat.images AS gambar','tbtempat.profile','tbtempat.latitude','tbtempat.longitude','tbtempat.alamat','tbtempat.namacp','tbtempat.nomorcp','tbtempat.template','tbtempat.created_at','tbtempat.updated_at','districts.name');
        $this->dt->select($scol);
        $this->dt->join('tbkategori', 'tbkategori.kode = tbtempat.kd_kat', 'left');;
        $this->dt->join('villages', 'villages.id = tbtempat.kd_desa', 'left');;
        $this->dt->join('districts', 'districts.id = villages.district_id', 'left');;
        $this->dt->where('tbtempat.kode', $id);

        $query = $this->dt->get();
        return $query->getResult();
    }

    public function getPointDetails($id)
    {
        $scol = array('tbdtltempat.kode','tbdtltempat.kodetempat','tbdtltempat.dtlimages','tbdtltempat.created_at','tbdtltempat.updated_at');
        $this->dt->select($scol);
        $this->dt->join('tbdtltempat', 'tbdtltempat.kodetempat = tbtempat.kode', 'left');;
        $this->dt->where('tbtempat.kode', $id);

        $query = $this->dt->get();
        return $query->getResult();
    }

    public function getPointMaps()
    {
        $scol = array('tbtempat.kode','tbtempat.kd_kat','tbkategori.kategori','tbkategori.images','tbtempat.kd_desa','districts.alt_name','tbtempat.nama','tbtempat.images AS gambar','tbtempat.profile','tbtempat.latitude','tbtempat.longitude','tbtempat.alamat','tbtempat.namacp','tbtempat.nomorcp','tbtempat.template','districts.totall','districts.totalp','districts.totala','districts.luaswil','districts.btsutara','districts.btsbarat','districts.btsselatan','districts.btstimur','districts.thndata','tbtempat.created_at','tbtempat.updated_at','districts.name');
        $this->dt->select($scol);
        $this->dt->join('tbkategori', 'tbkategori.kode = tbtempat.kd_kat', 'left');;
        $this->dt->join('villages', 'villages.id = tbtempat.kd_desa', 'left');;
        $this->dt->join('districts', 'districts.id = villages.district_id', 'left');;

        $query = $this->dt->get();
        return $query->getResult();
    }

    public function getMapsbykategori($id=0)
    {
        $scol = array('tbtempat.kode','tbtempat.kd_kat','tbkategori.kategori','tbkategori.images','tbtempat.kd_desa','districts.alt_name','tbtempat.nama','tbtempat.images AS gambar','tbtempat.profile','tbtempat.latitude','tbtempat.longitude','tbtempat.created_at','tbtempat.updated_at','districts.latitude as deslat','districts.longitude as deslng','tbtempat.alamat','tbtempat.namacp','tbtempat.nomorcp','tbtempat.template','districts.totall','districts.totalp','districts.totala','districts.luaswil','districts.btsutara','districts.btsbarat','districts.btsselatan','districts.btstimur','districts.thndata','districts.name');
        $this->dt->select($scol);
        $this->dt->join('tbkategori', 'tbkategori.kode = tbtempat.kd_kat', 'left');;
        $this->dt->join('villages', 'villages.id = tbtempat.kd_desa', 'left');;
        $this->dt->join('districts', 'districts.id = villages.district_id', 'left');;
        $this->dt->where('tbtempat.kd_kat', $id);

        $query = $this->dt->get();
        return $query->getResult();
    }

    public function getMapsbyvillages($id=0)
    {
        $scol = array('tbtempat.kode','tbtempat.kd_kat','tbkategori.kategori','tbkategori.images','tbtempat.kd_desa','districts.alt_name','tbtempat.nama','tbtempat.images AS gambar','tbtempat.profile','tbtempat.latitude','tbtempat.longitude','tbtempat.created_at','tbtempat.updated_at','districts.latitude as deslat','districts.longitude as deslng','tbtempat.alamat','tbtempat.namacp','tbtempat.nomorcp','tbtempat.template','districts.totall','districts.totalp','districts.totala','districts.luaswil','districts.btsutara','districts.btsbarat','districts.btsselatan','districts.btstimur','districts.thndata','districts.name');
        $this->dt->select($scol);
        $this->dt->join('tbkategori', 'tbkategori.kode = tbtempat.kd_kat', 'left');;
        $this->dt->join('villages', 'villages.id = tbtempat.kd_desa', 'left');;
        $this->dt->join('districts', 'districts.id = villages.district_id', 'left');;
        // $this->dt->where('tbtempat.kd_desa', $id);
        $this->dt->where('districts.id', $id);

        $query = $this->dt->get();
        return $query->getResult();
    }

    public function getMapsbykatkec($idkat=0,$idkec=0)
    {
        $scol = array('tbtempat.kode','tbtempat.kd_kat','tbkategori.kategori','tbkategori.images','tbtempat.kd_desa','districts.alt_name','tbtempat.nama','tbtempat.images AS gambar','tbtempat.profile','tbtempat.latitude','tbtempat.longitude','tbtempat.created_at','tbtempat.updated_at','districts.latitude as deslat','districts.longitude as deslng','tbtempat.alamat','tbtempat.namacp','tbtempat.nomorcp','tbtempat.template','districts.totall','districts.totalp','districts.totala','districts.luaswil','districts.btsutara','districts.btsbarat','districts.btsselatan','districts.btstimur','districts.thndata','districts.name');
        $this->dt->select($scol);
        $this->dt->join('tbkategori', 'tbkategori.kode = tbtempat.kd_kat', 'left');;
        $this->dt->join('villages', 'villages.id = tbtempat.kd_desa', 'left');;
        $this->dt->join('districts', 'districts.id = villages.district_id', 'left');;
        $this->dt->where('tbtempat.kd_kat', $idkat);
        $this->dt->where('districts.id', $idkec);

        $query = $this->dt->get();
        return $query->getResult();
    }

    public function getMapskatvillages($id=0)
    {
        // Subquery to count occurrences of each kd_kat
        $subqueryBuilder = $this->db->table('tbtempat');
        $subqueryBuilder->select('kd_kat, COUNT(kd_kat) AS count', false);
        $subqueryBuilder->join('villages', 'villages.id = tbtempat.kd_desa', 'left');
        $subqueryBuilder->join('districts', 'districts.id = villages.district_id', 'left');
        if ($id!=0) {
            $subqueryBuilder->where('districts.id', $id);
            $subqueryBuilder->orWhere('districts.id IS NULL', null, false);
        }
        $subqueryBuilder->groupBy('kd_kat');
        $subquery = $subqueryBuilder->getCompiledSelect();

        $scol = array('tbkategori.kode','tbkategori.kategori','COALESCE(kd_kat_counts.count, 0) AS count');
        $this->dtx = $this->db->table('tbkategori');
        $this->dtx->select($scol);
        $this->dtx->join("($subquery) AS kd_kat_counts", 'tbkategori.kode = kd_kat_counts.kd_kat', 'left');
        $this->dtx->groupBy('tbkategori.kode');

        $query = $this->dtx->get();
        return $query->getResult();
    }

    public function getMapsvillages($id)
    {
        // Subquery to count occurrences of each kd_kat
        $subqueryBuilder = $this->db->table('tbtempat');
        $subqueryBuilder->select('kd_kat, COUNT(*) AS count', false);
        $subqueryBuilder->join('villages', 'villages.id = tbtempat.kd_desa', 'left');
        $subqueryBuilder->join('districts', 'districts.id = villages.district_id', 'left');
        $subqueryBuilder->where('districts.id', $id);
        $subqueryBuilder->orWhere('districts.id IS NULL', null, false);
        $subqueryBuilder->groupBy('kd_kat');
        $subquery = $subqueryBuilder->getCompiledSelect();

        // Main query to get detailed information along with the count
        $this->dtx = $this->db->table('tbkategori');
        $scol = array('tbkategori.kode','tbkategori.kategori','tbkategori.images','tbtempat.kd_desa','districts.id','districts.alt_name','tbtempat.nama','tbtempat.images AS gambar','tbtempat.profile','tbtempat.latitude','tbtempat.longitude','tbtempat.created_at','tbtempat.updated_at','districts.latitude AS deslat','districts.longitude AS deslng','tbtempat.alamat','tbtempat.namacp','tbtempat.nomorcp','tbtempat.template','districts.totall','districts.totalp','districts.totala','districts.luaswil','districts.btsutara','districts.btsbarat','districts.btsselatan','districts.btstimur','districts.thndata','COALESCE(kd_kat_counts.count, 0) AS jumlah','districts.name');
        $this->dtx->select($scol);
        $this->dtx->join('tbtempat', 'tbkategori.kode = tbtempat.kd_kat', 'left');
        $this->dtx->join('villages', 'villages.id = tbtempat.kd_desa', 'left');
        $this->dtx->join('districts', 'districts.id = villages.district_id', 'left');
        $this->dtx->join("($subquery) AS kd_kat_counts", 'tbtempat.kd_kat = kd_kat_counts.kd_kat', 'left');
        $this->dtx->where('districts.id', $id);
        $this->dtx->orWhere('districts.id IS NULL', NULL, FALSE);
        
        $query = $this->dtx->get();
        return $query->getResult();
    }

    public function getMapsbyobject($obj)
    {
        $scol = array('tbtempat.kode','tbtempat.kd_kat','tbkategori.kategori','tbkategori.images','tbtempat.kd_desa','districts.alt_name','tbtempat.nama','tbtempat.images AS gambar','tbtempat.profile','tbtempat.latitude','tbtempat.longitude','tbtempat.created_at','tbtempat.updated_at','districts.latitude as deslat','districts.longitude as deslng','tbtempat.alamat','tbtempat.namacp','tbtempat.nomorcp','tbtempat.template','districts.totall','districts.totalp','districts.totala','districts.luaswil','districts.btsutara','districts.btsbarat','districts.btsselatan','districts.btstimur','districts.thndata','districts.name');
        $this->dt->select($scol);
        $this->dt->join('tbkategori', 'tbkategori.kode = tbtempat.kd_kat', 'left');;
        $this->dt->join('villages', 'villages.id = tbtempat.kd_desa', 'left');;
        $this->dt->join('districts', 'districts.id = villages.district_id', 'left');;
        $this->dt->where('tbtempat.nama', $obj);

        $query = $this->dt->get();
        return $query->getResult();
    }

    private function getDatatablesQuery($postData=null)
    {
        $scol = array('tbtempat.kode','tbtempat.kd_kat','tbkategori.kategori','tbkategori.images','tbtempat.kd_desa','districts.alt_name','tbtempat.nama','tbtempat.images AS gambar','tbtempat.profile','tbtempat.latitude','tbtempat.longitude','tbtempat.alamat','tbtempat.namacp','tbtempat.nomorcp','tbtempat.template','districts.totall','districts.totalp','districts.totala','districts.luaswil','districts.btsutara','districts.btsbarat','districts.btsselatan','districts.btstimur','districts.thndata','tbtempat.created_at','tbtempat.updated_at','districts.name');
        $order = ['tbtempat.kode' => 'DESC'];

        $this->dt->select($scol);
        $this->dt->join('tbkategori', 'tbkategori.kode = tbtempat.kd_kat', 'left');;
        $this->dt->join('villages', 'villages.id = tbtempat.kd_desa', 'left');;
        $this->dt->join('districts', 'districts.id = villages.district_id', 'left');;

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
        $scol = array('tbtempat.kode','tbtempat.kd_kat','tbkategori.kategori','tbkategori.images','tbtempat.kd_desa','districts.alt_name','tbtempat.nama','tbtempat.images AS gambar','tbtempat.profile','tbtempat.latitude','tbtempat.longitude','tbtempat.alamat','tbtempat.namacp','tbtempat.nomorcp','tbtempat.template','districts.totall','districts.totalp','districts.totala','districts.luaswil','districts.btsutara','districts.btsbarat','districts.btsselatan','districts.btstimur','districts.thndata','tbtempat.created_at','tbtempat.updated_at','districts.name');
        $this->dt->select($scol);
        $this->dt->join('tbkategori', 'tbkategori.kode = tbtempat.kd_kat', 'left');;
        $this->dt->join('villages', 'villages.id = tbtempat.kd_desa', 'left');;
        $this->dt->join('districts', 'districts.id = villages.district_id', 'left');;
        return $this->dt->countAllResults();
    }
}
