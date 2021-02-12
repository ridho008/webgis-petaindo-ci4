<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
   protected $table = 'data';
   protected $primaryKey = 'id';
   protected $allowedFields = ['id', 'id_master_data', 'kode_wilayah', 'nilai'];
   protected $returnType = '\App\Entities\Data';
   protected $useTimestamps = false;

   public function joinDataToMaster($limit, $offset, $keyword)
   {
      return $this->db->table('data')
                      ->select('*')
                      ->join('master_data', 'master_data.id = data.id_master_data')
                      ->join('kode_wilayah', 'kode_wilayah.kode_wilayah = data.kode_wilayah')
                      ->like('data.kode_wilayah', $keyword)
                      ->orLike('nilai', $keyword)
                      ->orderBy('data.id_master_data', 'asc')
                      ->get($limit, $offset)->getResult();
   }

   public function countDataToMaster($keyword)
   {
      return $this->db->table('data')
                      ->select('*')
                      ->join('master_data', 'master_data.id = data.id_master_data')
                      ->join('kode_wilayah', 'kode_wilayah.kode_wilayah = data.kode_wilayah')
                      ->like('data.kode_wilayah', $keyword)
                      ->orLike('nilai', $keyword)
                      ->orderBy('data.id_master_data', 'asc')
                      ->countAllResults();
   }
}