<?php

namespace App\Livewire;

use App\Models\tasks;
use Illuminate\Console\View\Components\Task;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\todolist;

class TodolistManager extends Component
{
    public $todolist;
    public $judul;
    public $tanggal;
    public $status;

    public function mount()
    {
        $this->todolist = todolist::all();
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


    public function delete($id)
    {

        todolist::find($id)->delete();

        session()->flash('pesanHapus', 'Todolist Berhasil dihapus');

        $this->todolist = todolist::all();

    }

    public function show($id)
    {

        $task = todolist::find($id);

        if (!$task) {
            abort(404, 'Task not found');
        }

        // Alihkan ke halaman task-manager dengan ID task
        return redirect()->route('task-manager', ['task' => $task->id]);
    }


    public function render()
    {
        return view('livewire.todolist-manager');
    }
}
