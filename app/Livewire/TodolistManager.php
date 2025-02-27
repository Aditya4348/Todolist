<?php

namespace App\Livewire;

use App\Models\tasks;
use Illuminate\Console\View\Components\Task;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\todolist;

class TodolistManager extends Component
{

    // properti yang digunakan untuk menyimpan data digunakan form dan tampilan
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
        //digunakan untuk mengambil data dari tabel todolist juga tabel task;
        $this->todolist = todolist::with('tasks')->get();
    }

    public function create()
    {
        // memvalidasi todo list yang akan dibuat
        $this->validate([
            'judul' => 'required',
            'tanggal' => 'required'
        ]);

        //membuat todolist baru setelah validasi menyatakan true 
        $this->todolist = todolist::create([
            'judul' => $this->judul,
            'tanggal' => $this->tanggal
        ]);

        session()->flash('pesan', 'Todolist Berhasil Dibuat');

        //mereset ulang form input yang ada pada tampilan menjadi kosong
        $this->judul = '';
        $this->tanggal = '';
        $this->todolist = todolist::all();//menampilkan seluruh todolist setelah semua operasi berjalan
    }

    public function taskCreate()
{
    // memvalidasi Task yang akan dibuat 
    $this->validate([
        'deskripsi' => 'required',
        'task_date' => 'required',
        'prioritas' => 'required',
        'todolist_id' => 'required'
    ]);

    //membuat Task baru setelah validasi menyatakan true 
    $this->task = tasks::create([
        'deskripsi' => $this->deskripsi,
        'task_date' => $this->task_date,
        'prioritas' => $this->prioritas,
        'todolist_id' => $this->todolist_id, 
    ]);

    session()->flash('sukses', 'Task Berhasil Dibuat');

    //mereset ulang form input yang ada pada tampilan menjadi kosong
    $this->deskripsi = '';
    $this->task_date = '';
    $this->prioritas = '';
    $this->todolist_id= '';
    $this->task = tasks::all();
}
    public function delete($id)
    {
        //mencari data todolist berdasarkan id kemudian dihapus
        todolist::find($id)->delete();

        session()->flash('pesanHapus', 'Todolist Berhasil dihapus');

        //menampilkan semua data setelah salah satu data di hapus
        $this->todolist = todolist::all();

    }

    public function deleteTask($id)
    {
        //mencari data tasks berdasarkan data kemudia dihapus
        tasks::find($id)->delete();

        session()->flash('pesanHapus', 'Task Berhasil dihapus');

        //menampilkan semua data setelah salah satu data di hapus
        $this->task = tasks::all();

    }

    public function markComplete($id){
        
        //mencari data task berdasarkan id kemudia dimasukan kedalam variabel $task
        $task = tasks::find($id);

        //pengecekan jika task ada atau true data pada tabel selesai di tasks akan di update menjadi true kemudian di save
        if ($task) {
            
            $task->selesai = true;
            $task->save(); # code...
        }else{//jika tidak ada akan memunculkan pesan 'Task tidak ditemukan!' 
            session()->flash('pesanHapus', 'Task tidak ditemukan!');
        }
        
    }

    //merender tampilan komponen. dan mengembalikan tampilan `todolist-manager` pada view livewire
    public function render()
    {
        return view('livewire.todolist-manager');
    }
}
