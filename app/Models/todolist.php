<?php

namespace App\Models;

use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todolist extends Model
{
    use HasFactory;

    protected $fillable = ['judul','tanggal','status'];

    public function tasks(){
        return $this->hasMany(Task::class, 'todolist_id');
    }
}
