<?php

namespace App\Models;

use App\Models\todolist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'deskripsi',
        'task_date',
        'prioritas',
        'selesai',
        'todolist_id',
    ];


    protected $priority =['Tinggi','Sedang','Rendah'];


    public function tasks(){

        return $this->belongsTo(todolist::class);
        
    }
}
