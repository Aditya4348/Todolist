<?php

namespace App\Livewire;

use App\Models\tasks;
use Livewire\Component;

class Task extends Component
{
    // untuk menyimpan data sementara dari form    
    public $taskId;
    public $deskripsi;
    public $task_date;
    public $prioritas;

    // Fungsi ini jalan pertama kali saat halaman dibuka
    public function mount($id)
    {
        // Cari data task berdasarkan ID dari database
        $data = tasks::find($id);

        // Simpan data task ke dalam variabel publik agar bisa ditampilkan di form
        $this->taskId = $data->id;
        $this->deskripsi = $data->deskripsi;
        $this->task_date = $data->task_date;
        $this->prioritas = $data->prioritas;

    }

    public function updateTask()
    {
        // memvalidasi inputan untuk memastikan inputan sesuai
        $this->validate([
            'deskripsi' => 'nullable|string',
            'task_date' => 'nullable|date',
            'prioritas' => 'nullable|in:Tinggi,Sedang,Rendah',
        ]);

        // Ambil data dari database berdasarkan ID
        $data = tasks::findOrFail($this->taskId);

        // Update data yang ada dengan input dari user
        $data->deskripsi = $this->deskripsi;
        $data->task_date = $this->task_date;
        $data->prioritas = $this->prioritas;
        $data->save(); // Simpan ke database

         // Bikin pesan sukses biar user tahu kalau update berhasil
        session()->flash('message', 'Data berhasil diperbarui!');

        // Setelah update, langsung balik ke halaman dashboard
        return redirect()->route('dashboard');
    }


    public function render()
    {
        return view('livewire.task')->layout('update');
    }
}
