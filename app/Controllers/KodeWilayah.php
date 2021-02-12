<?php

namespace App\Controllers;

class KodeWilayah extends BaseController
{
   public function __construct()
   {
      helper('form');
   }

	public function index()
	{
      $model = new \App\Models\KodeWilayahModel();
      // $kode_wilayah = $model->findAll();
      $currentPage = $this->request->getVar('page_kode_wilayah') ? $this->request->getVar('page_kode_wilayah') : 1;

      if($this->request->getPost('keyword')) {
         $kode_wilayah = $model->like('nama_wilayah', $this->request->getPost('keyword'))->orLike('kode_wilayah', $this->request->getPost('keyword'));
      } else {
         $kode_wilayah = $model;
      }

		return view('kode-wilayah/index', [
         'kode_wilayah' => $kode_wilayah->paginate(10, 'kode_wilayah'),
         'pager' => $model->pager,
         'currentPage' => $currentPage
      ]);
	}

   public function import()
   {
      if($this->request->getPost()) {
         $fileName = $this->request->getFile('csv');

         if($fileName->getSize() > 0) {
            $file = fopen($fileName, 'r');
            $model = new \App\Models\KodeWilayahModel();
            $builder = $model->builder();

            $data = [];

            while (!feof($file)) {
               $column = fgetcsv($file, 1000, ';');

               $kode_wilayah = $column[0];
               $nama_wilayah = $column[1];

               $row = [
                  'kode_wilayah' => $kode_wilayah,
                  'nama_wilayah' => $nama_wilayah
               ];

               array_push($data, $row);
            }

            $builder->insertBatch($data);
            fclose($file);
         }

         return redirect()->to('/kodeWilayah');
      }
      return view('kode-wilayah/import');
   }
}
