<?php

namespace App\Models;


use App\Models\tasks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todolist extends Model
{

    use HasFactory;

    protected $fillable = [
        'judul',
        'tanggal',
    ];


    public function tasks(){

        return $this->hasMany(tasks::class);

    }
}
