<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\todolist;
use App\Models\tasks;
use Livewire\Component;

/**
 * @OA\Info(
 *      title="API Dokumentasi Milik Torin",
 *      version ="9.0.1",
 *      description = "Dokumentasi APi Menggunakan Swagger "
 * )
 * 
 * @OA\pathItem(path="/api")
 */

class TodolistManager extends Controller
{


    public $task;
    public $prioritas;
    public $task_date;
    public $deskripsi;
    public $todolist_id;
    public $todolist = [];
    public $judul;
    public $tanggal;
    public $status;

    /**
     * @OA\Get(
     *      path="/api/todolist",
     *      summary="Ambil data TodoList dan Tasks",
     *      tags={"todolist"},
     *      @OA\Response(
     *          response=200,
     *          description="Daftar TodoList berhasil diambil",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="judul", type="string", example="Update Tema"),
     *                  @OA\Property(property="tanggal", type="string", format="date", example="2025-02-28")
     *              )
     *          )
     *      )
     * )
     */

    public function indexapi()
    {
        $todolist = todolist::all();
        return response()->json($todolist, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/tasks",
     *      summary="Ambil data TodoList dan Tasks",
     *      tags={"tasks"},
     *      @OA\Response(
     *          response=200,
     *          description="Daftar TodoList berhasil diambil",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="deskripsi", type="string", example="Buatkan saya makanan"),
     *                  @OA\Property(property="prioritas", type="string", example="Tinggi"),
     *                  @OA\Property(property="task_date", type="string", format="date", example="2025-03-23"),
     *                  @OA\Property(property="selesai", type="string", example="Belum Selesai")
     *              )
     *          )
     *      )
     * )
     */

    public function indexTaks()
    {
        $tasks = tasks::all();
        return response()->json($tasks, 200);
    }

    /**
     *  @OA\Post(
     *      path="/api/todolist",
     *      summary="Menambahkan data List Baru",
     *      tags={"List"},
     *      security={{"sanctum":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"judul", "tanggal"},
     *              @OA\Property(property="judul", type="string", example=""),
     *              @OA\Property(property="tanggal", type="string", format="date", example="")
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="List Berhasil Ditambahkan",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="List berhasil ditambahkan"),
     *              @OA\Property(property="data", type="object", 
     *                  @OA\Property(property="id", type="integer", example=1),
     *                  @OA\Property(property="judul", type="string", example="Update Tema"),
     *                  @OA\Property(property="tanggal", type="string", format="date", example="2025-02-28"),
     *                  @OA\Property(property="task_date", type="string", format="date-time", example="2025-03-23T10:00:00Z"),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-23T15:30:00Z")
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Respon Gagal",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=false),
     *              @OA\Property(property="message", type="string", example="List gagal ditambahkan"),
     *              @OA\Property(property="errors", type="object", 
     *                  @OA\Property(property="judul", type="array", 
     *                      @OA\Items(type="string", example="Kolom judul wajib diisi")
     *                  ),
     *                  @OA\Property(property="tanggal", type="array",
     *                      @OA\Items(type="string", example="Tanggal tidak valid")
     *                  )
     *              )
     *          )
     *      )
     * )
     */

    public function storeapi(Request $request)
    {

        // memvalidasi todo list yang akan dibuat
        $data = $request->validate([
            'judul' => 'required|string',
            'tanggal' => 'required'
        ]);

        //membuat todolist baru setelah validasi menyatakan true 
        $this->todolist = todolist::create($data);

        session()->flash('pesan', 'Todolist Berhasil Dibuat');

        //mereset ulang form input yang ada pada tampilan menjadi kosong
        $this->judul = '';
        $this->tanggal = '';
        $this->todolist = todolist::all();//menampilkan seluruh todolist setelah semua operasi berjalan

        return response()->json([
            'success' => true,
            'messagge' => "list berhasil dibuat",
            'data' => $this->todolist
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     *  @OA\Put(
     *      path="/api/tasks/{id}",
     *      summary="Belum Selesai Mumet",
     *      tags={"Tasks"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID Tasks yang akan diperbarui",
     *          @OA\Schema(type="integer")
     *        ),
     *        @OA\RequestBody(
     *              required=true,
     *              @OA\JsonContent(
     *                  @OA\Property(property="selesai", type="boolean", example="false") 
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Tasks Berhasil Diperbarui",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="Tasks berhasil diperbarui"),
     *              @OA\Property(property="status", type="string", example="Selesai")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validasi Gagal",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=false),
     *              @OA\Property(property="message", type="string", example="Validasi gagal, periksa input"),
     *              )
     *          )
     *      )
     *  )
     */

    public function updateTaks(Request $request, string $id)
    {
        // Mencari task berdasarkan ID
        $task = tasks::find($id);

        // Jika task tidak ditemukan, kembalikan response 404
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => "Task tidak ditemukan!",
                'status' => 'Belum Selesai'
            ], 404);
        }

        // Validasi request untuk memastikan 'status' ada dan berupa boolean
        $validated = $request->validate([
            'selesai' => 'required|boolean'
        ]);

        // Update status berdasarkan input
        $task->update(['selesai' => $validated['selesai']]);
        $task->save();

        return response()->json([
            'success' => true,
            'message' => "Data berhasil diubah",
            'status' => $validated['selesai'] ? 'Selesai' : 'Belum Selesai'
        ], 200);
    }




    /**
     * @OA\Delete(
     *     path="/api/todolist/{id}",
     *     summary="Menghapus data list",
     *     tags={"List"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID Todolist yang akan dihapus",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data Berhasil Dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="List berhasil dihapus"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="List tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function destroy(string $id)
    {
        //mencari data todolist berdasarkan id kemudian dihapus
        todolist::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => "data berhasil Hihapus"
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Delete a task",
     *     operationId="deleteTask",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of task to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="List berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="List tidak ditemukan")
     *         )
     *     )
     * )
     */


    public function destroyTask(string $id)
    {

        tasks::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => "data berhasil Hihapus"
        ], 200);
    }
}
