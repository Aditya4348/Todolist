<?php

namespace Database\Seeders;

use app\Models\todolist;
use App\Models\tasks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class task extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Menambahkan beberapa task menggunakan create()
        Tasks::create([
            'deskripsi' => 'Design Homepage',
            'task_date' => '2025-03-01',
            'prioritas' => 'Tinggi',
            'todolist_id' => '3',
        ]);
    }
}
