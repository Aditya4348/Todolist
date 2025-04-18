<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\todolist;
use App\Models\tasks;
use Livewire\Component;

// return response()->json(tabel, 200); digunakan untuk mengirim response ke json yang dikirim ke route api


class TodolistManager extends Controller
{


    public function indexapi()
    {
        // menampilkan seluruhb data taks yang diambil dari tabel taks
        $todolist = todolist::all();
        return response()->json($todolist, 200);
    }


    public function indexTaks()
    {
        // menampilkan seluruhb data taks yang diambil dari tabel taks
        $task = tasks::all();
        return response()->json($task, 200);
    }


    public function storeTaskapi(Request $request)
    {

        // memvalidasi todo list yang akan dibuat
        $data = $request->validate([
            'deskripsi' => 'required|string',
            'task_date' => 'required|date',
            'prioritas' => 'required|in:Tinggi,Sedang,Rendah',
            'selesai' => 'required|boolean',
            'todolist_id' => 'required',
        ]);

        //membuat todolist baru setelah validasi menyatakan true 
        tasks::create($data);

        return response()->json([
            'success' => true,
            'messagge' => "list berhasil diupdate",
            'data' => $data
        ], 200);
    }

    public function storeapi(Request $request)
    {

        // memvalidasi todo list yang akan dibuat
        $data = $request->validate([
            'judul' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        //membuat todolist baru setelah validasi menyatakan true 
        todolist::create($data);

        return response()->json([
            'success' => true,
            'messagge' => "list berhasil diupdate",
            'data' => $data
        ], 200);
    }



    public function updateTaks(Request $request, string $id)
    {
        

        // Mencari task berdasarkan ID
        $tasks = tasks::find($request->id);

        // Jika task tidak ditemukan atau false, kembalikan response 404
        if(!$tasks){
            return response()->json([
                'success' => false,
                'message' => "Data gagal diubah",
            ], 404);
        }
        // Validasi request untuk memastikan 'status' ada dan berupa boolean
        $data = $request->validate([
            'status'=> 'required|boolean',
        ]);

        // Update status berdasarkan input
        tasks::update($data);

        return response()->json([
            'success' => true,
            'message' => "Data berhasil diubah",
            'status' => $data['selesai'] ? 'Selesai' : 'Belum Selesai'
        ], 200);
    }




    public function destroy(string $id)
    {
        //mencari data todolist berdasarkan id kemudian dihapus
        todolist::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => "data List berhasil Sihapus"
        ], 200);
    }


    public function destroyTask(string $id)
    {

        //mencari data task berdasarkan id kemudian dihapus
        tasks::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => "data Taks berhasil Dihapus"
        ], 200);
    }
}
