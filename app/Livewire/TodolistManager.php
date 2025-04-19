<?php

namespace App\Livewire;

use App\Models\tasks;
use Livewire\Component;
use App\Models\todolist;

class TodolistManager extends Component
{
     // Properti untuk menyimpan data input dan digunakan di form
    public $task;
    public $prioritas;
    public $task_date;
    public $deskripsi;
    public $todolist_id;
    public $todolist = []; // Menyimpan seluruh data todolist dan relasi task
    public $judul;
    public $tanggal;
    public $status;

    // Method yang pertama kali dipanggil saat komponen dirender
    public function mount()
    {
        $this->loadTodolist(); // Memuat data todolist dari database
    }

    // Mengambil data todolist beserta relasi tasks dari database
    public function loadTodolist()
    {
        $this->todolist = todolist::with('tasks')->get()->keyBy('id')->toArray();
    }

    // Membuat data todolist baru
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

        // Reset input form
        $this->judul = '';
        $this->tanggal = '';
        $this->loadTodolist(); // Refresh data todolist
    }

    // Mengupdate data todolist berdasarkan ID
    public function update($id)
    {
        $data = $this->todolist[$id] ?? null;

        if (!$data) {
            session()->flash('messageError', 'Failed to update Todo List');    
        }

        $todo = todolist::find($id);
        $todo->judul = $data['judul'];
        $todo->tanggal =  $data['tanggal'];
        $todo->save();

        session()->flash('messageSuccess', 'Todolist Updated Successfully');
        $this->loadTodolist();
    }

    // Membuat task baru untuk todolist tertentu
    public function taskCreate()
    {
        $this->validate([
            'deskripsi' => 'required',
            'task_date' => 'required',
            'prioritas' => 'required',
            'todolist_id' => 'required',
        ]);

        $this->tasks = tasks::create([
            'deskripsi' => $this->deskripsi,
            'task_date' => $this->task_date,
            'prioritas' => $this->prioritas,
            'todolist_id' => $this->todolist_id,
        ]);

        session()->flash('pesan', 'Task Berhasil Dibuat');

        // Reset input form
        $this->deskripsi = '';
        $this->task_date = '';
        $this->prioritas = '';
        $this->todolist_id = '';
        $this->tasks = tasks::all();
    }

    // Menghapus todolist berdasarkan ID
    public function delete($id)
    {
        todolist::find($id)->delete();
        session()->flash('messageSuccess', 'List Delete Successfully');
        $this->loadTodolist();
    }

    // Menghapus task berdasarkan ID
    public function deleteTask($id)
    {
        tasks::find($id)->delete();
        session()->flash('message', 'List Berhasil Dihapus');
        $this->loadTodolist();
    }

    // Menandai sebuah task sebagai selesai
    public function markComplete($id)
    {
        $tasks = tasks::find($id);

        if ($tasks) {
            $tasks->selesai = true;
            $tasks->save();
            $this->loadTodolist();
        } else {
            session()->flash('messageError', 'Tasks Tidak Ditemukan Dihapus');
        }
    }

    // Merender tampilan Livewire dan mengarahkan ke view livewire.todolist-manager

    public function render()
    {
        return view('livewire.todolist-manager');
    }

}
