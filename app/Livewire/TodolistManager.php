<?php

namespace App\Livewire;

use App\Models\tasks;
use Illuminate\Console\View\Components\Task;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\todolist;

class TodolistManager extends Component
{
    public $task;
    public $prioritas;
    public $task_date;
    public $deskripsi;
    public $todolist_id ;
    public $todolist;
    public $judul;
    public $tanggal;
    public $status;

    public function mount()
    {
        $this->todolist = todolist::with('tasks')->get();
    }

    public function create()
    {
        $this->validate([
            'judul' => 'required',
            'tanggal' => 'required'
        ]);

        $this->todolist = todolist::create([
            'judul' => $this->judul,
            'tanggal' => $this->tanggal
        ]);

        session()->flash('pesan', 'Todolist Berhasil Dibuat');

        $this->judul = '';
        $this->tanggal = '';
        $this->todolist = todolist::all();
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

    // Reset the form fields
    $this->deskripsi = '';
    $this->task_date = '';
    $this->prioritas = '';
    $this->todolist_id= '';
    $this->task = tasks::all();
}
    public function delete($id)
    {

        todolist::find($id)->delete();

        session()->flash('pesanHapus', 'Todolist Berhasil dihapus');

        $this->todolist = todolist::all();

    }

    public function deleteTask($id)
    {

        tasks::find($id)->delete();

        session()->flash('pesanHapus', 'Task Berhasil dihapus');

        $this->task = tasks::all();

    }

    public function markComplete($id){
        
        $task = tasks::find($id);

        if ($task) {
            
            $task->selesai = true;
            $task->save(); # code...
        }else{
            session()->flash('pesanHapus', 'Task tidak ditemukan!');
        }
        
    }
    public function render()
    {
        return view('livewire.todolist-manager');
    }
}
