<?php

namespace App\Livewire;

use App\Models\tasks;
use Illuminate\Console\View\Components\Task;
use Livewire\Component;
use App\Models\todolist;

class TaskManager extends Component
{
    public $layout = 'layout.app';
    public $task;

    public $deskripsi;
    public $task_date;
    public $prioritas;
    public $todolist_id;


    // Menerima parameter taskId yang diteruskan melalui URL
    public function mount()
    {

        // Ambil task berdasarkan ID todolist_id yang diterima
        $this->task = tasks::all();

        // Jika task tidak ditemukan, beri pengecekan
        if (!$this->task) {
            abort(404, 'Task Not Found'); // Set task ke koleksi kosong jika tidak ada data
        }
    }

    public function taskCreate()
    {

        $this->validate([
            'deskripsi' => 'required',
            'task_date' => 'required',
            'prioritas' => 'required',
            'todolist_id' => 'required'
        ]);

        $this->task = tasks::create([
            'deskripsi' => $this->deskripsi,
            'task_date' => $this->task_date,
            'prioritas' => $this->prioritas,
            'todolist_id' => $this->todolist_id, // Pastikan todolist_id diisi
        ]);

        session()->flash('sukses', 'Task Berhasil Dibuat');

        $this->deskripsi = '';
        $this->task_date = '';
        $this->prioritas = '';
        $this->task = tasks::all();
    }

    public function render()
    {
        return view('livewire.task-manager')->layout('task');
    }
}
