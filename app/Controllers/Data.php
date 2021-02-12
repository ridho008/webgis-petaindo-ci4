<?php

namespace App\Controllers;

class Data extends BaseController
{
   public function __construct()
   {
      helper('form');
   }

	public function index()
	{
      $dataModel = new \App\Models\DataModel();
      $page = 1;
      $keyword = '';
      // $currentPage = $this->request->getVar('page_kode_wilayah') ? $this->request->getVar('page_kode_wilayah') : 1;

      if($this->request->getPost('keyword')) {
         $keyword = $this->request->getPost('keyword');
      }

      if($this->request->getGet()) {
         $page = $this->request->getGet('page');
      }

      $perPage = 10;
      $limit = $perPage;
      $offset = ($page - 1) * $perPage;
      $data = $dataModel->joinDataToMaster($limit, $offset, $keyword);
      $total = $dataModel->countDataToMaster($keyword);
		return view('data/index', [
         'data' => $data,
         'perPage' => $perPage,
         'page' => $page,
         'offset' => $offset,
         'total' => $total
      ]);
	}

   public function import()
   {
      if($this->request->getPost()) {
         $fileName = $this->request->getFile('csv');

         if($fileName->getSize() > 0) {
            $file = fopen($fileName, 'r');
            $modelMasterData = new \App\Models\MasterDataModel();
            $dataMaster = [
               'nama' => $this->request->getPost('nama')
            ];

            $modelMasterData->save($dataMaster);
            $id_master_data = $modelMasterData->insertID();

            $modelData = new \App\Models\DataModel();
            $builder = $modelData->builder();

            $data = [];

            while (!feof($file)) {
               $column = fgetcsv($file, 1000, ';');

               $kode_wilayah = $column[0];
               $nilai = $column[1];

               $row = [
                  'id_master_data' => $id_master_data,
                  'kode_wilayah' => $kode_wilayah,
                  'nilai' => $nilai
               ];

               array_push($data, $row);
            }

            $builder->insertBatch($data);
            fclose($file);
         }

         return redirect()->to('/data');
      }
      return view('data/import');
   }
}
