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

    // Menerima parameter taskId yang diteruskan melalui URL
    public function mount($task)
    {
        // Ambil task berdasarkan ID
        $this->task = todolist::find($task);

        // Jika task tidak ditemukan, bisa tambahkan pengecekan seperti ini
        if (!$this->task) {
            abort(404, 'Task not found');
        }
    }

    public function render()
    {
        return view('livewire.task-manager')->layout('livewire.task-manager');
    }
}
