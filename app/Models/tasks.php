<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    use HasFactory;

    protected $fillable =['deskripsi','task_date','prioritas','todolist_id','selesai'];

    protected $priorityOption =['Tinggi','Sedang','Rendah'];

    public function todolist(){
        return $this->belongsTo(todolist::class);
    }

    public function ValidatePriority(){
        return self::$priorityOption;
    }
}
