<?php

namespace Database\Seeders;

use App\Models\todolist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class todolists extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        todolist::create([
            'judul' => 'Tugas Sekolah',
            'tanggal' => '2025-03-01',
        ]);
    }
}
